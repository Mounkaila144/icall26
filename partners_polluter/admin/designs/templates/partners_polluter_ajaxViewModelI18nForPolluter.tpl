{messages class="PolluterModelI18n-errors"}
<h3>{__('View model for polluter [%s]',$item_i18n->getModel()->getPolluter()->get('name'))}</h3>
{if $item_i18n->isLoaded()}
<div>
    <a href="#" id="PolluterModelI18n-Save" class="btn" style="display:none">
        <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="#" id="PolluterModelI18n-Cancel" class="btn">
        <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>
<table class="tab-form">   
    <tr class="full-with">
        <td></td>
        <td><img id="{$item_i18n->get('lang')}" name="lang" src="{url("/flags/`$item_i18n->get('lang')`.png","picture")}" title="{format_country($item_i18n->get('lang'))}" />       
        </td>
    </tr>
     <tr class="full-with">
        <td class="label"><span>{__("Name")}</span>
        </td>
        <td><div id="PolluterModel-error_name" class="error-form">{$form.model.name->getError()}</div>  
            <input type="text" class="PolluterModel Input" name="name" size="64" value="{$item_i18n->getModel()->get('name')}"/> 
        </td>
    </tr>        
    <tr class="full-with">
         <td class="label"><span>{__("Value")}</span></td>
         <td>
            <div id="PolluterModel-error_value" class="error-form">{$form.model_i18n.value->getError()}</div>
            <input type="text" size="64" class="PolluterModelI18n Input" name="value" value="{$item_i18n->get('value')}"/>    
            {if $form->model_i18n.value->getOption('required')}*{/if} 
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
         <td class="label"><span>{__("Content")}</span></td>
         <td class="tdEditor">
            <div id="error_pages" class="error-form">{$form.model_i18n.content->getError()}</div>
            <textarea  class="PolluterModelI18n editor Input" rows="20" cols="120" name="content">{$item_i18n->get('content')}</textarea>    
            {if $form->model_i18n.content->getOption('required')}*{/if} 
         </td>
    </tr>  
     <tr class="dict">
        <td>
               
        </td>
    </tr> 
</table>

   
{else}  
    {__('Model is invalid.')}
{/if}
<script type="text/javascript">
    
     {* =================== F I E L D S ================================ *}
     $(".PolluterModelI18n,.PolluterModel").click(function() {  $('#PolluterModelI18n-Save').show(); });    
        
     
     
     
     {* =================== A C T I O N S ================================ *}
     $('#PolluterModelI18n-Cancel').click(function(){              
             return $.ajax2({ data: { Polluter: '{$item_i18n->getModel()->getPolluter()->get('id')}' },
                              url : "{url_to('partners_polluter_ajax',['action'=>'ListPartialModelI18nForPolluter'])}",
                              errorTarget: ".PolluterModelI18n-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions"}); 
      });
      
     $('#PolluterModelI18n-Save').click(function(){                             
            var  params= {     
                                PolluterModelI18n: { 
                                   model_i18n : { lang: "{$item_i18n->get('lang')}",model_id: "{$item_i18n->get('model_id')}"    },
                                   model : { },                                                            
                                   token :'{$form->getCSRFToken()}'
                                } };
          $(".PolluterModelI18n.Input").each(function() { params.PolluterModelI18n.model_i18n[$(this).attr('name')]=$(this).val(); });          
          $(".PolluterModel.Input").each(function() { params.PolluterModelI18n.model[$(this).attr('name')]=$(this).val(); });          
        //      alert("Params="+params.toSource());   return ;        
          return $.ajax2({ data : params,                             
                           url: "{url_to('partners_polluter_ajax',['action'=>'SaveModelI18nForPolluter'])}",
                           loading: "#tab-site-dashboard-x-settings-loading",   
                           errorTarget: ".PolluterModelI18n-errors",
                           target: "#actions"}); 
        });  
     
</script>


