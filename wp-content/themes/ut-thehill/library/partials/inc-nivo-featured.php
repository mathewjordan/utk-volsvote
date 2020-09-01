<section class="flexible-content main-slider">
	    <?php // loop through the rows of data only once to check the first row
	    while ( have_rows('custom_acf_layout')) : the_row(); ?>

		    <?php if( (get_row_layout() == 'nivo_slider_gallery') && $n == 0 ): ?>
		    	
						<div class="slider-wrapper theme-light full-width">
							<figure id="mainslider" class="nivoSlider">
								<?php while(has_sub_field('nivo_slider_gallery')):
									$fullimage    = wp_get_attachment_image_src(get_sub_field('image'), 'full');
									$alt          = get_post_meta(get_sub_field('image'), '_wp_attachment_image_alt', true); 
									$thumb        = wp_get_attachment_image_src(get_sub_field('image'), 'thumbnail');
									$nivo_caption = get_sub_field('caption');
									$nivo_link    = get_sub_field('link'); ?>
							        	
								  <a <?php if(isset($nivo_link) && $nivo_link != '') { echo "href='".$nivo_link."'"; } ?>><img src="<?php echo $fullimage[0]; ?>" alt="<?php echo $alt; ?>" rel="<?php echo $thumb[0]; ?>" title="<?php echo $nivo_caption;?>" /></a>
								<?php endwhile; ?>
							</figure>
						</div>											        	
				<?php elseif ( has_post_thumbnail() && ! post_password_required() && $n == 0 ) : ?>
					<div class="entry-thumbnail">
						<?php the_post_thumbnail("large"); ?>
					</div>
				<?php endif;
				$n++;
				$sliderExists = true;
			endwhile ?>
</section>