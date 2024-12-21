{foreach $form->extra->getSchema() as $form_name=>$schema}    
    <h3>{$schema->getRequest()}</h3>
    {foreach $schema->getSchema() as $field_name=>$field}
        <div>              
         <div>
            {$field->getRequest()}
         </div>  
         {if $field->widget=='input'}     
              <div class="form-errors">{$form.extra[$form_name][$field_name]->getError()}</div>
              <input type="text" size="{$field->getSize()}" class="CustomerMeetingExtra Input" id="{$form_name}" name="{$field_name}" value="{$form.extra[$form_name][$field_name]}"/>  
              {if $field->getOption('required')}*{/if}
         {elseif $field->widget=='text'}
              <div class="form-errors">{$form.extra[$form_name][$field_name]->getError()}</div>
              <textarea cols="{$field->cols}" rows="{$field->rows}" class="CustomerMeetingExtra Text" id="{$form_name}" name="{$field_name}">{$form.extra[$form_name][$field_name]}</textarea>  
         {elseif $field->widget=='boolean'}
             <div class="form-errors">{$form.extra[$form_name][$field_name]->getError()}</div>             
             <input type="checkbox" class="CustomerMeetingExtra Checkbox" id="{$form_name}" name="{$field_name}" {if $form.extra[$form_name][$field_name]->getValue()}checked=""{/if}/>{__('Yes/No')}
          {elseif $field->widget=='select'}
             select
         {/if}
         </div>
    {/foreach}          
{/foreach}   

<script type="text/javascript">
    
   $(".CustomerMeetingExtra").click(function() { $("#Save").show(); });
          
</script>    