{component name="/site/sublink"}
{messages class="Domoprime-errors"}
<h3>{__("ISO Settings")}</h3>
<div>
    <a href="#" id="Domoprime-Save" class="btn" style="display:none">
         <i class="fa fa-save" style=" margin-right: 10px"></i>{__('Save')}</a>
     <a href="#" id="Domoprime-Cancel" class="btn">
         <i class="fa fa-times" style=" margin-right: 10px"></i>{__('Cancel')}</a>
         {component name="/app_domoprime_iso/linkTransfer"}       
         {component name="/app_domoprime_iso/linkTransferContract"}       
         {component name="/app_domoprime_iso/linkConfiguration"}  
         {component name="/app_domoprime_iso/linkModels"}  
</div>   
 {if $form->hasValidator('mode')}
  <fieldset>    
     <legend> <h3>{__('Configuration')}</h3></legend>
      <table class="tab-form">            
      <tr class="full-with">
            <td class="label">
             {__('Mode')}
            </td>
            <td>                          
                    {html_options class="Domoprime-settings Select" name="mode" options=$form->mode->getOption('choices') selected=$settings->get('mode')}                                  
            </td>                           
        </tr>          
      </table>  
  </fieldset>      
{/if}
 {if $user->hasCredential([['superadmin']])}  
 <fieldset>
            <legend> <h3>{__('Engine')}</h3></legend>
            <table class="tab-form">
                 {if $form->hasValidator('coef_multiples')}
                    <tr class="full-with">
                        <td class="label">
                         {__('Multiple coefficients')}
                        </td>
                        <td>
                            <div class="error-form">{$form.coef_multiples->getError()}</div>
                            <input type="checkbox" class="Domoprime-settings Checkbox" value="true" name="coef_multiples" {if $settings->get('coef_multiples')}checked=""{/if}/>
                        </td>                           
                    </tr>
                    {/if}
            </table>
    </fieldset>
 {/if}           
<fieldset>    
     <legend> <h3>{__('Default values')}</h3></legend>
      <table class="tab-form">  
           {if $form->hasValidator('default_occupation_id')}
      <tr class="full-with">
            <td class="label">
             {__('Occupation')}
            </td>
            <td>
                <div class="error-form">{$form.default_occupation_id->getError()}</div>
                {html_options class="Domoprime-settings Select" name="default_occupation_id" options=$form->default_occupation_id->getOption('choices')  selected=$settings->get('default_occupation_id')}
            </td>                           
        </tr>
        {/if}
      </table>
</fieldset>      
<fieldset>    
     <legend> <h3>{__('Limits')}</h3></legend>
      <table class="tab-form">  
           {if $form->hasValidator('sales_limit')}
      <tr class="full-with">
            <td class="label">
             {__('Sales limit')}
            </td>
            <td>
                <div class="error-form">{$form.sales_limit->getError()}</div>
                <input type="text" class="Domoprime-settings Input" name="sales_limit" size="20" value="{$settings->get('sales_limit')}"/>
            </td>                           
        </tr>
        {/if}
        {if $form->hasValidator('fee_file')}
      <tr class="full-with">
            <td class="label">
             {__('Fee file')}
            </td>
            <td>
                <div class="error-form">{$form.fee_file->getError()}</div>
                <input type="text" class="Domoprime-settings Input" name="fee_file" size="20" value="{if $form->hasErrors()}{$settings->get('fee_file')}{else}{format_currency($settings->get('fee_file'),'EUR')}{/if}"/>
            </td>                           
        </tr>
        {/if}
         {if $form->hasValidator('tax_fee_file')}
      <tr class="full-with">
            <td class="label">
             {__('Tax fee file')}
            </td>
            <td>
                <div class="error-form">{$form.tax_fee_file->getError()}</div>
                <input type="text" class="Domoprime-settings Input" name="tax_fee_file" size="20" value="{if $form->hasErrors()}{$settings->get('tax_fee_file')}{else}{format_currency($settings->get('tax_fee_file'),'EUR')}{/if}"/>
            </td>                           
        </tr>
        {/if}
         {if $form->hasValidator('energy_filter')}
        <tr class="full-with">
            <td class="label">
             {__('Energies')}
            </td>
            <td>
                <div class="error-form">{$form.energy_filter->getError()}</div>
                {html_options class="Domoprime-settings Multiple" name="energy_filter" options=$form->energy_filter->getOption('choices') multiple="" selected=$settings->get('energy_filter')}
            </td>                           
        </tr>
        {/if}
         {if $form->hasValidator('class_filter')}
         <tr class="full-with">
            <td class="label">
             {__('Classes')}
            </td>
            <td>
                <div class="error-form">{$form.class_filter->getError()}</div>
                {html_options class="Domoprime-settings Multiple" name="class_filter" options=$form->class_filter->getOption('choices') multiple="" selected=$settings->get('class_filter')}
            </td>                           
        </tr>
        {/if}
    </table>
