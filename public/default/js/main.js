/**
 * Добавление товаров в корзину
 * @param item
 */
function addToCart(item)
{
    $.ajax({
        method: "POST",
        url: "/cart/addtocart/",
        dataType: "json",
        data: { id: item }
    }).done(function(data) {
        if (data['success']) {
            $('.card-title').html(data['countItems']);
            $('#item_cart_' + item).hide();
            $('#remove_item_cart_' + item).show();
        }
    });
}

/**
 * Добавление товаров в корзину
 * @param item
 */
function removeToCart(item)
{
    $.ajax({
        method: "POST",
        url: "/cart/removetocart/",
        dataType: "json",
        data: { id: item }
    }).done(function(data) {
        if (data['success']) {
            $('.card-title').html(data['countItems']);
            $('#remove_item_cart_' + item).hide();
            $('#item_cart_' + item).show();
        }
    });
}

/**
 * Изменение цены при добалении количества
 * @param idElement
 */
function conversionPrice(idElement) {
    var newCount = $("#item_count_" + idElement).val();
    var itemPrice = $("#item_price_" + idElement).attr('data-value');
    var itemRealPrice = newCount * itemPrice;
    $("#item_real_" + idElement).html(itemRealPrice);
}

$('#add_cart_link').click(function () {
    addToCart($(this).attr('data-index'));
    return false;
});

$('#remove_cart_link').click(function () {
    removeToCart($(this).attr('data-index'));
    return false;
});








