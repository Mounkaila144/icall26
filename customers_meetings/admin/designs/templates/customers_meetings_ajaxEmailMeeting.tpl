{messages class="customers-meeting-email-`$item->getCustomer()->get('id')`-errors"}
<h3>{__("New email")|capitalize}</h3>
<div>
    <a href="#" class="btn" id="CustomerMeetingsEmail-Send" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('send')}"/>{__('Send')}</a>   
</div>
{component name="/customers_communication_emails/newEmail" customer=$item->getCustomer() key="customers-contract-email-`$item->getCustomer()->get('id')`"}
<script type="text/javascript">
    
    $(".CustomerEmail").click(function() {  $("#CustomerMeetingsEmail-Send").show(); });

    $("#CustomerMeetingsEmail-Send").click(function() {  
            
            var params= { CustomerEmail: { customer_id: "{$item->getCustomer()->get('id')}",
                                           model_id: $("[name=model_id] option:selected").val(),
                                           token :'{mfForm::getToken('CustomerEmailSendForm')}' } };
             $("input.CustomerEmail,textarea.CustomerEmail").each(function() { params.CustomerEmail[this.name]=$(this).val(); });
            // alert("Params="+params.products.toSource()); return false;           
            return $.ajax2({     
                data : params,
                url: "{url_to('customers_communication_emails_ajax',['action'=>'SendEmail'])}",                
                errorTarget: ".customers-meeting-email-{$item->getCustomer()->get('id')}-errors",
                loading: "#tab-site-dashboard-customers-meeting-loading",   
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
                                    $("#CustomerMeetingsEmail-Send").hide();
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
                data : {    Meeting : "{$item->get('id')}",
                            CustomerModelEmailI18n: $("[name=model_id] option:selected").val()  },
                url: "{url_to('customers_meeting_ajax',['action'=>'LoadEmailModelI18nMeeting'])}",
                errorTarget: ".customers-meeting-email-{$item->getCustomer()->get('id')}-errors",
                loading: "#tab-site-dashboard-customers-meeting-loading",
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
                            width:"900px",
                            zIndex: 0,
                            language: '{$country}'  }).editable("sync");
                
   
  
</script>    