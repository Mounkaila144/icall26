{messages class="site-customers-contract-zone-errors"}
<h3>{__('Contract zone')}</h3>    
<div>
    <a href="#" id="CustomerContractZone-Save" class="btn"><i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>
       {__('Save')}</a>    
    <a href="#" class="btn" id="CustomerContractZone-Cancel" title="{__('Cancel')}" ><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('Cancel')}"/>{__('Cancel')}</a>   
</div>
<table class="tab-form" cellpadding="0" cellspacing="0">
    
    <tr class="full-with">
        <td class="label"><span>{__("Name")}{if $form->name->getOption('required')}*{/if}</span></td>
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
        <td class="label"><span>{__("Postcodes")}{if $form->postcodes->getOption('required')}*{/if}</span></td>
        <td>
            <div>{$form.postcodes->getError()}</div>        
            <textarea class="CustomerContractZone Input" cols="30" name="postcodes" >{$item->get('postcodes')}</textarea>
{*            <input type="text" size="20" class="CustomerContractZone Input" name="postcodes" value="{$item->get('postcodes')}"/> *}
        </td>
    </tr>   
</table>  

<script type="text/javascript">
    
    $(".CustomerContractZone").change(function () { $("#CustomerContractZone-Save").show(); });

    $(".CustomerContractZone").click(function () { $("#CustomerContractZone-Save").show(); });


    {* =====================  A C T I O N S =============================== *}   
        
    $("#CustomerContractZone-Cancel").click( function () {                     
            return $.ajax2({                  
                url: "{url_to('customers_contracts_ajax',['action'=>'ListPartialZone'])}",
                errorTarget: ".site-customers-contract-zone-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });  
    });
    
     $("#CustomerContractZone-Save").click( function () {      
         var params ={ 
                         CustomerContractZone: {
                                   token: '{$form->getCSRFToken()}'
                         }
                       };
           $(".CustomerContractZone.Select option:selected").each(function () { params.CustomerContractZone[$(this).parent().attr('name')]=$(this).val(); });
           $(".CustomerContractZone.Input").each(function () { params.CustomerContractZone[$(this).attr('name')]=$(this).val(); });
            return $.ajax2({   
                data : params,
                url: "{url_to('customers_contracts_ajax',['action'=>'NewZone'])}",
                errorTarget: ".site-customers-contract-zone-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });  
    });
</script>  
