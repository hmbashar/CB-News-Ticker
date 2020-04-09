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
	), $attrs));

	?>

	<!-- Suga Breaking News Ticker-->
	<section class="cb-news-ticker-breaking-news-ticker-area clearfix" <?php if(!empty($bg_color)) : ?> style="background-color:<?php echo esc_attr($bg_color); ?>" <?php endif; ?> >
	    <div class="cb-news-ticker-breaking-news-ticker clearfix">
            <div class="cb-news-ticker-left">
                <div class="cb-news-ticker-breaking-news">
                    <div class="cb-news-ticker-breaking-news-heading">
                        <strong <?php if(!empty($color)) : ?> style="color:<?php echo esc_attr($color); ?>" <?php endif; ?>><?php echo esc_html($bn_text); ?></strong>
                    </div>
                    <div class="cb-news-ticker-breaking-news-content">

                        <?php                                 
                            $cb_news_ticker = new WP_Query(array(
                                'post_type'     => $post_type,
                                'posts_per_page' => $count, 
                                'p'       => $id,
                            ));
                            if($cb_news_ticker->have_posts()) : while($cb_news_ticker->have_posts()) : $cb_news_ticker->the_post();
                        ?>
                      
                        <marquee class="cb-news-ticker-marquee" onmouseover="this.stop();" onmouseout="this.start();"><ul>
                        	<li><a href="" <?php if(!emtpy($color)) : ?> style="color:<?php echo esc_attr($color); ?>" <?php endif; ?>>Heading One</a></li>
                        	<li><a href="">Heading Two</a></li>
                        	<li><a href="">Heading Three</a></li>
                        </ul></marquee>
                        <?php endwhile; endif; ?>

                    </div>
                </div>
            </div>
            <div class="cb-news-ticker-right">
                <div class="cb-news-ticker-breaking-news-close">
                    <span <?php if(!empty($suga_option['bk_header_news_ticker_close'])) : ?> style="color:<?php echo esc_attr($suga_option['bk_header_news_ticker_close']); ?>" <?php endif; ?>>X</span>
                </div>
            </div>
	    </div>
	</section><!--/ Suga Breaking News Ticker -->


	<?php 

	return ob_get_clean();

}

add_shortcode('cb-news-ticker', 'cb_news_ticker');