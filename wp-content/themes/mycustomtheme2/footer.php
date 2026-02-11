
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

  <div class="footer-info">
    <p><?php echo esc_html( get_option( 'mytheme_footer_text' ) ); ?></p>
    <p><?php echo esc_html( get_option( 'mytheme_social_link' ) ); ?></p>
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