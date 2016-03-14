<?php
/**
 * Add Photo order fields to media uploader for the slilder
 *
 * @param $form_fields array, fields to include in attachment form
 * @param $post object, attachment record in database
 * @return $form_fields, modified form fields
 */
 
function attachment_order_field( $form_fields, $post ) {
	$value = get_post_meta( $post->ID, 'slider_order', true );
	$form_fields['slider_order'] = array(
		'label' => 'plaats in slider',
		'class'=> 'hide',
		'value' => get_post_meta( $post->ID, 'slider_order', true ),
		'helps' => 'Bepaal de plaats van de afbeelding in de slider',
		'input' => 'html',
		'html'  => "<input type='number'  name='attachments[$post->ID][slider_order]' id='attachments[$post->ID][slider_order]' value='$value' />"
	);


	return $form_fields;
}

add_filter( 'attachment_fields_to_edit', 'attachment_order_field', 1, 2 );

/**
 * Save values of Photographer Name and URL in media uploader
 *
 * @param $post array, the post data for database
 * @param $attachment array, attachment fields from $_POST form
 * @return $post array, modified post data
 */

function attachment_order_field_save( $post, $attachment ) {
	if( isset( $attachment['slider_order'] ) )
		update_post_meta( $post['ID'], 'slider_order', $attachment['slider_order'] );

	return $post;
}

add_filter( 'attachment_fields_to_save', 'attachment_order_field_save', 1, 2 );
