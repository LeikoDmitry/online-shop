<main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
    <h1>{$pageTitle}</h1>
    {if ! $products}
        В корзине пусто
    {else}
        <form method="post" action="/cart/order/">
            <table class="table table-hover table-responsive">
                <thead>
                <tr class="table-dark">
                    <th>id</th>
                    <th>Наименование</th>
                    <th>Количество</th>
                    <th>Цена за единицу</th>
                    <th>Цена</th>
                    <th>Дествие</th>
                </tr>
                </thead>
                <tbody>
                {foreach $products as $product}
                    <tr>
                        <th>{$product['id']}</th>
                        <td>{$product['name']}</td>
                        <td>
                            <div class="form-group">
                                <input name="{$product['id']}" onchange="conversionPrice({$product['id']})" min="1" class="form-control"
                                       type="number" id="item_count_{$product['id']}" value="1"/>
                            </div>
                        </td>
                        <td>
                            <span id="item_price_{$product['id']}"
                                  data-value="{$product['price']}">{$product['price']}</span>
                        </td>
                        <td><span id="item_real_{$product['id']}">{$product['price']}</span></td>
                        <td>
                            <p style="display: none" id="item_cart_{$product['id']}"><a data-index="{$product['id']}"
                                                                                        id="add_cart_link" href="#">Восстановить</a>
                            </p>
                            <p style="display: block;" id="remove_item_cart_{$product['id']}"><a
                                        data-index="{$product['id']}" id="remove_cart_link" href="#">Удалить</a></p>
                        </td>
                    </tr>
                {/foreach}
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Add order</button>
        </form>
    {/if}
</main>