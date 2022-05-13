// const { find } = require("lodash");

function is_numeric(mixed_var) {
    var whitespace =
        " \n\r\t\f\x0b\xa0\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u200b\u2028\u2029\u3000";
    return (typeof mixed_var === 'number' || (typeof mixed_var === 'string' && whitespace.indexOf(mixed_var.slice(-1)) === -
        1)) && mixed_var !== '' && !isNaN(mixed_var);
}



function loadCheckBox() {
    $("table input[type='checkbox']").iCheck({
        checkboxClass: 'icheckbox_square-green',
    });
    $("input[type='checkbox']").iCheck({
        checkboxClass: 'icheckbox_square-green',
    });
}

function checkbox(id) {
    $("table input[type='checkbox']").iCheck({
        checkboxClass: 'icheckbox_square-green',
    });
    loadCheckBox();
    return '<div class="text-center"><input class="checkbox multi-select" type="checkbox" name="item_id[]" value="' + id + '" /></div>';
}

function validateThemeColor(color) {
    if (color == "style_dark" || $.cookie('tim_theme_style') == "style_dark") {
        $('<link>')
            .appendTo('head')
            .attr({ type: 'text/css', rel: 'stylesheet' })
            .attr('href', site.base_url + '/assets/dist/css/adminlte_style_dark.css');
        $('link[href="' + site.base_url + '/assets/dist/css/adminlte.css"]').remove();

    } else if (color == "style_standard" || $.cookie('tim_theme_style') == "style_standard") {
        $('link[href="' + site.base_url + '/assets/dist/css/adminlte.css"]').remove();
        $('<link>')
            .appendTo('head')
            .attr({ type: 'text/css', rel: 'stylesheet' })
            .attr('href', site.base_url + '/assets/dist/css/adminlte.css');
    }
}
var count = 1;
(function($) {
    $.fn.textFormat = function(options) {
        var e = $.extend({}, $.fn.textFormat.defaults, options);
        return $(this).each(function() {
            return $(this).css({
                    fontSize: e.fontSize,
                })
                .addClass(e.className)
                .text(getText);
        });
    };
    $.fn.textFormat.defaults = {
        text: 'Week',
        format: 'W/Y',
        color: '#f00',
        className: 'text-default',
        fontSize: '12px',
        lang: 'en',
    };


})(jQuery);
$(function() {
    $('.table').addClass('table_list_items');
    $(document).ajaxStart(function() {
        $('#ajax_loading').show();
    }).ajaxStop(function() {
        $('#ajax_loading').hide();
    });
    validateThemeColor(color);
    loadCheckBox();
    $('.tip').tooltip({
        trigger: 'hover',
    });
    $('[data-toggle="popover"]').popover({
        container: 'body'
    });
    $("#loading").fadeOut("slow");
    $(".sortable_rows").sortable({
        items: "> tr",
        appendTo: "parent",
        helper: "clone",
        placeholder: "ui-sort-placeholder",
        axis: "x",
        update: function(event, ui) {
            var item_id = $(ui.item).attr('data-item-id');
            console.log(ui.item.index());
        }
    }).disableSelection();
    $('.sortable_table tbody').sortable({
        containerSelector: 'tr'
    });
    $('#podate').datetimepicker({
        format: 'Y/m/d H:i',
        theme: 'dark',
        value: new Date()
    });
    // $('#product_details').summernote();
    $('#clearLS').click(function(event) {
        bootbox.confirm('Are you sure?', function(result) {
            if (result == true) {
                localStorage.clear();
                location.reload();
            }
        });
        return false;
    });

    $(document).on('click', '.btn_select_theme_color', function() {
        var value = $(this).attr('id');
        $.cookie('tim_theme_style', value, { path: '/' });
        var color = $.cookie('tim_theme_style');
        validateThemeColor(color);
        location.reload(true);
        return true;
    });
    if ($.cookie('tim_theme_style') == "style_standard") {
        $('#style_standard').prepend('<input type="checkbox" class="checkbox style_standard" checked>');
        $("input.style_standard[type='checkbox']").iCheck({
            checkboxClass: 'icheckbox_polaris',
            increaseArea: '-10%'
        });
        var color = $('#style_standard').find('span').css('color');
        $('#btn_toggle_theme').css({ color: '' + color + '' });
    } else if ($.cookie('tim_theme_style') == "style_purple") {
        $('#style_purple').prepend('<input type="checkbox" class="checkbox style_purple" checked>');
        $("input.style_purple[type='checkbox']").iCheck({
            checkboxClass: 'icheckbox_polaris',
            increaseArea: '-10%'
        });
        var color = $('#style_purple').find('span').css('color');
        $('#btn_toggle_theme').css({ color: '' + color + '' });
    } else if ($.cookie('tim_theme_style') == "style_pink") {
        $('#style_pink').prepend('<input type="checkbox" class="checkbox style_pink" checked>');
        $("input.style_pink[type='checkbox']").iCheck({
            checkboxClass: 'icheckbox_polaris',
            increaseArea: '-10%'
        });
        var color = $('#style_pink').find('span').css('color');
        $('#btn_toggle_theme').css({ color: '' + color + '' });
    } else if ($.cookie('tim_theme_style') == "style_blue") {
        $('#style_blue').prepend('<input type="checkbox" class="checkbox style_blue" checked>');
        $("input.style_blue[type='checkbox']").iCheck({
            checkboxClass: 'icheckbox_polaris',
            increaseArea: '-10%'
        });
        var color = $('#style_blue').find('span').css('color');
        $('#btn_toggle_theme').css({ color: '' + color + '' });
    } else if ($.cookie('tim_theme_style') == "style_flat_red") {
        $('#style_flat_red').prepend('<input type="checkbox" class="checkbox style_flat_red" checked>');
        $("input.style_flat_red[type='checkbox']").iCheck({
            checkboxClass: 'icheckbox_polaris',
            increaseArea: '-10%'
        });
        var color = $('#style_flat_red').find('span').css('color');
        $('#btn_toggle_theme').css({ color: '' + color + '' });
    } else if ($.cookie('tim_theme_style') == "style_green") {
        $('#style_green').prepend('<input type="checkbox" class="checkbox style_green" checked>');
        $("input.style_green[type='checkbox']").iCheck({
            checkboxClass: 'icheckbox_polaris',
            increaseArea: '-10%'
        });
        var color = $('#style_green').find('span').css('color');
        $('#btn_toggle_theme').css({ color: '' + color + '' });
    } else if ($.cookie('tim_theme_style') == "style_dark") {
        $('#style_dark').prepend('<input type="checkbox" class="checkbox style_dark" checked>');
        $("input.style_dark[type='checkbox']").iCheck({
            checkboxClass: 'icheckbox_polaris',
            increaseArea: '-10%'
        });
        var colors = $('#style_dark').find('span').css('color');
        $('#btn_toggle_theme').css({ color: '' + colors + '' });
    }
    var checkAll = $('.table > thead tr th input.checkbox');
    var checkboxes = $(".table tbody tr td .checkbox");
    $(document).on('ifChecked ifUnchecked', '.table > thead tr th input.checkbox, .checkft', function(event) {
        // $('.checkth, .checkft').iCheck('check');
        if (event.type == 'ifChecked') {
            $('.multi-select').each(function() {
                $(this).iCheck('check');
            });
        } else {
            $('.multi-select').each(function() {
                $(this).iCheck('uncheck');
            });
        }
    });
    // $(document).on('ifUnchecked', '.table > thead tr th input.checkbox, .checkft', function(event) {
    //     $('.checkth, .checkft').iCheck('uncheck');
    //     $('.multi-select').each(function() {
    //         $(this).iCheck('uncheck');
    //     });
    // });
    $(document).on('ifChanged', '.multi-select', function(event) {
        // $('.checkth, .checkft').attr('checked', false);
        // $('.checkth, .checkft').iCheck('update');

        if ($('.multi-select').filter(':checked').length == 0) {
            checkAll.iCheck('uncheck');
        }
        if ($('.multi-select').filter(':checked').length == $('.multi-select').length) {
            checkAll.prop('checked', 'checked');
        }
        checkAll.iCheck('update');


    });

    // $('#check_all').click(function() {
    //     alert(22);
    // });

    // checkAll.on("ifChecked ifUnchecked", (event) => {
    //     if (event.type == 'ifChecked') {
    //         checkboxes.each(function () {
    //             $(this).iCheck('check');
    //         });
    //     } else {
    //         checkboxes.each(function () {
    //             $(this).iCheck('uncheck');
    //         });
    //     }
    // });
    // checkboxes.on('ifChanged', function(event){
    //     if(checkboxes.filter(':checked').length == 0) {
    //         checkAll.iCheck('uncheck');
    //     }
    //     if(checkboxes.filter(':checked').length == checkboxes.length) {
    //         checkAll.prop('checked', 'checked');
    //     }
    //     checkAll.iCheck('update');
    //     var row = $(this).closest('tr');
    //     row.addClass("success");
    // });
    // checkboxes.on('ifUnchecked', function(event){
    //     var row = $(this).closest('tr');
    //     row.removeClass("success");
    // });

    $(document).on('click', '.btn_export_pdf', (e) => {
        e.preventDefault();
        // $('#form_action').val($(this).attr('data-action'));
        $('#list_products_table_form').submit();
        // $.ajax({
        //     type: 'GET',
        //     url: `${site.base_url + '/admin/product/export_excel'}`,
        //     data: $('#list_products_table_form').serialize(),
        //     dataType: 'json',
        //     success: function(response) {
        //         if (response.products) {
        //             Swal.fire({
        //                 icon: response.icon,
        //                 title: response.status,
        //                 text: response.status_text,
        //                 button: "OK",
        //                 allowOutsideClick: false,
        //             }).then((confirmed) => {
        //                 $('#product_table').DataTable().ajax.reload();
        //             });
        //         }
        //     }
        // });
    });

    // show modal add table
    $(document).on('click', '#add_table', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'GET',
            url: site.base_url + '/admin/setting/create_table',
            success: function(response) {
                if (response.modal) {
                    $('.modal_1').html(response.modal).show();
                    $('#modal_add_table').modal('show');
                }
            }
        });
    });
});