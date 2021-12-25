<?php /** @noinspection PhpUnused */

/**
 * То что выводится в ЛК
 */

if ( ! is_admin() ) {
	add_action( 'rcl_enqueue_scripts', 'hat_style', 10 );
}
function hat_style() {
	if ( rcl_get_option( 'chr_hat', 0 ) != 1 ) {
		return;
	}

	rcl_enqueue_style( 'its-hat', rcl_addon_url( 'assets/css/hat.css', __FILE__ ) );
}


// новогодняя шапочка
add_action( 'wp_footer', 'chr_santa_hat' );
function chr_santa_hat() {
	if ( rcl_get_option( 'chr_hat', 0 ) != 1 ) {
		return;
	}

	if ( ! rcl_exist_addon( 'theme-sunshine' ) && ! rcl_exist_addon( 'theme-line' ) && ! rcl_exist_addon( 'theme-grace' ) && ! rcl_exist_addon( 'theme-clear-sky' ) && ! rcl_exist_addon( 'theme-control' ) ) {
		return;
	}

	$img_santa_hat = CHR_URL_IMG . 'santa-hat.png';
	$chr_santa     = '<style>
.santa_hat{background-image: url("' . $img_santa_hat . '");}</style>
<script>jQuery(document).ready(function($){$("#rcl-avatar").prepend("<div class=santa_hat></div>");});</script>';

	if ( rcl_exist_addon( 'theme-control' ) ) {
		$chr_santa .= '<style>
.santa_hat {
    right:-26px;
    left:auto;
    transform:rotateY(180deg);
    top:-6px;
}
</style>';
	}

	echo $chr_santa;
}

// отключим реколл обложку ЛК
add_action( 'init', 'chr_st_cover_off', 10 );
function chr_st_cover_off() {
	if ( ! function_exists( 'rcl_cover_upload' ) ) {
		return;
	}

	if ( rcl_get_option( 'chr_label' ) == 1 ) {
		remove_filter( 'rcl_inline_styles', 'rcl_add_cover_inline_styles', 10 );
	}
}

// свою праздничную обложку
add_filter( 'rcl_inline_styles', 'chr_label', 10 );
function chr_label( $styles ) {
	if ( ! function_exists( 'rcl_cover_upload' ) ) {
		return $styles;
	}

	if ( rcl_get_option( 'chr_label' ) != 1 ) {
		return $styles;
	}

	global $user_LK;
	$cover = get_user_meta( $user_LK, 'rcl_cover', 1 );

	$cover_url = $cover && is_numeric( $cover ) ? wp_get_attachment_image_url( $cover, 'large' ) : $cover;

	if ( ! $cover_url ) {
		$cover_url = CHR_URL_IMG . 'christmas-night.jpg';
	}
	$styles .= '#lk-conteyner{background-image:url(' . $cover_url . ');}';

	return $styles;
}

// Рамка с снежинками на аватарке
add_action( 'wp_footer', 'chr_square' );
function chr_square() {
	if ( rcl_get_option( 'chr_square', 0 ) != 1 ) {
		return;
	}

	if ( ! rcl_exist_addon( 'theme-sunshine' ) && ! rcl_exist_addon( 'theme-grace' ) ) {
		return;
	}

	$square = CHR_URL_IMG . 'square.png';
	echo '<style>.avatar-icons{background-image:url("' . $square . '");background-size:contain;}#rcl-avatar{border-width:2px;}</style>';
	echo '<script>jQuery(document).ready(function($){$(".avatar-icons").addClass("chr_square");});</script>';
}

