{component name="/site/sublink"}
<div id="actions">
{messages class="Domoprime-errors"}
<h3>{__("ISO Settings")}</h3>
<div>
    <a href="#" id="Domoprime-Save" class="btn" style="display:none">
         <i class="fa fa-save" style=" margin-right: 10px"></i>{__('Save')}</a>
     <a href="#" id="Domoprime-Cancel" class="btn">
         <i class="fa fa-times" style=" margin-right: 10px"></i>{__('Cancel')}</a>
      {if $user->hasCredential([['superadmin_debug']])}   
          <a href="#" id="Domoprime-System" class="btn">
         <i class="fa fa-cog" style=" margin-right: 10px"></i>{__('System')}</a>
         {/if}
</div>     
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
    <fieldset>
    <legend> <h3>{__('Surface')}</h3></legend>
    <table class="tab-form">     
        {if $form->hasValidator('surface_wall_formfield')}
        <tr class="full-with">
            <td class="label">
             {__('Surface Wall form field')}
            </td>
            <td>
                <div class="error-form">{$form.surface_wall_formfield->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="surface_wall_formfield" options=$form->surface_wall_formfield->getOption('choices') selected=$settings->get('surface_wall_formfield')}
                 {html_options class="Domoprime-settings Select" name="surface_wall_product" options=$form->surface_wall_product->getOption('choices') selected=$settings->get('surface_wall_product')}
            </td>                           
        </tr>  
        {/if}
         {if $form->hasValidator('surface_floor_formfield')}
         <tr class="full-with">
            <td class="label">
             {__('Surface Floor form field')}
            </td>
            <td>
                <div class="error-form">{$form.surface_floor_formfield->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="surface_floor_formfield" options=$form->surface_floor_formfield->getOption('choices') selected=$settings->get('surface_floor_formfield')}
                 {html_options class="Domoprime-settings Select" name="surface_floor_product" options=$form->surface_floor_product->getOption('choices') selected=$settings->get('surface_floor_product')}
            </td>                           
        </tr>
        {/if}
        {if $form->hasValidator('surface_top_formfield')}
        <tr class="full-with">
            <td class="label">
             {__('Surface Top form field')}
            </td>
            <td>
                <div class="error-form">{$form.surface_top_formfield->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="surface_top_formfield" options=$form->surface_top_formfield->getOption('choices') selected=$settings->get('surface_top_formfield')}
                 {html_options class="Domoprime-settings Select" name="surface_top_product" options=$form->surface_top_product->getOption('choices') selected=$settings->get('surface_top_product')}
            </td>                           
        </tr>
         {/if}        
    </table>                           
            </fieldset>    
          
            <fieldset>
     <legend> <h3>{__('Energies')}</h3></legend>
    <table class="tab-form">    
         {if $form->hasValidator('energy_formfield')}
        <tr class="full-with">
         <tr class="full-with">
            <td class="label">
             {__('Energy form field')}
            </td>
            <td>
                <div class="error-form">{$form.energy_formfield->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="energy_formfield" options=$form->energy_formfield->getOption('choices') selected=$settings->get('energy_formfield')}
                {* <a href="#" id="" class=""><i class="fa fa-times" style=" margin-right: 10px"></i>{__('Values')}</a> *}
                 <table class="tab-form">
                     {foreach $form->getEnergyI18nFields() as $item}
                     <tr class="full-with">
                         <td class="label">
                             {$item}  => 
                         </td>
                         <td>
                            {html_options class="Domoprime-settings Select" name="energy_`$item->get('energy_id')`" options=$form->getValidator("energy_`$item->get('energy_id')`")->getOption('choices') selected=$settings->get("energy_`$item->get('energy_id')`")}                              
                         </td>
                     </tr>
                     {/foreach}
                 </table>
            </td>                           
        </tr> 
        {/if}
        </table>
  </fieldset>   
                 

   {*         <fieldset>
     <legend> <h3>{__('Energy old')}</h3></legend>
    <table class="tab-form">    
         <tr class="full-with">
            <td class="label">
             {__('Energy form field')}
            </td>
            <td>
                <div class="error-form">{$form.energy_formfield->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="energy_formfield" options=$form->energy_formfield->getOption('choices') selected=$settings->get('energy_formfield')}               
                 <table>
                     {foreach $form->getEnergyFields() as $name=>$field}
                     <tr>
                         <td>
                             {__($field)}
                         </td>
                         <td>
                             <div>
                             <div class="error-form">{$form[$field]->getError()}</div>
                             Form: {html_options class="Domoprime-settings Select" name="{$field}" options=$form->getValidator($field)->getOption('choices') selected=$settings->get($field)}  =>
                             </div>                           
                             <div>
                             Energy: {html_options class="Domoprime-settings Select" name="{$name}" options=$form->getValidator($name)->getOption('choices') selected=$settings->get($name)}
                             </div>
                         </td>
                     </tr>
                     {/foreach}
                 </table>
            </td>                           
        </tr>       
        </table>
  </fieldset>     *}   
  
  <fieldset>
     <legend> <h3>{__('Occupation')}</h3></legend>
    <table class="tab-form">  
         {if $form->hasValidator('owner_formfield')}
         <tr class="full-with">
            <td class="label">
             {__('Owner form field')}
            </td>
            <td>
                <div class="error-form">{$form.owner_formfield->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="owner_formfield" options=$form->owner_formfield->getOption('choices') selected=$settings->get('owner_formfield')}
                 {* <a href="#" id="" class=""><i class="fa fa-times" style=" margin-right: 10px"></i>{__('Values')}</a> *}
                <table>
                     {foreach $form->getOwnerFields() as $field}
                     <tr>
                         <td>
                             {__($field)}
                         </td>
                         <td>
                              <div class="error-form">{$form[$field]->getError()}</div>
                             {html_options class="Domoprime-settings Select" name="{$field}" options=$form->getValidator($field)->getOption('choices') selected=$settings->get($field)}
                         </td>
                     </tr>
                     {/foreach}
                 </table>
            </td>                           
        </tr>
        {/if}
    </table>
