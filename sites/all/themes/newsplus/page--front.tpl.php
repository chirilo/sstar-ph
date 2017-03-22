<?php
    /* SunStar Affiliates location - Chirilo March 3, 2017 */
    $exploded_location = explode('-', $location);
    /* For SunStar Affiliates */
    if (strpos($location, 'CAGAYAN') !== false) {
        //echo 'true';
        $sunstar_aftlocation = 'CAGAYAN <span class="sunstar_aft_deoro">DE ORO</span>';
    }
    else if(strpos($location, 'SUPERBALITA') !== false && strpos($location, 'CAGAYAN') !== false) {
        $sunstar_aftlocation = 'CAGAYAN <span class="sunstar_aft_deoro">DE ORO</span>';
    }
    else if(strpos($location, 'SUPERBALITA') !== false && strpos($location, 'CAGAYAN') !== true) {
        $sunstar_aftlocation = $exploded_location[1];
    }
    else if (strpos($location, 'SEARCH') !== false || strpos($location, 'AUTHOR') !== false) {
        $sunstar_aftlocation = 'PHILIPPINES';
    }
    else{
        $sunstar_aftlocation = $location;
    }


    
    /* For SuperBalita Affiliates */
    if (strpos($location, 'SUPERBALITA') !== false) {
        $new_site_name = 'SuperBalita ';
    }
    else{
        $new_site_name = $new_site_name;
    }

    //echo $new_site_name.' '.$sunstar_aftlocation;
    //exit();
