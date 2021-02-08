<?php 
// Don't call the file directly
if ( !defined( 'ABSPATH' ) ) exit;


// Register Shortcode
function cb_news_ticker($attrs, $content = NULL) {
	ob_start();
	extract(shortcode_atts(array(
		'post_type'		=> 'post',
		'count'			=> '',
		'id'			=> '',
		'bg_color'		=> '',
		'color'			=> '',
		'bn_text'		=> __('Breaking News', 'CBNT'),
		'bn_bg'			=> '',
		'bn_color'		=> '',
		'button'		=> '',
		'design'		=> '',
		'cat_slug'		=> '',
		'type'			=> '',
		'custom_text'	=> '',
	), $attrs));


		//getting value from dashboard
		$cbnt_text_color = get_option('cb-news-ticker-news-text-color'); // text color
		$bn_txt_color = get_option('cb-news-ticker-bn-text-color'); // text color
		$cbnt_bg_color_val = get_option('cb-news-ticker-news-bg-color'); // background color
		$bn_bg_color_val = get_option('cb-news-ticker-bn-bg-color'); // breaking background color
		$cb_news_id_val = get_option('cb-news-ticker-post-id'); // post id
		$cb_news_count = get_option('cb-news-ticker-post-count');// post count
		$cb_news_breaking = get_option('cb-news-ticker-bn-text'); // Breaking News Static Text
		$close_button = get_option('cb-news-ticker-close-button'); // on/off cross button
		$ticker_design = get_option('cb-news-ticker-design'); // selected design
		$category_name = get_option('cb-news-ticker-post-cat'); // category name
		$data_type = get_option('cb-news-ticker-ts-button'); // type like post or custom data
		$custom_txt = get_option('cb-news-ticker-custom-text'); // custom text

		// check user shortcode value for else working default value
		$text_color = $color ? $color : $cbnt_text_color; // text color
		$bn_color = $bn_color ? $bn_color : $bn_txt_color; // text color
		$bg_color = $bg_color ? $bg_color : $cbnt_bg_color_val; // background color
		$bn_bg_color = $bn_bg ? $bn_bg : $bn_bg_color_val; // background color
		$id = $id ? $id : $cb_news_id_val; // post id
		$count = $count ? $count : $cb_news_count; // post count
		$bn_text = $bn_text ? $bn_text : $cb_news_breaking; // breaking news text
		$button = $button ? $button : $close_button; // cross button on/off
		$design = $design ? $design : $ticker_design; // change design
		$cat_slug = $cat_slug ? $cat_slug : $category_name;
		$type = $type ? $type : $data_type; // data type switch like post or custom text
		$custom_text = $custom_text ? $custom_text : $custom_txt; // custom text


		$button = $button ? $button : 1; // set default value for showing cross button
	?>

	<!-- Suga Breaking News Ticker-->
	<section class="cb-news-ticker-breaking-news-ticker-area clearfix" <?php if(!empty($bg_color)) : ?> style="background-color:<?php echo esc_attr($bg_color); ?>" <?php endif; ?> >
	    <div class="cb-news-ticker-breaking-news-ticker clearfix">
            <div class="cb-news-ticker-left">
                <div class="cb-news-ticker-breaking-news">
                    <div class="cb-news-ticker-breaking-news-heading" <?php if(!empty($bn_bg_color)) : ?>  style="background-color:<?php echo esc_attr($bn_bg_color); endif;?>">
                        <strong <?php if(!empty($bn_color)) : ?> style="color:<?php echo esc_attr($bn_color); ?>" <?php endif; ?>><?php echo esc_html($bn_text); ?></strong>
                    </div>
                    <div class="cb-news-ticker-breaking-news-content">
                    	<div class="cb-news-ticker-marquee"> 

                    		<?php if($design == 'Marquee') : ?> 
							<marquee class="cb-news-ticker-marquee" onmouseover="this.stop();" onmouseout="this.start();">
							<?php endif; ?>
								<ul>
									<?php 
										if($type == 1) : // post data type condition

				                            $cb_news_ticker = new WP_Query(array(
				                                'post_type'     	=> $post_type,
				                                'posts_per_page' 	=> $count, 
				                                'post__in'       			=> array($id),
				                               // 'category_name'		=> $cat_slug,
				                            ));
				                            if($cb_news_ticker->have_posts()) : while($cb_news_ticker->have_posts()) : $cb_news_ticker->the_post();
				                        ?>
				                                              

				                        	<li><a href="<?php the_permalink(); ?>" <?php if(!empty($text_color)) : ?> style="color:<?php echo esc_attr($text_color); ?> !important;" <?php endif; ?>><?php the_title(); ?></a></li>
				                        
				                        <?php endwhile; endif; 
			                    	endif; 

			                    	// custom text condition
			                    	if($type == 2) :

			                    	?>

			                    		<li><a <?php if(!empty($text_color)) : ?> style="color:<?php echo esc_attr($text_color); ?>" <?php endif; ?>><?php echo esc_html($custom_text); ?></a></li>

			                    	<?php endif; ?>

								</ul>
							<?php if($design == 'Marquee') : ?> 
							</marquee>
							<?php endif; ?>

						</div>
                    </div>
                </div>
            </div>
         
            <?php if($button == 1) : ?>
	            <div class="cb-news-ticker-right">
	                <div class="cb-news-ticker-breaking-news-close">
	                    <span <?php if(!empty($text_color)) : ?> style="color:<?php echo esc_attr($text_color); ?>" <?php endif; ?>>X</span>
	                </div>
	            </div>
        	<?php endif; ?>
	    </div>
	</section><!--/ Breaking News Ticker -->


	<?php 

	return ob_get_clean();

}

add_shortcode('cb-news-ticker', 'cb_news_ticker');