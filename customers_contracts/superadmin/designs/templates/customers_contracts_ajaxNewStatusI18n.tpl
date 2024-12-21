{messages class="{$site->getSiteID()}-CustomerContractStatus-errors"}
<h3>{__("New status")}</h3>
<div>
    <a href="#" id="{$site->getSiteID()}-CustomerContractStatus-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="{$site->getSiteID()}-CustomerContractStatus-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
<style> .ui-dialog { font-size: 62.5%; }</style> 
{component name="/site_languages/dialogListLanguagesFrontend" selected=(string)$form.status_i18n.lang site=$customer_contract_status_i18n->getSite()}   
<table cellpadding="0" cellspacing="0">
    <tr>
        <td></td>
        <td>
            <div>{$form.status_i18n.lang->getError()}</div>      
            <img class="{$site->getSiteID()}-CustomerContractStatusI18n" id="{$form.status_i18n.lang}" name="lang" src="{url("/flags/`$form.status_i18n.lang`.png","picture")}" title="{if !$form.status_i18n.lang->getError()}{format_country($form.status_i18n.lang)}{/if}" />
            <a id="{$site->getSiteID()}-CustomerContractStatus-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a> 
        </td>
    </tr> 
    <tr>
        <td><span>{__("name")}</span></td>
        <td>
             <div>{$form.status.name->getError()}</div>               
             <input type="text" size="20" class="{$site->getSiteID()}-CustomerContractStatus" name="name" value="{$customer_contract_status_i18n->getCustomerContractStatus()->get('name')}"/> 
        </td>
    </tr>  
     <tr>
        <td><span>{__("color")}</span></td>
        <td>
             <div>{$form.status.color->getError()}</div>               
             <input type="text" size="20" class="{$site->getSiteID()}-CustomerContractStatus" name="color" value="{$customer_contract_status_i18n->getCustomerContractStatus()->get('color')}"/> 
        </td>
    </tr> 
    <tr>
        <td><span>{__("icon")}</span></td>
        <td>                       
            <div id="error_icon">{$form.status.icon->getError()}</div>                 
            <a id="{$site->getSiteID()}-ChangeIcon" href="#"><img src="{url('/icons/add.gif','picture')}" alt="{__('new')}"/>
               <span id="text_icon">{__('add picture')|capitalize}</span>
            </a>
            <div id="{$site->getSiteID()}-icon" style="display:none">
               <div>{__('Max size for picture %s.',format_size($form->status.icon->getOption('max_size')))}</div>
               <input class="{$site->getSiteID()}-CustomerContractStatus-files" type="file" name="CustomerContractStatus[status][icon]"/> 
            </div>
            {if $form->status.icon->getOption('required')}*{/if} 
        </td>
    </tr>    
       <tr>
         <td><span>{__("value")}</span></td>
         <td>
            <div id="error_pages">{$form.status_i18n.value->getError()}</div>
            <input type="text" size="10" class="{$site->getSiteID()}-CustomerContractStatusI18n" name="value" value="{$customer_contract_status_i18n->get('value')}"/>    
            {if $form->status_i18n.value->getOption('required')}*{/if} 
         </td>
    </tr>  
</table> 
   
<script type="text/javascript">
     
     {* =================== F I E L D S ================================ *}
     $(".{$site->getSiteID()}-CustomerContractStatus,.{$site->getSiteID()}-CustomerContractStatusI18n").click(function() {  $('#{$site->getSiteID()}-CustomerContractStatus-Save').show(); });    
    
     $(".{$site->getSiteID()}-CustomerContractStatus-files").change(function() {  $('#{$site->getSiteID()}-CustomerContractStatus-Save').show(); });   
     
     $("#{$site->getSiteID()}-ChangeIcon").click(function() {
        $("#{$site->getSiteID()}-icon").show();
        $(this).hide();
      });
         
     {* =================== L A N G U A G E ================================ *}
         $( "#{$site->getSiteID()}-CustomerContractStatus-ChangeLang").click(function() {
            $("#{$site->getSiteID()}-CustomerContractStatus-Save").show();
            $("#{$site->getSiteID()}-dialogListLanguages").dialog("open");
         });  
         
         $("#{$site->getSiteID()}-dialogListLanguages").bind('select',function(event){                    
            $(".{$site->getSiteID()}-CustomerContractStatusI18n[name=lang]").attr({
                                  id: event.selected.id,
                                  src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                  title: event.selected.lang
                                  });         
         }); 
     
     
     {* =================== A C T I O N S ================================ *}
     $('#{$site->getSiteID()}-CustomerContractStatus-Cancel').click(function(){   
             $(".{$site->getSiteID()}-dialogs").dialog("destroy").remove(); 
             return $.ajax2({ data: { filter: { lang:$("img.{$site->getSiteID()}-CustomerContractStatusI18n").attr('id'), token: "{mfForm::getToken('CustomersContractStatusFormFilter')}" } },                              
                              url : "{url_to('customers_contracts_ajax',['action'=>'ListPartialStatus'])}",
                              errorTarget: ".{$site->getSiteID()}-site-errors",
                              loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",                         
                              target: "#{$site->getSiteID()}-actions"}); 
      });
      
      $('#{$site->getSiteID()}-CustomerContractStatus-Save').click(function(){                             
            var  params= {      iFrame:true,             
                                CustomerContractStatus: { 
                                   status_i18n : { lang: $(".{$site->getSiteID()}-CustomerContractStatusI18n[name=lang]").attr('id')  },
                                   status : { },
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.{$site->getSiteID()}-CustomerContractStatusI18n").each(function() { params.CustomerContractStatus.status_i18n[this.name]=$(this).val(); });
          $("input.{$site->getSiteID()}-CustomerContractStatus").each(function() {  params.CustomerContractStatus.status[this.name]=$(this).val();  });  // Get foreign key  
        //      alert("Params="+params.toSource());   return ;
          $(".{$site->getSiteID()}-dialogs").dialog("destroy").remove(); 
          return $.ajax2({ data : params,  
                           files: ".{$site->getSiteID()}-CustomerContractStatus-files",
                           url: "{url_to('customers_contracts_ajax',['action'=>'SaveNewStatusI18n'])}",
                           target: "#{$site->getSiteID()}-actions"}); 
        });  
     
</script>
