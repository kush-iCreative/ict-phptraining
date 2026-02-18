<?php
/*
Template Name: My Custom Layout
Template Post Type: post, page
*/
echo "custom template";

get_header();

// 1. Get the current page number
$paged = get_query_var('paged') ? get_query_var('paged'): 1;

// 2. Define the arguments for the custom query
$args = array(
    'post_type'      => 'movie', // Replace with your actual post type slug (e.g., 'videos')
    'posts_per_page' => 2,                      // Number of posts per page
    'paged'          => $paged,                  // Current page number
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
);

// 3. Create a new WP_Query instance
$custom_query = new WP_Query( $args );

// 4. Start the loop
if ( $custom_query->have_posts() ) :
    while ( $custom_query->have_posts() ) : $custom_query->the_post();
        // YOUR POST CONTENT CODE GOES HERE
        ?>
        <div class="custom-post-item">
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <?php the_excerpt(); ?>
        </div>
        <?php
    endwhile;

    // 5. Display pagination links
    $total_pages = $custom_query->max_num_pages;

    if ( $total_pages > 1 ) {
        $current_page = max( 1, get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' ) );

        echo '<div class="pagination">';
        echo paginate_links( array(
            'base'      => get_pagenum_link( 1 ) . '%_%',
            'format'    => '/page/%#%',
            'current'   => $current_page,
            'total'     => $total_pages,
            'prev_text' => __( '&laquo; Prev' ),
            'next_text' => __( 'Next &raquo;' ),
        ) );
        echo '</div>';
    }
endif;


// 6. Reset post data
wp_reset_postdata();

get_footer();
?>





