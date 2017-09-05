<nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
    <ul class="nav nav-pills flex-column">
        {foreach $categories as $category}
            <li class="nav-item">
                <a class="nav-link" href="/category/{$category['id']}/">{$category['name']}</a>
            </li>
            {if is_array($category['children'])}
                {foreach $category['children'] as $child}
                    <a class="nav-link" href="/category/{$child['id']}/">---{$child['name']}</a>
                {/foreach}
            {/if}
        {/foreach}
    </ul>
</nav>

