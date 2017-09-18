{* Шаблон главной страницы *}
<main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
    <h1>{$pageTitle}</h1>
    <section class="row text-center placeholders">
        {foreach $products as $item}
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
                    {if $paginator['current_page'] != 1}
                    <li class="page-item">
                        <a class="page-link" href="/index/?page={$paginator['current_page'] - 1}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    {/if}
                    {for $i = 1; $i <= $paginator['pageCount']; $i++}
                        <li class="page-item {if $paginator['current_page'] == $i}active{/if}"><a class="page-link" href="/index/?page={$i}">{$i}</a></li>
                    {/for}
                    {if $paginator['current_page'] < $paginator['pageCount']}
                    <li class="page-item">
                        <a class="page-link" href="/index/?page={$paginator['current_page'] + 1}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                    {/if}
                </ul>
            </nav>
        </div>
    </section>
</main>


