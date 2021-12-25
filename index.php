<?php /** @noinspection PhpDefineCanBeReplacedWithConstInspection */
/** @noinspection PhpMissingReturnTypeInspection */
/** @noinspection PhpUnused */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*

  ╔═╗╔╦╗╔═╗╔╦╗
  ║ ║ ║ ╠╣ ║║║ https://otshelnik-fm.ru
  ╚═╝ ╩ ╚  ╩ ╩

 */

//
define( 'CHR_PATH', trailingslashit( dirname( __FILE__ ) ) );
define( 'CHR_URL', trailingslashit( rcl_addon_url( '', CHR_PATH ) ) );
define( 'CHR_URL_IMG', CHR_URL . 'assets/images/' );
define( 'CHR_URL_ADMIN_IMG', CHR_URL . 'admin/assets/images/' );
define( 'CHR_VERSION', '4.0' );

if ( is_admin() ) {
	require_once CHR_PATH . 'admin/index.php';
}

add_action( 'init', 'chr_get_effects' );
function chr_get_effects() {
	// праздник прошел
	if ( false === chr_is_holiday() ) {
		return;
	}

	require_once CHR_PATH . 'functions/christmas-lights.php';
	require_once CHR_PATH . 'functions/others.php';
}

require_once CHR_PATH . 'functions/shortcodes.php';


add_action( 'init', 'chr_include_lk' );
function chr_include_lk() {
	if ( ! rcl_is_office() ) {
		return;
	}

	// праздник прошел
	if ( false === chr_is_holiday() ) {
		return;
	}

	require_once CHR_PATH . 'functions/personal-area.php';
}

/**
 * Проверяет - это праздничный день или нет.
 *
 * @return   bool    true - это праздник (эффекты должны работать).
 *                  false - праздник прошел (отключим все эффекты).
 */
function chr_is_holiday() {
	// настройка - не отключать эффекты
	if ( rcl_get_option( 'chr_off', 0 ) == 0 ) {
		return true;
	}

	// декабрь
	if ( '12' == current_time( 'm' ) ) {
		return true;
	}

	$date_off = rcl_get_option( 'chr_off_date', 14 );

	// январь и текущая дата не подошла к часу "X"
	if ( '01' == current_time( 'm' ) && current_time( 'j' ) < $date_off ) {
		return true;
	}

	return false;
}