?>
<style type="text/css">

    @font-face {
      font-family: 'Ziggurat-HTF-Black'; 
      src: url('http://www.sunstar.com.ph/sites/all/themes/newsplus/fonts/Ziggurat/Ziggurat-HTF-Black.otf') format("opentype"); /* IE9 Compat Modes */
      /*src: url('sites/all/themes/newsplus/fonts/Ziggurat/ufonts.com_ziggurat-htf-black.eot');*/ /* IE9 Compat Modes */
      /*src: url('sites/all/themes/newsplus/fonts/Ziggurat/ufonts.com_ziggurat-htf-black.ttf')  format('truetype'),*/ /* Safari, Android, iOS */
    }
    #main-navigation ul.sf-menu li a.menuparent:after, #pre-header ul.sf-menu li a.menuparent:after, #header-top ul.sf-menu li a.menuparent:after {
        visibility: hidden;
    }

    .sunstar_tlogo {
        font-family: 'Ziggurat-HTF-Black';
        /*font-size: 35px;*/
        color: #000000 !important;
        letter-spacing: 0.5px;
    }

    .sunstar_aftlogo {
        font-family: 'Ziggurat-HTF-Black';
        /*font-size: 35px;*/
        color: #0967b2 !important;
        letter-spacing: 0.5px;
    }

    .sunstar_paftlogo {
        /*font-size: 38px;*/
        color: #0967b2 !important;
        letter-spacing: 0px;
    }

    .sunstar_tlogo_mob {
        font-size: 38px;
    }

    .sunstar_aft_deoro{
        text-decoration: overline;
        color: #0967b2 !important;
        /*font-size: 30px;*/
    }

    #nav_desktop, #nav_mobile {
         background-color: #FFDD17 !important;
    }
    
    @media (max-width:992px){div#block-block-8 .content > .navigation-social-bookmarks > ul.social-bookmarks li a i.fa-facebook,div#block-block-8 .content > .navigation-social-bookmarks > ul.social-bookmarks li a i.fa-twitter,div#block-block-8 .content > .navigation-social-bookmarks > ul.social-bookmarks li a i.fa-youtube-play,div#block-block-8 .content > .navigation-social-bookmarks {display: inline-block;}}

    #main-content{
        background-color: #fff !important;
    }

    #main-navigation ul.menu li a{
        padding: 15px 6.5px 15px !important;
    }

    .sticky-title-noimage-section{
        padding-top: 30px !important;
    }
    .sticky-title-noimage-section a, .sticky-title-noimage-section a:hover, .sticky-title-noimage-section:hover{
        text-decoration: none !important;
    }

    .sf-menu li a{
        text-transform: uppercase;
        font-weight: bolder;
    }
    div#toolbar div.toolbar-shortcuts ul,
    .toolbar-shortcuts ul.menu li a {
        padding: 2px 5px 2px 5px !important; 
    }
    
    ul.menu li a{
        padding: 7px 11px 8px 11px !important;
    }

    .menu_simple a{
        font-size: 17px !important;
        text-decoration: none !important;
    }
    .menu_simple h4 {
        margin: -10px 0 10px 0 !important;
    }

    .item-list.affiliate_banner ul li a{
        margin: -0.5em 0 0 0;
        line-height: 35px;
        text-decoration: none;
    }
    .item-list.affiliate_banner ul li a:hover{
        text-decoration: none;
    }

    /*#page>.container{
        background-color: transparent !important;
    }*/

    #page-intro-inside {
        background-color: transparent !important;
    }

    .affiliate_banner ul > li .views-field > .field-content > p, .view-display-id-block_5 .view-content > .views-row > .views-field-body > .field-content > p, .view-display-id-block_6 .view-content > .views-row > .views-field-body > .field-content > p, .view-display-id-block_7 .view-content > .views-row > .views-field-body > .field-content > p, .view-display-id-block_2 > .view-content > div#slideshow > .flexslider ul > li > .views-field > .field-content{
        font-size: 17px !important;
        color: #3f3f3f !important;
    }

    .view-countr-news > .view-content > .views-view-grid .row-2 > .col-1 > .views-field-name span a{
        color: #0967b2 !important;
    }
    .view-countr-news > .view-content > .views-view-grid .row-1 > .col-1 > .views-field-name span a, .view-countr-news > .view-content > .views-view-grid .row-1 > .col-2 > .views-field-name span a, .view-countr-news > .view-content > .views-view-grid .row-2 > .col-1 > .views-field-name span a, .view-countr-news > .view-content > .views-view-grid .row-2 > .col-2 > .views-field-name span a, .view-countr-news > .view-content > .views-view-grid .row-3 > .col-1 > .views-field-name span a, .view-countr-news > .view-content > .views-view-grid .row-3 > .col-2 > .views-field-name span a, .view-countr-news > .view-content > .views-view-grid .row-4 > .col-1 > .views-field-name span a, .view-countr-news > .view-content > .views-view-grid .row-4 > .col-2 > .views-field-name span a, .view-countr-news > .view-content > .views-view-grid .row-5 > .col-1 > .views-field-name span a, .view-countr-news > .view-content > .views-view-grid .row-5 > .col-2 > .views-field-name span a, .view-countr-news > .view-content > .views-view-grid .row-6 > .col-1 > .views-field-name span a, .view-countr-news > .view-content > .views-view-grid .row-6 > .col-2 > .views-field-name span a, .view-id-countr_news .view-content > .views-row > .views-field-name > span a{
        color: #0967b2 !important;
        text-decoration: none;
    }

    /*a, .field-name-field-mt-post-categories.field-type-taxonomy-term-reference a, ul.links li.statistics_counter span{
        color: #0967b2 !important;
    }*/
    /*.field-content a {
        color: #0967b2 !important;
    }*/
    .col-md-6 h4{
        color: #3f3f3f !important;
        font-size: 18px !important;
    }

    h1 {
        line-height: 50px !important;
        text-decoration: none !important;
    }

    span {
        color: #3f3f3f !important;
    }

    .field-items p{
        margin-bottom: 0px !important;
        font-size: 15px !important;
    }

    #header {
        background-color: #0967b2;
        border-bottom: 0px solid #0967b2;
    }
    #header-inside {
        background-color: #0967b2;
    }

    #main-navigation ul.menu li:hover {
        background-color: #FFDD17 !important;
    }
    .input-group-addon:hover {
        cursor: pointer;
    }

    #block-superfish-2 ul#superfish-2 > li > a{
        font-family: 'Tungsten-Semibold' !important;
        font-size: 22px;
        font-weight: 600;
        color: #98C1E0; /* default color of Affiliate Menus */
        padding: 0px 20px 15px 18px !important;
    }

    #block-superfish-2 ul#superfish-2 > li > a:hover,
    #block-superfish-2 ul#superfish-2 > li > a:active,
    #block-superfish-2 ul#superfish-2 > li > a:focus {
        color: #0967b2; /* by default, if menus are on the BLUE bar, #fff will be used */
        background-color: transparent !important;
    }

    /*ul#superfish-1 {
        width: 1024px;
    }
    @media (max-width: 1228px) {
        #nav_desktop{
            display: none;
        }
        #nav_mobile {
            display: none;
        }
        #block-superfish-2{
            padding: 0px 20px 15px 18px !important;
        }

        #block-superfish-1 ul#superfish-1 > li > a {
            padding: 15px 8.5px 15px !important;
        }

        #block-superfish-2 ul#superfish-2 > li > a{
            padding: 0px 20px 15px 18px !important;
            font-size: 22px !important;
        }
    }

    @media (min-width: 1024px) {
        #nav_desktop{
            display: none;
        }
        #nav_mobile {
            display: none;
        }

        #attr-nav{
            display: none !important;
        }

        nav.navbar .navbar-brand img.logo {
            width: 65% !important;
            margin-left: -15%;
            margin-top: 0%;
            display: inline-block;
        }
        #block-superfish-2{
            padding: 0px 0px 5px 0px !important;
        }

        #block-views-mt-breaking-block{
            padding: 0px 0px 10px 0px !important;
            margin-top: -5px !important; 
        }

        nav.navbar.bootsnav.menu-center .navbar-header,
        nav.navbar.bootsnav.menu-center .attr-nav{
            
        }

        #block-superfish-2 ul#superfish-2 > li > a{
            padding: 0px 20px 15px 15px !important;
            font-size: 20px !important;
        }

        #main-navigation ul.menu li a {
            padding: 15px 5px 15px !important;
            font-size: 11px !important;
        }

    }

    @media (max-width: 1082px) {
        #block-superfish-2 ul#superfish-2 > li > a{
            padding: 0px 11px 15px 11px !important;
        }
        #block-superfish-1 ul#superfish-1 > li > a {
            padding: 13px 3px 8px !important
            font-size: 11px !important;
        }

        #block-superfish-2 ul#superfish-2 > li > a {
            font-size: 18px;
            font-weight: 700;
            padding: 0px 15px 15px 15px !important;
            font-size: 18px !important;
        }
    }

    @media (min-width: 768px) and (max-width: 992px) {
        #nav_desktop{
            display: none !important;
        }
        #nav_mobile {
            display: block;
        }
           
        #attr-nav{
            display: none !important;
        }

        .sidebar-second #highlighted {
            margin-left: 0px !important;
        }

        .header-area ul.social-bookmarks li{
            margin: -20px 10px 5px 0 !important;
        }

        #block-superfish-2 ul#superfish-2 > li > a {
            font-size: 18px !important;
            font-weight: 700;
            padding: 0px 15px 15px 15px !important;
        }
    }

    @media (max-width: 767px)  {
        #nav_desktop{
            display: none !important;
        }
        #nav_mobile {
            display: block;
        }
        #attr-nav{
            display: none !important;
        }

        .header-area ul.social-bookmarks li{
            margin: -20px 10px 5px 0 !important;
        }

        #block-superfish-2 ul#superfish-2 > li > a {
            font-size: 18px;
            font-weight: 700;
            padding: 0px 15px 15px 15px !important;
        }

    }*/

    ul#superfish-1 {
        width: 1024px;
    }
    @media (max-width: 1228px) {
        #nav_desktop{
            display: none;
        }
        #nav_mobile {
            display: none;
        }
        #block-superfish-2{
            padding: 0px 20px 15px 18px !important;
        }

        #block-superfish-1 ul#superfish-1 > li > a {
            padding: 15px 8.5px 15px !important;
        }

        #block-superfish-2 ul#superfish-2 > li > a{
            padding: 0px 20px 15px 18px !important;
            font-size: 22px !important;
        }
    }

    @media (min-width: 1024px) {
        #nav_desktop{
            display: none;
        }
        #nav_mobile {
            display: none;
        }

        .sunstar_tlogo {
            font-size: 35px;
        }
        .sunstar_aftlogo {
            font-size: 35px;
        }

        .sunstar_paftlogo {
            font-size: 38px;
        }

        .sunstar_aft_deoro {
            font-size: 30px;
        }

        #attr-nav{
            display: none !important;
        }

        nav.navbar .navbar-brand a.logo {
            width: 65% !important;
            margin-left: -15%;
            margin-top: 0%;
            display: inline-block;
        }
        #block-superfish-2{
            padding: 0px 0px 5px 0px !important;
        }

        #block-views-mt-breaking-block{
            padding: 0px 0px 10px 0px !important;
            margin-top: -5px !important; 
        }

        nav.navbar.bootsnav.menu-center .navbar-header,
        nav.navbar.bootsnav.menu-center .attr-nav{
            /*position: relative !important;*/
        }

        #block-superfish-2 ul#superfish-2 > li > a{
            padding: 0px 10px 15px 15px !important;
            font-size: 20px !important;
        }

        #main-navigation ul.menu li a {
            padding: 15px 5px 15px !important;
            font-size: 11px !important;
        }

    }

    /*@media (max-width: 1082px) {
        #block-superfish-2 ul#superfish-2 > li > a{
            padding: 0px 11px 15px 11px !important;
        }
        #block-superfish-1 ul#superfish-1 > li > a {
            padding: 13px 3px 8px !important
            font-size: 11px !important;
        }

        #block-superfish-2 ul#superfish-2 > li > a {
            font-size: 18px;
            font-weight: 700;
            padding: 0px 15px 15px 15px !important;
            font-size: 18px !important;
        }
    }*/

    @media (max-width: 320px){
        .sunstar_tlogo {
            font-size: 17px;
        }
        .sunstar_aftlogo {
            font-size: 17px;
        }

        .sunstar_paftlogo {
            font-size: 17px;
        }

        .sunstar_aft_deoro {
            font-size: 15px;
        }
        .sunstar_tlogo_mob {
            font-size: 38px;
        }
    }

    @media (min-width: 768px) and (max-width: 992px) {
        #nav_desktop{
            display: none !important;
        }
        #nav_mobile {
            display: block;
        }
        .col-md-1 {
            display: none;
        }

        .sunstar_tlogo {
            font-size: 17px;
        }
        .sunstar_aftlogo {
            font-size: 17px;
        }
        .sunstar_paftlogo {
            font-size: 17px;
        }

        ..sunstar_aft_deoro {
            font-size: 15px;
        }

        /*nav.navbar .navbar-brand img.logo{
            width: 90% !important;
            margin-left: -5%;
        } */  
        #attr-nav{
            display: none !important;
        }

        .sidebar-second #highlighted {
            margin-left: 0px !important;
        }

        /*.header-area ul.social-bookmarks li{
            margin: -20px 10px 5px 0 !important;
        }*/

        #block-superfish-2 ul#superfish-2 > li > a {
            font-size: 18px !important;
            font-weight: 700;
            padding: 0px 15px 15px 15px !important;
        }
    }

    @media (max-width: 320px) {
        /*.header-area ul.social-bookmarks li{
            margin: 0px 10px -5px 0 !important;
        }*/
        #block-block-8 .content > .navigation-social-bookmarks > ul.social-bookmarks > li {
            margin: 0px 10px -5px 0 !important;
        }
    }
    @media(min-width: 320px) and (max-width: 414px) {
        .sunstar_tlogo {
            font-size: 10px;
        }
        .sunstar_aftlogo {
            font-size: 10px;
        }
        .sunstar_paftlogo {
            font-size: 10px;
        }

        .sunstar_aft_deoro {
            font-size: 8px;
        }
    }
    @media (max-width: 767px)  {
        #nav_desktop{
            display: none !important;
        }
        #nav_mobile {
            display: block;
        }
        #attr-nav{
            display: none !important;
        }

        .header-area ul.social-bookmarks li{
            margin: -20px 10px 5px 0 !important;
        }

        #block-superfish-2 ul#superfish-2 > li > a {
            font-size: 18px;
            font-weight: 700;
            padding: 0px 15px 15px 15px !important;
        }
        #sunstar_logo_svg {
            display: none;
        }
    }

    @media (min-width: 768px) and (max-width: 768px) {
        #sunstar_logo_svg {
            display: none;
        }
    }

