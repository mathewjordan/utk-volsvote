<?php

/**
 * SearchWP i18n.
 *
 * @package SearchWP
 * @author  Jon Christopher
 */

namespace SearchWP\Admin;

/**
 * Class i18n is responsible for defining strings for i18n.
 *
 * @since 4.0
 */
class i18n {

	public static function get() {
		return [
			'_attribute' => sprintf(
				// Translators: placeholder is the number "1"
				__( '%s Attribute', 'searchwp' ),
				'{{ searchwpPlaceholder1 }}'
			),
			'_attributes' => sprintf(
				// Translators: placeholder is the number of attributes
				__( '%s Attributes', 'searchwp' ),
				'{{ searchwpPlaceholder1 }}'
			),
			'_rule' => sprintf(
				// Translators: placeholder is the number "1"
				__( '%s Rule', 'searchwp' ),
				'{{ searchwpPlaceholder1 }}'
			),
			'_rules' => sprintf(
				// Translators: placeholder is the number of attributes
				__( '%s Rules', 'searchwp' ),
				'{{ searchwpPlaceholder1 }}'
			),
			'_admin_engine_note' => __( 'This engine will be used for WordPress Admin searches, it will search these sources:', 'searchwp' ),
			'_admin_engine_tooltip' => __( 'When searching a supported Source, this Engine will be used', 'searchwp' ),
			'_admin_engine_defined_note' => sprintf(
				// Translators: placeholder is the label of the engine.
				__( 'Already set: %s', 'searchwp' ),
				'{{ searchwpPlaceholder1 }}' // This is a sequential token to be processed on the front end.
			),
			'_alternate_indexer_note' => __( 'Alternate indexer running, leave this browser window open', 'searchwp' ),
			'_attributes_choices_note' => wp_kses(
				sprintf(
					// Translators: 1st placeholder is the name of a Source, 2nd placeholder is the label of the engine.
					__( 'Choose which %1$s Attributes should be considered when searching the %2$s engine:', 'searchwp' ),
					'<strong>{{ sourceSingular }}</strong>',
					'<strong>{{ engineLabel }}</strong>'
				),
				[ 'strong' => [], ]
			),
			'_attributes_options_search_note' => wp_kses(
				sprintf(
					// Translators: 1st placeholder is the label of a Source Attribute.
					__( 'Type to search %1$s...', 'searchwp' ),
					'<strong>{{ attributeLabel }}</strong>'
				),
				[ 'strong' => [], ]
			),
			'_copy_clipboard_error' => __( 'There was an error copying to your clipboard, please manually copy and paste', 'searchwp' ),
			'_confirm_statistics_reset' => __( 'Are you sure you want to reset statistics? This cannot be undone!', 'searchwp' ),
			'_default_engine_note' => __( 'This engine will be used for native WordPress searches, it will search these sources:', 'searchwp' ),
			'_engine_note' => __( 'This engine will search these sources:', 'searchwp' ),
			'_default_admin_engine_note' => wp_kses(
				__( 'This engine will be used for native WordPress <strong>and</strong> Admin searches, it will search these sources', 'searchwp' ),
				[ 'strong' => [], ]
			),
			'_edit_rules_for_source_engine' => sprintf(
				// Translators: 1st placeholder is the label of the Source, 2nd placeholder is the label of the Engine.
				__( 'Edit Rules for %1$s (%2$s Engine)', 'searchwp' ),
				'{{ searchwpPlaceholder1 }}', // This is a sequential token to be processed on the front end.
				'{{ searchwpPlaceholder2 }}'  // This is a sequential token to be processed on the front end.
			),
			'_edit_settings_engine' => sprintf(
				// Translators: placeholder is the label of the engine.
				__( 'Edit Settings (%s engine)', 'searchwp' ),
				'{{ searchwpPlaceholder1 }}' // This is a sequential token to be processed on the front end.
			),
			'_exclude_if' => wp_kses(
				__( '<strong>Exclude</strong> entries if:', 'searchwp' ),
				[ 'strong' => [], ]
			),
			'_http_loopback_note' => __( 'HTTP Loopback connections are not working on this server; this window must be left open for the initial index to build. Subsequent content edits will be reindexed automatically when made.', 'searchwp' ),
			'_import_note' => __( 'To import: paste engine config export and click Import', 'searchwp' ),
			'_inactive_license_info' => wp_kses(
				sprintf(
					// Translators: 1st placeholder is an opening link, 2nd placeholder is closing, 3rd placeholder is an email link.
					__( '<p>Your license key can be retrieved or renewed within your %1$sAccount%2$s</p><p>If you are unable to activate your license due to network restrictions, please email %3$s first including your license key and then describing your issue.</p>', 'searchwp' ),
					'<a href="https://searchwp.com/account/" target="_blank">',
					'</a>',
					'<a href="mailto:support@searchwp.com">support@searchwp.com</a>'
				),
				[ 'p' => [], 'a' => [ 'href' => [], 'target' => [] ] ]
			),
			'_inactive_license_note' => __( 'Support and updates require an active license. Please activate your license to receive support.', 'searchwp' ),
			'_index_optimization_note' => __( 'Note: the index is automatically kept up to date and maintained for optimization', 'searchwp' ),
			'_index_outdated' => __( 'The index needs to be rebuilt.', 'searchwp' ),
			'_index_outdated_tooltip' => __( 'After certain engine configuration changes the index must be rebuilt', 'searchwp' ),
			'_indexer_blocked_note' => __( 'Indexer BLOCKED by HTTP Basic Authentication!', 'searchwp' ),
			'_invalid_default_engine_source_note' => __( 'Custom content Sources cannot be used in the Default engine', 'searchwp' ),
			'_keyword_stems_note' => __( 'Disregard keyword suffixes when searches are performed', 'searchwp' ),
			'_license_activation_problem' => __( 'There was a problem activating your license. Please ensure this server can communicate with searchwp.com and try again.', 'searchwp' ),
			'_license_deactivation_problem' => __( 'There was a problem deactivating your license. Please ensure this server can communicate with searchwp.com and try again.', 'searchwp' ),
			'_manage_engine_source_attributes' => sprintf(
				// Translators: 1st placeholder is the label of the Attribute, 2nd placeholder is the label of the Engine.
				__( 'Manage %1$s Attributes (%2$s Engine)', 'searchwp' ),
				'{{ searchwpPlaceholder1 }}', // This is a sequential token to be processed on the front end.
				'{{ searchwpPlaceholder2 }}'  // This is a sequential token to be processed on the front end.
			),
			'_manage_ignored_note' => __( 'The following queries have been ignored both when logging and displaying statistics.', 'searchwp' ),
			'_manage_ignored_note_none' => __( 'There are no ignored queries at this time.', 'searchwp' ),
			'_needs_initial_save' => __( 'To enable SearchWP, please save your initial settings which builds the index', 'searchwp' ),
			'_no_attributes_note' => __( 'In order for results to be returned, you must add Attributes to be searched.', 'searchwp' ),
			'_no_rules_note' => __( 'There are no rules', 'searchwp' ),
			'_no_rules_for_note' => sprintf(
				// Translators: placeholder is the label of the Rule.
				__( 'There are currently no rules for %s.', 'searchwp' ),
				'{{ searchwpPlaceholder1 }}' // This is a sequential token to be processed on the front end.
			),
			'_no_sources_warning' => __( 'In order for this engine to return results, you must add at least one source', 'searchwp' ),
			'_no_stopwords_note' => __( 'There are currently no stopwords.', 'searchwp' ),
			'_no_suggested_stopwords_note' => __( 'There are no suggested stopwords to add at this time.', 'searchwp' ),
			'_no_synonyms_note' => __( 'There are currently no synonyms.', 'searchwp' ),
			'_only_show_if' => wp_kses(
				__( '<strong>Only show</strong> entries if:', 'searchwp' ),
				[ 'strong' => [], ]
			),
			'_stopwords_note' => wp_kses(
				sprintf(
					// Translators: 1st placeholder opens the link, 2nd placeholder closes it.
					__( 'Stopwords are <em>ignored</em> so as to improve relevancy and performance. %1$sMore info%2$s', 'searchwp' ),
					'<a href="https://searchwp.com/?p=218825#stopwords" target="_blank">',
					'</a>'
				),
				[ 'em' => [], 'a' => [ 'href' => [], 'target' => [] ] ]
			),
			'_suggested_stopwords_note' => __( 'The following terms may be too common to have a positive effect on searches, consider adding them as Stopwords.', 'searchwp' ),
			'_synonyms_note' => wp_kses(
				sprintf(
					// Translators: 1st placeholder opens the link, 2nd placeholder closes it.
					__( 'Synonyms facilitate <em>replacement</em> of search terms. %1$sMore info%2$s', 'searchwp' ),
					'<a href="https://searchwp.com/?p=218825#synonyms" target="_blank">',
					'</a>'
				),
				[ 'em' => [], 'a' => [ 'href' => [], 'target' => [] ] ]
			),
			'_synonyms_replace_tooltip' => __( 'When enabled, original Search Term(s) will be removed', 'searchwp' ),
			'_synonyms_synonyms_tooltip' => __( 'Term(s) that are synonymous with the Search Term(s)', 'searchwp' ),
			'_synonyms_term_tooltip' => __( 'What visitors search for (separate different search terms by commas)', 'searchwp' ),
			'_rebuild_index_confirmation' => __( 'Are you sure you want to rebuild the index? This cannot be undone!', 'searchwp' ),
			'_save_source_attributes' => sprintf(
				// Translators: 1st placeholder is the name of a Source.
				__( 'Save %1$s Attributes', 'searchwp' ),
				'{{ sourceSingular }}'
			),
			'_system_information_note' => __( 'Please copy and paste this System Information when requested', 'searchwp' ),
			'_wake_indexer_note' => __( 'If the indexer appears to be stuck, first review the PHP error log to see if anything needs to be fixed before waking it up. The indexer can become stuck when customizations are not working as expected.', 'searchwp' ),
			'_welcome_blurb' => wp_kses(
				sprintf(
					// Translators: 1st placeholder opens the link, 2nd placeholder closes it.
					__( '<p>A default Engine has been generated as a starting point for you to customize. Once saved, SearchWP will then build its index and provide terrific search results automatically!</p><p>To find out more about customizing SearchWP, please %1$sreview the documentation%2$s.</p><p class="description">Thank you!</p>', 'searchwp' ),
					'<a href="https://searchwp.com/documentation/" target="_blank">',
					'</a>'
				),
				[ 'p' => [ 'class' => [] ], 'a' => [ 'href' => [], 'target' => [] ] ]
			),
			'_welcome_intro' => __( 'Thank you for activating SearchWP!', 'searchwp' ),
			'_welcome_migration_intro' => wp_kses(
				sprintf(
					// Translators: 1st placeholder opens the link, 2nd placeholder closes it.
					__( 'Your settings from SearchWP 3.x have been migrated. To delete legacy data from SearchWP 3.x please use %1$sthis Extension%2$s.', 'searchwp' ),
					'<a href="https://searchwp.com/extensions/legacy-data-removal/" target="_blank">',
					'</a>'
				),
				[ 'a' => [ 'href' => [], 'target' => [] ] ]
			),
			'_welcome_migration_success' => wp_kses(
				sprintf(
					// Translators: 1st placeholder opens the link, 2nd placeholder closes it.
					__( 'All data from SearchWP 3.x has been migrated! Legacy data can be removed with %1$sthis Extension%2$s.', 'searchwp' ),
					'<a href="https://searchwp.com/extensions/legacy-data-removal/" target="_blank">',
					'</a>'
				),
				[ 'a' => [ 'href' => [], 'target' => [] ] ]
			),
			'_welcome_migration_warning' => wp_kses(
				__( 'Statistics have <strong>NOT</strong> been migrated as it may take some time to do so.', 'searchwp' ),
				[ 'strong' => [], 'em' => [] ]
			),
			'_welcome_warning' => wp_kses(
				__( '<strong>Before SearchWP can take effect</strong> you will need to <em>review and save</em> your Engine(s)', 'searchwp' ),
				[ 'strong' => [], 'em' => [] ]
			),
			// Translators: this is the suffix for the Statistics tooltip.
			' Searches' => __( ' Searches', 'searchwp' ),
			'Actions' => __( 'Actions', 'searchwp' ),
			'Actions & Settings' => __( 'Actions & Settings', 'searchwp' ),
			'Activate' => __( 'Activate', 'searchwp' ),
			'Active' => __( 'Active', 'searchwp' ),
			'There are no omitted entries at this time.' => __( 'There are no omitted entries at this time.', 'searchwp' ),
			'Omitted' => __( 'Omitted', 'searchwp' ),
			'Omitted Entries' => __( 'Omitted Entries', 'searchwp' ),
			'SearchWP was unable to index the following content due to an indexing failure. Reviewing server logs may expose the reason for failure.' => __( 'SearchWP was unable to index the following content due to an indexing failure. Reviewing server logs may expose the reason for failure.', 'searchwp' ),
			'Reintroduce' => __( 'Reintroduce', 'searchwp' ),
			'Add New' => __( 'Add New', 'searchwp' ),
			'Add Rule' => __( 'Add Rule', 'searchwp' ),
			'Add Stopword' => __( 'Add Stopword', 'searchwp' ),
			'Admin Engine' => __( 'Admin Engine', 'searchwp' ),
			'Advanced Settings' => __( 'Advanced Settings', 'searchwp' ),
			'AND' => __( 'AND', 'searchwp' ),
			'Are you sure? The existing background process will be destroyed and then restarted.' => __( 'Are you sure? The existing background process will be destroyed and then restarted.', 'searchwp' ),
			'Are you sure you want to delete this engine?' => __( 'Are you sure you want to delete this engine?', 'searchwp' ),
			'Attributes' => __( 'Attributes', 'searchwp' ),
			'Applicable Attribute Relevance' => __( 'Applicable Attribute Relevance', 'searchwp' ),
			'Cancel' => __( 'Cancel', 'searchwp' ),
			'Sources & Settings' => __( 'Sources & Settings', 'searchwp' ),
			'Min' => __( 'Min', 'searchwp' ),
			'Max' => __( 'Max', 'searchwp' ),
			'Resetting index...' => __( 'Resetting index...', 'searchwp' ),
			'Saving Engines...' => __( 'Saving Engines...', 'searchwp' ),
			'Clear Stopwords' => __( 'Clear Stopwords', 'searchwp' ),
			'Close' => __( 'Close', 'searchwp' ),
			'Collapse Sources' => __( 'Collapse Sources', 'searchwp' ),
			'Copied!' => __( 'Copied!', 'searchwp' ),
			'Fix this' => __( 'Fix this', 'searchwp' ),
			'Copy to clipboard' => __( 'Copy to clipboard', 'searchwp' ),
			'Deactivate' => __( 'Deactivate', 'searchwp' ),
			'Debugging enabled' => __( 'Debugging enabled', 'searchwp' ),
			'Delete' => __( 'Delete', 'searchwp' ),
			'Delete Engine' => __( 'Delete Engine', 'searchwp' ),
			'Done' => __( 'Done', 'searchwp' ),
			'Edit Rules' => __( 'Edit Rules', 'searchwp' ),
			'Engine Configuration Transfer' => __( 'Engine Configuration Transfer', 'searchwp' ),
			'Engine Label' => __( 'Engine Label', 'searchwp' ),
			'Engine Name' => __( 'Engine Name', 'searchwp' ),
			'Engines import complete.' => __( 'Engines import complete.', 'searchwp' ),
			'Exclude entries if:' => __( 'Exclude entries if:', 'searchwp' ),
			'Existing engines with the same name will be overwritten. Continue?' => __( 'Existing engines with the same name will be overwritten. Continue?', 'searchwp' ),
			'Expand Sources' => __( 'Expand Sources', 'searchwp' ),
			'Export' => __( 'Export', 'searchwp' ),
			'There are no engines to export!' => __( 'There are no engines to export!', 'searchwp' ),
			'Get Help' => __( 'Get Help', 'searchwp' ),
			'Import' => __( 'Import', 'searchwp' ),
			'Performing migration, please wait...' => __( 'Performing migration, please wait...', 'searchwp' ),
			'Import Engine(s)' => __( 'Import Engine(s)', 'searchwp' ),
			'Inactive' => __( 'Inactive', 'searchwp' ),
			'Index Status' => __( 'Index Status', 'searchwp' ),
			'Keyword Stems' => __( 'Keyword Stems', 'searchwp' ),
			'Last Activity' => __( 'Last Activity', 'searchwp' ),
			'License' => __( 'License', 'searchwp' ),
			'Add/Remove Attributes' => __( 'Add/Remove Attributes', 'searchwp' ),
			'Manage Attributes' => __( 'Manage Attributes', 'searchwp' ),
			'Manage Ignored' => __( 'Manage Ignored', 'searchwp' ),
			'Manage Ignored Queries' => __( 'Manage Ignored Queries', 'searchwp' ),
			'Migrate Statistics' => __( 'Migrate Statistics', 'searchwp' ),
			'Indexed' => __( 'Indexed', 'searchwp' ),
			'is' => __( 'is', 'searchwp' ),
			'Options' => __( 'Options', 'searchwp' ),
			'Only show entries if:' => __( 'Only show entries if:', 'searchwp' ),
			'OR' => __( 'OR', 'searchwp' ),
			'Or choose from the following shortcuts' => __( 'Or choose from the following shortcuts', 'searchwp' ),
			'Prevalence' => __( 'Prevalence', 'searchwp' ),
			'Query' => __( 'Query', 'searchwp' ),
			'Rebuild Index' => __( 'Rebuild Index', 'searchwp' ),
			'Replace' => __( 'Replace', 'searchwp' ),
			'Reset' => __( 'Reset', 'searchwp' ),
			'Restore Defaults' => __( 'Restore Defaults', 'searchwp' ),
			'Rules' => __( 'Rules', 'searchwp' ),
			'Save' => __( 'Save', 'searchwp' ),
			'Save Engines' => __( 'Save Engines', 'searchwp' ),
			'Save Settings' => __( 'Save Settings', 'searchwp' ),
			'Update FAILED!' => __( 'Update FAILED!', 'searchwp' ),
			'Indexer communication error. See console.' => __( 'Indexer communication error. See console.', 'searchwp' ),
			'Saving engine settings FAILED!' => __( 'Saving engine settings FAILED!', 'searchwp' ),
			'Saving engine settings FAILED! View console for more information.' => __( 'Saving engine settings FAILED! View console for more information.', 'searchwp' ),
			'Search these sources:' => __( 'Search these sources:', 'searchwp' ),
			'Search Term(s)' => __( 'Search Term(s)', 'searchwp' ),
			'Searches' => __( 'Searches', 'searchwp' ),
			'Searches over the past 30 days' => __( 'Searches over the past 30 days', 'searchwp' ),
			'SearchWP Engines' => __( 'SearchWP Engines', 'searchwp' ),
			'SearchWP Statistics' => __( 'SearchWP Statistics', 'searchwp' ),
			'SearchWP Support' => __( 'SearchWP Support', 'searchwp' ),
			'SearchWP Settings' => __( 'SearchWP Settings', 'searchwp' ),
			'SearchWP Advanced' => __( 'SearchWP Advanced', 'searchwp' ),
			'Settings' => __( 'Settings', 'searchwp' ),
			'Settings update FAILED' => __( 'Settings update FAILED', 'searchwp' ),
			'Sort Alphabetically' => __( 'Sort Alphabetically', 'searchwp' ),
			'ID' => __( 'ID', 'searchwp' ),
			'Source' => __( 'Source', 'searchwp' ),
			'Sources' => __( 'Sources', 'searchwp' ),
			'Statistic' => __( 'Statistic', 'searchwp' ),
			'Stopwords' => __( 'Stopwords', 'searchwp' ),
			'Support' => __( 'Support', 'searchwp' ),
			'Suggested Stopwords' => __( 'Suggested Stopwords', 'searchwp' ),
			'Synonyms' => __( 'Synonyms', 'searchwp' ),
			'Synonym(s)' => __( 'Synonym(s)', 'searchwp' ),
			'System Information' => __( 'System Information', 'searchwp' ),
			'Term' => __( 'Term', 'searchwp' ), // Translators: prefaced by (translation of) "transfer weight".
			'to entry ID' => __( 'to entry ID', 'searchwp' ), // Translators: prefaced by (translation of) "transfer weight".
			'Total' => __( 'Total', 'searchwp' ),
			'Type to search options...' => __( 'Type to search options...', 'searchwp' ),
			'Unignore' => __( 'Unignore', 'searchwp' ),
			'Use for Admin searches' => __( 'Use for Admin searches', 'searchwp' ),
			'Use keyword stems' => __( 'Use keyword stems', 'searchwp' ),
			'Value' => __( 'Value', 'searchwp' ),
			'View Suggestions' => __( 'View Suggestions', 'searchwp' ),
			'Wake Up Indexer' => __( 'Wake Up Indexer', 'searchwp' ),
			'Waking indexer FAILED. View console for more information.' => __( 'Waking indexer FAILED. View console for more information.', 'searchwp' ),
			'Welcome' => __( 'Welcome', 'searchwp' ),
			'More Info' => __( 'More Info', 'searchwp' ),
			'Log information during indexing and searching for review' => __( 'Log information during indexing and searching for review', 'searchwp' ),
			'Partial matches (fuzzy when necessary)' => __( 'Partial matches (fuzzy when necessary)', 'searchwp' ),
			'Find partial matches when search terms yield no results' => __( 'Find partial matches when search terms yield no results', 'searchwp' ),
			'Automatic "Did you mean?" corrections' => __( 'Automatic "Did you mean?" corrections', 'searchwp' ),
			'Use the closest match for searches that yield no results and output a notice' => __( 'Use the closest match for searches with no results and output a notice (requires partial matches)', 'searchwp' ),
			'Support "quoted/phrase searches"' => __( 'Support "quoted/phrase searches"', 'searchwp' ),
			'When search terms are wrapped in double quotes, results will be limited to those with exact matches' => __( 'When search terms are wrapped in double quotes, results will be limited to those with exact matches', 'searchwp' ),
			'Highlight terms in results' => __( 'Highlight terms in results', 'searchwp' ),
			'Automatically highlight search terms when possible' => __( 'Automatically highlight search terms when possible', 'searchwp' ),
			'Parse Shortcodes when indexing' => __( 'Parse Shortcodes when indexing', 'searchwp' ),
			'Index expanded Shortcode output (at the time of indexing)' => __( 'Index expanded Shortcode output (at the time of indexing)', 'searchwp' ),
			'Exclusive regex matches' => __( 'Exclusive regex matches', 'searchwp' ),
			'When enabled, tokens generated from regex pattern matches will not be indexed' => __( 'When enabled, tokens generated from regex pattern matches will not be indexed', 'searchwp' ),
			'Remove minimum word length' => __( 'Remove minimum word length', 'searchwp' ),
			'Index everything regardless of token length' => __( 'Index everything regardless of token length', 'searchwp' ),
			'Indexer Paused' => __( 'Indexer Paused', 'searchwp' ),
			'Queued updates will be processed immediately when the indexer is unpaused' => __( 'Queued updates will be processed immediately when the indexer is unpaused', 'searchwp' ),
			'Continue to queue (but do not apply) delta index updates' => __( 'Continue to queue (but do not apply) delta index updates', 'searchwp' ),
			'Reduced indexer aggressiveness' => __( 'Reduced indexer aggressiveness', 'searchwp' ),
			'Process less data per index pass (less resource intensive, but slower)' => __( 'Process less data per index pass (less resource intensive, but slower)', 'searchwp' ),
			'Remove all data on uninstall' => __( 'Remove all data on uninstall', 'searchwp' ),
			'Remove all traces of SearchWP when it is deactivated and deleted from the Plugins page' => __( 'Remove all traces of SearchWP when it is deactivated and deleted from the Plugins page', 'searchwp' ),
		];
	}
}
