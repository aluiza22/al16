<?php 
/*
YARPP Template: Alab
Author: mitcho (Michael Yoshitaka Erlewine)
Description: A simple example YARPP template.
*/
?><h3>Outros artigos relacionados</h3>
<?php if (have_posts()):?>
<ol>
	<?php while (have_posts()) : the_post(); ?>
		<li class="item" style="background-image: url(<?php echo $image; ?>)">
					<a href="<?php echo $post->getPermalink() ?>" title="<?php echo $this->htmlEscape($post->getPostTitle()) ?>"><?php echo $this->htmlEscape($post->getPostTitle()) ?></a>
				</li>

	
	<?php endwhile; ?>
</ol>
<?php else: ?>
<p>No related posts.</p>
<?php endif; ?>
