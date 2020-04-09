<?php 
// Don't call the file directly
if ( !defined( 'ABSPATH' ) ) exit;


// Register Shortcode
function cb_news_ticker($attrs, $content = NULL) {
	ob_start();
	extract(shortcode_atts(array(
		'post_type'		=> 'post',
		'count'			=> 1,
		'id'			=> '',
		'bg_color'		=> '',
		'color'			=> '',
		'bn_text'		=> __('Breaking News', 'CBNT'),
		'button'		=> '',
		'design'		=> '',
		'cat_slug'		=> '',
	), $attrs));


		//getting value from dashboard
		$cbnt_text_color = get_option('cb-news-ticker-news-text-color'); // text color
		$cbnt_bg_color_val = get_option('cb-news-ticker-news-bg-color'); // background color
		$cb_news_id_val = get_option('cb-news-ticker-post-id'); // post id
		$cb_news_count = get_option('cb-news-ticker-post-count');// post count
		$cb_news_breaking = get_option('cb-news-ticker-bn-text'); // Breaking News Static Text
		$close_button = get_option('cb-news-ticker-close-button'); // on/off cross button
		$ticker_design = get_option('cb-news-ticker-design'); // selected design

		// check user shortcode value for else working default value
		$text_color = $color ? $color : $cbnt_text_color; // text color
		$bg_color = $bg_color ? $bg_color : $cbnt_bg_color_val; // background color
		$id = $id ? $id : $cb_news_id_val; // post id
		$count = $count ? $count : $cb_news_count; // post count
		$bn_text = $bn_text ? $bn_text : $cb_news_breaking; // breaking news text
		$button = $button ? $button : $close_button; // cross button on/off
		$design = $design ? $design : $ticker_design; // change design


		$button = $button ? $button : 1; // set default value for showing cross button
	?>

	<!-- Suga Breaking News Ticker-->
	<section class="cb-news-ticker-breaking-news-ticker-area clearfix" <?php if(!empty($bg_color)) : ?> style="background-color:<?php echo esc_attr($bg_color); ?>" <?php endif; ?> >
	    <div class="cb-news-ticker-breaking-news-ticker clearfix">
            <div class="cb-news-ticker-left">
                <div class="cb-news-ticker-breaking-news">
                    <div class="cb-news-ticker-breaking-news-heading">
                        <strong <?php if(!empty($text_color)) : ?> style="color:<?php echo esc_attr($text_color); ?>" <?php endif; ?>><?php echo esc_html($bn_text); ?></strong>
                    </div>
                    <div class="cb-news-ticker-breaking-news-content">
                    	<div class="cb-news-ticker-marquee"> 

                    		<?php if($design == 'Marquee') : ?> 
							<marquee class="cb-news-ticker-marquee" onmouseover="this.stop();" onmouseout="this.start();">
							<?php endif; ?>
								<ul>
			                        <?php                                 
			                            $cb_news_ticker = new WP_Query(array(
			                                'post_type'     	=> $post_type,
			                                'posts_per_page' 	=> $count, 
			                                'p'       			=> $id,
			                                'category_name'		=> $cat_slug,
			                            ));
			                            if($cb_news_ticker->have_posts()) : while($cb_news_ticker->have_posts()) : $cb_news_ticker->the_post();
			                        ?>
			                                              

			                        	<li><a href="<?php the_permalink(); ?>" <?php if(!empty($text_color)) : ?> style="color:<?php echo esc_attr($text_color); ?>" <?php endif; ?>><?php the_title(); ?></a></li>
			                        
			                        <?php endwhile; endif; ?>
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
	</section><!--/ Suga Breaking News Ticker -->


	<?php 

	return ob_get_clean();

}

add_shortcode('cb-news-ticker', 'cb_news_ticker');