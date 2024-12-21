{messages class="site-errors"}
<h3>{__("Multiple Cumac process")}</h3>
{if $form}
<div>    
    {format_number_choice('[0] no selected element|[1]one selected element|(1,Inf]%s selected elements',$form->getSelectionCount(),$form->getSelectionCount())} 
</div>


{/if}
