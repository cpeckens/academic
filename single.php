<?php get_header() ?>	
		
		
		<div id="container-mid">
			<div id="main">
				<div id="sidebar-left">
				
					<!--Subpage navigation - Current code needs to be tweaked to show appropriate pages -->
			<?php
				
							
					$parent = ksas_get_page_id('about');;
								
									
					$children = wp_list_pages("title_li=&child_of=". $parent ."&echo=0&depth=1");
									
					if ($children) { ?>
						<ul id="subnav">
							<li class="subnav-head">Also in <span class="highlight"><a href="<?php echo get_permalink($parent); ?>"><?php echo get_the_title($parent); ?></a></span></li>
							<?php echo $children; ?>
						</ul>			
				<?php } ?><!--End subnav -->

						<!--End Subpage Navigation code -->
						
				<div id="address"><?php get_sidebar('address-sb'); ?></div>
				</div> <!--End sidebar-left -->
				
		
				<div id="content">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> <!--Start the loop -->
					
					<div class="entry">
						
						
						
						<h2><?php the_title() ?></h2>
						
						<div class="news-item"><?php if ( has_post_thumbnail()) { ?> 
						<img src="<?php $image_id = get_post_thumbnail_id();
										$image_url = wp_get_attachment_image_src($image_id,'page-image', true);
										echo $image_url[0];  ?>" />
						<?php	} ?>
						<?php the_content() ?>
						</div>
			
					</div><!--End entry -->
					
					<?php endwhile; else: ?>
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>
				
				</div> <!--End content -->		
				<div class="clearboth"></div> <!--to have background work properly -->
			</div> <!--End main -->
			
		</div> <!--End container-mid -->
	
	
	<?php get_footer() ?>