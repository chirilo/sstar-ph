<?php 
$reading_time = theme_get_setting('reading_time');
$share_links = theme_get_setting('share_links');
$print_button = theme_get_setting('print_button');
$font_resize = theme_get_setting('font_resize');
$post_progress = theme_get_setting('post_progress');
?>
<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  
  <!-- node-content-wrapper -->
  <div id="printArea" class="node-content-wrapper clearfix">

    <?php if ( $page && ($share_links || $print_button || $font_resize || $display_submitted || $post_progress || $reading_time )) { ?>
    <!-- node-side -->
    <div class="node-side">
      
      <?php if ($display_submitted) { ?>
      <div class="user-info">
        <?php print $user_picture; ?>
        <?php if ($display_submitted) { ?>
        <?php print t('By ');?> <?php print $name; ?>
        <?php } ?>
      </div>
      <?php } ?>
      
      <?php if ($reading_time) { ?>
      <!-- reading-time -->
      <div class="reading-time">
        <div><?php print t('Time to read')?></div>
          
        <?php 
        $node_content = $content;
        $node_content = render($node_content); 
        $words = str_word_count(strip_tags($node_content));
        $minutes = floor($words / 275);
        if ($minutes<1) { 
        print '<span>' . t('less than<br> 1 minute' . '</span>'); 
        } elseif ($minutes<2) {
        print '<span>' . $minutes . t(' minute') . '</span>';  
        } else {
        print '<span>' . $minutes . t(' minutes') . '</span>'; 
        }
        ?>
          
      </div>
      <!-- EOF: reading-time -->
      <?php } ?>
      
      <?php if ($share_links || $print_button || $font_resize || $display_submitted || $post_progress) { ?>
      <!-- #affix -->
      <div id="affix">
        
        <?php if ($share_links) { ?>
        <!-- share-links -->
        <div class="share-links">
          <?php print t('Share'); ?>
          <?php $path = isset($_GET['q']) ? $_GET['q'] : '<front>'; ?>
      <link rel="stylesheet" href="http://www.sunstar.com.ph/sites/all/themes/newsplus/social-share-kit.css" type="text/css">
        <script type="text/javascript" src="http://www.sunstar.com.ph/sites/all/themes/newsplus/js/social-share-kit.js"></script>
        <script type="text/javascript" src="http://www.sunstar.com.ph/sites/all/themes/newsplus/js/social-share-kit.min.js"></script>
        <script>(function($){$(document).ready(function(){SocialShareKit.init({
          'url': 'http://www.sunstar.com.ph<?php echo $node_url; ?>',
           twitter: {
            title: "<?php echo $title . ' | SunStar Philippines'; ?>",
            url: 'http://www.sunstar.com.ph<?php echo $node_url; ?>',
            text: '',
            via: 'sunstaronline'
          }
          });});})(jQuery);</script>
        <!--<script type="text/javascript">SocialShareKit.init();</script>-->
      <ul>
        <li>
          <div class="ssk-rounded ssk-count">
            <a href="" class="ssk ssk-facebook ssk-sm"></a>
          </div>
        </li>
        <li>
          <div class="ssk-rounded ssk-count">
            <a href="" class="ssk ssk-twitter ssk-sm"></a>
            </div>
        </li>
        <li>
          <div class="ssk-rounded ssk-count" data-url="http://www.sunstar.com.ph<?php echo $node_url; ?>">
            <a href="" class="ssk ssk-google-plus ssk-sm"></a>
          </div>
        </li>
        <li>
          <div class="ssk-rounded ssk-count" data-url="http://www.sunstar.com.ph<?php echo $node_url; ?>">
            <a href="" class="ssk ssk-email ssk-sm"></a>
          </div>
        </li>
      </ul>
        </div>
        <!-- EOF:share-links -->
        <?php } ?>
        
        <?php if ($print_button || $font_resize || $display_submitted) { ?>
        <!-- submitted-info -->
        <div class="submitted-info">
          <?php if ($print_button) { ?>
          <div class="print">
            <?php 
            /*
            * Commented out since PrintElem() is not working. Chirilo - Oct 6, 2016
            * <i class="fa fa-print"></i> <a href="javascript:PrintElem()" target="_blank" class="print-button"> <?php print t(' Print')?></a> 
            */
            ?>
            <i class="fa fa-print"></i> <a href="javascript:window.print()" target="_blank" class="print-button"> <?php print t(' Print')?></a>
          </div>
          <?php } ?>
          <?php if ($font_resize) { ?>
          <div class="font-resize">
            <a href="#" id="decfont">a-</a>
            <a href="#" id="incfont">a+</a>
          </div>
          <?php } ?>
          <?php if ($display_submitted) { ?>
          <div class="submitted-info-item">
            <?php print t('Published')?>
            <span><?php print $posted_ago; ?><?php print t(' ago')?></span>
          </div>
          <div class="submitted-info-item">
            <?php print t('Last updated')?>
            <span><?php print $changed_ago; ?><?php print t(' ago')?></span>
          </div>
          <?php } ?>
        </div>
        <!--EOF: submitted-info -->
        <?php } ?>
        
        <?php if ($post_progress) { ?>
        <!-- post-progress -->
        <div class="post-progress">
          <?php print t('Read so far')?>
          <span class="post-progress-value"></span>
          <div class="post-progressbar"></div>
        </div>
        <!-- EOF: post-progress -->
        <?php } ?>
      
      </div>
      <!-- EOF:#affix -->
      <?php } ?>

    </div>
    <!-- EOF:node-side -->
    <?php } ?>

    <!-- node-content -->
    <div id="printAreaContent" class="node-content clearfix <?php if (!($share_links || $print_button || $font_resize || $display_submitted || $post_progress || $reading_time) || (!$page)) { print ' ' . 'full-width'; } ?> ">
      <header>
        <?php print render($title_prefix); ?>
        <?php if (!$page) { ?>
          <h2 <?php print $title_attributes; ?> class="title"><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
        <?php } else { ?>
          <h1 class="title" <?php print $title_attributes; ?>><?php print $title; ?></h1>
        <?php } ?>
        <?php print render($title_suffix); ?>

          <div class="node-info">
            <div class="node-info-item"><i class="fa fa-clock-o"></i> <?php print format_date($created, 'custom', 'l, F d, Y '); ?></div>
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

          /* hide the tags/keywords, avoid rendering it ABOVE the related article - Chi Rilo August 10, 2016 */
          hide($content['field_tags']);

          hide($content['field_publication_default_date']);
          print render($content);
        ?>
        <?php 
            /* For Ventuno - Chirilo Feb 3, 2017
            if (strpos($_SERVER['REQUEST_URI'], "entertainment") !== false){
            // car found
              $block = module_invoke('block', 'block_view', '139');
              print render($block['content']);
            }

            elseif( strpos($_SERVER['REQUEST_URI'], "cebu/entertainment") !== false ) {
              $block = module_invoke('block', 'block_view', '140');
              print render($block['content']);
            }*/
        ?>

		<div class="related-article">
         <?php
         $views_block = module_invoke('views','block_view','related_articles-block');
         print render($views_block);
         ?>
        </div>
        <?php
          /* since it was hidden above, show the tags/keyword beneath the related articles - Chi Rilo August 10, 2016 */
          print render($content['field_tags']);
        ?>

        <?php
          /**
          * Publication on ALL articles - Chirilo Feb 06, 2017
          * Check if article is published on newspaper before displaying below
          */
        ?>
        <?php if( $content['sunstar_date_published_in_newspaper']['#value'] !== null ) { ?>
          <p id="publication"><strong><?php echo strip_tags($content['sunstar_date_published_in_newspaper']['#value']); ?></strong></p>
        <?php } ?>
	
	<!-- start of e-paper promotion -->
    <?php 
      /*
      * This template modification is dependent on the $node_url value wherein it splits() the value of the url
      * and uses the second element it the array which contains the used "Location" of the node.  Changing the
      * url or url alias in drupal might render this e-paper promotion non-rendable.
      */
      /* orig below */
      /*<p id="publication"><strong><?php echo strip_tags($content['sunstar_date_published_in_newspaper']['#value']); ?></strong></p>*/

      //$split_location = split("/", $node_url);
      $split_location = explode("/", $node_url);
      $used_loc = $split_location[1]; //Note: Use the second element in the array!
      if($used_loc=='bacolod' || $used_loc=='baguio' || $used_loc=='cebu' || $used_loc=='davao' || $used_loc=='pampanga') {
        echo "<p id='publication'>Latest issues of <strong>Sun.Star ".ucfirst($used_loc)."</strong> also available on your mobile phones, laptops, and tablets. Subscribe to our digital editions at <a href='http://epaper.sunstar.com.ph/epaper/viewer.aspx' target='_blank'>epaper.sunstar.com.ph</a> and get a free seven-day trial.</p>";
      }
    ?>
    <!-- end of e-paper promotion -->
    
    <?php /*<!-- Ventuno Editorial Player Integration - March 20, 2017 Chirilo -->*/ ?>
    <div id="vt-editorial-player"></div><br />
    <script type="text/javascript">
    window.__ventunoplayer = window.__ventunoplayer||[];
    window.__ventunoplayer.push({publisher_key : '58296788743db', slot_id : '718', holder_id : 'vt-editorial-player', player_type: 'ep'});
    </script>
    <script type="text/javascript" src="https://pl.ventunotech.com/plugins/cntplayer/ventunoSmartPlayer.js"></script>
    <?php /*<!-- EOF: Ventuno Editorial Player Integration - March 20, 2017 Chirilo -->*/ ?>
    

	
	 <!-- start of survey monkey -->
	 
    <?php
