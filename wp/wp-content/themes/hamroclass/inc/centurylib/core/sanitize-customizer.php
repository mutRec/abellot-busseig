<?php
/*
 * Sanitize Repeater Data
 */
if ( ! function_exists( 'centurylib_sanitize_repeater_data' ) ){
	function centurylib_sanitize_repeater_data( $repeater_value ){
		$repeater_json = json_decode( $repeater_value, true );
		if( !empty( $repeater_json ) ) {
			foreach ( $repeater_json as $boxes => $box ){
				foreach ( $box as $key => $value ){
					if( $key == 'link' || $key == 'image' ){
						$repeater_json[$boxes][$key] = esc_url_raw( $value );
					}
                    elseif ( $key == 'checkbox' ){
						$repeater_json[$boxes][$key] = centurylib_sanitize_checkbox( $value );
					}
					else{
						$repeater_json[$boxes][$key] = esc_attr( $value );
					}
				}
			}
			return json_encode( $repeater_json );
		}
		return json_encode(array());
	}
}

/*
 * Sanitize Checkbox Data
 */
if(!function_exists('centurylib_sanitize_checkbox')){

	function centurylib_sanitize_checkbox($is_checked){

		return ( ( isset( $is_checked ) && true == $is_checked ) ? true : false );

	}

}