</fieldset> 
  {if $user->hasCredential([['superadmin']])}    
  <fieldset>
     <legend> <h3>{__('Others')}</h3></legend>
    <table class="tab-form">   
         {if $form->hasValidator('tax_credit')}
         <tr class="full-with">
            <td class="label">
             {__('Tax credit')}
            </td>
            <td>
                <div class="error-form">{$form.tax_credit->getError()}</div>
                <input type="checkbox" class="Domoprime-settings Checkbox" name="tax_credit"  value="YES" {if $settings->get('tax_credit')=='YES'}checked=""{/if}/>                 
            </td>                           
        </tr>  
        {/if}  
         {if $form->hasValidator('quotation_engine')}
         <tr class="full-with">
            <td class="label">
             {__('Quotation engine')}
            </td>
            <td>
                <div class="error-form">{$form.quotation_engine->getError()}</div>
                <input type="text" size="60" class="Domoprime-settings Input" name="quotation_engine"  value="{$settings->get('quotation_engine')}"/>                 
            </td>                           
        </tr>  
        {/if}  
         {if $form->hasValidator('simulation_engine')}
         <tr class="full-with">
            <td class="label">
             {__('Simulation engine')}
            </td>
            <td>
                <div class="error-form">{$form.simulation_engine->getError()}</div>
                <input type="text" size="60"  class="Domoprime-settings Input" name="simulation_engine"  value="{$settings->get('simulation_engine')}"/>                 
            </td>                           
        </tr>  
        {/if}
         {if $form->hasValidator('classic_class')}
         <tr class="full-with">
            <td class="label">
             {__('Classic class')}
            </td>
            <td>
                <div class="error-form">{$form.classic_class->getError()}</div>
                {html_options class="Domoprime-settings Select" name="classic_class" options=$form->classic_class->getOption('choices') selected=$settings->get('classic_class')}
            </td>                           
        </tr>
        {/if}
         {if $form->hasValidator('transfer_number_of_items')}
         <tr class="full-with">
            <td class="label">
             {__('Transfert form to request')}
            </td>
            <td>
                <div class="error-form">{$form.transfer_number_of_items->getError()}</div>
                <input type="text" class="Domoprime-settings Input" name="transfer_number_of_items" value="{$settings->get('transfer_number_of_items')}"/>                 
            </td>                           
        </tr>  
        {/if}          
    </table>
  </fieldset>   
            
