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
	), $attrs));

		$cbnt_text_color = get_option('cb-news-ticker-news-text-color');
		// check user shortcode value for else working default value
		$text_color = $color ? $color : $cbnt_text_color;
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
						<marquee class="cb-news-ticker-marquee" onmouseover="this.stop();" onmouseout="this.start();">
							<ul>
		                        <?php                                 
		                            $cb_news_ticker = new WP_Query(array(
		                                'post_type'     => $post_type,
		                                'posts_per_page' => $count, 
		                                'p'       		=> $id,
		                                'category_name'			=> 'asperiores-sed-et',
		                            ));
		                            if($cb_news_ticker->have_posts()) : while($cb_news_ticker->have_posts()) : $cb_news_ticker->the_post();
		                        ?>
		                                              

		                        	<li><a href="<?php the_permalink(); ?>" <?php if(!empty($text_color)) : ?> style="color:<?php echo esc_attr($text_color); ?>" <?php endif; ?>><?php the_title(); ?></a></li>
		                        
		                        <?php endwhile; endif; ?>
							</ul>
						</marquee>
                    </div>
                </div>
            </div>
            <div class="cb-news-ticker-right">
                <div class="cb-news-ticker-breaking-news-close">
                    <span <?php if(!empty($text_color)) : ?> style="color:<?php echo esc_attr($text_color); ?>" <?php endif; ?>>X</span>
                </div>
            </div>
	    </div>
	</section><!--/ Suga Breaking News Ticker -->


	<?php 

	return ob_get_clean();

}

add_shortcode('cb-news-ticker', 'cb_news_ticker');