<?php

/**
 * SearchWP Statistics.
 *
 * @package SearchWP
 * @author  Jon Christopher
 */

namespace SearchWP;

use SearchWP\Query;
use SearchWP\Index\Tables\LogTable;

/**
 * Class Statistics is responsible for logging searches and displaying statistics.
 *
 * @since 4.0
 */
class Statistics {

	/**
	 * Database table.
	 *
	 * @since 4.0
	 * @var   LogTable
	 */
	private $db_table;

	/**
	 * Capability requirement for viewing Statistics.
	 *
	 * @since 4.0
	 * @var string
	 */
	public static $capability = 'edit_others_posts';

	/**
	 * Statistics constructor.
	 *
	 * @since 4.0
	 */
	function __construct() {
		self::$capability = (string) apply_filters( 'searchwp\statistics\capability', self::$capability );

		add_action( 'searchwp\query\ran', [ $this, 'log' ] );
	}

	/**
	 * Logs searches.
	 *
	 * @since 4.0
	 * @param Query $query
	 * @return false|int
	 */
	public function log( Query $query ) {
		global $wpdb;

		// If it's an ignored query we don't need to clutter the database with it.
		$ignored = Settings::get( 'ignored_queries', 'array' );
		$default = ! in_array( $query->get_keywords(), $ignored );

		if ( ! apply_filters( 'searchwp\statistics\log', $default, $query ) ) {
			return false;
		}

		$this->db_table = new LogTable();
		$this->db_table->maybe_upgrade();

		return $wpdb->insert(
			$this->db_table->table_name,
			[
				'query'  => $query->get_keywords(),
				'tstamp' => current_time( 'mysql' ),
				'hits'   => $query->found_results,
				'engine' => $query->get_engine()->get_name(),
				'site'   => get_current_blog_id(),
			],
			[ '%s', '%s', '%d', '%s', '%d' ]
		);
	}

	/**
	 * Resets Statistics data.
	 *
	 * @since 4.0
	 * @return void
	 */
	public static function reset( $all_sites = false ) {
		global $wpdb;

		$db_table = new LogTable();
		$db_table->maybe_upgrade();

		if ( $all_sites ) {
			$db_table->truncate();
		} else {
			$wpdb->query( $wpdb->prepare( "
				DELETE FROM {$db_table->table_name}
				WHERE site = %d",
				get_current_blog_id()
			) );
		}
	}

	/**
	 * Retreives all Statistics.
	 *
	 * @since 4.0
	 * @return array
	 */
	public static function get() {
		$ignored = Settings::get( 'ignored_queries', 'array' );

		return [
			'ignored' => $ignored,
			'engines' => array_map( function( $engine ) use ( $ignored ) {
				$over_time = self::get_searches_over_time( [
					'days'    => 30,
					'engine'  => $engine->get_name(),
					'exclude' => $ignored,
				] );

				return [
					'engine' => $engine->get_name(),
					'label'  => $engine->get_label(),
					'data'   => [
						'labels'  => wp_list_pluck( $over_time, 'day' ),
						'counts'  => wp_list_pluck( $over_time, 'searches' ),
					],
					'details' => [ [
						'label' => __( 'No Results Searches', 'searchwp' ),
						'data'  => self::get_popular_searches( [
							'days'     => absint( apply_filters( 'searchwp\statistics\no_results\days_30', 30 ) ),
							'engine'   => $engine->get_name(),
							'min_hits' => 0,
							'max_hits' => 0,
							'exclude'  => $ignored,
						] ),
					], [
						'label' => __( 'Today', 'searchwp' ),
						'data'  => self::get_popular_searches( [
							'days'    => absint( apply_filters( 'searchwp\statistics\popular\days_1', 1 ) ),
							'engine'  => $engine->get_name(),
							'exclude' => $ignored,
						] ),
					], [
						'label' => __( 'This Month', 'searchwp' ),
						'data'  => self::get_popular_searches( [
							'days'    => absint( apply_filters( 'searchwp\statistics\popular\days_30', 30 ) ),
							'engine'  => $engine->get_name(),
							'exclude' => $ignored,
						] ),
					], [
						'label' => __( 'This Year', 'searchwp' ),
						'data'  => self::get_popular_searches( [
							'days'    => absint( apply_filters( 'searchwp\statistics\popular\days_365', 365 ) ),
							'engine'  => $engine->get_name(),
							'exclude' => $ignored,
						] ),
					], ],
				];
			}, Settings::get_engines() ),
		];
	}

	/**
	 * Displays the submitted statistics in an HTML table.
	 *
	 * @since 4.0
	 * @param array $statistics Stats as returned by @get_popular_searches.
	 * @param bool  $echo       Whether to echo.
	 * @return string|false|void
	 */
	public static function display( $statistics, $echo = true ) {
		if ( empty( $echo ) ) {
			ob_start();
		}

		if ( empty( $statistics ) ) {
			?>
			<p class="description"><?php esc_html_e( 'No searches for this time period.', 'searchwp' ); ?></p>
			<?php
		} else {
			$classes = apply_filters( 'searchwp\statistics\display\table\class', [] );
			?>
			<table cellpadding="0" cellspacing="0" class="<?php echo esc_attr( implode( ' ', (array) $classes ) ); ?>">
				<thead>
					<tr>
						<th><?php esc_html_e( 'Query', 'searchwp' ); ?></th>
						<th><?php esc_html_e( 'Count', 'searchwp' ); ?></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ( $statistics as $stat ) : ?>
					<tr>
						<td>
							<div title="<?php echo esc_attr( $stat->query ); ?>">
								<?php echo esc_html( $stat->query ); ?>
							</div>
						</td>
						<td>
							<?php echo absint( $stat->searches ); ?>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
			<?php
		}

		if ( empty( $echo ) ) {
			$output = ob_get_contents();
			ob_end_clean();

			return $output;
		}
	}

