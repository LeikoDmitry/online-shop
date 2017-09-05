<div class="col-md-12">
    <h2>Добавление категории</h2>
    <form method="post">
        <div class="form-group">
            <label for="inputNameCategory" class="col-sm-2 col-form-label">Название категории</label>
            <div class="col-sm-10">
                <input name="name" class="form-control" id="inputNameCategory" placeholder="Название категории">
            </div>
        </div>
        <div class="form-group">
            <label for="select_category" class="col-sm-3 col-form-label">Выбрать категорию родителя</label>
            <div class="col-sm-10">
                <select class="form-control" id="select_category" name="parent_id">
                    <option value="0">Главная</option>
                    {foreach $rsCategories as $category}
                        <option value="{$category['id']}">{$category['name']}</option>
                        {if isset($category['children'])}
                            {foreach $category['children'] as $child}
                                <option value="{$child['id']}">{$child['name']}</option>
                            {/foreach}
                        {/if}
                    {/foreach}
                </select>
            </div>
        </div>
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Добавить категорию</button>
        </div>
    </form>
</div>
