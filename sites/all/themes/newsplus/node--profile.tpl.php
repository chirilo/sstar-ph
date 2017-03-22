<?php 
$reading_time = theme_get_setting('reading_time');
$share_links = theme_get_setting('share_links');
$print_button = theme_get_setting('print_button');
$font_resize = theme_get_setting('font_resize');
$post_progress = theme_get_setting('post_progress');
?>

<style type="text/css">
p#publication, .base.pad-bottom,.fb-comments,div#disqus_thread,div#kskd8266049,.kskdDiv.kskdCls,footer.node-footer {
display: none;
}
.field.field-name-body.field-type-text-with-summary.field-label-hidden > .field-items > .field-item p, .field-name-field-search-author-name > .field-items > .field-item > .taxonomy-term > .content > .taxonomy-term-description > p {
    text-align: justify;
}
.field-name-field-search-author-name.field-type-entityreference > .field-items > .field-item > .taxonomy-term > .content > .field-name-field-author-image > .field-items > .field-item img {
    float: left;
    border-radius: 50%;
    margin: 20px 20px 0px 0px;
}
.field-type-entityreference > .field-items > .field-item > div h2 {
    display: none;
}
header .title a {
    font-size: 17px;
	color: #1D457C;
	font-weight: bold;
}
.node-teaser {
    margin-bottom: 0px;
}
.page-node- .field-name-body {
    margin-bottom: -22px;
}
</style>

<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  
  <!-- node-content-wrapper -->
  <div id="printArea" class="node-content-wrapper clearfix">

    <!-- node-content -->
    <div class="node-content clearfix <?php if (!($share_links || $print_button || $font_resize || $display_submitted || $post_progress || $reading_time) || (!$page)) { print ' ' . 'full-width'; } ?> ">
      <header>
        <?php print render($title_prefix); ?>
        <?php if (!$page) { ?>
          <h2 <?php print $title_attributes; ?> class="title"><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
        <?php } else { ?>
          <h1 class="title" <?php print $title_attributes; ?>><?php print $title; ?></h1>
        <?php } ?>
        <?php print render($title_suffix); ?>

          <div class="node-info">
            <div class="node-info-item" style="display: none;"><i class="fa fa-clock-o"></i> <?php print format_date($created, 'custom', 'l, F d, Y '); ?></div>
            <?php if (isset($content['field_author'])) { ?>
            <!-- display author image in opinion only -->            
            <div class="node-info-item">
                <?php if ($content['sunstar_with_author_image']['#value'] && $content['sunstar_term_name_section']['#value'] == "Opinion") { ?>
                <img src="<?php print $content['sunstar_author_image_url']['#value']; ?>" alt="<?php print $content['sunstar_author_name']['#value']; ?>" />
                <?php } ?>               
                <i class="fa fa-user"></i> <?php print t('By ');?><?php print render($content['field_author']) . render($content['field_column']) ;  ?>
            </div>
            <?php } ?>
            <!-- display author in opinion only -->
          </div>
      </header>

      <div class="content clearfix"<?php print $content_attributes; ?>>
        <?php
          // We hide the comments and links now so that we can render them later.
          hide($content['comments']);
          hide($content['links']);
		  /* hide the publication date and default, avoid rendering in front end */
		  hide($content['field_publication_date']);
          hide($content['field_publication_default_date']);
          print render($content);
        ?>
		
	<h2 style="    font-weight: 600;font-size: 20px;color: #F3F3F3;padding: 0 0 0 5px;margin: -.6em 0 0 0;background: #1D457C;">Columns</h2>
	
	
	<!-- Author article listing -->
	
	<?php

	 // get URL and query the tid of the author's name
	  $d = 'node/' . arg(1);
	  $dalias = drupal_get_path_alias($d);
	  $dcomponent = explode('/', $dalias);
	  $author_name = str_replace('-', ' ', $dcomponent[1]);
	  $author = db_query("SELECT tid FROM {taxonomy_term_data} WHERE LOWER(REPLACE(name, '.', ''))  = '" .  $author_name . "'")->fetchAllAssoc('tid');
	  if ($author) {
		// tid is the array's key
		$tid = key($author);
		$query = new EntityFieldQuery();
		$result = $query
				   ->entityCondition('entity_type', 'node')
				   ->entityCondition('bundle', 'article')
				   // get only nodes that are 'published'
				   ->propertyCondition('status', 1)
				   ->propertyOrderBy('created', 'DESC')
				  // replace field_food_menu with field_TAXONOMY_NAME
				  // replace 2 with the taxonomy ID (tid) you're wanting
				  ->fieldCondition('field_author', 'tid', $tid)
		                  // Number of rows per page
				  ->pager(5)
				  ->execute();

		if (isset($result['node'])) {
		   $nodes = node_load_multiple(array_keys($result['node']));
		   print render(node_view_multiple($nodes, 'teaser')) . theme('pager');
		}
	  }
	?>
		
      <!-- EOF: Author article listing -->
		
		
      </div>
      
      <?php if ($links = render($content['links'])): ?>
      <footer class="node-footer">
      <?php print render($content['links']); ?>
      </footer>
      <?php endif; ?>

      <?php print render($content['comments']); ?>
    </div>
    <!-- EOF:node-content -->

  </div>
  <!-- EOF: node-content-wrapper -->

</article>
