<?php
/**
 * Plugin Name: BE WPForms Secret Key
 * Plugin URI:  https://github.com/billerickson/be-wpforms-secret-key/
 * Description: Spam protection using a secret key you define
 * Version:     1.0.0
 * Author:      Bill Erickson
 * Author URI:  https://www.billerickson.net
 * Text Domain: integrate-convertkit-wpforms
 * Domain Path: /languages
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License version 2, as published by the
 * Free Software Foundation.  You may NOT assume that you can use any other
 * version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.
 *
 * @package    BE_WPForms_Secret_Key
 * @since      1.0.0
 * @copyright  Copyright (c) 2017, Bill Erickson
 * @license    GPL-2.0+
 */

 // Exit if accessed directly
 if ( ! defined( 'ABSPATH' ) ) exit;

 // Plugin version
 define( 'BE_WPFORMS_SECRET_KEY', '1.0.0' );

/**
 * Load the class
 *
 */
function integrate_convertkit_wpforms() {

    require_once( plugin_dir_path( __FILE__ ) . 'class-be-wpforms-secret-key.php' );

}
add_action( 'wpforms_loaded', 'integrate_convertkit_wpforms' );
