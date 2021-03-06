<?php
/*
Template Name: Job Market
*/
?>		
	<?php get_header() ?>	
		<div id="container-mid">
			<div id="main">
				<div id="sidebar-left">
					<!--Subpage navigation-->
				<?php
					$parent = ksas_get_page_id('directoryindex');;
					$children = wp_list_pages("title_li=&child_of=". $parent ."&echo=0&depth=1");
									
					if ($children) { ?>
						<ul id="subnav">
							<li class="subnav-head">Also in <span class="highlight"><a href="<?php echo get_permalink($parent); ?>"><?php echo get_the_title($parent); ?></a></span></li>
							<?php echo $children; ?>
						</ul>			
				<?php } ?> 
				<!--End Subpage Navigation code -->
				<div id="address"><?php get_sidebar('address-sb'); ?></div>
				</div> <!--End sidebar-left -->
				
				<div id="content">
					<div class="entry">
					<!--This is the page content -->
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> <!--Start the loop -->
					<h2><?php the_title(); ?></h2>
					<?php the_content(); ?>
					<?php endwhile; ?>
					<?php endif; ?>
					<div class="directory-table">
					<table>
					
					<?php if(is_page('job-market')) :  ?>
					<!--Create query -->
					<?php // Get any existing copy of our transient data
	    	if ( false === ( $my_candidate_query = get_transient( 'ksas_candidate_query' ) ) ) {
        	// It wasn't there, so regenerate the data and save the transient
        	$my_candidate_query = new WP_Query(array(
					'post-type' => 'people',
					'role' => 'job-market-candidate',
					'meta_key' => 'ecpt_people_alpha',
					'orderby' => 'meta_value',
					'order' => 'ASC',
					'posts_per_page' => '25'));
        	set_transient( 'ksas_candidate_query', $my_candidate_query, 86400 );
	    	} ?>
					<?php while ($my_candidate_query->have_posts()) : $my_candidate_query->the_post(); ?>
					
					
					<tr>
						<td><?php if ( get_post_meta($post->ID, 'ecpt_people_photo', true) ) : ?><a href="<?php the_permalink() ?>"><img src="<?php echo get_post_meta($post->ID, 'ecpt_people_photo', true); ?>" /></a><?php endif; ?></td>
						
						<td><h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4><?php if ( get_post_meta($post->ID, 'ecpt_phone', true) ) : ?> <?php echo get_post_meta($post->ID, 'ecpt_phone', true); ?><br><?php endif; ?>
						<?php if ( get_post_meta($post->ID, 'ecpt_email', true) ) : ?><a href="mailto:<?php echo get_post_meta($post->ID, 'ecpt_email', true); ?>"> <?php echo get_post_meta($post->ID, 'ecpt_email', true); ?></a><?php endif; ?></p>
						<div class="divider"></div>
						<p class="candidates"><?php if ( get_post_meta($post->ID, 'ecpt_thesis', true) ) : ?><strong>Thesis Title: </strong>"<?php echo get_post_meta($post->ID, 'ecpt_thesis', true); ?>"<?php endif; ?><?php if ( get_post_meta($post->ID, 'ecpt_job_abstract', true) ) : ?>&nbsp;- <a href="<?php echo get_post_meta($post->ID, 'ecpt_job_abstract', true); ?>">Download Abstract (PDF)</a><?php endif; ?> </p>
						<p class="candidates"><?php if ( get_post_meta($post->ID, 'ecpt_advisor', true) ) : ?><strong>Main Advisor: </strong><?php echo get_post_meta($post->ID, 'ecpt_advisor', true); ?><?php endif; ?></p>
						<p class="candidates"><?php if ( get_post_meta($post->ID, 'ecpt_fields', true) ) : ?><strong>Fields: </strong><?php echo get_post_meta($post->ID, 'ecpt_fields', true); ?><?php endif; ?></p>
						
						</td>
												
					</tr>
					
					<?php endwhile; ?>
					<?php endif; ?>
					</table>
					</div> <!--end directory-table-->
						<div class="pagination"><?php ksas_pagination('«', '»'); ?></div>
					</div> <!--End entry-->
				</div> <!--End content -->		
				<div class="clearboth"></div> <!--to have background work properly -->
			</div> <!--End main -->
			
		</div> <!--End container-mid -->
	
	
	<?php get_footer() ?>