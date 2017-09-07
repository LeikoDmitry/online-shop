<div class="col-md-10">
    <h2>{$pageTitle}</h2>
    <hr />
    <form method="post">
        <div class="form-group row">
            <label for="name_new" class="col-sm-1 col-form-label">Нзвание</label>
            <div class="col-sm-11">
                <input value="{$product['name']}" name="name" type="text" class="form-control" id="name_new" />
            </div>
        </div>
        <div class="form-group row">
            <label for="desc_new" class="col-sm-1 col-form-label">Описание</label>
            <div class="col-sm-11">
                <textarea name="description" id="desc_new" class="form-control">
                    {$product['description']}
                </textarea>
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
                <input value="{$product['price']}" name="price" type="text" class="form-control" id="price_new" />
            </div>
        </div>
        <div class="form-group row">
            <label for="image_new" class="col-sm-1 col-form-label">Image</label>
            <div class="col-sm-11">
                <input value="{$product['image']}" name="image" type="text" class="form-control" id="image_new" />
            </div>
        </div>
        <div class="form-group row">
            <label for="status" class="col-sm-1 col-form-label">Статус</label>
            <div class="col-sm-11">
                <input value="{$product['status']}" name="status" type="text" class="form-control" id="status_new" />
            </div>
        </div>
        <input hidden name="id" value="{$product['id']}" />
        <button type="submit" class="btn btn-primary">Изменить</button>
    </form>
</div>