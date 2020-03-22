/*global $*/
/*global mailChimpCallBack*/

/* PrettyPhoto
========================*/
$(document).ready(function () {
    "use strict";
	$("a[data-type^='prettyPhoto']").prettyPhoto({
		animation_speed: 'normal',
		theme: 'light_square'
	});
});


$(document).ready(function (e) {
    'use strict';
    $(".rev_slider").revolution({
        sliderType: "standard",
        sliderLayout: "auto",
        dottedOverlay: "none",
        delay: 5000,
        navigation: {
            keyboardNavigation: "off",
            keyboard_direction: "horizontal",
            mouseScrollNavigation: "off",
            onHoverStop: "off",
            touch: {
                touchenabled: "on",
                swipe_threshold: 75,
                swipe_min_touches: 1,
                swipe_direction: "horizontal",
                drag_block_vertical: false
            },
            arrows: {
                style: "gyges",
                enable: true,
                hide_onmobile: true,
                hide_under: 600,
                hide_onleave: true,
                hide_delay: 200,
                hide_delay_mobile: 1200,
                tmp: '<div class="tp-title-wrap">    <div class="tp-arr-imgholder"></div> </div>',
                left: {
                    h_align: "left",
                    v_align: "center",
                    h_offset: 30,
                    v_offset: 0
                },
                right: {
                    h_align: "right",
                    v_align: "center",
                    h_offset: 30,
                    v_offset: 0
                }
            },
            bullets: {
                enable: true,
                hide_onmobile: true,
                hide_under: 600,
                style: "metis",
                hide_onleave: true,
                hide_delay: 200,
                hide_delay_mobile: 1200,
                direction: "horizontal",
                h_align: "center",
                v_align: "bottom",
                h_offset: 0,
                v_offset: 30,
                space: 5,
                tmp: '<span class="tp-bullet-img-wrap">  <span class="tp-bullet-image"></span></span><span class="tp-bullet-title">{{title}}</span>'
            }
        },
        responsiveLevels: [1240, 1024, 778],
        visibilityLevels: [1240, 1024, 778],
        gridwidth: [1170, 1024, 778, 480],
        gridheight: [600, 768, 960, 720],
        lazyType: "none",
        parallax: {
            origo: "slidercenter",
            speed: 1000,
            levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 100, 55],
            type: "scroll"
        },
        shadow: 0,
        spinner: "off",
        stopLoop: "on",
        stopAfterLoops: 0,
        stopAtSlide: -1,
        shuffle: "off",
        autoHeight: "off",
        fullScreenAutoWidth: "off",
        fullScreenAlignForce: "off",
        fullScreenOffsetContainer: "",
        fullScreenOffset: "0",
        hideThumbsOnMobile: "off",
        hideSliderAtLimit: 0,
        hideCaptionAtLimit: 0,
        hideAllCaptionAtLilmit: 0,
        debugMode: false,
        fallbacks: {
            simplifyAll: "off",
            nextSlideOnWindowFocus: "off",
            disableFocusListener: false
        }
    });
});


$("#appointment_form_at_home").validate({
    submitHandler: function (form) {
        'use strict';
        var form_btn = $(form).find('button[type="submit"]');
        var form_result_div = '#form-result';
        $(form_result_div).remove();
        form_btn.before('&amp;lt;div id="form-result" class="alert alert-success" role="alert" style="display: none;"&amp;gt;&amp;lt;/div&amp;gt;');
        
        var form_btn_old_msg = form_btn.html();
        form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
        $(form).ajaxSubmit({
            dataType:  'json',
            success: function (data) {
                if (data.status === 'true') {
                    $(form).find('.form-control').val('');
                }
                form_btn.prop('disabled', false).html(form_btn_old_msg);
                $(form_result_div).html(data.message).fadeIn('slow');
                setTimeout(function () { $(form_result_div).fadeOut('slow'); }, 6000);
            }
        });
    }
});


