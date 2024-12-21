<fieldset>
    <legend><h3>{__('Customer informations')}</h3></legend>
   <table>
        <tr>
            <td>
                <fieldset>
                    <legend> <h3>{__('Main contact')}</h3></legend>
                    <table class="tab-form">                      
                         {if $user->hasCredential([['superadmin','contract_new_company']])}        
                        <tr>
                            <td class="label">{__("Company")}</td>
                            <td>                      
                                 <div class="form-errors">{$form.customer.company->getError()}</div> 
                                 <input type="text" class="CustomerForNewContract" size="40" name="company" value="{$contract->getCustomer()->get('company')}"/>
                            </td>
                       </tr> 
                       {/if}  
                         <tr>
                            <td class="label">{__("title")}</td>
                            <td>
                                <div class="form-errors">{$form.customer.gender->getError()}</div> 
                                 {foreach $form->customer.gender->getOption("choices") as $name=>$gender}
                                         <input type="radio" class="CustomerForNewContract" name="gender" value="{$name}" {if $contract->getCustomer()->get('gender')==$name}checked="checked"{/if}/>
                                         <span>{format_gender($gender,1,true)|capitalize}</span>
                                  {/foreach} 
                            </td>
                       </tr>
                              <tr>
                            <td class="label">{__('Last name')}
                            </td>
                            <td>  
                                <div class="form-errors">{$form.customer.lastname->getError()}</div>
                                <input type="text" class="CustomerForNewContract" size="30" name="lastname" value="{$contract->getCustomer()->get('lastname')}"/>
                                {if $form->customer.lastname->getOption('required')}*{/if}
                            </td>
                        </tr>
                        <tr>
                            <td class="label">{__('Firstname')} </td>
                            <td>
                                <div class="form-errors">{$form.customer.firstname->getError()}</div>
                                <input type="text" class="CustomerForNewContract" size="30" name="firstname" value="{$contract->getCustomer()->get('firstname')}"/>
                                {if $form->customer.firstname->getOption('required')}*{/if}
                            </td>
                        </tr>                                 
                         <tr>
                            <td class="label"> {__('Phone')}
                            </td>
                            <td>
                                <div class="form-errors">{$form.customer.phone->getError()}</div>
                                <input type="text" class="CustomerForNewContract" name="phone" value="{$contract->getCustomer()->get('phone')}"/>
                                {if $form->customer.phone->getOption('required')}*{/if}
                            </td>
                        </tr>
                         <tr>
                            <td class="label"> {__('Mobile 1')}
                            </td>
                            <td>
                                 <div class="form-errors">{$form.customer.mobile->getError()}</div>
                                <input type="text" class="CustomerForNewContract" name="mobile" value="{$contract->getCustomer()->get('mobile')}"/>
                                {if $form->customer.mobile->getOption('required')}*{/if}
                            </td>
                        </tr>
                         <tr>
                            <td class="label"> {__('Mobile 2')}
                            </td>
                            <td>
                                 <div class="form-errors">{$form.customer.mobile2->getError()}</div>
                                <input type="text" class="CustomerForNewContract" name="mobile2" value="{$contract->getCustomer()->get('mobile2')}"/>
                                {if $form->customer.mobile2->getOption('required')}*{/if}
                            </td>
                        </tr>
                         <tr>
                            <td class="label"> {__('Email')}
                            </td>
                            <td>
                                 <div class="form-errors">{$form.customer.email->getError()}</div>
                                <input type="text" class="CustomerForNewContract" size="30" name="email" value="{$contract->getCustomer()->get('email')}"/>
                                {if $form->customer.email->getOption('required')}*{/if}
                            </td>
                        </tr>
                        <tr>
                            <td class="label"> {__('Address')}
                            </td>
                            <td> 
                                <div class="form-errors">{$form.address.address1->getError()}</div>
                                <div>
                                <input type="text" class="CustomerAddressForNewContract" size="38" name="address1" value="{$contract->getCustomer()->getAddress()->get('address1')}"/>
                                {if $form->address.address1->getOption('required')}*{/if}
                                </div>
                                <div>
                                <input type="text" class="CustomerAddressForNewContract" size="38" name="address2" value="{$contract->getCustomer()->getAddress()->get('address2')}"/>
                                {if $form->address.address2->getOption('required')}*{/if}
                                </div>
                            </td>
                        </tr>
                         
                         <tr>
                            <td class="label"> {__('Post code')}
                            </td>
                            <td> <div class="form-errors">{$form.address.postcode->getError()}</div> 
                                <input type="text" class="CustomerAddressForNewContract" name="postcode" value="{$contract->getCustomer()->getAddress()->get('postcode')}"/>
                                {if $form->address.postcode->getOption('required')}*{/if}
                            </td>
                        </tr>
                         <tr>
                            <td class="label"> {__('City')}
                            </td>
                            <td> <div class="form-errors">{$form.address.city->getError()}</div> 
                                <input type="text" class="CustomerAddressForNewContract" size="30" name="city" value="{$contract->getCustomer()->getAddress()->get('city')}"/>
                                {if $form->address.city->getOption('required')}*{/if}
                                <div id="cities-container-new"></div>
                            </td>
                        </tr>
                    </table>
                </fieldset>               
            </td>          
        </tr>
    </table>  
</fieldset>  
<script type="text/javascript">
    
    $(".CustomerAddressForNewContract[name=postcode]").keyup(function() {
          if ($(this).val().length<=2)
          {                              
             $("#cities-container-new").html('');  
             return false;
          }    
         return $.ajax2({ data : { City: {
                         country:"{$customer_settings->get('default_country')}",
                         postcode: $(this).val()
                                  }
                      },
                      url: "{url_to('utils_city_ajax',['action'=>'CityMaster'])}",
                      success:function(response) {
                            if (response.length)
                            {    
                                $("#cities-container-new").html('<select id="cities-new"></select>');  
                                $.each(response,function () {
                                    $("#cities-new").append('<option value="'+this.postalcode+'|'+this.city+'">'+this.postalcode+' '+this.city+'</option>');
                                });
                            }
                            else
                                $("#cities-container-new").html("{__('no city exists')}");
                      }
                 });     
                      
    });
    
     $(document).on('click',"#cities-new",function () { 
             city_postcode=$("#cities-new").val().split('|');
             $(".CustomerAddressForNewContract[name=postcode]").val(city_postcode[0]);
             $(".CustomerAddressForNewContract[name=city]").val(city_postcode[1]);
     });
    
</script>            