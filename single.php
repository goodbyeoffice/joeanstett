<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package joeanstett
 */

get_header( 'secondary' ); ?>

<?php 




?>

<header id="masthead" class="secondary-header" role="banner" style="background-color: <?php if ( get_custom_field('project_description_background_color') ) { echo get_custom_field('project_description_background_color'); } else {echo get_custom_field('project_background_color'); } ?>; color: <?php echo get_custom_field('project_text_color') ?>;">
	
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
					<?php echo get_custom_field('projectdescription') ?>
				</div>
				
				<div class="push"></div>
			
			</div>
			
			<div class="push"></div>

	</div><!-- .site-branding -->
	
	<div id="home_button">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">&larr; Back to all projects</a>
	</div>

</header><!-- #masthead -->

<div id="content" class="site-content">

	<div id="primary" class="project-area">
		
		<main id="main" class="site-main" role="main">
			
			<div class="entry-content">
				<?php the_content(); ?>
			</div><!-- .entry-content -->

		</main><!-- #main -->
		
	</div><!-- #primary -->
	
	<footer class="mobile-footer" style="background-color: <?php echo get_custom_field('project_background_color') ?>; color: <?php echo get_custom_field('project_text_color') ?>;">
		
		<a id="home_button" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			&larr; Back to all projects
		</a>
		
	</footer>
		
	
	<?php endwhile; // End of the loop. ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
