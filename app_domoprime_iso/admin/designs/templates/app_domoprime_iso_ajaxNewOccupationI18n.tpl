{messages class="DomoprimeOccupation-errors"}
<h3>{__("New occupation")}</h3>
<div>
    <a href="#" id="DomoprimeOccupation-Save" class="btn"><i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{*<img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>*}{__('save')}</a>
    <a href="#" id="DomoprimeOccupation-Cancel" class="btn"><i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{*<img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>*}{__('cancel')}</a>
</div>
<style> .ui-dialog { font-size: 62.5%; }</style> 
{component name="/site_languages/dialogListLanguagesFrontend" selected=(string)$form.occupation_i18n.lang}   
<table class="tab-form" cellpadding="0" cellspacing="0">
    <tr>
        <td></td>
        <td>
            <div class="error-form">{$form.occupation_i18n.lang->getError()}</div>      
            <img class="DomoprimeOccupationI18n" id="{$form.occupation_i18n.lang}" name="lang" src="{url("/flags/`$form.occupation_i18n.lang`.png","picture")}" title="{if !$form.occupation_i18n.lang->getError()}{format_country($form.occupation_i18n.lang)}{/if}" />
            <a id="DomoprimeOccupation-ChangeLang" href="#" title="{__('Change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a> 
        </td>
    </tr> 
    <tr>
        <td class="label"><span>{__("Name")}</span></td>
        <td>
             <div>{$form.occupation.name->getError()}</div>               
             <input occupation="text" size="20" class="DomoprimeOccupation" name="name" value="{$item_i18n->getOccupation()->get('name')}"/> 
        </td>
    </tr>     
       <tr>
         <td class="label"><span>{__("Value")}</span></td>
         <td>
             <div id="error_pages" class="error-form">{$form.occupation_i18n.value->getError()}</div>
            <input occupation="text" size="10" class="DomoprimeOccupationI18n" name="value" value="{$item_i18n->get('value')}"/>    
            {if $form->occupation_i18n.value->getOption('required')}*{/if} 
         </td>
    </tr>  
</table>      
<script occupation="text/javascript">
     $(".DomoprimeOccupation[name=color]").minicolors();
     {* =================== F I E L D S ================================ *}
     $(".DomoprimeOccupation,.DomoprimeOccupationI18n").click(function() {  $('#DomoprimeOccupation-Save').show(); });    
    
  
         
     {* =================== L A N G U A G E ================================ *}
         $( "#DomoprimeOccupation-ChangeLang").click(function() {
            $("#DomoprimeOccupation-Save").show();
            $("#dialogListLanguages").dialog("open");
         });  
         
         $("#dialogListLanguages").bind('select',function(event){                    
            $(".DomoprimeOccupationI18n[name=lang]").attr({
                                  id: event.selected.id,
                                  src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                  title: event.selected.lang
                                  });         
         }); 
     
     
     {* =================== A C T I O N S ================================ *}
     $('#DomoprimeOccupation-Cancel').click(function(){              
             return $.ajax2({ data: { filter: { lang:$("img.DomoprimeOccupationI18n").attr('id'), token: "{mfForm::getToken('DomoprimeOccupationFormFilter')}" } },                              
                              url : "{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialOccupation'])}",
                              errorTarget: ".site-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions"}); 
      });
      
      $('#DomoprimeOccupation-Save').click(function(){                             
            var  params= {               
                                DomoprimeOccupation: { 
                                   occupation_i18n : { lang: $(".DomoprimeOccupationI18n[name=lang]").attr('id')  },
                                   occupation : { },
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.DomoprimeOccupationI18n").each(function() { params.DomoprimeOccupation.occupation_i18n[this.name]=$(this).val(); });
          $("input.DomoprimeOccupation").each(function() {  params.DomoprimeOccupation.occupation[this.name]=$(this).val();  });  // Get foreign key  
        //      alert("Params="+params.toSource());   return ;        
          return $.ajax2({ data : params,                          
                           url: "{url_to('app_domoprime_iso_ajax',['action'=>'SaveNewOccupationI18n'])}",
                             errorTarget: ".site-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",    
                           target: "#actions"}); 
        });  
     
</script>


