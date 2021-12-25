jQuery(window).resize(function () {
    let $height = jQuery('.animation-layer').css('padding-top');

    jQuery('.animation-container').css('height', $height);
}).resize();
