{if $meeting->isLoaded()}  
    <div>{$meeting->getCustomer()}</div>
    {messages class="site-meeting-errors-{$meeting->get('id')}"}
{foreach $form->getValidatorSchema()->getSchema() as $form_name=>$schema}    
    {if !in_array($form_name,['token','id'])}
        <h3>{$schema->getRequest()}</h3>        
        {foreach $schema->getSchema() as $field_name=>$field}
            <div>              
             <div>
                {$field->getRequest()}
             </div>  
             {if $field->widget=='input'}     
                  <div class="form-errors">{$form[$form_name][$field_name]->getError()}</div>
                  <input type="text" size="{$field->getSize()}" class="CustomerMeetingExtra Input" id="{$form_name}" name="{$field_name}" value="{$form[$form_name][$field_name]}"/>  
                  {if $field->getOption('required')}*{/if}
             {elseif $field->widget=='text'}
                  <div class="form-errors">{$form[$form_name][$field_name]->getError()}</div>
                  <textarea cols="{$field->cols}" rows="{$field->rows}" class="CustomerMeetingExtra Text" id="{$form_name}" name="{$field_name}">{$form[$form_name][$field_name]}</textarea>  
             {elseif $field->widget=='boolean'}
                 <div class="form-errors">{$form[$form_name][$field_name]->getError()}</div>             
                 <input type="checkbox" class="CustomerMeetingExtra Checkbox" id="{$form_name}" name="{$field_name}" {if $form[$form_name][$field_name]->getValue()}checked=""{/if}/>{__('Yes/No')}
              {elseif $field->widget=='select'}
                 select
             {/if}
             </div>
        {/foreach}         
    {/if}
{/foreach} 
<div>
    <a href="#" id="CustomerMeetingExtra-Save-{$meeting->get('id')}" style="display:none" class="btn">{__('Save')}</a>  
</div>
<script type="text/javascript">
    
   $(".CustomerMeetingExtra").click(function() { $("#CustomerMeetingExtra-Save-{$meeting->get('id')}").show(); });
     

   $("#CustomerMeetingExtra-Save-{$meeting->get('id')}").click(function(){ 
            var params= { MeetingForms: { 
                            id: "{$meeting->get('id')}",                            
                            token :'{$form->getCSRFToken()}'
            } };
                      
            $(".CustomerMeetingExtra.Input,.CustomerMeetingExtra.Text").each(function() { 
                if (typeof params.MeetingForms[$(this).attr('id')] == 'undefined' )
                    params.MeetingForms[$(this).attr('id')]={ };  
                params.MeetingForms[$(this).attr('id')][$(this).attr('name')]=$(this).val();
            });

            $(".CustomerMeetingExtra.Checkbox:checked").each(function() { 
                if (typeof params.MeetingForms[$(this).attr('id')] == 'undefined' )
                    params.MeetingForms[$(this).attr('id')]={ };  
                params.MeetingForms[$(this).attr('id')][$(this).attr('name')]=1;
            });                       
           // alert("Params="+params.toSource()); return false;
            return $.ajax2({   data: params, 
                                url: "{url_to('customers_meeting_forms_ajax',['action'=>'SaveForms'])}", 
                                errorTarget: ".site-meeting-errors-{$meeting->get('id')}",
                                loading: "#tab-site-dashboard-customers-meeting-loading",                          
                                target: "#CustomerMeetingForms-{$meeting->get('id')}"
                                }); 
         });
</script>
{else}
    <span>{__('Meeting is invalid.')}</span>
{/if}    