if (localStorage.getItem('poItems')) {
    loadItems();
}

function loadItems() {
    if (localStorage.getItem('poItems')) {
        total = 0;
        count = 1;
        an = 1;
        product_tax = 0;
        invoice_tax = 0;
        product_discount = 0;
        order_discount = 0;
        $("#poTable tbody").empty();
        $("#poTable tfoot").empty();
        tr_data = "";
        poItems = JSON.parse(localStorage.getItem('poItems'));
        sortedItems = poItems;
        $.each(sortedItems, function() {
            var item = this;
            var item_id = item.id;
            item.order = item.order ? item.order : new Date().getTime();

            tr_data += `<tr id="row_${item_id}" data-item-id="${item_id}">
                        <td>
                            <input type="hidden" name="product_id[]" value="${item.row.id}">
                            <span>${item.row.code}-${item.row.name}</span>
                            <i class="float-right fa fa-edit tip edit" id="1" data-item="1" title="Edit" style="cursor:pointer;"></i>
                        </td>
                        <td class="text-center"><span class="unit_cost">${item.row.cost}</span></td>
                        <td class="text-center"><input type="text" class="form-control text-center qty class="" value="${item.row.qty}"></td>
                        <td class="text-center"><span>0</span></td>
                        <td class="text-right"><span>${parseFloat(item.row.qty) * parseFloat(item.row.cost)}</span></td>
                        <td class="text-right"><i class="fa fa-times tip podel" id="1" title="Remove" style="cursor:pointer;"></i></td>
                    </tr>`;

            $("#poTable tbody").html(tr_data);
            an++;
            count += parseFloat(item.row.qty);
            total += parseFloat(item.row.qty) * parseFloat(item.row.cost);
        });
        var tfoot = `<tr>
                        <th>Total</th>
                        <th></th>
                        <th class="text-center">${(count -1)}</th>
                        <th></th>
                        <th class="text-right">${total}</th>
                        <th class="text-right"><i class="fa fa-trash" style="opacity:0.5; filter:alpha(opacity=50);"></i></th>
                    </tr>`;
        $("#poTable tfoot").html(tfoot);
    }
}

function add_invoice_item(item) {

    if (count == 1) {
        poItems = {};
    }
    if (item == null)
        return;

    var item_id = item.id;
    poItems[item_id] = item;
    poItems[item_id].order = new Date().getTime();
    localStorage.setItem('poItems', JSON.stringify(poItems));
    loadItems();
    return true;
}

// Jquery Loaded
$(function() {
    // delete item
    $(document).on('click', '.podel', function() {
        var row = $(this).closest('tr');
        var item_id = row.attr('data-item-id');
        delete poItems[item_id];
        row.remove();
        if (poItems.hasOwnProperty(item_id)) {} else {
            localStorage.setItem('poItems', JSON.stringify(poItems));
            loadItems();
            return;
        }
    });
    var old_row_qty;
    $(document).on("focus", '.qty', function() {
        old_row_qty = $(this).val();
    }).on("change", '.qty', function() {
        var row = $(this).closest('tr');
        if (!is_numeric($(this).val()) || parseFloat($(this).val()) < 0) {
            $(this).val(old_row_qty);
            bootbox.alert('unexpected value');
            return;
        }
        var new_qty = parseFloat($(this).val()),
            item_id = row.attr('data-item-id');
        poItems[item_id].row.quantity = new_qty;
        poItems[item_id].row.qty = new_qty;
        localStorage.setItem('poItems', JSON.stringify(poItems));
        loadItems();
    });
    // show modal edit item
    $(document).on('click', '.edit', function() {
        var row = $(this).closest('tr');
        var row_id = row.attr('id');
        item_id = row.attr('data-item-id');
        item = poItems[item_id];
        var qty = row.children().children('.qty').val();
        var unit_cost = row.children().children('.unit_cost').text();
        $('#pqty').val(qty);
        $('#unit_cost').val(unit_cost);
        $('#prModalLabel').text(item.row.name + ' (' + item.row.code + ')');

        $('#row_id').val(row_id);
        $('#item_id').val(item_id);
        $('#prModal').appendTo("body").modal('show');

    });

    $(document).on('click', '#editItem', function() {
        var row = $('#' + $('#row_id').val());
        var item_id = row.attr('data-item-id');
        alert(item_id);
    });
});
