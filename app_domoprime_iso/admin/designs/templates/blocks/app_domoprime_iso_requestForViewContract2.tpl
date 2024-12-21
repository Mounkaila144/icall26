{if $contract->isHold()}  
   <fieldset >
     <legend> <h3>{__('Home information')}</h3></legend>   

        <fieldset class="tab-form tab-form-3-columns" style="width: auto;" >
         <legend> <h3>{__('Fiscal')}</h3></legend> 
         <table>
               <tr>
                    <td class="label">{__('Number of people')}
                    </td>
                    <td>                      
                        <input type="text" disabled="" class="red-input" value="{format_number($iso->get('number_of_people'),"#")}" />
                    </td>                  
                </tr>                     
                  <tr>
                    <td class="label">{__('Number of children')}
                    </td>
                    <td>                      
                        <input type="text" disabled="" value="{format_number($iso->get('number_of_children'),"#")}"/>
                    </td>                  
                </tr> 
                 <tr>
                    <td class="label">{__('Revenue')}
                    </td>
                    <td>                          
                        <input type="text" disabled="" class="red-input" value="{format_number($iso->get('revenue'),"#.00")}" />
                    </td>                  
                </tr>                            
                 <tr>
                    <td class="label">{__('Number of fiscal')}
                    </td>
                    <td>                          
                        <input type="text" disabled="" class="red-input" value="{format_number($iso->get('number_of_fiscal'),"#")}" />
                    </td>                  
                </tr> 
                <tr>
                    <td class="label">{__('Tax credit used')}
                    </td>
                    <td>                              
                         <input type="text" disabled="" value="{format_number($iso->get('tax_credit_used'),"#.00")}"/>
                    </td>                  
                </tr> 
                <tr>
                    <td class="label">{__('Declarants')}
                    </td>
                    <td>                         
                        <input type="text" disabled=""  value="{$iso->get('declarants')}"/>
                    </td>                  
                </tr>
         </table>    
         </fieldset>
     
     <fieldset class="tab-form tab-form-3-columns" style="width: auto;" >
         <legend> <h3>{__('Home')}</h3></legend>  
         <table> 
                <tr>
                    <td class="label">{__('Surface 101')}
                    </td>
                    <td>                          
                        <input type="text" disabled="" class="red-input" value="{format_number($iso->get('surface_top'),"#")}" /> {if $iso->get('src_surface_top')}({format_number($iso->get('src_surface_top'),"#")}){/if}
                    </td>                  
                </tr>                              
                <tr>
                    <td class="label">{__('Surface 102')}
                    </td>
                    <td>                    
                        <input type="text"  disabled="" class="red-input" value="{format_number($iso->get('surface_wall'),"#")}" /> {if $iso->get('src_surface_wall')}({format_number($iso->get('src_surface_wall'),"#")}){/if}
                    </td>                  
                </tr>                           
                 <tr>
                    <td class="label">{__('Surface 103')}
                    </td>
                    <td>                           
                        <input type="text" disabled="" class="red-input"  value="{format_number($iso->get('surface_floor'),"#")}" /> {if $iso->get('src_surface_floor')}({format_number($iso->get('src_surface_floor'),"#")}){/if}
                    </td>                  
                </tr>  
                 {if $form->iso2->hasValidator('item_top')}
                <tr>
                    <td class="label">{__('Article 101')}
                    </td>
                    <td>                           
                        {html_options name="item_top" options=$form->iso2.item_top->getChoices() selected=$form.iso2.item_top}
                    </td>                  
                </tr>
                {/if}
                  {if $form->iso2->hasValidator('item_wall')}
                <tr>
                    <td class="label">{__('Article 102')}
                    </td>
                    <td>                       
                        {html_options name="item_wall" options=$form->iso2.item_wall->getChoices() selected=$form.iso2.item_wall}
                    </td>                  
                </tr>
                {/if}              
                 {if $form->iso2->hasValidator('item_floor')}
                <tr>
                    <td class="label">{__('Article 103')}
                    </td>
                    <td>                         
                       {html_options name="item_floor" options=$form->iso2.item_floor->getChoices() selected=$form.iso2.item_floor}
                    </td>                  
                </tr>
                {/if}
                <tr>
                    <td class="label">{__('Energy')}
                    </td>
                    <td>                             
                       <input type="text" disabled=""  value="{$iso->getEnergy()->getI18n()}"/>       
                    </td>                  
                </tr>                    
                 <tr>
                    <td class="label">{__('Occupation')}
                    </td>
                    <td>                            
                        <input type="text" disabled=""  value="{$iso->getOccupation()->getI18n()}"/>                         
                    </td>                  
                </tr>                         
                 <tr>
                    <td class="label">{__('More 2 years')}
                    </td>
                    <td>                            
                        {html_options disabled="" name="more_2_years" options=$form->iso2.more_2_years->getOption('choices') selected=$iso->get('more_2_years')}                         
                    </td>                  
                </tr>  
                <tr>
                    <td class="label">{__('Parcel reference')}
                    </td>
                    <td>                           
                        <input type="text" disabled="" class="red-input" value="{$iso->get('parcel_reference')}" />
                    </td>                  
                </tr> 
                <tr>
                    <td class="label">{__('Parcel surface')}
                    </td>
                    <td>                          
                        <input type="text" disabled="" class="red-input" value="{format_number($iso->get('parcel_surface'),"#")}" />
                    </td>                  
                </tr>  
                <tr>
                    <td class="label">{__('Type layer')}
                    </td>
                    <td>                            
                        <input type="text" disabled=""  value="{$iso->getType()->getI18n()}"/>
                    </td>                  
                </tr>    
                {if $user->hasCredential([['app_domoprime_iso2_view_display_pricing']])}
                <tr>
                    <td class="label">{__('Pricing')}
                    </td>
                    <td>                            
                        <input type="text" disabled=""  value="{$iso->getPricing()}"/>
                    </td>                  
                </tr>      
                {/if}
         </table>
     </fieldset>
     <fieldset class="tab-form tab-form-3-columns" style="width: auto;">
         <legend> <h3>{__('Surfaces Installateur')}</h3></legend> 
         <table>
                <tr>
                    <td class="label">{__('Install surface 101')}
                    </td>
                    <td>                         
                        <input type="text" disabled="" value="{format_number($iso->get('install_surface_top'),"#")}"/>
                    </td>                  
                </tr>                                
                <tr>
                    <td class="label">{__('Install surface 102')}
                    </td>
                    <td>                           
                        <input type="text"  disabled="" value="{format_number($iso->get('install_surface_wall'),"#")}"/>
                    </td>                  
                </tr>                    
                 <tr>
                    <td class="label">{__('Install surface 103')}
                    </td>
                    <td>                          
                        <input type="text" disabled="" value="{format_number($iso->get('install_surface_floor'),"#")}"/>
                    </td>                  
                </tr>  
         </table>
    </fieldset>                                        
     
   </fieldset>
    
