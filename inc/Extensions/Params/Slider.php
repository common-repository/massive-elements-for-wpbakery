<?php
/**
 * @package  MEWVC
 */
namespace Inc\Extensions\Params;

class Slider {
	function __construct() {

		$path =  plugin_dir_url(__FILE__);

		if ( defined( 'WPB_VC_VERSION' ) && version_compare( WPB_VC_VERSION, 4.8 ) >= 0 ) {
			if ( function_exists( 'vc_add_shortcode_param' ) ) {
				vc_add_shortcode_param('prime_slider' , array($this, 'prime_slider_range_settings'), $path . 'js/slider-param.js');
			}
		} else {
			if ( function_exists( 'add_shortcode_param' ) ) {
				add_shortcode_param( 'prime_slider', array($this, 'prime_slider_range_settings'), $path . 'js/slider-param.js');
			}
		}
	}


	function prime_slider_range_settings( $settings, $value ) {
		$defaults = array(
			'min'        => 0,
			'max'        => 100,
			'step'       => 1,
			'value'      => 0,
			'unit'       => '',
			'fill'       => true,
			'hide_input' => false,
		);
		$settings = wp_parse_args( $settings, $defaults );
		$value    = $value == null ? $settings['value'] : $value;

		$slider = '<div class="prime-vc-slider' . ( $settings['hide_input'] ? ' prime-hide-input' : '' ) . ( $settings['fill'] ? ' prime-fill' : '' ) . '">';
		$slider .= '<div class="prime-slider" data-min="' . esc_attr( $settings['min'] ) . '" data-max="' . esc_attr( $settings['max'] ) . '" data-step="' . esc_attr( $settings['step'] ) . '" data-value="' . esc_attr( $value ) . '"></div>';
		$slider .= '</div>';

		$input = '<input class="prime-value wpb_vc_param_value wpb-input ' . esc_attr( $settings['param_name'] ) . '" name="' . esc_attr( $settings['param_name'] ) . '" value="' . esc_attr( $value ) . '" type="text" />';

		$unit = $settings['unit'] != '' ? '<span class="prime-unit">' . $settings['unit'] . '</span>' : '';

		return '<div class="prime-slider-wrap">' . $slider . $unit . $input . '</div>';
	}

}