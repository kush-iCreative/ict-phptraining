
<footer class="site-footer">
  <div class="footer-container">
    <div class="footer-column">
      <?php dynamic_sidebar('footer-col-1'); ?>
    </div>
    
    <div class="footer-column">
      <div class="footer-company-info">
        <h4 class="widget-title">iCreative</h4>

        <p class="company-theory">
          This is a brief description of our company values and mission.
          We strive to provide the best services to our clients worldwide.
          Experience excellence with our dedicated professional team.
        </p>

        <div class="footer-social-links">
          <a href="#" class="social-icon" aria-label="Facebook">
            <i class="fa fa-facebook" aria-hidden="true"></i>
          </a>
          <a href="#" class="social-icon" aria-label="Instagram">
            <i class="fa fa-instagram" aria-hidden="true"></i>
          </a>
          <a href="#" class="social-icon" aria-label="Twitter">
            <i class="fa fa-twitter" aria-hidden="true"></i>
          </a>
        </div>
      </div>
    </div>

    <!-- Column 3 -->
    <div class="footer-column">
      <?php

      echo "<h5> Navigate </h5>";
      wp_nav_menu(array(
        'theme_location' => 'custom-footer-links',
        'container'      => 'nav', // Optional: wrap the menu in a <nav> tag
        'menu_class'     => 'footer-menu-items', // Optional: add a custom CSS class to the <ul>
        'echo'           => true,
        'container_class' => 'custom-footer-links',
      ));
      ?>

    </div>
  </div>

  <div class="footer-info">
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