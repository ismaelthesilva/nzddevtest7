<?php
/*
Template Name: Blank Content Only
Template Post Type: page
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
  <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
</head>
<body <?php body_class('template-blank-content'); ?>>
  <div class="header">
    <a class="about-link" href="/about">About Us</a>
    <h1 class="hero-title">Committed to community growth through expert planning</h1>
    <img class="hero-image" src="<?php echo get_template_directory_uri(); ?>/assets/images/header.png" alt="Header landscape">
  </div>

  <section class="team-section">
    <h2>Our People</h2>
    <div class="team-filter">
      <button class="active" data-filter="all">All</button>
      <button data-filter="director">Director</button>
      <button data-filter="consultant">Consultant</button>
      <button data-filter="associate">Associate</button>
      <button data-filter="lead">Technical Lead</button>
    </div>
    <div class="team-grid">
      <?php echo do_shortcode('[my_team_grid]'); ?>
    </div>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        // Wait for shortcode content to load
        setTimeout(function() {
          const filterButtons = document.querySelectorAll('.team-filter button');
          const members = document.querySelectorAll('.team-member');
          
          filterButtons.forEach(btn => {
            btn.addEventListener('click', function() {
              filterButtons.forEach(b => b.classList.remove('active'));
              this.classList.add('active');
              const filter = this.getAttribute('data-filter');
              
              members.forEach(member => {
                if (filter === 'all' || member.getAttribute('data-category').includes(filter)) {
                  member.style.display = '';
                } else {
                  member.style.display = 'none';
                }
              });
            });
          });
        }, 300);
      });
    </script>
  </section>
  <?php wp_footer(); ?>
</body>
</html>