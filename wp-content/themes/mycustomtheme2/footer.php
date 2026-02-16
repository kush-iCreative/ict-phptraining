
<footer class="site-footer">
  <div class="footer-container">
    <div class="footer-column">
      <?php dynamic_sidebar('footer-col-1'); ?>
    </div>
    
    <div class="footer-column">
      <?php dynamic_sidebar('footer-col-2'); ?>
    </div>

    <!-- Column 3 -->
    <div class="footer-column">
      <?php dynamic_sidebar('footer-col-3');
      ?>

    </div>
  </div>
<?php 
$repeater_data = get_post_meta(get_the_ID(), 'movie_repeater_data', true);
if (!empty($repeater_data) && is_array($repeater_data)) {
    
    foreach ($repeater_data as $row) {
        $date = esc_html($row['movie_date']);
        $price = esc_html($row['movie_price']);
        
        echo '<div class="movie-item">';
        echo '<span>Date: ' . $date . '</span> - ';
        echo '<span>Price:' . $price . '</span>';
        echo '</div>';
    }
    
}

?>
  <div class="footer-info">
    
    <p><?php echo esc_html( get_option( 'mytheme_footer_text' ) ); ?></p>
    <p><?php echo esc_html( get_option( 'mytheme_social_link' ) ); ?></p>
    <h2><?php echo "Value from custom meta field". esc_html(get_post_meta($post->ID, 'movie_repeater_data', true)) ?></h2>
    <h2><?php echo "Value from custom meta field" . esc_html(get_post_meta($post->ID, 'movie_repeater_data', true)) ?></h2>
    <p>
      &copy; <span id="displayYear"></span> All Rights Reserved By
      <a href="https://html.design/">Kush Mistry</a><br><br>
      &copy; <span id="displayYear"></span> Distributed By
      <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
    </p>
  </div>
</footer>


<?php wp_footer(); ?>
</body>

</html>