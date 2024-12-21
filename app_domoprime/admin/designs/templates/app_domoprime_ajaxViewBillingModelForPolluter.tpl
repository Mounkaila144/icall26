{messages class="site-errors"}
<h3>{__("View model for billing")}</h3>
{if $polluter->isLoaded()}
<div>
    <a href="#" class="btn" id="PolluterModelBilling-Save"><i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="#" class="btn" id="PolluterModelBilling-Cancel"><i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>
<table class="tab-form">   
    <tr class="full-with">
         <td class="label"><span>{__("Model")}</span></td>
         <td>
            <div id="PolluterModel-error_value" class="error-form">{$form.model_id->getError()}</div>
            {html_options class="PolluterModelBilling Select" name="model_id" options=$form->model_id->getOption('choices') selected=$item->get('model_id')}    
            {if $form->model_id->getOption('required')}*{/if} 
         </td>
    </tr>  
</table>   
<script type="text/javascript">
     
    
     {* =================== A C T I O N S ================================ *}
     $('#PolluterModelBilling-Cancel').click(function(){              
             return $.ajax2({ url : "{url_to('app_domoprime_ajax',['action'=>'ListPartialPollutingCompany'])}",
                              errorTarget: ".site-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions"}); 
      });
      
      
    $('#PolluterModelBilling-Save').click(function(){   
           var params = {   Polluter: '{$polluter->get('id')}',
                            BillingModelForPolluter: {
                                 model_id: $(".PolluterModelBilling.Select[name=model_id]").val(),
                                 token :'{$form->getCSRFToken()}'
                            }    
                        };
             return $.ajax2({ data:  params,
                              url : "{url_to('app_domoprime_ajax',['action'=>'SaveBillingModelForPolluter'])}",
                              errorTarget: ".site-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions"}); 
      });
      
</script>
{else}
    {__('Polluter is invalid.')}
{/if}    