$("#appointment_form").validate({
    submitHandler: function (form) {
        'use strict';
        var form_btn = $(form).find('button[type="submit"]');
        var form_result_div = '#form-result';
        $(form_result_div).remove();
        form_btn.before('&amp;lt;div id="form-result" class="alert alert-success" role="alert" style="display: none;"&amp;gt;&amp;lt;/div&amp;gt;');
        
        var form_btn_old_msg = form_btn.html();
        form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
        $(form).ajaxSubmit({
            dataType:  'json',
            success: function (data) {
                if (data.status === 'true') {
                    $(form).find('.form-control').val('');
                }
                form_btn.prop('disabled', false).html(form_btn_old_msg);
                $(form_result_div).html(data.message).fadeIn('slow');
                setTimeout(function () { $(form_result_div).fadeOut('slow'); }, 6000);
            }
        });
    }
});


$('#mailchimp-subscription-form').ajaxChimp({
    callback: mailChimpCallBack,
    url: '//thememascot.us9.list-manage.com/subscribe/post?u=a01f440178e35febc8cf4e51f&amp;id=49d6d30e1e'
});

function mailChimpCallBack(resp) {
// Hide any previous response text
    'use strict';
    var $mailchimpform = $('#mailchimp-subscription-form'),
        $response = '';
    $mailchimpform.children(".alert").remove();
    if (resp.result === 'success') {
        $response = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + resp.msg + '</div>';
    } else if (resp.result === 'error') {
        $response = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + resp.msg + '</div>';
    }
    $mailchimpform.prepend($response);
}



$('#mailchimp-subscription-form-footer').ajaxChimp({
    callback: mailChimpCallBack,
    url: '//thememascot.us9.list-manage.com/subscribe/post?u=a01f440178e35febc8cf4e51f&amp;id=49d6d30e1e'
});

function mailChimpCallBack(resp) {
    'use strict';
    // Hide any previous response text
    var $mailchimpform = $('#mailchimp-subscription-form-footer'),
        $response = '';
    $mailchimpform.children(".alert").remove();
    if (resp.result === 'success') {
        $response = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + resp.msg + '</div>';
    } else if (resp.result === 'error') {
        $response = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + resp.msg + '</div>';
    }
    $mailchimpform.prepend($response);
}



$("#appointment_form_at_home").validate({
    submitHandler: function (form) {
        'use strict';
        var form_btn = $(form).find('button[type="submit"]');
        var form_result_div = '#form-result';
        $(form_result_div).remove();
        form_btn.before('&amp;lt;div id="form-result" class="alert alert-success" role="alert" style="display: none;"&amp;gt;&amp;lt;/div&amp;gt;');
        var form_btn_old_msg = form_btn.html();
        form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
        $(form).ajaxSubmit({
            dataType:  'json',
            success: function (data) {
                if (data.status === 'true') {
                    $(form).find('.form-control').val('');
                }
                form_btn.prop('disabled', false).html(form_btn_old_msg);
                $(form_result_div).html(data.message).fadeIn('slow');
                setTimeout(function () { $(form_result_div).fadeOut('slow'); }, 6000);
            }
        });
    }
});




$("#contact_form").validate({
    submitHandler: function (form) {
        'use strict';
        var form_btn = $(form).find('button[type="submit"]');
        var form_result_div = '#form-result';
        $(form_result_div).remove();
        form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
        var form_btn_old_msg = form_btn.html();
        form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
        $(form).ajaxSubmit({
            dataType:  'json',
            success: function (data) {
                if (data.status === 'true') {
                    $(form).find('.form-control').val('');
                }
                form_btn.prop('disabled', false).html(form_btn_old_msg);
                $(form_result_div).html(data.message).fadeIn('slow');
                setTimeout(function () { $(form_result_div).fadeOut('slow'); }, 6000);
            }
        });
    }
});




