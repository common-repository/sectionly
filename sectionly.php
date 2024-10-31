<?php
/**
 * Plugin Name:       Sectionly
 * Plugin URI:        https://plugins.bracesol.com
 * Description:       Sectionly is a plugin as well as an add-on for the visual composer and elementor page builder.it contains the elements/widgets/shortcodes that are commonly used in every website like Teams, Progress bar, Blogs, Services, Testimonial, and many more in new updates with a variety of styles. 
 * Version:           1.0
 * Author:            BraceSol
 * Author URI:        https://www.bracesol.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       sectionly
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('SECTIONLY_VERSION', '1.0.0');
define('SECTIONLY_PLUGIN_DIR', plugin_dir_url(__DIR__));
define('SECTIONLY_PLUGIN_URL', plugin_dir_url(__FILE__));
define('SECTIONLY_PLUGIN_PATH', plugin_dir_path(__FILE__));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-sectionly-activator.php
 */
function activate_sectionly() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-sectionly-activator.php';
    Sectionly_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-sectionly-deactivator.php
 */
function deactivate_sectionly() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-sectionly-deactivator.php';
    Sectionly_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_sectionly');
register_deactivation_hook(__FILE__, 'deactivate_sectionly');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-sectionly.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_sectionly() {

    $plugin = new Sectionly();
    $plugin->run();
}

run_sectionly();