<?php 
	
	header("Content-type: text/css"); 
	$leisure_parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] ); 
	require_once( $leisure_parse_uri[0].'wp-load.php' ); 
	do_action( 'curly_editor_style_import', true );

?>
/** General ----------------------------------------------------------------------------- */
#background-slider { position: fixed; top: 0; left: 0; right: 0; bottom: 0; }

#site { max-width: 1440px; margin: 0 auto; z-index: 1; }

a, a:hover { -webkit-transition: all 200ms ease-in; transition: all 200ms ease-in; outline: none; text-decoration: none; }

img { max-width: 100%; height: auto; border-radius: 2px; }

strong, b { font-weight: 500; }

abbr { border-color: currentColor; }

.wallpaper .container { z-index: 1; position: relative; }

input[type=number]::-webkit-inner-spin-button, input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }

::-moz-selection { border-radius: 2px; }

::selection { border-radius: 2px; }

::-moz-selection { border-radius: 2px; }

/** General > Typography ----------------------------------------------------------------------------- */
html { font-size: 62.5%; font-weight: 300; }

.lead { font-size: 125%; margin: 2.8rem 0; }

h1 { line-height: 1.2; }

h2 { line-height: 1.2; }

h3 { line-height: 1.2; }

h4 { line-height: 1.2; }

h5 { line-height: 1.2; }

h6 { line-height: 1.2; }

p, h1, h2, h3, h4, h5, h6, blockquote, ul { margin: 2.8rem 0 1.4rem; }

ul.list-unstyled li { margin-bottom: 1.4rem; }

dl dt { margin-top: 1.4rem; }

dl dt:first-of-type { margin-top: 0; }

h1 small, h2 small, h3 small { font-size: 50%; font-weight: normal; }

h4 small { font-size: 65%; }

h5 small, h6 small { font-size: 75%; }

h1, h2, h3, h4, h5, h6 { position: relative; }

#content h1[style*='center'], #content h2[style*='center'], #content h3[style*='center'], #content h4[style*='center'], #content h5[style*='center'], #content h6[style*='center'], #content h1.text-center, #content h2.text-center, #content h3.text-center, #content h4.text-center, #content h5.text-center, #content h6.text-center { margin-bottom: 6.2rem; }

#content h1[style*='center']::after, #content h2[style*='center']::after, #content h3[style*='center']::after, #content h4[style*='center']::after, #content h5[style*='center']::after, #content h6[style*='center']::after, #content h1.text-center::after, #content h2.text-center::after, #content h3.text-center::after, #content h4.text-center::after, #content h5.text-center::after, #content h6.text-center::after { content: ''; display: block; position: absolute; width: 6rem; border-bottom: .3rem solid; margin-top: 1.2rem; margin-left: -3rem; left: 50%; }

h1 small, h2 small, h3 small, h4 small, h5 small, h6 small { display: block; opacity: 0.8; line-height: 1.2; }

h1 .center-block, h2 .center-block, h3 .center-block, h4 .center-block, h5 .center-block, h6 .center-block { display: block; margin: 0 auto; line-height: 1.4; }

blockquote, blockquote p { margin-top: 0; }

blockquote { padding-left: 7rem; position: relative; border-left: none; }

blockquote::before { font-family: 'FontAwesome'; content: '\F10D'; position: absolute; top: 0; left: 0; font-size: 42px; }

blockquote cite { opacity: 0.5; display: block; margin-top: 1rem; }

blockquote cite::before { content: '\2014 \00A0'; }

hr { margin-top: 5.6rem; margin-bottom: 5.6rem; border-top: 1px solid; opacity: 0.2; }

hr.xs { margin-top: 3.2rem; margin-bottom: 3.2rem; }

.pullquote { width: 50%; max-width: 400px; margin-bottom: 2.8rem; }

.pullquote.pull-left { text-align: right; margin-right: 2.8rem; padding-right: 2.8rem; }

