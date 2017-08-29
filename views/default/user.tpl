{* Страница пользователя *}
<main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
    <h1>{$pageTitle}</h1>
    <form method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4" class="col-form-label">Email</label>
                <input disabled type="email" value="{$arrayUser['email']}" class="form-control" id="inputEmail4" placeholder="Email">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4" class="col-form-label">Password</label>
                <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
            </div>
        </div>
        <div class="form-group">
            <label for="inputName" class="col-form-label">Name</label>
            <input type="text" class="form-control" value="{$arrayUser['name']}" id="inputName" placeholder="Name">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputAdress" class="col-form-label">Adress</label>
                <input type="text" class="form-control" id="inputAdress" value="{$arrayUser['adress']}">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPhone" class="col-form-label">Phone</label>
                <input type="text" class="form-control" id="inputPhone" value="{$arrayUser['phone']}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Edit</button>
    </form>
</main>