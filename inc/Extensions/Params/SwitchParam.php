<?php
/**
 * @package  EssentialAddonsVC
 */
namespace Inc\Extensions\Params;


class SwitchParam{
	function __construct()
	{
		if(defined('WPB_VC_VERSION') && version_compare(WPB_VC_VERSION, 4.8) >= 0) {
			if(function_exists('vc_add_shortcode_param'))
			{
				vc_add_shortcode_param('mew_switch' , array($this, 'checkbox_param'));
			}
		}
		else {
			if(function_exists('add_shortcode_param'))
			{
				add_shortcode_param('mew_switch' , array($this, 'checkbox_param'));
			}
		}
	}

	function checkbox_param($settings, $value){
		$dependency = '';
		$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
		$type = isset($settings['type']) ? $settings['type'] : '';
		$options = isset($settings['options']) ? $settings['options'] : '';
		$class = isset($settings['class']) ? $settings['class'] : '';
		$default_set = isset($settings['default_set']) ? $settings['default_set'] : false;
		$output = $checked = '';
		$un = uniqid('ultswitch-'.rand());
		if(is_array($options) && !empty($options)){
			foreach($options as $key => $opts){
				if($value == $key){
					$checked = "checked";
				} else {
					$checked = "";
				}
				$uid = uniqid('ultswitchparam-'.rand());
				$output .= '<div class="mew-onoffswitch">
							<input type="checkbox" name="'.esc_attr( $param_name ).'" value="'.esc_attr( $value ).'" '.$dependency.' class="wpb_vc_param_value ' . esc_attr( $param_name ) . ' ' . esc_attr( $type ) . ' ' . esc_attr( $class ) . ' '.esc_attr( $dependency ).' mew-onoffswitch-checkbox chk-switch-'.esc_attr( $un ).'" id="switch'.esc_attr( $uid ).'" '.$checked.'>
							<label class="mew-onoffswitch-label" for="switch'.esc_attr( $uid ).'">
								<div class="mew-onoffswitch-inner">
									<div class="mew-onoffswitch-active">
										<div class="mew-onoffswitch-switch">'.esc_html( $opts['on'] ).'</div>
									</div>
									<div class="mew-onoffswitch-inactive">
										<div class="mew-onoffswitch-switch">'.esc_html( $opts['off'] ).'</div>
									</div>
								</div>
							</label>
						</div>';
				if(isset($opts['label']))
					$lbl = $opts['label'];
				else
					$lbl = '';
				$output .= '<div class="chk-label">'.$lbl.'</div><br/>';
			}
		}

		if($default_set)
			$set_value = 'off';
		else
			$set_value = '';

		//$output .= '<input type="hidden" id="chk-switch-'.$un.'" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.$value.'" />';
		$output .= '<script type="text/javascript">
				jQuery("#switch'.esc_attr( $uid ).'").change(function(){

					 if(jQuery("#switch'.esc_attr( $uid ).'").is(":checked")){
						jQuery("#switch'.esc_attr( $uid ).'").val("'.esc_attr( $key ).'");
						jQuery("#switch'.esc_attr( $uid ).'").attr("checked","checked");
					 } else {
						jQuery("#switch'.esc_attr( $uid ).'").val("'.esc_attr( $set_value ).'");
						jQuery("#switch'.esc_attr( $uid ).'").removeAttr("checked");
					 }

				});
			</script>';

		return $output;
	}

}


