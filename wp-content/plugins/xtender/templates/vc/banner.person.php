<?php
$img = ! is_null( $image ) && ! empty( $image  ) ? wp_get_attachment_image( $image, 'large' ) : '';
$person_name = esc_attr( $person_name );
$person_title = ! is_null( $person_title ) && ! empty( $person_title  ) ? "<small>" . esc_attr( $person_title ) . "</small>" : '';
$person_position = ! is_null( $person_position ) && ! empty( $person_position  ) ? "<span>" . esc_attr( $person_position ) . "</span>" : '';
$html = isset( $link['url'] ) && strlen ( $link['url'] ) > 0 ?  "<div class='xtd-person {$el_css}'><a href='{$link['url']}' target='{$link['target']}'>" : "<div class='xtd-person {$el_css}'>";
$html .= $img;
$html .= "<div class='xtd-person__info'><div class='xtd-person__title'>{$person_title}{$person_name}{$person_position}</div><div class='xtd-person__content'>" . do_shortcode( $content ) . "</div></div>";
$html .= isset( $link['url'] ) && strlen ( $link['url'] ) > 0 ? "</a></div>" : "</div>";

?>
