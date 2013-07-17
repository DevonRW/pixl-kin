=== EP Display Users ===
Contributors: Earth People, darkwhispering, fjallstrom
Tags: plugin, widget, social, user, users, userlist, profile, avatar, info, userinfo, shortcode
Requires at least: 3.3.0
Tested up to: 3.5.0
Stable tag: 0.1.3

Adding extra user info fields and options to display user on the site with template code, shortcode or widget.

== Description ==
Display a list of all the users on your site and give you extra fields in the profile to add more information about the users and control if they should be visible on the site or not.

As default the plugins displays the users gravatar, if there is no one, it defaults back to the "mystery man" avatar. If you wish not to use gravatar or want more control of the avatars, this plugin work with the [User Photo](http://wordpress.org/extend/plugins/user-photo/) plugin.

There are 3 different ways of displaying the users on your site. You can use the template code in your theme, shortcode in post and pages or the random widget.

**Template code example** *(displays all users that is set to visible)*:
`
<?php
if(function_exists('ep_display_users')) {
ep_display_users($username,$order,$visible);
}
?>

$username (optional) - To display one user only, set the username here.
Default: all

$order (optional) - Any field in the wp_users tabel to sort by.
Default: ID

$visible (optional) - What visible status should be followed.
Available: is_visible, is_sidebar
Default: is_visible
`

**Shortcode:**
`
[ep_display_users username="$username" order="$order" visible="$visible"]

$username (required) - The username of user to display or "all" to display a list of all users.

$order (optional) - Any field in the wp_users tabel to sort by.
Default: ID

$visible (optional) - What visible status should be followed.
Available: is_visible, is_sidebar
Default: is_visible
`

Widget:
The widget displays one random user in your widget area. If a users is visible or not in the widget can be controlled via there profile settings. It also give you the option to add some own text, set size of avatar (when using wordpress gravatars only), link name and link path to the site with your list of users.

== Installation ==

1. Upload the zipped file to yoursite/wp-content/plugins
2. Activate the plugin through the 'Plugins' menu in WordPress

== Screenshots ==

1. New fields in a users profile.
2. Widget settings
3. User with use of template code or shortcode
4. Widget user

== Changelog ==

= 0.1.3 =
* Tested on wordpress 3.5
* Fixed issue with line break option in widget

= 0.1.2 =
* Fixed css file issues

= 0.1.1 =
* Made the code work with PHP versions below 5.3

= 0.1.0 =
* initial release