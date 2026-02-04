<?php get_header();
echo "test code"; ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php
        while ( have_posts() ) :
            the_post();
            // Your custom template content here
            the_title( '<h1>', '</h1>' );
            the_content('<h2>' , '</h2>');
            the_excerpt();
            // Add more custom fields if needed
        endwhile;
        ?>
    </main>
</div>

<?php get_footer(); ?>
