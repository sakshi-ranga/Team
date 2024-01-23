<?php
/*
* Plugin Name: Team Member 
* Description: Plugin to display team members grouped by department.
* Plugin URI: https://www.site.com/
* Version: 0.1
* Author: Sakshi
* Author URI: https://www.test.com/
*/

// Hook into admin notices
define( 'PLUGINPATH',  plugins_url('/', __FILE__) );
add_action('admin_notices', 'dependency_check_notice');

function dependency_check_notice() {
    // Check for the presence of dependent plugin
    if (!is_plugin_active('advanced-custom-fields/acf.php')) {
        deactivate_plugins(plugin_basename(__FILE__));
        ?>
        <div class="error">
            <p>The Dependent Plugin is required for this plugin to function properly. Please install and activate it before activating this plugin.</p>
        </div>
        <?php
    }
}

require_once 'includes/helper-functions.php';
require_once 'includes/team-post-type.php';
require_once 'includes/shortcode.php';