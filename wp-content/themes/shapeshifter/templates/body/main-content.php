<?php
# Action Hook "shapeshifter_main_content"
# Filter Hook "shapeshifter_filters_main_content"
/*if ( SHAPESHIFTER_IS_404 ) {

} else*/if ( SHAPESHIFTER_IS_HOME && SHAPESHIFTER_IS_FRONT_PAGE ) {
	shapeshifter_main_content_archive_page();
} elseif ( SHAPESHIFTER_IS_FRONT_PAGE ) {
	shapeshifter_main_content_singular_page();
} elseif ( SHAPESHIFTER_IS_HOME ) { 
	shapeshifter_main_content_home();
} elseif ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) { // WooCommerce
	shapeshifter_main_content_woocommerce_page();
	} elseif ( function_exists( 'is_woocommerce' ) && is_cart() ) {
	shapeshifter_main_content_woocommerce_page();
	} elseif ( function_exists( 'is_woocommerce' ) && is_checkout() ) {
	shapeshifter_main_content_woocommerce_page();
	} elseif ( function_exists( 'is_woocommerce' ) && is_account_page() ) {
	shapeshifter_main_content_woocommerce_page();
} elseif ( function_exists( 'is_bbpress' ) && is_bbpress() ) { // bbPress
	if ( bbp_is_forum_archive() 
	|| bbp_is_topic_archive() ) { // Archive
		shapeshifter_main_content_bbpress_page();
	} elseif ( bbp_is_topic_tag() 
	|| bbp_is_topic_tag_edit() ) { // Topic Tags
		shapeshifter_main_content_bbpress_page();
	} elseif ( bbp_is_single_forum() 
	|| bbp_is_single_topic() 
	|| bbp_is_single_reply()
	|| bbp_is_topic_edit()
	|| bbp_is_topic_merge() 
	|| bbp_is_topic_split()
	|| bbp_is_reply_edit() 
	|| bbp_is_reply_move() 
	|| bbp_is_single_view() ) { // Components
		shapeshifter_main_content_bbpress_page();
	} elseif ( bbp_is_single_user_edit()
	|| bbp_is_single_user()
	|| bbp_is_user_home()
	|| bbp_is_user_home_edit()
	|| bbp_is_topics_created()
	|| bbp_is_replies_created()
	|| bbp_is_favorites()
	|| bbp_is_subscriptions() ) { // User
		shapeshifter_main_content_bbpress_page();
	} elseif ( bbp_is_search()
	|| bbp_is_search_results() ) { // Search
		shapeshifter_main_content_bbpress_page();
	}
} elseif ( SHAPESHIFTER_IS_ARCHIVE || SHAPESHIFTER_IS_SEARCH ) {
	shapeshifter_main_content_archive_page();
} elseif ( SHAPESHIFTER_IS_SINGULAR ) {
	shapeshifter_main_content_singular_page();
} else {
	echo '<h3><i class="fa fa-info"></i>&nbsp' . esc_html__( 'The Required Page doesn\'t exist.', 'shapeshifter' ) . '</h3><p>' . esc_html__( 'Please try to search for the page with keywords.', 'shapeshifter' ) . '</p>';

	get_search_form();

}
