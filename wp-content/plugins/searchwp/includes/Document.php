<?php

/**
 * SearchWP Document.
 *
 * @package SearchWP
 * @author  Jon Christopher
 */

namespace SearchWP;

use SearchWP\Parser;

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

/**
 * Class Document is responsible for modeling an attachment WP_Post.
 *
 * @since 4.0
 */
class Document extends Parser {

	/**
	 * Meta key that stores parsed Document content.
	 *
	 * @since 4.0
	 * @var string
	 */
	public static $meta_key = SEARCHWP_PREFIX . 'content';

	/**
	 * Retrieve the file content from a Media entry.
	 *
	 * @since 4.0
	 * @param WP_Post $post The Media entry.
	 * @return string
	 */
	public static function get_content( \WP_Post $post ) {
		$mime_type = $post->post_mime_type;
		$filename  = get_attached_file( $post->ID );
		$content   = self::get_stored_content( $post );
		$skipped   = apply_filters( 'searchwp\document\skip',
			get_post_meta( $post->ID, self::$meta_key . '_skipped', true ), $post );

		if ( empty( $content ) && ! $skipped ) {
			$content = apply_filters( 'searchwp\document\content',
				self::extract_text( $filename, $mime_type, $post ), $post );

			if ( empty( $content ) ) {
				// There was an actual error or there's no content.
				// Flag this to omit skip from further extraction attempts.
				update_post_meta( $post->ID, self::$meta_key . '_skipped', true );
			}

			update_post_meta( $post->ID, self::$meta_key, $content );
		}

		return (string) $content;
	}

	/**
	 * Retrieve stored document content.
	 *
	 * @since 4.0
	 * @return mixed|string
	 */
	public static function get_stored_content( \WP_Post $post ) {
		return get_post_meta( $post->ID, self::$meta_key, true );
	}

	/**
	 * Retrieve PDF metadata from a Media entry.
	 *
	 * @since 4.0
	 * @param WP_Post $post The Media entry.
	 * @return string
	 */
	public static function get_pdf_metadata( \WP_Post $post ) {
		$filename = get_attached_file( $post->ID );
		$skipped  = apply_filters( 'searchwp\document\pdf_metadata\skip',
			get_post_meta( $post->ID, self::$meta_key . '_skipped_pdf_metadata', true ), $post );

		if ( $skipped || ! file_exists( $filename ) || 'application/pdf' !== $post->post_mime_type ) {
			return null;
		}

		$pdf_parser = new \SearchWP\Dependencies\Smalot\PdfParser\Parser();

		try {
			$metadata = $pdf_parser->parseFile( $filename )->getDetails();

			update_post_meta( $post->ID, self::$meta_key . '_pdf_metadata', $metadata );
		} catch (\Exception $e) {
			do_action(
				'searchwp\debug\log',
				'PDF metadata extraction failed: ' . sanitize_text_field( $e->getMessage() ),
				'parser'
			);

			update_post_meta( $post->ID, self::$meta_key . '_skipped_pdf_metadata', true );

			$metadata = null;
		}

		return $metadata;
	}
}