{/if}
 <fieldset>
     <legend> <h3>{__('Documents')}</h3></legend>
    <table class="tab-form">           
         <tr class="full-with">
            <td class="label">
             {__('101 R1')}
            </td>
            <td>
                <div class="error-form">{$form.model_101_R1_id->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="model_101_R1_id" options=$form->model_101_R1_id->getOption('choices') selected=$settings->get('model_101_R1_id')}
            </td>                           
            <td class="label">
             {__('101 R1 Classic')}
            </td>
            <td>
                <div class="error-form">{$form.model_101_R1_classic_id->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="model_101_R1_classic_id" options=$form->model_101_R1_classic_id->getOption('choices') selected=$settings->get('model_101_R1_classic_id')}
            </td>
        </tr>        
         <tr class="full-with">
            <td class="label">
             {__('102 R1')}
            </td>
            <td>
                <div class="error-form">{$form.model_102_R1_id->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="model_102_R1_id" options=$form->model_102_R1_id->getOption('choices') selected=$settings->get('model_102_R1_id')}
            </td>                           
            <td class="label">
             {__('102 R1 Classic')}
            </td>
            <td>
                <div class="error-form">{$form.model_102_R1_classic_id->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="model_102_R1_classic_id" options=$form->model_102_R1_classic_id->getOption('choices') selected=$settings->get('model_102_R1_classic_id')}
            </td>
        </tr>
         <tr class="full-with">
            <td class="label">
             {__('103 R1')}
            </td>
            <td>
                <div class="error-form">{$form.model_103_R1_id->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="model_103_R1_id" options=$form->model_103_R1_id->getOption('choices') selected=$settings->get('model_103_R1_id')}
            </td>                           
               <td class="label">
             {__('103 R1 Classic')}
            </td>
            <td>
                <div class="error-form">{$form.model_103_R1_classic_id->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="model_103_R1_classic_id" options=$form->model_103_R1_classic_id->getOption('choices') selected=$settings->get('model_103_R1_classic_id')}
            </td> 
        </tr>
         <tr class="full-with">
            <td class="label">
             {__('101 102 R1')}
            </td>
            <td>
                <div class="error-form">{$form.model_101_102_R1_id->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="model_101_102_R1_id" options=$form->model_101_102_R1_id->getOption('choices') selected=$settings->get('model_101_102_R1_id')}
            </td>                           
            <td class="label">
             {__('101 102 R1 Classic')}
            </td>
            <td>
                <div class="error-form">{$form.model_101_102_R1_classic_id->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="model_101_102_R1_classic_id" options=$form->model_101_102_R1_classic_id->getOption('choices') selected=$settings->get('model_101_102_R1_classic_id')}
            </td>  
        </tr>
           <tr class="full-with">
            <td class="label">
             {__('101 103 R1')}
            </td>
            <td>
                <div class="error-form">{$form.model_101_103_R1_id->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="model_101_103_R1_id" options=$form->model_101_103_R1_id->getOption('choices') selected=$settings->get('model_101_103_R1_id')}
            </td>                           
             <td class="label">
             {__('101 103 R1 Classic')}
            </td>
            <td>
                <div class="error-form">{$form.model_101_103_R1_classic_id->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="model_101_103_R1_classic_id" options=$form->model_101_103_R1_classic_id->getOption('choices') selected=$settings->get('model_101_103_R1_classic_id')}
            </td> 
        </tr>
           <tr class="full-with">
            <td class="label">
             {__('102 103 R1')}
            </td>
            <td>
                <div class="error-form">{$form.model_102_103_R1_id->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="model_102_103_R1_id" options=$form->model_102_103_R1_id->getOption('choices') selected=$settings->get('model_102_103_R1_id')}
            </td>                           
             <td class="label">
             {__('102 103 R1 Classic')}
            </td>
            <td>
                <div class="error-form">{$form.model_102_103_R1_classic_id->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="model_102_103_R1_classic_id" options=$form->model_102_103_R1_classic_id->getOption('choices') selected=$settings->get('model_102_103_R1_classic_id')}
            </td> 
        </tr>
         <tr class="full-with">
            <td class="label">
             {__('101 102 103 R1')}
            </td>
            <td>
                <div class="error-form">{$form.model_101_102_103_R1_id->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="model_101_102_103_R1_id" options=$form->model_101_102_103_R1_id->getOption('choices') selected=$settings->get('model_101_102_103_R1_id')}
            </td>                           
             <td class="label">
             {__('101 102 103 R1 Classic')}
            </td>
            <td>
                <div class="error-form">{$form.model_101_102_103_R1_classic_id->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="model_101_102_103_R1_classic_id" options=$form->model_101_102_103_R1_classic_id->getOption('choices') selected=$settings->get('model_101_102_103_R1_classic_id')}
            </td> 
        </tr>
        
        
        <tr class="full-with">
            <td class="label">
             {__('101 R2')}
            </td>
            <td>
                <div class="error-form">{$form.model_101_R2_id->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="model_101_R2_id" options=$form->model_101_R2_id->getOption('choices') selected=$settings->get('model_101_R2_id')}
            </td>                           
             <td class="label">
             {__('101 R2 Classic')}
            </td>
            <td>
                <div class="error-form">{$form.model_101_R2_classic_id->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="model_101_R2_classic_id" options=$form->model_101_R2_classic_id->getOption('choices') selected=$settings->get('model_101_R2_classic_id')}
            </td>
        </tr>        
         <tr class="full-with">
            <td class="label">
             {__('102 R2')}
            </td>
            <td>
                <div class="error-form">{$form.model_102_R2_id->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="model_102_R2_id" options=$form->model_102_R2_id->getOption('choices') selected=$settings->get('model_102_R2_id')}
            </td>                           
             <td class="label">
             {__('102 R2 Classic')}
            </td>
            <td>
                <div class="error-form">{$form.model_102_R2_classic_id->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="model_102_R2_classic_id" options=$form->model_102_R2_classic_id->getOption('choices') selected=$settings->get('model_102_R2_classic_id')}
            </td> 
        </tr> 
        <tr class="full-with">
            <td class="label">
             {__('103 R2')}
            </td>
            <td>
                <div class="error-form">{$form.model_103_R2_id->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="model_103_R2_id" options=$form->model_103_R2_id->getOption('choices') selected=$settings->get('model_103_R2_id')}
            </td>                           
            <td class="label">
             {__('103 R2 Classic')}
            </td>
            <td>
                <div class="error-form">{$form.model_103_R2_classic_id->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="model_103_R2_classic_id" options=$form->model_103_R2_classic_id->getOption('choices') selected=$settings->get('model_103_R2_classic_id')}
            </td>  
        </tr>
          <tr class="full-with">
            <td class="label">
             {__('101 102 R2')}
            </td>
            <td>
                <div class="error-form">{$form.model_101_102_R2_id->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="model_101_102_R2_id" options=$form->model_101_102_R2_id->getOption('choices') selected=$settings->get('model_101_102_R2_id')}
            </td>                           
            <td class="label">
             {__('101 102 R2 Classic')}
            </td>
            <td>
                <div class="error-form">{$form.model_101_102_R2_classic_id->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="model_101_102_R2_classic_id" options=$form->model_101_102_R2_classic_id->getOption('choices') selected=$settings->get('model_101_102_R2_classic_id')}
            </td>  
        </tr>
           <tr class="full-with">
            <td class="label">
             {__('101 103 R2')}
            </td>
            <td>
                <div class="error-form">{$form.model_101_103_R1_id->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="model_101_103_R2_id" options=$form->model_101_103_R2_id->getOption('choices') selected=$settings->get('model_101_103_R2_id')}
            </td>                           
             <td class="label">
             {__('101 103 R2 Classic')}
            </td>
            <td>
                <div class="error-form">{$form.model_101_103_R1_classic_id->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="model_101_103_R2_classic_id" options=$form->model_101_103_R2_classic_id->getOption('choices') selected=$settings->get('model_101_103_R2_classic_id')}
            </td>   
        </tr>
           <tr class="full-with">
            <td class="label">
             {__('102 103 R2')}
            </td>
            <td>
                <div class="error-form">{$form.model_102_103_R2_id->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="model_102_103_R2_id" options=$form->model_102_103_R2_id->getOption('choices') selected=$settings->get('model_102_103_R2_id')}
            </td>                           
            <td class="label">
             {__('102 103 R2 Classic')}
            </td>
            <td>
                <div class="error-form">{$form.model_102_103_R2_classic_id->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="model_102_103_R2_classic_id" options=$form->model_102_103_R2_classic_id->getOption('choices') selected=$settings->get('model_102_103_R2_classic_id')}
            </td>  
        </tr>
         <tr class="full-with">
            <td class="label">
             {__('101 102 103 R2')}
            </td>
            <td>
                <div class="error-form">{$form.model_101_102_103_R2_id->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="model_101_102_103_R2_id" options=$form->model_101_102_103_R2_id->getOption('choices') selected=$settings->get('model_101_102_103_R2_id')}
            </td>                           
             <td class="label">
             {__('101 102 103 R2 Classic')}
            </td>
            <td>
                <div class="error-form">{$form.model_101_102_103_R2_classic_id->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="model_101_102_103_R2_classic_id" options=$form->model_101_102_103_R2_classic_id->getOption('choices') selected=$settings->get('model_101_102_103_R2_classic_id')}
            </td>  
        </tr>
    </table>
 </fieldset>    
 <fieldset>
     <legend> <h3>{__('Models')}</h3></legend>
    <table class="tab-form">  
         {if $form->hasValidator('quotation_model_id')}
         <tr class="full-with">
            <td class="label">
             {__('Quotation model')}
            </td>
            <td>
                <div class="error-form">{$form.quotation_model_id->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="quotation_model_id" options=$form->quotation_model_id->getOption('choices') selected=$settings->get('quotation_model_id')}
            </td>                           
        </tr>  
        {/if}
         {if $form->hasValidator('billing_model_id')}
        <tr class="full-with">
            <td class="label">
             {__('Quotation format')}
            </td>
            <td>
                <div class="error-form">{$form.quotation_reference_format->getError()}</div>
                <input type="text" class="Domoprime-settings Input" name="quotation_reference_format" size="40" value="{$settings->get('quotation_reference_format')}"/>
            </td>                           
        </tr>
        {/if}
         {if $form->hasValidator('billing_model_id')}
         <tr class="full-with">
            <td class="label">
             {__('Billing model')}
            </td>
            <td>
                <div class="error-form">{$form.billing_model_id->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="billing_model_id" options=$form->billing_model_id->getOption('choices') selected=$settings->get('billing_model_id')}
            </td>                           
        </tr>
        {/if}
         {if $form->hasValidator('billing_reference_format')}
        <tr class="full-with">
            <td class="label">
             {__('Billing format')}
            </td>
            <td>
                <div class="error-form">{$form.billing_reference_format->getError()}</div>
                <input type="text" class="Domoprime-settings Input" name="billing_reference_format" size="40" value="{$settings->get('billing_reference_format')}"/>
            </td>                           
        </tr>
        {/if}
         {if $form->hasValidator('asset_model_id')}
         <tr class="full-with">
            <td class="label">
             {__('Asset model')}
            </td>
            <td>
                <div class="error-form">{$form.asset_model_id->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="asset_model_id" options=$form->asset_model_id->getOption('choices') selected=$settings->get('asset_model_id')}
            </td>                           
        </tr>  
        {/if}
         {if $form->hasValidator('asset_reference_format')}
        <tr class="full-with">
            <td class="label">
             {__('Asset format')}
            </td>
            <td>
                <div class="error-form">{$form.asset_reference_format->getError()}</div>
                <input type="text" class="Domoprime-settings Input" name="asset_reference_format" size="40" value="{$settings->get('asset_reference_format')}"/>
            </td>                           
        </tr>
        {/if}
        {if $form->hasValidator('simulation_reference_format')}
        <tr class="full-with">
            <td class="label">
             {__('Simulation format')}
            </td>
            <td>
                <div class="error-form">{$form.simulation_reference_format->getError()}</div>
                <input type="text" class="Domoprime-settings Input" name="simulation_reference_format" size="40" value="{$settings->get('simulation_reference_format')}"/>
            </td>                           
        </tr>
        {/if}
          {if $form->hasValidator('premeeting_model_id')}
         <tr class="full-with">
            <td class="label">
             {__('Pre Meeting model')}
            </td>
            <td>
                <div class="error-form">{$form.premeeting_model_id->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="premeeting_model_id" options=$form->premeeting_model_id->getOption('choices') selected=$settings->get('premeeting_model_id')}
            </td>                           
        </tr>  
        {/if}
    </table>
             </fieldset>        
            <fieldset>
     <legend> <h3>{__('Quotation')}</h3></legend>
    <table class="tab-form">  
         {if $form->hasValidator('quotation_shift_for_dated_at')}
         <tr class="full-with">
            <td class="label">
             {__('Shift for date')}
            </td>
            <td>
                <div class="error-form">{$form.quotation_shift_for_dated_at->getError()}</div>
                <input type="text" class="Domoprime-settings Input" name="quotation_shift_for_dated_at" size="5" value="{$settings->get('quotation_shift_for_dated_at')}"/>                 
            </td>                           
        </tr>  
{/if}        
{if $form->hasValidator('pourcentage_advance')}
         <tr class="full-with">
            <td class="label">
             {__('Advance')}
            </td>
            <td>
                <div class="error-form">{$form.pourcentage_advance->getError()}</div>
                <input type="text" class="Domoprime-settings Input" name="pourcentage_advance" size="5" value="{format_pourcentage($settings->get('pourcentage_advance'))}"/>                 
            </td>                           
        </tr>  
{/if}  
{if $form->hasValidator('ana_tax')}
         <tr class="full-with">
            <td class="label">
             {__('ANA tax')}
            </td>
            <td>
                <div class="error-form">{$form.ana_tax->getError()}</div>
                <input type="text" class="Domoprime-settings Input" name="ana_tax" size="5" value="{format_currency($settings->get('ana_tax','EUR'))}"/>                 
            </td>                           
        </tr>  
{/if}
    </table>
             </fieldset>   
              <fieldset>
     <legend> <h3>{__('Billing')}</h3></legend>
    <table class="tab-form">  
         {if $form->hasValidator('multiple_billings_max')}
         <tr class="full-with">
            <td class="label">
             {__('Maximum billings for multiple PDF genenration')}
            </td>
            <td>
                <div class="error-form">{$form.multiple_billings_max->getError()}</div>
                <input type="text" class="Domoprime-settings Input" name="multiple_billings_max" size="5" value="{$settings->get('multiple_billings_max')}"/>                 
            </td>                           
        </tr>      
        {/if}
        {if $form->hasValidator('billing_email_model_id')}
         <tr class="full-with">
            <td class="label">
             {__('Email model for customer')}
            </td>
            <td>
                <div class="error-form">{$form.billing_email_model_id->getError()}</div>
                  {html_options class="Domoprime-settings Select" name="billing_email_model_id" options=$form->billing_email_model_id->getOption('choices') selected=$settings->get('billing_email_model_id')}           
            </td>                           
        </tr>      
        {/if}
    </table>
             </fieldset>   
  {if $user->hasCredential([['superadmin']])}        
