{messages class="DomoprimeEnergy-errors"}
<h3>{__("New energy")}</h3>
<div>
    <a href="#" id="DomoprimeEnergy-Save" class="btn" style="display:none">
        <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="#" id="DomoprimeEnergy-Cancel" class="btn">
        <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>
<style> .ui-dialog { font-size: 62.5%; }</style> 
{component name="/site_languages/dialogListLanguagesFrontend" selected=(string)$form.energy_i18n.lang}   
<table class="tab-form" cellpadding="0" cellspacing="0">
    <tr class="full-with">
        <td></td>
        <td>
            <div class="error-form">{$form.energy_i18n.lang->getError()}</div>      
            <img class="DomoprimeEnergyI18n" id="{$form.energy_i18n.lang}" name="lang" src="{url("/flags/`$form.energy_i18n.lang`.png","picture")}" title="{if !$form.energy_i18n.lang->getError()}{format_country($form.energy_i18n.lang)}{/if}" />
            <a id="DomoprimeEnergy-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a> 
        </td>
    </tr> 
    <tr class="full-with">
        <td class="label"><span>{__("name")}</span></td>
        <td>
            <div class="error-form">{$form.energy.name->getError()}</div>               
             <input type="text" size="20" class="DomoprimeEnergy" name="name" value="{$item_i18n->getEnergy()->get('name')}"/> 
        </td>
    </tr>      
       <tr class="full-with">
           <td class="label"><span>{__("value")}</span></td>
         <td>
            <div id="error_pages" class="error-form">{$form.energy_i18n.value->getError()}</div>
            <input type="text" size="40" class="DomoprimeEnergyI18n" name="value" value="{$item_i18n->get('value')}"/>    
            {if $form->energy_i18n.value->getOption('required')}*{/if} 
         </td>
    </tr>  
</table> 
   
  
<script type="text/javascript">
    
     {* =================== F I E L D S ================================ *}
     $(".DomoprimeEnergy,.DomoprimeEnergyI18n").click(function() {  $('#DomoprimeEnergy-Save').show(); });           
         
     {* =================== L A N G U A G E ================================ *}
         $( "#DomoprimeEnergy-ChangeLang").click(function() {
            $("#DomoprimeEnergy-Save").show();
            $("#dialogListLanguages").dialog("open");
         });  
         
         $("#dialogListLanguages").bind('select',function(event){                    
            $(".DomoprimeEnergyI18n[name=lang]").attr({
                                  id: event.selected.id,
                                  src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                  title: event.selected.lang
                                  });         
         }); 
     
     
     {* =================== A C T I O N S ================================ *}
     $('#DomoprimeEnergy-Cancel').click(function(){   
           //  $(".dialogs").dialog("destroy").remove(); 
             return $.ajax2({ data: { filter: { lang:$("img.DomoprimeEnergyI18n").attr('id'), token: "{mfForm::getToken('DomoprimeEnergyFormFilter')}" } },                              
                              url : "{url_to('app_domoprime_ajax',['action'=>'ListPartialEnergy'])}",
                              errorTarget: ".DomoprimeEnergy-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions"}); 
      });
      
      $('#DomoprimeEnergy-Save').click(function(){                             
            var  params= {             
                                DomoprimeEnergy: { 
                                   energy_i18n : { lang: $(".DomoprimeEnergyI18n[name=lang]").attr('id')  },
                                   energy : { },
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.DomoprimeEnergyI18n").each(function() { params.DomoprimeEnergy.energy_i18n[this.name]=$(this).val(); });
          $("input.DomoprimeEnergy").each(function() {  params.DomoprimeEnergy.energy[this.name]=$(this).val();  });  // Get foreign key  
        //      alert("Params="+params.toSource());   return ;
        //  $(".dialogs").dialog("destroy").remove(); 
          return $.ajax2({ data : params,  
                           files: ".DomoprimeEnergy-files",
                           url: "{url_to('app_domoprime_ajax',['action'=>'SaveNewEnergyI18n'])}",
                           loading: "#tab-site-dashboard-x-settings-loading",
                           errorTarget: ".DomoprimeEnergy-errors",
                           target: "#actions"}); 
        });  
     
</script>
