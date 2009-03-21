<?php
	/**
	 * Tidypics: Edit the properties of multiple images 
	 * 
	 */

	include_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

	gatekeeper();
	set_context('photos');
	$file_string = get_input('files');
	$file_array_sent = explode('-', $file_string);
	$new_file_array = array();
	
	foreach($file_array_sent as $file_guid){
		if ($entity = get_entity($file_guid)){
			if($entity->canEdit()){
				array_push($new_file_array, $file_guid);
			}
			if(!$album_guid) $album_guid = $entity->container_guid;
			
		}
	}
		
	$area2 .= elgg_view_title($title = elgg_echo('image:edit'));
    $area2 .= elgg_view("tidypics/forms/edit_multi", array('file_array' => $new_file_array, 'album_guid' => $album_guid));
	$body = elgg_view_layout('two_column_left_sidebar', $area1, $area2);
	page_draw(elgg_echo("edit"), $body);
?>