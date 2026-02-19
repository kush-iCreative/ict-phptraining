<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <header class="site-header">
        <div class="container">
            <div class="site-branding">
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                    <img src="<?php echo get_template_directory_uri(); ?>/screenshot.jpeg" alt="Site Logo" width="50px">
                </a>
            </div>
            <nav class="main-nav">
                <ul>
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'primary-menu', // The slug you registered in functions.php
                            'container'      => 'nav',          // Wraps the menu in a <nav> tag (default is a <div>)
                            'container_class' => 'main-navigation', // CSS class for the container
                            'menu_class'     => 'menu-list',    // CSS class for the <ul> element
                            'echo'           => true,           // Echo the menu to the page (default)

                        )
                    );
                    ?>

                </ul>
            </nav>
        </div>
    </header>