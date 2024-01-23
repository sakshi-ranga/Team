<?php

/**
 * Enqueue styles and scripts for the team display shortcode.
 *
 * @action wp_enqueue_scripts
 */
function your_shortcode_wp_enqueue_scripts_fun() {
    // Register and enqueue custom.js script
    wp_register_script('team-js', PLUGINPATH . '/assets/js/custom.js', array('jquery'), '1.0', true);
    wp_localize_script('team-js', 'customAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
    ));

    // Register and enqueue style.css
    wp_register_style('team-styles', PLUGINPATH . '/assets/css/style.css');
    wp_enqueue_style('team-styles');
    wp_enqueue_script('team-js');
}
add_action('wp_enqueue_scripts', 'your_shortcode_wp_enqueue_scripts_fun');

/**
 * Shortcode function to display a team selection dropdown and team members.
 *
 * @shortcode display_team
 * @return string HTML content for the team display.
 */
function team_display_shortcode() {
    ob_start();

    // Get department terms
    $department_terms = get_terms(array(
        'taxonomy' => 'department',
        'hide_empty' => false,
    ));

    // Output department selection dropdown
    echo '<div class"teams-page">';
    if (!empty($department_terms) && !is_wp_error($department_terms)) {
        echo '<select id="taxonomySelect"><option value="">Select Taxonomy</option>';
        foreach ($department_terms as $taxonomy) {
            echo '<option value="' . esc_attr($taxonomy->slug) . '">' . esc_html($taxonomy->name) . '</option>';
        }
        echo '</select>';
    }

    // Output container for team members
    echo '<div class="teams" id="teams"></div></div>';

    // Return the buffered content
    return ob_get_clean();
}
add_shortcode('display_team', 'team_display_shortcode');

/**
 * AJAX callback function to retrieve and display team members based on the selected department.
 *
 * @action wp_ajax_display_team_members
 * @action wp_ajax_nopriv_display_team_members
 */
function display_team_members() {
    // Define query arguments
    $args = array(
        'post_type' => 'team'
    );

    // Check if a department is selected
    if (isset($_POST['department']) && $_POST['department'] !== '') {
        $termslug = array(
            array(
                'taxonomy' => 'department',
                'field' => 'slug',
                'terms' => trim($_POST['department']),
            )
        );
        $args['tax_query'] = $termslug;
    }

    // Query for team members
    $the_query = new WP_Query($args);
    $html = '<ul>';

    // Check if team members are found
    if ($the_query->have_posts()) {
        while ($the_query->have_posts()) {
            $the_query->the_post();
            $post_thumbnail = get_the_post_thumbnail(get_the_ID(), 'thumbnail');

            // If no post thumbnail is available, use a default image
            if (empty($post_thumbnail)) {
                $post_thumbnail = '<img src="' . PLUGINPATH . '/assets/images/avtaar.jpg' . '" alt="Default Image">';
            }

            // Build HTML for each team member
            $html .= '<li><div class="team-member">
                        ' . $post_thumbnail . '
                        <div class="name">' . get_the_title() . '</div>
                        <div class="email"> Email :' . get_field('email') . '</div>
                        <div class="bio">Bio :' . get_field('bio') .
                '</div></div></li>';
        }
    } else {
        // Display a message if no team members are found
        $html .= '<li><div class="team-member">No team members found</div></li>';
    }

    // Complete the HTML list
    $html .= '</ul>';

    // Reset post data and send the HTML response using wp_send_json_success
    wp_reset_postdata();
    wp_send_json_success($html);
}

// Hook the AJAX action for authenticated users and non-authenticated users
add_action('wp_ajax_display_team_members', 'display_team_members');
add_action('wp_ajax_nopriv_display_team_members', 'display_team_members');