/*
     if ($used_loc == 'cebu') {
        echo"<script>(function(t,e,o,n){var c,s,a;t.SMCX=t.SMCX||[],e.getElementById(n)||(c=e.getElementsByTagName(o),s=c[c.length-1],a=e.createElement(o),a.type='text/javascript',a.async=!0,a.id=n,a.src=['https:'===location.protocol?'https://':'http://','widget.surveymonkey.com/collect/website/js/Z4lFGWG53Zw2bnAaS4omZ65_2B25vSPugUU_2Fo7nRTQ2ST4VPSy0GG8o0cwazaiSyBO.js'].join(''),s.parentNode.insertBefore(a,s))})(window,document,'script','smcx-sdk');</script>";
      }
*/
    ?>

    <!-- end of survey monkey -->

    <!-- start of specific kiosked ads -->
     <?php
      /*
      if ($used_loc == 'tacloban') {        
        echo"<script type='text/javascript' async='async' src='//scripts.kiosked.com/loader/kiosked-loader.js?pub=11301&site=11440'></script>";
        echo"<script type='text/javascript' async='async' src='//anonymousdemographics.com/u?pub=11301&site=11440&ts=1438855071&_response_content_type=js'></script>";
      }
      */
     ?>    
    <!-- end of specific kiosked ads -->

    <!-- start of kiosked ads -->
     <?php      
      //echo"<script type='text/javascript' async='async' src='//scripts.kiosked.com/loader/kiosked-loader.js?pub=11301&site=11440'></script>";
      //echo"<script type='text/javascript' async='async' src='//anonymousdemographics.com/u?pub=11301&site=11440&ts=1438855071&_response_content_type=js'></script>";
     ?>  
    <!-- end of kiosked ads -->
	

      <?php 
      /**
      * Outbrain widget to be moved to sidebar (1month experiment) - Chirilo Feb 2, 2017 */ ?>
        <!--Outbrain widget -->
        <div class="base pad-bottom" style="margin-top: 20px;">
        <div class="OUTBRAIN" data-src="http://www.sunstar.com.ph<?php echo $node_url; ?>" data-widget-id="AR_3" data-ob-template="sunstar" ></div>
        <script type="text/javascript" async="async" src="http://widgets.outbrain.com/outbrain.js"></script>
        </div>
       
        <?php 
          /**
          * Google Syndication One Month test is done - Chirilo March 11, 2017
        <div class="base pad-bottom">
          <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
          <ins class="adsbygoogle"
               style="display:block"
               data-ad-format="autorelaxed"
               data-ad-client="ca-pub-2836569479021745"
               data-ad-slot="4724639110"></ins>
          <script>
               (adsbygoogle = window.adsbygoogle || []).push({});
          </script>
        </div> */ ?>
      </div>
      <!-- #EOF End of content -->




      
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


  <div id="second-node-content" class="node-content clearfix">
    <!-- Facebook comment  -->
  <div class="fb-comments" style="display: none;">
  <p style="margin: 0 auto; width:100%; margin-top:1em;border-top: dashed 1px #a5a5a5;  padding-top: 1em;"><strong>DISCLAIMER:</strong>  Sun.Star website welcomes friendly debate, but comments posted on this site do not necessary reflect the views of the Sun.Star management and its affiliates. Sun.Star reserves the right to delete, reproduce or modify comments posted here without notice. Posts that are inappropriate will automatically be deleted.<br /><br /><strong>Forum rules:</strong> Do not use obscenity.  Some words have been banned. Stick to the topic.  Do not veer away from the discussion.  Be coherent and respectful. Do not shout or use CAPITAL LETTERS!</p>
  <?php /* Comments Video Guide requested by Miss Nini - Chirilo October 5, 2016 */ ?>
  <iframe width="650" height="366" src="https://www.youtube.com/embed/KTkDaAhzavk" frameborder="0" allowfullscreen></iframe>
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=170014129740511";
  fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>

 


      <div style="margin-top:0px;margin-left:-3px;padding:5px 8px; background:#f0f0f0; border: 1px dashed #c3c3c3;">
      <div class="fb-comments" data-href="http://www.sunstar.com.ph/node/<?php echo $nid; ?>" data-width="100%" data-numposts="5" data-colorscheme="light" data-mobile="true" data-version="v2.3"></div>
      </div>
      </div>
    <!-- EOF: Facebook comment -->

    <!--Disqus-->
      <!-- An element a visitor can click if they <3 comments! - Chirilo September 9, 2016 -->
      <center><a id="view_comments" style="cursor: pointer; width: 100%; font-size: 22px; font-weight: bold; background-color: #0967b2 !important;" class="button show-comments">View Comments</a></center>
      <div id="disqus_thread"></div>
      <?php 
      /* This is to prevent from loading the Disqus comments on page load - Chirilo September 9, 2016 */
      /**<script type="text/javascript">
    // CONFIGURATION VARIABLES 
    var disqus_shortname = 'sunstarphilippines';
    
    // DON'T EDIT BELOW THIS LINE 
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
      </script>
      <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>*/
      /* This is to prevent from loading the Disqus comments on page load - Chirilo September 9, 2016 */
      ?>
      <!--EOF: Disqus -->
      </div> <!-- second node-content div -->


</article>