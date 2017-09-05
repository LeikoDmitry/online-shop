<div class="col-md-12">
    <h2>Добавление категории</h2>
    <form method="post">
        <div class="form-group">
            <label for="inputNameCategory" class="col-sm-2 col-form-label">Название категории</label>
            <div class="col-sm-10">
                <input class="form-control" id="inputNameCategory" placeholder="Категория">
            </div>
        </div>
        <div class="form-group">
            <label for="select_category" class="col-sm-3 col-form-label">Выбрать категорию родителя</label>
            <div class="col-sm-10">
                <select class="form-control" id="select_category" name="id_category">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
        </div>
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Добавить категорию</button>
        </div>
    </form>
</div>
