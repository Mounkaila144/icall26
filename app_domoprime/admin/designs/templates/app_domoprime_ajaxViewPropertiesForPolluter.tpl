{messages class="site-errors"}
{if $polluter->isLoaded()}
<h3>{__('View properties for [%s]',$polluter->get('name'))}</h3>    
<div>     
       <a href="#" class="btn" style="display:none" id="DomoprimePolluterProperty-Save" title="{__('Save')}" >
      <i class="fa fa-plus" style="margin-right:10px;"></i>
      {__('Save')}</a>  
      <a href="#" class="btn" id="DomoprimePolluterProperty-Cancel" title="{__('Cancel')}" >
      <i class="fa fa-times" style="margin-right:10px;"></i>
      {__('Cancel')}</a>      
</div>
<table class="tab-form" cellpadding="0" cellspacing="0">  
     <tr class="full-with">
        <td class="label"><span>{__("Boiler Prime")}</span></td>
        <td>
            <div class="error-form">{$form.prime->getError()}</div>               
             <input type="text" size="20" class="DomoprimePolluterProperty Input" name="prime" value="{$item->getPrime()->getAmount()}"/> 
        </td>
    </tr>
      <tr class="full-with">
        <td class="label"><span>{__("Pack Prime")}</span></td>
        <td>
            <div class="error-form">{$form.pack_prime->getError()}</div>               
             <input type="text" size="20" class="DomoprimePolluterProperty Input" name="pack_prime" value="{$item->getPackPrime()->getAmount()}"/> 
        </td>
    </tr>
</table>  
<script type="text/javascript">
    
          $(".DomoprimePolluterProperty").click(function () { $("#DomoprimePolluterProperty-Save").show(); });
  
          $("#DomoprimePolluterProperty-Cancel").click( function () {             
            return $.ajax2({                 
                url: "{url_to('app_domoprime_ajax',['action'=>'ListPartialPollutingCompany'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         });
         
           $("#DomoprimePolluterProperty-Save").click( function () {             
            var params = {  Polluter :'{$polluter->get('id')}',
                            PolluterProperty : { token : '{$form->getCSRFToken()}' }
                        };
            $(".DomoprimePolluterProperty.Input").each(function () { params.PolluterProperty[$(this).attr('name')]=$(this).val(); });
            return $.ajax2({        
                data : params,
                url: "{url_to('app_domoprime_ajax',['action'=>'SavePropertiesForPolluter'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         });
         
          
</script>    

{else}
    {__('Polluter is invalid.')}
{/if}  

