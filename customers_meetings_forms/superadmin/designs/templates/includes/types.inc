'<div id="#0#">'+
    {foreach $form->fields[0]['type']->getOption('choices') as $type}       
             '<input type="radio" class="Survey-Types" name="type-#0#" {if $type==$choice}checked=""{/if} id="{$type}">{__($type)}'+
    {/foreach}    
'</div>'