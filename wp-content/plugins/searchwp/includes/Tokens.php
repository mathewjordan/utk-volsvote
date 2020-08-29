<?php

/**
 * SearchWP Token Collection.
 *
 * @package SearchWP
 * @author  Jon Christopher
 */

namespace SearchWP;

use SearchWP\Utils;
use SearchWP\Stemmer;
use SearchWP\Settings;

/**
 * Class Tokens is a collection of tokenized strings.
 *
 * @since 4.0
 */
class Tokens {

	/**
	 * Collection items.
	 *
	 * @since 4.0
	 * @var   array
	 */
	private $items = [];

	/**
	 * Tokens that have been whitelisted by whitelist patterns.
	 *
	 * @since 4.0
	 * @var array
	 */
	private $whitelisted = [];

	/**
	 * Whether regex patterns are tokenized.
	 *
	 * @since 4.0
	 * @var bool
	 */
	public $tokenize_pattern_matches = false;

	/**
	 * The (stringified) raw value.
	 *
	 * @since 4.0
	 * @var string
	 */
	public $raw = '';

	/**
	 * Constructor.
	 *
	 * @since 4.0
	 */
	function __construct( $data = false ) {
		$this->tokenize_pattern_matches = (bool) apply_filters(
			'searchwp\tokens\tokenize_pattern_matches',
			Settings::get_single( 'tokenize_pattern_matches', 'boolean' )
		);

		if ( ! empty( $data ) ) {
			$this->tokenize( $data );
		}
	}

	/**
	 * Tokenizes the submitted data by extracting string values from any data type.
	 *
	 * @since 4.0
	 * @param mixed $data The data to tokenize, can be anything.
	 */
	public function tokenize( $data ) {
		// Tokens are built from strings. We need to convert the data into a string.
		$string = Utils::get_string_from( $data );

		// Now that we have a string, we need to make sure it's formatted how we expect.
		$string = Utils::normalize_string( $string );

		// Handle HTML.
		$string = Utils::stringify_html( $string );

		// Store the original, raw value.
		$this->raw = $string;

		// Extract whitelist matches.
		$this->whitelisted = $this->get_whitelisted_tokens_from_string( $string );

		// Maybe remove whitelist matches.
		if ( ! empty( $this->whitelisted ) && ! $this->tokenize_pattern_matches ) {
				$string = Utils::remove_strings_from_string( $this->whitelisted, $string );
		}

		// Clean the string.
		$string = Utils::clean_string( $string );

		// We always work with arrays of tokens.
		$string_array = explode( ' ', $string );

		// Remove accents from tokens if applicable.
		if ( ! apply_filters( 'searchwp\tokens\strict', false ) ) {
			$string_array = array_merge( $string_array, array_filter( array_map( function( $string ) {
				$accents_removed = apply_filters(
					'searchwp\tokens\removed_accents',
					remove_accents( $string )
				);

				return $accents_removed === $string ? false : $accents_removed;
			}, $string_array ) ) );
		}

		// Explode the string and add each as a Token.
		if ( ! empty( $string_array ) ) {
			$string_array = $this->apply_rules( $string_array );
			array_walk(
				$string_array,
				function( $string ) {
					$this->items[] = $string;
				}
			);
		}

		// Append whitelist matches.
		array_walk(
			$this->whitelisted,
			function( $whitelisted_token ) {
				$this->items[] = $whitelisted_token;
			}
		);

		// Return the tokens.
		return $this->items;
	}

