<?php

// Don't call the file directly
if ( !defined( 'ABSPATH' ) ) exit;



function cb_news_ticker_fields_register() {
	// Add Section
	add_settings_section( 'cb_news_ticker_section', __('Setting for CB News Ticker', 'CBNT'), 'cb_news_ticker_section_desc', 'cb_news_ticker.php' );
	

	// Add Field for choose design
	add_settings_field( 'cb-news-ticker-design', __('Choose your Design', 'CBNT'), 'cb_news_ticker_design', 'cb_news_ticker.php', 'cb_news_ticker_section' );
	
	// Add Field for post or custom switch button
	add_settings_field( 'cb-news-ticker-ts-button', __('Type', 'CBNT'), 'cb_news_ticker_ts_button', 'cb_news_ticker.php', 'cb_news_ticker_section' );
	

	// Add Field for custom text
	add_settings_field( 'cb-news-ticker-custom-text', __('Custom', 'CBNT'), 'cb_news_ticker_custom_text', 'cb_news_ticker.php', 'cb_news_ticker_section' );	
	
	
	// Add Field for post id
	add_settings_field( 'cb-news-ticker-post-id', __('Post ID', 'CBNT'), 'cb_news_ticker_post_id', 'cb_news_ticker.php', 'cb_news_ticker_section' );
	
	// Add Field for post count
	add_settings_field( 'cb-news-ticker-post-count', __('Count', 'CBNT'), 'cb_news_ticker_post_count', 'cb_news_ticker.php', 'cb_news_ticker_section' );
	

	// Add Field for Breaking news text
	add_settings_field( 'cb-news-ticker-bn-text', __('Breaking News', 'CBNT'), 'cb_news_ticker_breaking_news', 'cb_news_ticker.php', 'cb_news_ticker_section' );
	

	// Add Field
	add_settings_field( 'cb-news-ticker-news-text-color', __('Text Color', 'CBNT'), 'cb_news_ticker_news_text_color', 'cb_news_ticker.php', 'cb_news_ticker_section' );
	// Add Field
	add_settings_field( 'cb-news-ticker-bn-text-color', __('BN Text Color', 'CBNT'), 'cb_news_ticker_bn_text_color', 'cb_news_ticker.php', 'cb_news_ticker_section' );
		
	// Add Field
	add_settings_field( 'cb-news-ticker-news-bg-color', __('Background Color', 'CBNT'), 'cb_news_ticker_news_bg_color', 'cb_news_ticker.php', 'cb_news_ticker_section' );

	// Add Field for breaking new background color
	add_settings_field( 'cb-news-ticker-bn-bg-color', __('BN Background Color', 'CBNT'), 'cb_news_ticker_bn_bg_color', 'cb_news_ticker.php', 'cb_news_ticker_section' );



	// Add Field for close button
	add_settings_field( 'cb-news-ticker-close-button', __('Switch Close Button', 'CBNT'), 'cb_news_ticker_close_button', 'cb_news_ticker.php', 'cb_news_ticker_section' );

	// Add Field for choose design
	//add_settings_field( 'cb-news-ticker-post-cat', __('Choose your Cat', 'CBNT'), 'cb_news_ticker_cat_slug', 'cb_news_ticker.php', 'cb_news_ticker_section' );

	// Register field
	register_setting( 'cb_news_ticker_section', 'cb-news-ticker-news-text-color', array('sanitize_callback' => 'esc_attr') );
	register_setting( 'cb_news_ticker_section', 'cb-news-ticker-bn-text-color', array('sanitize_callback' => 'esc_attr') );
	register_setting( 'cb_news_ticker_section', 'cb-news-ticker-news-bg-color', array('sanitize_callback' => 'esc_attr') );
	register_setting( 'cb_news_ticker_section', 'cb-news-ticker-bn-bg-color', array('sanitize_callback' => 'esc_attr') );
	register_setting( 'cb_news_ticker_section', 'cb-news-ticker-post-id', array('sanitize_callback' => 'esc_html') );
	register_setting( 'cb_news_ticker_section', 'cb-news-ticker-post-count', array('sanitize_callback' => 'esc_attr') );
	register_setting( 'cb_news_ticker_section', 'cb-news-ticker-bn-text', array('sanitize_callback' => 'esc_attr') );
	register_setting( 'cb_news_ticker_section', 'cb-news-ticker-custom-text', array('sanitize_callback' => 'esc_html') );
	register_setting( 'cb_news_ticker_section', 'cb-news-ticker-close-button', array('sanitize_callback' => 'esc_attr') );
	register_setting( 'cb_news_ticker_section', 'cb-news-ticker-ts-button', array('sanitize_callback' => 'esc_attr') );
	register_setting( 'cb_news_ticker_section', 'cb-news-ticker-design', array('sanitize_callback' => 'esc_attr') );
	//register_setting( 'cb_news_ticker_section', 'cb-news-ticker-post-cat', array('sanitize_callback' => 'esc_attr') );
}
add_action('admin_init', 'cb_news_ticker_fields_register');


