<div class="scrollDivDraggable">
<ul id="draggable">
    <table class="tableLi">
    {foreach $variables as $name=>$field}
        {if $field@index % 5==0}<tr>{/if}
            <td class="tdFields">
                <li class="draggable ui-state-highlight">
                    <span class="Format Fields " name="{$name}">{$field}</span>
                    <input type="text" class="editInput" style="display:none;" />
                    <i class="fa fa-pencil displayNoneIcon editIcon" aria-hidden="true" style="cursor: pointer;"></i>
                    <i class="fa fa-trash displayNoneIcon deleteIcon" aria-hidden="true" style="cursor: pointer;"></i>                       
                </li> 
            </td>
        {if $field@index % 5==5}</tr>{/if}
    {/foreach} 
    </table>
</ul>
</div>          