	/**
	 * Map tokens to Index token IDs.
	 *
	 * @since 4.0
	 * @return array
	 */
	public function map_index_ids( array $tokens = [], $use_stems = false ) {
		global $wpdb;

		if ( empty( $tokens ) ) {
			$tokens = $this->items;
		}

		$col = 'token';

		if ( ! empty( $use_stems ) ) {
			$stemmer = new Stemmer();
			$col     = 'stem';
			$tokens  = array_map( function( $token ) use ( $stemmer ) {
				return $stemmer->stem( $token );
			}, $tokens );
		}

		$ids    = [];
		$index  = \SearchWP::$index;
		$tokens = $wpdb->get_results( $wpdb->prepare(
			"SELECT id, token
			FROM {$index->get_tables()['tokens']->table_name}
			WHERE {$col} IN ( " . implode( ', ', array_fill( 0, count( $tokens ), '%s' ) ) . " )
			ORDER BY FIELD(token, " . implode( ', ', array_fill( 0, count( $tokens ), '%s' ) ) . ')',
			array_merge( $tokens, $tokens )
		), ARRAY_A );

		foreach ( $tokens as $token ) {
			$ids[ absint( $token['id'] ) ] = sanitize_text_field( $token['token'] );
		}

		// If there was a token submitted that's not in the index it will be flagged with an ID of zero.
		// This may prove to be essential knowledge e.g. if forcing AND logic.
		foreach ( $this->items as $search_token ) {
			if ( ! in_array( $search_token, $ids, true ) ) {
				$existing_missing = isset( $ids[0] ) ? $ids[0] : '';
				$ids[0] = trim( $existing_missing . ' ' . sanitize_text_field( $search_token ) );
			}
		}

		return $ids;
	}

	/**
	 * Apply token whitelist patterns to a string and return matches.
	 *
	 * @since 4.0
	 * @param string $string The string to check.
	 * @return array
	 */
	public function get_whitelisted_tokens_from_string( string $string ) {
		if ( empty( $string ) ) {
			return [];
		}

		// Iterate over token whitelist matches and find matches for each.
		$matches = [];

		foreach ( Utils::get_token_whitelist_patterns() as $regex_pattern ) {
			preg_match_all( $regex_pattern, $string, $match_set );

			if ( ! is_array( $match_set[0] ) || empty( $match_set[0] ) ) {
				continue;
			}

			// We only want to work with the full match set. If this hook returns false,
			// all group matches will be considered as well.
			if( (bool) apply_filters( 'searchwp\tokens\whitelist\only_full_matches', true ) ) {
				$match_set = [ $match_set[0] ];
			}

			// Iterate through this set of matches and process each match.
			foreach ( $match_set as $match_set_matches ) {
				if ( empty( $match_set_matches ) || ! is_array( $match_set ) ) {
					continue;
				}

				$matches = array_merge(
					$matches,
					array_map(
						function( $match ) {
							$match = trim( $match );
							$match = function_exists( 'mb_strtolower' )
										? mb_strtolower( $match, 'UTF-8' )
										: strtolower( $match );

							return $match;
						},
						$match_set_matches
					)
				);
			}

			// Remove the matches from the string?
			if ( ! $this->tokenize_pattern_matches ) {
				$string = Utils::remove_strings_from_string( $matches, $string );
			}
		}

		// Finalize and validate our matches.
		$matches = array_map( 'sanitize_text_field', $matches );
		$matches = array_map( 'trim', $matches );
		$matches = array_filter( $matches );

		if ( apply_filters( 'searchwp\tokens\apply_rules_to_whitelist', true ) ) {
			$matches = $this->apply_rules( $matches );
		}

		return $matches;
	}

	/**
	 * Retrieves minimum token length in number of characters.
	 *
	 * @since 4.0
	 * @return int Minimum length.
	 */
	public function get_minimum_length() {
		$min_length = Settings::get( 'remove_min_word_length', 'boolean' ) ? 1 : 3;
		return absint( apply_filters( 'searchwp\tokens\minimum_length', $min_length ) );
	}

	/**
	 * Applies rules (e.g. minimum character length, stopwords ) to submitted strings.
	 *
	 * @since 4.0
	 * @param array $data The data to apply rules.
	 * @return array
	 */
	public function apply_rules( array $strings ) {
		$min_length = $this->get_minimum_length();
		$max_length = 80; // Database schema.

		$strings = array_filter( $strings, function( $string ) use( $min_length, $max_length ) {
			return strlen( $string ) >= $min_length && strlen( $string ) <= $max_length;
		} );

		// Stopwords hook in here.
		return apply_filters( 'searchwp\tokens', $strings );
	}

	/**
	 * Getter for collection items.
	 *
	 * @since 4.0
	 * @return array
	 */
	public function get() {
		return $this->items;
	}
}
