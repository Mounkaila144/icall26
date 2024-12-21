{if $contract->isHold()}
    <fieldset class="tab-form">
        <legend><h3>{__('Customer informations')}</h3></legend>
        <div class="form-inline">
            <div class="cols w-100" style="text-align: center;">
                <div class="label">{__("title")}</div>
                <span style="display: inline-block;">
                    {format_gender($contract->getCustomer()->get('gender'),1,true)|capitalize|upper} 
                </span>
            </div>
            <div class="cols">
                <div  class="label">{__('Last name')}</div>
                <span style="display: inline-block;">                                  
                   : {$contract->getCustomer()->get('lastname')|upper}
                </span>
            </div>
            <div class="cols">
                <div  class="label">{__('Firstname')} </div>
                <span style="display: inline-block;">                               
                    : {$contract->getCustomer()->get('firstname')|upper}
                </span>
            </div>
            <div class="cols">
               <div  class="label"> {__('phone')}</div>
               <span style="display: inline-block;">

                 : {$contract->getCustomer()->get('phone')}
               </span>
           </div>                
            {*  <div class="cols">
                <div  class="label">{__('Age')} </div>
                <span style="display: inline-block;">
                    : {$customer->get('age')}
                </span>
            </div> *}  
            <div class="cols">
                <div  class="label"> {__('Mobile 1')} </div>
                <span style="display: inline-block;">
                  : {$contract->getCustomer()->get('mobile')}
                </span>
            </div>
            <div class="cols">
               <div  class="label"> {__('Mobile 2')} </div>
               <span style="display: inline-block;">
                 : {$contract->getCustomer()->get('mobile2')}
               </span>
            </div>
            <div class="cols">
               <div  class="label"> {__('Email')} </div>
               <span style="display: inline-block;">
                  : {$contract->getCustomer()->get('email')|upper}
               </span>
            </div>               
            <div class="cols">
                <div  class="label"> {__('Address')}</div>
                <span style="display: inline-block;">                                                     
                   : {$contract->getCustomer()->getAddress()->getAddress1()->upper()}
                     
                </span>
            </div>  
                 <div class="cols">
                <div  class="label"> {__('Address Complement')}</div>
                <span style="display: inline-block;">                                                     
                 
                     {$contract->getCustomer()->getAddress()->getAddress2()->upper()}
                </span>
            </div>  
            <div class="cols">
                <div  class="label"> {__('postcode')}</div>
                <span style="display: inline-block;">  
                   : {$contract->getCustomer()->getAddress()->get('postcode')}
                </span>
            </div>
            <div class="cols">
               <div  class="label"> {__('city')} </div>
               <span style="display: inline-block;">  
                   : {$contract->getCustomer()->getAddress()->get('city')|upper}
               </span>
            </div>   
                
        </div>
           
