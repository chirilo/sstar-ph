<?php /*<link rel="stylesheet" href="sites/all/themes/newsplus/specials/religion/css/religion-style.css" />*/ ?>
<style type="text/css">
    /**
    * Religion Page Custom Styles
    * @author - Chi Rilo
    * @date - December 27, 2016
    * @desc - Custom CSS styling for Religion taxonomy term page
    */
    #header-top, #header {
        /*background-color: #FF8519 !important;
        border-bottom: 6px solid #FF8519;*/
        background: #87e0fd; /* Old browsers */
        background: -moz-linear-gradient(top, #87e0fd 0%, #53cbf1 40%, #05abe0 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top, #87e0fd 0%,#53cbf1 40%,#05abe0 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom, #87e0fd 0%,#53cbf1 40%,#05abe0 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#87e0fd', endColorstr='#05abe0',GradientType=0 );
    }
    a:hover, a:focus, ul.menu li.collapsed > a:before, ul.menu li.expanded > a:before, .subfooter-area ul.menu li a:hover, .field-name-field-mt-post-categories.field-type-taxonomy-term-reference a:hover, .views-field-title a:hover, .view-titles:after, ul.user-social-bookmarks li a:hover, .flex-direction-nav a, #internal-slider-carousel .flex-direction-nav a, #toTop, .item-list ul.quicktabs-tabs > li.active > a:after, .nav-tabs > li.active > a:after, .prev-node a:hover, .next-node a:hover, .node-navigation div:hover > .fa-angle-left, .node-navigation div:hover > .fa-angle-right{
        color: #000000 !important;
    }

    .item-list ul li:hover {
        background-color: #87e0fd !important;
    }

    #pre-header, #header-top, #main-navigation .sf-menu>li.sfHover>a, ul.menu li a:hover, ul.pager li > a:hover, ul.pager li.pager-current, .item-list ul li.pager-current.last, .field-type-taxonomy-term-reference a:hover, .view-taxonomy .views-row a:hover, .views-field-field-mt-post-categories a:hover, .view-titles .more-link a, .view-popular-objects .views-row:hover .views-field-field-mt-post-categories a, .view-feed .view-header p, .header-area ul.social-bookmarks li a:hover, .header-area ul.brands li a:hover, .overlay i, a.button:hover, input[type="submit"]:hover, input[type="reset"]:hover, input[type="button"]:hover, ul.links li a:hover, .more a:hover, .item-list ul.quicktabs-tabs > li > a:hover, .nav-tabs > li > a:hover, .item-list ul.quicktabs-tabs > li.active > a, .nav-tabs > li.active > a, .item-list ul.quicktabs-tabs > li.active > a:hover, .nav-tabs > li.active > a:hover, .panel-title a, .panel-heading a:hover, .flexslider:hover .flex-next:hover, .flexslider:hover .flex-prev:hover, .flex-control-paging li a:hover, .flex-control-paging li a.flex-active, .overlayed-teaser a:after, .checkout-buttons .checkout-cancel:hover, .checkout-buttons .checkout-back:hover, .post-progressbar{
        background-color: #87e0fd !important;
    }

    ul.links li a, .more a, ul.links li.statistics_counter span{
        background-color: #87e0fd !important;
    }
    ul.menu li a:hover, ul.pager li > a:hover {
        background-color: #87e0fd !important;
    }
    .item-list ul.quicktabs-tabs > li:hover {
        background-color: #87e0fd !important;
    }

    .item-list ul.quicktabs-tabs > li.active > a {
        border-color: #87e0fd;
        background: #87e0fd; /* Old browsers */
        background: -moz-linear-gradient(top, #87e0fd 0%, #53cbf1 40%, #05abe0 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top, #87e0fd 0%,#53cbf1 40%,#05abe0 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom, #87e0fd 0%,#53cbf1 40%,#05abe0 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#87e0fd', endColorstr='#05abe0',GradientType=0 );
    }
    
    .item-list ul.quicktabs-tabs {
        border-bottom: 3px solid #87e0fd;
    }

    #header{
        background: #eeeeee !important;
        border-bottom: 6px solid #87e0fd;
        /*background: #87e0fd;*/ /* Old browsers */
        /*background: -moz-linear-gradient(top, #87e0fd 0%, #53cbf1 40%, #05abe0 100%);*/ /* FF3.6-15 */
        /*background: -webkit-linear-gradient(top, #87e0fd 0%,#53cbf1 40%,#05abe0 100%);*/ /* Chrome10-25,Safari5.1-6 */
        /*background: linear-gradient(to bottom, #87e0fd 0%,#53cbf1 40%,#05abe0 100%);*/ /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        /*filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#87e0fd', endColorstr='#05abe0',GradientType=0 );*/ 
    }
    #header-inside{
        background-color: #eeeeee !important;
        /*background-color: #2e1915 !important;*/
        /*background: #87e0fd;
        background: -moz-linear-gradient(top, #87e0fd 0%, #53cbf1 40%, #05abe0 100%);
        background: -webkit-linear-gradient(top, #87e0fd 0%,#53cbf1 40%,#05abe0 100%);
        background: linear-gradient(to bottom, #87e0fd 0%,#53cbf1 40%,#05abe0 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#87e0fd', endColorstr='#05abe0',GradientType=0 );*/
    }

    #main-navigation ul.menu li a {
        color: #3f3f3f !important;
    }
    .navigation-social-bookmarks ul li a,
    .dropdown.search-bar .trigger {
        color: #3f3f3f !important;
    }

    #superfish-13-select {
       display: none;
    }

    .mean-nav {
        background: #87e0fd; /* Old browsers */
        background: -moz-linear-gradient(top, #87e0fd 0%, #53cbf1 40%, #05abe0 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top, #87e0fd 0%,#53cbf1 40%,#05abe0 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom, #87e0fd 0%,#53cbf1 40%,#05abe0 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#87e0fd', endColorstr='#05abe0',GradientType=0 );
    }


</style>

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

<!-- #header-top -->
<header id="header-top" role="banner" class="clearfix">
    <div class="container">

        <!-- #header-top-inside -->
        <div id="header-top-inside" class="clearfix">
            <div class="row">
            
                <div class="<?php print $header_top_inside_left_grid_class; ?>">
                    <!-- #header-top-left -->
                    <div id="header-top-left" class="clearfix">
                        <div class="header-top-area">

                            <div id="logo-and-site-name-wrapper" class="clearfix">
                                <?php if ($logo):?>
                                <div id="logo">
                                <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"> <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /> </a>
                                </div>
                                <?php endif; ?>
                                
                                <?php if ($site_name):?>
                                <div id="site-name">
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
                    <div class="col-md-4">
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
                        <div style="display: none;" id="breadcrumb" class="clearfix">
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
                            <?php if ($title): ?><h1 style="display: none;" class="title" id="page-title"><?php print $title; ?></h1><?php endif; ?>
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