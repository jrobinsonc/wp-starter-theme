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

    <!--[if lt IE 9]><div style="text-align: center; font-size: 20px; padding: 50px 0; background-color: #FEF49C; color: #444;"><?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'wpstartertheme'); ?></div><![endif]-->

    <div class="page">

        <div class="page__top">
            <div class="container">
                <?php show_menu('primary'); ?>
            </div>
        </div>

        <div class="page__header">

            <div class="container">
                <a rel="home" class="logo" href="<?php echo esc_url(home_url('/')); ?>"><span><?php bloginfo( 'name'); ?></span></a>

                <p class="site-description">Example template for WP-Starter-Theme using Bootstrap.</p>

            </div>

        </div>
