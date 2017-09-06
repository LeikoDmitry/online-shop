<div class="col-md-12">
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h2>{$pageTitle}</h2>
            <form class="form-inline">
                <div class="form-group">
                    <label for="staticEmail2" class="sr-only">Email</label>
                    <input type="text" class="form-control" id="staticEmail2" value="email@example.com">
                </div>
                <div class="form-group mx-sm-3">
                    <label for="inputPassword2" class="sr-only">Password</label>
                    <input type="password" class="form-control" id="inputPassword2" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Confirm identity</button>
            </form>
        </div>
    </div>
    <table class="table table-hover table-responsive table-bordered table-striped">
        <thead>
        <tr class="table-info">
            <th>id</th>
            <th>Название категории</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Цена</th>
            <th>Картинка</th>
            <th>Статус</th>
            <th>Действие</th>
        </tr>
        </thead>
        <tbody>
        {foreach $rsProducts as $product}
            <tr>
                <td>{$product['id']}</td>
                <td>
                    <select name="parent_id" class="form-control">
                        <option value="0">Главная</option>
                        {foreach $rsCategories as $val}
                            <option {if $val['id'] == $product['category_id']}selected{/if}
                                    value="{$val['id']}">{$val['name']}</option>
                        {/foreach}
                    </select>
                </td>
                <td>{$product['name']}</td>
                <td>{$product['description']}</td>
                <td>{$product['price']}</td>
                <td>{$product['image']}</td>
                <td>{$product['status']}</td>
                <td>
                    <a href="#" class="btn btn-outline-warning">Редактировать</a>
                    <a href="#" class="btn btn-outline-danger">Удалить</a>
                </td>
            </tr>
        {/foreach}
        </tbody>
    </table>
</div>


