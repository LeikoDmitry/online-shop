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
        <div class="col-12 col-md-12">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>
</main>
<div class="col-sm-6 ml-sm-auto col-md-10 pt-3">
    <ul class="list-group">
        {foreach $rsChildCats as $child}
            <li class="list-group-item"><a href="/category/{$child['id']}/">{$child['name']}</a></li>
        {/foreach}
    </ul>
</div>