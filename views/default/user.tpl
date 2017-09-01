{* Страница пользователя *}
<main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
    <h1>{$pageTitle}</h1>
    <div class="jumbotron">
        <h2>Заказы</h2>
        <table class="table table-response">
            <thead>
            <tr class="bg-success">
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
                    <th>{$order['id']}</th>
                    <td>{$order['status']}</td>
                    <td>{$order['date_created']}</td>
                    <td>{$order['date_payment']}</td>
                    <td>{$order['comment']}</td>
                </tr>
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
                <label for="inputAdress" class="col-form-label">Adress</label>
                <input name="adress" type="text" class="form-control" id="inputAdress" value="{$arrayUser['adress']}">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPhone" class="col-form-label">Phone</label>
                <input name="phone" type="text" class="form-control" id="inputPhone" value="{$arrayUser['phone']}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Edit</button>
    </form>
</main>