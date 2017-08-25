{* Шаблон страницы product *}
<div class="col-sm-9 ml-sm-auto col-md-10 pt-3">
    <div class="row featurette">
        <div class="col-md-7 order-md-2">
            <h2 class="featurette-heading">{$rsProduct['name']}</h2>
            <p class="lead">{$rsProduct['description']}</p>
            <p class="lead">Цена: {$rsProduct['price']} руб</p>
            <p {if $itemInCart}style="display: none;" {/if} class="lead" id="item_cart_{$rsProduct['id']}"><a data-index="{$rsProduct['id']}" id="add_cart_link" href="#">Добавить в корзину</a></p>
            <p {if ! $itemInCart} style="display: none;" {/if} class="lead" id="remove_item_cart_{$rsProduct['id']}"><a data-index="{$rsProduct['id']}" id="remove_cart_link" href="#">Удалить из корзины</a></p>
        </div>
        <div class="col-md-5 order-md-1">
            <img class="featurette-image img-fluid mx-auto" alt="500x500" style="width: 500px; height: 500px;" src="{$templateWebPath}images/9.jpeg">
        </div>
    </div>
</div>
