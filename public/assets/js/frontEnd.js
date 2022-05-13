$(function() {
    $('[data-toggle="popover"]').popover({
        container: 'body',
        trigger: 'hover',
        html: true,
    });
    $('#myTooltip').on('hidden.bs.popover', function() {
        // alert();
    })
});