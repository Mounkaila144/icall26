 <li class="dropdown-submenu">
     <a href="javascript:void(0);" class="submenu" tabindex="-1">
         <span>{__('Contracts')}</span>
     </a>
      {if   $item_1->hasChildren()}
         
        <ul class="dropdown-menu">
        {foreach $item_1->getChildren() as $item_2}
            {if $item_2->get('component')}
                {component name=$item_2->get('component')}                
            {/if}                
        {/foreach}
        </ul>
    {/if}
 </li>
