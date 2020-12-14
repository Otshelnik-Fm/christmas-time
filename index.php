<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*

  ╔═╗╔╦╗╔═╗╔╦╗
  ║ ║ ║ ╠╣ ║║║ https://otshelnik-fm.ru
  ╚═╝ ╩ ╚  ╩ ╩

 */

//
require_once 'chr-options.php';

/**/
if ( ! is_admin() ) {
    add_action( 'rcl_enqueue_scripts', 'chr_style', 10 );
}
function chr_style() {
    rcl_enqueue_style( 'its-christmas', rcl_addon_url( 'style.css', __FILE__ ) );
}

add_action( 'init', 'chr_st_cover_off', 10 );
function chr_st_cover_off() {
    if ( rcl_is_office() && function_exists( 'rcl_cover_upload' ) ) {
        if ( rcl_get_option( 'chr_label' ) == 1 ) {
            remove_filter( 'rcl_inline_styles', 'rcl_add_cover_inline_styles', 10 );
        }
    }
}

add_filter( 'rcl_inline_styles', 'chr_label', 10 );
function chr_label( $styles ) {
    if ( rcl_is_office() && function_exists( 'rcl_cover_upload' ) ) {
        if ( rcl_get_option( 'chr_label' ) != 1 )
            return $styles;

        global $user_LK;
        $cover = get_user_meta( $user_LK, 'rcl_cover', 1 );

        $cover_url = $cover && is_numeric( $cover ) ? wp_get_attachment_image_url( $cover, 'large' ) : $cover;

        if ( ! $cover_url )
            $cover_url = rcl_addon_url( 'inc/christmas-night.jpg', __FILE__ );
        $styles    .= '#lk-conteyner{background-image: url(' . $cover_url . ');}';
    }
    return $styles;
}

rcl_block( 'before', 'chr_light_prfl' );
function chr_light_prfl() {
    if ( rcl_is_office() && rcl_get_option( 'chr_lght_prf' ) == 1 ) {
        // http://codepen.io/tobyj/pen/QjvEex
        $chr_prf_time = rcl_get_option( 'chr_lght_prf_time', 'infinite' );
        $chr_light    = '<ul class="lightrope">
<li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>
<li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>
</ul>
<style>.lightrope li{-webkit-animation-iteration-count: ' . $chr_prf_time . ';animation-iteration-count: ' . $chr_prf_time . ';}</style>';

        return $chr_light;
    }
}

add_action( 'wp_footer', 'chr_light_rclbr', 10 );
function chr_light_rclbr() {
    if ( rcl_get_option( 'chr_lght_rcl' ) == 1 ) {
        $chr_margn = '';

        if ( rcl_get_option( 'view_recallbar' ) == 1 )
            $chr_margn = 'margin: 20px 0 0;';

        $chr_time_long = rcl_get_option( 'chr_lght_rcl_time', 'infinite' );
        $chr_position  = rcl_get_option( 'chr_lght_rcl_pos' );
        $rclbr_light   = '<style>
.top_rclbr.lightrope li {
-webkit-animation-iteration-count: ' . $chr_time_long . ';
animation-iteration-count: ' . $chr_time_long . ';
}
.top_rclbr.lightrope {
position: ' . $chr_position . ';
' . $chr_margn . '
}
</style>
<script>
(function($){
$("body").append("<ul class=\"top_rclbr lightrope\">"
+ "<li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>"
+ "<li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>"
+ "<li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>"
+ "<li></li><li></li><li></li><li></li><li></li><li></li></ul>");
})(jQuery);
</script>';

        echo $rclbr_light;
    }
}

add_action( 'wp_footer', 'chr_santa_hat' );
function chr_santa_hat() {
    if ( rcl_is_office() && rcl_get_option( 'chr_hat' ) == 1 ) {

        if ( ! rcl_exist_addon( 'theme-sunshine' ) && ! rcl_exist_addon( 'theme-line' ) && ! rcl_exist_addon( 'theme-grace' ) && ! rcl_exist_addon( 'theme-clear-sky' ) && ! rcl_exist_addon( 'theme-control' ) )
            return;

        $img_santa_hat = rcl_addon_url( 'inc/santa-hat.png', __FILE__ );
        $chr_santa     = '<style>
.santa_hat{background-image: url("' . $img_santa_hat . '");}</style>
<script>
jQuery(document).ready(function($){
    $("#rcl-avatar").prepend("<div class=santa_hat></div>");
});
</script>';

        if ( rcl_exist_addon( 'theme-control' ) ) {
            $chr_santa .= '<style>
.santa_hat {
    right: -26px;
    left: auto;
    transform: rotateY(180deg);
    top: -6px;
}
            </style>';
        }

        echo $chr_santa;
    }
}

