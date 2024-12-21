{messages class="PolluterModelI18n-errors"}
<h3>{__('New model for polluter [%s]',$polluter->get('name'))}</h3>
{if $polluter->isLoaded()}
<div>
    <a href="#" id="PolluterModelI18n-Save" class="btn" style="display:none">
        <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="#" id="PolluterModelI18n-Cancel" class="btn">
        <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>
<style> .ui-dialog { font-size: 62.5%; }</style> 
{component name="/site_languages/dialogListLanguagesFrontend" selected=$item_i18n->get('lang')}   
<table class="tab-form" cellpadding="0" cellspacing="0">
    <tr class="full-with">
        <td></td>
        <td>
            <div class="error-form">{$form.model_i18n.lang->getError()}</div>      
            <img class="PolluterModelI18n" id="{$item_i18n->get('lang')}" name="lang" src="{url("/flags/`$item_i18n->get('lang')`.png","picture")}" title="{if !$form.model_i18n.lang->getError()}{format_country($item_i18n->get('lang'))}{/if}" />
            <a id="PolluterModelI18n-ChangeLang" href="#" title="{__('Change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a> 
        </td>
    </tr>
     <tr class="full-with">
           <td class="label"><span>{__("Name")}{if $form->model.name->getOption('required')}*{/if} </span></td>
         <td>
            <div id="error_pages" class="error-form">{$form.model.name->getError()}</div>
            <input type="text" size="40" class="PolluterModel Input" name="name" value="{$item_i18n->getModel()->get('name')}"/>               
         </td>
    </tr> 
       <tr class="full-with">
           <td class="label"><span>{__("Value")}{if $form->model_i18n.value->getOption('required')}*{/if} </span></td>
         <td>
            <div id="error_pages" class="error-form">{$form.model_i18n.value->getError()}</div>
            <input type="text" size="40" class="PolluterModelI18n Input" name="value" value="{$item_i18n->get('value')}"/>               
         </td>
    </tr>  
     <tr class="full-with">
         <td class="label"><span>{__("Comments")}</span>  {if $form->model_i18n.comments->getOption('required')}*{/if} </td>
         <td>
            <div id="error_pages" class="error-form">{$form.model_i18n.comments->getError()}</div>
            <input type="text"  class="PartnerPolluterModelI18n" size="64" name="comments" value="{$item_i18n->get('comments')}"/>              
         </td>
    </tr>
     <tr class="full-with">
           <td class="label"><span>{__("Content")}{if $form->model_i18n.content->getOption('required')}*{/if} </span></td>
         <td>
            <div id="error_pages" class="error-form">{$form.model_i18n.content->getError()}</div>
            <textarea  rows="4" cols="80" class="PolluterModelI18n Input" name="content">{$item_i18n->get('content')}</textarea>           
         </td>
    </tr>  
</table> 
   
{else}  
    {__('Polluter is invalid.')}
{/if}
<script type="text/javascript">
    
     {* =================== F I E L D S ================================ *}
     $(".PolluterModelI18n,.PolluterModel").click(function() {  $('#PolluterModelI18n-Save').show(); });    
        
     {* =================== L A N G U A G E ================================ *}
         $( "#PolluterModelI18n-ChangeLang").click(function() {
            $("#PolluterModelI18n-Save").show();
            $("#dialogListLanguages").dialog("open");
         });  
         
         $("#dialogListLanguages").bind('select',function(event){                    
            $(".PolluterModelI18n[name=lang]").attr({
                                  id: event.selected.id,
                                  src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                  title: event.selected.lang
                                  });         
         }); 
     
     
     {* =================== A C T I O N S ================================ *}
     $('#PolluterModelI18n-Cancel').click(function(){   
           //  $(".dialogs").dialog("destroy").remove(); 
             return $.ajax2({ data: { Polluter: '{$polluter->get('id')}' },
                              url : "{url_to('partners_polluter_ajax',['action'=>'ListPartialModelI18nForPolluter'])}",
                              errorTarget: ".PolluterModelI18n-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions"}); 
      });
      
     $('#PolluterModelI18n-Save').click(function(){                             
            var  params= {      Polluter: '{$polluter->get('id')}',
                                PolluterModel: {                                    
                                   model_i18n : { lang: $(".PolluterModelI18n[name=lang]").attr('id')  },
                                   model : { },
                                   token :'{$form->getCSRFToken()}'
                                } };
          $(".PolluterModelI18n.Input").each(function() { params.PolluterModel.model_i18n[$(this).attr('name')]=$(this).val(); });          
          $(".PolluterModel.Input").each(function() { params.PolluterModel.model[$(this).attr('name')]=$(this).val(); }); 
        //      alert("Params="+params.toSource());   return ;
        //  $(".dialogs").dialog("destroy").remove(); 
          return $.ajax2({ data : params,                             
                           url: "{url_to('partners_polluter_ajax',['action'=>'SaveNewModelI18nForPolluter'])}",
                           loading: "#tab-site-dashboard-x-settings-loading",   
                           errorTarget: ".PolluterModelI18n-errors",
                           target: "#actions"}); 
        });  
     
     
     
</script>

