<?php
add_action('widgets_init','load_epdu_widget');

function load_epdu_widget() {
	register_widget('epdu_widget');
}

class epdu_widget extends WP_Widget {
	function epdu_widget() {
		//Settings
		$widget_ops = array('classname'=>get_class(),'description'=>__('Display random user/member with profile avatar, name and more','epdu-widget'));
		
		//Controll settings
		$control_ops = array('id_base' => get_class());
		
		//Create widget
		$this->WP_Widget(get_class(),__('EP Display User'),$widget_ops,$control_ops);
		
		global $wpdb;
		$this->wpdb = $wpdb;
	}
	
	function widget($args,$instance) {
		extract($args);
		
		//User selected settings
		$title 			= $instance['title'];
		$info_text 		= $instance['info_text'];
		$nl2br 			= $instance['nl2br'];
		$link_name 		= $instance['link_name'];
		$link_url 		= $instance['link_url'];
		$gravatar_size 	= $instance['gravatar'];
		
		echo $before_widget;
		
		if ($title) echo $before_title . __($title) . $after_title;
		
		$user = $this->epdu_get_random_user();
		?>
		
		<div class="epdu-widget-box">
			<?php
				if (function_exists('userphoto')) userphoto_thumbnail($user->ID);
				else echo get_avatar($user->ID, $gravatar_size);
			?>
			
			<div class="epdu-widget-title"><?php echo $user->display_name; ?></div>
			<?php if ($user->epdu_position) echo '<p>'.$user->epdu_position.'</p>'; ?>
			<?php if ($user->user_description) echo '<div class="user_desc">'.$this->epdu_excerpt($user->user_description,20,'...').'</div>'; ?>
			
			<?php if ($nl2br) : ?>
				<p><?php echo nl2br($info_text); ?></p>
			<?php else : ?>
				<p><?php echo $info_text; ?></p>
			<?php endif; ?>

			<?php if ($link_name && $link_url) : ?>
				<a href="<?php echo $link_url; ?>" class="link-btn"><?php echo $link_name ?> &raquo;</a>
			<?php endif; ?>
		
		</div>
		
		<?php

		echo $after_widget;
	}
	
	function update($new_instance,$old_instance) {
		$instance = $old_instance;
		
		$instance['title'] 		= strip_tags($new_instance['title']);
		$instance['info_text'] 	= strip_tags($new_instance['info_text']);
		$instance['nl2br'] 		= strip_tags($new_instance['nl2br']);
		$instance['link_name'] 	= strip_tags($new_instance['link_name']);
		$instance['link_url'] 	= strip_tags($new_instance['link_url']);
		$instance['gravatar'] 	= strip_tags($new_instance['gravatar']);
		
		return $instance;
	}

	function form($instance) {
		$default = array('title'=>'','info_text' => '', 'nl2br' => '', 'link_name' => 'Display all users', 'link_url' => '', 'gravatar' => 185);
		$instance = wp_parse_args((array)$instance,$default);
	?>
		<!-- TITLE -->
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __('Title:'); ?></label>
			<br />
			<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>
		
		<?php if(!function_exists('userphoto')) : ?>
		<!-- GRAVATAR -->
		<p>
			<label for="<?php echo $this->get_field_id('gravatar'); ?>"><?php echo __('Gravatar width:'); ?></label>
			<br />
			<input type="text" id="<?php echo $this->get_field_id('gravatar'); ?>" name="<?php echo $this->get_field_name('gravatar'); ?>" value="<?php echo $instance['gravatar']; ?>" class="widefat" />
		</p>
		<?php endif; ?>
		
		
		<!-- INFO TEXT -->
		<p>
			<label for="<?php echo $this->get_field_id('info_text'); ?>"><?php echo __('Optional info text below user info:'); ?></label>
			<br />
			<textarea rows="15" class="widefat" id="<?php echo $this->get_field_id('info_text'); ?>" name="<?php echo $this->get_field_name('info_text'); ?>"><?php echo $instance['info_text']; ?></textarea>
		
			<!-- STYCKES DELNING -->
			<label for="<?php echo $this->get_field_id('nl2br'); ?>">
				<input type="checkbox" id="<?php echo $this->get_field_id('nl2br'); ?>" name="<?php echo $this->get_field_name('nl2br'); ?>" value="1" <?php echo ($instance['nl2br']) ? 'checked="checked"' : ''; ?> />
				<?php echo __('Automatically add paragraphs'); ?>
			</label>
		</p>
		
		<!-- LINK NAME -->
		<p>
			<label for="<?php echo $this->get_field_id('link_name'); ?>"><?php echo __('Link name:'); ?></label>
			<br />
			<input type="text" id="<?php echo $this->get_field_id('link_name'); ?>" name="<?php echo $this->get_field_name('link_name'); ?>" value="<?php echo $instance['link_name']; ?>" class="widefat" />
		</p>
		
		<!-- LINK URL -->
		<p>
			<label for="<?php echo $this->get_field_id('link_url'); ?>"><?php echo __('Link url:'); ?></label>
			<br />
			<input type="text" id="<?php echo $this->get_field_id('link_url'); ?>" name="<?php echo $this->get_field_name('link_url'); ?>" value="<?php echo $instance['link_url']; ?>" class="widefat" />
		</p>	
	<?php
	
	}
	
	private function epdu_get_random_user() {
		$users = epdu_get('list','ID','is_sidebar');
		$user = $users[rand(0,count($users)-1)];
		return $user;
	}
	
	private function epdu_excerpt($text='',$excerpt_length = 10,$excerptEnd) {
		global $post;
		if($text == '') {
			$text = get_the_content('');
		} else {
			$text = apply_filters('the_content', $text);
			$text = str_replace(']]>', ']]&gt;', $text);
			$text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
			$text = strip_tags($text, '<p>');
			$words = explode(' ', $text, $excerpt_length + 1);
			if (count($words)> $excerpt_length) {
				array_pop($words);
				# Style the end of the excerpt here.
				array_push($words, $excerptEnd.'</p>');
				$text = implode(' ', $words);
			}
		}
		echo $text;
	}
}


?>