add_action( 'wp_footer', 'chr_snow' );
function chr_snow() {
    if ( rcl_get_option( 'chr_snows' ) == 1 && ! is_user_logged_in() ) {
        // codepen.io/TackOnes1/pen/xwMYGy
        $chr_snow = '<style>
.panel_lk_recall.floatform::before {
content: "";
display: block;
height: 23px;
left: 0;
margin: -4px -5px;
pointer-events: none;
position: absolute;
right: 0;
top: 0;
z-index: 1;
background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACsAAAAXCAYAAACS5bYWAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAABFpJREFUeNrUV0tIo1cUvpkYjQ4xxSA6DxuNqG0dtaUKOgs3s6i0dFd3pSsXdjeIixakiGA34sZuXCkoONLFwJTK4GMYLYXg29gatTpiXurkbd7vv9/5ub+IxuhA7eiFQ5Kbc8/57ne/e87/ywRBYLdl3GG3aNwqsLJ0k0tLS+fmcnNzWUVFBVMoFGx2djarvLxcm5OTw+bm5iytra2xc4ExNjY27iqVyvvwK6CpeDzuCYVC1urq6qDA9UcfPp+PHR4esmAwKK6tr68/l5/8rgQ2Ozub1dbWyiYmJooaGxt/VqvV38jlchX9l0qlwoFA4DWS/RKLxRxFRUVf5+XlPcaaT2AP0sVPJBL2SCRiAPBpu93+vKamZo/Ae71eZjabWV1dXVqw7CKwp43ksrCw8Bhg7MJ/PLDZ5PHx8cz29vYT5JGD/bSYLgTrcDgYdk6siSc6NjZWDaAe4ZoHQL+cmZnRpZPnhWDpD8kw7uKo9ML/NMCsd2tr61vkzboMrEyv138M7TyLRqMWMBsX3sMgaZhMpp+AR5EJrCocDpuEGzKg4x8khs+CVWxubvZfR9JkMik4nU7BarUKLpeLmLsKuwIqTLynp4fqmIzASrqQT09Pf1VVVfX0KsWZ6uHBwQHTaDSsoKAgo6/H4xHLEcrVyRwuEisrKzs5XrrIVAVwiUVDKRRrL+YI32ewdVhMApuHWvcj6vids6J2u90MF4yBHUZNgKoEBaRBQalJqFSqtJfUYrGIlQX+ydXVVTN+u0tKSjQNDQ1axJVl2iTypebn55d7e3v/kqoDgZU1NTU9LCws/Py0M+2ekuGincxJ3yF+18jIyHJLS0slQJUWFxczrBeBE0vE5tHRkbixlZWVfSR8gTX/0P5gH7S1tX3Z3t7+BW8qAvwSfr8/jA0EIRM/qoFtampqbW9vTw+XA+ojUruVd3Z2tvb19T2TQFEim81GgVJoCvvj4+NLOJZgaWmpemdn5y3a6BbcnJDAw8HBwac6ne6eqCW5XDwB3qVSqM9/DAwMUNy/eVLabT7sI25qwgujThCBhWE+mAt2yNc4SQKSZrOQQE1HS22VJkmPAGTr7+//fX19fRk+Zgq0trbGeFAKEAQT98BSqKOj47vm5uaa/Px8JeIk4GcaHh6eWlxcfAU/A8xG67BxAX3fwdcbYUpSDJ06Z49Ak8ZC3OL8f3YiA4PBYKdLQ2AJ9OTk5GpXV9cQiCVh79M94QtlPLDUE/1gPNrd3f0W33W4cBoco48zQuy/IZYAMnGqlSc4c66L9JruQUaSARXeT8HGKzxAqFBekni6+h46+pMzGiJGMgTOJh1yU/KNEGDvZWvfBawkA9ppwGg0mrRa7SOI2g+gxOgbJIpdFpj72PnxSnPX8vqRxTURgBQWKisrH+GThOm+CtAzoK/9/Uiqq/6hoaHfdnd3jaOjo7/yY7yxbwqkWy3sQzpS2C6YirwvUJk0y7hurfyGRrnduPGvAAMASmo8wzeVwfsAAAAASUVORK5CYII=) no-repeat 0 0,
url(data:image/png;base64,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) no-repeat 50% 0,
url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAXCAYAAACFxybfAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAodJREFUeNrsVb1rWlEUv2pN/GqspKRSKFYXWzEloIWif0Fn6dJChQ7OQil0qd3EzcEpg0OgdHDr4CQODk7VRlLMEIVqApX4We0zflR9/Z1Ui4T34ksaaAYP/Hzc673n/M6550PG8zz73yKjn0wm83fDYDAwo9HINBrNnwOQg4MDs0ql2lQqlfdAWont7ng8Pjw+Ps44nc4G1pI9EXWaSOzt7TGO42aH5Pv7+08ajUZ0MBiUeXEZd7vdL5VK5fX29rZ+5tQiEmdxKrlcjsEYczgcynK5/BKKv/IXFNz/XiqVXkHdjUuRIA9SqdRD8or/R8Ez9fr9fqHVakUR4c2z0REjIQuHw2ZcrPBXLCA0RHTezEdHjIQqkUhEr9I4HOILhQLf6/VoOUFEvDMiQiToDx1Cdz+bzZ6bUFarlel0OkkVUK/XWbvdPoVer5fh3ntsfwJ+CJ2XA4p0Op1bpBgJyxDehQQ6nQ5DZXHBYDBZq9V+EhFUndnr9drEqoc2bwJbwGPgtohuVSwWe2Gz2TZMJpNgRKi6qtUqg2EWj8dTgUDgo0KhWPN4PC70EvXOzs67fD6/S6kiRIKeZA1YJ2MiJNbdbvfTUCjkV6vVK2hcDF8GI2w0GrGTkxM2HA5PDxaLxSOfz/cWEfk81X0XIMMFgJJ/srBjCgk8IdcfuVyuZ36//7nFYtkQyAMumUzuRiKRD0jMFLa+AZOpYwqgB/ziBVqmVBKUO7eAB/R0WG/Z7XaTVqtdbTabHJL6EK2djBaBPHA0NSqpbUsiMUeEBgpF4Q5AbZrmSJ/yEWgBTaBNHl9kdkgmMUeG7qwAq9PqovceTA3zlxlgsuswyuXsGsiSxJLEkoSY/BZgAEjRodi+uBruAAAAAElFTkSuQmCC) no-repeat 100% 0;
}
</style>';

        echo $chr_snow;
    }
}

