
		            <div class="entry-content acf">
									<?php

										// check if the flexible content field has rows of data
										if(have_rows('custom_acf_layout') ):
					
												echo '<section class="flexible-content">';
										     // loop through the rows of data
												$i = 0;
										    while ( have_rows('custom_acf_layout') ) : the_row();

														// ***************
														// TEXT COLUMNS
														// ***************
															

												      if( get_row_layout() == 'text' ):
															$text_title = get_sub_field('title');
															$columns = get_sub_field('columns');
															
															if ($columns == '2')
															{
												        		echo '<br class="clear"><section class="text">';
												        		if ($text_title != "") {
							  					        		echo '<h2 class="mod-text-title">'.$text_title.'</h2>';
												        		}
							                      echo '<div class="half">';
												        		the_sub_field('text');
												        		echo '</div><div class="half">';
							                      the_sub_field('text_2');
												        		echo '</div></section><br class="clear">';
															}	
															else {
																echo '<section class="text">';
																		if ($text_title != "") {
							  					        		echo '<h2 class="mod-text-title">'.$text_title.'</h2>';
												        		}
												        		the_sub_field('text');
												        		echo '</section><br class="clear">';
															}
																
															echo '<br class="clear">';
												        endif;
												        
												        
												        
														// ***************
														// QUOTE
														// ***************
															
																				        
												        if( get_row_layout() == 'quote' ): 
															echo '<blockquote class="quote">';
												        		the_sub_field('quote');
															echo '<div class="quote-author">';
																the_sub_field('name');
															echo '</div></blockquote><br class="clear">';
												
												        endif;


														// ***************
														// IMAGES
														// ***************
															

														if( get_row_layout() == 'image' ): 
															$image_title = get_sub_field('title');
												        	$image_url = get_sub_field('image');
												        	$image_caption = get_sub_field('caption');
												        	
												        	
												        		if ($image_title != "") {
							  					        		echo '<h2 class="mod-image-title">'.$image_title.'</h2>';
												        		}
												        	echo '<figure class="image">
												        			<img src="'.$image_url.'" class="frame" />';
												        		if ($image_caption != "") {
							  					        		echo '<p>'.$image_caption.'</p>';
												        		}
															echo '</figure><br class="clear">';
												        	
												        	
												
												        endif;


														// ***************
														// NIVO SLIDER
														// ***************
															
														// Check if we already used this one for the main gallery
										        if($i > 0) {
											        	
																if( get_row_layout() == 'nivo_slider_gallery' ): 
																	$nivo_title = get_sub_field('title');
														        	// $nivo_image = get_sub_field('nivo_slider_gallery');
														        	
														        	?>
														        	<h2><?php echo $nivo_title;?></h2>
														        	<div class="slider-wrapper theme-light"><figure id="slider" class="nivoSlider">
																		<?php while(has_sub_field('nivo_slider_gallery')):
																		
																			$fullimage = wp_get_attachment_image_src(get_sub_field('image'), 'full'); 
																			$thumb = wp_get_attachment_image_src(get_sub_field('image'), 'thumbnail');
																        	$nivo_caption = get_sub_field('caption');
																        	$nivo_link = get_sub_field('link'); ?>
																        	
																	    	<a href="<?php echo $nivo_link;?>"><img src="<?php echo $fullimage[0]; ?>" alt="<?php  the_sub_field('title');?>" rel="<?php echo $thumb[0]; ?>" title="<?php echo $nivo_caption;?>" /></a>
																	    <?php endwhile; ?>
																	</figure>	</div>											        	
														        	<?php
														        	
														
														        endif;
										        }



														// ***************
														// GALLERY
														// ***************
															

														if( get_row_layout() == 'gallery' ): 
															
												        	$gallery_title = get_sub_field('title');
												        	$gallery_caption = get_sub_field('caption');
												        	
												        	echo '<figure class="mod-gallery">';
											        		if ($gallery_title != "") {
							  					        	echo '<h2 class="mod-gallery-title">'.$gallery_title.'</h2>';
												        	}

													        	$images = get_sub_field('gallery');



							                      if( $images ): ?>
							                              <?php foreach( $images as $image ): ?>
							                                      <a href="<?php echo $image['url']; ?>"  data-toggle="lightbox" data-gallery="multiimages">
							                                           <img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" data-title="<?php echo $image['caption']; ?>" />
							                                      </a>
							                              <?php endforeach; ?>
							                      <?php endif; 
																																
																 
											        		if ($gallery_caption != "") {
							  					        	echo '<figcaption class="lightbox-gallery">'.$gallery_caption.'</figcaption>';
												        	}

												        	echo '</figure>';

							                    // echo '<br class="clear">';

												        endif;
												        $i++;
												    endwhile;
					
										echo '</section>'; // end flexible content 
					
									else :
					
								    // no layouts found
								    echo '<h2>Please create your layout. ACF needs to be activated.</h2>';
					
									endif;
									?>

									<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'utthehill' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
						</div><!-- .entry-content -->
