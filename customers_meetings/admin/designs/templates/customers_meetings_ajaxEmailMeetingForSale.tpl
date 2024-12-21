{messages class="customers-meeting-email-sale-`$item->getCustomer()->get('id')`-errors"}
<h3>{__("New email")|capitalize}</h3>
<div>
    <a href="#" class="btn" id="UserMeetingsEmail-Send" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('send')}"/>{__('Send')}</a>   
</div>
{if $form->isValid()}    
    {if $form.sale->getValue()=='Sale1'}
        {component name="/users_communication_emails/newEmail" user=$user}
    {else}
        {component name="/users_communication_emails/newEmail" user=$user}
    {/if} 
{else}
    {__('Sale is invalid.')}
{/if}
<script type="text/javascript">
    
    $(".UserEmail").click(function() {  $("#UserMeetingsEmail-Send").show(); });

{if $user}
    $("#UserMeetingsEmail-Send").click(function() {  
            
            var params= { UserEmail: { 
                                           user_id: "{$user->get('id')}",
                                           model_id: $("[name=model_id] option:selected").val(),
                                           token :'{mfForm::getToken('UserEmailSendForm')}' } };
             $("input.UserEmail,textarea.UserEmail").each(function() { params.UserEmail[this.name]=$(this).val(); });
            // alert("Params="+params.products.toSource()); return false;           
            return $.ajax2({     
                data : params,
                url: "{url_to('users_communication_emails_ajax',['action'=>'SendEmail'])}",                
                errorTarget: ".customers-meeting-email-sale-{$item->getCustomer()->get('id')}-errors",
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
                                    $("#UserMeetingsEmailForSale-Send").hide();
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
                            User: "{$user->get('id')}",
                            UserModelEmailI18n: $("[name=model_id] option:selected").val()  },
                url: "{url_to('customers_meeting_ajax',['action'=>'LoadEmailModelI18nMeetingForSale'])}",
                errorTarget: ".customers-meeting-email-sale-{$item->getCustomer()->get('id')}-errors",
                loading: "#tab-site-dashboard-customers-meeting-loading",
                success: function(resp)
                         {
                             if (resp.action=='LoadModelI18n')
                             {
                                 $(".UserEmail[name=body]").html(resp.model.body);     
                                 $(".UserEmail[name=subject]").val(resp.model.subject);                                 
                                 $(".UserEmail.editor").editable("setHTML", resp.model.body, true);
                             }
                         }
           });
    });
  
{/if}

    $('.UserEmail.editor').editable({ 
                            inlineMode: false, 
                            buttons: ['undo', 'redo' , 'sep', 'bold', 'italic','fontFamily', 'underline','html','color'],                          
                            width:"900px",
                            zIndex: 0,
                            language: '{$country}'  });
                
   
  
</script>   