add_action( 'wp_footer', 'chr_bckgrnd' );
function chr_bckgrnd() {
    if ( is_user_logged_in() )
        return;

    if ( rcl_get_option( 'chr_bck' ) == 1 ) {
        $dop_url = rcl_addon_url( 'inc/snow-falling', __FILE__ );
        $out     = '
<style>
#rcl-overlay{
background-image: url("' . $dop_url . rcl_get_option( 'chr_bck_gif', 1 ) . '.gif");
background-size: ' . rcl_get_option( 'chr_bck_position', 'cover' ) . ';
background-color: rgba(0, 0, 0, ' . rcl_get_option( 'chr_bck_opacity', '0.7' ) . ');
opacity: ' . rcl_get_option( 'chr_bck_opacity', '0.7' ) . ';
}
</style>';

        echo $out;
    }
}

add_action( 'wp_footer', 'chr_rtng' );
function chr_rtng() {
    if ( rcl_get_option( 'chr_rat' ) == 1 ) {

        $out = '
<style>
.rcl-rating-box .rating-wrapper {
    align-items: center;
    display: flex;
    justify-content: flex-end;
}
.rcl-rating-box.box-stars .fa-star::before {
    content: "";
    background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAACoElEQVRIie2UX0hTcRTHT4jVVfPezf25U7vdZjN2t3v1qqV15+bclltISdQwtKwcUSlhZC9hD0qoYEQZ6ZRgkSBoBD0kEfgQ+RqoRI8RUXhJbf1DQZueHmpx1ZmGQT144PP25fuB8zv8AP7xEKvIJPxx66OWnUf8DtWHk6Xa+7/LHXDp9A5RNeyTNG2rLh9oMR09uJfCkS4OnwctaM8mn8TK0UmgtedS73HYi/euClgkqp6upn+Tv4iaxsFcjDJ02xzJs1LtAOADgKqfEO4C9SgOezHKQIc4x7EJzSsJqP17yOmpARGVklt1bKQhwM6GGnkMNfJoz6FmPj5zo1Lw4JqIuRzZv5IgM10XV2nZTkzUHNLPXj/H4MOmDLxwWI9NZ0040ifhSJ+ErvwU7G0RsL8tG5vOmOZPlBpkzkgMAUAeAKhjNnu0ZHP1Nt2rSkbzrm23abJb4r4GJfN00MbNdEjmuZCLx54SAXtKBOws5OY7JfO3oI2b6ZK4qW4b9/lOoSV8x24J11vY8X1q0rO4nz/OaCbQLyEecyKeL1sT5UbdGwCIUwpKGsxpX9AvIVa51iy4aGXGAIBWCqwCSYTL0tR42mTAK1nGBdRbWazlGawTWawTWayxMnh5USZKrXlrJD8l6SUAkAt2RBNx7b0FmSj7C1EOeBdw08HjjUtmlAedKA86sWwXjaMVziU5OeDFcqPuEwDYljwyQ2xsfWznYq7oricHQ438r5Msl1JRDnhjriewwxAGgOx1wbrgPxZULyfQx8efarUwEawoWpPAY1CNA4BmiQAANhRrk0P+9JQXTu2Wt26aGouSo06cFDKS5uxZVMSeRUUENnHWoU+WlRk3TY0V09RrnzbZF6tcOanw46NajKAgc5nM5pXK//p8BxcOELpgLoyMAAAAAElFTkSuQmCC);
    width: 24px;
    height: 24px;
    background-size: 24px;
    display: block;
    background-origin: content-box;
    background-repeat: no-repeat;
}
.rcl-rating-box.box-stars .must-vote .fa-star::before,
.rcl-rating-box.box-stars .must-vote .rating-vote:hover ~ .rating-vote > span.stars__out,
.rcl-rating-box.box-stars span:not(.must-vote).stars-wrapper .fa-star.stars__out::before {
    filter: grayscale(1);
}
.rcl-rating-box.box-stars .must-vote .stars__in.fa-star::before,
.rcl-rating-box.box-stars .stars-wrapper.must-vote:hover .vote-star span.stars__out::before {
    filter: grayscale(0);
}

.rcl-rating-box.box-like .fa-heart::before {
    content: "";
    background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA1MTIgNTEyIj4KICA8ZyBmaWxsPSIjY2ZlYjcwIj4KICAgIDxwYXRoIGQ9Ik02My41NzUgNDE1LjgxM2gzODQuODUydjgyLjIzMUg2My41NzV6Ii8+CiAgICA8cGF0aCBkPSJNNDI4Ljc5NiA0MTUuODE3bC0xOC45ODgtNjIuNDIySDEwMi4xOTJsLTE4Ljk4NiA2Mi40MjJ6Ii8+CiAgPC9nPgogIDxwYXRoIGQ9Ik00MDUuMjQ4IDM1My4zOTZjMzMuMDg3LTM2LjA1IDUzLjI5LTg0LjExNyA1My4yOS0xMzYuOTA2IDAtMTExLjg1OS05MC42NzktMjAyLjUzNy0yMDIuNTM3LTIwMi41MzdTNTMuNDYyIDEwNC42MzEgNTMuNDYyIDIxNi40OWMwIDUyLjc4OSAyMC4yMDMgMTAwLjg1NiA1My4yOSAxMzYuOTA2aDI5OC40OTZ6IiBmaWxsPSIjYmJkY2UzIi8+CiAgPHBhdGggZD0iTTMxNS4wMzggMTQ2Ljg3OWMtMzMuMDc5IDAtNTkuMDMyIDM2Ljg4My01OS4wMzIgMzYuODgzcy0yNC40ODEtMzYuODgzLTU5LjA0Ny0zNi44ODNjLTMzLjYyMSAwLTYxLjA3NiAyNy43MzEtNjIuODczIDYxLjMwNi0xLjAxMiAxOC45NjcgNS4xMDIgMzMuNDA0IDEzLjcxOCA0Ni40NzcgMTcuMjE2IDI2LjEyIDkyLjQ4IDg5LjAwNiAxMDguMzEzIDg5LjAwNiAxNi4xNiAwIDkwLjc1NC02Mi42NTcgMTA4LjA4NS04OS4wMDYgOC42MzItMTMuMTMzIDE0LjczMS0yNy41MSAxMy43MTQtNDYuNDc3LTEuOC0zMy41NzUtMjkuMjU1LTYxLjMwNi02Mi44NzgtNjEuMzA2IiBmaWxsPSIjZmY1ZThhIi8+CiAgPHBhdGggZD0iTTQ0OC40MjcgNDAxLjg2NGgtOS4yOTFsLTE0LjkzNi00OS4xYzMxLjIyNC0zOC40ODUgNDguMjkxLTg2LjM3NCA0OC4yOTEtMTM2LjI3NEM0NzIuNDkxIDk3LjExNiAzNzUuMzczIDAgMjU2LjAwMSAwIDEzNi42MjcgMCAzOS41MDkgOTcuMTE2IDM5LjUwOSAyMTYuNDljMCA0OS44OTggMTcuMDY3IDk3Ljc4OSA0OC4yOTEgMTM2LjI3NGwtMTQuOTM2IDQ5LjFoLTkuMjkxYy03LjcwNiAwLTEzLjk1MyA2LjI0OC0xMy45NTMgMTMuOTUzdjgyLjIzMWMwIDcuNzA1IDYuMjQ3IDEzLjk1MyAxMy45NTMgMTMuOTUzaDM4NC44NTJjNy43MDUgMCAxMy45NTMtNi4yNDggMTMuOTUzLTEzLjk1M3YtODIuMjMxYy4wMDEtNy43MDUtNi4yNDctMTMuOTUzLTEzLjk1MS0xMy45NTN6TTI1Ni4wMDEgMjcuOTA1YzEwMy45ODUgMCAxODguNTg1IDg0LjYgMTg4LjU4NSAxODguNTg1IDAgNDUuMzIxLTE2LjE0OSA4OC43NDQtNDUuNTk4IDEyMi45NTJoLTEwNS42MmM3LjA0My01LjAzMyAxNS4zOC0xMS40NTQgMjUuMjY0LTE5LjY2IDIwLjcwMS0xNy4xODcgNDYuNjA2LTQxLjMwNSA1Ny4yMjgtNTcuNDU2IDcuNTEzLTExLjQzMSAxNy4zNDctMjkuNTU4IDE1Ljk4OC01NC44ODYtMS4wNjItMTkuODMzLTkuNDU3LTM4LjQ1NS0yMy42NDEtNTIuNDM1LTE0LjQ0NS0xNC4yMzctMzMuMzI2LTIyLjA3Ny01My4xNjYtMjIuMDc3LTI1LjM5NCAwLTQ2LjUyNSAxNi42NjItNTguODM0IDI5LjIxMS0xMi4wNTEtMTIuNjE0LTMyLjkxLTI5LjIxMS01OS4yNDctMjkuMjExLTE5Ljg0IDAtMzguNzIxIDcuODQtNTMuMTY1IDIyLjA3Ny0xNC4xODQgMTMuOTgyLTIyLjU3OSAzMi42MDEtMjMuNjQxIDUyLjQzOC0xLjM1NSAyNS4zODcgOC40ODMgNDMuNDg5IDE2LjAwMSA1NC44OTggMTAuNTI5IDE1Ljk3NyAzNi41NyA0MC4xMTIgNTcuNDMgNTcuMzcxIDkuOTU4IDguMjM5IDE4LjM0MiAxNC42ODQgMjUuNDE0IDE5LjczMkgxMTMuMDE0Yy0yOS40NS0zNC4yMS00NS42LTc3LjYzMy00NS42LTEyMi45NTIgMC0xMDMuOTg3IDg0LjYtMTg4LjU4NyAxODguNTg3LTE4OC41ODd6bS4xNSAzMDEuNTgxYy01LjU3LTIuMDQ4LTIxLjk4NC0xMi4xNzEtNDcuMjc0LTMzLjM1Mi0yMi43MzctMTkuMDQxLTQyLjYtMzguNzk1LTQ5LjQyNC00OS4xNDktOC43MzEtMTMuMjUxLTEyLjE1MS0yNC42MzItMTEuNDM1LTM4LjA1NCAxLjQyLTI2LjUyMSAyMy4zNzMtNDguMDk4IDQ4Ljk0LTQ4LjA5OCAyNi41MTMgMCA0Ny4yMzggMzAuMzczIDQ3LjQyMiAzMC42NDcgMi41NDEgMy44MjkgNi44MTYgNi4xNDYgMTEuNDEgNi4yMiA0LjYwNi4wNzMgOC45NDItMi4xMzMgMTEuNjA2LTUuODggNi4xMjgtOC42MiAyNi42MzMtMzAuOTg3IDQ3LjY0Mi0zMC45ODcgMjUuNTY4IDAgNDcuNTI1IDIxLjU3OCA0OC45NDQgNDguMS43MTcgMTMuMzktMi43MDQgMjQuNzc0LTExLjQ0MSAzOC4wNjItNi45MDYgMTAuNTAzLTI2LjcyNSAzMC4zMTUtNDkuMzE1IDQ5LjI5Ni0yNS4xNTEgMjEuMTM0LTQxLjUxMyAzMS4xODgtNDcuMDc1IDMzLjE5NXptLTE0My42MTggMzcuODYzaDI4Ni45MzZsMTAuNDk5IDM0LjUxNkgxMDIuMDMzbDEwLjUtMzQuNTE2em0zMjEuOTQxIDExNi43NDZINzcuNTI3di0xMy4yMWgyMDIuNzA5YzcuNzA1IDAgMTMuOTUzLTYuMjQ4IDEzLjk1My0xMy45NTMgMC03LjcwNS02LjI0OC0xMy45NTItMTMuOTUzLTEzLjk1Mkg3Ny41Mjd2LTEzLjIxaDM1Ni45NDd2NTQuMzI1eiIvPgogIDxwYXRoIGQ9Ik0zMjEuODcxIDQ3MC44ODJjLTMuNjg1IDAtNy4yNjktMS40OC05Ljg2NC00LjA4OC0yLjU5NC0yLjU5NS00LjA4OC02LjE4Mi00LjA4OC05Ljg2NCAwLS45MDcuMDg0LTEuODI5LjI2NC0yLjcyMS4xODMtLjg5My40NDYtMS43NzIuODA5LTIuNjA5LjM0OS0uODUuNzY5LTEuNjU5IDEuMjg0LTIuNDEyLjUwMi0uNzY3IDEuMDg4LTEuNDggMS43My0yLjEyMiAzLjIzNy0zLjIzNiA4LjA2NS00LjczIDEyLjU4Ny0zLjgwOC44OTMuMTgxIDEuNzcyLjQ0NSAyLjYwOS43OTQuODUuMzQ5IDEuNjU5Ljc4MyAyLjQxMiAxLjI4NC43NjcuNTAyIDEuNDc5IDEuMDg4IDIuMTIyIDEuNzMuNjQyLjY0MiAxLjIyOCAxLjM1NSAxLjcyOSAyLjEyMi41MDIuNzUzLjkzNSAxLjU2MyAxLjI4NCAyLjQxMi4zNDkuODM5LjYyOCAxLjcxNi43OTUgMi42MDkuMTgxLjg5My4yNzkgMS44MTQuMjc5IDIuNzIxIDAgMy42ODQtMS40OTMgNy4yNjktNC4wODggOS44NjQtLjY0My42NDItMS4zNTUgMS4yMjgtMi4xMjIgMS43NDQtLjc1My41MDEtMS41NjMuOTM1LTIuNDEyIDEuMjg0LS44MzkuMzQ5LTEuNzE2LjYxMy0yLjYwOS43OTQtLjg5NS4xODItMS44MTYuMjY2LTIuNzIxLjI2NnoiLz4KPC9zdmc+Cg==);
    width: 30px;
    height: 30px;
    background-size: 30px;
    display: block;
    background-origin: content-box;
    background-repeat: no-repeat;
}
</style>';

        echo $out;
    }
}

