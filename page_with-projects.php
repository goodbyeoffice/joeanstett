<?php
/**
 * Template Name: Include Projects Template
 *
 * This template shows the project grid along side whatever content
 * is provided. It is intended to be used on pages such as contact
 * or about, where the content in minimal.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package joeanstett
 */

get_header( 'secondary' ); ?>

<header id="masthead" class="secondary-header" role="banner">

	<div class="site-branding">

		<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->

		<?php while ( have_posts() ) : the_post(); ?>

			<div id="project-details">

				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

				</header><!-- .entry-header -->

				<div class="project-description">
					<?php echo get_custom_field('textcontent') ?>
				</div>

			</div>

	</div><!-- .site-branding -->

</header><!-- #masthead -->

<?php endwhile; // End of the loop. ?>

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