<fieldset>
     <legend> <h3>{__('Report')}</h3></legend>
    <table class="tab-form">  
         {if $form->hasValidator('install_in_progess_status_id')}
         <tr class="full-with">
            <td class="label">
             {__('Install in progress status')}
            </td>
            <td>
                <div class="error-form">{$form.install_in_progess_status_id->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="install_in_progess_status_id" options=$form->install_in_progess_status_id->getOption('choices') selected=$settings->get('install_in_progess_status_id')}
            </td>                           
        </tr>  
{/if}        
    </table>
             </fieldset> 
{/if}            
 
 <fieldset>
     <legend> <h3>{__('Archivage')}</h3></legend>
    <table class="tab-form">  
         {if $form->hasValidator('ah_archivage')}
         <tr class="full-with">
            <td class="label">
             {__('AH')}
            </td>
            <td>
                <div class="error-form">{$form.ah_archivage->getError()}</div>
                <input type="checkbox" class="Domoprime-settings Checkbox" name="ah_archivage"  value="YES" {if $settings->get('ah_archivage')=='YES'}checked=""{/if}/>                 
            </td>                           
        </tr>  
        {/if}       
 {if $form->hasValidator('quotation_archivage')}
         <tr class="full-with">
            <td class="label">
             {__('Quotation')}
            </td>
            <td>
                <div class="error-form">{$form.quotation_archivage->getError()}</div>
                <input type="checkbox" class="Domoprime-settings Checkbox" name="quotation_archivage"  value="YES" {if $settings->get('quotation_archivage')=='YES'}checked=""{/if}/>                 
            </td>                           
        </tr>  
{/if}    
{if $form->hasValidator('billing_archivage')}
         <tr class="full-with">
            <td class="label">
             {__('Billing')}
            </td>
            <td>
                <div class="error-form">{$form.billing_archivage->getError()}</div>
                <input type="checkbox" class="Domoprime-settings Checkbox" name="billing_archivage"  value="YES" {if $settings->get('billing_archivage')=='YES'}checked=""{/if}/>                 
            </td>                           
        </tr>  
{/if}  
{if $form->hasValidator('premeeting_archivage')}
         <tr class="full-with">
            <td class="label">
             {__('Pre meeting')}
            </td>
            <td>
                <div class="error-form">{$form.premeeting_archivage->getError()}</div>
                <input type="checkbox" class="Domoprime-settings Checkbox" name="premeeting_archivage"  value="YES" {if $settings->get('premeeting_archivage')=='YES'}checked=""{/if}/>                 
            </td>                           
        </tr>  
{/if}
{if $form->hasValidator('verif_archivage')}
         <tr class="full-with">
            <td class="label">
             {__('Verif fiscal')}
            </td>
            <td>
                <div class="error-form">{$form.verif_archivage->getError()}</div>
                <input type="checkbox" class="Domoprime-settings Checkbox" name="verif_archivage"  value="YES" {if $settings->get('verif_archivage')=='YES'}checked=""{/if}/>                 
            </td>                           
        </tr>  
{/if}
{if $form->hasValidator('signed_verif_archivage')}
         <tr class="full-with">
            <td class="label">
             {__('Signed Verif fiscal')}
            </td>
            <td>
                <div class="error-form">{$form.signed_verif_archivage->getError()}</div>
                <input type="checkbox" class="Domoprime-settings Checkbox" name="signed_verif_archivage"  value="YES" {if $settings->get('signed_verif_archivage')=='YES'}checked=""{/if}/>                 
            </td>                           
        </tr>  
{/if}
{if $form->hasValidator('multi_documents_archivage')}
         <tr class="full-with">
            <td class="label">
             {__('Multi document (AH/Quotation/Billing)')}
            </td>
            <td>
                <div class="error-form">{$form.multi_documents_archivage->getError()}</div>
                <input type="checkbox" class="Domoprime-settings Checkbox" name="multi_documents_archivage"  value="YES" {if $settings->get('multi_documents_archivage')=='YES'}checked=""{/if}/>                 
            </td>                           
        </tr>  
{/if} 

    </table>
             </fieldset> 

       
