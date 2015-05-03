jQuery(document).ready(function() {

    jQuery('#datepicker-example1').Zebra_DatePicker();

    jQuery('#datepicker-example2').Zebra_DatePicker({
        direction: 1    // boolean true would've made the date picker future only
                        // but starting from today, rather than tomorrow
    });

    jQuery('#datepicker-example3').Zebra_DatePicker({
        direction: true,
        disabled_dates: ['* * * 0,6']   // all days, all monts, all years as long
                                        // as the weekday is 0 or 6 (Sunday or Saturday)
    });

    jQuery('#datepicker-example4').Zebra_DatePicker({
        direction: [1, 10]
    });

    jQuery('#datepicker-example5').Zebra_DatePicker({
        // remember that the way you write down dates
        // depends on the value of the "format" property!
        direction: ['2012-08-01', '2012-08-12']
    });

    jQuery('#datepicker-example6').Zebra_DatePicker({
        // remember that the way you write down dates
        // depends on the value of the "format" property!
        direction: ['2012-08-01', false]
    });

    jQuery('#datepicker-example7-start').Zebra_DatePicker({
        direction: true,
        pair: jQuery('#datepicker-example7-end')
    });

    jQuery('#datepicker-example7-end').Zebra_DatePicker({
        direction: 1
    });

    jQuery('#datepicker-example8').Zebra_DatePicker({
        format: 'M d, Y'
    });

    jQuery('#datepicker-example9').Zebra_DatePicker({
        show_week_number: 'Wk'
    });

    jQuery('#datepicker-example10').Zebra_DatePicker({
        view: 'years'
    });

    jQuery('#datepicker-example11').Zebra_DatePicker({
        format: 'm Y'
    });

    jQuery('#datepicker-example12').Zebra_DatePicker({
        onChange: function(view, elements) {
            if (view == 'days') {
                elements.each(function() {
                    if (jQuery(this).data('date').match(/\-24jQuery/))
                        jQuery(this).css({
                            background: '#C40000',
                            color:      '#FFF'
                        });
                });
            }
        }
    });

    jQuery('#datepicker-example13').Zebra_DatePicker({
        always_visible: jQuery('#container')
    });

    jQuery('#datepicker-example14').Zebra_DatePicker();

});