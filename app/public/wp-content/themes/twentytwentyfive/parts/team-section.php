<?php
// Team Section Template Part
?>
<section class="team-section">
  <h2>Our People</h2>
  <div class="team-grid">
    <?php
    $args = array('post_type' => 'team', 'posts_per_page' => -1);
    $team_query = new WP_Query($args);
    if ($team_query->have_posts()) :
      while ($team_query->have_posts()) : $team_query->the_post();
        $position = get_field('position');
        $phone = get_field('phone_number');
        $email = get_field('email');
        ?>
        <div class="team-member">
          <?php if (has_post_thumbnail()) : ?>
            <div class="team-photo"><?php the_post_thumbnail('medium'); ?></div>
          <?php endif; ?>
          <div class="team-info">
            <h3><?php the_title(); ?></h3>
            <div class="team-position"><?php echo esc_html($position); ?></div>
            <div class="team-phone"><?php echo esc_html($phone); ?></div>
            <?php if ($email): ?>
              <div class="team-email"><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></div>
            <?php endif; ?>
            <a href="<?php the_permalink(); ?>" class="team-read-bio">Read Bio</a>
          </div>
        </div>
      <?php endwhile;
      wp_reset_postdata();
    endif;
    ?>
  </div>
</section>
