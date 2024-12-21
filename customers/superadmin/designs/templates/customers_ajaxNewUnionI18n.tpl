{messages class="{$site->getSiteID()}-CustomerUnion-errors"}
<h3>{__("New union")}</h3>
<div>
    <a href="#" id="{$site->getSiteID()}-CustomerUnion-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="{$site->getSiteID()}-CustomerUnion-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
<style> .ui-dialog { font-size: 62.5%; }</style> 
{component name="/site_languages/dialogListLanguagesFrontend" selected=(string)$form.union_i18n.lang site=$item->getSite()}   
<table cellpadding="0" cellspacing="0">
    <tr>
        <td></td>
        <td>
            <div>{$form.union_i18n.lang->getError()}</div>      
            <img class="{$site->getSiteID()}-CustomerUnionI18n" id="{$form.union_i18n.lang}" name="lang" src="{url("/flags/`$form.union_i18n.lang`.png","picture")}" title="{if !$form.union_i18n.lang->getError()}{format_country($form.union_i18n.lang)}{/if}" />
            <a id="{$site->getSiteID()}-CustomerUnion-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a> 
        </td>
    </tr> 
    <tr>
        <td><span>{__("name")}</span></td>
        <td>
             <div>{$form.union.name->getError()}</div>               
             <input type="text" size="20" class="{$site->getSiteID()}-CustomerUnion" name="name" value="{$item->getCustomerUnion()->get('name')}"/> 
        </td>
    </tr>         
       <tr>
         <td><span>{__("value")}</span></td>
         <td>
            <div id="error_pages">{$form.union_i18n.value->getError()}</div>
            <input type="text" size="10" class="{$site->getSiteID()}-CustomerUnionI18n" name="value" value="{$item->get('value')}"/>    
            {if $form->union_i18n.value->getOption('required')}*{/if} 
         </td>
    </tr>  
</table> 
   
<script type="text/javascript">
     
     {* =================== F I E L D S ================================ *}
     $(".{$site->getSiteID()}-CustomerUnion,.{$site->getSiteID()}-CustomerUnionI18n").click(function() {  $('#{$site->getSiteID()}-CustomerUnion-Save').show(); });    
    
     $(".{$site->getSiteID()}-CustomerUnion-files").change(function() {  $('#{$site->getSiteID()}-CustomerUnion-Save').show(); });   
     
     $("#{$site->getSiteID()}-ChangeIcon").click(function() {
        $("#{$site->getSiteID()}-icon").show();
        $(this).hide();
      });
         
     {* =================== L A N G U A G E ================================ *}
         $( "#{$site->getSiteID()}-CustomerUnion-ChangeLang").click(function() {
            $("#{$site->getSiteID()}-CustomerUnion-Save").show();
            $("#{$site->getSiteID()}-dialogListLanguages").dialog("open");
         });  
         
         $("#{$site->getSiteID()}-dialogListLanguages").bind('select',function(event){                    
            $(".{$site->getSiteID()}-CustomerUnionI18n[name=lang]").attr({
                                  id: event.selected.id,
                                  src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                  title: event.selected.lang
                                  });         
         }); 
     
     
     {* =================== A C T I O N S ================================ *}
     $('#{$site->getSiteID()}-CustomerUnion-Cancel').click(function(){   
             $(".{$site->getSiteID()}-dialogs").dialog("destroy").remove(); 
             return $.ajax2({ data: { filter: { lang:$("img.{$site->getSiteID()}-CustomerUnionI18n").attr('id'), token: "{mfForm::getToken('CustomersUnionFormFilter')}" } },                              
                              url : "{url_to('customers_ajax',['action'=>'ListPartialUnion'])}",
                              errorTarget: ".{$site->getSiteID()}-site-errors",
                              loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",                         
                              target: "#{$site->getSiteID()}-actions"}); 
      });
      
      $('#{$site->getSiteID()}-CustomerUnion-Save').click(function(){                             
            var  params= {      iFrame:true,             
                                CustomerUnion: { 
                                   union_i18n : { lang: $(".{$site->getSiteID()}-CustomerUnionI18n[name=lang]").attr('id')  },
                                   union : { },
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.{$site->getSiteID()}-CustomerUnionI18n").each(function() { params.CustomerUnion.union_i18n[this.name]=$(this).val(); });
          $("input.{$site->getSiteID()}-CustomerUnion").each(function() {  params.CustomerUnion.union[this.name]=$(this).val();  });  // Get foreign key  
        //      alert("Params="+params.toSource());   return ;
          $(".{$site->getSiteID()}-dialogs").dialog("destroy").remove(); 
          return $.ajax2({ data : params,  
                           files: ".{$site->getSiteID()}-CustomerUnion-files",
                           url: "{url_to('customers_ajax',['action'=>'SaveNewUnionI18n'])}",
                           target: "#{$site->getSiteID()}-actions"}); 
        });  
     
</script>
