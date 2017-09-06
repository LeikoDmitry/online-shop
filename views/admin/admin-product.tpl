<div class="col-md-12">
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h2>{$pageTitle}</h2>
            <hr />
            <h3>Добавление товара</h3>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="name_new" class="col-sm-1 col-form-label">Нзвание</label>
                    <div class="col-sm-11">
                        <input name="name" type="text" class="form-control" id="name_new" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="desc_new" class="col-sm-1 col-form-label">Описание</label>
                    <div class="col-sm-11">
                        <textarea name="description" id="desc_new" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="cat_new" class="col-sm-1 col-form-label">Категория</label>
                    <div class="col-sm-11">
                        <select name="category_id" id="cat_new" class="form-control">
                            {foreach $rsCategories as $val}
                                <option value="{$val['id']}">{$val['name']}</option>
                            {/foreach}
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="price_new" class="col-sm-1 col-form-label">Цена</label>
                    <div class="col-sm-11">
                        <input name="price" type="text" class="form-control" id="price_new" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="image_new" class="col-sm-1 col-form-label">Загрузить</label>
                    <div class="col-md-11">
                        <label class="custom-file">
                            <input name="image" type="file" id="image" class="custom-file-input">
                            <span class="custom-file-control">Файл</span>
                        </label>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-sm-1 col-form-label">Статус</label>
                    <div class="col-sm-11">
                        <input name="status" type="text" class="form-control" id="status_new" />
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Добавить новый</button>
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


