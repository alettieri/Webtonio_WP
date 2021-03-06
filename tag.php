<?php
/**
 * The template used to display Tag Archive pages
 *
 * @package WordPress
 * @subpackage webtonio
 */

get_header(); ?>

				<?php the_post(); ?>

				<header class="page-header">
					<h1 class="page-title"><?php
						printf( __( 'Tag Archives: %s', 'webtonio' ), '<span>' . single_tag_title( '', false ) . '</span>' );
					?></h1>
				</header>

				<?php rewind_posts(); ?>

				<?php get_template_part( 'loop', 'tag' ); ?>

<?php get_footer(); ?>