add_action( 'wp_footer', 'chr_chat_three' );
function chr_chat_three() {
    if ( ! is_user_logged_in() )
        return;

    if ( rcl_get_option( 'chr_chat' ) == 1 ) {

        $out = '
<style>
div.rcl-smiles .fa-smile-o::before {
	content: "🎄";
	margin: 0 0 6px;
	display: block;
}
</style>';

        echo $out;
    }
}

add_action( 'wp_footer', 'chr_chat_sound' );
function chr_chat_sound() {
    if ( rcl_get_option( 'chr_hoho' ) == 1 ) {

        $out = "
rcl_add_filter('rcl_chat_sound_options','dd3_sound');
function dd3_sound(options){
    options.path = Rcl.wpurl + '/wp-content/wp-recall/add-on/christmas-time/inc/';
    options.sounds = ['ho-ho-ho'];
    options.volume = '0.6';

    return options;
}
";
        echo '<script>' . $out . '</script>';
    }
}

add_action( 'wp_footer', 'chr_santa_bttm', 20 );
function chr_santa_bttm() {
    if ( rcl_get_option( 'chr_santa' ) == 1 ) {
        $img_santa1 = rcl_addon_url( 'inc/xmas-bottom.png', __FILE__ );
        $img_santa2 = rcl_addon_url( 'inc/xmas-bgnd.gif', __FILE__ );
        $img_santa3 = rcl_addon_url( 'inc/xmas-santa.gif', __FILE__ );

        $chr_after = '<style>
#santa{background: url("' . $img_santa2 . '")  left bottom;}
#santa:before{background: url("' . $img_santa3 . '") transparent no-repeat;}
#santa:after{background: url("' . $img_santa1 . '") transparent repeat-x;}
</style>
<div id="santa"></div>';

        echo $chr_after;
    }
}

