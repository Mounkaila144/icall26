{foreach $tabs as $name=>$tab} 
<li>  
    {if $tab.component}
    <a href="#tab-customer-meetings-{$name}-{$key}" title="{__($tab.title)}" class="tabs-sites">
      {*   <img height="32" width="32" src="{url($tab.picture,'web')}" alt="{__($tab.title)|capitalize}"/>                 *}
         <span>{__($tab.title)|capitalize}</span>    
    </a>            
    {else}
   {* <a href="{url_to($tab.actions.view.name,$tab.actions.view.parameters)}" title="{__($tab.title)}" name="tab{$name|capitalize}" class="items_view">
         <img height="32" width="32" src="{url($tab.picture,'web')}" alt="{__($tab.title)|capitalize}"/>                  
         <span>{__($tab.title)|capitalize}</span>          
    </a>    *}       
    {/if}
    <span style="display:none;" id="item-tab-{$name|capitalize}">{__($tab.help)|default:'&nbsp;'}</span>    
</li>
{/foreach}  

