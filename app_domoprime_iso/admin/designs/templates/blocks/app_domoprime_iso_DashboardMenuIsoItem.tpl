<li>                                    
    <div class="menu-site-dashboard-item">
         <a href="#" id="{$item_0@index}_{$item@index}" class="menu-site-dashboard-items" name="{$item->getRouteAjax()}">
           {if $item.picture}<img height="32px" width="32px" style="margin : 0 auto; display : block;" src='{url($item.picture,"web","admin",$site)}' alt='{__($item.title)}'/>{/if}                                         
            <div class="menu-site-dashboard-text">{__($item.title)}</div>                                             
        </a>
        <span style="display:none;" id="{$item_0@index}_{$item@index}">{__($item.help)|default:'&nbsp;'}</span>
    </div>
 </li>
