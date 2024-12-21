{if $meeting->isHold()}
    <fieldset style="padding: 0;">
     <legend> <h3>{__('Home information')}</h3></legend>     
    
     <fieldset class="tab-form tab-form-3-columns" style="width:auto;">
        <legend> <h3>{__('Home')}</h3></legend>
        <table>
                <tr>
                    <td class="label">{__('Surface 101')}
                    </td>
                    <td>                          
                        <input type="text" disabled="" value="{format_number($iso->get('surface_top'),"#.00")}" style="border:1px solid #ff0000;"/>
                    </td>                  
                </tr>               
                <tr>
                    <td class="label">{__('Surface 102')}
                    </td>
                    <td>                    
                        <input type="text"  disabled="" value="{format_number($iso->get('surface_wall'),"#.00")}" style="border:1px solid #ff0000;"/>
                    </td>                  
                </tr>               
                 <tr>
                    <td class="label">{__('Surface 103')}
                    </td>
                    <td>   
                        
                        <input type="text" disabled="" value="{format_number($iso->get('surface_floor'),"#.00")}" style="border:1px solid #ff0000;"/>
                    </td>                  
                </tr>  
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
                        {html_options disabled="" name="more_2_years" options=$form->iso.more_2_years->getOption('choices') selected=$iso->get('more_2_years')}                         
                    </td>                  
                </tr>  
                <tr>
                    <td class="label">{__('Parcel reference')}
                    </td>
                    <td>                           
                        <input type="text" disabled="" value="{$iso->get('parcel_reference')}" style="border:1px solid #ff0000;"/>
                    </td>                  
                </tr>                
                 <tr>
                    <td class="label">{__('Parcel surface')}
                    </td>
                    <td>                          
                        <input type="text" disabled="" value="{format_number($iso->get('parcel_surface'),"#.00")}" style="border:1px solid #ff0000;"/>
                    </td>                  
                </tr> 
                <tr>
                    <td class="label">{__('Type layer')}
                    </td>
                    <td>                      
                           <input type="text" disabled="" value="{format_number($iso->get('tax_credit_used'),"#.00")}"/>
                    </td>                  
                </tr>  
        </table>
      </fieldset>
      <fieldset class="tab-form tab-form-3-columns" style="width:auto;">
         <legend> <h3>{__('Fiscal')}</h3></legend> 
         <table>
                <tr>
                    <td class="label">{__('Number of people')}
                    </td>
                    <td>                      
                        <input type="text" disabled="" value="{format_number($iso->get('number_of_people'),"#.00")}" style="border:1px solid #ff0000;"/>
                    </td>                  
                </tr>             
                 <tr>
                    <td class="label">{__('Number of children')}
                    </td>
                    <td>                      
                        <input type="text" disabled="" value="{format_number($iso->get('number_of_children'),"#.00")}"/>
                    </td>                  
                </tr>    
                 <tr>
                    <td class="label">{__('Revenue')}
                    </td>
                    <td>                          
                        <input type="text" disabled="" value="{format_number($iso->get('revenue'),"#.00")}" style="border:1px solid #ff0000;"/>
                    </td>                  
                </tr>  
                <tr>
                    <td class="label">{__('Number of fiscal')}
                    </td>
                    <td>                          
                        <input type="text" disabled="" value="{format_number($iso->get('number_of_fiscal'),"#.00")}" style="border:1px solid #ff0000;"/>
                    </td>                  
                </tr>   
                <tr>
                    <td class="label">{__('Tax credit used')}
                    </td>
                    <td>                              
                         <input type="text" disabled="" value="{$iso->get('tax_credit_used')}"/>
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
     
        <fieldset class="tab-form tab-form-3-columns" style="width:auto;">
            <legend> <h3>{__('Surfaces Installateur')}</h3></legend> 
            <table>
                                <tr>
                    <td class="label">{__('Install surface 101')}
                    </td>
                    <td>                           
                        <input type="text" disabled="" value="{format_number($iso->get('install_surface_top'),"#.00")}" style="border:1px solid #ff0000;"/>
                    </td>                  
                </tr>               
                <tr>
                    <td class="label">{__('Install surface 102')}
                    </td>
                    <td>                           
                        <input type="text" disabled="" value="{format_number($iso->get('install_surface_wall'),"#.00")}" style="border:1px solid #ff0000;"/>
                    </td>                  
                </tr>                
                 <tr>
                    <td class="label">{__('Install surface 103')}
                    </td>
                    <td>                       
                        <input type="text" disabled="" value="{format_number($iso->get('install_surface_floor'),"#.00")}" style="border:1px solid #ff0000;"/>
                    </td>                  
                </tr>  
            </table>
        </fieldset> 

     
     
     
     
     
     
     
     
     
{*     <table class="tab-form">                 
                <tr>
                    <td class="label">{__('Surface 101')}
                    </td>
                    <td>                          
                        <input type="text" disabled="" value="{format_number($iso->get('surface_top'),"#.00")}"/>
                    </td>                  
                </tr>               
                <tr>
                    <td class="label">{__('Surface 102')}
                    </td>
                    <td>                    
                        <input type="text"  disabled="" value="{format_number($iso->get('surface_wall'),"#.00")}"/>
                    </td>                  
                </tr>               
                 <tr>
                    <td class="label">{__('Surface 103')}
                    </td>
                    <td>   
                        
                        <input type="text" disabled="" value="{format_number($iso->get('surface_floor'),"#.00")}"/>
                    </td>                  
                </tr>                
                <tr>
                    <td class="label">{__('Number of people')}
                    </td>
                    <td>                      
                        <input type="text" disabled="" value="{format_number($iso->get('number_of_people'),"#.00")}"/>
                    </td>                  
                </tr>             
                 <tr>
                    <td class="label">{__('Number of children')}
                    </td>
                    <td>                      
                        <input type="text" disabled="" value="{format_number($iso->get('number_of_children'),"#.00")}"/>
                    </td>                  
                </tr>    
                 <tr>
                    <td class="label">{__('Revenue')}
                    </td>
                    <td>                          
                        <input type="text" disabled="" value="{format_number($iso->get('revenue'),"#.00")}"/>
                    </td>                  
                </tr>               
                 <tr>
                    <td class="label">{__('Number of fiscal')}
                    </td>
                    <td>                          
                        <input type="text" disabled="" value="{format_number($iso->get('number_of_fiscal'),"#.00")}"/>
                    </td>                  
                </tr>               
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
                        {html_options disabled="" name="more_2_years" options=$form->iso.more_2_years->getOption('choices') selected=$iso->get('more_2_years')}                         
                    </td>                  
                </tr>                
                <tr>
                    <td class="label">{__('Type layer')}
                    </td>
                    <td>                      
                           <input type="text" disabled="" value="{format_number($iso->get('tax_credit_used'),"#.00")}"/>
                    </td>                  
                </tr>                               
                 <tr>
                    <td class="label">{__('Tax credit used')}
                    </td>
                    <td>                              
                         <input type="text" disabled="" value="{$iso->get('tax_credit_used')}"/>
                    </td>                  
                </tr>                                                          
                <tr>
                    <td class="label">{__('Install surface 101')}
                    </td>
                    <td>                           
                        <input type="text" disabled="" value="{format_number($iso->get('install_surface_top'),"#.00")}"/>
                    </td>                  
                </tr>               
                <tr>
                    <td class="label">{__('Install surface 102')}
                    </td>
                    <td>                           
                        <input type="text" disabled="" value="{format_number($iso->get('install_surface_wall'),"#.00")}"/>
                    </td>                  
                </tr>                
                 <tr>
                    <td class="label">{__('Install surface 103')}
                    </td>
                    <td>                       
                        <input type="text" disabled="" value="{format_number($iso->get('install_surface_floor'),"#.00")}"/>
                    </td>                  
                </tr>  
                <tr>
                    <td class="label">{__('Parcel reference')}
                    </td>
                    <td>                           
                        <input type="text" disabled="" value="{$iso->get('parcel_reference')}"/>
                    </td>                  
                </tr>                
                 <tr>
                    <td class="label">{__('Parcel surface')}
                    </td>
                    <td>                          
                        <input type="text" disabled="" value="{format_number($iso->get('parcel_surface'),"#.00")}"/>
                    </td>                  
                </tr> 
                <tr>
                    <td class="label">{__('Declarants')}
                    </td>
                    <td>                         
                        <input type="text" disabled=""  value="{$iso->get('declarants')}"/>
                    </td>                  
                </tr>
       </table> *}
     
 </fieldset>   
    
