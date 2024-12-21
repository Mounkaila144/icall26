<div id="billings-target-{$contract->get('id')}">
{messages class="customers-contract-app-domoprime-billing-contract-errors"}
{if $contract->isLoaded()}
<div>
  {if $last_billing && $last_billing->isLoaded()}    
      <span id="DomoprimeBillingForViewContract-Ctn">
       <a href="{url_to('app_domoprime',['action'=>'ExportBillingPdf'])}?{__('Billing')}={$last_billing->get('id')}" target="_blank" title="{__('Export PDF')}" class="DomoprimeBillingForViewContract-ExportPdf">
        <i class="fa fa-file-pdf-o" style="font-size: 16px;"></i>
        <span>{__('Billing')} {$last_billing->get('reference')} {$last_billing->getFormatter()->getDatedAt()->getFormatted()}</span>
       </a>   
      </span>
       {if $user->hasCredential([['superadmin','admin','app_domoprime_contrat_billing_list_send_email']])}
        <a href="javascript:void(0);"  title="{__('Send by email to customer')}" id="{$last_billing->get('id')}" class="DomoprimeBillingForViewContract-SendEmail">
               <i class="fa fa-envelope"></i></a> 
       {/if}   
  {else}
      
      <span id="DomoprimeBillingForViewContract-Ctn">
          {__('No billing')}
      </span> 
      {if $user->hasCredential([['superadmin','admin','app_domoprime_contrat_billing_list_send_email']])}
      <a href="javascript:void(0);"  title="{__('Send by email to customer')}" style="display:none" name="DomoprimeBillingForViewContract-SendEmail" class="DomoprimeBillingForViewContract-SendEmail">
               <i class="fa fa-envelope"></i></a> 
      {/if} 
  {/if}          
  <a href="javascript:void(0);" title="{__('Details')}" {if !$last_billing || !$last_billing->isLoaded()}style="display:none;"{/if} class="Hide" id="DomoprimeBillingForViewContract-Details">
                     <i class="fa fa-search" style="font-size: 16px;"></i></a>  
</div>


     <script type="text/javascript">
              
           
      $("#DomoprimeBillingForViewContract-Details").click(function () {           
         return $.ajax2({                     
                                data : { Contract: '{$contract->get('id')}' },
                                url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialBillingForViewContract'])}" , 
                                errorTarget: ".customers-contract-app-domoprime-billing-contract-errors",    
                                loading: "#tab-site-dashboard-customers-contract-loading",
                                target: "#billings-target-{$contract->get('id')}" 
                             }); 
      });
      
      
        $(".DomoprimeBillingForViewContract-SendEmail").click(function () { 
               return $.ajax2({ data : { Billing: $(this).attr('id') },                                              
                                url:"{url_to('app_domoprime_ajax',['action'=>'SendEmailBilling'])}" , 
                                errorTarget: ".customers-contract-app-domoprime-billing-contract-errors",    
                                loading: "#tab-site-dashboard-customers-contract-loading",
                                success : function (resp)
                                        {
                                        }
                             }); 
           });
    </script>  
    
{else}
    {__('Contract is invalid.')}
{/if}    
 


</div>

