jQuery(document).ready( function(){
		antonine_preview_link();
		antonine_article_align();
		items = Array();
		jQuery("article")
			.each(
				function(index,value){
					items.push(value);
				}
			);
		antonine_menu_slide(items);
	}
);