<?php 

/*
Plugin Name: CB News Ticker
Plugin URI: http://www.codingbank.com/plugins/cb-news-ticker
Author: Md Abul Bashar
Author URI: https://www.codingbank.com
Version: 1.1
Description: Display popular post using shortcode [cb-news-ticker]

*/
// Don't call the file directly
if ( !defined( 'ABSPATH' ) ) exit;

//define url
define('CB_NEWS_TICKER_URL', plugin_dir_url( __FILE__ ));
define('CB_NEWS_TICKER_PATH', plugin_dir_path(__FILE__));



function cb_news_ticker_enqueue() {

	wp_enqueue_style( 'cb-news-ticker', CB_NEWS_TICKER_URL.'css/style.css');
	wp_enqueue_style( 'cb-news-ticker-responsive', CB_NEWS_TICKER_URL.'css/responsive.css');

	wp_enqueue_script( 'cookie', CB_NEWS_TICKER_URL. 'js/cookie/js.cookie.min.js', array('jquery'), 3.0, true );

	wp_enqueue_script( 'cb-news-ticker-cookie', CB_NEWS_TICKER_URL.'js/cookie/cookie-custom.js', array('jquery'), 3.0, true );
	
}
add_action('wp_enqueue_scripts', 'cb_news_ticker_enqueue');


// ADD NEW COLUMN
function cb_news_ticker_columns_head($defaults) {
    $defaults['cb_post_id'] = 'Post ID';
    return $defaults;
}
// show value in the new column
function cb_news_ticker_columns_content($column_name, $post_ID) {
    if ($column_name == 'cb_post_id') {
        echo '<strong>'.get_the_ID().'</strong>';
    }
}
add_filter('manage_posts_columns', 'cb_news_ticker_columns_head');
add_action('manage_posts_custom_column', 'cb_news_ticker_columns_content', 10, 2);


//Basic Setting
function cb_news_ticker_basic_settings() {

	load_plugin_textdomain( 'CBNT', false, CB_NEWS_TICKER_PATH .'lang' );

}
add_action('after_setup_theme', 'cb_news_ticker_basic_settings');

//Include additional file
require_once( CB_NEWS_TICKER_PATH . 'inc/shortcode.php' );
require_once( CB_NEWS_TICKER_PATH . 'inc/admin-panel.php' );