<?php
/*
Plugin Name: No Updates For Plugins Under Revision Control
Description: Disables updates for plugins under revision control. Based on <a href="http://developersmind.com/2010/06/12/preventing-wordpress-from-checking-for-updates-for-a-plugin/">code</a> by PeteMall.
Author: Adam Harley
Author URI: http://adamharley.co.uk
Plugin URI: http://adamharley.co.uk/wordpress-plugins/no-updates-for-plugins-under-revision-control/
Version: 1.1
License: GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/


if ( !defined('REVISION_CONTROL' ) )
	define( 'REVISION_CONTROL', '.svn' );


add_filter( 'plugin_row_meta', 'svn_plugin_row_meta', 10, 2 );

function svn_plugin_row_meta( $plugin_meta, $plugin_slug ) {
	$plugins_dir = trailingslashit( WP_PLUGIN_DIR );
	$plugin_rev_dir = plugin_dir_path( $plugins_dir . $plugin_slug ) . REVISION_CONTROL;
	
	if ( $plugin_rev_dir != $plugins_dir.REVISION_CONTROL && file_exists( $plugin_rev_dir ) )
		$plugin_meta[] = __('Revision controlled', 'no-updates-for-plugins-under-svn');
	
	return $plugin_meta;
}


add_filter( 'http_request_args', 'svn_prevent_update_check', 10, 2 );

function svn_prevent_update_check( $r, $url ) {
	if ( 0 === strpos( $url, 'http://api.wordpress.org/plugins/update-check/' ) ) {
		$plugins = unserialize( $r['body']['plugins'] );
		$plugins_dir = trailingslashit( WP_PLUGIN_DIR );

		foreach( array_keys( $plugins->plugins ) as $plugin_slug ) {
			$plugin_rev_dir = plugin_dir_path( $plugins_dir . $plugin_slug ) . REVISION_CONTROL;
			if ( $plugin_rev_dir != $plugins_dir.REVISION_CONTROL && file_exists( $plugin_rev_dir ) )
				unset( $plugins->plugins[$plugin_slug], $plugins->active[array_search( $plugin_slug, $plugins->active )] );
		}

		$r['body']['plugins'] = serialize( $plugins );
	}
	return $r;
}