</style>

<!-- Bootsnavs -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css" rel="stylesheet">
<link href="http://www.sunstar.com.ph/sites/all/themes/newsplus/bootsnav/css/animate.css" rel="stylesheet">
<link href="http://www.sunstar.com.ph/sites/all/themes/newsplus/bootsnav/css/bootsnav.css" rel="stylesheet">
<link href="http://www.sunstar.com.ph/sites/all/themes/newsplus/bootsnav/css/style.css" rel="stylesheet">

<link href="http://www.sunstar.com.ph/sites/all/themes/newsplus/fonts/https/new/HCo_Tungsten_Complete/OpenType/style-new-t1.css" rel="stylesheet">
<link href="http://www.sunstar.com.ph/sites/all/themes/newsplus/fonts/https/new/commercial-type-1701-HPIOQC-web/1701-HPIOQC.css" rel="stylesheet">

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://www.sunstar.com.ph/sites/all/themes/newsplus/bootsnav/js/bootstrap.min.js"></script>
<script src="http://www.sunstar.com.ph/sites/all/themes/newsplus/bootsnav/js/bootsnav.js"></script>
<!--/ end of Bootsnavs -->

<script type="text/javascript">
    (function ($) {
        

        $('.input-group-addon i.fa-search').on('click', function(e){
            console.log('im clicked');
            $("#cse-search-box").submit();
        });
        
        
        $('#bar_mobile').on('click', function(e){
            // /$('#navbar-menu').toggle();
            
            if( $('#navbar-menu').hasClass('in') ){
                $('#navbar-menu').removeClass('in');
            }
            else{
                $('#navbar-menu').addClass('in');
            }
        });
    }(jQuery));
