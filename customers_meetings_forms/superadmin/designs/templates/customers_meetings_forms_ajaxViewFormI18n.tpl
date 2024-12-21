{messages class="{$site->getSiteID()}-CustomerMeetingForm-errors"}
<h3>{__("View form")|capitalize}</h3>
<div>
    <a href="#" id="CustomerMeetingForm-Save" class="btn" style="display:none">
        <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>
        {*<img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>*}{__('save')}</a>
    <a href="#" id="CustomerMeetingForm-Cancel" class="btn"><i class="fa fa-times" style="color:#000;margin-right:10px;"></i>
        {*<img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>*}{__('cancel')}</a>
</div>
<table class="tab-form">
    <tr class="full-with">
        <td class="label">{__('id')}</td>
        <td>{if $item->isLoaded()} 
            <span>{$item->get('id')}</span>  
            {else}
             <span>{__('New')}</span>  
            {/if} 
        </td>
    </tr>
    <tr>
        <td></td>
        <td><img id="{$item->get('lang')}" name="lang" src="{url("/flags/`$item->get('lang')`.png","picture")}" title="{format_country($item->get('lang'))}" />       
        </td>
    </tr>
     <tr class="full-with">
         <td class="label"><span>{__("name")}</span>
        </td>
        <td><div id="CustomerMeetingForm-error_name" class="error-form">{$form.form.name->getError()}</div>  
            <input type="text" class="CustomerMeetingForm" name="name" size="48" value="{$item->getForm()->get('name')}"/> 
        </td>
    </tr>         
    <tr class="full-with">
         <td class="label"><span>{__("value")}</span></td>
         <td>
            <div id="CustomerMeetingForm-error_value" class="error-form">{$form.form_i18n.value->getError()}</div>
            <input type="text" size="10" class="CustomerMeetingFormI18n" name="value" value="{$item->get('value')}"/>    
            {if $form->form_i18n.value->getOption('required')}*{/if} 
         </td>
    </tr>   
</table>
<script type="text/javascript">
    
      
     
     {* =================== F I E L D S ================================ *}
     $(".CustomerMeetingForm,.CustomerMeetingFormI18n").click(function() {  $('#CustomerMeetingForm-Save').show(); });       
    
     {* =================== A C T I O N S ================================ *}
     $('#CustomerMeetingForm-Cancel').click(function(){                           
             return $.ajax2({ data: { filter: { lang:"{$item->get('lang')}", token: "{mfForm::getToken('CustomerMeetingFormsFormFilter')}" } },                              
                              url : "{url_to('customers_meeting_forms_ajax',['action'=>'ListPartialForm'])}",
                              errorTarget: ".{$site->getSiteID()}-CustomerMeetingForm-errors",
                              loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",                         
                              target: "#{$site->getSiteID()}-actions" }); 
      });
      
      $('#CustomerMeetingForm-Save').click(function(){                             
            var  params= {            
                                CustomerMeetingFormI18n: { 
                                   form_i18n : { lang: "{$item->get('lang')}",form_id: "{$item->get('form_id')}"    },
                                   form : { },
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.CustomerMeetingFormI18n").each(function() { params.CustomerMeetingFormI18n.form_i18n[this.name]=$(this).val(); });
          $("input.CustomerMeetingForm").each(function() {  params.CustomerMeetingFormI18n.form[this.name]=$(this).val();  });  // Get foreign key  
          //    alert("Params="+params.toSource());   return ;       
          return $.ajax2({ data : params,                            
                           errorTarget: ".{$site->getSiteID()}-CustomerMeetingForm-errors",
                           url: "{url_to('customers_meeting_forms_ajax',['action'=>'SaveFormI18n'])}",
                           target: "#{$site->getSiteID()}-actions" }); 
        });  
     
</script>