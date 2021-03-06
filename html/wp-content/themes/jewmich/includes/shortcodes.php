<?php

add_shortcode('um_school_year_dropdown', function ($atts = []) {
	$options = array('');
	for ($i = 0; $i < 5; $i++) {
		$options[] = date('Y') + $i;
	}
	for ($i = 0; $i < 4; $i++) {
		$options[] = 'Grad ' . (date('Y') + $i);
	}
	$options[] = 'Other';

	$selectName = isset($atts['name']) ? $atts['name'] : 'student';
	$selectClass = isset($atts['class']) ? $atts['class'] : null;
	$selectedValue = isset($atts['value']) ? $atts['value'] : null;
	$html = "<select name='$selectName' class='$selectClass' required> \n <option value=''>Choose One</option> ";
	foreach ($options as $option) {
		$html .= "

		\n<option" . (($option == $selectedValue) ? ' selected' : '') . ">$option</option>\n";


	}
	$html .= '</select>';
	return $html;
});



add_shortcode('plugnpay_success_link', function($atts = []) {
	$url = get_site_url(null, "/successredirect?type={$atts['type']}");
	return '<input name="success-link" type="hidden" value="' . $url . '">';
});

add_shortcode('user_welcome', function($atts = []) {
	$user = wp_get_current_user();
	if (!$user->exists()) return '';
	return '
		<div class="chabad" style="text-align: center; padding-bottom: 5px;">
			Welcome, ' . esc_html($user->display_name) . '<br>
			<a href="myaccount">My Account</a> &ndash; <a href="logout?return=' . get_page_uri() . '">Logout</a>
		</div>
	';
});
