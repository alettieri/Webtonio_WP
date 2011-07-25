
<?php if(is_active_sidebar("ft-left") || is_active_sidebar("ft-right") ) : ?>
	<footer id="ft" class="clearfix">
		<aside id="ft-left" class="left_block">
			<?php echo dynamic_sidebar("ft-left"); ?>
		</aside>
		<aside id="ft-right" class="right_block pull_right">
			<?php dynamic_sidebar("ft-right");  ?>
		</aside>
	</footer>
<?php endif; ?>
			
			


