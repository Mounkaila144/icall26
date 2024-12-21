{if $contract->isHold()}
    <fieldset class="tab-form" style="width: auto;">
        <legend><h3>{__('Customer informations')}</h3></legend>
        <table>
                        <tr style="width: 100%;">
                            <td  class="label">{__("title")}  </td>
                            <td>
                                <span>: {format_gender($contract->getCustomer()->get('gender'),1,true)|capitalize|upper}</span>                                 
                            </td>
                        </tr>  
                        <tr>
                            <td  class="label">{__('Last name')}
                            </td>
                            <td>                                  
                               : {$contract->getCustomer()->get('lastname')|upper}
                            </td>
                        </tr>
                         <tr>
                            <td  class="label">{__('Firstname')} </td>
                            <td>                               
                                <span>: {$contract->getCustomer()->get('firstname')|upper}</span>
                            </td>
                        </tr>
                      {*  <tr>
                            <td  class="label">{__('Age')} 
                            </td>
                            <td>
                                : {$customer->get('age')}
                            </td>
                        </tr> *}
                         <tr>
                            <td  class="label"> {__('Phone')}
                            </td>
                            <td>
                                
                              : {$contract->getCustomer()->get('phone')}
                            </td>
                        </tr>
                         <tr>
                            <td  class="label"> {__('Mobile 1')} 
                            </td>
                            <td>
                                
                              : {$contract->getCustomer()->get('mobile')}
                            </td>
                        </tr>
                         <tr>
                            <td  class="label"> {__('Mobile 2')} 
                            </td>
                            <td>
                                
                              : {$contract->getCustomer()->get('mobile2')}
                            </td>
                        </tr>
                         <tr>
                            <td  class="label"> {__('Email')} 
                            </td>
                            <td>
                               : {$contract->getCustomer()->get('email')|upper}
                            </td>
                        </tr>
                        <tr>
                            <td  class="label"> {__('Address')} 
                            </td>
                            <td>                                                     
                               : {$contract->getCustomer()->getAddress()->getAddress1()->upper()}
                                 {$contract->getCustomer()->getAddress()->getAddress2()->upper()}
                            </td>
                        </tr>
                         
                         <tr>
                            <td  class="label"> {__('Post code')} 
                            </td>
                            <td> 
                               : {$contract->getCustomer()->getAddress()->get('postcode')}
                            </td>
                        </tr>
                         <tr>
                            <td  class="label"> {__('City')} 
                            </td>
                            <td> 
                                : {$contract->getCustomer()->getAddress()->get('city')|upper}
                            </td>
                        </tr>                        
