<?php
/*
 Plugin Name:  PSVideo
 Description:  Shows video at your page
 Version:      1.0
 Author:       Serj.by
 Author URI:   http://serj.by
 License:      GPL2
 License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 */
 
const SUBST_REGEXP = '/#PSVideo(\s+id=([\w\-_]{1,11}))?#/';

const DEFAULT_ID = "jofNR_WkoCE";

const HTML_CONTENT = '<iframe width="560" height="315" src="https://www.youtube.com/embed/%s" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';

function createEmbedHTML ($matches) {
	$id = DEFAULT_ID;
	if (sizeof ($matches) == 3) {
		$id = $matches[2];
	};
	return sprintf (HTML_CONTENT, $id);
}

function PSVideoContentFilter ($content)
{
	global $subst, $htmlContent;
	$content = preg_replace_callback (SUBST_REGEXP, "createEmbedHTML", $content);
	return $content;
}
add_filter('the_content','PSVideoContentFilter');