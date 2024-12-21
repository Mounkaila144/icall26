<table class="tab-dict">       
{foreach $variables->sort()->getVariables() as $name=>$value}
    {if $value@index % 2 ==0} <tr>{/if}
    <td class="variable"> 
            <div class="ModelVariables" name="{$name}">{$value}</div>    
    </td>
    {if $value@index % 2 ==2} </tr> {/if} 
 {/foreach} 
</table>
