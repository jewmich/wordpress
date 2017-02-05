<?php

function generateUmSchoolYearDropDown($atts) {
	$options = array('');
	for ($i = 0; $i < 5; $i++) {
		$options[] = date('Y') + $i;
	}
	for ($i = 0; $i < 4; $i++) {
		$options[] = 'Grad ' . (date('Y') + $i);
	}
	$options[] = 'Other';

	$selectName = isset($atts['name']) ? $atts['name'] : 'student';
	$selectedValue = isset($atts['value']) ? $atts['value'] : null;
	$html = "<select size='1' name='$selectName'>";
	foreach ($options as $option) {
		$html .= "\n<option" . (($option == $selectedValue) ? ' selected' : '') . ">$option</option>\n";
	}
	$html .= '</select>';
	return $html;
}
add_shortcode('um_school_year_dropdown', 'generateUmSchoolYearDropDown');
