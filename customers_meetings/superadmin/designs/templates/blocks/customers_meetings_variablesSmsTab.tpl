<table class="tab-dict">       
{foreach $variables->sort()->getVariables() as $name=>$value}
    {if $value@index % 2 ==0} <tr>{/if}
    <td class="variable"> 
            <span class="{$site->getSiteID()}-ModelVariables" name='{$name}'>{$value}</span>    
    </td>
    {if $value@index % 2 ==2} </tr> {/if} 
 {/foreach} 
</table>