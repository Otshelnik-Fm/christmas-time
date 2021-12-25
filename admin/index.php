<?php /** @noinspection PhpIncludeInspection */

require_once CHR_PATH . 'admin/addon-options.php';

add_action( 'admin_footer', 'chr_admin_resources' );
function chr_admin_resources() {
	$chr_page = get_current_screen();

	if ( 'manage-wprecall' != $chr_page->parent_base ) {
		return;
	}

	wp_enqueue_style( 'admin-christmas', CHR_URL . 'admin/assets/css/christmas.css', '', CHR_VERSION );
}

add_action( 'admin_footer', 'chr_adm_style' );
function chr_adm_style() {
	$chr_page = get_current_screen();

	if ( 'manage-wprecall' != $chr_page->parent_base ) {
		return;
	}

	$chr_background = CHR_URL_ADMIN_IMG . 'area-settings-background.webp';
	$chr_img_prev1  = CHR_URL_ADMIN_IMG . 'personal-area-background.webp';
	$chr_img_prev2  = CHR_URL_ADMIN_IMG . 'personal-area-light.webp';
	$chr_img_prev3  = CHR_URL_ADMIN_IMG . 'top-light.webp';
	$chr_img_prev4  = CHR_URL_ADMIN_IMG . 'hat.webp';
	$chr_square     = CHR_URL_ADMIN_IMG . 'ava-snow-square.webp';
	$chr_img_prev5  = CHR_URL_ADMIN_IMG . 'login-form-snow.jpg';
	$chr_img_prev6  = CHR_URL_ADMIN_IMG . 'login-form-background.jpg';
	$chr_img_prev7  = CHR_URL_ADMIN_IMG . 'santa-in-footer.jpg';
	$chr_img_prev9  = CHR_URL_ADMIN_IMG . 'rating-gift.png';
	$chr_img_prev10 = CHR_URL_ADMIN_IMG . 'chat-three.png';
	$chr_img_prev11 = CHR_URL_ADMIN_IMG . 'login-form-text.png';
	$chr_img_prev12 = CHR_URL_ADMIN_IMG . 'recall-bar-text.png';
	$chr_tree       = CHR_URL_ADMIN_IMG . 'tree.jpg';
	$chr_city       = CHR_URL_ADMIN_IMG . 'city.jpg';
	$chr_radio      = CHR_URL_ADMIN_IMG . 'radio.jpg';
	$avas           = CHR_URL_ADMIN_IMG . 'avas.jpg';
	$tree_balls     = CHR_URL_ADMIN_IMG . 'tree_balls.png';

	echo '<style>
#chrst_box_id-options-box {
    background: url("' . esc_html( $chr_background ) . '") no-repeat;
}
#options-group-chrst_group_1::after {
    background-image: url("' . esc_html( $chr_img_prev1 ) . '");
}
#options-group-chrst_group_2::after {
    background-image: url("' . esc_html( $chr_img_prev2 ) . '");
}
#options-group-chrst_group_3::after {
    background-image: url("' . esc_html( $chr_img_prev3 ) . '");
}
#options-group-chrst_group_4::after {
    background-image: url("' . esc_html( $chr_img_prev4 ) . '");
}
#options-group-chrst_square::after {
    background-image: url("' . esc_html( $chr_square ) . '");
}
#options-group-chrst_group_5::after {
    background-image: url("' . esc_html( $chr_img_prev5 ) . '");
}
#options-group-chrst_group_6::after {
    background-image: url("' . esc_html( $chr_img_prev6 ) . '");
}
#options-group-chrst_group_7::after {
    background-image: url("' . esc_html( $chr_img_prev7 ) . '");
}
#options-group-chrst_group_9::after {
    background-image: url("' . esc_html( $chr_img_prev9 ) . '");
}
#options-group-chrst_group_10::after {
    background-image: url("' . esc_html( $chr_img_prev10 ) . '");
}
#options-group-chrst_group_11::after {
    background-image: url("' . esc_html( $chr_img_prev11 ) . '");
}
#options-group-chrst_group_12::after {
    background-image: url("' . esc_html( $chr_img_prev12 ) . '");
}
#options-group-chrst_tree::after {
    background: url("' . esc_html( $chr_tree ) . '") no-repeat;
}
#options-group-chrst_town::after {
    background: url("' . esc_html( $chr_city ) . '") no-repeat;
}
#options-group-chrst_radio::after {
    background: url("' . esc_html( $chr_radio ) . '") no-repeat;
}
#options-group-chrst_avas::after {
    background: url("' . esc_html( $avas ) . '") no-repeat;
}
#options-group-chrst_tree_balls::after {
    background: url("' . esc_html( $tree_balls ) . '") no-repeat;
}
</style>';
}
