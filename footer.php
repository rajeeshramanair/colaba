<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package colaba
 */
?>

	
			</div><!-- #content -->
		</div><!--# main page-->
	</div><!-- # main-content area-->		

	<footer id="colophon" class="site-footer inner" role="contentinfo">
		<div class="site-info" style="text-align:center;">
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'colaba' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'colaba' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'colaba' ), 'colaba', '<a href="http://twitter.com/rajeeshramanair" rel="designer" target="_blank">Underscore</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->


<?php wp_footer(); ?>

</body>
</html>
