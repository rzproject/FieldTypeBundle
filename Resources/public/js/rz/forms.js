jQuery(document).ready(function(){
    rz_chosen.init();
    rz_selectpicker.init();
    rz_datepicker.init();
    rz_uniform_checkbox.init();
    rz_timepicker.init();
    rz_qtips.init();
    rz_datetimepicker.init();
    rz_multiselect.init();
//    rz_datetimepicker.init();
});

//* enhanced select elements
var rz_chosen = {
    init: function(){

        if(jQuery(".chosen-select").length > 0 ) {
            jQuery(".chosen-select").chosen({
                allow_single_deselect: true
            });
            jQuery(".chosen-select-multiple").chosen().change(function(){
                console.log(this);
                console.log('parent');

                var ret = null;
                $(this).find('.chosen-choices').each(function(){
                    console.log(this);
                    console.log('child');
//                var selectedValue = $(this).find('span').text();
//                ret.push(selectedValue);
                })
                //console.log(ret);
            });
        }

    },
    initById: function(id, type){
        if(type == 'single') {
            jQuery("#"+id).chosen({
                allow_single_deselect: true
            });
        } else {
            jQuery("#"+id).chosen();
        }
    }
};

//* select
var rz_selectpicker = {
    init: function() {
        jQuery('.selectpicker').selectpicker();
    },
    initById: function(id, options){
        jQuery("#"+id).selectpicker(options ? options : null);
    }
}

//* timepicker
var rz_timepicker = {
    init: function() {
        jQuery('.rz-timepicker').timepicker({'defaultTime': false, 'showMeridian': false});
    },
    initById: function(id, options) {
        jQuery('#'+id).timepicker(options);
    }
}

//* datepicker
var rz_datepicker = {
    init: function() {
        jQuery('.rz-datepicker').datepicker({autoclose: true});
    },
    initById: function(id, options) {
        jQuery('#'+id).datepicker(options);
    }
}

//* timepicker
var rz_datetimepicker = {
    init: function() {
        jQuery('.rz-datetimepicker').datetimepicker({
            autoclose: true,
            todayBtn: true,
            pickerPosition: "bottom-left",
            minuteStep: 5
        });
    }
}

//* uniform
var rz_uniform_checkbox = {
    init: function() {
        jQuery(".uni_style_checkbox").uniform();
    }
};

var rz_qtips = {
    init: function() {

        var shared = {
            style		: {
                classes: 'qtip-youtube'
            },
            show		: {
                delay: 100
            },
            hide		: {
                delay: 0
            }
        };
        if($('.ttip_b').length) {
            $('.ttip_b').qtip( $.extend({}, shared, {
                position	: {
                    my		: 'top center',
                    at		: 'bottom center',
                    viewport: $(window)
                }
            }));
        }
        if($('.ttip_t').length) {
            $('.ttip_t').qtip( $.extend({}, shared, {
                position: {
                    my		: 'bottom center',
                    at		: 'top center',
                    viewport: $(window)
                }
            }));
        }
        if($('.ttip_l').length) {
            $('.ttip_l').qtip( $.extend({}, shared, {
                position: {
                    my		: 'right center',
                    at		: 'left center',
                    viewport: $(window)
                }
            }));
        }
        if($('.ttip_r').length) {
            $('.ttip_r').qtip( $.extend({}, shared, {
                position: {
                    my		: 'left center',
                    at		: 'right center',
                    viewport: $(window)
                }
            }));
        };
    }
};

//* multiselect
var rz_multiselect = {
    init: function(){
        if(jQuery('.multiselect').length) {
            //* searchable
            jQuery('.multiselect').multiSelect();
        }

    }
};
