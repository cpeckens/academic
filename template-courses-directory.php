<?php
/*
Template Name: Courses
*/
?>

<?php get_header(); ?>
		<div id="container-mid">
			<div id="main">
				<div id="sidebar-left">
				
			<!--Subpage navigation-->
			<?php
				if(is_page('undergraduate-courses')) : 
					 $parent = ksas_get_page_id('undergraduate');
				elseif(is_page('graduate-courses')) :
					 $parent = ksas_get_page_id('graduate');
				elseif(is_page('faq')) :
					 $parent = ksas_get_page_id('graduate');
				endif;
								
									
					$children = wp_list_pages("title_li=&child_of=". $parent ."&echo=0&depth=1");
									
					if ($children) { ?>
						<ul id="subnav">
							<li class="subnav-head">Also in <span class="highlight"><a href="<?php echo get_permalink($parent); ?>"><?php echo get_the_title($parent); ?></a></span></li>
							<?php echo $children; ?>
						</ul>			
				<?php } ?> <!--End subnav -->

						<!--End Subpage Navigation code -->
				</div> <!--End sidebar-left -->
				
		
				<div id="content">
 					<div class="entry">
 					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> <!--Start the loop -->
					<h2><?php the_title(); ?>&nbsp;<a class="acc_expandall">[Expand All]</a></h2>
					<?php the_content() ?>
					<?php endwhile; ?>
					<?php endif; ?>
 				
					<!-- Start course loop -->
					<?php if(is_page('undergraduate-courses')) : ?>
					
					<?php 
						// Get any existing copy of our transient data
						if ( false === ( $ksas_course_query = get_transient( 'ksas_course_query' ) ) ) {
    					// It wasn't there, so regenerate the data and save the transient
     					$ksas_course_query = new WP_Query('post-type=courses&coursetype=undergraduate-course&orderby=title&order=asc&posts_per_page=100');
     					set_transient( 'ksas_course_query', $ksas_course_query, 86400 );
						} 
					?>
					
					<?php while ($ksas_course_query->have_posts()) : $ksas_course_query->the_post(); ?>
						
							<h3 class="acc_trigger"><a href="#"><?php the_title(); ?><?php if ( get_post_meta($post->ID, 'ecpt_credit', true) ) : ?>&nbsp;(<?php echo get_post_meta($post->ID, 'ecpt_credit', true); ?> Credits)<?php endif; ?></a></h3>
							<div class="acc_container">
								<div class="course">
								<?php the_content()?>
								<?php if ( get_post_meta($post->ID, 'ecpt_prereqs', true) ) : ?><p><span class="label">Prerequisites:</span> <?php echo get_post_meta($post->ID, 'ecpt_prereqs', true); ?></p><?php endif; ?>
								<p><?php if ( get_post_meta($post->ID, 'ecpt_instructor', true) ) : ?><span class="label">Instructor:</span> <?php echo get_post_meta($post->ID, 'ecpt_instructor', true); ?><br><?php endif; ?>
									
									<?php if ( get_post_meta($post->ID, 'ecpt_course_times', true) ) : ?><span class="label">Course Times:</span> <?php echo get_post_meta($post->ID, 'ecpt_course_times', true); ?><br><?php endif; ?>
									
									<?php if ( get_post_meta($post->ID, 'ecpt_course_limit', true) ) : ?><span class="label">Course Limit:</span> <?php echo get_post_meta($post->ID, 'ecpt_course_limit', true); ?><br><?php endif; ?>
									
									<?php if ( get_post_meta($post->ID, 'ecpt_course_website', true) ) : ?><a href="<?php echo get_post_meta($post->ID, 'ecpt_course_website', true); ?>" target="_blank">View course website/syllabus</a><?php endif; ?>
								</p>
								
								
								</div>
							</div>
							
							<?php endwhile; ?>
				
				<?php elseif(is_page('graduate-courses')) :  ?>
				
					<?php
						// Get any existing copy of our transient data
						if ( false === ( $ksas_gradcourse_query = get_transient( 'ksas_gradcourse_query' ) ) ) {
    					// It wasn't there, so regenerate the data and save the transient
     					$ksas_gradcourse_query = new WP_Query('post-type=courses&coursetype=graduate-course&orderby=title&order=asc&posts_per_page=100');
     					set_transient( 'ksas_gradcourse_query', $ksas_gradcourse_query, 86400 );
						} 
					?>
					<?php while ($ksas_gradcourse_query->have_posts()) : $ksas_gradcourse_query->the_post(); ?>
						
							<h3 class="acc_trigger"><a href="#"><?php the_title(); ?></a></h3>
							<div class="acc_container">
								<div class="course">
								<?php the_content()?>
								<?php if ( get_post_meta($post->ID, 'ecpt_prereqs', true) ) : ?><p><span class="label">Prerequisites:</span> <?php echo get_post_meta($post->ID, 'ecpt_prereqs', true); ?></p><?php endif; ?>
								<p><?php if ( get_post_meta($post->ID, 'ecpt_instructor', true) ) : ?><span class="label">Instructor:</span> <?php echo get_post_meta($post->ID, 'ecpt_instructor', true); ?><br><?php endif; ?>
									
									<?php if ( get_post_meta($post->ID, 'ecpt_course_times', true) ) : ?><span class="label">Course Times:</span> <?php echo get_post_meta($post->ID, 'ecpt_course_times', true); ?><br><?php endif; ?>
									
									<?php if ( get_post_meta($post->ID, 'ecpt_course_limit', true) ) : ?><span class="label">Course Limit:</span> <?php echo get_post_meta($post->ID, 'ecpt_course_limit', true); ?><br><?php endif; ?>
									
									<?php if ( get_post_meta($post->ID, 'ecpt_course_website', true) ) : ?><a href="<?php echo get_post_meta($post->ID, 'ecpt_course_website', true); ?>" target="_blank">View course website/syllabus</a><?php endif; ?>
								</p>
								</div>
							</div>
							
							<?php endwhile; ?>
						
						<?php endif; ?>

					</div> <!--End entry-->
				</div> <!--End content -->		
				<div class="clearboth"></div> <!--to have background work properly -->
			</div> <!--End main -->
			
		</div> <!--End container-mid -->
	
	<?php get_footer() ?>