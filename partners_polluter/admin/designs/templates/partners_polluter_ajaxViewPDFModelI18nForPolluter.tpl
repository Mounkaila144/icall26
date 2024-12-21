{messages class="PartnerPolluterModel-errors"}
<h3>{__("View PDF model for polluter [%s]",$item_i18n->getModel()->getPolluter()->get('name'))}</h3>
<div>
    <a href="#" id="PartnerPolluterModel-Save" class="btn" style="display:none">
        <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
        <a href="#" id="PartnerPolluterModel-Cancel" class="btn">
         <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>
<table class="tab-form">   
    <tr class="full-with">
        <td></td>
        <td><img id="{$item_i18n->get('lang')}" name="lang" src="{url("/flags/`$item_i18n->get('lang')`.png","picture")}" title="{format_country($item_i18n->get('lang'))}" />       
        </td>
    </tr>
     <tr class="full-with">
        <td class="label"><span>{__("Name")} {if $form->model.name->getOption('required')}*{/if} </span>
        </td>
        <td><div id="PartnerPolluterModel-error_name" class="error-form">{$form.model.name->getError()}</div>  
            <input type="text" class="PartnerPolluterModel Input" name="name" size="64" value="{$item_i18n->getModel()->get('name')}"/> 
        </td>
    </tr>        
    <tr class="full-with">
         <td class="label"><span>{__("Value")}{if $form->model_i18n.value->getOption('required')}*{/if}</span></td>
         <td>
            <div id="PartnerPolluterModel-error_value" class="error-form">{$form.model_i18n.value->getError()}</div>
            <input type="text" size="64" class="PartnerPolluterModelI18n Input" name="value" value="{$item_i18n->get('value')}"/>              
         </td>
    </tr>  
     <tr class="full-with">
         <td class="label"><span>{__("Comments")}</span>  {if $form->model_i18n.comments->getOption('required')}*{/if} </td>
         <td>
            <div id="error_pages" class="error-form">{$form.model_i18n.comments->getError()}</div>
            <input type="text"  class="PartnerPolluterModelI18n" size="64" name="comments" value="{$item_i18n->get('comments')}"/>              
         </td>
    </tr>
      {if $user->hasCredential([['superadmin']])}
     <tr class="full-with">
         <td class="label"><span>{__("Signature")}</span>{if $form->model_i18n.signature->getOption('required')}*{/if} </td>
         <td>
            <div id="error_pages" class="error-form">{$form.model_i18n.signature->getError()}</div>
            <input type="text"  class="PartnerPolluterModelI18n Input" size="64" name="signature" value="{$item_i18n->get('signature')}"/>            
         </td>
    </tr>
     <tr class="full-with">
         <td class="label"><span>{__("Initiator signature")}</span> {if $form->model_i18n.initiator_signature->getOption('required')}*{/if} </td>
         <td>
            <div id="error_pages" class="error-form">{$form.model_i18n.initiator_signature->getError()}</div>
            <input type="text"  class="PartnerPolluterModelI18n" size="64" name="initiator_signature" value="{$item_i18n->get('initiator_signature')}"/>               
         </td>
    </tr>
    {else}
      <tr class="full-with">
        <td class="label"><span>{__("Signature")}</span></td>
        <td>{if $item_i18n->hasSignature()}
                {$item_i18n->get('signature')}
            {else}
                {__('---')}
            {/if}    
        </td>
    </tr>   
    <tr class="full-with">
        <td class="label"><span>{__("Initiator signature")}</span></td>
        <td>{if $item_i18n->hasInitiatorSignature()}
                {$item_i18n->get('initiator_signature')}
            {else}
                {__('---')}
            {/if}    
        </td>
    </tr>  
    {/if}
    {if $form->model_i18n->hasValidator('file')}
        <tr class="full-with">
        <td class="label"><span>{__("PDF")}{if $form->model_i18n.file->getOption('required')}*{/if}</span></td>
        <td>
            <div id="error_file" class="error-form">{$form.model_i18n.file->getError()}</div>  
            <div>{__('Max size for file %s.',format_size($form->model_i18n.file->getOption('max_size')))}</div>
            <div>
               <input class="files" type="file" name="PolluterModelI18n[model_i18n][file]"/> 
            </div>          
        </td>
    </tr>
    {/if}    
    {if $user->hasCredential([['superadmin']])}
     <tr class="full-with">
        <td class="label"><span>{__("Variables")}</span></td>
        <td>
            <textarea disabled="" readonly="" cols="80" rows="10">{$item_i18n->getVariablesOfFile()->implode("\n")}</textarea>
        </td>
    </tr>
    {/if}     
</table>


<script type="text/javascript">
  
     {* =================== F I E L D S ================================ *}
     $(".PartnerPolluterModelI18n,.PartnerPolluterModel").click(function() {  $('#PartnerPolluterModel-Save').show(); });    
                       
     {* =================== A C T I O N S ================================ *}
     $('#PartnerPolluterModel-Cancel').click(function(){              
             return $.ajax2({ data: { Polluter: '{$item_i18n->getModel()->getPolluter()->get('id')}' },
                              url : "{url_to('partners_polluter_ajax',['action'=>'ListPartialModelI18nForPolluter'])}",
                              errorTarget: ".PolluterModelI18n-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions"}); 
      });
      
      $('#PartnerPolluterModel-Save').click(function(){                             
            var  params= {            
                                PolluterModelI18n: { 
                                   model_i18n : { lang: "{$item_i18n->get('lang')}",model_id: "{$item_i18n->get('model_id')}"    },
                                   model : { },
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.PartnerPolluterModelI18n,textarea.PartnerPolluterModelI18n").each(function() { params.PolluterModelI18n.model_i18n[this.name]=$(this).val(); });
          $("input.PartnerPolluterModel").each(function() {  params.PolluterModelI18n.model[this.name]=$(this).val();  });  // Get foreign key  
          //    alert("Params="+params.toSource());   return ;       
          return $.ajax2({ data : params,  
                           files: ".files",
                           errorTarget: ".PartnerPolluterModel-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",  
                           url: "{url_to('partners_polluter_ajax',['action'=>'SavePDFModelI18nForPolluter'])}",
                           target: "#actions" }); 
        });  
     
  
     
</script>