</script>



<?php if (theme_get_setting('scrolltop_display')): ?>
<div id="toTop"><i class="fa fa-play-circle fa-rotate-270"></i></div>
<?php endif; ?>

<?php if ($page['pre_header_left'] || $page['pre_header_right']):?>
<!-- #pre-header -->
<div id="pre-header" class="clearfix">
    <div class="container">

        <!-- #pre-header-inside -->
        <div id="pre-header-inside" class="clearfix">
            <div class="row">
                
                <?php if ($page['pre_header_left']) :?>
                <div class="<?php print $pre_header_left_grid_class; ?>">
                    <!-- #pre-header-left -->
                    <div id="pre-header-left" class="clearfix">
                        <div class="pre-header-area">
                            <?php print render($page['pre_header_left']); ?>
                        </div>
                    </div>
                    <!-- EOF:#pre-header-left -->
                </div>
                <?php endif; ?>
            
            
                <?php if ($page['pre_header_right']) :?>
                <div class="<?php print $pre_header_right_grid_class; ?>">
                    <!-- #pre-header-right -->
                    <div id="pre-header-right" class="clearfix">
                        <div class="pre-header-area">                    
                            <?php print render($page['pre_header_right']); ?>
                        </div>
                    </div>
                    <!-- EOF:#pre-header-right -->
                </div>
                <?php endif; ?>
            
            </div>
        </div>
        <!-- EOF: #pre-header-inside -->

    </div>
</div>
<!-- EOF: #pre-header -->
<?php endif; ?>


