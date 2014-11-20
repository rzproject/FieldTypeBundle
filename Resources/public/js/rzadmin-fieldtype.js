jQuery(document).ready(function () {
    rzadmin_fieldtype.init();
});

// specific JS for rzAdminTheme2
var rzadmin_fieldtype = {

    init:function(){
        //rzadmin_fieldtype.initChosen();
        rzadmin_fieldtype.initSelect2();
        rzadmin_fieldtype.initSelectPicker();
        rzadmin_fieldtype.initDatePicker();
        rzadmin_fieldtype.initTimePicker();
        rzadmin_fieldtype.initDateTimePicker();
        rzadmin_fieldtype.initMultiSelect();
    },

    /**
     * render log message
     */
    log: function() {
        var msg = '[Rz.Admin.FieldType] ' + Array.prototype.join.call(arguments,', ');
        if (window.console && window.console.log) {
            window.console.log(msg);
        } else if (window.opera && window.opera.postError) {
            window.opera.postError(msg);
        }
    },

    initChosen: function() {
        // Chosen (chosen)
        if(jQuery('.chosen-select').length > 0)
        {
            jQuery('.chosen-select').each(function(){
                var $el = jQuery(this);
                var search = ($el.attr("data-nosearch") === "true") ? true : false,
                    opt = {};
                if(search) {
                    opt.disable_search_threshold = 9999999;
                }
                opt.allow_single_deselect = true;
                $el.chosen(opt);
            });

            rzadmin_fieldtype.resizeChosen();
        }
    },

    initChosenById: function(id, options) {
        if(jQuery("#"+id).length > 0 ) {
            jQuery("#"+id).chosen(options ? options : null);
        }
    },

    initSelectPicker: function() {
        if(jQuery('.selectpicker').length > 0) {
            jQuery('.selectpicker').selectpicker();
        }
    },

    initSelectPickerById: function(id, options) {
        if(jQuery("#"+id).length > 0 ) {
            jQuery('#'+id).selectpicker(options ? options : null);
        }
    },

    initDatePicker: function() {
        if(jQuery('.rz-datepicker').length > 0){
            jQuery('.rz-datepicker').datepicker();
        }
    },

    initDatePickerById: function(id, options) {
        if(jQuery("#"+id).length > 0 ) {
            jQuery('#'+id).datepicker(options ? options : null);
        }
    },

    initTimePicker: function() {
        if(jQuery('.rz-timepicker').length > 0) {
            jQuery('.rz-timepicker').timepicker({
                'defaultTime': false,
                'showMeridian': false});
        }
    },

    initTimePickerById: function(id, options) {
        if(jQuery("#"+id).length > 0 ) {
            jQuery('#'+id).timepicker(options ? options : null);
        }
    },

    initDateTimePicker: function() {
        //TODO: pass params via HTML tags
        if (jQuery('.rz-datetimepicker').length > 0) {
            jQuery('.rz-datetimepicker').datetimepicker({
                autoclose: true,
                todayBtn: true,
                pickerPosition: "bottom-left",
                minuteStep: 5
            });
        }
    },

    initDateTimePickerById: function(id, options) {
        if(jQuery("#"+id).length > 0 ) {
            jQuery('#'+id).datetimepicker(options ? options : null);
        }
    },

    initMultiSelect: function() {
        if(jQuery('.multiselect').length > 0)
        {
            jQuery(".multiselect").each(function(){
                var $el = jQuery(this);
                var selectableHeader = $el.attr('data-selectableheader'),
                    selectionHeader  = $el.attr('data-selectionheader');
                if(selectableHeader != undefined)
                {
                    selectableHeader = "<div class='multi-custom-header'>"+selectableHeader+"</div>";
                }
                if(selectionHeader != undefined)
                {
                    selectionHeader = "<div class='multi-custom-header'>"+selectionHeader+"</div>";
                }
                $el.multiSelect({
                    selectionHeader : selectionHeader,
                    selectableHeader : selectableHeader
                });
            });
        }
    },

    initMultiSelectById: function(id, options) {
        if(jQuery("#"+id).length > 0 ) {
            jQuery('#'+id).datetimepicker(options ? options : null);
        }
    },

    resizeChosen: function(){
        if (jQuery('.chosen-container').length > 0){
            jQuery('.chosen-container').each(function() {
                console.log('triggered');
                var $el = jQuery(this);
                $el.css('width', $el.parent().width()+'px');
                $el.find(".chosen-drop").css('width', ($el.parent().width()-2)+'px');
            });
        }
    },

    initSelect2: function(id, options) {
        //TODO: pass params via HTML tags
        if (jQuery('.chosen-select').length > 0) {
            jQuery('select.chosen-select').select2();
        }
    }
}

jQuery(window).resize(function(e){
    rzadmin_fieldtype.resizeChosen();
});