add_action( 'admin_footer', 'chr_adm_style' );
function chr_adm_style() {

    $chr_page = get_current_screen();

    if ( $chr_page->parent_base != 'manage-wprecall' )
        return;

    $chr_img_bcgrnd = rcl_addon_url( 'inc/adm-chr-christmas.jpg', __FILE__ );
    $chr_img_prev1  = rcl_addon_url( 'inc/adm-chr-background.jpg', __FILE__ );
    $chr_img_prev2  = rcl_addon_url( 'inc/adm-chr-light.jpg', __FILE__ );
    $chr_img_prev3  = rcl_addon_url( 'inc/adm-chr-light-2.jpg', __FILE__ );
    $chr_img_prev4  = rcl_addon_url( 'inc/adm-chr-hat.jpg', __FILE__ );
    $chr_img_prev5  = rcl_addon_url( 'inc/adm-chr-snow.jpg', __FILE__ );
    $chr_img_prev6  = rcl_addon_url( 'inc/adm-chr-bck.jpg', __FILE__ );
    $chr_img_prev7  = rcl_addon_url( 'inc/adm-chr-santa.jpg', __FILE__ );

    $chr_img_prev9  = rcl_addon_url( 'inc/chr_rtng.png', __FILE__ );
    $chr_img_prev10 = rcl_addon_url( 'inc/chr_chat_three.png', __FILE__ );
    $chr_img_prev11 = rcl_addon_url( 'inc/chr_add_text_form_sign.png', __FILE__ );
    $chr_img_prev12 = rcl_addon_url( 'inc/chr_add_in_rcl_bar.png', __FILE__ );

    $img_bcgrnd_adm = '<style>
#chrst_box_id-options-box {
    background: url("' . $chr_img_bcgrnd . '") no-repeat;
    box-shadow: 0 0 10px 5px rgb(79, 112, 159) inset;
    padding: 35px;
}
#chrst_box_id-options-box::after {
    content: "Здоровья и удачи в 2021-м году! CodeSeller.ru";
    color: #000;
    background: rgba(124, 242, 169, .8);
    padding: 12px 24px;
    font: bold 16px Arial,Georgia;
    margin: 18px auto;
    display: table;
}
#chrst_box_id-options-box .options-group {
    background-color: rgba(139, 179, 223,.88);
    border: none;
    box-shadow: 0 0 3px 1px #2c558f;
    font-size: 16px;
    padding: 0;
    margin: 24px 0;
}
#chrst_box_id-options-box .options-group .group-title {
    color: #f7ea84;
    font-size: 24px;
    text-align: center;
    text-shadow: 1px 2px 0px #1d4a57;
    padding: 3px 0 6px;
    line-height: normal;
    background: #45867a;
}
#chrst_box_id-options-box .options-group .rcl-option .dashicons-editor-help {
    color: #f0ede5;
}
#chrst_box_id-options-box .options-group .rcl-option {
    padding: 0 6px 6px;
    color: #000;
    box-sizing: border-box;
}
#chrst_box_id-options-box .options-group .rcl-field-notice {
    color: #000;
}
#chrst_box_id-options-box .options-group::after {
    background-repeat: no-repeat;
    content: "";
    display: block;
}
#chrst_box_id-options-box #options-group-chrst_group_1::after {
    background-image: url("' . $chr_img_prev1 . '");
    height: 222px;
}
#chrst_box_id-options-box #options-group-chrst_group_2::after {
    background-image: url("' . $chr_img_prev2 . '");
    height: 97px;
}
#chrst_box_id-options-box #options-group-chrst_group_3::after {
    background-image: url("' . $chr_img_prev3 . '");
    height: 85px;
}
#chrst_box_id-options-box #options-group-chrst_group_4::after {
    background-image: url("' . $chr_img_prev4 . '");
    height: 160px;
}
#chrst_box_id-options-box #options-group-chrst_group_5::after {
    background-image: url("' . $chr_img_prev5 . '");
    height: 150px;
}
#chrst_box_id-options-box #options-group-chrst_group_6::after {
    background-image: url("' . $chr_img_prev6 . '");
    height: 130px;
}
#chrst_box_id-options-box #options-group-chrst_group_7::after {
    background-image: url("' . $chr_img_prev7 . '");
    height: 90px;
}
#chrst_box_id-options-box #options-group-chrst_group_9::after {
    background-image: url("' . $chr_img_prev9 . '");
    height: 150px;
    background-size: cover;
}
#chrst_box_id-options-box #options-group-chrst_group_10::after {
    background-image: url("' . $chr_img_prev10 . '");
    height: 130px;
    background-size: cover;
    background-position-x: -20px;
}
#chrst_box_id-options-box #options-group-chrst_group_11::after {
    background-image: url("' . $chr_img_prev11 . '");
    height: 165px;
    background-size: cover;
}
#chrst_box_id-options-box #options-group-chrst_group_12::after {
    background-image: url("' . $chr_img_prev12 . '");
    height: 210px;
    background-position-x: -120px;
}
</style>';
    echo $img_bcgrnd_adm;
}

