{if $form}
    {foreach $form->getRegistrationValidators() as $name=>$validator}                                             
        <tr id="{$name}" class="registration">
            <td>
                 {if $validator->title}{__($validator->title)}{elseif $name=="commercial"}{__("commercial name")}{else}{__($name)}{/if}   
            </td>   
            <td>
                {if $name=='autoentreprise'}            
                        <input type="checkbox" name="autoentreprise"/>                                                                                                            
                {else}     
                        <div>{$form[$name]->getError()}</div>
                        <input type="text" class="company" name="{$name}" value=""/>   
                        {if $validator->getOption("required")}*{/if}
                {/if}           
            </td>
        </tr>             
    {/foreach}  
    <script type="text/javascript">
        $("[name=autoentreprise]").click(function() { 
           if ($(this).is(":checked"))
               $("#tva").hide();
           else
               $("#tva").show(); 
        });  
     </script>    
{/if}    