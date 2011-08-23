		
	<?php get_header() ?>	
		
		
		<div id="container-mid">
			<div id="homepage">
				
				
		
				<div id="blogfeed">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> <!--Start the loop -->
					
					<div class="snippet">
						
						<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
						<?php if ( has_post_thumbnail()) { ?> 
						<div class="thumbnail"><img src="<?php $image_id = get_post_thumbnail_id();
										$image_url = wp_get_attachment_image_src($image_id,’thumbnail’, true);
										echo $image_url[0];  ?>" align="left" /></div>
						<?php	} ?>
						
						<?php the_excerpt() ?>
			
					</div><!--End snippet -->
					
					<?php endwhile; else: ?>
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>
				
				<p><a href="/about/news-archive/">More News and Announcements</a></p>
				</div> <!--End blogfeed -->	
				
				
				<div id="sidebar-right">
				<h3>Sidebar Right</h3>

				</div> <!--End sidebar-right -->	
				<div class="clearboth"></div> <!--to have background work properly -->
			</div> <!--End homepage -->
			
		</div> <!--End container-mid -->
	
	
	<?php get_footer() ?>