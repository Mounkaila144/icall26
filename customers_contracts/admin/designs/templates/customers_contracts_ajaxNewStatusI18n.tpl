{messages class="CustomerContractStatus-errors"}
<h3>{__("New status")}</h3>
<div>
    <a href="#" id="CustomerContractStatus-Save" class="btn" style="display:none"><i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{*<img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>*}{__('save')}</a>
    <a href="#" id="CustomerContractStatus-Cancel" class="btn"><i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{*<img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>*}{__('cancel')}</a>
</div>
<style> .ui-dialog { font-size: 62.5%; }</style> 
{component name="/site_languages/dialogListLanguagesFrontend" selected=(string)$form.status_i18n.lang site=$customer_contract_status_i18n->getSite()}   
<table class="tab-form" cellpadding="0" cellspacing="0">
    <tr>
        <td></td>
        <td>
            <div class="error-form">{$form.status_i18n.lang->getError()}</div>      
            <img class="CustomerContractStatusI18n" id="{$form.status_i18n.lang}" name="lang" src="{url("/flags/`$form.status_i18n.lang`.png","picture")}" title="{if !$form.status_i18n.lang->getError()}{format_country($form.status_i18n.lang)}{/if}" />
            <a id="CustomerContractStatus-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a> 
        </td>
    </tr> 
    <tr>
        <td class="label"><span>{__("name")}</span></td>
        <td>
             <div>{$form.status.name->getError()}</div>               
             <input type="text" size="20" class="CustomerContractStatus" name="name" value="{$customer_contract_status_i18n->getCustomerContractStatus()->get('name')}"/> 
        </td>
    </tr>  
     <tr>
        <td class="label"><span>{__("color")}</span></td>
        <td>
             <div class="error-form">{$form.status.color->getError()}</div>               
             <input type="text" size="20" class="CustomerContractStatus" name="color" value="{$customer_contract_status_i18n->getCustomerContractStatus()->get('color')}"/> 
        </td>
    </tr> 
    <tr>
        <td class="label"><span>{__("icon")}</span></td>
        <td>                       
            <div id="error_icon" class="error-form">{$form.status.icon->getError()}</div>                 
            <a id="ChangeIcon" href="#"><i class="fa fa-plus" style="margin-right: 10px;"></i>
{*<img src="{url('/icons/add.gif','picture')}" alt="{__('new')}"/>*}
               <span id="text_icon">{__('add picture')|capitalize}</span>
            </a>
            <div id="icon" style="display:none">
               <div>{__('Max size for picture %s.',format_size($form->status.icon->getOption('max_size')))}</div>
               <input class="CustomerContractStatus-files" type="file" name="CustomerContractStatus[status][icon]"/> 
            </div>
            {if $form->status.icon->getOption('required')}*{/if} 
        </td>
    </tr>    
       <tr>
         <td class="label"><span>{__("value")}</span></td>
         <td>
             <div id="error_pages" class="error-form">{$form.status_i18n.value->getError()}</div>
            <input type="text" size="10" class="CustomerContractStatusI18n" name="value" value="{$customer_contract_status_i18n->get('value')}"/>    
            {if $form->status_i18n.value->getOption('required')}*{/if} 
         </td>
    </tr>  
</table>      
<script type="text/javascript">
     $(".CustomerContractStatus[name=color]").minicolors();
     {* =================== F I E L D S ================================ *}
     $(".CustomerContractStatus,.CustomerContractStatusI18n").click(function() {  $('#CustomerContractStatus-Save').show(); });    
    
     $(".CustomerContractStatus-files").change(function() {  $('#CustomerContractStatus-Save').show(); });   
     
     $("#ChangeIcon").click(function() {
        $("#icon").show();
        $(this).hide();
      });
         
     {* =================== L A N G U A G E ================================ *}
         $( "#CustomerContractStatus-ChangeLang").click(function() {
            $("#CustomerContractStatus-Save").show();
            $("#dialogListLanguages").dialog("open");
         });  
         
         $("#dialogListLanguages").bind('select',function(event){                    
            $(".CustomerContractStatusI18n[name=lang]").attr({
                                  id: event.selected.id,
                                  src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                  title: event.selected.lang
                                  });         
         }); 
     
     
     {* =================== A C T I O N S ================================ *}
     $('#CustomerContractStatus-Cancel').click(function(){   
             $(".dialogs").dialog("destroy").remove(); 
             return $.ajax2({ data: { filter: { lang:$("img.CustomerContractStatusI18n").attr('id'), token: "{mfForm::getToken('CustomersContractStatusFormFilter')}" } },                              
                              url : "{url_to('customers_contracts_ajax',['action'=>'ListPartialStatus'])}",
                              errorTarget: ".site-errors",
                              loading: "#tab-site-dashboard-site-x-settings-loading",                         
                              target: "#actions"}); 
      });
      
      $('#CustomerContractStatus-Save').click(function(){                             
            var  params= {      iFrame:true,             
                                CustomerContractStatus: { 
                                   status_i18n : { lang: $(".CustomerContractStatusI18n[name=lang]").attr('id')  },
                                   status : { },
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.CustomerContractStatusI18n").each(function() { params.CustomerContractStatus.status_i18n[this.name]=$(this).val(); });
          $("input.CustomerContractStatus").each(function() {  params.CustomerContractStatus.status[this.name]=$(this).val();  });  // Get foreign key  
        //      alert("Params="+params.toSource());   return ;
          $(".dialogs").dialog("destroy").remove(); 
          return $.ajax2({ data : params,  
                           files: ".CustomerContractStatus-files",
                           url: "{url_to('customers_contracts_ajax',['action'=>'SaveNewStatusI18n'])}",
                           target: "#actions"}); 
        });  
     
</script>
