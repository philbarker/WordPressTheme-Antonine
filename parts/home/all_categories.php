<?php 

	$post_categories = get_categories( array('exclude' => get_option("antonine_featured")) );
	$cats = array();
		
	foreach($post_categories as $c){
		$cat = get_category( $c );
		?><article style="<?php antonine_category_thumbnail_background($c->term_id); ?>" >
			<header class="entry-header">
				<h1 style="<?PHP antonine_category_title_background($c->term_id); ?>" class="entry-title">
					<a href="<?PHP echo get_category_link($c); ?>">
						<?PHP echo $cat->name; ?>
					</a>
				</h1>				
			</header><!-- .entry-header -->
		</article><!-- #post-## --><?PHP
	}
	
?>