{messages class="site-errors"}
<h3>{__("View recipient for polluter [%s]",$polluter->get('name'))}</h3>
{if $polluter->isLoaded()}
<div>
    <a href="#" class="btn" id="PolluterRecipient-Save"><i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="#" class="btn" id="PolluterRecipient-Cancel"><i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>
<table class="tab-form">   
      <tr class="full-with">
           <td class="label"><span>{__("Recipient")}</span></td>
         <td>
            <div id="error_pages" class="error-form">{$form.recipient_id->getError()}</div>
            {html_options class="PolluterRecipient Select" options=$form->recipient_id->getOption('choices') name="recipient_id" selected=$item->get('recipient_id')}             
         </td>
    </tr>  
</table>   
<script type="text/javascript">
     
    
     {* =================== A C T I O N S ================================ *}
     $('#PolluterRecipient-Cancel').click(function(){              
             return $.ajax2({ url : "{url_to('app_domoprime_ajax',['action'=>'ListPartialPollutingCompany'])}",
                              errorTarget: ".site-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions"}); 
      });
      
      
    $('#PolluterRecipient-Save').click(function(){   
           var params = {   Polluter: '{$polluter->get('id')}',
                            RecipientForPolluter: {
                                 recipient_id: $(".PolluterRecipient.Select[name=recipient_id]").val(),
                                 token :'{$form->getCSRFToken()}'
                            }    
                        };
             return $.ajax2({ data:  params,
                              url : "{url_to('app_domoprime_ajax',['action'=>'SaveRecipientForPolluter'])}",
                              errorTarget: ".site-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions"}); 
      });
      
</script>
{else}
    {__('Polluter is invalid.')}
{/if} 
