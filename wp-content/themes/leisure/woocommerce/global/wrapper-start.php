<?php 
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; if(is_active_sidebar('sidebar_shop')) : ?>
<div id="content">
	<div class="main-wrapper">
		<div class="container-fluid with-sidebar">
			<div class="row animated">
				<div class="col-lg-8 col-md-8">
<?php else : ?>
<div id="content">
	<div class="main-wrapper">
		<div class="container-fluid">
			<div class="row animated">
				<div class="col-lg-12 col-md-12">
<?php endif; ?>		