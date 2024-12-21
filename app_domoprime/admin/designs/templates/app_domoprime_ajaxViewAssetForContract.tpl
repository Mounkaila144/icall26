{messages class="customers-contract-app-domoprime-asset-contract-errors"}
{if $contract->isLoaded()}
    {$contract->getCustomer()|upper}   
    {if $item->isLoaded()}
    <div>
       <a href="#" id="DomoprimeAssetForContract-Save" class="btn" style="display:none">
            <i class="fa fa-floppy-o" style="color:#000; margin-right:5px;"></i>{__('Save')}</a>
        <a href="#" id="DomoprimeAssetForContract-Cancel" class="btn">
            <i class="fa fa-times" style="color:#000;margin-right:5px;"></i>{__('Cancel')}</a>
    </div>
    <table> 
         <tr class="DomoprimeAssetForContract"> 
            <td>
                <div>{$form.dated_at->getError()}</div>
                <div>
                {__('Date')}
                <input type="text" class="DomoprimeAssetForContract Fields Date Input" name="dated_at" value="{if $form->hasErrors()}{$form.dated_at}{else}{$item->getFormatter()->getDatedAt()->getFormatted()}{/if}"/>
                </div>
            </td>
        </tr>  
         <tr class="DomoprimeAssetForContract"> 
            <td>
                <div>{$form.total_asset_with_tax->getError()}</div>
                <div>
                {__('Amount')}
                <input type="text" class="DomoprimeAssetForContract Fields Input" name="total_asset_with_tax" value="{if $form->hasErrors()}{$form.total_asset_with_tax}{else}{$item->getFormattedTotalWithTax()}{/if}"/>
                </div>
            </td>
        </tr> 
          <tr class="DomoprimeAssetForContract"> 
            <td>
                <div>{$form.comments->getError()}</div>
                <div>
                {__('Comment')}
                <textarea rows="4" cols="80" class="DomoprimeAssetForContract Fields Input" name="comments">{$item->get('comments')|escape}</textarea>
                </div>
            </td>
        </tr> 
    </table>
    <script type="text/javascript">

       $(".DomoprimeAssetForContract.Date").datepicker();

              $(".DomoprimeAssetForContract.Fields").click(function () {   $("#DomoprimeAssetForContract-Save").show();   });

              {* =====================  P A G E R  A C T I O N S =============================== *}  

               $("#DomoprimeAssetForContract-Cancel").click(function() {                  
                   return $.ajax2({                     
                                data : { Contract: '{$contract->get('id')}' },
                                url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialAssetForContract'])}" , 
                                errorTarget: ".customers-contract-app-domoprime-asset-contract-errors",    
                                loading: "#tab-site-dashboard-customers-contract-loading",
                                target: "#tab-customer-contracts-assets-{$contract->get('id')}" 
                             }); 
               });


              {* =====================  A C T I O N S =============================== *}  

           $('#DomoprimeAssetForContract-Save').click(function(){                             
                var  params= {      Contract: '{$contract->get('id')}',       
                                    DomoprimeAsset: {  
                                       id: '{$item->get('id')}',
                                       token :'{$form->getCSRFToken()}'
                                    } };
             $(".DomoprimeAssetForContract.Input").each(function () { params.DomoprimeAsset[$(this).attr('name')]=$(this).val(); });                                                                          
              //alert("Params="+params.toSource());   return ;        
              return $.ajax2({ data : params,                          
                               url: "{url_to('app_domoprime_ajax',['action'=>'SaveAssetForContract'])}",
                                loading: "#tab-site-dashboard-customers-contract-loading",
                               errorTarget: ".customers-contract-app-domoprime-asset-contract-errors",
                               target: "#tab-customer-contracts-assets-{$contract->get('id')}" }); 
            }); 

    </script>   
    {else}
        {__('Asset is invalid.')}
    {/if}
{else}
    {__('Contract is invalid.')}        
{/if}    


