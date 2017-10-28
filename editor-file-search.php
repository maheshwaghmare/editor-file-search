<?php
/**
 * Plugin Name: Editor File Search
 * Description: Add the search filed in theme & plugin file editor window.
 * Plugin URI: https://github.com/maheshwaghmare/editor-file-search/
 * Author: Mahesh M. Waghmare
 * Author URI: https://maheshwaghmare.wordpress.com/
 * Version: 1.0.0
 * License: GPL2
 * Text Domain: editor-file-search
 *
 * @package Editor File Search
 */

/**
 * Set constants.
 */
define( 'EDITOR_FILE_SEARCH_VER',  '1.0.0' );
define( 'EDITOR_FILE_SEARCH_FILE', __FILE__ );
define( 'EDITOR_FILE_SEARCH_BASE', plugin_basename( EDITOR_FILE_SEARCH_FILE ) );
define( 'EDITOR_FILE_SEARCH_DIR',  plugin_dir_path( EDITOR_FILE_SEARCH_FILE ) );
define( 'EDITOR_FILE_SEARCH_URI',  plugins_url( '/', EDITOR_FILE_SEARCH_FILE ) );

if ( is_admin() ) {
	require_once EDITOR_FILE_SEARCH_DIR . 'classes/class-editor-file-search.php';
}