</table>
</fieldset>                              
{else}
        <fieldset class="tab-form" style="width: auto;">
            <legend><h3>{__('Customer informations')}</h3></legend>
        <table>
                        <tr style="width: 100%;">
                            <td class="label">{__("title")}</td>
                            <td>
                                  <div>{$form.customer.gender->getError()}</div> 
                                 {foreach $form->customer.gender->getOption("choices") as $name=>$gender}
                                         <input type="radio" class="CustomerForContract Radio" name="gender" value="{$name}" {if $contract->getCustomer()->get('gender')==$name}checked="checked"{/if}/>
                                         <span>{format_gender($gender,1,true)|capitalize}</span>
                                  {/foreach}                            
                            </td>
                       </tr>                         
                        <tr>
                            <td class="label">{__('Last name')}
                            </td>
                            <td>                                  
                                 <div class="form-errors">{$form.customer.lastname->getError()}</div>
                                <input type="text" class="CustomerForContract Input" size="48" name="lastname" value="{$contract->getCustomer()->get('lastname')}"/>
                                {if $form->customer.lastname->getOption('required')}*{/if}
                            </td>
                        </tr>
                         <tr>
                            <td class="label">{__('Firstname')} </td>
                            <td>                               
                                <div class="form-errors">{$form.customer.firstname->getError()}</div>
                                <input type="text" class="CustomerForContract Input" size="48" name="firstname" value="{$contract->getCustomer()->get('firstname')}"/>
                                {if $form->customer.firstname->getOption('required')}*{/if}
                            </td>
                        </tr>
                   {*     <tr>
                            <td>{__('Age')}
                            </td>
                            <td>
                               <div class="form-errors">{$form.customer.age->getError()}</div>
                                <input type="text" class="Customer" name="age" value="{$contract->getCustomer()->get('age')}"/>
                            </td>
                        </tr> *}
                         <tr>
                            <td class="label"> {__('Phone')}
                            </td>
                            <td>
                                <div class="form-errors">{$form.customer.phone->getError()}</div>
                                <input type="text" class="CustomerForContract Input" name="phone" value="{$contract->getCustomer()->get('phone')}"/> 
                             {if $form->customer.phone->getOption('required')}*{/if}
                            </td>
                        </tr>
                         <tr>
                            <td class="label"> {__('Mobile 1')}
                            </td>
                            <td>
                                 <div class="form-errors">{$form.customer.mobile->getError()}</div>
                                <input type="text" class="CustomerForContract Input yellow-input" name="mobile" value="{$contract->getCustomer()->get('mobile')}"/>
                               {if $form->customer.mobile->getOption('required')}*{/if}
                            </td>
                        </tr>
                         <tr>
                            <td class="label"> {__('Mobile 2')}
                            </td>
                            <td>
                                 <div class="form-errors">{$form.customer.mobile2->getError()}</div>
                                <input type="text" class="CustomerForContract Input" name="mobile2" value="{$contract->getCustomer()->get('mobile2')}" />
                                {if $form->customer.mobile2->getOption('required')}*{/if}
                            </td>
                        </tr>
                         <tr>
                            <td class="label"> {__('Email')}
                            </td>
                            <td>
                                 <div class="form-errors">{$form.customer.email->getError()}</div>
                                <input type="text" class="CustomerForContract Input yellow-input" size="48" name="email" value="{$contract->getCustomer()->get('email')}" />
                                 {if $form->customer.email->getOption('required')}*{/if}
                            </td>
                        </tr>
                        <tr>
                            <td class="label"> {__('Address')}
                            </td>
                            <td>                                                     
                                <div class="form-errors">{$form.address.address1->getError()}</div>
                                <div><input type="text" class="CustomerAddressForContract Input" size="64" name="address1" value="{$contract->getCustomer()->getAddress()->getAddress1()->escapeHtml()}"/>{if $form->address.address1->getOption('required')}*{/if}</div>
                                <div><input type="text" class="CustomerAddressForContract Input" size="64" name="address2" value="{$contract->getCustomer()->getAddress()->getAddress2()->escapeHtml()}"/>
                                     {if $form->address.address2->getOption('required')}*{/if}
                                {component name="/services_impot_verif/ButtonAndDialogForViewContract" contract=$contract}
                                {component name="/google_maps/calculateForContract" contract=$contract}
                                {component name="/geoportal_maps/linkMapForContract" contract=$contract} 
                                {component name="/customers/CopyAndPasteAddressForContract" contract=$contract} 
                                </div>
                            </td>
                        </tr>
                         
                         <tr>
                            <td class="label"> {__('Post code')}
                            </td>
                            <td> 
                                <div class="form-errors">{$form.address.postcode->getError()}</div> 
                                <input type="text" class="CustomerAddressForContract Input" name="postcode" value="{$contract->getCustomer()->getAddress()->get('postcode')}"/>
                                {if $form->address.postcode->getOption('required')}*{/if}
                            </td>
                        </tr>
                         <tr>
                            <td class="label"> {__('City')}
                            </td>
                            <td> 
                                 <div class="form-errors">{$form.address.city->getError()}</div> 
                                <input type="text" class="CustomerAddressForContract Input" size="48" name="city" value="{$contract->getCustomer()->getAddress()->get('city')}"/>                                
                                {if $form->address.city->getOption('required')}*{/if}
                            </td>
                        </tr>
        </table> 
</fieldset>
<script type="text/javascript">
    
     $("#CustomerContract-Save-{$contract->get('id')}").on('parameters', function (event,params) {  
           params.Contract.customer= { };
           params.Contract.address= { };
            $(".CustomerForContract.Input").each(function() { params.Contract.customer[this.name]=$(this).val(); });
            $(".CustomerForContract.Radio:checked").each(function() { params.Contract.customer[this.name]=$(this).val(); }); 
            // Address
            $(".CustomerAddressForContract.Input").each(function() { params.Contract.address[this.name]=$(this).val(); });
            
     });
     
     $(".CustomerAddressForContract,.CustomerForContract").click(function () { 
            $("#CustomerContract-Save-{$contract->get('id')}").show();
     });
     
     
</script>    
{/if}