// idea https://codepen.io/codemzy/full/pgNKEq
add_shortcode( 'chr_counter', 'chr_counter_load' );
function chr_counter_load( $width ) {
    wp_enqueue_style( 'chr-count', rcl_addon_url( 'counter/count.css', __FILE__ ) );
    wp_enqueue_script( 'chr-count', rcl_addon_url( 'counter/count.js', __FILE__ ) );

    return chr_counter_box( $width );
}

function chr_counter_box( $width = false ) {
    $out = '<div class="chr_wrapper" style="opacity:0;">
                <div id="chr_header">До нового года:</div>
                <div class="chr_container">
                  <div class="chr_col" style="min-width:' . $width . 'px;">
                      <div class="chr_top_pane">
                        <div id="chr_days" class="chr_num">00</div>
                      </div>
                      <div class="chr_bottom_pane">
                        <div id="chr_days_text" class="chr_text">дни</div>
                      </div>
                  </div>
                  <div class="chr_col" style="min-width:' . $width . 'px;">
                      <div class="chr_top_pane">
                        <div id="chr_hours" class="chr_num">00</div>
                      </div>
                      <div class="chr_bottom_pane">
                        <div id="chr_hours_text" class="chr_text">часы</div>
                      </div>
                  </div>
                  <div class="chr_col" style="min-width:' . $width . 'px;">
                      <div class="chr_top_pane">
                        <div id="chr_mins" class="chr_num">00</div>
                      </div>
                      <div class="chr_bottom_pane">
                        <div id="chr_mins_text" class="chr_text">минуты</div>
                      </div>
                  </div>
                  <div class="chr_col" style="min-width:' . $width . 'px;">
                      <div class="chr_top_pane">
                        <div id="chr_secs" class="chr_num">00</div>
                      </div>
                      <div class="chr_bottom_pane">
                        <div id="chr_secs_text" class="chr_text">секунды</div>
                      </div>
                  </div>
                </div>
                <div id="chr_info" class="small"></div>
            </div>';

    return $out;
}

