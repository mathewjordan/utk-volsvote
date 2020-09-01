<?php
function generateJson() {
	// Because we will have multiple sites running the same theme, we need to identify each json object separately
	global $blog_id;
	$siteId = $blog_id;
	// Setup an empty array to hold the json when looped
	$contentArray = array();
	//Setup Query args
	$contentArgs = array(
		'post_type'      => 'any',
		'posts_per_page' => -1,
		'orderby'        => array('parent', 'title'),
		'order'          => 'ASC',
	);
	$queryAllContent = new WP_Query($contentArgs);
	if($queryAllContent->have_posts()) {
		while($queryAllContent->have_posts()) {
			$queryAllContent->the_post();
			$title   = get_the_title();
			$content = get_the_content();
			$link    = get_the_permalink();
			$content = $title." ".$content;
			$content = str_replace("&nbsp;", " ", $content);
			$content = html_entity_decode($content);
			$content = strip_tags($content);
			$content = preg_replace('/[\r\n]+/', " ", $content);
			$content = preg_replace('/[ \t]+/', " ", $content);
			$content = preg_replace("/[^a-z0-9\-!@#$%^&*()_+=.,?]/i", " ", $content);
			$contentArray[] = array('title' => $title, 'content' => $content, 'link' => $link);
		}
	}
	// print_r($contentArray);die;

	// $dir = get_template_directory().'/library/json';
	// if ( !file_exists($dir) ) {
	// 	mkdir ($dir, 0744);
	// }
	// if($siteId) {
	// 	file_put_contents ($dir.'/'.$siteId.'-supersearch.json', json_encode($contentArray));
	// } else {
	// 	file_put_contents ($dir.'/supersearch.json', json_encode($contentArray));
	// }

	return $contentArray;
}