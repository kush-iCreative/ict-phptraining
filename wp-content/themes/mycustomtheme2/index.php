<?php get_header(); 

echo do_shortcode('[my_banner]'); 
?>

<div id="content" style="margin-top: 50px;">
    
    <?php 
    if ( have_posts() ) : 
        while ( have_posts() ) : the_post(); ?>
          
            <div class="entry-content">
                <?php the_content(); ?>
            </div>

        <?php endwhile; 
    else : 
        echo '<p>Sorry, no content found.</p>';
    endif; 
    ?>
</div>

<?php get_footer(); ?>
