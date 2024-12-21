{messages class="site-customers-contract-zone-errors"}
<h3>{__("Contract zone")}</h3>
<div>
    <a href="#" class="btn" id="CustomerContractsZone-{$item->get('id')}-Save" style="display:none">
        <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>
        {*<img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>*}{__('save')}</a>
    <a href="#" class="btn" id="CustomerContractsZone-{$item->get('id')}-Cancel">
         <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>
         {*<img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>*}{__('cancel')}</a>   
</div>
{if $item->isLoaded()}
 <table class="tab-form" cellpadding="0" cellspacing="0">
    
     <tr class="full-with">
        <td class=" label"><span>{__("Name")}{if $form->name->getOption('required')}*{/if}</span></td>
        <td>
            <div>{$form.name->getError()}</div>               
            <input type="text" size="20" class="CustomerContractZone Input" name="name" value="{$item->get('name')}"/> 
        </td>
    </tr> 
    <tr class="full-with">
        <td class=" label"><span>{__("Max contracts by zone")}{if $form->max_contracts->getOption('required')}*{/if}</span></td>
        <td>
            <div>{$form.max_contracts->getError()}</div>               
            <input type="text" size="20" class="CustomerContractZone Input" name="max_contracts" value="{$item->get('max_contracts')}"/> 
        </td>
    </tr> 
    <tr class="full-with">
        <td class="label "><span>{__("Postcodes")}{if $form->postcodes->getOption('required')}*{/if}</span></td>
        <td>
            <div>{$form.postcodes->getError()}</div>      
            <textarea class="CustomerContractZone Input" cols="30" name="postcodes" >{$item->get('postcodes')}</textarea>
{*            <input type="text" size="20" class="CustomerContractZone Input" name="postcodes" value="{$item->get('postcodes')}"/> *}
        </td>
    </tr>   
</table>  
{else}      
    <span>{__('Zone is invalid.')}</span> 
{/if}    

  <script type="text/javascript">
       
        $(".CustomerContractZone.Input").click(function() { $("#CustomerContractsZone-{$item->get('id')}-Save").show(); });
    
        $(".CustomerContractZone.Input").change(function() { $("#CustomerContractsZone-{$item->get('id')}-Save").show(); });
    
        $("#CustomerContractsZone-{$item->get('id')}-Save").click( function () {
            var params= { CustomerContractZone: { id: "{$item->get('id')}",                                          
                                            token :'{$form->getCSRFToken()}' },
                          };
             $(".CustomerContractZone.Input").each(function() { params.CustomerContractZone[this.name]=$(this).val(); });
             $(".CustomerContractZone.Select option:selected").each(function() {  params.CustomerContractZone[$(this).parent().attr('name')]=$(this).val();  }); 
            // alert("Params="+params.products.toSource()); return false;           
            return $.ajax2({     
                data : params,
                url: "{url_to('customers_contracts_ajax',['action'=>'SaveZone'])}",
                                errorTarget: ".site-customers-contract-zone-errors",
                                loading: "#tab-site-dashboard-x-settings-loading",                         
                                target: "#actions"
           });
       });
       
       $("#CustomerContractsZone-{$item->get('id')}-Cancel").click( function () {
            return $.ajax2({    
                url: "{url_to('customers_contracts_ajax',['action'=>'ListPartialZone'])}",
                                errorTarget: ".site-customers-contract-zone-errors",
                                loading: "#tab-site-dashboard-x-settings-loading",                       
                                target: "#actions"
           });
       });
        
</script>