.pullquote.pull-right { margin-left: 2.8rem; padding-left: 2.8rem; border-left: 3px solid #EBF0F1; }

.animated { opacity: 0; }

.animated-children [class*="col-"] > * { opacity: 0; }

.no-animations .animated, .no-animations .animated-children [class*="col-"] > * { opacity: 1; }

.white-box { background-color: rgba(255, 255, 255, 0.85); border-radius: 2px; }

.white-box.content-padding { padding: 5.6rem; }

.white-box.content-padding-xs { padding: 3.2rem; }

ul ul, ul ol, ol ul, ol ol { margin-top: 0; }

.wp-post-image, img[class*=wp-image] { border-radius: 2px; margin-bottom: 1.4rem; -webkit-transition: all 200ms ease-in; transition: all 200ms ease-in; box-sizing: border-box; }

a .wp-post-image:hover, a img[class*=wp-image]:hover { opacity: .8; filter: alpha(opacity=80); }

.wp-caption { max-width: 100%; }

.wp-caption img { margin-bottom: 0; }

.wp-caption-text { font-size: 85%; padding: 0.7rem 1.4rem; margin: 0; -webkit-border-bottom-right-radius: 2px; -webkit-border-bottom-left-radius: 2px; -moz-border-radius-bottomright: 2px; -moz-border-radius-bottomleft: 2px; border-bottom-right-radius: 2px; border-bottom-left-radius: 2px; }

.aligncenter { margin: 0 auto 2.8rem; float: none; }

.alignright { float: right; margin: 0 0 1.4rem 2.8rem; }

.alignleft { float: left; margin: 0 2.8rem 1.4rem 0; }

.alignnone { float: none; }

.screen-reader-text { clip: rect(1px, 1px, 1px, 1px); position: absolute !important; height: 1px; width: 1px; overflow: hidden; }

/** Audio Player */
.mejs-container div :last-of-type, .mejs-container div :first-of-type { margin-bottom: auto !important; margin-top: auto !important; }

.mejs-controls .mejs-button button { margin: 7px 5px !important; }

.mejs-controls .mejs-time-rail .mejs-time-total { margin: 5px !important; }

.mejs-controls, .mejs-container { border-radius: 2px !important; }

/** Gallery */
.gallery { margin-left: -1.4rem; margin-right: -1.4rem; overflow: visible; }

.gallery::after { content: ' '; display: block; clear: both; }

.gallery-caption { width: auto; }

.gallery .gallery-item { float: left; padding: 0 1.4rem; margin-bottom: 2.8rem; text-align: center; }

.gallery .gallery-item .wp-caption-text { background: none !important; display: none; }

.gallery.gallery-columns-1 .gallery-item { width: 100%; }

.gallery.gallery-columns-2 .gallery-item { width: 50%; }

.gallery.gallery-columns-3 .gallery-item { width: 33.33333333%; }

.gallery.gallery-columns-4 .gallery-item { width: 25%; }

.gallery.gallery-columns-5 .gallery-item { width: 20%; }

.gallery.gallery-columns-6 .gallery-item { width: 16.6666666666%; }

.gallery.gallery-columns-7 .gallery-item { width: 14.285714286%; }

.gallery.gallery-columns-8 .gallery-item { width: 12.5%; }

.gallery.gallery-columns-9 .gallery-item { width: 11.111111111%; }

.gallery.gallery-columns-5, .gallery.gallery-columns-6, .gallery.gallery-columns-7 .gallery.gallery-columns-8, .gallery.gallery-columns-9 { margin-left: -0.7rem; margin-right: -0.7rem; }

.gallery.gallery-columns-5 .gallery-item, .gallery.gallery-columns-6 .gallery-item, .gallery.gallery-columns-7 .gallery-item, .gallery.gallery-columns-8 .gallery-item, .gallery.gallery-columns-9 .gallery-item { padding: 0 0.7rem; margin-bottom: 1.4rem; }

@media (max-width: 767px) { .gallery { margin-left: -0.7rem !important; margin-right: -0.7rem !important; }
  .gallery .gallery-item { width: 33.33333333% !important; padding: 0 0.7rem !important; margin-bottom: 1.4rem !important; } }
/** Calendar */
#wp-calendar { width: 100%; }

#wp-calendar thead th { border: none; border-bottom: 1px solid; }

#wp-calendar tbody td { text-align: center; border-bottom: 1px solid; line-height: 2.5em; transition: background 0.15s ease; -webkit-transition: background 0.15s ease; -o-transition: background 0.15s ease; -moz-transition: background 0.15s ease; }

#wp-calendar tbody td a { display: block; text-decoration: none; }

#wp-calendar tfoot td { padding-top: 1px; padding: 4px; }

#wp-calendar caption { cursor: pointer; text-transform: uppercase; margin: 0; padding: 12px; outline: 0 none !important; font-weight: bold; -webkit-border-top-left-radius: 2px; -webkit-border-top-right-radius: 2px; -moz-border-radius-topleft: 2px; -moz-border-radius-topright: 2px; border-top-left-radius: 2px; border-top-right-radius: 2px; }

#wp-calendar tbody a { display: block; text-decoration: underline; }

#wp-calendar th { text-align: center; border: 1px solid transparent; border-top: none; padding: 7px 0; }

#wp-calendar tfoot td { padding: 10px 0 0; }

/** Bootstrap Overrides ----------------------------------------------------------------------------- */
.display-block { display: block; }

.display-inline { display: inline; }

/** Form Elements **/
input[type=text], input[type=search], select, textarea, input[type=password], input[type=email], input[type=number], input[type=url], input[type=date], input[type=tel] { -webkit-transition: all 0.30s ease-in-out; -moz-transition: all 0.30s ease-in-out; -ms-transition: all 0.30s ease-in-out; -o-transition: all 0.30s ease-in-out; display: inline-block; width: 100%; min-height: 28px; box-shadow: none; -moz-box-shadow: none; -webkit-box-shadow: none; padding: 1rem 1.5rem; height: auto; border-radius: 2px; -webkit-appearance: none; -moz-appearance: textfield; appearance: none; padding-right: 20px; text-indent: 0.01px; text-overflow: ''; outline: none; border-width: 1px; border-style: solid; }

select { background-repeat: no-repeat !important; background-position: center right !important; background-size: 20px !important; }

body.gecko select, body.ie select { background-image: none !important; padding-right: 15px; }

.table { margin: 2.8rem 0 1.4rem; }

.table > thead > tr > th { border-bottom-width: 3px; }

/* Buttons */
.btn.btn-inline { padding: 0.9rem 0; display: inline-block; white-space: normal; font-weight: 500; border:none }

.btn, .comment-edit-link, .comment-reply-link, input[type=submit] { font-weight: 500; height: auto; padding: 1rem 2.8rem; -webkit-transition: all 200ms ease-in; transition: all 200ms ease-in; border-radius: 2px; border-width: 1px; border-style: solid; outline: none !important; }

.comment-edit-link, .comment-reply-link { border: none !important; display: inline-block; }

.btn:active { box-shadow: none; }

.btn.btn-lg { padding: 1.4rem 2.4rem; line-height: 1.4rem; }

.btn.btn-sm { padding: 0.5rem 0.7rem; }

.btn.btn-link, .comment-reply-link, .comment-edit-link { padding-left: 0; padding-right: 0; text-decoration: none !important; font-weight: normal; background: none; border: none; }

.btn.btn-link::before, .comment-reply-link::before { content: '\f178'; font-family: 'FontAwesome'; font-size: 14px; display: inline-block; margin-right: 10px; line-height: 20px; }

.btn.btn-block { padding-left: inherit; padding-right: inherit; text-align: center; }

/** Font Awesome ----------------------------------------------------------------------------- */
h1 .fa, h2 .fa, h3 .fa, h4 .fa, h5 .fa, h6 .fa { font-size: inherit; text-align: inherit; }

h1 .fa.fa-lg, h2 .fa.fa-lg, h3 .fa.fa-lg, h4 .fa.fa-lg, h5 .fa.fa-lg, h6 .fa.fa-lg { font-size: 125%; }

.fa-bordered { line-height: 1.28571429em; height: 1.28571429em; border-radius: 100%; border-width: 1px; border-style: solid; border-color: inherit; box-sizing: content-box; }

.fa-boxed { display: inline-block; text-align: center; line-height: 1.28571429em; height: 1.28571429em; border-radius: 100%; margin: 0 1px; box-sizing: content-box; padding: 3px; }

.fa-boxed::before { color: inherit; }

.fa-boxed.fa-rss { background: #dca334; }

.fa-boxed.fa-pinterest { background: #dd4430; }

.fa-boxed.fa-facebook { background: #2f5c95; }

.fa-boxed.fa-twitter { background: #398feb; }

.fa-boxed.fa-linkedin { background: #1E7DB5; }

.fa-boxed.fa-google-plus { background: #C73A35; }

/** Dropcap ----------------------------------------------------------------------------- */
.dropcap { float: left; font-size: 7rem; line-height: 6rem; padding-top: 4px; padding-right: 8px; padding-left: 3px; }

<?php do_action( 'curly_editor_style', true ); ?>