</fieldset>
    
{/if}
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
                <input type="text" class="Domoprime-settings Input" name="fee_file" size="20" value="{$settings->get('fee_file')}"/>
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
         {if $form->hasValidator('number_of_people_formfield')}
         <tr class="full-with">
            <td class="label">
             {__('Number of people form field')}
            </td>
            <td>
                <div class="error-form">{$form.number_of_people_formfield->getError()}</div>
                 {html_options class="Domoprime-settings Select" name="number_of_people_formfield" options=$form->number_of_people_formfield->getOption('choices') selected=$settings->get('number_of_people_formfield')}
            </td>                           
        </tr>  
        {/if}
         {if $form->hasValidator('revenue_formfield')}
         <tr class="full-with">
            <td class="label">
             {__('Revenue form field')}
            </td>
            <td>
                <div class="error-form">{$form.revenue_formfield->getError()}</div>
                {html_options class="Domoprime-settings Select" name="revenue_formfield" options=$form->revenue_formfield->getOption('choices') selected=$settings->get('revenue_formfield')}
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
    </table>
  </fieldset>   
            
{/if}
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
         {if $form->hasValidator('quotation_reference_format')}
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
                           url: "{url_to('app_domoprime_ajax',['action'=>'Settings'])}",
                           target: "#tab-dashboard-x-settings"}); 
         });

         $('#Domoprime-Cancel').click(function(){ 
                return $.ajax2({ url:"{url_to('site_ajax',['action'=>'Home'])}",
                                 target: "#tab-dashboard-x-settings" ,
                                 loading: "#tab-site-dashboard-x-settings-loading",
                              }); 
        });
        
        $('#Domoprime-System').click(function(){                           
             return $.ajax2({ errorTarget: ".Domoprime-errors",
                           url: "{url_to('app_domoprime_ajax',['action'=>'System'])}",
                           loading: "#tab-site-dashboard-x-settings-loading",
                           target: "#actions"}); 
         });
</script>
</div>