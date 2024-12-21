{messages class="site-errors"}
<h3>{__('View field for document [%s]',$item->getDocument()->get('name'))}</h3>   
{if $item->isLoaded()}
   <div>
      <a href="#" class="btn" id="CustomerMeetingFormDocument-Save"><img  src="{url('/icons/save.gif','picture')}" alt="{__('Save')}"/>{__('Save')}</a>
      <a href="#" class="btn" id="CustomerMeetingFormDocument-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('Cancel')}"/>{__('Cancel')}</a>      
    </div> 
    
  <table class="tab-form">    
        <tr class="full-with">
            <td class="label"><span>{__("Field")}</span> {if $form->formfield_id->getOption('required')}*{/if} </td>
            <td>
                <div class="error-form">{$form.formfield_id->getError()}</div>               
                {html_options class="CustomerMeetingFormDocumentField Select" name="formfield_id" options=$form->formfield_id->getOption('choices') selected=$item->get('formfield_id')}                
            </td>
        </tr>        
        <tr class="full-with">
            <td class="label"><span>{__("Operation")}</span></td>
            <td>
                <div class="error-form">{$form.operation->getError()}</div>               
                 {html_options class="CustomerMeetingFormDocumentField Select" name="operation" options=$form->operation->getOption('choices') selected=$item->get('operation')}                
            </td>
        </tr> 
         <tr class="full-with">
            <td class="label"><span>{__("Value")}</span>{$form.value->getError()}</td>
            <td>
                <div class="error-form"></div>               
                 <input type="text" class="CustomerMeetingFormDocumentField Input" name="value" size="64" value="{$item->get('value')}"/>                  
            </td>
        </tr> 
</table>    
    
    
    
    
    
    
    
<script type="text/javascript">
    
       $('#CustomerMeetingFormDocument-Cancel').click(function(){                           
             return $.ajax2({ data : { CustomerMeetingFormDocument : '{$item->getDocument()->get('id')}' },                               
                              url : "{url_to('app_domoprime_ajax',['action'=>'ListPartialFieldForDocument'])}",
                              errorTarget: ".site-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions" }); 
      });
      
       $('#CustomerMeetingFormDocument-Save').click(function(){  
             var params = {                         
                        CustomerMeetingFormDocumentField: {                            
                            id : '{$item->get('id')}',
                            token :'{$form->getCSRFToken()}'
                        }            
             };
             $(".CustomerMeetingFormDocumentField.Input").each(function () { params.CustomerMeetingFormDocumentField[$(this).attr('name')]=$(this).val(); });
             $(".CustomerMeetingFormDocumentField.Select option:selected").each(function () { params.CustomerMeetingFormDocumentField[$(this).parent().attr('name')]=$(this).val(); });
             return $.ajax2({  
                              data: params,
                              url : "{url_to('app_domoprime_ajax',['action'=>'SaveFieldForDocument'])}",
                              errorTarget: ".site-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions" }); 
      });
      
     
</script>    
          
    
{else}
    {__('Field is invalid.')}
{/if}    


