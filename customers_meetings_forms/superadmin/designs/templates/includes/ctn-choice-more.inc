'<tr id="#0#" class="Survey-Choices  Survey-Choices-item full-with">'+
    '<td>'+         
    {foreach $form->getWidgetForChoices() as $choice}
        '<label>{__($choice)}</label><input class="Survey-Choices-Type" type="radio" class="" id="#0#" name="choice-#0#" value="{$choice}"/>'+
    {/foreach}    
    '</td>'+   
'</tr>'+
{include file="./includes/ctn-choice-item.inc"}    
       
