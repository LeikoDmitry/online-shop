<div class="col-md-12">
    <h2>Обновление заказа</h2>
    <hr />
    <form method="post" action="/admin/updateorder/{$order['id']}/">
        <div class="form-group">
            <label for="status">Статус</label>
            <input name="status" class="form-control" id="status" placeholder="Статус" value="{$order['status']}">
        </div>
        <div class="form-group">
            <label for="date_created">Дата создания</label>
            <input name="date_created" class="form-control" id="date_created" placeholder="" value="{$order['date_created']}">
        </div>
        <div class="form-group">
            <label for="date_payment">Дата оплаты</label>
            <input name="date_payment" class="form-control" id="date_payment" placeholder="" value="{$order['date_payment']}">
        </div>
        <div class="form-group">
            <label for="date_modyfication">Дата изменения</label>
            <input name="date_modyfication" class="form-control" id="date_modyfication" placeholder="" value="{$order['date_modyfication']}">
        </div>
        <div class="form-group">
            <label for="comment">Доп. инфо</label>
            <textarea name="comment" class="form-control">{$order['comment']}</textarea>
        </div>
        <input type="hidden" name="id" value="{$order['id']}">
        <button type="submit" class="btn btn-primary">Изменить</button>
    </form>
</div>