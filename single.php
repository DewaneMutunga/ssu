<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Sans Sidebar Underscores
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php ssu_post_nav(); ?>

			<?php
			if (get_theme_mod( 'ssu_post_footer_content')) { ?>
				<div class="post_footer">
					<?php echo wpautop( get_theme_mod( 'ssu_post_footer_content' ) ); ?>
	            </div>
            <?php
        		}
        	?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->


<?php 1 != get_theme_mod( 'ssu_body_layout' ) ? get_sidebar() : ''; ?>
<?php get_footer(); ?>