{else}    
<fieldset style="padding: 0;">
     <legend> <h3>{__('Home information')}</h3></legend>
     
        <fieldset class="tab-form tab-form-3-columns" style="width:auto;">
         <legend> <h3>{__('Fiscal')}</h3></legend>  
         <table>
                {if $form->iso->hasValidator('number_of_people')}
                 <tr>
                    <td class="label">{__('Number of people')}{if $form->iso.number_of_people->getOption('required')}*{/if}
                    </td>
                    <td> 
                        <div class="error-form">{$form.iso.number_of_people->getError()}</div>
                        <input type="text" class="CustomerMeetingIso-{$meeting->get('id')} Input" name="number_of_people" value="{format_number($iso->get('number_of_people'),"#.00")}" style="border:1px solid #ff0000;"/>
                    </td>                  
                </tr>
                {/if}
                 {if $form->iso->hasValidator('number_of_children')}
                 <tr>
                    <td class="label">{__('Number of children')}{if $form->iso.number_of_children->getOption('required')}*{/if}
                    </td>
                    <td> 
                        <div class="error-form">{$form.iso.number_of_children->getError()}</div>
                        <input type="text" class="CustomerMeetingIso-{$meeting->get('id')} Input" name="number_of_children" value="{format_number($iso->get('number_of_children'),"#.00")}"/>
                    </td>                  
                </tr>
                {/if}
                  {if $form->iso->hasValidator('revenue')}
                 <tr>
                    <td class="label">{__('Revenue')}{if $form->iso.revenue->getOption('required')}*{/if}
                    </td>
                    <td>  
                         <div class="error-form">{$form.iso.revenue->getError()}</div>
                        <input type="text" class="CustomerMeetingIso-{$meeting->get('id')} Input" name="revenue" value="{format_number($iso->get('revenue'),"#.00")}" style="border:1px solid #ff0000;"/>
                    </td>                  
                </tr>
                {/if}
                  {if $form->iso->hasValidator('number_of_fiscal')}
                 <tr>
                    <td class="label">{__('Number of fiscal')}{if $form->iso.number_of_fiscal->getOption('required')}*{/if}
                    </td>
                    <td>     
                         <div class="error-form">{$form.iso.number_of_fiscal->getError()}</div>
                        <input type="text" class="CustomerMeetingIso-{$meeting->get('id')} Input" name="number_of_fiscal" value="{format_number($iso->get('number_of_fiscal'),"#.00")}" style="border:1px solid #ff0000;"/>
                    </td>                  
                </tr>
                {/if}
                {if $form->iso->hasValidator('tax_credit_used')}
                 <tr>
                    <td class="label">{__('Tax credit used')}{if $form->iso.tax_credit_used->getOption('required')}*{/if}
                    </td>
                    <td>     
                         <div class="error-form">{$form.iso.tax_credit_used->getError()}</div>
                        <input type="text" class="CustomerMeetingIso-{$meeting->get('id')} Input" name="tax_credit_used" value="{format_number($iso->get('tax_credit_used'),"#.00")}"/>
                    </td>                  
                </tr>
                {/if}
                {if $form->iso->hasValidator('declarants')}
                 <tr>
                    <td class="label">{__('Declarants')}{if $form->iso.declarants->getOption('required')}*{/if}
                    </td>
                    <td>   
                        <div class="error-form">{$form.iso.declarants->getError()}</div>
                        <input type="text" class="CustomerMeetingIso-{$meeting->get('id')}  Input" name="declarants" value="{$iso->get('declarants')}"/>
                    </td>                  
                </tr>
                {/if}
         </table>
        </fieldset>
        <fieldset class="tab-form tab-form-3-columns" style="width:auto;">
         <legend> <h3>{__('Home')}</h3></legend>  
         <table>
                {if $form->iso->hasValidator('surface_top')}
                <tr>
                    <td class="label">{__('Surface 101')}{if $form->iso.surface_top->getOption('required')}*{/if}
                    </td>
                    <td>   
                        <div class="error-form">{$form.iso.surface_top->getError()}</div>
                        <input type="text" class="CustomerMeetingIso-{$meeting->get('id')} Input" name="surface_top" value="{format_number($iso->get('surface_top'),"#.00")}" style="border:1px solid #ff0000;"/>
                    </td>                  
                </tr>
                {/if}
                  {if $form->iso->hasValidator('surface_wall')}
                <tr>
                    <td class="label">{__('Surface 102')}{if $form->iso.surface_wall->getOption('required')}*{/if}
                    </td>
                    <td>     
                        <div class="error-form">{$form.iso.surface_wall->getError()}</div>
                        <input type="text" class="CustomerMeetingIso-{$meeting->get('id')} Input" name="surface_wall" value="{format_number($iso->get('surface_wall'),"#.00")}" style="border:1px solid #ff0000;"/>
                    </td>                  
                </tr>
                {/if}
                  {if $form->iso->hasValidator('surface_floor')}
                 <tr>
                    <td class="label">{__('Surface 103')}{if $form->iso.surface_floor->getOption('required')}*{/if}
                    </td>
                    <td>   
                        <div class="error-form">{$form.iso.surface_floor->getError()}</div>
                        <input type="text" class="CustomerMeetingIso-{$meeting->get('id')} Input" name="surface_floor" value="{format_number($iso->get('surface_floor'),"#.00")}" style="border:1px solid #ff0000;"/>
                    </td>                  
                </tr>
                {/if}
                {if $form->iso->hasValidator('energy_id')}
                <tr>
                    <td class="label">{__('Energy')}{if $form->iso.energy_id->getOption('required')}*{/if}
                    </td>
                    <td>     
                         <div class="error-form">{$form.iso.energy_id->getError()}</div>
                        {html_options class="CustomerMeetingIso-`$meeting->get('id')` Select" name="energy_id" options=$form->iso.energy_id->getOption('choices') selected=$iso->get('energy_id') style="border:1px solid #ff0000;"}                         
                    </td>                  
                </tr>
                {/if}
                  {if $form->iso->hasValidator('occupation_id')}
                 <tr>
                    <td class="label">{__('Occupation')}{if $form->iso.occupation_id->getOption('required')}*{/if}
                    </td>
                    <td>     
                         <div class="error-form">{$form.iso.occupation_id->getError()}</div>
                        {html_options class="CustomerMeetingIso-`$meeting->get('id')` Select" name="occupation_id" options=$form->iso.occupation_id->getOption('choices') selected=$iso->get('occupation_id')}                         
                    </td>                  
                </tr>
                {/if}
                  {if $form->iso->hasValidator('more_2_years')}
                 <tr>
                    <td class="label">{__('More 2 years')}{if $form->iso.more_2_years->getOption('required')}*{/if}
                    </td>
                    <td>     
                         <div class="error-form">{$form.iso.more_2_years->getError()}</div>
                        {html_options class="CustomerMeetingIso-`$meeting->get('id')` Select" name="more_2_years" options=$form->iso.more_2_years->getOption('choices') selected=$iso->get('more_2_years')}                         
                    </td>                  
                </tr>                
                {/if}
                {if $form->iso->hasValidator('layer_type_id')}
                <tr>
                    <td class="label">{__('Type layer')}{if $form->iso.layer_type_id->getOption('required')}*{/if}
                    </td>
                    <td>     
                         <div class="error-form">{$form.iso.layer_type_id->getError()}</div>
                        {html_options class="CustomerMeetingIso-`$meeting->get('id')` Select" name="layer_type_id" options=$form->iso.layer_type_id->getOption('choices') selected=$iso->get('layer_type_id')}                         
                    </td>                  
                </tr>               
                {/if}  
                {if $form->iso->hasValidator('parcel_surface')}
                 <tr>
                    <td class="label">{__('Parcel surface')}{if $form->iso.parcel_surface->getOption('required')}*{/if}
                    </td>
                    <td>   
                        <div class="error-form">{$form.iso.parcel_surface->getError()}</div>
                        <input type="text" class="CustomerMeetingIso-{$meeting->get('id')} Input" name="parcel_surface" value="{$iso->get('parcel_surface')}" style="border:1px solid #ff0000;"/>
                    </td>                  
                </tr>
                {/if}
                {if $form->iso->hasValidator('parcel_reference')}
                 <tr>
                    <td class="label">{__('Parcel reference')}{if $form->iso.parcel_reference->getOption('required')}*{/if}
                    </td>
                    <td>   
                        <div class="error-form">{$form.iso.parcel_reference->getError()}</div>
                        <input type="text" class="CustomerMeetingIso-{$meeting->get('id')} Input" name="parcel_reference" value="{$iso->get('parcel_reference')}" style="border:1px solid #ff0000;"/>
                    </td>                  
                </tr>
                {/if}
         </table>
        </fieldset>
        <fieldset class="tab-form tab-form-3-columns" style="width:auto;">
         <legend> <h3>{__('Surfaces Installateur')}</h3></legend>  
         <table style="width:100%;"> 
                {if $form->iso->hasValidator('install_surface_top')}
                <tr>
                    <td class="label">{__('Install surface 101')}{if $form->iso.install_surface_top->getOption('required')}*{/if}
                    </td>
                    <td>   
                        <div class="error-form">{$form.iso.install_surface_top->getError()}</div>
                        <input type="text" class="CustomerMeetingIso-{$meeting->get('id')} Input" name="install_surface_top" value="{format_number($iso->get('install_surface_top'),"#.00")}" style="border:1px solid #ff0000;"/>
                    </td>                  
                </tr>
                {/if}
                  {if $form->iso->hasValidator('install_surface_wall')}
                <tr>
                    <td class="label">{__('Install surface 102')}{if $form->iso.install_surface_wall->getOption('required')}*{/if}
                    </td>
                    <td>     
                        <div class="error-form">{$form.iso.install_surface_wall->getError()}</div>
                        <input type="text" class="CustomerMeetingIso-{$meeting->get('id')} Input" name="install_surface_wall" value="{format_number($iso->get('install_surface_wall'),"#.00")}" style="border:1px solid #ff0000;"/>
                    </td>                  
                </tr>
                {/if}
                  {if $form->iso->hasValidator('install_surface_floor')}
                 <tr>
                    <td class="label">{__('Install surface 103')}{if $form->iso.install_surface_floor->getOption('required')}*{/if}
                    </td>
                    <td>   
                        <div class="error-form">{$form.iso.install_surface_floor->getError()}</div>
                        <input type="text" class="CustomerMeetingIso-{$meeting->get('id')} Input" name="install_surface_floor" value="{format_number($iso->get('install_surface_floor'),"#.00")}" style="border:1px solid #ff0000;"/>
                    </td>                  
                </tr>
                {/if}
         </table>
        </fieldset>

         
     
     
     
     
{*     
    <table class="tab-form">
                {if $form->iso->hasValidator('surface_top')}
                <tr>
                    <td class="label">{__('Surface 101')}{if $form->iso.surface_top->getOption('required')}*{/if}
                    </td>
                    <td>   
                        <div class="error-form">{$form.iso.surface_top->getError()}</div>
                        <input type="text" class="CustomerMeetingIso-{$meeting->get('id')} Input" name="surface_top" value="{format_number($iso->get('surface_top'),"#.00")}"/>
                    </td>                  
                </tr>
                {/if}
                  {if $form->iso->hasValidator('surface_wall')}
                <tr>
                    <td class="label">{__('Surface 102')}{if $form->iso.surface_wall->getOption('required')}*{/if}
                    </td>
                    <td>     
                        <div class="error-form">{$form.iso.surface_wall->getError()}</div>
                        <input type="text" class="CustomerMeetingIso-{$meeting->get('id')} Input" name="surface_wall" value="{format_number($iso->get('surface_wall'),"#.00")}"/>
                    </td>                  
                </tr>
                {/if}
                  {if $form->iso->hasValidator('surface_floor')}
                 <tr>
                    <td class="label">{__('Surface 103')}{if $form->iso.surface_floor->getOption('required')}*{/if}
                    </td>
                    <td>   
                        <div class="error-form">{$form.iso.surface_floor->getError()}</div>
                        <input type="text" class="CustomerMeetingIso-{$meeting->get('id')} Input" name="surface_floor" value="{format_number($iso->get('surface_floor'),"#.00")}"/>
                    </td>                  
                </tr>
                {/if}
                  {if $form->iso->hasValidator('number_of_people')}
                 <tr>
                    <td class="label">{__('Number of people')}{if $form->iso.number_of_people->getOption('required')}*{/if}
                    </td>
                    <td> 
                        <div class="error-form">{$form.iso.number_of_people->getError()}</div>
                        <input type="text" class="CustomerMeetingIso-{$meeting->get('id')} Input" name="number_of_people" value="{format_number($iso->get('number_of_people'),"#.00")}"/>
                    </td>                  
                </tr>
                {/if}
                 {if $form->iso->hasValidator('number_of_chlidren')}
                 <tr>
                    <td class="label">{__('Number of chlidren')}{if $form->iso.number_of_chlidren->getOption('required')}*{/if}
                    </td>
                    <td> 
                        <div class="error-form">{$form.iso.number_of_chlidren->getError()}</div>
                        <input type="text" class="CustomerMeetingIso-{$meeting->get('id')} Input" name="number_of_chlidren" value="{format_number($iso->get('number_of_chlidren'),"#.00")}"/>
                    </td>                  
                </tr>
                {/if}
                  {if $form->iso->hasValidator('revenue')}
                 <tr>
                    <td class="label">{__('Revenue')}{if $form->iso.revenue->getOption('required')}*{/if}
                    </td>
                    <td>  
                         <div class="error-form">{$form.iso.revenue->getError()}</div>
                        <input type="text" class="CustomerMeetingIso-{$meeting->get('id')} Input" name="revenue" value="{format_number($iso->get('revenue'),"#.00")}"/>
                    </td>                  
                </tr>
                {/if}
                  {if $form->iso->hasValidator('number_of_fiscal')}
                 <tr>
                    <td class="label">{__('Number of fiscal')}{if $form->iso.number_of_fiscal->getOption('required')}*{/if}
                    </td>
                    <td>     
                         <div class="error-form">{$form.iso.number_of_fiscal->getError()}</div>
                        <input type="text" class="CustomerMeetingIso-{$meeting->get('id')} Input" name="number_of_fiscal" value="{format_number($iso->get('number_of_fiscal'),"#.00")}"/>
                    </td>                  
                </tr>
                {/if}
                  {if $form->iso->hasValidator('energy_id')}
                <tr>
                    <td class="label">{__('Energy')}{if $form->iso.energy_id->getOption('required')}*{/if}
                    </td>
                    <td>     
                         <div class="error-form">{$form.iso.energy_id->getError()}</div>
                        {html_options class="CustomerMeetingIso-`$meeting->get('id')` Select" name="energy_id" options=$form->iso.energy_id->getOption('choices') selected=$iso->get('energy_id')}                         
                    </td>                  
                </tr>
                {/if}
                  {if $form->iso->hasValidator('occupation_id')}
                 <tr>
                    <td class="label">{__('Occupation')}{if $form->iso.occupation_id->getOption('required')}*{/if}
                    </td>
                    <td>     
                         <div class="error-form">{$form.iso.occupation_id->getError()}</div>
                        {html_options class="CustomerMeetingIso-`$meeting->get('id')` Select" name="occupation_id" options=$form->iso.occupation_id->getOption('choices') selected=$iso->get('occupation_id')}                         
                    </td>                  
                </tr>
                {/if}
                  {if $form->iso->hasValidator('more_2_years')}
                 <tr>
                    <td class="label">{__('More 2 years')}{if $form->iso.more_2_years->getOption('required')}*{/if}
                    </td>
                    <td>     
                         <div class="error-form">{$form.iso.more_2_years->getError()}</div>
                        {html_options class="CustomerMeetingIso-`$meeting->get('id')` Select" name="more_2_years" options=$form->iso.more_2_years->getOption('choices') selected=$iso->get('more_2_years')}                         
                    </td>                  
                </tr>                
                {/if}
                {if $form->iso->hasValidator('layer_type_id')}
                <tr>
                    <td class="label">{__('Type layer')}{if $form->iso.layer_type_id->getOption('required')}*{/if}
                    </td>
                    <td>     
                         <div class="error-form">{$form.iso.layer_type_id->getError()}</div>
                        {html_options class="CustomerMeetingIso-`$meeting->get('id')` Select" name="layer_type_id" options=$form->iso.layer_type_id->getOption('choices') selected=$iso->get('layer_type_id')}                         
                    </td>                  
                </tr>               
                {/if}  
                   {if $form->iso->hasValidator('tax_credit_used')}
                 <tr>
                    <td class="label">{__('Tax credit used')}{if $form->iso.tax_credit_used->getOption('required')}*{/if}
                    </td>
                    <td>     
                         <div class="error-form">{$form.iso.tax_credit_used->getError()}</div>
                        <input type="text" class="CustomerMeetingIso-{$meeting->get('id')} Input" name="tax_credit_used" value="{format_number($iso->get('tax_credit_used'),"#.00")}"/>
                    </td>                  
                </tr>
                {/if}
                
                 {if $form->iso->hasValidator('install_surface_top')}
                <tr>
                    <td class="label">{__('Install surface 101')}{if $form->iso.install_surface_top->getOption('required')}*{/if}
                    </td>
                    <td>   
                        <div class="error-form">{$form.iso.install_surface_top->getError()}</div>
                        <input type="text" class="CustomerMeetingIso-{$meeting->get('id')} Input" name="install_surface_top" value="{format_number($iso->get('install_surface_top'),"#.00")}"/>
                    </td>                  
                </tr>
                {/if}
                  {if $form->iso->hasValidator('install_surface_wall')}
                <tr>
                    <td class="label">{__('Install surface 102')}{if $form->iso.install_surface_wall->getOption('required')}*{/if}
                    </td>
                    <td>     
                        <div class="error-form">{$form.iso.install_surface_wall->getError()}</div>
                        <input type="text" class="CustomerMeetingIso-{$meeting->get('id')} Input" name="install_surface_wall" value="{format_number($iso->get('install_surface_wall'),"#.00")}"/>
                    </td>                  
                </tr>
                {/if}
                  {if $form->iso->hasValidator('install_surface_floor')}
                 <tr>
                    <td class="label">{__('Install surface 103')}{if $form->iso.install_surface_floor->getOption('required')}*{/if}
                    </td>
                    <td>   
                        <div class="error-form">{$form.iso.install_surface_floor->getError()}</div>
                        <input type="text" class="CustomerMeetingIso-{$meeting->get('id')} Input" name="install_surface_floor" value="{format_number($iso->get('install_surface_floor'),"#.00")}"/>
                    </td>                  
                </tr>
                {/if}
                  {if $form->iso->hasValidator('parcel_surface')}
                 <tr>
                    <td class="label">{__('Parcel surface')}{if $form->iso.parcel_surface->getOption('required')}*{/if}
                    </td>
                    <td>   
                        <div class="error-form">{$form.iso.parcel_surface->getError()}</div>
                        <input type="text" class="CustomerMeetingIso-{$meeting->get('id')} Input" name="parcel_surface" value="{$iso->get('parcel_surface')}"/>
                    </td>                  
                </tr>
                {/if}
                {if $form->iso->hasValidator('parcel_reference')}
                 <tr>
                    <td class="label">{__('Parcel reference')}{if $form->iso.parcel_reference->getOption('required')}*{/if}
                    </td>
                    <td>   
                        <div class="error-form">{$form.iso.parcel_reference->getError()}</div>
                        <input type="text" class="CustomerMeetingIso-{$meeting->get('id')} Input" name="parcel_reference" value="{$iso->get('parcel_reference')}"/>
                    </td>                  
                </tr>
                {/if}
                 {if $form->iso->hasValidator('declarants')}
                 <tr>
                    <td class="label">{__('Declarants')}{if $form->iso.declarants->getOption('required')}*{/if}
                    </td>
                    <td>   
                        <div class="error-form">{$form.iso.declarants->getError()}</div>
                        <input type="text" class="CustomerMeetingIso-{$meeting->get('id')}  Input" name="declarants" value="{$iso->get('declarants')}"/>
                    </td>                  
                </tr>
                {/if}
       </table> 
     *}
 </fieldset>     
                    
                    
<script type="text/javascript">
    
      $(".CustomerMeetingIso-{$meeting->get('id')}").click(function() { $("#Save-{$meeting->get('id')}").show(); });
         
      $(".CustomerMeetingIso-{$meeting->get('id')}").change(function() { $("#Save-{$meeting->get('id')}").show(); } );
    
      $("#customer-meetings-tabs-{$meeting->get('id')}").on('parameters',function (event,params) { 
             params.Meeting.iso= { };
             $(".CustomerMeetingIso-{$meeting->get('id')}.Select option:selected").each( function () { params.Meeting.iso[$(this).parent().attr('name')]=$(this).val(); } );
             $(".CustomerMeetingIso-{$meeting->get('id')}.Input").each( function () { params.Meeting.iso[$(this).attr('name')]=$(this).val(); });                   
      });
</script>    
{/if}