{messages class="ContractCustomer-errors"}
<div>
    <a href="#" class="btn" id="ContractCustomer-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" class="btn" id="ContractCustomer-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>   
</div>
{if $contract->isLoaded()}
<fieldset>  
   <table>
        <tr>
            <td>
                <fieldset>                  
                    <table> 
                        {if $user->hasCredential([['superadmin','contract_view_company','contract_modify_company']])}        
                      {*  <tr>
                            <td>{__("Company")}</td>
                            <td>
                                {if $form->customer->hasValidator('company')}
                                  <div>{$form.customer.company->getError()}</div> 
                                    <input type="text" class="Customer" size="48" name="company" value="{$contract->getCustomer()->get('company')}"/>                       
                                {else}
                                     <input type="text" readonly="" disable="" size="48" value="{$contract->getCustomer()->get('company')}"/>     
                                {/if}    
                            </td>
                       </tr> *}
                       {/if}
                         <tr>
                            <td>{__("title")}</td>
                            <td>
                                  <div>{$form.customer.gender->getError()}</div> 
                                 {foreach $form->customer.gender->getOption("choices") as $name=>$gender}
                                         <input type="radio" class="Customer" name="gender" value="{$name}" {if $contract->getCustomer()->get('gender')==$name}checked="checked"{/if}/>
                                         <span>{format_gender($gender,1,true)|capitalize}</span>
                                  {/foreach}                            
                            </td>
                       </tr>                         
                        <tr>
                            <td>{__('Last name')}
                            </td>
                            <td>                                  
                                 <div class="form-errors">{$form.customer.lastname->getError()}</div>
                                <input type="text" class="Customer" size="48" name="lastname" value="{$contract->getCustomer()->get('lastname')}"/>
                            </td>
                        </tr>
                         <tr>
                            <td>{__('Firstname')} </td>
                            <td>                               
                                <div class="form-errors">{$form.customer.firstname->getError()}</div>
                                <input type="text" class="Customer" size="48" name="firstname" value="{$contract->getCustomer()->get('firstname')}"/>
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
                            <td> {__('Phone')}
                            </td>
                            <td>
                                <div class="form-errors">{$form.customer.phone->getError()}</div>
                                <input type="text" class="Customer" name="phone" value="{$contract->getCustomer()->get('phone')}"/> 
                             
                            </td>
                        </tr>
                         <tr>
                            <td> {__('Mobile 1')}
                            </td>
                            <td>
                                 <div class="form-errors">{$form.customer.mobile->getError()}</div>
                                <input type="text" class="Customer yellow-input" name="mobile" value="{$contract->getCustomer()->get('mobile')}"/>
                               
                            </td>
                        </tr>
                         <tr>
                            <td> {__('Mobile 2')}
                            </td>
                            <td>
                                 <div class="form-errors">{$form.customer.mobile2->getError()}</div>
                                <input type="text" class="Customer" name="mobile2" value="{$contract->getCustomer()->get('mobile2')}"/>
                               
                            </td>
                        </tr>
                         <tr>
                            <td> {__('Email')}
                            </td>
                            <td>
                                 <div class="form-errors">{$form.customer.email->getError()}</div>
                                <input type="text" class="Customer" size="48" name="email" value="{$contract->getCustomer()->get('email')}"/>
                            </td>
                        </tr>
                        <tr>
                            <td> {__('Address')}
                            </td>
                            <td>                                                     
                                <div class="form-errors">{$form.address.address1->getError()}</div>
                                <div><input type="text" class="CustomerAddress" size="64" name="address1" value="{$contract->getCustomer()->getAddress()->getAddress1()->escapeHtml()}"/></div>
                                <div><input type="text" class="CustomerAddress" size="64" name="address2" value="{$contract->getCustomer()->getAddress()->getAddress2()->escapeHtml()}"/></div>
                            </td>
                        </tr>
                         
                         <tr>
                            <td> {__('Post code')}
                            </td>
                            <td> 
                                <div class="form-errors">{$form.address.postcode->getError()}</div> 
                                <input type="text" class="CustomerAddress" name="postcode" value="{$contract->getCustomer()->getAddress()->get('postcode')}"/>
                            </td>
                        </tr>
                         <tr>
                            <td> {__('City')}
                            </td>
                            <td> 
                                 <div class="form-errors">{$form.address.city->getError()}</div> 
                                <input type="text" class="CustomerAddress" size="48" name="city" value="{$contract->getCustomer()->getAddress()->get('city')}"/>
                                {component name="/services_impot_verif/ButtonAndDialogForContract" contract=$contract}
                            </td>
                        </tr>
                    </table>
                </fieldset>                     
            </td>
</table>
{else}
    <span>{__('Contract is invalid.')}</span>
{/if}    
<script type="text/javascript">
    
    $(".Customer,.CustomerAddress").click(function () { $("#ContractCustomer-Save").show(); } );
    
    $("#ContractCustomer-Cancel").click(function(){            
       return $.ajax2({                    
                data : { Contract: "{$contract->get('id')}" },
                url: "{url_to('customers_ajax',['action'=>'ViewCustomerForContract'])}",
                errorTarget: ".site-contract-errors-{$contract->get('id')}",
                loading: "#tab-site-dashboard-customers-contract-loading",                            
                target: "#tab-customer-contracts-customer-{$contract->get('id')}"
           });  
    
    });
    
    $("#ContractCustomer-Save").click(function(){
       var params = { 
                    Contract: "{$contract->get('id')}",
                    CustomerContract: { customer: { }, address: { },token :'{$form->getCSRFToken()}' }
       };
       
       // Customer
            $("input.Customer[type=text]").each(function() { params.CustomerContract.customer[this.name]=$(this).val(); });
            $("input.Customer[type=radio]:checked").each(function() { params.CustomerContract.customer[this.name]=$(this).val(); }); 
            // Address
            $("input.CustomerAddress[type=text]").each(function() { params.CustomerContract.address[this.name]=$(this).val(); });
            
      //   alert("Params="+params.toSource()); return false;     
       return $.ajax2({                    
                data : params,
                url: "{url_to('customers_ajax',['action'=>'SaveCustomerForContract'])}",
                errorTarget: ".site-contract-errors-{$contract->get('id')}",
                loading: "#tab-site-dashboard-customers-contract-loading",                            
                target: "#tab-customer-contracts-customer-{$contract->get('id')}"
           }); 
    
    });
</script>     