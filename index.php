<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package joeanstett
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="projects-grid" class="site-main" role="main">

		<?php
		query_posts(array('posts_per_page' => -1, 'offset' => 0, 'orderby' => 'date', 'order' => 'DESC', 'post_type' => 'project', 'post_status' => 'publish', 'suppress_filters' => true ));
		
		if(have_posts()) :
			while(have_posts())	: the_post();
				echo '<div class="project-square" style="background-color: ' . get_custom_field('project_background_color') . ';"><a href="' . get_permalink() . '">';
				if ( has_post_thumbnail() ) {	
					$image = wp_get_attachment_image_src(get_post_thumbnail_id(),'full');
					
					$animation_steps = (int)get_custom_field('project_frames') - 1;
					$animation_duration = (int)get_custom_field('project_frames') / (int)get_custom_field('project_fps');
					
					echo '<div class="project-square-bg" style="background: url('.$image[0].'); animation: project-square-bg-animation ' . $animation_duration . 's steps(' . $animation_steps . ') infinite;"></div>';
				}
				echo '<div class="project-square-inner" style="color: ' . get_custom_field('project_text_color') . '">';
				the_title('<h1>','</h1>' );
				echo '<h4>' . get_custom_field('project_subtitle') . '</h4>';
				echo '</div></a></div>'; 
				
				

				
				
				
			endwhile;
		endif;
		?>
			
	
					
					
		
		

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
