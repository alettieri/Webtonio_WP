<?php
/**
 * @package WordPress
 * @subpackage webtonio
 */
?>

	</div><!-- #main  -->
	<?php get_sidebar(); ?>
	<?php get_template_part("sidebar","footer"); ?>

</div><!-- #page-wrap -->



</body>

<!-- Grab Google CDN's jQuery. Fall back to local if necessary -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script>!window.jQuery && document.write(unescape('%3Cscript src="<?php echo get_bloginfo("template_url"); ?>/js/libs/jquery-1.6.2.min.js"%3E%3C/script%3E'))</script>

<?php wp_footer(); ?>

</html>