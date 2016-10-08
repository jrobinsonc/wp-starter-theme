<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url'); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <!--[if lt IE 9]><div style="text-align: center; font-size: 20px; padding: 50px 0; background-color: #FEF49C; color: #444;"><?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', THEME_TEXTDOMAIN); ?></div><![endif]-->

    <div class="page">

        <div class="page__top">
            <div class="container">

                <div class="clearfix visible-xs-block">
                    <a href="#" class="top__navbar-btn" data-toggle="collapse" data-target="#top__navbar"><span class="glyphicon glyphicon-menu-hamburger pull-right" aria-hidden="true"></span></a>
                </div>

                <div class="row" id="top__navbar">
                    <div class="col-sm-3 col-sm-push-9"><?php get_search_form(); ?></div>
                    <div class="col-sm-9 col-sm-pull-3"><?php show_menu('primary'); ?></div>
                </div>

            </div>
        </div>

        <div class="page__header">

            <div class="container">

                <a rel="home" class="logo" href="<?php echo esc_url(home_url('/')); ?>"><span><?php bloginfo( 'name'); ?></span></a>

                <p class="site-description"><?php bloginfo('description') ?></p>

            </div>

        </div>
