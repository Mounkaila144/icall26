<li class="dashboard_menu_level0">
    <div > 
        <a href="{$item_0->getRouteAjax()}" name="" class="items">
            <img height="32px" width="32px" src='{url('/icons/tools_permissons32x32.png',"picture")}' alt='{__('Tools Permissions')}'/>   
            <div class="dashboard_menu_item_text">{$item_0->get('title')}</div>
        </a>   
    </div>
    <span style="display:none;" id="item-menu-{$item_0@index}">{__($item_0.help)}</span>
</li>