//Section description
function cb_news_ticker_section_desc() {
	printf('%s You can use the news ticker anywhere, just use the shortcode [cb-news-ticker], and you can manage the ticker color from here %s', '<p>', '</p>');
}

// News Text Color Field
function cb_news_ticker_news_text_color() {
	$cbnt_text_color_val = get_option('cb-news-ticker-news-text-color');
	$cbnt_text_id = 'cb-news-ticker-news-text-color';	

	printf("<input type='text' id='%s' name='%s' class='regular-text'  value='%s' placeholder='Input your color code/name'>", $cbnt_text_id, $cbnt_text_id, $cbnt_text_color_val);

	printf('%s Please type your color name or color code with a # sign, it will apply to content text %s', '<p class="description">', '</p>');
}
// BN Text Color Field
function cb_news_ticker_bn_text_color() {
	$bn_text_color_val = get_option('cb-news-ticker-bn-text-color');
	$bn_text_id = 'cb-news-ticker-bn-text-color';	

	printf("<input type='text' id='%s' name='%s' class='regular-text'  value='%s' placeholder='Input your color code/name'>", $bn_text_id, $bn_text_id, $bn_text_color_val);

	printf('%s Please type your color name or color code with a # sign, it will apply to Heading/Alert text %s', '<p class="description">', '</p>');
}

// News Background Color Field
function cb_news_ticker_news_bg_color() {
	$cbnt_bg_color_val = get_option('cb-news-ticker-news-bg-color');
	$cbnt_bg_id = 'cb-news-ticker-news-bg-color';	

	printf("<input type='text' id='%s' name='%s' class='regular-text'  value='%s' placeholder='Input your color code/name'>", $cbnt_bg_id, $cbnt_bg_id, $cbnt_bg_color_val);

	printf('%s Please type your color name or color code with a # sign, it will apply to full width news ticker section %s', '<p class="description">', '</p>');
}

// News BN Background Color Field
function cb_news_ticker_bn_bg_color() {
	$bn_bg_color_val = get_option('cb-news-ticker-bn-bg-color');
	$bn_bg_id = 'cb-news-ticker-bn-bg-color';	

	printf("<input type='text' id='%s' name='%s' class='regular-text'  value='%s' placeholder='Input your color code/name'>", $bn_bg_id, $bn_bg_id, $bn_bg_color_val);


	printf('%s Please type your color name or color code with a # sign, it will apply to Heading/Alert text background %s', '<p class="description">', '</p>');
}


// News Ticker Post ID field
function cb_news_ticker_post_id() {
	$cb_news_id_val = get_option('cb-news-ticker-post-id');
	$cbnt_post_id = 'cb-news-ticker-post-id';	

	printf("<input type='text' id='%s' name='%s' class='regular-text'  value='%s' placeholder='News ID'>", $cbnt_post_id, $cbnt_post_id, $cb_news_id_val);

	printf('%s Please input your post id here, you can find your post id from your all post option, check the screenshot https://prnt.sc/rwbf8l <b>Important: only work if you select "Post" from the type field</b> %s', '<p class="description">', '</p>');
	
}




// News Ticker Post count
function cb_news_ticker_post_count() {
	$cb_news_count = get_option('cb-news-ticker-post-count');
	$cbnt_post_count = 'cb-news-ticker-post-count';	
	$count = $cb_news_count ? $cb_news_count : 1;

	printf("<input type='text' id='%s' name='%s' class='regular-text'  value='%s' placeholder='Count'>", $cbnt_post_count, $cbnt_post_count, $count);
	printf('%s Please input numeric, how much post will be show in the news ticker, default value 1 %s', '<p class="description">', '</p>');
	
}


