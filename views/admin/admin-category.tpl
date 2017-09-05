<div class="col-md-12">
    <h2>{$pageTitle}</h2>
    <table class="table table-responsive table-bordered">
        <thead>
        <tr>
            <th>id</th>
            <th>Название</th>
            <th>Родительская категория</th>
            <th>Действие</th>
        </tr>
        </thead>
        <tbody>
        {foreach $rsMainCategories as $item}
            <tr>
                <td>{$item['id']}</td>
                <form method="post">
                <td><input class="form-control" name="name" value="{$item['name']}"/></td>
                <td>
                    <select name="parent_id" class="form-control">
                        <option value="0">Главная</option>
                        {foreach $rsMainCategories as $val}
                            <option {if $item['parent_id'] == $val['id']}selected{/if}  value="{$val['id']}">{$val['name']}</option>
                        {/foreach}
                    </select>
                </td>
                <td>
                    <button type="submit" class="btn btn-success">Изменить</button>
                </td>
                    <input type="hidden" value="{$item['id']}" name="id">
                </form>
            </tr>
        {/foreach}
        </tbody>
    </table>
</div>