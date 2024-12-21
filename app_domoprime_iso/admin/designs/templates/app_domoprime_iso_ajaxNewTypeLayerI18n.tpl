{messages class="DomoprimeTypeLayer-errors"}
<h3>{__("New type")}</h3>
<div>
    <a href="#" id="DomoprimeTypeLayer-Save" class="btn"><i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{*<img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>*}{__('save')}</a>
    <a href="#" id="DomoprimeTypeLayer-Cancel" class="btn"><i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{*<img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>*}{__('cancel')}</a>
</div>
<style> .ui-dialog { font-size: 62.5%; }</style> 
{component name="/site_languages/dialogListLanguagesFrontend" selected=(string)$form.type_i18n.lang}   
<table class="tab-form" cellpadding="0" cellspacing="0">
    <tr>
        <td></td>
        <td>
            <div class="error-form">{$form.type_i18n.lang->getError()}</div>      
            <img class="DomoprimeTypeLayerI18n" id="{$form.type_i18n.lang}" name="lang" src="{url("/flags/`$form.type_i18n.lang`.png","picture")}" title="{if !$form.type_i18n.lang->getError()}{format_country($form.type_i18n.lang)}{/if}" />
            <a id="DomoprimeTypeLayer-ChangeLang" href="#" title="{__('Change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a> 
        </td>
    </tr> 
    <tr>
        <td class="label"><span>{__("Name")}</span></td>
        <td>
             <div>{$form.type.name->getError()}</div>               
             <input type="text" size="20" class="DomoprimeTypeLayer" name="name" value="{$item_i18n->getType()->get('name')}"/> 
        </td>
    </tr>     
       <tr>
         <td class="label"><span>{__("Value")}</span></td>
         <td>
             <div id="error_pages" class="error-form">{$form.type_i18n.value->getError()}</div>
            <input type="text" size="10" class="DomoprimeTypeLayerI18n" name="value" value="{$item_i18n->get('value')}"/>    
            {if $form->type_i18n.value->getOption('required')}*{/if} 
         </td>
    </tr>  
</table>      
<script type="text/javascript">
     $(".DomoprimeTypeLayer[name=color]").minicolors();
     {* =================== F I E L D S ================================ *}
     $(".DomoprimeTypeLayer,.DomoprimeTypeLayerI18n").click(function() {  $('#DomoprimeTypeLayer-Save').show(); });    
    
  
         
     {* =================== L A N G U A G E ================================ *}
         $( "#DomoprimeTypeLayer-ChangeLang").click(function() {
            $("#DomoprimeTypeLayer-Save").show();
            $("#dialogListLanguages").dialog("open");
         });  
         
         $("#dialogListLanguages").bind('select',function(event){                    
            $(".DomoprimeTypeLayerI18n[name=lang]").attr({
                                  id: event.selected.id,
                                  src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                  title: event.selected.lang
                                  });         
         }); 
     
     
     {* =================== A C T I O N S ================================ *}
     $('#DomoprimeTypeLayer-Cancel').click(function(){              
             return $.ajax2({ data: { filter: { lang:$("img.DomoprimeTypeLayerI18n").attr('id'), token: "{mfForm::getToken('DomoprimeTypeLayerFormFilter')}" } },                              
                              url : "{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialTypeLayer'])}",
                              errorTarget: ".site-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions"}); 
      });
      
      $('#DomoprimeTypeLayer-Save').click(function(){                             
            var  params= {               
                                DomoprimeTypeLayer: { 
                                   type_i18n : { lang: $(".DomoprimeTypeLayerI18n[name=lang]").attr('id')  },
                                   type : { },
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.DomoprimeTypeLayerI18n").each(function() { params.DomoprimeTypeLayer.type_i18n[this.name]=$(this).val(); });
          $("input.DomoprimeTypeLayer").each(function() {  params.DomoprimeTypeLayer.type[this.name]=$(this).val();  });  // Get foreign key  
        //      alert("Params="+params.toSource());   return ;        
          return $.ajax2({ data : params,                          
                           url: "{url_to('app_domoprime_iso_ajax',['action'=>'SaveNewTypeLayerI18n'])}",
                             errorTarget: ".site-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",    
                           target: "#actions"}); 
        });  
     
</script>

