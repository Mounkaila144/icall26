{messages class="multiple-attributions-errors"}
<fieldset>
    <h4>{__('Attributions')}</h4>
    <table> <tr>
            <td>
               
            </td>
            <td>
               
            </td>
            <td>
               {__('Attribution')}
            </td>
            <td>
                {__('Date')}
            </td>
        </tr>
    {foreach $attributions_form->getTypes()->getKeys() as $type}        
         {if $attributions_form->hasValidator($type)}
            <tr>
                <td>
                    {__("type_`$type`")}
                </td>
            </tr>
            <tr>  
                <td>
                    <input type="checkbox" class="CustomerContractMultipleAttributeActions" name="{$type}" {if $attributions_form->getActions()->in($type)}checked=""{/if}/>
                </td>            
                <td>           
                {if $type=='team'}
                    {html_options data=$type name="team_id" class="CustomerContractMultipleAttributeFilter" options=$attributions_form->getValidatorByType($type,'team_id')->getOption('choices') selected=$attributions_form[$type]['team_id']}                               
                {else}
                    {html_options data=$type name="user_id" class="CustomerContractMultipleAttributeFilter" options=$attributions_form->getValidatorByType($type,'user_id')->getOption('choices') selected=$attributions_form[$type]['user_id']}                               
                {/if}   
                </td>
                <td>            
                    {html_options data=$type name="attribution_id" class="CustomerContractMultipleAttributeFilter" options=$attributions_form->getValidatorByType($type,'attribution_id')->getOption('choices') selected=$attributions_form[$type]['attribution_id']}                            
                </td> 
                <td>
                    <input type="text" class="CustomerContractMultipleAttributeFilter Date" data="{$type}" name="payment_at" value="{if $attributions_form->hasErrors()}{$attributions_form[$type]['payment_at']}{else}{format_date($attributions_form[$type]['payment_at'],'a')}{/if}"/>
                </td>
            </tr>
        {/if}
    {/foreach}    
    </table>
    <a href="#" id="MutipleContractAttributionProcess" class="btn">{__('Process')}</a>  
</fieldset>

<script type="text/javascript">
     
     $(".CustomerContractMultipleAttributeFilter.Date").datepicker();
     
     $("#MutipleContractAttributionProcess").click(function() {            
        var params={ 
                MultipleContractSelection : {
                 actions: [],                                      
                 selection : {$attributions_form->getSelection()->toJson()},
                 count : '{$attributions_form->getSelection()->count()}',
                 token :'{$attributions_form->getCSRFToken()}'
                     }
        };             
        
       $(".CustomerContractMultipleAttributeActions:checked").each(function() { params.MultipleContractSelection.actions.push($(this).attr('name')); }); 
       
       $(".CustomerContractMultipleAttributeActions").each(function() {
             var type=  $(this).attr('name');           
             if (!params.MultipleContractSelection[type])
                params.MultipleContractSelection[type]= { };            
             $(".CustomerContractMultipleAttributeFilter[data="+type+"]").each(function () { 
                 params.MultipleContractSelection[type][$(this).attr('name')]=$(this).val();
             });
       });
      //   $(".dialogs").dialog('destroy').remove();
      //  alert("Params="+params.toSource());
           return $.ajax2({                   
                    data : params,
                    url: "{url_to('customers_contracts_ajax',['action'=>'MultipleProcessAttributionSelection'])}",
                    errorTarget: ".multiple-attributions-errors",
                    loading: "#tab-site-dashboard-customers-contract-loading",
                    target: "#AttributionsForMultiple-Ctn"
               });
        });
    
</script>    