{else}    
 <fieldset>
     <legend> <h3>{__('Home information')}</h3></legend>  
             <fieldset class="tab-form tab-form-3-columns" style="width: auto;" >
         <legend> <h3>{__('Fiscal')}</h3></legend>  
         <table> 
                {if $form->iso2->hasValidator('number_of_people')}
                 <tr>
                    <td class="label">{__('Number of people')}{if $form->iso2.number_of_people->getOption('required')}*{/if}
                    </td>
                    <td> 
                        <div class="error-form">{$form.iso2.number_of_people->getError()}</div>
                        <input type="text" class="CustomerContractIso2-{$contract->get('id')} Input red-input" name="number_of_people" value="{format_number($iso->get('number_of_people'),"#")}" />                        
                    </td>                  
                </tr>
                {/if}
                 {if $form->iso2->hasValidator('number_of_children')}
                 <tr>
                    <td class="label">{__('Number of children')}{if $form->iso2.number_of_children->getOption('required')}*{/if}
                    </td>
                    <td> 
                        <div class="error-form">{$form.iso2.number_of_children->getError()}</div>
                        <input type="text" class="CustomerContractIso2-{$contract->get('id')} Input" name="number_of_children" value="{format_number($iso->get('number_of_children'),"#")}"/>                         
                    </td>                  
                </tr>
                {/if}
                {if $form->iso2->hasValidator('revenue')}
                 <tr>
                    <td class="label">{__('Revenue')}{if $form->iso2.revenue->getOption('required')}*{/if}
                    </td>
                    <td>  
                         <div class="error-form">{$form.iso2.revenue->getError()}</div>
                        <input type="text" class="CustomerContractIso2-{$contract->get('id')} Input red-input" name="revenue" value="{format_number($iso->get('revenue'),"#.00")}" />                        
                    </td>                  
                </tr>
                {/if}
                {if $form->iso2->hasValidator('number_of_fiscal')}
                 <tr>
                    <td class="label">{__('Number of fiscal')}{if $form->iso2.number_of_fiscal->getOption('required')}*{/if}
                    </td>
                    <td>     
                         <div class="error-form">{$form.iso2.number_of_fiscal->getError()}</div>
                        <input type="text" class="CustomerContractIso2-{$contract->get('id')} Input red-input" name="number_of_fiscal" value="{format_number($iso->get('number_of_fiscal'),"#")}" />                      
                    </td>                  
                </tr>
                {/if}
                {if $form->iso2->hasValidator('tax_credit_used')}
                 <tr>
                    <td class="label">{__('Tax credit used')}{if $form->iso2.tax_credit_used->getOption('required')}*{/if}
                    </td>
                    <td>  
                         <div class="error-form">{$form.iso2.tax_credit_used->getError()}</div>
                        <input type="text" class="CustomerContractIso2-{$contract->get('id')} Input" name="tax_credit_used" value="{format_number($iso->get('tax_credit_used'),"#.00")}"/>                       
                    </td>                  
                </tr>
                {/if}
                {if $form->iso2->hasValidator('declarants')}
                 <tr>
                    <td class="label">{__('Declarants')}{if $form->iso2.declarants->getOption('required')}*{/if}
                    </td>
                    <td>   
                        <div class="error-form">{$form.iso2.declarants->getError()}</div>
                        <input type="text" class="CustomerContractIso2-{$contract->get('id')} Input" name="declarants" value="{$iso->get('declarants')}"/>                         
                    </td>                  
                </tr>
                {/if}
         </table>
        </fieldset>
        <fieldset class="tab-form tab-form-3-columns" style="width: auto;">
         <legend> <h3>{__('Home')}</h3></legend>  
         <table> 
                {if $form->iso2->hasValidator('surface_top')}
                <tr>
                    <td class="label">{__('Surface 101')}{if $form->iso2.surface_top->getOption('required')}*{/if}
                    </td>
                    <td>   
                        <div class="error-form">{$form.iso2.surface_top->getError()}</div>
                        <input type="text" class="CustomerContractIso2-{$contract->get('id')} Input red-input" name="surface_top" value="{format_number($iso->get('surface_top'),"#")}" />  {if $iso->get('src_surface_top')}({format_number($iso->get('src_surface_top'),"#")}){/if}
                    </td>                  
                </tr>
                {/if}                  
                
                {if $form->iso2->hasValidator('surface_wall')}
                <tr>
                    <td class="label">{__('Surface 102')}{if $form->iso2.surface_wall->getOption('required')}*{/if}
                    </td>
                    <td>     
                        <div class="error-form">{$form.iso2.surface_wall->getError()}</div>
                        <input type="text" class="CustomerContractIso2-{$contract->get('id')} Input red-input" name="surface_wall" value="{format_number($iso->get('surface_wall'),"#")}" />{if $iso->get('src_surface_wall')}({format_number($iso->get('src_surface_wall'),"#")}){/if}                         
                    </td>                  
                </tr>
                {/if}
                
               
                {if $form->iso2->hasValidator('surface_floor')}
                 <tr>
                    <td class="label">{__('Surface 103')}{if $form->iso2.surface_floor->getOption('required')}*{/if}
                    </td>
                    <td>   
                        <div class="error-form">{$form.iso2.surface_floor->getError()}</div>
                        <input type="text" class="CustomerContractIso2-{$contract->get('id')} Input red-input" name="surface_floor" value="{format_number($iso->get('surface_floor'),"#")}" /> {if $iso->get('src_surface_floor')}({format_number($iso->get('src_surface_floor'),"#")}){/if}
                    </td>                  
                </tr>
                {/if}
                  {if $form->iso2->hasValidator('item_top')}
                <tr>
                    <td class="label">{__('Article 101')}{if $form->iso2.item_top->getOption('required')}*{/if}
                    </td>
                    <td>   
                        <div class="error-form">{$form.iso2.item_top->getError()}</div>
                        {html_options style="width: 84%;" class="AutoSaveField  Request CustomerContractIso2-`$contract->get('id')` Select" name="item_top" options=$form->iso2.item_top->getChoices() selected=$form.iso2.item_top}
                    </td>                  
                </tr>
                {/if}
                  {if $form->iso2->hasValidator('item_wall')}
                <tr>
                    <td class="label">{__('Article 102')}{if $form->iso2.item_wall->getOption('required')}*{/if}
                    </td>
                    <td>   
                        <div class="error-form">{$form.iso2.item_wall->getError()}</div>
                        {html_options style="width: 84%;"  class="AutoSaveField  Request CustomerContractIso2-`$contract->get('id')` Select" name="item_wall" options=$form->iso2.item_wall->getChoices() selected=$form.iso2.item_wall}
                    </td>                  
                </tr>
                {/if}              
                 {if $form->iso2->hasValidator('item_floor')}
                <tr>
                    <td class="label">{__('Article 103')}{if $form->iso2.item_floor->getOption('required')}*{/if}
                    </td>
                    <td>   
                        <div class="error-form">{$form.iso2.item_floor->getError()}</div>
                       {html_options style="width: 84%;"  class="AutoSaveField  Request CustomerContractIso2-`$contract->get('id')` Select" name="item_floor" options=$form->iso2.item_floor->getChoices() selected=$form.iso2.item_floor}
                    </td>                  
                </tr>
                {/if}
              
                {if $form->iso2->hasValidator('energy_id')}
                <tr>
                    <td class="label">{__('Energy')}{if $form->iso2.energy_id->getOption('required')}*{/if}
                    </td>
                    <td>     
                         <div class="error-form">{$form.iso2.energy_id->getError()}</div>
                        {html_options  class="AutoSaveField  Request CustomerContractIso2-`$contract->get('id')` Select red-input" name="energy_id" options=$form->iso2.energy_id->getOption('choices') selected=$iso->get('energy_id')}                         
                    </td>                  
                </tr>
                {/if}
                {if $form->iso2->hasValidator('occupation_id')}
                 <tr>
                    <td class="label">{__('Occupation')}{if $form->iso2.occupation_id->getOption('required')}*{/if}
                    </td>
                    <td>     
                         <div class="error-form">{$form.iso2.occupation_id->getError()}</div>
                        {html_options class="AutoSaveField  Request CustomerContractIso2-`$contract->get('id')` Select" name="occupation_id" options=$form->iso2.occupation_id->getOption('choices') selected=$iso->get('occupation_id')}                         
                    </td>                  
                </tr>
                {/if}
                {if $form->iso2->hasValidator('more_2_years')}
                 <tr>
                    <td class="label">{__('More 2 years')}{if $form->iso2.more_2_years->getOption('required')}*{/if}
                    </td>
                    <td>     
                         <div class="error-form">{$form.iso2.more_2_years->getError()}</div>
                        {html_options class="AutoSaveField  Request CustomerContractIso2-`$contract->get('id')` Select" name="more_2_years" options=$form->iso2.more_2_years->getOption('choices') selected=$iso->get('more_2_years')}                         
                    </td>                  
                </tr>                
                {/if}
                {if $form->iso2->hasValidator('layer_type_id')}
                <tr>
                    <td class="label">{__('Type layer')}{if $form->iso2.layer_type_id->getOption('required')}*{/if}
                    </td>
                    <td>     
                         <div class="error-form">{$form.iso2.layer_type_id->getError()}</div>
                        {html_options class="AutoSaveField  Request CustomerContractIso2-`$contract->get('id')` Select" name="layer_type_id" options=$form->iso2.layer_type_id->getOption('choices') selected=$iso->get('layer_type_id')}                         
                    </td>                  
                </tr>               
                {/if} 
                {if $form->iso2->hasValidator('pricing_id')}
                <tr>
                    <td class="label">{__('Pricing')}{if $form->iso2.pricing_id->getOption('required')}*{/if}
                    </td>
                    <td>     
                         <div class="error-form">{$form.iso2.pricing_id->getError()}</div>
                        {html_options class="AutoSaveField  Request CustomerContractIso2-`$contract->get('id')` Select" name="pricing_id" options=$form->iso2.pricing_id->getChoices()->toArray() selected=$iso->get('pricing_id')}                         
                    </td>                  
                </tr>               
                {/if}
                {if $form->iso2->hasValidator('parcel_surface')}
                 <tr>
                    <td class="label">{__('Parcel surface')}{if $form->iso2.parcel_surface->getOption('required')}*{/if}
                    </td>
                    <td>   
                        <div class="error-form">{$form.iso2.parcel_surface->getError()}</div>
                        <input type="text" class="CustomerContractIso2-{$contract->get('id')} Input red-input" name="parcel_surface" value="{format_number($iso->get('parcel_surface'),"#")}" />                         
                    </td>                  
                </tr>
                {/if}
                {if $form->iso2->hasValidator('parcel_reference')}
                 <tr>
                    <td class="label">{__('Parcel reference')}{if $form->iso2.parcel_reference->getOption('required')}*{/if}
                    </td>
                    <td>   
                        <div class="error-form">{$form.iso2.parcel_reference->getError()}</div>
                        <input type="text" class="CustomerContractIso2-{$contract->get('id')} Input red-input" name="parcel_reference" value="{$iso->get('parcel_reference')}" />                                                 
                    </td>                  
                </tr>
                {/if}
         </table>
        </fieldset>
        <fieldset class="tab-form tab-form-3-columns" style="width: auto;">
         <legend> <h3>{__('Surfaces Installateur')}</h3></legend>  
         <table style="width:100%;"> 
                {if $form->iso2->hasValidator('install_surface_top')}
                <tr>
                    <td class="label">{__('Install surface 101')}{if $form->iso2.install_surface_top->getOption('required')}*{/if}
                    </td>
                    <td>   
                        <div class="error-form">{$form.iso2.install_surface_top->getError()}</div>
                        <input type="text" class="CustomerContractIso2-{$contract->get('id')} Input" name="install_surface_top" value="{format_number($iso->get('install_surface_top'),"#")}"/>                     
                    </td>                  
                </tr>
                {/if}
                {if $form->iso2->hasValidator('install_surface_wall')}
                <tr>
                    <td class="label">{__('Install surface 102')}{if $form->iso2.install_surface_wall->getOption('required')}*{/if}
                    </td>
                    <td>     
                        <div class="error-form">{$form.iso2.install_surface_wall->getError()}</div>
                        <input type="text" class="CustomerContractIso2-{$contract->get('id')} Input" name="install_surface_wall" value="{format_number($iso->get('install_surface_wall'),"#")}"/>                    
                    </td>                  
                </tr>
                {/if}
                {if $form->iso2->hasValidator('install_surface_floor')}
                 <tr>
                    <td class="label">{__('Install surface 103')}{if $form->iso2.install_surface_floor->getOption('required')}*{/if}
                    </td>
                    <td>   
                        <div class="error-form">{$form.iso2.install_surface_floor->getError()}</div>
                        <input type="text" class="CustomerContractIso2-{$contract->get('id')} Input" name="install_surface_floor" value="{format_number($iso->get('install_surface_floor'),"#")}"/>                         
                    </td>                  
                </tr>
                {/if}
         </table>
        </fieldset>
     
 </fieldset>
                    
                    