// News Ticker breaking news
function cb_news_ticker_breaking_news() {
	$cb_news_breaking = get_option('cb-news-ticker-bn-text');
	$cbnt_post_breaking = 'cb-news-ticker-bn-text';	
	$breaking_news = $cb_news_breaking ? $cb_news_breaking : __('Breaking News', 'CBNT');

	printf("<input type='text' id='%s' name='%s' class='regular-text'  value='%s' placeholder='Breaking News Text'>", $cbnt_post_breaking, $cbnt_post_breaking, $breaking_news);

	printf('%s You can change the heading for breaking news static text, default Breaking News %s', '<p class="description">', '</p>');
	
}

// News Ticker custom text
function cb_news_ticker_custom_text() {
	$cb_custom_text = get_option('cb-news-ticker-custom-text');
	$cbnt_custom_text = 'cb-news-ticker-custom-text';	
	$custom_text = $cb_custom_text ? $cb_custom_text : __('Custom Text', 'CBNT');

	printf("<textarea id='%s' name='%s' class='regular-text' rows='10' class='large-text code' placeholder='Breaking News Text'> %s </textarea>", $cbnt_custom_text, $cbnt_custom_text, $custom_text);

	printf('%s Type your content here if you want to show the custom text to your ticker section, <b>Important: only work if you select "custom" from the type field</b> %s', '<p class="description">', '</p>');
	
}


// News Ticker switch close button
function cb_news_ticker_close_button() {
	$close_button = get_option('cb-news-ticker-close-button');
	$close_button_id = 'cb-news-ticker-close-button';	
	
	$close_button = $close_button ? $close_button : 1;
	$button_on = checked(1, $close_button, false);	
	$button_off = checked(2, $close_button, false);

	
	$button_on_switch = sprintf("<input type='radio' id='%s' name='%s' class='regular-text'  value='%s' %s>", 'cb-news-t-button-on', $close_button_id, 1, $button_on);	
	printf('%s %s Show %s %s', '<label for="cb-news-t-button-on">',$button_on_switch, '</label>', '<br>');

	
	$button_off_switch = sprintf("<input type='radio' id='%s' name='%s' class='regular-text'  value='%s' %s>",'cb-news-t-button-off', $close_button_id, 2, $button_off);	
	printf('%s %s Hide %s', '<label for="cb-news-t-button-off">',$button_off_switch, '</label>');
	printf('%s You can show/hide your breaking news closing button. %s', '<p class="description">', '</p>');
	
}

// News Ticker switch ticker or static button
function cb_news_ticker_ts_button() {
	$ts_button = get_option('cb-news-ticker-ts-button');
	$ts_button_id = 'cb-news-ticker-ts-button';	
	
	$ts_button = $ts_button ? $ts_button : 1;
	$button_on = checked(1, $ts_button, false);	
	$button_off = checked(2, $ts_button, false);

	
	$button_on_switch = sprintf("<input type='radio' id='%s' name='%s' class='regular-text'  value='%s' %s>", 'cb-news-ts-button-on', $ts_button_id, 1, $button_on);	
	printf('%s %s Post %s %s', '<label for="cb-news-ts-button-on">',$button_on_switch, '</label>', '<br>');

	
	$button_off_switch = sprintf("<input type='radio' id='%s' name='%s' class='regular-text'  value='%s' %s>",'cb-news-ts-button-off', $ts_button_id, 2, $button_off);	
	printf('%s %s Custom %s', '<label for="cb-news-ts-button-off">',$button_off_switch, '</label>');
	printf('%s You can choose what type of data would you like to show. %s', '<p class="description">', '</p>');
	
}


//Choose your design here (Dropdown)
function cb_news_ticker_design() {
	$options = get_option('cb-news-ticker-design');
	$items = array("Marquee", "Static");

	echo "<select id='cb-news-ticker-design' name='cb-news-ticker-design'>";
	foreach($items as $item) {
		$selected = ($options==$item) ? 'selected="selected"' : '';
		printf("<option value='%s' %s>%s</option>", $item, $selected, $item);		
	}
	echo "</select>";
}

//Choose your design here (Dropdown)
function cb_news_ticker_cat_slug() {
	$cat_slug = get_option('cb-news-ticker-post-cat');
	$items = get_categories();	
	
	echo "<select id='cb-news-ticker-post-cat' name='cb-news-ticker-post-cat'>";
	foreach($items as $item) {
		$selected = ($cat_slug==$item->slug) ? 'selected="selected"' : '';
		printf("<option value='%s' %s>%s</option>", $item->slug, $selected, $item->name);		
	}
	echo "</select>";
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
