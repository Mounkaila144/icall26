{messages class="`$site->getSiteID()`-customers-contract-email-`$item->getCustomer()->get('id')`-errors"}
<h3>{__("New email")|capitalize}</h3>
<div>
    {if $item->getCustomer()->get('email')}
    <a href="#" class="btn" id="{$site->getSiteID()}-CustomerContractsEmail-Send" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('send')}"/>{__('Send')}</a>   
    {/if}
</div>   
{component name="/customers_communication_emails/newEmail" customer=$item->getCustomer() key="`$site->getSiteID()`-customers-contract-email-`$item->getCustomer()->get('id')`"}
<script type="text/javascript">
    
    $(".CustomerEmail").click(function() {  $("#{$site->getSiteID()}-CustomerContractsEmail-Send").show(); });

    $("#{$site->getSiteID()}-CustomerContractsEmail-Send").click(function() {  
            
            var params= { CustomerEmail: { customer_id: "{$item->getCustomer()->get('id')}",   
                                           model_id: $("[name=model_id] option:selected").val(),
                                           token :'{mfForm::getToken('CustomerEmailSendForm')}' } };
             $("input.CustomerEmail,textarea.CustomerEmail").each(function() { params.CustomerEmail[this.name]=$(this).val(); });
            // alert("Params="+params.products.toSource()); return false;           
            return $.ajax2({     
                data : params,
                url: "{url_to('customers_communication_emails_ajax',['action'=>'SendEmail'])}",                
                errorTarget: ".{$site->getSiteID()}-customers-contract-email-{$item->getCustomer()->get('id')}-errors",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-contract-loading",   
                success: function (resp)
                         {
                             if (resp.action=='SendEmail')
                             {                                                                      
                                if (resp.errors)
                                {
                                   $.each(resp.errors,function(id,name){   $(".errors-form[name="+id+"]").html(name);  });     
                                }
                                else
                                {
                                    $("#{$site->getSiteID()}-CustomerContractsEmail-Send").hide();
                                }
                             }    
                         }              
           });
    });

    $("#LoadModelEmail").click(function() { 
            if ($("[name=model_id] option:selected").val()==0)
                return ;
            $(".errors-form").html("");
            return $.ajax2({     
                data : {    Contract : "{$item->get('id')}",
                            CustomerModelEmailI18n: $("[name=model_id] option:selected").val()  },
                url: "{url_to('customers_contracts_ajax',['action'=>'LoadEmailModelI18nContract'])}",
                errorTarget: ".{$site->getSiteID()}-customers-contract-email-{$item->getCustomer()->get('id')}-errors",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-contract-loading",
                success: function(resp)
                         {
                             if (resp.action=='LoadModelI18n')
                             {
                                 $(".CustomerEmail[name=body]").html(resp.model.body);     
                                 $(".CustomerEmail[name=subject]").val(resp.model.subject);                                 
                                 $(".CustomerEmail.editor").editable("setHTML", resp.model.body, true);
                             }
                         }
           });
    });
    
    $('.CustomerEmail.editor').editable({ 
                            inlineMode: false, 
                            buttons: ['undo', 'redo' , 'sep', 'bold', 'italic','fontFamily', 'underline','html','color'],
                            height: "300px",
                            language: '{$country}'  });
</script>    