<?php
/**
 * Twenty Twenty-Five functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

// Adds theme support for post formats.
if ( ! function_exists( 'twentytwentyfive_post_format_setup' ) ) :
	/**
	 * Adds theme support for post formats.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_post_format_setup() {
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
	}
endif;
add_action( 'after_setup_theme', 'twentytwentyfive_post_format_setup' );

// Enqueues editor-style.css in the editors.
if ( ! function_exists( 'twentytwentyfive_editor_style' ) ) :
	/**
	 * Enqueues editor-style.css in the editors.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_editor_style() {
		add_editor_style( 'assets/css/editor-style.css' );
	}
endif;
add_action( 'after_setup_theme', 'twentytwentyfive_editor_style' );

// Register Team Custom Post Type
function register_team_post_type() {
	$labels = array(
		'name' => 'Team',
		'singular_name' => 'Team Member',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Team Member',
		'edit_item' => 'Edit Team Member',
		'new_item' => 'New Team Member',
		'view_item' => 'View Team Member',
		'search_items' => 'Search Team Members',
		'not_found' => 'No team members found',
		'not_found_in_trash' => 'No team members found in Trash',
		'menu_name' => 'Team'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'menu_icon' => 'dashicons-groups',
		'supports' => array('title', 'editor', 'thumbnail'),
		'has_archive' => false,
		'rewrite' => array('slug' => 'team'),
		'show_in_rest' => true,
	);
	register_post_type('team', $args);
}
add_action('init', 'register_team_post_type');

// Add admin notice to check ACF setup
function team_acf_setup_notice() {
    $screen = get_current_screen();
    if ($screen && ($screen->post_type === 'team' || $screen->id === 'edit-team')) {
        // Check if ACF is active
        if (!function_exists('acf_add_local_field_group')) {
            echo '<div class="notice notice-error"><p><strong>ACF Plugin Required:</strong> Please install and activate Advanced Custom Fields (ACF) plugin.</p></div>';
            return;
        }
        
        // Check if field group exists for team post type
        $field_groups = acf_get_field_groups(array('post_type' => 'team'));
        if (empty($field_groups)) {
            echo '<div class="notice notice-warning"><p><strong>ACF Fields Missing:</strong> No ACF field group found for Team post type. Required fields: featured_image, name, title, position, phone_number, team_category</p></div>';
        } else {
            echo '<div class="notice notice-info"><p><strong>ACF Fields Found:</strong> '.count($field_groups).' field group(s) configured for Team posts. Make sure to fill in all fields before publishing.</p></div>';
        }
    }
}
add_action('admin_notices', 'team_acf_setup_notice');

// Register ACF fields programmatically if ACF is installed
if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
        'key' => 'group_team_members',
        'title' => 'Team Member Details',
        'fields' => array(
            array(
                'key' => 'field_featured_image',
                'label' => 'Featured Image',
                'name' => 'featured_image',
                'type' => 'image',
                'required' => 1,
                'return_format' => 'url',
                'preview_size' => 'medium',
            ),
            array(
                'key' => 'field_name',
                'label' => 'Name',
                'name' => 'name',
                'type' => 'text',
                'required' => 1,
            ),
            array(
                'key' => 'field_title',
                'label' => 'Title/Qualifications',
                'name' => 'title',
                'type' => 'text',
                'required' => 1,
                'instructions' => 'e.g., BRP (Hons) MNZPI',
            ),
            array(
                'key' => 'field_position',
                'label' => 'Position',
                'name' => 'position',
                'type' => 'text',
                'required' => 1,
                'instructions' => 'e.g., Principal Planner | Director',
            ),
            array(
                'key' => 'field_phone_number',
                'label' => 'Phone Number',
                'name' => 'phone_number',
                'type' => 'text',
                'required' => 1,
            ),
            array(
                'key' => 'field_team_category',
                'label' => 'Category',
                'name' => 'team_category',
                'type' => 'select',
                'required' => 1,
                'choices' => array(
                    'director' => 'Director',
                    'consultant' => 'Consultant',
                    'associate' => 'Associate',
                    'lead' => 'Technical Lead',
                ),
                'multiple' => 1,
                'allow_null' => 0,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'team',
                ),
            ),
        ),
    ));
}

// Enqueues style.css on the front.
if ( ! function_exists( 'twentytwentyfive_enqueue_styles' ) ) :
	/**
	 * Enqueues style.css on the front.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_enqueue_styles() {
		wp_enqueue_style(
			'twentytwentyfive-style',
			get_parent_theme_file_uri( 'style.css' ),
			array(),
			wp_get_theme()->get( 'Version' )
		);
	}
endif;
add_action( 'wp_enqueue_scripts', 'twentytwentyfive_enqueue_styles' );

// Enqueue Team Filter script for front-end
if ( ! function_exists( 'twentytwentyfive_enqueue_team_filter' ) ) :
    /**
     * Enqueues team-filter.js to handle client-side filtering of the Team grid.
     * Loaded in footer and safe to run across pages; it self-guards when markup isn't present.
     *
     * @since Twenty Twenty-Five 1.0
     *
     * @return void
     */
    function twentytwentyfive_enqueue_team_filter() {
        if ( is_admin() ) {
            return; // front-end only
        }
        $theme_ver = wp_get_theme()->get( 'Version' );
        wp_enqueue_script(
            'twentytwentyfive-team-filter',
            get_stylesheet_directory_uri() . '/assets/js/team-filter.js',
            array(),
            $theme_ver,
            true
        );
    }
