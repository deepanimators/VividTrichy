<?php
class LeisureWPML {

	public static function get_wpml_selector(){

		if( ! class_exists('SitePress') || filter_var( esc_attr( get_theme_mod( 'wpml' ) ), FILTER_VALIDATE_BOOLEAN ) )
			return;


		$languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' );

		if( ! empty( $languages ) ){

			$html = '<div class="wpml-switcher">';

			foreach( $languages as $language ){
				$code = isset( $language['code'] ) ? $language['code'] : '';
				$code = isset( $language['language_code'] ) ? $language['language_code'] : $code;
				if( $language['active'] ) {
					$html .= '<span class="active">';
				} else {
					$html .= '<span>';
				}
				if( ! $language['active'] ) {
					$html .= '<a href="'.$language['url'].'">';
				}
				$html .= $code;
				if( ! $language['active'] ) {
					$html .= '</a>';
				}
				$html .= '</span>';
			}

			$html .= '</div>';
		}

		echo ( isset( $html ) ) ? $html : null;
	}

}

if( class_exists('SitePress' ) ) {
	new LeisureWPML();
}
