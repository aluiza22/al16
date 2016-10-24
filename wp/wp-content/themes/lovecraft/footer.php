<?php if ( is_active_sidebar('footer-one') || is_active_sidebar('footer-two') || is_active_sidebar('footer-three') ) : ?>

	
	<div class="footer section big-padding bg-white">
		
		<div class="section-inner">
			
			
			<div class="widgets" style="margin-left: 100px;">
				
				<?php dynamic_sidebar('footer-one'); ?>
				
			</div>
			
			<div class="widgets">
				
				<?php dynamic_sidebar('footer-two'); ?>
				
			</div>
			
			<div class="widgets">
				
				<?php dynamic_sidebar('footer-three'); ?>
				
			</div>

			<div class="widgets" style="margin-right: 30px;">
				
				<?php dynamic_sidebar('footer-four'); ?>
				
			</div>
			
			<div class="clear"></div>
			
		</div> <!-- /section-inner -->
		
	</div> <!-- /footer.section -->

<?php endif; ?>

<div class="credits section bg-dark">
			
	<div class="credits-inner section-inner">
	
		<p style="text-align: center;"><font color="#fff">Desenvolvido por <a class="endereco" title="Agencia SEO Hina" href="http://hina.com.br" target="_blank" style="color:#fff;"><strong>Agência SEO Hina</strong></a> - © 2016 - Todos os direitos reservados.</font></p>
	
	</div> <!-- /section-inner -->

</div> <!-- /credits.section -->



<?php wp_footer(); ?>

</body>
</html>