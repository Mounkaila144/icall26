{messages class="customers-contract-sms-`$item->getCustomer()->get('id')`-errors"}
<h3>{__("New SMS")|capitalize}</h3>
<div>
        {if $item->getCustomer()->get('mobile')}
    <a href="#" class="btn" id="CustomerContractsSms-Send" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('send')}"/>{__('Send')}</a>   
    {/if}
</div>
{component name="/customers_communication_sms/newSms" customer=$item->getCustomer() key="`-customers-contract-sms-`$item->getCustomer()->get('id')`"}
<script type="text/javascript">
    
    $(".CustomerSms").click(function() {  $("#CustomerContractsSms-Send").show(); });

    $("#CustomerContractsSms-Send").click(function() {  
            
            var params= { CustomerSms: { customer_id: "{$item->getCustomer()->get('id')}",
                                           model_id: $("[name=model_id] option:selected").val(),
                                           token :'{mfForm::getToken('CustomerSmsSendForm')}' } };
             $("input.CustomerSms,textarea.CustomerSms").each(function() { params.CustomerSms[this.name]=$(this).val(); });
            // alert("Params="+params.products.toSource()); return false;           
            return $.ajax2({     
                data : params,
                url: "{url_to('customers_communication_sms_ajax',['action'=>'SendSms'])}",                
                errorTarget: ".customers-contract-sms-{$item->getCustomer()->get('id')}-errors",
                loading: "#tab-site-dashboard-site-customers-contract-loading",   
                success: function (resp)
                         {
                             if (resp.action=='SendSms')
                             {                                                                      
                                if (resp.errors)
                                {
                                   $.each(resp.errors,function(id,name){   $(".errors-form[name="+id+"]").html(name);  });     
                                }
                                else
                                {
                                    $("#CustomerContractsSms-Send").hide();
                                }
                             }    
                         }              
           });
    });
    
    
     $("#LoadModelSms").click(function() { 
            if ($("[name=model_id] option:selected").val()==0)
                return ;
            $(".errors-form").html("");
            return $.ajax2({     
                data : {        Contract : "{$item->get('id')}",
                                CustomerModelSmsI18n: $("[name=model_id] option:selected").val()  },
                url: "{url_to('customers_contracts_ajax',['action'=>'LoadSmsModelI18nContract'])}",
                errorTarget: ".customers-contract-sms-{$item->getCustomer()->get('id')}-errors",
                loading: "#tab-site-dashboard-site-customers-contract-loading",   
                success: function(resp)
                         {
                             if (resp.action=='LoadModelI18n')
                             {                                   
                                 $(".CustomerSms[name=message]").html(resp.model.message);
                             }
                         }
           });
    });

</script>    