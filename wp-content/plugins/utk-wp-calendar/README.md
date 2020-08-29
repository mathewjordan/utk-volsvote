# UT Event Calendar - WordPress Plugin

## Introduction
This plugin adds functionality to pull upcoming events by Department ID into your WordPress site. If Department ID is not set, all upcoming events will be available. Events are ordered by default ascending into the future.

## Requirements
Plugin has been tested in modern versions of WordPress 4.9.x and higher.

## Implementation

### Shortcode
Add the shortcode below to any post, page or widget to populate according to the set Calendar Options.

#### Basic Usage
#### `[utk_calendar]`

#### Shortcode Overrides
There might be cases where multiple shortcodes are required on one WP instance. In that case, attributes can be sent to override some set Calendar Options.

#### Examples

_Overrides ***Department ID***_.

`[utk_calendar id="17658"]`

_Overrides ***Heading***, ***Department ID*** and the number count of ***Events to List***._

`[utk_calendar heading="Sample Heading" id="14177" count="5"]`

### Gutenberg Support
If Gutenberg support is available, events can also be rendered from the Layout Elements section as a Gutenberg block.

**Note:** Overrides cannot be set from this method. However, you can render a shortcode via Gutenberg.

### Theme Styling
Theme styling options account for differences in font sizing and margin spacing between various themes. Select the best option for the theme you are currently running.

### Figure Rendering
The default representation of the date is text. An experimental mode is currently available in beta for SVG representation of dates in an orange block. 
