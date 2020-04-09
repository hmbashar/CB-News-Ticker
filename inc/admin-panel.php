<?php

// Don't call the file directly
if ( !defined( 'ABSPATH' ) ) exit;



function cb_news_ticker_fields_register() {
	// Add Section
	add_settings_section( 'cb_news_ticker_section', __('Setting for CB News Ticker', 'CBNT'), 'cb_news_ticker_section_desc', 'cb_news_ticker.php' );
	
	// Add Field
	add_settings_field( 'cb-news-ticker-news-text-color', __('News Text Color', 'CBNT'), 'cb_news_ticker_news_text_color', 'cb_news_ticker.php', 'cb_news_ticker_section' );
	
	// Add Field for post id
	add_settings_field( 'cb-news-ticker-post-id', __('Post ID', 'CBNT'), 'cb_news_ticker_post_id', 'cb_news_ticker.php', 'cb_news_ticker_section' );
	
	// Add Field for post count
	add_settings_field( 'cb-news-ticker-post-count', __('Count', 'CBNT'), 'cb_news_ticker_post_count', 'cb_news_ticker.php', 'cb_news_ticker_section' );

	// Register field
	register_setting( 'cb_news_ticker_section', 'cb-news-ticker-news-text-color', array('sanitize_callback' => 'esc_attr') );
	register_setting( 'cb_news_ticker_section', 'cb-news-ticker-post-id', array('sanitize_callback' => 'esc_attr') );
	register_setting( 'cb_news_ticker_section', 'cb-news-ticker-post-count', array('sanitize_callback' => 'esc_attr') );
}
add_action('admin_init', 'cb_news_ticker_fields_register');


//Section description
function cb_news_ticker_section_desc() {
	printf('%s You can use the news ticker anywhere, just use the shortcode [cb-news-ticker], and you can manage the ticker color from here %s', '<p>', '</p>');
}

// News Text Color Field
function cb_news_ticker_news_text_color() {
	$cbnt_text_color = get_option('cb-news-ticker-news-text-color');
	$cbnt_text_id = 'cb-news-ticker-news-text-color';	

	printf("<input type='text' id='%s' name='%s' class='regular-text'  value='%s' placeholder='Input your color code/name'>", $cbnt_text_id, $cbnt_text_id, $cbnt_text_color);
}


// News Ticker Post ID field
function cb_news_ticker_post_id() {
	$cb_news_id = get_option('cb-news-ticker-post-id');
	$cbnt_post_id = 'cb-news-ticker-post-id';	

	printf("<input type='text' id='%s' name='%s' class='regular-text'  value='%s' placeholder='News ID'>", $cbnt_post_id, $cbnt_post_id, $cb_news_id);
	printf('%s Please input your post id here, you can find your post id from your all post option, check the screenshot https://prnt.sc/rwbf8l %s', '<p class="description">', '</p>');
	
}




// News Ticker Post ID count
function cb_news_ticker_post_count() {
	$cb_news_count = get_option('cb-news-ticker-post-count');
	$cbnt_post_count = 'cb-news-ticker-post-count';	

	printf("<input type='text' id='%s' name='%s' class='regular-text'  value='%s' placeholder='Count'>", $cbnt_post_count, $cbnt_post_count, $cb_news_count);
	printf('%s Please input numeric, how much post will be show in the news ticker, default value 1 %s', '<p class="description">', '</p>');
	
}



//Admin Panel Menu callback
function cb_news_ticker_section_callback() {
	
?>
	<form action="options.php" method="POST">
		<?php do_settings_sections('cb_news_ticker.php');?>
		<?php settings_fields('cb_news_ticker_section');?>
		<?php submit_button();?>
	</form>
<?php 


}


// CB News Ticker Admin Panel Menu
function cb_news_ticker_admin_panel() {
	// add sub menu page
	add_submenu_page( 'options-general.php', __('CB News Ticker', 'CBNT'), __('CB News Ticker', 'CBNT'), 'manage_options', 'cb_news_ticker.php', 'cb_news_ticker_section_callback' );


}
add_action('admin_menu', 'cb_news_ticker_admin_panel');
