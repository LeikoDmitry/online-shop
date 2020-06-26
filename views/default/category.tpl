{* Шаблон категорий *}
<main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
    <h1>{$pageTitle}</h1>
    <section class="row text-center placeholders">
        {foreach $rsProducts as $item}
            <div class="col-6 col-sm-4 placeholder">
                <a href="/product/{$item['id']}/">
                    {if ! $item['image'] }
                        <img src="{$templateWebUploadPath}default.jpg" width="200" height="200" class="img-fluid" alt="Generic placeholder thumbnail">
                    {else}
                        <img src="{$templateWebUploadPath}{$item['image']}" width="200" height="200" class="img-fluid" alt="Generic placeholder thumbnail">
                    {/if}
                </a>
                <h4>{$item['price']}</h4>
                <div class="text-muted"><a href="/product/{$item['id']}/">{$item['name']}</a></div>
            </div>
        {/foreach}
    </section>
</main>
<div class="col-sm-6 ml-sm-auto col-md-10 pt-3">
    <ul class="list-group">
        {foreach $rsChildCats as $child}
            <li class="list-group-item"><a href="/category/{$child['id']}/">{$child['name']}</a></li>
        {/foreach}
    </ul>
</div>