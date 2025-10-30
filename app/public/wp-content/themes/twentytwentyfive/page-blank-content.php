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

  <main class="wpb-content-area">
    <?php the_content(); ?>
  </main>

  <main class="wpb-content-area">
    <?php the_content(); ?>
  </main>
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
      <div class="team-member" data-category="director">
        <div class="team-photo"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/jack.png" alt="Jack O'Connor"></div>
        <div class="team-info">
          <h3>Jack O'Connor</h3>
          <div class="team-qual">BRP (Hons) MNZPI</div>
          <div class="team-position">Principal Planner | Director</div>
          <div class="team-phone">027 777 7777</div>
          <a href="#" class="team-read-bio">
            Read Bio
            <span class="bio-arrow">
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 22 22">
                <path d="M5 17L17 5M17 5H7M17 5V15" stroke="#F9855D" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </span>
          </a>
        </div>
      </div>
      <div class="team-member" data-category="director">
        <div class="team-photo"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/leo.png" alt="Leo Patel"></div>
        <div class="team-info">
          <h3>Leo Patel</h3>
          <div class="team-qual">BRP MNZPI</div>
          <div class="team-position">Principal Planner | Director</div>
          <div class="team-phone">027 666 6666</div>
          <a href="#" class="team-read-bio">
            Read Bio
            <span class="bio-arrow">
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 22 22">
                <path d="M5 17L17 5M17 5H7M17 5V15" stroke="#F9855D" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </span>
          </a>
        </div>
      </div>
      <div class="team-member" data-category="consultant">
        <div class="team-photo"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/aria.png" alt="Aria Thompson"></div>
        <div class="team-info">
          <h3>Aria Thompson</h3>
          <div class="team-qual">PhD, MEnv BSc (GEO)</div>
          <div class="team-position">Consultant Planner</div>
          <div class="team-phone">027 888 8888</div>
          <a href="#" class="team-read-bio">
            Read Bio
            <span class="bio-arrow">
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 22 22">
                <path d="M5 17L17 5M17 5H7M17 5V15" stroke="#F9855D" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </span>
          </a>
        </div>
      </div>
      <div class="team-member" data-category="associate">
        <div class="team-photo"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/patty.png" alt="Patty Gower"></div>
        <div class="team-info">
          <h3>Patty Gower</h3>
          <div class="team-qual">BRP (HONS) MNZPI</div>
          <div class="team-position">Associate Planner</div>
          <div class="team-phone">021 234 5456</div>
          <a href="#" class="team-read-bio">
            Read Bio
            <span class="bio-arrow">
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 22 22">
                <path d="M5 17L17 5M17 5H7M17 5V15" stroke="#F9855D" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </span>
          </a>
        </div>
      </div>
      <div class="team-member" data-category="associate lead">
        <div class="team-photo"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/jacinda.png" alt="Jacinda Ardern"></div>
        <div class="team-info">
          <h3>Jacinda Ardern</h3>
          <div class="team-qual">MNZPI</div>
          <div class="team-position">Associate Planner | Technical Lead</div>
          <div class="team-phone">027 889 9892</div>
          <a href="#" class="team-read-bio">
            Read Bio
            <span class="bio-arrow">
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 22 22">
                <path d="M5 17L17 5M17 5H7M17 5V15" stroke="#F9855D" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </span>
          </a>
        </div>
      </div>
      <div class="team-member" data-category="associate">
        <div class="team-photo"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/chris.png" alt="Chris Luxon"></div>
        <div class="team-info">
          <h3>Chris Luxon</h3>
          <div class="team-qual">BRP (MSc)</div>
          <div class="team-position">Associate Planner</div>
          <div class="team-phone">021 123 1234</div>
          <a href="#" class="team-read-bio">
            Read Bio
            <span class="bio-arrow">
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 22 22">
                <path d="M5 17L17 5M17 5H7M17 5V15" stroke="#F9855D" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </span>
          </a>
        </div>
      </div>
    </div>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
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
      });
    </script>
  </section>
  <?php wp_footer(); ?>
</body>
</html>