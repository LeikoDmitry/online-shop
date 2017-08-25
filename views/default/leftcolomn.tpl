<nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
    <ul class="nav nav-pills flex-column">
        {foreach $categories as $category}
            <li class="nav-item">
                <a class="nav-link" href="/category/{$category['id']}/">{$category['name']}</a>
            </li>
            {if isset($category['children'])}
                {foreach $category['children'] as $child}
                    <li class="nav-item">
                        <a class="nav-link" href="/category/{$child['id']}/">---{$child['name']}</a>
                    </li>
                {/foreach}
            {/if}
        {/foreach}
    </ul>
    <div class="card border-primary mb-3" style="max-width: 20rem;">
        <div class="card-header">Корзина</div>
        <div class="card-body text-primary">
            <h4 class="card-title">{if $cartCounts > 0} {$cartCounts} {else} Пусто {/if}</h4>
            <p class="card-text"><a href="/cart/">Перейти в корзину</a></p>
        </div>
    </div>
</nav>
