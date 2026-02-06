<?php acf_form_head(); ?>
<?php get_header(); ?>

<div id="primary">
    <div id="content" role="main">
        <div class="my-contact-section">
            <h3>Have a Question? Contact Us:</h3>
            <?php echo do_shortcode('[contact-form-7 id="0f83f77" title="Contact form 1"]'); ?>
        </div>
        <?php /* The loop */

        ?>
        <?php while (have_posts()) : the_post(); ?>

            <h1><?php the_title(); ?></h1>

            <?php the_content(); ?>

            <p>My custom field: <?php the_field('my_custom_field'); ?></p>

            <?php acf_form(); ?>

        <?php endwhile; ?>

    </div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>