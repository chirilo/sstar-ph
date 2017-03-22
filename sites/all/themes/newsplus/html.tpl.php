<!DOCTYPE html>
<html lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces;?>>

<head profile="<?php print $grddl_profile; ?>">
  <?php print $head; ?>
<meta property="fb:pages" content="58605083395" />
<meta property="fb:app_id" content="170014129740511" />

  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
  
  <!--  microsite slide slideshow -->  
  <link rel="stylesheet" type="text/css" href="/sites/all/libraries/slick/slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="/sites/all/libraries/slick/slick/slick-theme.css"/>

  <link rel="icon" href="/sites/default/files/favicon.ico" type="image/x-icon" />

  <!-- Begin Kiosked (Commented) -->
  <!--
    <script type="text/javascript" async="async" src="//scripts.kiosked.com/loader/kiosked-loader.js?pub=11301&site=11440"></script>
    <script type="text/javascript" async="async" src="//anonymousdemographics.com/u?pub=11301&site=11440&ts=1438855071&_response_content_type=js"></script>
  -->
  <!-- End Kiosked (Commented) -->
  
  <!-- HTML5 element support for IE6-8 -->
  <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <?php print $scripts; ?>
  <style type="text/css">
    #dfp-ad-sunstar_networkpage_breakingatf_970x90 iframe { width: 1140px !important; }
    #dfp-ad-sunstar_networkpage_breakingatf_970x90 img.img_ad { width: 1140px !important; }
  </style>
</head>
<body class="<?php print $classes; ?>" <?php print $attributes;?>>
<h1 class="title element-invisible"><?php print $head_title; ?></h1>
  <div id="skip-link">
    <a href="#main-content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
  </div>
  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>
  

  <div class="various" style="display: none; width: 360px !important;">
    <div class="item-list">
      <ul class="quicktabs-tabs quicktabs-style-nostyle">
      <li class="active first last"><a href="/icymi" id="quicktabs-tab-custom_channel_qt-0" class="active quicktabs-loaded jquery-once-2-processed">In Case You Missed It!<br />
      <span style="font-size: 12px; text-transform: none;"><?php echo ucfirst('(Something light from SunStar website)');?></span>
      </a>
      </li>
      </ul>
    </div>
    <?php 
      $block = module_invoke('block', 'block_view', '31');
      print render($block['content']);

      /* this is for conditionally showing ICYMI popup ONLY on FrontPage - Chirilo Nov 30, 2016 */
      if (drupal_is_front_page()) {
          $thisisfrontpage = 'yes';
      }
      else{
       $thisisfrontpage = 'no'; 
      }
    ?>
  </div>

  
    <?php /* This is the element handle for the Cesafi Video popup - Chirilo September 9, 2016 */ ?>
    <?php /* <a class="various fancybox.iframe" style="display: none;" rel="group" href="https://www.youtube.com/embed/1rAKeLQmk5M?autoplay=1">CESAFI 2016 Ad</a> */ ?>

    <!--  microsite slide slideshow -->  
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript" src="/sites/all/libraries/slick/slick/slick.min.js"></script>


  <?php /* Add fancyBox to show Cesafi video popup on sports related articles and sections - Chirilo September 9, 2016 */ ?>
  <link rel="stylesheet" href="/sites/all/libraries/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
  <script type="text/javascript" src="/sites/all/libraries/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
  <script type="text/javascript" src="/sites/all/themes/newsplus/js/local-cache.js"></script>
  
  <?php
  global $user;

  if ( $user->uid === 0 ) { ?>
    <!-- Anonymous user detected -->
    <script type="text/javascript">
    $(document).on('copy', function(e)
    {
      var sel = window.getSelection();
      var copyFooter = 
            "<br /><br /> Read more: <a href='" + document.location.href + "'>" + document.location.href + "</a><br />Follow us: @sunstaronline on Twitter | SunStar Philippines on Facebook";
      var copyHolder = $('<div>', {html: sel+copyFooter, style: {position: 'absolute', left: '-99999px'}});
      $('body').append(copyHolder);
      sel.selectAllChildren( copyHolder[0] );
      window.setTimeout(function() {
          copyHolder.remove();
      },0);
    });
    </script>
  <?php
  }
  ?>