// в форму входа текст
add_action( 'rcl_register_form_head', 'chr_add_text_form_sign', 10 );
add_action( 'rcl_remember_form_head', 'chr_add_text_form_sign', 10 );
add_action( 'rcl_login_form_head', 'chr_add_text_form_sign', 10 );
function chr_add_text_form_sign() {
    if ( is_user_logged_in() )
        return;

    if ( ! rcl_get_option( 'chr_hello' ) )
        return;

    $text = rcl_get_option( 'chr_hello_txt', '🎄  ☃️  🎅  Желаем счастья и здоровья в Новом Году!' );

    $text_out = apply_filters( 'chr_add_text_form_sign', $text );

    $out = '<div class="chr_header_form" style="margin:20px 0;text-align:center;">';
    $out .= '<style>.chr_header_form > img {margin: 0 9px 0 0 !important;}</style>';
    $out .= $text_out;
    $out .= '</div>';

    echo $out;
}

// в меню автора реколлбара текст
add_action( 'rcl_bar_print_menu', 'chr_add_in_rcl_bar', 10 );
function chr_add_in_rcl_bar() {
    if ( ! is_user_logged_in() )
        return;

    if ( ! rcl_get_option( 'chr_rclb' ) )
        return;

    $text = rcl_get_option( 'chr_rclb_txt', 'В Новом Году удачи 💰, любви 🥰 и здоровья 💪 желаем Вам!' );

    $text_out = apply_filters( 'chr_add_in_rcl_bar', $text );

    $out = '<div class="chr_header_bar" style="margin:20px 0;text-align:center;color:#fff;line-height:30px;">';
    $out .= '<style>.chr_header_bar > img {margin: 0 9px !important;}</style>';
    $out .= $text_out;
    $out .= '</div>';

    echo $out;
}
