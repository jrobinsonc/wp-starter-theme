<?php

get_header();

// This must be after get_header().
$sidebar = is_active_sidebar('sidebar');

?>

<div class="page__main">
    <div class="container">
        <div class="row">
            <main class="site-main <?php echo $sidebar? 'col-sm-9' : 'col-sm-12' ?>" role="main">
