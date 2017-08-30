{* Страница потверждения заказа *}
<main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
    <h1>{$pageTitle}</h1>
    <form method="post" action="/cart/saveorder/">
        <table class="table table-hover table-responsive">
            <thead>
                <tr class="bg-info">
                    <th>id</th>
                    <th>Наименование</th>
                    <th>Количество</th>
                    <th>Цена за единицу</th>
                    <th>Стоимость</th>
                </tr>
            </thead>
            <tbody>
                {foreach $rsProducts as $product}
                    <tr>
                        <td>
                            {$product['id']}
                            <input type="hidden" name="id_{$product['id']}" value="{$product['id']}">
                        </td>
                        <td>
                            {$product['name']}
                            <input type="hidden" name="name_{$product['id']}" value="{$product['name']}">
                        </td>
                        <td>
                            {$product['count']}
                            <input type="hidden" name="count_{$product['id']}" value="{$product['count']}">
                        </td>
                        <td>
                            {$product['price']}
                            <input type="hidden" name="price_{$product['id']}" value="{$product['price']}">
                        </td>
                        <td>
                            {$product['realPrice']}
                            <input type="hidden" name="realPrice_{$product['id']}" value="{$product['realPrice']}">
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
        {if isset($arrayUser)}
            <button type="submit" class="btn btn-primary">Потвердить</button>
        {else}
            <p>Необходимо пройти <a href="/user/login/">регистрацию</a> или <a href="/user/register/">авторизаваться</a></p>
        {/if}
    </form>
</main>