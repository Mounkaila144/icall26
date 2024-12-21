<li class="dropdown">
<a class="dropdown-toggle" data-toggle="dropdown" href="#">{__('Customers')}
         {if $item_0->hasChildren()}<span class="caret"></span>{/if}
</a>
 {if   $item_0->hasChildren()}
        <ul class="dropdown-menu">          
        {foreach $item_0->getChildren() as $item_1}
            {if $item_1->get('component')}
                {component name=$item_1->get('component')}                
            {/if}                
        {/foreach}
        </ul>
{/if}
</li>
