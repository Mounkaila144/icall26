{messages class="`$site->getSiteID()`-customers-meeting-sms-`$item->getCustomer()->get('id')`-errors"}
<h3>{__("New SMS")|capitalize}</h3>
<div>
    <a href="#" class="btn" id="{$site->getSiteID()}-UserMeetingsSms-Send" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('send')}"/>{__('Send')}</a>   
</div>   
{if $form->isValid()}    
    {if $form.sale->getValue()=='Sale1'}
        {component name="/users_communication_sms/newSms" user=$user}
    {else}
        {component name="/users_communication_sms/newSms" user=$user}
    {/if} 
{else}
    {__('Sale is invalid.')}
{/if}
<script type="text/javascript">
    
    $(".UserSms").click(function() {  $("#{$site->getSiteID()}-UserMeetingsSms-Send").show(); });

{if $user}
    $("#{$site->getSiteID()}-UserMeetingsSms-Send").click(function() {  
            
            var params= { UserSms: { user_id: "{$user->get('id')}",
                                           model_id: $("[name=model_id] option:selected").val(),
                                           token :'{mfForm::getToken('UserSmsSendForm')}' } };
             $("input.UserSms,textarea.UserSms").each(function() { params.UserSms[this.name]=$(this).val(); });
            // alert("Params="+params.products.toSource()); return false;           
            return $.ajax2({     
                data : params,
                url: "{url_to('users_communication_sms_ajax',['action'=>'SendSms'])}",                
                errorTarget: ".{$site->getSiteID()}-customers-meeting-sms-{$item->getCustomer()->get('id')}-errors",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-meeting-loading",   
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
                                    $("#{$site->getSiteID()}-UserMeetingsSms-Send").hide();
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
                data : {        Meeting : "{$item->get('id')}",
                                User: "{$user->get('id')}",
                                UserModelSmsI18n: $("[name=model_id] option:selected").val()  },
                url: "{url_to('customers_meeting_ajax',['action'=>'LoadSmsModelI18nMeetingForSale'])}",
                errorTarget: ".{$site->getSiteID()}-customers-meeting-sms-{$item->getCustomer()->get('id')}-errors",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-meeting-loading",   
                success: function(resp)
                         {
                             if (resp.action=='LoadModelI18n')
                             {                                   
                                 $(".UserSms[name=message]").html(resp.model.message);
                             }
                         }
           });
    });
{/if}    
</script> 