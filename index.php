<?php/*  ╔═╗╔╦╗╔═╗╔╦╗  ║ ║ ║ ╠╣ ║║║ https://otshelnik-fm.ru  ╚═╝ ╩ ╚  ╩ ╩ */if ( ! defined( 'ABSPATH' ) )    exit;//require_once 'chr-options.php';/**/if ( ! is_admin() ) {    add_action( 'rcl_enqueue_scripts', 'chr_style', 10 );}function chr_style() {    rcl_enqueue_style( 'its-christmas', rcl_addon_url( 'style.css', __FILE__ ) );}add_action( 'init', 'chr_st_cover_off', 10 );function chr_st_cover_off() {    if ( rcl_is_office() && function_exists( 'rcl_cover_upload' ) ) {        if ( rcl_get_option( 'chr_label' ) == 1 ) {            remove_filter( 'rcl_inline_styles', 'rcl_add_cover_inline_styles', 10 );        }    }}add_filter( 'rcl_inline_styles', 'chr_label', 10 );function chr_label( $styles ) {    if ( rcl_is_office() && function_exists( 'rcl_cover_upload' ) ) {        if ( rcl_get_option( 'chr_label' ) != 1 )            return $styles;        global $user_LK;        $cover = get_user_meta( $user_LK, 'rcl_cover', 1 );        $cover_url = $cover && is_numeric( $cover ) ? wp_get_attachment_image_url( $cover, 'large' ) : $cover;        if ( ! $cover_url )            $cover_url = rcl_addon_url( 'inc/christmas-night.jpg', __FILE__ );        $styles    .= '#lk-conteyner{background-image: url(' . $cover_url . ');}';    }    return $styles;}rcl_block( 'before', 'chr_light_prfl' );function chr_light_prfl() {    if ( rcl_is_office() && rcl_get_option( 'chr_lght_prf' ) == 1 ) {        // http://codepen.io/tobyj/pen/QjvEex        $chr_prf_time = rcl_get_option( 'chr_lght_prf_time', 'infinite' );        $chr_light    = '<ul class="lightrope"><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li></ul><style>.lightrope li{-webkit-animation-iteration-count: ' . $chr_prf_time . ';animation-iteration-count: ' . $chr_prf_time . ';}</style>';        return $chr_light;    }}add_action( 'wp_footer', 'chr_light_rclbr', 10 );function chr_light_rclbr() {    if ( rcl_get_option( 'chr_lght_rcl' ) == 1 ) {        $chr_margn = '';        if ( rcl_get_option( 'view_recallbar' ) == 1 )            $chr_margn = 'margin: 20px 0 0;';        $chr_time_long = rcl_get_option( 'chr_lght_rcl_time', 'infinite' );        $chr_position  = rcl_get_option( 'chr_lght_rcl_pos' );        $rclbr_light   = '<style>.top_rclbr.lightrope li {-webkit-animation-iteration-count: ' . $chr_time_long . ';animation-iteration-count: ' . $chr_time_long . ';}.top_rclbr.lightrope {position: ' . $chr_position . ';' . $chr_margn . '}</style><script>(function($){$("body").append("<ul class=\"top_rclbr lightrope\">"+ "<li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>"+ "<li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>"+ "<li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>"+ "<li></li><li></li><li></li><li></li><li></li><li></li></ul>");})(jQuery);</script>';        echo $rclbr_light;    }}add_action( 'wp_footer', 'chr_santa_hat' );function chr_santa_hat() {    if ( rcl_is_office() && rcl_get_option( 'chr_hat' ) == 1 ) {        if ( ! rcl_exist_addon( 'theme-sunshine' ) && ! rcl_exist_addon( 'theme-line' ) && ! rcl_exist_addon( 'theme-grace' ) && ! rcl_exist_addon( 'theme-clear-sky' ) )            return;        $img_santa_hat = rcl_addon_url( 'inc/santa-hat.png', __FILE__ );        $chr_santa     = '<style>.santa_hat{background-image: url("' . $img_santa_hat . '");}</style><script>jQuery(document).ready(function($){    $("#rcl-avatar").prepend("<div class=santa_hat></div>");});</script>';        echo $chr_santa;    }}add_action( 'wp_footer', 'chr_snow' );function chr_snow() {    if ( rcl_get_option( 'chr_snows' ) == 1 && ! is_user_logged_in() ) {        // codepen.io/TackOnes1/pen/xwMYGy        $chr_snow = '<style>.panel_lk_recall.floatform::before {content: "";display: block;height: 23px;left: 0;margin: -4px -5px;pointer-events: none;position: absolute;right: 0;top: 0;z-index: 1;background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACsAAAAXCAYAAACS5bYWAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAABFpJREFUeNrUV0tIo1cUvpkYjQ4xxSA6DxuNqG0dtaUKOgs3s6i0dFd3pSsXdjeIixakiGA34sZuXCkoONLFwJTK4GMYLYXg29gatTpiXurkbd7vv9/5ub+IxuhA7eiFQ5Kbc8/57ne/e87/ywRBYLdl3GG3aNwqsLJ0k0tLS+fmcnNzWUVFBVMoFGx2djarvLxcm5OTw+bm5iytra2xc4ExNjY27iqVyvvwK6CpeDzuCYVC1urq6qDA9UcfPp+PHR4esmAwKK6tr68/l5/8rgQ2Ozub1dbWyiYmJooaGxt/VqvV38jlchX9l0qlwoFA4DWS/RKLxRxFRUVf5+XlPcaaT2AP0sVPJBL2SCRiAPBpu93+vKamZo/Ae71eZjabWV1dXVqw7CKwp43ksrCw8Bhg7MJ/PLDZ5PHx8cz29vYT5JGD/bSYLgTrcDgYdk6siSc6NjZWDaAe4ZoHQL+cmZnRpZPnhWDpD8kw7uKo9ML/NMCsd2tr61vkzboMrEyv138M7TyLRqMWMBsX3sMgaZhMpp+AR5EJrCocDpuEGzKg4x8khs+CVWxubvZfR9JkMik4nU7BarUKLpeLmLsKuwIqTLynp4fqmIzASrqQT09Pf1VVVfX0KsWZ6uHBwQHTaDSsoKAgo6/H4xHLEcrVyRwuEisrKzs5XrrIVAVwiUVDKRRrL+YI32ewdVhMApuHWvcj6vids6J2u90MF4yBHUZNgKoEBaRBQalJqFSqtJfUYrGIlQX+ydXVVTN+u0tKSjQNDQ1axJVl2iTypebn55d7e3v/kqoDgZU1NTU9LCws/Py0M+2ekuGincxJ3yF+18jIyHJLS0slQJUWFxczrBeBE0vE5tHRkbixlZWVfSR8gTX/0P5gH7S1tX3Z3t7+BW8qAvwSfr8/jA0EIRM/qoFtampqbW9vTw+XA+ojUruVd3Z2tvb19T2TQFEim81GgVJoCvvj4+NLOJZgaWmpemdn5y3a6BbcnJDAw8HBwac6ne6eqCW5XDwB3qVSqM9/DAwMUNy/eVLabT7sI25qwgujThCBhWE+mAt2yNc4SQKSZrOQQE1HS22VJkmPAGTr7+//fX19fRk+Zgq0trbGeFAKEAQT98BSqKOj47vm5uaa/Px8JeIk4GcaHh6eWlxcfAU/A8xG67BxAX3fwdcbYUpSDJ06Z49Ak8ZC3OL8f3YiA4PBYKdLQ2AJ9OTk5GpXV9cQiCVh79M94QtlPLDUE/1gPNrd3f0W33W4cBoco48zQuy/IZYAMnGqlSc4c66L9JruQUaSARXeT8HGKzxAqFBekni6+h46+pMzGiJGMgTOJh1yU/KNEGDvZWvfBawkA9ppwGg0mrRa7SOI2g+gxOgbJIpdFpj72PnxSnPX8vqRxTURgBQWKisrH+GThOm+CtAzoK/9/Uiqq/6hoaHfdnd3jaOjo7/yY7yxbwqkWy3sQzpS2C6YirwvUJk0y7hurfyGRrnduPGvAAMASmo8wzeVwfsAAAAASUVORK5CYII=) no-repeat 0 0,url(data:image/png;base64,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) no-repeat 50% 0,url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAXCAYAAACFxybfAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAodJREFUeNrsVb1rWlEUv2pN/GqspKRSKFYXWzEloIWif0Fn6dJChQ7OQil0qd3EzcEpg0OgdHDr4CQODk7VRlLMEIVqApX4We0zflR9/Z1Ui4T34ksaaAYP/Hzc673n/M6550PG8zz73yKjn0wm83fDYDAwo9HINBrNnwOQg4MDs0ql2lQqlfdAWont7ng8Pjw+Ps44nc4G1pI9EXWaSOzt7TGO42aH5Pv7+08ajUZ0MBiUeXEZd7vdL5VK5fX29rZ+5tQiEmdxKrlcjsEYczgcynK5/BKKv/IXFNz/XiqVXkHdjUuRIA9SqdRD8or/R8Ez9fr9fqHVakUR4c2z0REjIQuHw2ZcrPBXLCA0RHTezEdHjIQqkUhEr9I4HOILhQLf6/VoOUFEvDMiQiToDx1Cdz+bzZ6bUFarlel0OkkVUK/XWbvdPoVer5fh3ntsfwJ+CJ2XA4p0Op1bpBgJyxDehQQ6nQ5DZXHBYDBZq9V+EhFUndnr9drEqoc2bwJbwGPgtohuVSwWe2Gz2TZMJpNgRKi6qtUqg2EWj8dTgUDgo0KhWPN4PC70EvXOzs67fD6/S6kiRIKeZA1YJ2MiJNbdbvfTUCjkV6vVK2hcDF8GI2w0GrGTkxM2HA5PDxaLxSOfz/cWEfk81X0XIMMFgJJ/srBjCgk8IdcfuVyuZ36//7nFYtkQyAMumUzuRiKRD0jMFLa+AZOpYwqgB/ziBVqmVBKUO7eAB/R0WG/Z7XaTVqtdbTabHJL6EK2djBaBPHA0NSqpbUsiMUeEBgpF4Q5AbZrmSJ/yEWgBTaBNHl9kdkgmMUeG7qwAq9PqovceTA3zlxlgsuswyuXsGsiSxJLEkoSY/BZgAEjRodi+uBruAAAAAElFTkSuQmCC) no-repeat 100% 0;}</style>';        echo $chr_snow;    }}add_action( 'wp_footer', 'chr_bckgrnd' );function chr_bckgrnd() {    if ( is_user_logged_in() )        return;    if ( rcl_get_option( 'chr_bck' ) == 1 ) {        $dop_url = rcl_addon_url( 'inc/snow-falling', __FILE__ );        $out     = '<style>#rcl-overlay{background-image: url("' . $dop_url . rcl_get_option( 'chr_bck_gif', 1 ) . '.gif");background-size: ' . rcl_get_option( 'chr_bck_position', 'cover' ) . ';background-color: rgba(0, 0, 0, ' . rcl_get_option( 'chr_bck_opacity', '0.7' ) . ');opacity: ' . rcl_get_option( 'chr_bck_opacity', '0.7' ) . ';}</style>';        echo $out;    }}add_action( 'wp_footer', 'chr_santa_bttm', 20 );function chr_santa_bttm() {    if ( rcl_get_option( 'chr_santa' ) == 1 ) {        $img_santa1 = rcl_addon_url( 'inc/xmas-bottom.png', __FILE__ );        $img_santa2 = rcl_addon_url( 'inc/xmas-bgnd.gif', __FILE__ );        $img_santa3 = rcl_addon_url( 'inc/xmas-santa.gif', __FILE__ );        $chr_after = '<style>#santa{background: url("' . $img_santa2 . '")  left bottom;}#santa:before{background: url("' . $img_santa3 . '") transparent no-repeat;}#santa:after{background: url("' . $img_santa1 . '") transparent repeat-x;}</style><div id="santa"></div>';        echo $chr_after;    }}add_action( 'admin_footer', 'chr_adm_style' );function chr_adm_style() {    $chr_page = get_current_screen();    if ( $chr_page->parent_base != 'manage-wprecall' )        return;    $chr_img_bcgrnd = rcl_addon_url( 'inc/adm-chr-christmas.jpg', __FILE__ );    $chr_img_prev1  = rcl_addon_url( 'inc/adm-chr-background.jpg', __FILE__ );    $chr_img_prev2  = rcl_addon_url( 'inc/adm-chr-light.jpg', __FILE__ );    $chr_img_prev3  = rcl_addon_url( 'inc/adm-chr-light-2.jpg', __FILE__ );    $chr_img_prev4  = rcl_addon_url( 'inc/adm-chr-hat.jpg', __FILE__ );    $chr_img_prev5  = rcl_addon_url( 'inc/adm-chr-snow.jpg', __FILE__ );    $chr_img_prev6  = rcl_addon_url( 'inc/adm-chr-bck.jpg', __FILE__ );    $chr_img_prev7  = rcl_addon_url( 'inc/adm-chr-santa.jpg', __FILE__ );    $img_bcgrnd_adm = '<style>#chrst_box_id-options-box {    background: url("' . $chr_img_bcgrnd . '") no-repeat;    box-shadow: 0 0 10px 5px rgb(79, 112, 159) inset;    padding: 35px;}#chrst_box_id-options-box::after {    content: "Здоровья и удачи в 2021-м году! CodeSeller.ru";    color: #000;    background: rgba(124, 242, 169, .8);    padding: 12px 24px;    font: bold 16px Arial,Georgia;    margin: 18px auto;    display: table;}#chrst_box_id-options-box .options-group {    background-color: rgba(139, 179, 223,.88);    border: none;    box-shadow: 0 0 3px 1px #2c558f;    font-size: 16px;    padding: 0;    margin: 24px 0;}#chrst_box_id-options-box .options-group .group-title {    color: #f7ea84;    font-size: 24px;    text-align: center;    text-shadow: 1px 2px 0px #1d4a57;    padding: 3px 0 6px;    line-height: normal;    background: #45867a;}#chrst_box_id-options-box .options-group .rcl-option .dashicons-editor-help {    color: #f0ede5;}#chrst_box_id-options-box .options-group .rcl-option {    padding: 0 6px 6px;    color: #000;    box-sizing: border-box;}#chrst_box_id-options-box .options-group .rcl-field-notice {    color: #000;}#chrst_box_id-options-box .options-group::after {    background-repeat: no-repeat;    content: "";    display: block;}#chrst_box_id-options-box .options-group:nth-child(1)::after {    background-image: url("' . $chr_img_prev1 . '");    height: 222px;}#chrst_box_id-options-box .options-group:nth-child(2)::after {    background-image: url("' . $chr_img_prev2 . '");    height: 97px;}#chrst_box_id-options-box .options-group:nth-child(3)::after {    background-image: url("' . $chr_img_prev3 . '");    height: 85px;}#chrst_box_id-options-box .options-group:nth-child(4)::after {    background-image: url("' . $chr_img_prev4 . '");    height: 160px;}#chrst_box_id-options-box .options-group:nth-child(5)::after {    background-image: url("' . $chr_img_prev5 . '");    height: 150px;}#chrst_box_id-options-box .options-group:nth-child(6)::after {    background-image: url("' . $chr_img_prev6 . '");    height: 130px;}#chrst_box_id-options-box .options-group:nth-child(7)::after {    background-image: url("' . $chr_img_prev7 . '");    height: 90px;}</style>';    echo $img_bcgrnd_adm;}// idea https://codepen.io/codemzy/full/pgNKEqadd_shortcode( 'chr_counter', 'chr_counter_load' );function chr_counter_load( $width ) {    wp_enqueue_style( 'chr-count', rcl_addon_url( 'counter/count.css', __FILE__ ) );    wp_enqueue_script( 'chr-count', rcl_addon_url( 'counter/count.js', __FILE__ ) );    return chr_counter_box( $width );}function chr_counter_box( $width = false ) {    $out = '<div class="chr_wrapper" style="opacity:0;">                <div id="chr_header">До нового года:</div>                <div class="chr_container">                  <div class="chr_col" style="min-width:' . $width . 'px;">                      <div class="chr_top_pane">                        <div id="chr_days" class="chr_num">00</div>                      </div>                      <div class="chr_bottom_pane">                        <div id="chr_days_text" class="chr_text">дни</div>                      </div>                  </div>                  <div class="chr_col" style="min-width:' . $width . 'px;">                      <div class="chr_top_pane">                        <div id="chr_hours" class="chr_num">00</div>                      </div>                      <div class="chr_bottom_pane">                        <div id="chr_hours_text" class="chr_text">часы</div>                      </div>                  </div>                  <div class="chr_col" style="min-width:' . $width . 'px;">                      <div class="chr_top_pane">                        <div id="chr_mins" class="chr_num">00</div>                      </div>                      <div class="chr_bottom_pane">                        <div id="chr_mins_text" class="chr_text">минуты</div>                      </div>                  </div>                  <div class="chr_col" style="min-width:' . $width . 'px;">                      <div class="chr_top_pane">                        <div id="chr_secs" class="chr_num">00</div>                      </div>                      <div class="chr_bottom_pane">                        <div id="chr_secs_text" class="chr_text">секунды</div>                      </div>                  </div>                </div>                <div id="chr_info" class="small"></div>            </div>';    return $out;}