<script type="text/javascript">
$( document ).ready(function() {

  $('.slider-for').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.slider-nav'
  });
  $('.slider-nav').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    asNavFor: '.slider-for',
    dots: true,
    centerMode: true,
    focusOnSelect: true
  });

  /*  UPDATED - Stopped implementation - Chirilo March 14, 2017 */
  /* Check if url if <front> if true, show ICYMI popup  - Chirilo Nov 4, 2016*/
  //if(window.location.href.indexOf("/") > -1 || window.location.href.indexOf("latest-news") > -1 ) {
  /*var isfrontpage = '<?php //echo $thisisfrontpage;?>';
  if( isfrontpage === 'yes' && isfrontpage !== null ){
    
    var popupstate = localStorage.getCacheItem("popUpState");
    
    //if(localStorage.getItem('popState') != 'shown'){
      if( popupstate == null ){
        //$('.various').css('style','block');
        $('.various').removeAttr('style');
        $(".various").fancybox({
          maxWidth  : 360,
          maxHeight : 700,
          fitToView : true,
          width   : '360px',
          height    : '100%',
          autoSize  : true,
          closeClick  : false,
          openEffect  : 'none',
          closeEffect : 'none'
        });
        $(".various").click();

        $('.various a').each(function(){
          $(this).attr('style', 'cursor: pointer;');
          $(this).on('click', function(e){
            e.preventDefault();
            var this_url = $(this).attr('href');
            window.open(this_url);
            $('.fancybox-close').trigger('click');
            //location.reload();
          //  $("#fancybox-close").trigger('click');
          });
        });
        //localStorage.setItem('popState','shown');
        localStorage.setCacheItem("popUpState", "shown", { days: 1 });
    }
    // Add event handle for the ICYMI quicktab to redirect to url=/icymi on click - Chirilo Nov 7, 2016
    $('#quicktabs-tab-custom_channel_qt-0').on('click', function(e){
      e.preventDefault();
      var thisquicktab = $(this).text();
      var icymiurl = $(location).attr('href')+'icymi';
      //console.log("this quick tab text"+thisquicktab);
      if( thisquicktab === "In Case You Missed It" ){
        window.open(icymiurl);
      }
    });

    // close this dialog after 5 seconds - Chirilo 
    setTimeout(function(){
      $('.fancybox-close').trigger('click');
    }, 5000);

  }*/

  /* ICYMI - Dirty fix for showing specific logo on ICYMI page */
  var newthispath = "<?php echo current_path(); ?>";
  if(newthispath == 'node/509359'){
    var asd = $("#logo img").attr('src');
    var newsrc = '/sites/default/files/field/image/icymi/ICYMI_logo.png';
    $('#logo img').attr('src', '/sites/default/files/field/image/icymi/ICYMI_logo.png');
  }

  /*  Religion  Taxonomy Term Page - Dec 27, 2016 - Chi Rilo */
  if( newthispath == 'taxonomy/term/3743' ) {
    var asd = $("#logo img").attr('src');
    var newsrc = '/sites/default/files/field/image/religion/religion-logo.png';
    $('#logo img').attr('src', '/sites/default/files/field/image/religion/religion-logo-black.png');
  }


  /* Slick Slideshow Thumbnail and Caption Link - Chirilo September 19, 2016 */
  $('#slick-views-slideshow-1-thumbnail .slick-list div.slick__slide').each(function(){
      $(this).on('click', function(e){
        e.preventDefault();
      });
      $(this).on('dblclick', function(e){
        e.preventDefault();
        var link = 'http://www.sunstar.com.ph'+$(this).children('a').attr('href');
        //console.log('adasdsa'+link);
        window.open(
          link,
          '_blank' // <- This is what makes it open in a new window.
        );
      });
  });

  /* Disqus - This is the script which loads the Disqus comments/comments thread on element show-comments click - Chirilo September 9, 2016 */
  $('.show-comments').on('click', function(){
      // show fb and disclaimer
      $('.fb-comments').show();

      var disqus_shortname = 'sunstarphilippines'; // Replace this value with *your* username.

      // ajax request to load the disqus javascript
      $.ajax({
        type: "GET",
        url: "http://" + disqus_shortname + ".disqus.com/embed.js",
        dataType: "script",
        cache: true
      });
      // hide the button once comments load
      $(this).fadeOut();
  });

  
  /* animate showing of nav header to avoid showing placing of elements dynamically - Chi Jan 20, 2017 */
  $('#nav_desktop').hide();
  setTimeout(function(){
      if( $('#nav_desktop').is(':hidden') ) {
        $('#nav_desktop').fadeIn('slow');
      }
  },1500);

  var mediaQueryTemplate = '\
  @media (max-width:767px) { \
      #nav_desktop{ display: none !important } \
  } \
  ';


});
</script>
<script type="text/javascript">
  $('.responsive').slick({
    infinite: false,
    speed: 300,
    slidesToShow: 6,
    slidesToScroll: 6,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 4,
          infinite: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });

  
  
</script>

</body>
</html>