<!-- Custom Header -->
<!-- Start Navigation -->
<nav id="nav_desktop" class="navbar navbar-default brand-center center-side bootsnav">
    <!-- Start Top Search -->
    <form action="<?php $_SERVER['SERVER_NAME'];?>/search" id="cse-search-box">   
        <input type="hidden" name="cx" value="partner-pub-2836569479021745:1006360187" />
        <input type="hidden" name="cof" value="FORID:10" />
        <input type="hidden" name="ie" value="UTF-8" />
        <?php /*<input type="text" name="as_q" style="width: 90%;  float: left;  display: inline-block;" class="searchboxcolor"/>
        <button type="submit" name="sa" style="background: transparent;border: none;display: inline-block; color: #3f3f3f;" ><i class="fa fa-search"></i></button>*/ ?>
        <div id="top-search" class="top-search">
            <div class="container">
                <div class="input-group">
                    <span class="input-group-addon" style="color: #FFDD17 !important;"><i class="fa fa-search"><input style="display: none;" type="submit" name="sa" /></i></span>
                    <input type="text" name="as_q" class="form-control" placeholder="Search">
                    <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                </div>
            </div>
        </div>
    </form>
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">google.load("elements", "1", {packages: "transliteration"});</script>
    <script type="text/javascript" src="http://www.google.com/cse/t13n?form=cse-search-box&t13n_langs=en"></script>
    <script type="text/javascript" src="http://www.google.com.ph/coop/cse/brand?form=cse-search-box&amp;lang=en"></script>
    <!-- End Top Search -->

    <div class="container">

        <!-- <div id="attr-nav" class="attr-nav">
            <ul>
                <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
            </ul>
        </div> -->

        <!-- Start Header Navigation -->
        <!-- <div class="navbar-header"> -->
        <div class="navbar-header" style="margin-top: 20px; margin-bottom: 0px;">
            <!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav" style="background-color: transparent !important;">
                <i class="fa fa-bars"></i>
            </button> -->
            <a class="navbar-brand" href="#brand">
                <?php /*<img class="logo" src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>"  />*/ ?>
                <span class="sunstar_tlogo"><?php echo $new_site_name ;?></span>
                <span class="sunstar_aftlogo <?php echo ($sunstar_aftlocation === 'PHILIPPINES') ? 'PublicoText-Bold-Web' : '';?>">
                    <?php echo $sunstar_aftlocation; ?>
                </span>
            </a>
            
        </div>
        <!-- End Header Navigation -->

        <!-- Collect the nav links, forms, and other content for toggling -->
        <!-- <div class="collapse navbar-collapse"> -->
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-left" data-in="fadeInDown" data-out="fadeOutUp">
                <?php /*<li class="dropdown megamenu-fw">
                    <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></a> -->
                    <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown"> -->*/ ?>
                <li>
                    <a href="#" style="padding-left: 0px;">
                        <img src="http://www.sunstar.com.ph/sites/all/themes/newsplus/bootsnav/images/sections-140x40.png" />
                    </a>
                    <?php /*<ul style="display: none;" class="dropdown-menu megamenu-content" role="menu">
                        <li>
                            <div style="display: none;"  class="row">
                                <div class="col-menu col-md-12">
                                    <h6 class="title">Section 1</h6>
                                    <div class="content">
                                        <ul class="menu-col">
                                            <li><a href="#">Custom Menu</a></li>
                                            <li><a href="#">Custom Menu</a></li>
                                            <li><a href="#">Custom Menu</a></li>
                                            <li><a href="#">Custom Menu</a></li>
                                            <li><a href="#">Custom Menu</a></li>
                                            <li><a href="#">Custom Menu</a></li>
                                        </ul>
                                    </div>
                                </div><!-- end col-3 -->
                            </div><!-- end row -->
                        </li>
                    </ul>*/ ?>
                </li>
                <li>
                    <!-- Start Atribute Navigation -->
                    <div class="attr-nav">
                        <ul>
                            <li><a href="http://epaper.sunstar.com.ph/epaper/viewer.aspx" target="_blank"><img src="sites/all/themes/newsplus/bootsnav/images/todays-paper-180x40.png" /></a></li>
                            <?php /*<li><a href="#"><img src="sites/all/themes/newsplus/bootsnav/images/weather-67x40.png" /><!-- <i class="fa fa-sun-o"></i> --></a></li>*/ ?>
                            <li class="search"><a href="#"><img src="http://www.sunstar.com.ph/sites/all/themes/newsplus/bootsnav/images/search-31x40.png" /><!-- <i class="fa fa-search"></i> --></a></li>
                        </ul>
                    </div>
                    <div><span style="font-family: Tungsten-Semibold; font-size: 25px; margin-right: 30%; color: #000;"><?php echo date("D, F j, Y");?></span></div>
                    <!-- End Atribute Navigation -->
                </li>
            </ul>
            
        </div><!-- /.navbar-collapse -->
    </div>   
</nav>
<!-- End Navigation -->

<nav id="nav_mobile" class="navbar navbar-default bootsnav" style="background-color: #FFDD17;">
    <!-- Start Top Search -->
    <form action="<?php $_SERVER['SERVER_NAME'];?>/search" id="cse-search-box">   
        <input type="hidden" name="cx" value="partner-pub-2836569479021745:1006360187" />
        <input type="hidden" name="cof" value="FORID:10" />
        <input type="hidden" name="ie" value="UTF-8" />
        <?php /*<input type="text" name="as_q" style="width: 90%;  float: left;  display: inline-block;" class="searchboxcolor"/>
        <button type="submit" name="sa" style="background: transparent;border: none;display: inline-block; color: #3f3f3f;" ><i class="fa fa-search"></i></button>*/ ?>
        <div id="top-search" class="top-search">
            <div class="container">
                <div class="input-group">
                    <span class="input-group-addon" style="color: #FFDD17 !important;"><i class="fa fa-search"><input style="display: none;" type="submit" name="sa" /></i></span>
                    <input type="text" name="as_q" class="form-control" placeholder="Search">
                    <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                </div>
            </div>
        </div>
    </form>
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">google.load("elements", "1", {packages: "transliteration"});</script>
    <script type="text/javascript" src="http://www.google.com/cse/t13n?form=cse-search-box&t13n_langs=en"></script>
    <script type="text/javascript" src="http://www.google.com.ph/coop/cse/brand?form=cse-search-box&amp;lang=en"></script>
    <!-- End Top Search -->
    <div class="container">  
        
        <!-- Start Atribute Navigation -->
        <div class="attr-nav">
            <ul>
                <?php /*<li><a href="http://epaper.sunstar.com.ph/epaper/viewer.aspx" target="_blank"><i class="fa fa-folder"></i></a></li>
                <li><a href="#"><i class="fa fa-sun-o"></i></a></li>*/?>
                <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
            </ul>
        </div>        
        

        <!-- End Atribute Navigation -->

        
        <!-- Start Header Navigation -->
        <div class="navbar-header">
            <?php /*<button id="bar_mobile" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu" style="background-color: transparent !important;">
                <i class="fa fa-bars"></i>
            </button>*/ ?>
            <button id="bar_mobile" type="button" class="navbar-toggle" data-toggle="" data-target="" style="background-color: transparent !important;">
                <i class="fa fa-bars"></i>
            </button>
            <!-- <a class="navbar-brand sunstar_tlogo sunstar_tlogo_mob" href="#brand">S</a> -->
        </div>
        <div class="navbar-header" style="margin-top: -40px; margin-bottom: -10px;">
            <a class="navbar-brand" href="#brand">
                <span class="sunstar_tlogo"><?php echo $new_site_name ;?></span>
                <span class="sunstar_aftlogo <?php echo ($sunstar_aftlocation === 'PHILIPPINES') ? 'PublicoText-Bold-Web' : '';?>">
                    <?php echo $sunstar_aftlocation; ?>
                </span>
            </a>
        </div>
        <!-- End Header Navigation -->

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-menu">
            <!-- <ul class="nav navbar-nav navbar-center"> -->
            <ul class="nav navbar-nav navbar-left" data-in="fadeInDown" data-out="fadeOutUp" style="background-color: #FFDD17;">
                <li><a href="http://www.sunstar.com.ph/">Home</a></li>                    
                <li><a href="http://www.sunstar.com.ph/latest-news">News</a></li>
                <li><a href="#">Business</a></li>
                <li><a href="#">Opinion</a></li>
                <li><a href="#">Sports</a></li>
                <li><a href="#">Feature</a></li>
                <li><a href="#">Lifestyle</a></li>
                <li><a href="#">Entertainment</a></li>
                <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" >Superbalita</a>
                        <ul class="dropdown-menu">
                            <li><a href="/superbalita-cagayan-de-oro">Cagayan de Oro</a></li>
                            <li><a href="/superbalita-cebu">Cebu</a></li>
                            <li><a href="/superbalita-davao">Davao</a></li>
                            
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" >SunStar</a>
                        <ul class="dropdown-menu">
                            <li><a href="/cebu">Cebu</a></li>
                            <li><a href="/bacolod">Bacolod</a></li>
                            <li><a href="/baguio">Baguio</a></li>
                            <li><a href="/cagayan-de-oro">Cagayan de Oro</a></li>
                            <li><a href="/davao">Davao</a></li>
                            <li><a href="/dumaguete">Dumaguete</a></li>
                            <li><a href="/iloilo">Iloilo</a></li>
                            <li><a href="/manila">Manila</a></li>
                            <li><a href="/pampanga">Pampanga</a></li>
                            <li><a href="/tacloban">Tacloban</a></li>
                            <li><a href="/zamboanga">Zamboanga</a></li>
                            
                        </ul>
                    </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>   
