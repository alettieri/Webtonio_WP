<?php
/**
 * @package WordPress
 * @subpackage webtonio
 */
?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	<nav id="nav-above" role="article">
		<h1 class="section-heading"><?php _e( 'Post navigation', 'webtonio' ); ?></h1>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'webtonio' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'webtonio' ) ); ?></div>
	</nav><!-- #nav-above -->
<?php endif; ?>

<?php /* Start the Loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
		<header class="entry-header">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'webtonio' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

			<div class="entry-meta">
				<?php
					printf( __( '<span class="sep">Posted on </span><a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s" pubdate>%3$s</time></a> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%4$s" title="%5$s">%6$s</a></span>', 'webtonio' ),
						get_permalink(),
						get_the_date( 'c' ),
						get_the_date(),
						get_author_posts_url( get_the_author_meta( 'ID' ) ),
						sprintf( esc_attr__( 'View all posts by %s', 'webtonio' ), get_the_author() ),
						get_the_author()
					);
				?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->

		<?php if ( is_archive() || is_search() ) : // Only display Excerpts for archives & search ?>
		<div class="entry-summary">
			<?php the_excerpt( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'webtonio' ) ); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'webtonio' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'webtonio' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>

		<footer class="entry-meta">
			<span class="cat-links"><span class="entry-utility-prep entry-utility-prep-cat-links"><?php _e( 'Posted in ', 'webtonio' ); ?></span><?php the_category( ', ' ); ?></span>
			<span class="meta-sep"> | </span>
			<?php the_tags( '<span class="tag-links">' . __( 'Tagged ', 'webtonio' ) . '</span>', ', ', '<span class="meta-sep"> | </span>' ); ?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'webtonio' ), __( '1 Comment', 'webtonio' ), __( '% Comments', 'webtonio' ) ); ?></span>
			<?php edit_post_link( __( 'Edit', 'webtonio' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
		</footer><!-- #entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->

	<?php comments_template( '', true ); ?>

<?php endwhile; ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
	<nav id="nav-below" role="article">
		<h1 class="section-heading"><?php _e( 'Post navigation', 'webtonio' ); ?></h1>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'webtonio' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'webtonio' ) ); ?></div>
	</nav><!-- #nav-below -->
<?php endif; ?>
