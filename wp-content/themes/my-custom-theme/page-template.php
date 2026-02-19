<?php
/*
Template Name: Full Width Page
Template Post Type: page
*/

?>

<?php get_header(); ?>

<main class="container">
    <h3>Search Products</h3>
    <form role="search" action="<?php echo site_url('/'); ?>" method="get" id="searchform">
        <input type="text" name="s" placeholder="Search Products" />
        <input type="hidden" name="post_type" value="movies" /> <!-- Hidden field specifies the post type -->
        <input type="submit" alt="Search" value="Search" />
    </form>
    
<?php
// 1. Determine the current page number
if ( get_query_var( 'paged' ) ) {
    $paged = get_query_var( 'paged' );
} elseif ( get_query_var( 'page' ) ) {
    // 'page' is used instead of 'paged' for static front pages
    $paged = get_query_var( 'page' );
} else {
    $paged = 1;
}

// 2. Define arguments for your custom query
$args = array(
    'post_type'      => 'post', // Or your custom post type (e.g., 'event', 'product')
    'posts_per_page' => 1,      // Number of posts per page
    'paged'          => $paged, // Pass the current page number to the query
);

// 3. Run the custom query
$custom_query = new WP_Query( $args );

// 4. The Loop
if ( $custom_query->have_posts() ) :
    while ( $custom_query->have_posts() ) : $custom_query->the_post();
        // Your post content goes here
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="entry-content">
                <?php the_excerpt(); ?>
            </div>
        </article>
        <?php
    endwhile;

    // 5. Display the pagination links
    if ( $custom_query->max_num_pages > 1 ) {
        echo '<div class="custom-pagination">';
        echo paginate_links( array(
            'base'    => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
            'total'   => $custom_query->max_num_pages,
            'current' => max( 1, get_query_var( 'paged' ) ?: get_query_var( 'page' ) ),
            'format'  => '?paged=%#%',
            'show_all' => false,
            'type'     => 'plain',
            'end_size' => 2,
            'mid_size' => 1,
            'prev_text' => __( '&laquo; Previous', 'textdomain' ),
            'next_text' => __( 'Next &raquo;', 'textdomain' ),
        ) );
        echo '</div>';
    }
    
    // 6. Reset postdata to restore the global $post variable
    wp_reset_postdata();

else :
    // If no posts are found
    get_template_part( 'content', 'none' );
endif;
?>
