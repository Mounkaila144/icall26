<fieldset style="padding: 0;">
     <legend> <h3>{__('Home information')}</h3></legend>   
        <fieldset class="tab-form tab-form-3-columns" style="width: auto;">
         <legend> <h3>{__('Fiscal')}</h3></legend> 
         <table>
                {if $form->iso2->hasValidator('number_of_people')}
                 <tr>
                    <td class="label">{__('Number of people')}{if $form->iso2.number_of_people->getOption('required')}*{/if}
                    </td>
                    <td> 
                        <div class="error-form">{$form.iso2.number_of_people->getError()}</div>
                        <input type="text" class="CustomerContractIso2 Input red-input" name="number_of_people" value="{format_number($iso->get('number_of_people'),"#.00")}" />
                    </td>                  
                </tr>
                {/if}
                 {if $form->iso2->hasValidator('number_of_children')}
                 <tr>
                    <td class="label">{__('Number of children')}{if $form->iso2.number_of_children->getOption('required')}*{/if}
                    </td>
                    <td> 
                        <div class="error-form">{$form.iso2.number_of_children->getError()}</div>
                        <input type="text" class="CustomerContractIso2 Input" name="number_of_children" value="{format_number($iso->get('number_of_children'),"#.00")}"/>
                    </td>                  
                </tr>
                {/if}
                {if $form->iso2->hasValidator('revenue')}
                 <tr>
                    <td class="label">{__('Revenue')}{if $form->iso2.revenue->getOption('required')}*{/if}
                    </td>
                    <td>  
                         <div class="error-form">{$form.iso2.revenue->getError()}</div>
                        <input type="text" class="CustomerContractIso2 Input red-input" name="revenue" value="{format_number($iso->get('revenue'),"#.00")}" />
                    </td>                  
                </tr>
                {/if}
                {if $form->iso2->hasValidator('number_of_fiscal')}
                 <tr>
                    <td class="label">{__('Number of fiscal')}{if $form->iso2.number_of_fiscal->getOption('required')}*{/if}
                    </td>
                    <td>     
                         <div class="error-form">{$form.iso2.number_of_fiscal->getError()}</div>
                        <input type="text" class="CustomerContractIso2 Input red-input" name="number_of_fiscal" value="{format_number($iso->get('number_of_fiscal'),"#.00")}" />
                    </td>                  
                </tr>
                {/if}
                {if $form->iso2->hasValidator('tax_credit_used')}
                 <tr>
                    <td class="label">{__('Tax credit used')}{if $form->iso2.tax_credit_used->getOption('required')}*{/if}
                    </td>
                    <td>     
                         <div class="error-form">{$form.iso2.tax_credit_used->getError()}</div>
                         <input type="text" class="CustomerContractIso2 Input" name="tax_credit_used" value="{format_number($iso->get('tax_credit_used'),"#.00")}"/>
                    </td>                  
                </tr>  
                {/if}
                {if $form->iso2->hasValidator('declarants')}
                 <tr>
                    <td class="label">{__('Declarants')}{if $form->iso2.declarants->getOption('required')}*{/if}
                    </td>
                    <td>   
                        <div class="error-form">{$form.iso2.declarants->getError()}</div>
                        <input type="text" class="CustomerContractIso2 Input" name="declarants" value="{$iso->get('declarants')}"/>
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
                        <input type="text" class="CustomerContractIso2 Input red-input" name="surface_top" value="{format_number($iso->get('surface_top'),"#.00")}"/>
                    </td>                  
                </tr>
                {/if}
                {if $form->iso2->hasValidator('surface_wall')}
                <tr>
                    <td class="label">{__('Surface 102')}{if $form->iso2.surface_wall->getOption('required')}*{/if}
                    </td>
                    <td>     
                        <div class="error-form">{$form.iso2.surface_wall->getError()}</div>
                        <input type="text" class="CustomerContractIso2 Input red-input" name="surface_wall" value="{format_number($iso->get('surface_wall'),"#.00")}"/>
                    </td>                  
                </tr>
                {/if}
                {if $form->iso2->hasValidator('surface_floor')}
                 <tr>
                    <td class="label">{__('Surface 103')}{if $form->iso2.surface_floor->getOption('required')}*{/if}
                    </td>
                    <td>   
                        <div class="error-form">{$form.iso2.surface_floor->getError()}</div>
                        <input type="text" class="CustomerContractIso2 Input red-input" name="surface_floor" value="{format_number($iso->get('surface_floor'),"#.00")}"/>
                    </td>                  
                </tr>
                {/if}
                
                 {if $form->iso2->hasValidator('item_top')}
                <tr>
                    <td class="label">{__('Article 101')}{if $form->iso2.item_top->getOption('required')}*{/if}
                    </td>
                    <td>   
                        <div class="error-form">{$form.iso2.item_top->getError()}</div>
                        {html_options style="width: 84%;" class="AutoSaveField  Request CustomerContractIso2 Select" name="item_top" options=$form->iso2.item_top->getChoices() selected=$form.iso2.item_top}
                    </td>                  
                </tr>
                {/if}
                  {if $form->iso2->hasValidator('item_wall')}
                <tr>
                    <td class="label">{__('Article 102')}{if $form->iso2.item_wall->getOption('required')}*{/if}
                    </td>
                    <td>   
                        <div class="error-form">{$form.iso2.item_wall->getError()}</div>
                        {html_options style="width: 84%;"  class="AutoSaveField  Request CustomerContractIso2 Select" name="item_wall" options=$form->iso2.item_wall->getChoices() selected=$form.iso2.item_wall}
                    </td>                  
                </tr>
                {/if}              
                 {if $form->iso2->hasValidator('item_floor')}
                <tr>
                    <td class="label">{__('Article 103')}{if $form->iso2.item_floor->getOption('required')}*{/if}
                    </td>
                    <td>   
                        <div class="error-form">{$form.iso2.item_floor->getError()}</div>
                       {html_options style="width: 84%;"  class="AutoSaveField  Request CustomerContractIso2 Select" name="item_floor" options=$form->iso2.item_floor->getChoices() selected=$form.iso2.item_floor}
                    </td>                  
                </tr>
                {/if}
                
                {if $form->iso2->hasValidator('energy_id')}
                <tr>
                    <td class="label">{__('Energy')}{if $form->iso2.energy_id->getOption('required')}*{/if}
                    </td>
                    <td>     
                         <div class="error-form">{$form.iso2.energy_id->getError()}</div>
                        {html_options class="CustomerContractIso2 Select red-input" name="energy_id" options=$form->iso2.energy_id->getOption('choices') selected=$iso->get('energy_id') }                         
                    </td>                  
                </tr>
                {/if}
                {if $form->iso2->hasValidator('occupation_id')}
                 <tr>
                    <td class="label">{__('Occupation')}{if $form->iso2.occupation_id->getOption('required')}*{/if}
                    </td>
                    <td>     
                         <div class="error-form">{$form.iso2.occupation_id->getError()}</div>
                        {html_options class="CustomerContractIso2 Select" name="occupation_id" options=$form->iso2.occupation_id->getOption('choices') selected=$iso->get('occupation_id')}                         
                    </td>                  
                </tr>
                {/if}
                {if $form->iso2->hasValidator('more_2_years')}
                 <tr>
                    <td class="label">{__('Plus de 2 years')}{if $form->iso2.more_2_years->getOption('required')}*{/if}
                    </td>
                    <td>     
                         <div class="error-form">{$form.iso2.more_2_years->getError()}</div>
                        {html_options class="CustomerContractIso2 Select" name="more_2_years" options=$form->iso2.more_2_years->getOption('choices') selected=$iso->get('more_2_years')}                         
                    </td>                  
                </tr>  
                {/if}
                {if $form->iso2->hasValidator('parcel_reference')}
                 <tr>
                    <td class="label">{__('Parcel reference')}{if $form->iso2.parcel_reference->getOption('required')}*{/if}
                    </td>
                    <td>   
                        <div class="error-form">{$form.iso2.parcel_reference->getError()}</div>
                        <input type="text" class="CustomerContractIso2 Input red-input" name="parcel_reference" value="{format_number($iso->get('parcel_reference'),"#.00")}"/>
                    </td>                  
                </tr>
                {/if}
                 {if $form->iso2->hasValidator('parcel_surface')}
                 <tr>
                    <td class="label">{__('Parcel surface')}{if $form->iso2.parcel_surface->getOption('required')}*{/if}
                    </td>
                    <td>   
                        <div class="error-form">{$form.iso2.parcel_surface->getError()}</div>
                        <input type="text" class="CustomerContractIso2 Input red-input" name="parcel_surface" value="{format_number($iso->get('parcel_surface'),"#.00")}" />
                    </td>                  
                </tr>
                {/if}
                {if $form->iso2->hasValidator('layer_type_id')}
                <tr>
                    <td class="label">{__('Type layer')}{if $form->iso2.layer_type_id->getOption('required')}*{/if}
                    </td>
                    <td>     
                         <div class="error-form">{$form.iso2.layer_type_id->getError()}</div>
                        {html_options class="CustomerContractIso2 Select" name="layer_type_id" options=$form->iso2.layer_type_id->getOption('choices') selected=$iso->get('layer_type_id')}                         
                    </td>                  
                </tr>               
                {/if} 
                 {if $form->iso2->hasValidator('pricing_id')}
                <tr>
                    <td class="label">{__('Pricing')}{if $form->iso2.pricing_id->getOption('required')}*{/if}
                    </td>
                    <td>     
                         <div class="error-form">{$form.iso2.pricing_id->getError()}</div>
                        {html_options class="CustomerContractIso2 Select" name="pricing_id" options=$form->iso2.pricing_id->getChoices()->toArray() selected=$iso->get('pricing_id')}                         
                    </td>                  
                </tr>               
                {/if} 
         </table>
         </fieldset>
        <fieldset class="tab-form tab-form-3-columns" style="width: auto;">
         <legend> <h3>{__('Surfaces Installateur')}</h3></legend> 
         <table style="width: 100%;">
               {if $form->iso2->hasValidator('install_surface_top')}
                <tr>
                    <td class="label">{__('Surface 101')}{if $form->iso2.install_surface_top->getOption('required')}*{/if}
                    </td>
                    <td>   
                        <div class="error-form">{$form.iso2.install_surface_top->getError()}</div>
                        <input type="text" class="CustomerContractIso2 Input " name="install_surface_top" value="{format_number($iso->get('install_surface_top'),"#.00")}" />
                    </td>                  
                </tr>
                {/if}
                {if $form->iso2->hasValidator('install_surface_wall')}
                <tr>
                    <td class="label">{__('Surface 102')}{if $form->iso2.install_surface_wall->getOption('required')}*{/if}
                    </td>
                    <td>     
                        <div class="error-form">{$form.iso2.install_surface_wall->getError()}</div>
                        <input type="text" class="CustomerContractIso2 Input" name="install_surface_wall" value="{format_number($iso->get('install_surface_wall'),"#.00")}" />
                    </td>                  
                </tr>
                {/if}
                {if $form->iso2->hasValidator('install_surface_floor')}
                 <tr>
                    <td class="label">{__('Surface 103')}{if $form->iso2.install_surface_floor->getOption('required')}*{/if}
                    </td>
                    <td>   
                        <div class="error-form">{$form.iso2.install_surface_floor->getError()}</div>
                        <input type="text" class="CustomerContractIso2 Input" name="install_surface_floor" value="{format_number($iso->get('install_surface_floor'),"#.00")}" />
                    </td>                  
                </tr>
                {/if}
         </table>
        </fieldset>
          
     
 </fieldset>     
                    
                    
<script type="text/javascript">
    
      $(".CustomerContractIso2").click(function() { $("#CustomerContract-New-Save").show(); });
         
      $(".CustomerContractIso2").change(function() { $("#CustomerContract-New-Save").show(); } );
    
      $("#CustomerContract-New-Save").on('parameters',function (event,params) { 
             params.CustomerContract.iso2= { };
             $(".CustomerContractIso2.Select option:selected").each( function () { params.CustomerContract.iso2[$(this).parent().attr('name')]=$(this).val(); } );
             $(".CustomerContractIso2.Input").each( function () { params.CustomerContract.iso2[$(this).attr('name')]=$(this).val(); });                   
      });  
</script>    