</nav>

<nav id="for_mobile_sub" class="navbar navbar-default bootsnav" style="background-color: #0967b2; display: none;">
  
        <div class="container">  
            
            
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu-2">
                <ul class="nav navbar-nav navbar-center">
                    <li><a href="/bacolod">BACOLOD <span>/</span> </a></li>                    
                    <li><a href="/baguio">BAGUIO <span>/</span> </a></li>
                    <li><a href="cagayan-de-oro">CAGAYAN DE ORO <span>/</span> </a></li>
                    <li><a href="/cebu">CEBU <span>/</span> </a></li>
                    <li><a href="/davao">DAVAO <span>/</span> </a></li>
                    <li><a href="/dumaguete">DUMAGUETE <span>/</span> </a></li>
                    <li><a href="/iloilo">ILOILO <span>/</span> </a></li>
                    <li><a href="/manila">MANILA <span>/</span> </a></li>
                    <li><a href="/pangasinan">PANGASINAN <span>/</span> </a></li>
                    <li><a href="/pampanga">PAMPANGA <span>/</span> </a></li>
                    <li><a href="/tacloban">TACLOBAN <span>/</span> </a></li>
                    <li><a href="/zamboanga">ZAMBOANGA</a></li>
                    
                </ul>
            </div><!-- /.navbar-collapse -->

            
        </div>   
    </nav>

<!-- EOF: Custom Header -->


<!-- #header-top -->
<header style="display: none;" id="header-top" role="banner" class="clearfix">
    <div class="container">

        <!-- #header-top-inside -->
        <div id="header-top-inside" class="clearfix">
            <div class="row">
            
                <div class="<?php print $header_top_inside_left_grid_class; ?>">
                    <!-- #header-top-left -->
                    <div id="header-top-left" class="clearfix">
                        <div class="header-top-area">

                            
                            <div id="logo-and-site-name-wrapper" class="clearfix">
                                <div id="site-name" style="margin: 0 auto !important; float: left !important;">
                                    <a href="#">
                                        <ul style="list-style-type: none; padding-left: 0px;">
                                            <li style="float: left;">
                                                <!-- <img id="section-btn" src="sites/default/files/logos/newdesign/sections-btn.png" alt="Section" /> -->
                                                <!-- <img src="http://www.sunstar.com.ph/sites/all/themes/newsplus/bootsnav/images/brand/Sunstar_Logo_ (Black&Yellow)_Version_3.svg" alt="SunStar Brand" /> -->
                                            </li>
                                            <!-- <li style="float: left;"><img src="sites/default/files/logos/newdesign/sections-text.png" alt="Sections" /></li> -->
                                        </ul>
                                    </a>
                                </div>
                                <?php if ($logo):?>
                                <!-- <div id="logo" style="padding-top: 10px;" data-bg-img="../sites/default/files/logos/newdesign"> -->
                                <div id="logo" style="padding-top: 10px;">
                                
                                    <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home">
                                        <img class="logo" src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
                                    </a>
                                </div>

                                <div id="todays-paper" style="margin: 0 auto !important; float: right !important;">
                                    <ul style="list-style-type: none; padding-top: 5px;">
                                        <li>
                                            <img src="sites/default/files/logos/newdesign/todays-paper-weather-search.png" />
                                            
                                        </li>
                                        <li style="letter-spacing: 2px; color: #000; text-align: left; padding-left: 10px;"><?php echo date("D, F j, Y");?></li>
                                    </ul>
                                </div>
                                
                                <?php endif; ?>
                                
                                

                                <?php if ($site_name):?>
                                <!-- <div id="site-name"> -->
                                <div>
                                <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>"><?php print $site_name; ?></a>
                                </div>
                                <?php endif; ?>
                                
                                <?php if ($site_slogan):?>
                                <div id="site-slogan">
                                <?php print $site_slogan; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            
                            <?php if ($page['header_top_left']) :?>
                            <?php print render($page['header_top_left']); ?>
                            <?php endif; ?>

                        </div>
                    </div>
                    <!-- EOF:#header-top-left -->
                </div>
            
            
                <?php if ($page['header_top_right']) :?>
                <div class="col-md-6">
                    <!-- #header-top-right -->
                    <div id="header-top-right" class="clearfix">
                        <div class="header-top-area">                    
                            <?php print render($page['header_top_right']); ?>
                        </div>
                    </div>
                    <!-- EOF:#header-top-right -->
                </div>
                <?php endif; ?>
            
            </div>
        </div>
        <!-- EOF: #header-top-inside -->

    </div>