endif;
add_action( 'wp_enqueue_scripts', 'twentytwentyfive_enqueue_team_filter' );

// Registers custom block styles.
if ( ! function_exists( 'twentytwentyfive_block_styles' ) ) :
	/**
	 * Registers custom block styles.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_block_styles() {
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __( 'Checkmark', 'twentytwentyfive' ),
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_block_styles' );

// Registers pattern categories.
if ( ! function_exists( 'twentytwentyfive_pattern_categories' ) ) :
	/**
	 * Registers pattern categories.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_pattern_categories() {

		register_block_pattern_category(
			'twentytwentyfive_page',
			array(
				'label'       => __( 'Pages', 'twentytwentyfive' ),
				'description' => __( 'A collection of full page layouts.', 'twentytwentyfive' ),
			)
		);

		register_block_pattern_category(
			'twentytwentyfive_post-format',
			array(
				'label'       => __( 'Post formats', 'twentytwentyfive' ),
				'description' => __( 'A collection of post format patterns.', 'twentytwentyfive' ),
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_pattern_categories' );

// Registers block binding sources.
if ( ! function_exists( 'twentytwentyfive_register_block_bindings' ) ) :
	/**
	 * Registers the post format block binding source.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_register_block_bindings() {
		register_block_bindings_source(
			'twentytwentyfive/format',
			array(
				'label'              => _x( 'Post format name', 'Label for the block binding placeholder in the editor', 'twentytwentyfive' ),
				'get_value_callback' => 'twentytwentyfive_format_binding',
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_register_block_bindings' );

// Registers block binding callback function for the post format name.
if ( ! function_exists( 'twentytwentyfive_format_binding' ) ) :
	/**
	 * Callback function for the post format name block binding source.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return string|void Post format name, or nothing if the format is 'standard'.
	 */
	function twentytwentyfive_format_binding() {
		$post_format_slug = get_post_format();

		if ( $post_format_slug && 'standard' !== $post_format_slug ) {
			return get_post_format_string( $post_format_slug );
		}
	}
endif;

// Team Grid Shortcode
function my_team_grid_shortcode($atts) {
    $args = array(
        'post_type' => 'team',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC'
    );
    $query = new WP_Query($args);

    ob_start();
    
    // The shortcode itself creates the grid wrapper
    echo '<div class="team-grid">';
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            
            $post_id = get_the_ID();
            
            // Get ACF fields
            $img_url = get_field('featured_image', $post_id);
            $name = get_field('name', $post_id);
            $title = get_field('title', $post_id);
            $position = get_field('position', $post_id);
            $phone_number = get_field('phone_number', $post_id);
            $category_raw = get_field('team_category', $post_id);
            
            // **FIXED**: Properly handle the category array
            $category_string = '';
            if (is_array($category_raw)) {
                // Trim each value and filter out any empty ones
                $categories = array_map('trim', $category_raw);
                $categories = array_filter($categories);
                $category_string = implode(' ', $categories);
            } elseif (!empty($category_raw)) {
                $category_string = trim($category_raw);
            }
            
            // Fallback to post title if name is empty
            if (empty($name)) {
                $name = get_the_title();
            }
            
            // DEBUG: Output category info as HTML comment
            echo '<!-- Member: '.esc_html($name).' | Raw Category: '.print_r($category_raw, true).' | Final Category String: '.esc_attr(strtolower($category_string)).' -->';
            
            // Output team member HTML with the correct category string
            echo '<div class="team-member" data-category="'.esc_attr(strtolower($category_string)).'">';
            echo '<div class="team-photo">';
            if ($img_url) {
                echo '<img src="'.esc_url($img_url).'" alt="'.esc_attr($name).'">';
            }
            echo '</div>';
            echo '<div class="team-info">';
            echo '<h3>'.esc_html($name).'</h3>';
            if ($title) echo '<div class="team-qual">'.esc_html($title).'</div>';
            if ($position) echo '<div class="team-position">'.esc_html($position).'</div>';
            if ($phone_number) echo '<div class="team-phone">'.esc_html($phone_number).'</div>';
            echo '<a href="#" class="team-read-bio">';
            echo 'Read Bio';
            echo '<span class="bio-arrow">';
            echo '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 22 22">';
            echo '<path d="M5 17L17 5M17 5H7M17 5V15" stroke="#F9855D" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>';
            echo '</svg>';
            echo '</span>';
            echo '</a>';
            echo '</div>';
            echo '</div>';
        }
        wp_reset_postdata();
    }
    
    echo '</div>'; // Close the grid wrapper
    
    // Add inline script to initialize the filter AFTER the members are rendered
    echo '<script>
