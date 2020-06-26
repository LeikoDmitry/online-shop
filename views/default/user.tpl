{* Страница пользователя *}
<main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
    <h1>{$pageTitle}</h1>
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
            </tr>
            </thead>
            <tbody>
            {foreach $rsUserOrders as $order}
                <tr>
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_{$order['id']}">
                            Показать товар
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal_{$order['id']}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <th>{$order['id']}</th>
                    <td>{$order['status']}</td>
                    <td>{$order['date_created']}</td>
                    <td>{$order['date_payment']}</td>
                    <td>{$order['comment']}</td>
                </tr>
                <!-- Button trigger modal -->
                <!-- Modal -->
            {/foreach}
            </tbody>
        </table>
    </div>
    <form method="post">
        <div class="form-group">
            <label for="inputEmail4" class="col-form-label">Email</label>
            <input name="email" disabled type="email" value="{$arrayUser['email']}" class="form-control"
                   id="inputEmail4" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="inputName" class="col-form-label">Name</label>
            <input name="name" type="text" class="form-control" value="{$arrayUser['name']}" id="inputName"
                   placeholder="Name">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputAdress" class="col-form-label">Address</label>
                <input name="address" type="text" class="form-control" id="inputAdress" value="{$arrayUser['address']}">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPhone" class="col-form-label">Phone</label>
                <input name="phone" type="text" class="form-control" id="inputPhone" value="{$arrayUser['phone']}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Edit</button>
    </form>
</main>