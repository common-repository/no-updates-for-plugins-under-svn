=== No Updates for Plugins under Revision Control ===
Contributors: kawauso
Donate link: http://adamharley.co.uk/buy-me-a-coffee/
Tags: svn, plugins, updates, revision control, git
Requires at least: 3.0
Tested up to: 3.2
Stable tag: 1.1

Prevents plugins from being updated by the WordPress updater if they are under Subversion revision control (or other systems).

== Description ==

Checks for the presence of the `.svn` directory in each plugin's directory. Disabled for plugins with their files directly in the `/plugins/` directory to prevent false positives.

Also supports other systems through the use of the `REVISION_CONTROL` constant. Just set this to the directory created by your revision control system in your `wp-config.php`

Based on <a href="http://developersmind.com/2010/06/12/preventing-wordpress-from-checking-for-updates-for-a-plugin/">code</a> by PeteMall.

== Installation ==

1. Upload `no-updates-for-plugins-under-svn.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Changelog ==

= 1.1 =
* Added support for other revision control systems
* Added plugin meta for controlled plugins
* Changed from strpos() to substr() for update URL check
* Changed name to 'No Updates for Plugins under Revision Control'

= 1.0 =
* First public release

== Upgrade Notice ==

= 1.1 =
Changed name to '...under Revision Control' and added support for other revision control systems through a constant. Added plugin meta for revision controlled plugins.