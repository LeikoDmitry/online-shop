<div class="jumbotron">
    <h2>Заказы</h2>
    <table class="table table-response">
        <thead>
        <tr class="bg-success">
            <th>Показать товар</th>
            <th>ID заказа</th>
            <th>Статус</th>
            <th>Дата создания</th>
            <th>Дата оплаты</th>
            <th>Дополнительная информация</th>
            <th>Действие</th>
        </tr>
        </thead>
        <tbody>
        {foreach $orders as $order}
            <tr>
                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_{$order['order_id']}">
                        Показать товар
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal_{$order['order_id']}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Информация по продукту</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {if $order['children']}
                                        {foreach $order['children'] as $child}
                                            <p>{$child['name']}</p>
                                            <p>{$child['price']}</p>
                                            <p>{$child['amount']}</p>
                                            <hr>
                                        {/foreach}
                                    {/if}
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <th>{$order['order_id']}</th>
                <td>{$order['status']}</td>
                <td>{$order['date_created']}</td>
                <td>{$order['date_payment']}</td>
                <td>{$order['comment']}</td>
                <td>
                    <a class="btn btn-info" href="/admin/updateorder/{$order['order_id']}/">Обновить</a>
                    <a class="btn btn-danger" href="/admin/deleteoder/{$order['order_id']}/">Удалить</a>
                </td>
            </tr>
            <!-- Button trigger modal -->
            <!-- Modal -->
        {/foreach}
        </tbody>
    </table>
</div>