{messages class="site-errors"}
    <h3>{__('New Document form')}</h3>    
    <div>
      <a href="#" class="btn" id="CustomerMeetingFormDocument-Save"><img  src="{url('/icons/save.gif','picture')}" alt="{__('Save')}"/>{__('Save')}</a>
      <a href="#" class="btn" id="CustomerMeetingFormDocument-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('Cancel')}"/>{__('Cancel')}</a>      
    </div> 
<table class="tab-form">
    <tr class="full-with">
            <td class="label"><span>{__('Name')}</span>{if $form->name->getOption('required')}*{/if} </td>
            <td>
                <div class="error-form">{$form.name->getError()}</div>               
                 <input type="text" class="CustomerMeetingFormDocument" name="name" size="64" value="{$item->get('name')}"/>                  
            </td>
        </tr> 
          <tr class="full-with">
            <td class="label"><span>{__("Class")}</span> {if $form->class_id->getOption('required')}*{/if} </td>
            <td>
                <div class="error-form">{$form.class_id->getError()}</div>               
                {html_options class="CustomerMeetingFormDocument Select" name="class_id" options=$form->class_id->getOption('choices') selected=$item->get('class_id')}                
            </td>
        </tr>
    <tr class="full-with">
            <td class="label"><span>{__("Model")}</span> {if $form->model_id->getOption('required')}*{/if} </td>
            <td>
                <div class="error-form">{$form.model_id->getError()}</div>               
                {html_options class="CustomerMeetingFormDocument" name="model_id" options=$form->model_id->getOption('choices') selected=$form.model_id->getValue()}
                
            </td>
        </tr> 
</table>        
    

<script type="text/javascript">
    
       $('#CustomerMeetingFormDocument-Cancel').click(function(){                           
             return $.ajax2({                                
                              url : "{url_to('app_domoprime_ajax',['action'=>'ListPartialDocument'])}",
                              errorTarget: ".site-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions" }); 
      });
      
       $('#CustomerMeetingFormDocument-Save').click(function(){  
             var params = { 
                       
                        CustomerMeetingFormDocument: { 
                            model_id: $("[name=model_id] option:selected").val(),  
                            class_id: $("[name=class_id] option:selected").val(),  
                            name: $("[name=name]").val(),  
                            token :'{$form->getCSRFToken()}'
                        }            
             };
             
             return $.ajax2({  
                              data: params,
                              url : "{url_to('app_domoprime_ajax',['action'=>'NewDocument'])}",
                              errorTarget: ".site-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions" }); 
      });
      
     
</script>