</fieldset>                              
{else}
        <fieldset class="tab-form">
            <legend><h3>{__('Customer informations')}</h3></legend>
            <div class="form-inline">
                <div class="cols w-100" style="text-align: center;">
                    <div class="label">{__("title")}</div>
                    <span style="display: inline-block;">
                          <div>{$form.customer.gender->getError()}</div> 
                         {foreach $form->customer.gender->getOption("choices") as $name=>$gender}
                             <input type="radio" style="width: auto;" class="CustomerForContract Radio" name="gender" value="{$name}" {if $contract->getCustomer()->get('gender')==$name}checked="checked"{/if}/>
                                 <span>{format_gender($gender,1,true)|capitalize}</span>
                          {/foreach}                            
                    </span>
                </div>  
                <div class="cols">
                    <div class="label">{__('Last name')}{if $form->customer.lastname->getOption('required')}*{/if}</div>
                    <span style="display: inline-block;">                                  
                         <div class="form-errors">{$form.customer.lastname->getError()}</div>
                        <input type="text" class="CustomerForContract Input red-input" size="48" name="lastname" value="{$contract->getCustomer()->get('lastname')}"/>                        
                    </span>
                </div>                    
                <div class="cols">
                   <div class="label">{__('Firstname')} {if $form->customer.firstname->getOption('required')}*{/if}</div>
                   <span style="display: inline-block;">                               
                       <div class="form-errors">{$form.customer.firstname->getError()}</div>
                       <input type="text" class="CustomerForContract Input red-input" size="48" name="firstname" value="{$contract->getCustomer()->get('firstname')}"/>                       
                   </span>
               </div> 
            {*    <div class="cols">
                     <div class="label">{__('Age')}</div>
                     <span style="display: inline-block;">
                        <div class="form-errors">{$form.customer.age->getError()}</div>
                         <input type="text" class="Customer" name="age" value="{$contract->getCustomer()->get('age')}"/>
                     </span>
                 </div> *}  

                <div class="cols">
                   <div class="label"> {__('phone')}{if $form->customer.phone->getOption('required')}*{/if}</div>
                   <span style="display: inline-block;"> 
                       <div class="form-errors">{$form.customer.phone->getError()}</div>
                       <input type="text" class="CustomerForContract Input red-input" name="phone" value="{$contract->getCustomer()->get('phone')}"/>                     
                   </span>
               </div>
                <div class="cols">
                    <div class="label"> {__('Mobile 1')}{if $form->customer.mobile->getOption('required')}*{/if}</div>
                    <span style="display: inline-block;"> 
                         <div class="form-errors">{$form.customer.mobile->getError()}</div>
                        <input type="text" class="CustomerForContract Input red-input" name="mobile" value="{$contract->getCustomer()->get('mobile')}"/>                       
                    </span>
                </div>
                <div class="cols">
                    <div class="label"> {__('Mobile 2')}{if $form->customer.mobile2->getOption('required')}*{/if}</div>
                    <span style="display: inline-block;">
                         <div class="form-errors">{$form.customer.mobile2->getError()}</div>
                        <input type="text" class="CustomerForContract Input blue-input" name="mobile2" value="{$contract->getCustomer()->get('mobile2')}" />                        
                    </span>
                </div>
                <div class="cols">
                   <div class="label"> {__('Email')}</div>
                   <span style="display: inline-block;">
                        <div class="form-errors">{$form.customer.email->getError()}{if $form->customer.email->getOption('required')}*{/if}</div>
                       <input type="text" class="CustomerForContract Input blue-input" size="48" name="email" value="{$contract->getCustomer()->get('email')}" />                        
                   </span>
               </div>
                <div class="cols">
                    <div class="label"> {__('Address')}{if $form->address.address1->getOption('required')}*{/if}</div>
                    <span style="display: inline-block;">                                                     
                        <div class="form-errors">{$form.address.address1->getError()}</div>
                        <div><input type="text" class="CustomerAddressForContract Input red-input" size="64" name="address1" value="{$contract->getCustomer()->getAddress()->getAddress1()->escapeHtml()}"/></div>
                      
                    </span>
                </div>
                 <div class="cols">
                    <div class="label"> {__('Address complement')}{if $form->address.address2->getOption('required')}*{/if}</div>
                    <span style="display: inline-block;">                                                     
                        <div class="form-errors">{$form.address.address2->getError()}</div>
                         <div><input type="text" style="margin: 5px;margin-left: 35px;" class="CustomerAddressForContract Input blue-input" size="64" name="address2" value="{$contract->getCustomer()->getAddress()->getAddress2()->escapeHtml()}"/>                             
                        {component name="/services_impot_verif/ButtonAndDialogForViewContract" contract=$contract}
                        {component name="/google_maps/calculateForContract" contract=$contract}
                        {component name="/geoportal_maps/linkMapForContract" contract=$contract} 
                        {component name="/customers/CopyAndPasteAddressForContract" contract=$contract} 
                        </div>
                    </span>
                </div>  
                <div class="cols">
                    <div class="label"> {__('postcode')}{if $form->address.postcode->getOption('required')}*{/if}</div>
                    <span style="display: inline-block;"> 
                        <div class="form-errors">{$form.address.postcode->getError()}</div> 
                        <input type="text" class="CustomerAddressForContract Input red-input" name="postcode" value="{$contract->getCustomer()->getAddress()->get('postcode')}"/>                        
                    </span>
                </div>                
                <div class="cols">
                    <div class="label"> {__('city')}{if $form->address.city->getOption('required')}*{/if}</div>
                    <span style="display: inline-block;">  
                         <div class="form-errors">{$form.address.city->getError()}</div> 
                        <input type="text" class="CustomerAddressForContract Input red-input" size="48" name="city" value="{$contract->getCustomer()->getAddress()->get('city')}"/>                                                        
                    </span>
                </div>                  
            </div>  
</fieldset>
<script type="text/javascript">
    
     $("#CustomerContract-Save-{$contract->get('id')},#CustomerContract-Top-Save-{$contract->get('id')}").on('parameters', function (event,params) {  
           params.Contract.customer= { };
           params.Contract.address= { };
            $(".CustomerForContract.Input").each(function() { params.Contract.customer[this.name]=$(this).val(); });
            $(".CustomerForContract.Radio:checked").each(function() { params.Contract.customer[this.name]=$(this).val(); }); 
            // Address
            $(".CustomerAddressForContract.Input").each(function() { params.Contract.address[this.name]=$(this).val(); });
            
     });
     
     $(".CustomerAddressForContract,.CustomerForContract").click(function () { 
            $("#CustomerContract-Save-{$contract->get('id')},#CustomerContract-Top-Save-{$contract->get('id')}").show();
     });
     
     
</script>    
{/if}
