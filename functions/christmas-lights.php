<?php

// гирлянды

if ( ! is_admin() ) {
	add_action( 'rcl_enqueue_scripts', 'chr_get_christmas_lights_style', 10 );
}
function chr_get_christmas_lights_style() {
	// вверху сайта
	if ( rcl_get_option( 'chr_top_light', 0 ) == 1 ) {
		chr_christmas_lights_style();
	}
	// в ЛК
	if ( rcl_get_option( 'chr_lk_light', 0 ) == 1 ) {
		if ( ! rcl_is_office() ) {
			return;
		}
		chr_christmas_lights_style();
	}
}

function chr_christmas_lights_style() {
	rcl_enqueue_style( 'christmas_lights', rcl_addon_url( 'assets/css/christmas-lights.css', __FILE__ ) );
}

// гирлянды вверху сайта
add_action( 'wp_footer', 'chr_christmas_lights_top_site', 10 );
function chr_christmas_lights_top_site() {
	if ( rcl_get_option( 'chr_top_light', 0 ) != 1 ) {
		return;
	}

	$chr_margin = '';
	if ( rcl_get_option( 'view_recallbar' ) == 1 ) {
		$chr_margin = 'margin:20px 0 0;';
	}

	$chr_time_long = rcl_get_option( 'chr_top_light_time', 'infinite' );
	$chr_position  = rcl_get_option( 'chr_top_light_pos', 'fixed' );
	echo '<style>.top_rclbr.lightrope li {animation-iteration-count:' . $chr_time_long . ';}
.top_rclbr.lightrope {position:' . $chr_position . ';
' . $chr_margin . '
}</style>
<script>(function($){$("body").append("<ul class=\"top_rclbr lightrope\">"
+ "<li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>"
+ "<li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>"
+ "<li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>"
+ "<li></li><li></li><li></li><li></li><li></li><li></li></ul>")
})(jQuery);</script>';

}


// в лк гирлянды
rcl_block( 'before', 'chr_light_profile' );
function chr_light_profile() {
	if ( rcl_get_option( 'chr_lk_light', 0 ) != 1 ) {
		return false;
	}

	// https://codepen.io/tobyj/pen/QjvEex
	$chr_prf_time = rcl_get_option( 'chr_lk_light_time', 'infinite' );

	return '<ul class="lightrope"><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li>
</li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li></ul>
<style>.lightrope li{animation-iteration-count:' . $chr_prf_time . ';}</style>';
}