</header>
<!-- EOF: #header-top -->

<!-- #header -->
<header id="header">

    <?php if (!$is_front): ?>
    <div id="homeMobile"><a href="/"><i class="fa fa-home fa-rotate-360"></i></a></div>
    <?php endif; ?> 
            
    <?php if ($site_name):?>
    <div id="navigation-site-name">
    <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>"><?php print $site_name; ?></a>
    </div>
    <?php endif; ?>

    <div class="container">
        
        <!-- #header-inside -->
        <div id="header-inside" class="clearfix">
            <div class="row">
                <div class="header-area">
                    <div class="col-md-1">
                        <img id="sunstar_logo_svg" src="http://www.sunstar.com.ph/sites/all/themes/newsplus/bootsnav/images/brand/Sunstar_Logo_ (Black&amp;Yellow)_Version_3.svg" style="max-width: 75%; padding: 5px;" />
                    </div>
                    <div class="<?php print $header_inside_left_grid_class; ?>">
                        <!-- #header-inside-left -->
                        <div id="header-inside-left" class="clearfix">
                            <!-- #main-navigation -->
                            <div id="main-navigation" class="clearfix">
                                <nav role="navigation"> 
                                    <?php if ($page['navigation']) :?>
                                    <?php print render($page['navigation']); ?>
                                    <?php else : ?>
                                    <div id="main-menu">
                                    <?php print theme('links__system_main_menu', array('links' => $main_menu, 'attributes' => array('class' => array('main-menu', 'menu'), ), 'heading' => array('text' => t('Main menu'), 'level' => 'h2', 'class' => array('element-invisible'), ), )); ?>
                                    </div>
                                    <?php endif; ?>
                                </nav>
                            </div>
                            <!-- EOF: #main-navigation -->
                        </div>
                        <!-- EOF:#header-inside-left -->
                    </div>

                    <?php if ($page['header']) :?>                
                    <div class="col-md-3">
                        <!-- #header-inside-right -->
                        <div id="header-inside-right" class="clearfix">
                        <?php print render($page['header']); ?>
                        </div>
                        <!-- EOF:#header-inside-right -->                        
                    </div>
                    <?php endif; ?>
                    
                </div>
            </div>
        </div>
        <!-- EOF: #header-inside -->

    </div>
</header>
<!-- EOF: #header -->


<?php if ($page['page_intro']) :?> 
<!-- #page-intro -->
<div id="page-intro" class="clearfix">
    
    <div class="container">
        <div class="row">
            
            <!-- #page-intro-inside -->
            <div id="page-intro-inside" class="clearfix">
                <?php print render($page['page_intro']); ?>
            </div>
            <!-- EOF: #page-intro-inside -->

        </div>
    </div>

</div>
<!-- EOF: #page-intro -->
<?php endif; ?>

