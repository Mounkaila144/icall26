{component name="/site/sublink"}
{messages class="Domoprime-errors"}
<h3>{__("System Settings")}</h3>
<div>  
     <a href="#" id="Domoprime-Cancel" class="btn">
         <i class="fa fa-times" style=" margin-right: 10px"></i>{__('Cancel')}</a>     
</div>

<fieldset>    
<table>
    <tr>
        <td>{__('Actions')}</td>
        <td>{__('Parameters')}</td>
        <td></td>
    </tr>
     {if $form->hasActionInValidator('contract_forms')}
    <tr>
        <td>
            <input type="checkbox" class="SystemSettingsActions" name="contract_forms" value="" {if $form->hasAction('contract_forms')}checked=""{/if}/>
        </td>
        <td>
            {__('Contract affectation missing')}
        </td>
        <td>        
           ({$form->getNumberOfContractNotAffected()})
        </td>    
    </tr>
    {/if}
     {if $form->hasActionInValidator('calculation_double')}
    <tr>
        <td>
            <input type="checkbox" class="SystemSettingsActions" name="calculation_double" value="" {if $form->hasAction('calculation_double')}checked=""{/if}/>
        </td>
        <td>
             {__('Calculation double')}
        </td>
        <td>        
           ({$form->getNumberOfDoubleCalculation()})
        </td>    
    </tr>
    {/if}
    {if $form->hasActionInValidator('quotation_double')}
    <tr>
        <td>
            <input type="checkbox" class="SystemSettingsActions" name="quotation_double" value="" {if $form->hasAction('quotation_double')}checked=""{/if}/>
        </td>
        <td>
             {__('Quotation double')}
        </td>
        <td>        
           ({$form->getNumberOfDoubleQuotation()})
        </td>    
    </tr>
    {/if}
     {if $form->hasActionInValidator('forms_double')}
    <tr>
        <td>
            <input type="checkbox" class="SystemSettingsActions" name="forms_double" value="" {if $form->hasAction('forms_double')}checked=""{/if}/>
        </td>
        <td>
             {__('Form double')}
        </td>
        <td>        
           ({$form->getNumberOfDoubleForm()})
        </td>    
    </tr>
    {/if}
      {if $form->hasActionInValidator('yousign_meeting_document')}
    <tr>
        <td>
            <input type="checkbox" class="SystemSettingsActions" name="yousign_meeting_document" value="" {if $form->hasAction('yousign_meeting_document')}checked=""{/if}/>
        </td>
        <td>
             {__('Yousign document unicity')}
        </td>
        <td>        
           ({$form->getNumberOfDoubleDocument()})
        </td>    
    </tr>
    {/if}
</table>   
<a href="#" id="Process" class="btn">{__('Process')}</a>  
</fieldset>   

<script type="text/javascript">        
          
           $("#Process").click(function() { 
           var params={ 
                   SystemSettings : {
                    actions: [],                    
                    token :'{$form->getCSRFToken()}'
                        }
           };
           $(".SystemSettingsActions:checked").each(function() { params.SystemSettings.actions.push($(this).attr('name')); });           
   //        alert("Params="+params.toSource());
           return $.ajax2({                   
                    data : params,
                    url: "{url_to('app_domoprime_ajax',['action'=>'System'])}",
                    errorTarget: ".Domoprime-errors",
                    loading: "#tab-site-dashboard-x-settings-loading",
                           target: "#tab-dashboard-x-settings"
               });
        });
        
         $('#Domoprime-Cancel').click(function(){                           
             return $.ajax2({ errorTarget: ".Domoprime-errors",
                           url: "{url_to('app_domoprime_ajax',['action'=>'Settings'])}",
                           loading: "#tab-site-dashboard-x-settings-loading",
                           target: "#tab-dashboard-x-settings"}); 
         });

     
</script>
