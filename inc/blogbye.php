<?php

/* Remove posts & comments menu item */
function blogbye_remove_menus(){
  remove_menu_page( 'edit.php' );
  remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'blogbye_remove_menus' );

/* Remove post related general subpages */
function blogbye_remove_admin_submenus() {
  remove_submenu_page( 'options-general.php', 'options-discussion.php' );
  remove_submenu_page( 'options-general.php', 'options-writing.php' );
  remove_submenu_page( 'options-general.php', 'options-reading.php' );
  remove_submenu_page( 'options-general.php', 'options-permalink.php' );
}
add_action( 'admin_menu', 'blogbye_remove_admin_submenus', 999 );

/* Remove post related widgets */
function blogbye_remove_widgets() {
	unregister_widget( 'WP_Widget_Calendar' );
  unregister_widget( 'WP_Widget_Archives' );
  unregister_widget( 'WP_Widget_Categories' );
  unregister_widget( 'WP_Widget_Recent_Posts' );
  unregister_widget( 'WP_Widget_Recent_Comments' );
  unregister_widget( 'WP_Widget_RSS' );
  unregister_widget( 'WP_Widget_Meta' );
  unregister_widget( 'WP_Widget_Search' );
  unregister_widget( 'WP_Widget_Tag_Cloud' );
}
add_action( 'widgets_init', 'blogbye_remove_widgets' );

/* Remove post related admin bar links */
function blogbye_remove_post_link( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'new-post' );
  $wp_admin_bar->remove_node( 'comments' );
}
add_action( 'admin_bar_menu', 'blogbye_remove_post_link', 999 );

/* Remove post related dashboard widgets */
function blogbye_remove_dashboard_meta() {
  remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
  remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
  remove_meta_box( 'dashboard_activity', 'dashboard', 'side' );
  remove_meta_box( 'dashboard_right_now', 'dashboard', 'side' );
}
add_action( 'admin_init', 'blogbye_remove_dashboard_meta' );

/* Set permalinks to post name */
add_action( 'init', function() {
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure( '/%postname%/' );
} );

/* Set front page to page and set default comments to closed */
function blogbye_after_setup_theme() {
  update_option( 'show_on_front', 'page' );
  update_option( 'default_comment_status', 'closed' );
}
add_action( 'after_setup_theme', 'blogbye_after_setup_theme' );

/* Update customizer setting to only show page stuff */
function blogbye_remove_settings( $wp_customize ) {
  $wp_customize->remove_control( 'show_on_front' );
  $wp_customize->remove_control( 'page_for_posts' );
}
add_action( 'customize_register', 'blogbye_remove_settings' );

/* Remove post stuff from custom menus */
function blogbye_remove_nav_fields() {
  remove_meta_box( 'add-post-type-post', 'nav-menus', 'side' );
  remove_meta_box( 'add-category', 'nav-menus', 'side' );
}
add_action( 'admin_head-nav-menus.php' , 'blogbye_remove_nav_fields' );

?>