<!-- #page -->
<div id="page" class="clearfix">
    
    

    <div class="container">
        
        <!-- #page-inside -->
        <div id="page-inside">

            <!-- #messages-console -->
            <?php if ($messages):?>
            <div id="messages-console" class="clearfix">

                <div class="row">
                    <div class="col-md-12">
                    <?php print $messages; ?>
                    </div>
                </div>

            </div>
            <?php endif; ?>
            <!-- EOF: #messages-console -->

            <?php if ($page['top_content']):?>
            <!-- #top-content -->
            <div id="top-content">

                <!-- #top-content-inside -->
                <div id="top-content-inside" class="clearfix">
                    <div class="row">
                        <div class="col-md-12">
                        <?php print render($page['top_content']); ?>
                        </div>
                    </div>
                </div>
                <!-- EOF:#top-content-inside -->

            </div>
            <!-- EOF: #top-content -->
            <?php endif; ?>

            <!-- #main-content -->
            <div id="main-content">

                <div class="row">

                    <?php if ($page['sidebar_first']):?>
                    <aside class="<?php print $sidebar_first_grid_class; ?>">
                        <!--#sidebar-->
                        <section id="sidebar-first" class="sidebar clearfix">
                        <?php print render($page['sidebar_first']); ?>
                        </section>
                        <!--EOF:#sidebar-->
                    </aside>
                    <?php endif; ?>

                    <section class="<?php print $main_grid_class; ?>">

                        <?php if ($breadcrumb && theme_get_setting('breadcrumb_display')):?> 
                        <!-- #breadcrumb -->
                        <div id="breadcrumb" class="clearfix">
                            <!-- #breadcrumb-inside -->
                            <div id="breadcrumb-inside" class="clearfix">
                            <?php print $breadcrumb; ?>
                            </div>
                            <!-- EOF: #breadcrumb-inside -->
                        </div>
                        <!-- EOF: #breadcrumb -->
                        <?php endif; ?>

                        <?php if ($page['banner']):?>
                        <!-- #banner -->
                        <div id="banner">
                            <!-- #banner-inside -->
                            <div id="banner-inside" class="clearfix">
                                <?php print render($page['banner']); ?>
                            </div>
                            <!-- EOF:#banner-inside -->
                        </div>
                        <!-- EOF: #banner -->
                        <?php endif; ?>

                        <?php if ($page['highlighted']):?>
                        <!-- #highlighted -->
                        <div id="highlighted">
                            <!-- #highlighted-inside -->
                            <div id="highlighted-inside" class="clearfix">
                                <?php print render($page['highlighted']); ?>
                            </div>
                            <!-- EOF:#highlighted-inside -->
                        </div>
                        <!-- EOF: #highlighted -->
                        <?php endif; ?>

                        <?php if ($page['promoted']):?>
                        <!-- #promoted -->
                        <div id="promoted" class="clearfix">
                            <!-- #promoted-inside -->
                            <div id="promoted-inside" class="clearfix">
                            <?php print render($page['promoted']); ?>
                            </div>
                            <!-- EOF: #promoted-inside -->
                        </div>
                        <!-- EOF: #promoted -->
                        <?php endif; ?>

                        <!-- #main -->
                        <div id="main" class="clearfix">

                            <?php print render($title_prefix); ?>
                            <?php if ($title): ?><h1 class="title" id="page-title"><?php print $title; ?></h1><?php endif; ?>
                            <?php print render($title_suffix); ?>

                            <!-- #tabs -->
                            <?php if ($tabs):?>
                                <div class="tabs">
                                <?php print render($tabs); ?>
                                </div>
                            <?php endif; ?>
                            <!-- EOF: #tabs -->

                            <?php print render($page['help']); ?>

                            <!-- #action links -->
                            <?php if ($action_links):?>
                                <ul class="action-links">
                                <?php print render($action_links); ?>
                                </ul>
                            <?php endif; ?>
                            <!-- EOF: #action links -->

                            <?php if (theme_get_setting('frontpage_content_print') || !drupal_is_front_page()):?> 
                            <?php print render($page['content']); ?>
                            <?php endif; ?>

                        </div>
                        <!-- EOF:#main -->

                    </section>

                    <?php if ($page['sidebar_second']):?>
                    <aside class="<?php print $sidebar_second_grid_class; ?>">
                        <!--#sidebar-->
                        <section id="sidebar-second" class="sidebar clearfix">
                        <?php print render($page['sidebar_second']); ?>
                        </section>
                        <!--EOF:#sidebar-->
                    </aside>
                    <?php endif; ?>
                    
                </div>

            </div>
            <!-- EOF:#main-content -->

        </div>
        <!-- EOF: #page-inside -->

    </div>

</div>
<!-- EOF: #page -->

<?php if ($page['footer_first'] || $page['footer_second'] || $page['footer_third'] || $page['footer_fourth']):?>
<!-- #footer -->
<footer id="footer" class="clearfix">
    <div class="container">

        <div class="row">
            <?php if ($page['footer_first']):?>
            <div class="<?php print $footer_grid_class; ?>">
                <div class="footer-area">
                <?php print render($page['footer_first']); ?>
                </div>
            </div>
            <?php endif; ?>      

            <?php if ($page['footer_second']):?>      
            <div class="<?php print $footer_grid_class; ?>">
                <div class="footer-area">
                <?php print render($page['footer_second']); ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($page['footer_third']):?>
            <div class="<?php print $footer_grid_class; ?>">
                <div class="footer-area">
                <?php print render($page['footer_third']); ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($page['footer_fourth']):?>
            <div class="<?php print $footer_grid_class; ?>">
                <div class="footer-area">
                <?php print render($page['footer_fourth']); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

    </div>
</footer> 
<!-- EOF #footer -->
<?php endif; ?>

<?php if ($page['sub_footer_left'] || $page['footer']):?>
<div id="subfooter" class="clearfix">
    <div class="container">
        
        <!-- #subfooter-inside -->
        <div id="subfooter-inside" class="clearfix">
            <div class="row">
                <div class="col-md-4">
                    <!-- #subfooter-left -->
                    <?php if ($page['sub_footer_left']):?>
                    <div class="subfooter-area left">
                    <?php print render($page['sub_footer_left']); ?>
                    </div>
                    <?php endif; ?>
                    <!-- EOF: #subfooter-left -->
                </div>
                <div class="col-md-8">
                    <!-- #subfooter-right -->
                    <?php if ($page['footer']):?>
                    <div class="subfooter-area right">
                    <?php print render($page['footer']); ?>
                    </div>
                    <?php endif; ?>
                    <!-- EOF: #subfooter-right -->
                </div>
            </div>
        </div>
        <!-- EOF: #subfooter-inside -->
    
    </div>
</div><!-- EOF:#subfooter -->
<?php endif; ?>