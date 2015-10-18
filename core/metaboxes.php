<?php

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function shoelace_add_meta_box() {

	$screens = array( 'post', 'page' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'shoelace_sectionid',
			__( 'Shoelace Settings', 'shoelace' ),
			'shoelace_meta_box_callback',
			$screen
		);
	}
}
add_action( 'add_meta_boxes', 'shoelace_add_meta_box' );

/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
function shoelace_meta_box_callback( $post ) {

	// Add a nonce field so we can check for it later.
	wp_nonce_field( 'shoelace_save_meta_box_data', 'shoelace_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, '_my_meta_value_key', true ); ?>

	<table class="form-table">

				<tbody><tr>
					<th scope="row">Snippet Preview<img src="http://localhost:8888/testing-wp/wp-content/plugins/wordpress-seo/images/question-mark.png" class="alignright yoast_help" id="snippetpreviewhelp" alt="This is a rendering of what this post might look like in Google's search results.&lt;br/&gt;&lt;br/&gt;Read &lt;a href=&quot;https://yoast.com/snippet-preview/#utm_source=wordpress-seo-metabox&amp;utm_medium=inline-help&amp;utm_campaign=snippet-preview&quot;&gt;this post&lt;/a&gt; for more info." data-hasqtip="0"></th>
					<td><div id="wpseosnippet">
<a class="title" id="wpseosnippet_title" href="#">A post with a gallery  - Shoelace</a>
<span class="url">localhost:8888/testing-wp/</span>
<p class="desc"><span class="autogen"> This one has a caption&nbsp;&nbsp;</span><span class="content"></span></p>
</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="yoast_wpseo_focuskw">Focus Keyword:</label><img src="http://localhost:8888/testing-wp/wp-content/plugins/wordpress-seo/images/question-mark.png" class="alignright yoast_help" id="focuskwhelp" alt="Pick the main keyword or keyphrase that this post/page is about.&lt;br/&gt;&lt;br/&gt;Read &lt;a href=&quot;https://yoast.com/focus-keyword/#utm_source=wordpress-seo-metabox&amp;utm_medium=inline-help&amp;utm_campaign=focus-keyword&quot;&gt;this post&lt;/a&gt; for more info." data-hasqtip="1"></th>
					<td><input type="text" id="yoast_wpseo_focuskw" autocomplete="off" name="yoast_wpseo_focuskw" value="" class="large-text"><br><div><div id="focuskwresults"></div></div>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="yoast_wpseo_title">SEO Title:</label><img src="http://localhost:8888/testing-wp/wp-content/plugins/wordpress-seo/images/question-mark.png" class="alignright yoast_help" id="titlehelp" alt="The SEO title defaults to what is generated based on this sites title template for this posttype." data-hasqtip="2"></th>
					<td><input type="text" id="yoast_wpseo_title" name="yoast_wpseo_title" value="" class="large-text" placeholder="A post with a gallery  - Shoelace"><br><div><p id="yoast_wpseo_title-length-warning" style="display: none;"><span class="wrong">Warning:</span> Title display in Google is limited to a fixed width, yours is too long.</p></div>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="yoast_wpseo_metadesc">Meta description:</label><img src="http://localhost:8888/testing-wp/wp-content/plugins/wordpress-seo/images/question-mark.png" class="alignright yoast_help" id="metadeschelp" alt="The meta description is often shown as the black text under the title in a search result. For this to work it has to contain the keyword that was searched for.&lt;br/&gt;&lt;br/&gt;Read &lt;a href=&quot;https://yoast.com/snippet-preview/#utm_source=wordpress-seo-metabox&amp;utm_medium=inline-help&amp;utm_campaign=focus-keyword&quot;&gt;this post&lt;/a&gt; for more info." data-hasqtip="3"></th>
					<td><textarea class="large-text metadesc" rows="2" id="yoast_wpseo_metadesc" name="yoast_wpseo_metadesc"></textarea><div>The <code>meta</code> description will be limited to 156 chars, <span id="yoast_wpseo_metadesc-length"></span> chars left. <div id="yoast_wpseo_metadesc_notice"></div></div>
					</td>
				</tr>			</tbody></table>

	<?php echo '<label for="shoelace_new_field">';
	_e( 'Description for this field', 'shoelace' );
	echo '</label> ';
	echo '<input type="text" id="shoelace_new_field" name="shoelace_new_field" value="' . esc_attr( $value ) . '" size="25" />';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function shoelace_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['shoelace_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['shoelace_meta_box_nonce'], 'shoelace_save_meta_box_data' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */

	// Make sure that it is set.
	if ( ! isset( $_POST['shoelace_new_field'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['shoelace_new_field'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_my_meta_value_key', $my_data );
}
add_action( 'save_post', 'shoelace_save_meta_box_data' );