(function(){
  console.log("[team-filter] Script executing...");
  
  // Try multiple ways to find the section
  var section = null;
  if(document.currentScript && document.currentScript.closest){
    section = document.currentScript.closest(".team-section");
    console.log("[team-filter] Found section via currentScript:", !!section);
  }
  
  if(!section){
    // Fallback: find the section that contains this script
    var scripts = document.querySelectorAll("script");
    for(var i = scripts.length - 1; i >= 0; i--){
      var parent = scripts[i].parentElement;
      while(parent){
        if(parent.classList && parent.classList.contains("team-section")){
          section = parent;
          console.log("[team-filter] Found section via parent traversal");
          break;
        }
        parent = parent.parentElement;
      }
      if(section) break;
    }
  }
  
  if(!section){
    console.error("[team-filter] Could not find .team-section parent!");
    return;
  }
  
  if(section.dataset.filterInit){
    console.log("[team-filter] Already initialized, skipping");
    return;
  }
  section.dataset.filterInit = "true";
  
  var filterBar = section.querySelector(".team-filter");
  var members = section.querySelectorAll(".team-member");
  
  console.log("[team-filter] Filter bar found:", !!filterBar);
  console.log("[team-filter] Members found:", members.length);
  
  if(!filterBar){
    console.error("[team-filter] No .team-filter found in section!");
    return;
  }
  
  // Log all member categories
  members.forEach(function(m, idx){
    console.log("[team-filter] Member", idx, "data-category:", m.getAttribute("data-category"));
  });
  
  function applyFilter(filter){
    var target = (filter || "all").toLowerCase();
    console.log("[team-filter] Applying filter:", target);
    
    var shown = 0, hidden = 0;
    members.forEach(function(m){
      var catAttr = m.getAttribute("data-category") || "";
      var cats = catAttr.toLowerCase().split(/\s+/).filter(Boolean);
      var show = (target === "all" || cats.indexOf(target) !== -1);
      m.style.display = show ? "" : "none";
      if(show) shown++; else hidden++;
    });
    console.log("[team-filter] Result: shown=" + shown + ", hidden=" + hidden);
  }
  
  filterBar.addEventListener("click", function(e){
    var btn = e.target.closest("button");
    if(!btn){
      console.log("[team-filter] Click on non-button element");
      return;
    }
    var filter = (btn.getAttribute("data-filter") || "").toLowerCase();
    console.log("[team-filter] Button clicked, filter:", filter);
    
    filterBar.querySelectorAll("button").forEach(function(b){ b.classList.remove("active"); });
    btn.classList.add("active");
    applyFilter(filter);
  });
  
  var activeBtn = filterBar.querySelector("button.active") || filterBar.querySelector("button[data-filter=all]");
  var initialFilter = activeBtn ? activeBtn.getAttribute("data-filter") : "all";
  console.log("[team-filter] Initial filter:", initialFilter);
  applyFilter(initialFilter);
  
  console.log("[team-filter] ✓ Initialization complete");
})();
</script>';
    
    return ob_get_clean();
}
add_shortcode('my_team_grid', 'my_team_grid_shortcode');

