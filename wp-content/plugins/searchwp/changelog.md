### 4.0.9
- **[Fix]** Regression introduced in 4.0.6 that prevented non `WP_Post` results from returning

### 4.0.8
- **[Fix]** Issue where taxonomy Rules for Media were not applied correctly in some cases

### 4.0.7
- **[Fix]** Mod `WHERE` clauses not restricted to `Source` when defined

### 4.0.6
- **[Change]** Post is now returned when parent weight transfer is enabled but Post has no `post_parent`
- **[Improvement]** Excerpt handling for native results
- **[Improvement]** Additional prevention of invalid `WP_Post` results being returned in one case

### 4.0.5
- **[New]** Filter to control stemmer locale `searchwp\stemmer\locale`
- **[Improvement]** Token stems/partial matches are considered during `AND` logic pass
- **[Fix]** String not sent to `searchwp\stemmer\custom`
- **[Change]** `searchwp\query\partial_matches\buoy` is now opt-in

### 4.0.4
- **[Fix]** Issue where `AND` logic would not apply in some cases
- **[Fix]** Issue where additional unnecessary query clauses are added in some cases
- **[Fix]** Issue with delta updates not processing when HTTP Basic Auth is active
- **[Fix]** Minimum PHP version requirement check (which is 7.2)

### 4.0.3
- **[Fix]** Issue where tokens table was not reset during index rebuild

### 4.0.2
- **[New]** Support for `BETWEEN`, `NOT BETWEEN`, `LIKE`, and `NOT LIKE` compare operators for `Mod` `WHERE` clauses
- **[Fix]** Handling of `Mod` `WHERE` clauses in some cases
- **[Fix]** Handling of REST parameters when returning search results

### 4.0.1
- **[New]** Check for remnants of SearchWP 3 that were not removed as per the Migration Guide
- **[New]** `searchwp\source\post\attributes\comments` action when retrieving Post comments
- **[Fix]** Handling of empty search strings in some cases

### 4.0.0
- **[New]** Complete rewrite of SearchWP