<script type="text/javascript">
    
      $(".CustomerContractIso2-{$contract->get('id')}").click(function() { $("#CustomerContract-Save-{$contract->get('id')}").show(); });
         
      $(".CustomerContractIso2-{$contract->get('id')}").change(function() { $("#CustomerContract-Save-{$contract->get('id')}").show(); } );
    
      $("#CustomerContract-Save-{$contract->get('id')}").on('parameters',function (event,params) { 
             params.Contract.iso2= { };
             $(".CustomerContractIso2-{$contract->get('id')}.Select option:selected").each( function () { params.Contract.iso2[$(this).parent().attr('name')]=$(this).val(); } );
             $(".CustomerContractIso2-{$contract->get('id')}.Input").each( function () { params.Contract.iso2[$(this).attr('name')]=$(this).val(); });                   
      });
      
      
     {if $user->hasCredential([['app_domoprime_contract_view_autosave']])}       
      $(".AutoSaveField.Request").change(function() { 
            var params = { 
                             AutoSaveField : { 
                                    id : '{$contract->get('id')}',
                                    field : $(this).attr('name'),
                                    value : $(this).val(),
                                    token : '{mfForm::getToken('AutoSaveRequestForm')}'
                                }
                         };
            return $.ajax2({   data: params, 
                                url: "{url_to('app_domoprime_iso_ajax',['action'=>'AutoSaveRequestForViewContract'])}", 
                                errorTarget: ".site-contract-errors-{$contract->get('id')}",
                                loading: "#tab-site-dashboard-customers-contract-loading",                          
                                
                                 
                                });  
      });
      {/if}
</script>    
{/if}