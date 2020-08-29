<?php

/**
 * SearchWP Debug.
 *
 * @package SearchWP
 * @author  Jon Christopher
 */

namespace SearchWP;

use SearchWP\Query;
use SearchWP\Dependencies\Monolog\Logger;
use SearchWP\Dependencies\Monolog\Formatter\LineFormatter;
use SearchWP\Dependencies\Monolog\Handler\RotatingFileHandler;

/**
 * Class Debug is responsible for logging.
 *
 * @since 4.0
 */
class Debug {

	/**
	 * Whether debugging is enabled.
	 *
	 * @since 4.0
	 * @var bool
	 */
	private $enabled = false;

	/**
	 * Our logger.
	 *
	 * @since 4.0
	 * @var mixed
	 */
	private $logger;

	/**
	 * Storage for queries that happened during this request.
	 *
	 * @since 4.0
	 * @var Query[]
	 */
	private $queries;

	/**
	 * Debug constructor.
	 *
	 * @since 4.0
	 */
	public function __construct() {
		$this->enabled = (bool) apply_filters( 'searchwp\debug', Settings::get( 'debug', 'boolean' ) );

		if ( $this->enabled ) {
			$this->init();
		}
	}

	/**
	 * Initializes the debugging environment (logfile, handler).
	 *
	 * @since 4.0
	 * @return void
	 */
	public function init() {
		$dir     = apply_filters( 'searchwp\debug\dir', trailingslashit( wp_upload_dir()['basedir'] ) . 'searchwp-logs' );
		$handler = new RotatingFileHandler( trailingslashit( $dir ) . 'searchwp-debug.log', 0, Logger::DEBUG, false );

		$handler->setFormatter( new LineFormatter( "[%datetime%] %message%\n", 'Y-m-d H:i:s', true ) );

		$this->logger = new Logger( 'SearchWP' );
		$this->logger->pushHandler( $handler );

		add_action( 'searchwp\debug\log', array( $this, 'log' ), 1, 2 );
		add_action( 'searchwp\query\ran', function( $query ) {
			$this->queries[] = $query;
		} );

		add_action( 'wp_footer', [ $this, 'output_front_end_debug_summary' ], 999 );
	}

	public function output_front_end_debug_summary() {
		if ( ! $this->enabled ) {
			return;
		}

?>

<!-- BEGIN SEARCHWP DEBUG

<?php if ( empty( $this->queries ) ) : ?>
[NO QUERIES]

<?php else : ?>
<?php $i = 1; foreach( $this->queries as $query ) { ?>
Query <?php echo $i . "\n"; ?>
===============

Keywords:         <?php echo esc_html( $query->get_keywords() ) . "\n"; ?>
Engine:           <?php echo esc_html( $query->get_engine()->get_label() ) . "\n"; ?>
<?php if ( ! empty( $query->get_suggested_search() ) ) : ?>
Suggested Search: <?php echo esc_html( $query->get_suggested_search() ) . "\n"; ?><?php endif; ?>
Tokens:           <?php echo esc_html( implode( ', ', $query->get_tokens() ) ) . "\n"; ?>
Found Results:    <?php echo esc_html( $query->found_results ) . "\n"; ?>
Max Pages:        <?php echo esc_html( $query->max_num_pages ) . "\n"; ?>
Query Time:       <?php echo esc_html( $query->query_time ) . "\n"; ?>
<?php if ( ! empty( $query->get_errors() ) ) : ?>
Errors:           YES [<?php echo count( $query->get_errors() ); ?>]<?php echo "\n"; endif; ?>

<?php
if ( extension_loaded( 'mbstring' ) && ! empty( $query->get_raw_results() ) ) {
	$builder = new \SearchWP\Dependencies\AsciiTable\Builder();

	foreach ( $query->get_raw_results() as $result ) {
		$title = $result->source;

		// If we're outputting WP_Posts we can find the Title.
		$flag = 'post' . SEARCHWP_SEPARATOR;
		if ( $flag === substr( $result->source, 0, strlen( $flag ) ) ) {
			$title = html_entity_decode( get_the_title( $result->id ) );
		}

		$builder->addRow([
			'Relevance' => $result->relevance,
			'ID'        => $result->id,
			'Source'    => $title,
			'Site'      => $result->site,
		]);
	}

	echo esc_textarea( $builder->renderTable() );
} else {
	echo "Results:\n\n";
	if ( empty( $query->get_raw_results() ) ) {
		echo "[[ NONE ]]\n";
	} else {
		print_r( $query->get_raw_results() );
	}
}
?>


<?php $i++; } ?>
<?php endif; ?>
END SEARCHWP DEBUG -->

<?php
	}

	/**
	 * Logs a message to the debug log.
	 *
	 * @since 4.0
	 * @param string $message The message to log.
	 * @return void
	 */
	public function log( $message = '', string $channel = '' ) {
		if ( $this->enabled ) {

			if ( ! is_string( $message ) ) {
				$message = print_r( $message, true );
			}

			if ( empty( trim( $channel ) ) ) {
				$channel = 'debug';
			}

			$this->logger->debug( "[{$channel}] $message" );
		}
	}
}
