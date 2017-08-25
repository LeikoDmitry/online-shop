{* Шаблон категорий *}
<main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
    <h1>{$pageTitle}</h1>
    <section class="row text-center placeholders">
        {foreach $rsProducts as $item}
            <div class="col-6 col-sm-4 placeholder">
                <a href="/product/{$item['id']}/"><img src="{$templateWebPath}images/1.jpg" width="200" height="200" class="img-fluid" alt="Generic placeholder thumbnail"></a>
                <h4>{$item['price']}</h4>
                <div class="text-muted"><a href="/product/{$item['id']}/">{$item['name']}</a></div>
            </div>
        {/foreach}
    </section>
    <section class="row">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Previous</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </section>
</main>
<div class="col-sm-6 ml-sm-auto col-md-10 pt-3">
    <ul class="list-group">
        {foreach $rsChildCats as $child}
            <li class="list-group-item"><a href="/category/{$child['id']}/">{$child['name']}</a></li>
        {/foreach}
    </ul>
</div>