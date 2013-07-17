<?php

class epdu {	
	function layout($username,$order,$visible) {
	
		$html = '<ul class="epdu_userlist">';
			if($username == 'all') {
				foreach(epdu_get('list',$order,$visible) as $user) :
					$html .= $this->userlist_html($user);
				endforeach;
			} else {
				$user = epdu_get('single','','',$username);
				$html .= $this->userlist_html($user);
			}
		$html .= '</ul>';
		
		echo $html;
	}
	
	function shortcode($args) {
		$user_login = $args['username'];		
		
		$html = '<ul class="epdu_userlist">';
		
			if($user_login == 'all') {
				if($args['order']) {
					$order = $args['order'];
				} else {
					$order = 'ID';
				}

				if($args['visible']) {
					$visible = $args['visible'];
				} else {
					$visible = 'is_visible';
				}
				
				foreach(epdu_get('list',$order,$visible) as $user)  {
					$html .= $this->userlist_html($user);
				}
			} else {
				$user = epdu_get('single','','',$user_login);
				$html .= $this->userlist_html($user);
			} 
			
		$html .= '</ul>';
		
		return $html;
	}
	
	private function userlist_html($user) {
		$html .= '<li>';
			
			$html .= '<div class="user-info">';
				$html .= '<h2>'.$user->display_name.'</h2>';
				if($user->epdu_position) $html .= '<p>'.$user->epdu_position.'</p>';
				$html .= '<ul>';
					if($user->show_user_email) $html .= '<li><strong>E-mail:</strong> '.$user->user_email.'</li>';
					if($user->epdu_phone) $html .= '<li><strong>Phone:</strong> '.$user->epdu_phone.'</li>';
					if($user->epdu_city) $html .= '<li><strong>City:</strong> '.$user->epdu_city.'</li>';
					if($user->epdu_age) $html .= '<li><strong>Age:</strong> '.$this->get_age($user->epdu_age).'</li>';
					if($user->user_url) $html .= '<li><strong>Website:</strong> <a href="'.$user->user_url.'" target="_blank">'.str_replace('http://','',$user->user_url).'</a></li>';
				$html .= '</ul>';
			$html .= '</div>';
			$html .= '<div class="user-photo">';
				if(function_exists('userphoto_thumbnail')) {
					ob_start();
						userphoto($user->ID);
						$html .= ob_get_contents();
					ob_end_clean();
				} else {
					$html .= get_avatar($user->ID, 180);
				}
			$html .= '</div>';
			if($user->user_description) $html .= '<div class="user_desc">'.nl2br($user->user_description).'</div>';
			
		$html .= '</li>';
		
		return $html;
	}

	private function get_age($birthdate = NULL) {
    	list($Y,$m,$d) = explode("-",$birthdate);

    	if(date("md") < $m.$d) {
    		$age = date("Y")-$Y-1;
    	} else {
    		$age = date("Y")-$Y;
    	}

    	return($age);
	}
}

function ep_display_users($username='all',$order='ID',$visible='is_visible') {
	$epdu = new epdu;
	echo $epdu->layout($username,$order,$visible);
}

function epdu_shortcode($args){
	$epdu = new epdu;
 	return $epdu->shortcode($args);
}
add_shortcode('ep_display_users', 'epdu_shortcode');
?>