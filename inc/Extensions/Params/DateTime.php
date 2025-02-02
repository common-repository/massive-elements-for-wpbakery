<?php
/**
 * @package  EssentialAddonsVC
 */
namespace Inc\Extensions\Params;

class DateTime {
	function __construct() {

		$path =  plugin_dir_url(__FILE__);

		if ( defined( 'WPB_VC_VERSION' ) && version_compare( WPB_VC_VERSION, 4.8 ) >= 0 ) {
			if ( function_exists( 'vc_add_shortcode_param' ) ) {
				vc_add_shortcode_param('datetimepicker' , array($this, 'datetimepicker'), $path . 'js/datetime-param.js');
			}
		} else {
			if ( function_exists( 'add_shortcode_param' ) ) {
				add_shortcode_param( 'datetimepicker', array($this, 'datetimepicker'), $path . 'js/datetime-param.js');
			}
		}
	}

	function datetimepicker($settings, $value)
	{
		$dependency = '';
		$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
		$type = isset($settings['type']) ? $settings['type'] : '';
		$class = isset($settings['class']) ? $settings['class'] : '';
		$uni = uniqid('datetimepicker-'.rand());
		$output = '<div id="ult-date-time'.esc_attr( $uni ).'" class="ult-datetime"><input data-format="yyyy/MM/dd hh:mm:ss" readonly class="wpb_vc_param_value ' . esc_attr( $param_name ) . ' ' . esc_attr( $type ) . ' ' . esc_attr( $class ) . '" name="' . esc_attr( $param_name ) . '" style="width:258px;" value="'. esc_attr( $value ).'" '.$dependency.'/><div class="add-on" >  <i data-time-icon="fa fa-calendar-o" data-date-icon="fa fa-calendar-o"></i></div></div>';
		$output .= '<script type="text/javascript">

				</script>';
		return $output;
	}
}