<?php
/*
Plugin Name: EP Display Users
Plugin URI: http://darkwhispering.com/wordpress-plugins
Description: Adding extra user info fields and options to display user on the site with template code, shortcode or widget.
Version: 0.1.3
Author: Mattias Hedman
Author URI: http://darkwhispering.com
*/

define('EP_DISPLAY_USERS_VERSION', '0.1.3');
// Plugin version
update_option('ep_display_users_version',EP_DISPLAY_USERS_VERSION);

function epdu_site_css() {
	echo '<link href="'.plugins_url('style.css',__FILE__).'" rel="stylesheet" />';
}
add_action('wp_head','epdu_site_css');

/* No JS file neede yet, but keeping code if it will be implemented one day
function epdu_site_scripts() {
	echo '<script src="'.plugins_url('script.js',__FILE__).'"></script>';
}
add_action('wp_head','epdu_site_scripts');
*/

include_once(dirname( __FILE__ ).'/files/user_profile.php');
include_once(dirname( __FILE__ ).'/files/widget.php');
include_once(dirname( __FILE__ ).'/files/site.php');

class epduInit {
	function __construct() {
		global $wpdb;
		$this->wpdb = $wpdb;
		$this->table = $this->wpdb->users;
	}
	
	function epdu_get_users($order,$visible){
		$user_ids = $this->wpdb->get_col("SELECT ID FROM $this->table ORDER BY $order ASC");
		$userarray = array();
		$i=0;
		foreach($user_ids as $user_id){
			$user = get_userdata($user_id);
			if(get_the_author_meta($visible,$user->ID)){
				$userobj->user_firstname	=	$user->user_firstname;
				$userobj->user_lastname 	= 	$user->user_lastname;
				$userobj->user_nicename 	= 	$user->user_nicename;
				$userobj->display_name 		= 	$user->display_name;
				$userobj->ID 				= 	$user->ID;
				$userobj->user_email 		= 	$user->user_email;
				$userobj->user_url 			= 	$user->user_url;
	 			$userobj->user_description 	= 	$user->user_description;
				$userobj->epdu_position 	= 	get_the_author_meta('epdu_position',$user->ID);
				$userobj->show_user_email 	= 	get_the_author_meta('show_user_email',$user->ID);
				$userobj->epdu_phone 		= 	get_the_author_meta('epdu_phone',$user->ID);
				$userobj->epdu_city 		= 	get_the_author_meta('epdu_city',$user->ID);
				$userobj->epdu_age 			= 	get_the_author_meta('epdu_age',$user->ID);
			
				$userarray[] = $userobj;
				unset($userobj);
			}
		}
		return $userarray;
	}
	
	function epdu_get_user($user_login) {
		$user = get_userdata($this->wpdb->get_var("SELECT ID FROM $this->table WHERE user_login = '$user_login' LIMIT 1"));
		if(get_the_author_meta('is_visible',$user->ID)) {
			$userobj->user_firstname	=	$user->user_firstname;
			$userobj->user_lastname 	= 	$user->user_lastname;
			$userobj->user_nicename 	= 	$user->user_nicename;
			$userobj->display_name 		= 	$user->display_name;
			$userobj->ID 				= 	$user->ID;
			$userobj->user_email 		= 	$user->user_email;
			$userobj->user_url 			= 	$user->user_url;
 			$userobj->user_description 	= 	$user->user_description;
			$userobj->epdu_position 	= 	get_the_author_meta('epdu_position',$user->ID);
			$userobj->show_user_email 	= 	get_the_author_meta('show_user_email',$user->ID);
			$userobj->epdu_phone 		= 	get_the_author_meta('epdu_phone',$user->ID);
			$userobj->epdu_city 		= 	get_the_author_meta('epdu_city',$user->ID);
			$userobj->epdu_age 			= 	get_the_author_meta('epdu_age',$user->ID);
		
			$userarray = $userobj;
			unset($userobj);
		}
		return $userarray;
	}
}

function epdu_get($type='list',$order,$visible,$user_login='') {
	$users = new EpduInit;
	if($type == 'list') {
		return $users->epdu_get_users($order,$visible);
	} elseif($type == 'single') {
		return $users->epdu_get_user($user_login);
	}
}

?>