// Enhanced WPBakery Team Grid Element with Filter
if (function_exists('vc_map')) {
    
    // Map the NEW filterable element
    vc_map(array(
        'name' => __('Team Grid with Filter', 'twentytwentyfive'),
        'base' => 'team_grid_filtered',
        'category' => __('Content', 'twentytwentyfive'),
        'icon' => 'icon-wpb-team',
        'description' => __('Display filterable team members grid', 'twentytwentyfive'),
        'params' => array(
            array(
                'type' => 'dropdown',
                'heading' => __('Show Filter Buttons', 'twentytwentyfive'),
                'param_name' => 'show_filters',
                'value' => array(
                    'Yes' => 'yes',
                    'No' => 'no',
                ),
                'std' => 'yes',
                'description' => __('Display category filter buttons above the grid', 'twentytwentyfive'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Section Title', 'twentytwentyfive'),
                'param_name' => 'title',
                'value' => 'Our People',
                'description' => __('Title to display above the team grid', 'twentytwentyfive'),
            ),
        )
    ));
    
    // Shortcode handler for the NEW element
    function team_grid_filtered_shortcode($atts) {
        $atts = shortcode_atts(array(
            'show_filters' => 'yes',
            'title' => 'Our People',
        ), $atts);
        
        $args = array(
            'post_type' => 'team',
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC'
        );
        $query = new WP_Query($args);
        
        // Generate unique ID for this instance
        $unique_id = 'team-section-' . uniqid();
        
        ob_start();
        ?>
        
        <section class="team-section" id="<?php echo esc_attr($unique_id); ?>">
            <?php if (!empty($atts['title'])): ?>
                <h2><?php echo esc_html($atts['title']); ?></h2>
            <?php endif; ?>
            
            <?php if ($atts['show_filters'] === 'yes'): ?>
            <div class="team-filter">
                <button class="active" data-filter="all">All</button>
                <button data-filter="director">Director</button>
                <button data-filter="consultant">Consultant</button>
                <button data-filter="associate">Associate</button>
                <button data-filter="lead">Technical Lead</button>
            </div>
            <?php endif; ?>
            
            <div class="team-grid">
                <?php
                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
                        
                        $post_id = get_the_ID();
                        
                        // Get ACF fields
                        $img_url = get_field('featured_image', $post_id);
                        $name = get_field('name', $post_id);
                        $title = get_field('title', $post_id);
                        $position = get_field('position', $post_id);
                        $phone_number = get_field('phone_number', $post_id);
                        $category_raw = get_field('team_category', $post_id);
                        
                        // Handle category array
                        $category_string = '';
                        if (is_array($category_raw)) {
                            $categories = array_map('trim', $category_raw);
                            $categories = array_filter($categories);
                            $category_string = implode(' ', $categories);
                        } elseif (!empty($category_raw)) {
                            $category_string = trim($category_raw);
                        }
                        
                        // Fallback to post title if name is empty
                        if (empty($name)) {
                            $name = get_the_title();
                        }
                        ?>
                        
                        <div class="team-member" data-category="<?php echo esc_attr(strtolower($category_string)); ?>">
                            <div class="team-photo">
                                <?php if ($img_url): ?>
                                    <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($name); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="team-info">
                                <h3><?php echo esc_html($name); ?></h3>
                                <?php if ($title): ?>
                                    <div class="team-qual"><?php echo esc_html($title); ?></div>
                                <?php endif; ?>
                                <?php if ($position): ?>
                                    <div class="team-position"><?php echo esc_html($position); ?></div>
                                <?php endif; ?>
                                <?php if ($phone_number): ?>
                                    <div class="team-phone"><?php echo esc_html($phone_number); ?></div>
                                <?php endif; ?>
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
                        
                        <?php
                    }
                    wp_reset_postdata();
                }
                ?>
            </div>
        </section>
        
        <script>
        (function(){
            var section = document.getElementById('<?php echo esc_js($unique_id); ?>');
            if(!section || section.dataset.filterInit) return;
            section.dataset.filterInit = 'true';
            
            var filterBar = section.querySelector('.team-filter');
            if(!filterBar) return;
            
            var members = section.querySelectorAll('.team-member');
            
            function applyFilter(filter){
                var target = (filter || 'all').toLowerCase();
                members.forEach(function(m){
                    var catAttr = (m.getAttribute('data-category') || '').toLowerCase();
                    var cats = catAttr.split(/\s+/).filter(Boolean);
                    var show = (target === 'all' || cats.indexOf(target) !== -1);
                    m.style.display = show ? '' : 'none';
                });
            }
            
            filterBar.addEventListener('click', function(e){
                var btn = e.target.closest('button');
                if(!btn) return;
                
                var filter = (btn.getAttribute('data-filter') || '').toLowerCase();
                
                filterBar.querySelectorAll('button').forEach(function(b){
                    b.classList.remove('active');
                });
                btn.classList.add('active');
                
                applyFilter(filter);
            });
            
            var activeBtn = filterBar.querySelector('button.active');
            if(activeBtn){
                applyFilter(activeBtn.getAttribute('data-filter'));
            }
        })();
        </script>
        
        <?php
        return ob_get_clean();
    }
    add_shortcode('team_grid_filtered', 'team_grid_filtered_shortcode');
    
    // Keep the old element for backward compatibility
    vc_map(array(
        'name' => 'Team Grid',
        'base' => 'my_team_grid',
        'category' => 'Content',
        'icon' => 'icon-wpb-team',
        'description' => 'Display team members in a grid (no filter)'
    ));
}