	/**
	 * Retrieves searches over time.
	 *
	 * @since 4.0
	 * @param array $args Arguments to consider when finding searches.
	 */
	public static function get_searches_over_time( array $args = [] ) {
		global $wpdb;

		$defaults = [
			'days'     => 1,                         // How many days (from now) to go back.
			'engine'   => 'default',                 // Engine used.
			'exclude'  => [],                        // Excluded search queries.
			'site'     => [ get_current_blog_id() ], // Site(s) to consider.
		];

		$args     = wp_parse_args( $args, $defaults );
		$values   = array_merge(
			[ $args['days'], $args['engine'] ],
			$args['site']
		);

		$exclude = '';
		if ( is_array( $args['exclude'] ) && ! empty( $args['exclude'] ) ) {
			$exclude = " AND query NOT IN (" . implode( ', ', array_fill( 0, count( $args['exclude'] ), '%s' ) ) . ') ';
			$values  = array_merge( $values, $args['exclude'] );
		}

		$db_table = new LogTable();
		$db_table->maybe_upgrade();

		$searches_per_day = $wpdb->get_results( $wpdb->prepare( "
			SELECT
				MONTH(tstamp) AS month,
				DAY(tstamp) AS day,
				COUNT(tstamp) AS searches
			FROM {$db_table->table_name}
				WHERE tstamp > DATE_SUB(NOW(), INTERVAL %d day)
					AND engine = %s
					AND query <> ''
					AND site IN (" . implode( ', ', array_fill( 0, count( $args['site'] ), '%d' ) ) . ")
				{$exclude}
			GROUP BY TO_DAYS(tstamp)
			ORDER BY tstamp ASC
			", $values ) );

		return array_reverse( array_map( function( $index ) use ( $searches_per_day ) {
			$timestamp = strtotime( '-'. ( $index ) .' days' );
			$month = date_i18n( 'M', $timestamp );
			$day   = date_i18n( 'd', $timestamp );

			$search_day = array_values( array_filter( $searches_per_day,
				function( $search_from_day ) use ( $timestamp ) {
					return date_i18n( 'j', $timestamp ) === $search_from_day->day
						&& date_i18n( 'n', $timestamp ) === $search_from_day->month;
				}
			) );

			return [
				'day'      => $month . ' ' . $day,
				'searches' => empty( $search_day ) ? 0 : $search_day[0]->searches,
			];
		}, range( 0, $args['days'] ) ) );
	}

	/**
	 * Retrieves popular searches based on submitted arguments.
	 *
	 * @since 4.0
	 * @param array $args Arguments to consider when finding popular searches.
	 */
	public static function get_popular_searches( array $args = [] ) {
		global $wpdb;

		$defaults = [
			'days'     => 1,                         // How many days (from now) to go back.
			'engine'   => 'default',                 // Engine used.
			'exclude'  => [],                        // Excluded search queries.
			'limit'    => 10,                        // How many searches to retrieve.
			'min_hits' => 1,                         // Minimum number of results returned for each search.
			'max_hits' => false,                     // Maximum number of results returned for each search.
			'site'     => [ get_current_blog_id() ], // Site(s) to consider.
		];

		$args   = wp_parse_args( $args, $defaults );
		$values = array_merge(
			[ $args['days'], $args['engine'] ],
			$args['site']
		);

		$min_hits = '';
		if ( false !== $args['min_hits'] ) {
			$min_hits = " AND hits >= %d";
			$values   = array_merge( $values, [ absint( $args['min_hits'] ) ] );
		}

		$max_hits = '';
		if ( false !== $args['max_hits'] ) {
			$max_hits = " AND hits <= %d";
			$values   = array_merge( $values, [ absint( $args['max_hits'] ) ] );
		}

		$exclude = '';
		if ( is_array( $args['exclude'] ) && ! empty( $args['exclude'] ) ) {
			$exclude = " AND query NOT IN (" . implode( ', ', array_fill( 0, count( $args['exclude'] ), '%s' ) ) . ') ';
			$values  = array_merge( $values, $args['exclude'] );
		}

		$values   = array_merge( $values, [ $args['limit'] ] );
		$db_table = new LogTable();
		$db_table->maybe_upgrade();

		return $wpdb->get_results( $wpdb->prepare( "
			SELECT query, count(query) AS searches
			FROM {$db_table->table_name}
			WHERE tstamp > DATE_SUB(NOW(), INTERVAL %d DAY)
			AND engine = %s
			AND site IN (" . implode( ', ', array_fill( 0, count( $args['site'] ), '%d' ) ) . ")
			{$min_hits}
			{$max_hits}
			{$exclude}
			GROUP BY query
			ORDER BY searches DESC, tstamp DESC
			LIMIT %d
		", $values ) );
	}
}
