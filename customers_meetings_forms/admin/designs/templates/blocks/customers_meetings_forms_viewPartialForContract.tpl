   {if $contract->isHold()}   
    {foreach $form->extra->getSchema() as $form_name=>$schema}   
         <legend><h3>{$schema->getRequest()}</h3></legend>       
         <table class="tab-form">
            {foreach $schema->getSchema() as $field_name=>$field}                
                <tr>             
                    <td class="label">{$field->getRequest()}      
                    </td>
                    <td>
                     {if $field->widget=='input'}                          
                          <input disabled="" readonly="" type="text"  size="{$field->getSize()}" value="{$form.extra[$form_name][$field_name]}"/>                       
                     {elseif $field->widget=='text'}                     
                          <textarea disabled="" readonly="" cols="{$field->cols}" rows="{$field->rows}">{$form.extra[$form_name][$field_name]}</textarea>  
                     {elseif $field->widget=='boolean'}                     
                         <input disabled="" readonly="" type="checkbox" class="" {if $form.extra[$form_name][$field_name]->getValue()}checked=""{/if}/>{__('Yes/No')}
                       {elseif $field->widget=='select'}                     
                         {html_options disabled="" readonly="" class="Select"  name=$field_name options=$field->getOption('choices') selected=$form.extra[$form_name][$field_name]->getValue()}                     
                      {elseif $field->widget=='checkbox'}                       
                           {if $field->getOption('multiple')}
                                {foreach $field->getOption('choices')  as $name=>$choice}                        
                                    {$choice}<input disabled="" readonly="" type="checkbox" value="{$name}" {if in_array($name,(array)$form.extra[$form_name][$field_name]->getValue())}checked=""{/if}/>
                                {/foreach}   
                           {else}                     
                                {foreach $field->getOption('choices')  as $name=>$choice}                        
                                    {$choice}<input disabled="" readonly="" type="radio" value="{$name}" {if $form.extra[$form_name][$field_name]->getValue()==$name}checked=""{/if}/>
                                {/foreach}                            
                            {/if}
                     {/if}
                    </td>
                </tr>
            {/foreach}            
            </table>
    {/foreach}    
    {else}         
{foreach $form->extra->getSchema() as $form_name=>$schema}               
    <legend><h3>{$schema->getRequest()}</h3></legend>          
    <table class="tab-form">           
                 {if $form_name=='poseur'}
                      <tr>
            <td>
        {component name="/partners_layer/SelectWithContactsForFormsFromViewContract" layer=$form.extra['poseur']['nom']}
            </td>
            <td></td>
                      </tr>
    {/if}            
        </tr>
        {foreach $schema->getSchema() as $field_name=>$field}
            <tr>             
                <td class="label">
                    {$field->getRequest()}                     
                   {if $form_name=='iso' && $field_name=='REFERENCEDELAVIS1'}
                       {component name="/services_impot_verif/ButtonScreenShotForField1ForViewContract"}
                   {elseif $form_name=='iso' && $field_name=='REFERENCEDELAVIS2'}
                      {component name="/services_impot_verif/ButtonScreenShotForField2ForViewContract"}
                      {component name="/services_impot_verif/ButtonForOtherForViewContract"}                 
                   {/if}  
                </td>
                <td>
             {if $field->widget=='input'}     
                  <div class="form-errors">{$form.extra[$form_name][$field_name]->getError()}</div>
                  <input type="text" size="{$field->getSize()}" class="CustomerMeetingPartialForContractExtra-{$contract->get('id')} Input" id="{$form_name}" name="{$field_name}" value="{$form.extra[$form_name][$field_name]}"/>  
                  {if $field->getOption('required')}*{/if}
             {elseif $field->widget=='text'}
                  <div class="form-errors">{$form.extra[$form_name][$field_name]->getError()}</div>
                  <textarea cols="{$field->cols}" rows="{$field->rows}" class="CustomerMeetingPartialForContractExtra-{$contract->get('id')} Text" id="{$form_name}" name="{$field_name}">{$form.extra[$form_name][$field_name]}</textarea>  
             {elseif $field->widget=='boolean'}
                 <div class="form-errors">{$form.extra[$form_name][$field_name]->getError()}</div>             
                 <input type="checkbox" class="CustomerMeetingPartialForContractExtra-{$contract->get('id')} Checkbox" id="{$form_name}" name="{$field_name}" {if $form.extra[$form_name][$field_name]->getValue()}checked=""{/if}/>{__('Yes/No')}
               {elseif $field->widget=='select'}
                 <div class="form-errors">{$form.extra[$form_name][$field_name]->getError()}</div>  
                 {html_options class="CustomerMeetingPartialForContractExtra-`$contract->get('id')` Select" id=$form_name name=$field_name options=$field->getOption('choices') selected=$form.extra[$form_name][$field_name]->getValue()}
                 {if $field->getOption('required')}*{/if}
              {elseif $field->widget=='checkbox'}
                    <div class="form-errors">{$form.extra[$form_name][$field_name]->getError()}</div>  
                   {if $field->getOption('multiple')}
                        {foreach $field->getOption('choices')  as $name=>$choice}                        
                            {$choice}<input type="checkbox" class="CustomerMeetingPartialForContractExtra-{$contract->get('id')} Multiple" id="{$form_name}" name="{$form_name}-{$field_name}" value="{$name}" {if in_array($name,$form.extra[$form_name][$field_name]->getValue())}checked=""{/if}/>
                        {/foreach}   
                   {else}                     
                        {foreach $field->getOption('choices')  as $name=>$choice}                        
                            {$choice}<input type="radio" class="CustomerMeetingPartialForContractExtra-{$contract->get('id')} Radio" id="{$form_name}" name="{$form_name}-{$field_name}" value="{$name}" {if $form.extra[$form_name][$field_name]->getValue()==$name}checked=""{/if}/>
                        {/foreach}
                        {if $field->getOption('required')}*{/if}
                    {/if} 
             {/if}
                </td>
            </tr>
        {/foreach}     
         </table>
{/foreach}           
<script type="text/javascript">      
    
    $("#CustomerContract-Save-{$contract->get('id')}").on('parameters', function (event,params) {         
     params.Contract.extra= { };
$(".CustomerMeetingPartialForContractExtra-{$contract->get('id')}.Input,.CustomerMeetingPartialForContractExtra-{$contract->get('id')}.Text").each(function() { 
    if (typeof params.Contract.extra[$(this).attr('id')] == 'undefined' )
        params.Contract.extra[$(this).attr('id')]={ };  
    params.Contract.extra[$(this).attr('id')][$(this).attr('name')]=$(this).val();
});

$(".CustomerMeetingPartialForContractExtra-{$contract->get('id')}.Checkbox:checked").each(function() { 
    if (typeof params.Contract.extra[$(this).attr('id')] == 'undefined' )
        params.Contract.extra[$(this).attr('id')]={ };  
    params.Contract.extra[$(this).attr('id')][$(this).attr('name')]=1;
});

$(".CustomerMeetingPartialForContractExtra-{$contract->get('id')}.Select option:selected").each(function() { 
    if (typeof params.Contract.extra[$(this).parent().attr('id')] == 'undefined' )
        params.Contract.extra[$(this).parent().attr('id')]={ };  
    params.Contract.extra[$(this).parent().attr('id')][$(this).parent().attr('name')]=$(this).val();
});

$(".CustomerMeetingPartialForContractExtra-{$contract->get('id')}.Radio:checked").each(function() { 
    if (typeof params.Contract.extra[$(this).attr('id')] == 'undefined' )
        params.Contract.extra[$(this).attr('id')]={ };     
        params.Contract.extra[$(this).attr('id')][$(this).attr('name').replace($(this).attr('id')+'-','')]=$(this).val();        
}); 
    });
    
    $(".CustomerMeetingPartialForContractExtra-{$contract->get('id')}").click(function () { 
        $("#CustomerContract-Save-{$contract->get('id')}").show();
    });
</script>    


{component name="/services_impot_verif/checkNumberOfFiscalForViewContract"}

{/if}