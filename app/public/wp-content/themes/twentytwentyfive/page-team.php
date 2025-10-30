<?php
/*
Template Name: Team Page
*/
get_header();
?>
<main class="site-main">
  <div class="container">
    <?php
    // Page content (optional)
    if ( have_posts() ) :
      while ( have_posts() ) : the_post();
        the_content();
      endwhile;
    endif;
    ?>
    <?php include( get_template_directory() . '/parts/team-section.php' ); ?>
  </div>
</main>
<?php get_footer(); ?>