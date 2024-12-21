<div class="scrollDivDraggable">
<ul id="draggable">
    <table class="tableLi row m-0 p-0">
    {foreach $variables as $name=>$field}
        {if $field@index % 5==0}<tr>{/if}
            <td class="tdFields col-md-2">
               <li class="draggable ui-state-highlight" style="background-color:{__("category-`$name`",[],'categories')} !important"  >
                     <span><b class="searchable" title="{__("pre-`$name`",[],'fields')}">{__("pre-`$name`",[],'fields')}</b></span><br>
                   <span class="text-success-tab" >{$name}</span><br>
                   <span class="Format Fields text-danger-tab" name="{$name}" title="{$name}" >{__($name,[],'fields')}</span> 
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
