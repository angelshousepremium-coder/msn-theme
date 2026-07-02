$(document).ready(function() {
    $('.wpcf7 form').submit(function(e) {
        var parent = $(this).closest('.wpcf7');
        var split_array = parent.attr('id').split('-');
        if (split_array[1] == 'f' + 575) {
            yaCounter52129636.reachGoal('kp_ok');
            gtag("event","kp_ok",{event_category:"kp",event_action:"kp_ok",event_label:"form"});
        } else if (split_array[1] == 'f' + 576) {
            yaCounter52129636.reachGoal('lizing_ok');
            gtag("event","lizing_ok",{event_category:"lizing",event_action:"lizing_ok",event_label:"form"});
        } else if (split_array[1] == 'f' + 479) {
            yaCounter52129636.reachGoal('consult_ok');
            gtag("event","consult_ok",{event_category:"consult",event_action:"consult_ok",event_label:"form"});
        } else if (split_array[1] == 'f' + 366) {
            yaCounter52129636.reachGoal('callback_ok');
            gtag("event","callback_ok",{event_category:"callback",event_action:"callback_ok",event_label:"form"});
        }
		else if (split_array[1] == 'f' + 5) {
            yaCounter52129636.reachGoal('zakazat_zvonok');
            gtag('event', 'zakazat_zvonok', {'event_category' : 'send','event_label' : 'form' ,});
        }
		else if (split_array[1] == 'f' + 7731) {
            yaCounter52129636.reachGoal('oformit_zayavky');
            gtag('event', 'oformit_zayavky', {'event_category':'send','event_label':'form'});
        }
		else if (split_array[1] == 'f') {
            yaCounter52129636.reachGoal('click_phone');
            gtag('event', 'phone', {'event_category':'click','event_label':'button'});
        }
		else if (split_array[1] == 'f') {
            yaCounter52129636.reachGoal('click_email');
            gtag('event', 'email', {'event_category':'click','event_label':'button'});  
        }
        // e.preventDefault();
    });
});