<script type="text/javascript">        
            
   
                 
         $(".Domoprime-settings.Input,.Domoprime-settings.Checkbox,.Domoprime-settings.Select,.Domoprime-settings.Multiple").click(function(){         
             $(".Domoprime-errors").messagesManager('clear');
             $("#Domoprime-Save").show();        
         });
         
         $(".Domoprime-settings.Select,.Domoprime-settings.Multiple").change(function(){
            $(".Domoprime-errors").messagesManager('clear');
            $("#Domoprime-Save").show();        
         });
         
         $('#Domoprime-Save').click(function(){ 
          var  params= { Settings: {  token :'{$form->getCSRFToken()}' } };
          $(".Domoprime-settings.Input").each(function(id) { params.Settings[this.name]=$(this).val(); });                             
          $(".Domoprime-settings.Checkbox:checked").each(function(id) { params.Settings[this.name]=$(this).val(); });                             
          $(".Domoprime-settings.Select option:selected").each(function() { params.Settings[$(this).parent().attr('name')]=$(this).val(); });                             
          $(".Domoprime-settings.Multiple option:selected").each(function() { 
              if (!params.Settings[$(this).parent().attr('name')])
                params.Settings[$(this).parent().attr('name')]=[];
              params.Settings[$(this).parent().attr('name')].push($(this).val()); 
          });                             
             return $.ajax2({ data : params,                            
                           errorTarget: ".Domoprime-errors",
                           loading: "#tab-site-dashboard-x-settings-loading",
                           url: "{url_to('app_domoprime_iso_ajax',['action'=>'Settings'])}",
                           target: "#tab-dashboard-x-settings"}); 
         });

         $('#Domoprime-Cancel').click(function(){ 
                return $.ajax2({ url:"{url_to('site_ajax',['action'=>'Home'])}",
                                 target: "#tab-dashboard-x-settings" ,
                                 errorTarget: ".Domoprime-errors",
                                 loading: "#tab-site-dashboard-x-settings-loading",
                              }); 
        });
        
        
      
</script>