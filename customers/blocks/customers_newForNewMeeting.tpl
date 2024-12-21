
 <fieldset class="tab-form" style="width: auto;padding-bottom: 30px;">
        <legend><h3>{__('Customer informations')}</h3></legend>                 
                    <div class="form-inline">
                       {if $user->hasCredential([['superadmin','meeting_new_company']]) && $form->customer->hasValidator('company')}        
                        <div class="cols">
                            <div class="label">{__("Company")}</div>
                            <span>                                  
                                    <div class="form-errors">{$form.customer.company->getError()}</div>
                                <input type="text" class="red-input CustomerForNewMeeting" size="30" name="company" value="{$item->getCustomer()->get('company')}"/>{if $form->customer.company->getOption('required')}*{/if}                                                               
                            </span>
                       </div> 
                       {/if}  
                        <div class="cols w-100">
                            <div class="label d-none">{__("title")}</div>
                            <span>
                                <div class="form-errors">{$form.customer.gender->getError()}</div> 
                                 {foreach $form->customer.gender->getOption("choices") as $name=>$gender}
                                         <input style="width: auto;" type="radio" class="CustomerForNewMeeting" name="gender" value="{$name}" {if $item->getCustomer()->get('gender')==$name}checked="checked"{/if}/>
                                         <span>{format_gender($gender,1,true)|capitalize}</span>
                                  {/foreach} 
                            </span>
                        </div>
                        <div class="cols">
                            <div class="label">
                                {__('Last name')}{if $form->customer.lastname->getOption('required')}*{/if}
                            </div>
                            <span>  
                                <div class="form-errors">{$form.customer.lastname->getError()}</div>
                                <input type="text" class="red-input CustomerForNewMeeting" size="30" name="lastname" value="{$item->getCustomer()->get('lastname')}"/>                                
                            </span>
                        </div>
                        <div class="cols">
                            <div class="label">{__('Firstname')} {if $form->customer.firstname->getOption('required')}*{/if}</div>
                            <span>
                                <div class="form-errors">{$form.customer.firstname->getError()}</div>
                                <input type="text" class="red-input CustomerForNewMeeting" size="30" name="firstname" value="{$item->getCustomer()->get('firstname')}"/>                                
                            </span>
                        </div> 
                        {if $form->customer->hasValidator('birthday')}
                        <div class="cols">
                            <div class="label"> {__('Birthday')}{if $form->customer.birthday->getOption('required')}*{/if}
                            </div>
                            <span>
                                <div class="form-errors">{$form.customer.birthday->getError()}</div>
                                <input type="text" class="red-input CustomerForNewMeeting Date" name="birthday" value="{if $form->hasErrors()}{$item->getCustomer()->get('birthday')}{else}{if $item->getCustomer()->hasBirthday()}{$item->getCustomer()->getFormatter()->getBirthday()->getText}{/if}{/if}"/>                                
                            </span>
                        </div>
                        {/if}
                        <div class="cols">
                            <div class="label"> {__('Phone')}{if $form->customer.phone->getOption('required')}*{/if}
                            </div>
                            <span>
                                <div class="form-errors">{$form.customer.phone->getError()}</div>
                                <input type="text" class="red-input CustomerForNewMeeting" name="phone" value="{$item->getCustomer()->get('phone')}"/>                                
                            </span>
                        </div>
                        <div class="cols">
                            <div class="label"> {__('Mobile 1')}{if $form->customer.mobile->getOption('required')}*{/if}
                            </div>
                            <span>
                                 <div class="form-errors">{$form.customer.mobile->getError()}</div>
                                <input type="text" class="red-input CustomerForNewMeeting" name="mobile" value="{$item->getCustomer()->get('mobile')}"/>                                
                            </span>
                        </div>
                        <div class="cols">
                            <div class="label"> {__('Mobile 2')}{if $form->customer.mobile2->getOption('required')}*{/if}
                            </div>
                            <span>
                                 <div class="form-errors">{$form.customer.mobile2->getError()}</div>
                                <input type="text" class="blue-input CustomerForNewMeeting" name="mobile2" value="{$item->getCustomer()->get('mobile2')}" />                                
                            </span>
                        </div>
                        <div class="cols">
                            <div class="label"> {__('Email')}{if $form->customer.email->getOption('required')}*{/if}
                            </div>
                            <span>
                                 <div class="form-errors">{$form.customer.email->getError()}</div>
                                <input type="text" class="blue-input CustomerForNewMeeting yellow-input" size="30" name="email" value="{$item->getCustomer()->get('email')}" />                                
                            </span>
                        </div>
                        <div class="cols">
                            <div class="label"> {__('Address')}{if $form->address.address1->getOption('required')}*{/if} {if $form->address.address2->getOption('required')}*{/if}
                            </div>
                            <span> 
                                <div class="form-errors">{$form.address.address1->getError()}</div>
                                <div>
                                <input type="text" class="red-input CustomerAddressForNewMeeting" size="38" name="address1" value="{$item->getCustomer()->getAddress()->getAddress1()->escapeHtml()}"/>                                
                                </div>
                               
                            </span>
                        </div>
                          <div class="cols">
                            <div class="label"> {__('Address complement')}{if $form->address.address2->getOption('required')}*{/if} 
                            </div>
                            <span> 
                              
                                <div>
                                <input type="text" class="blue-input CustomerAddressForNewMeeting" size="38" name="address2" value="{$item->getCustomer()->getAddress()->getAddress2()->escapeHtml()}"/>                               
                                </div>
                            </span>
                        </div>
                        <div class="cols">
                            <div class="label"> {__('Post code')}{if $form->address.postcode->getOption('required')}*{/if}
                            </div>
                            <span> <div class="form-errors">{$form.address.postcode->getError()}</div> 
                                <input type="text" class="red-input CustomerAddressForNewMeeting" name="postcode" value="{$item->getCustomer()->getAddress()->get('postcode')}"/>                                
                            </span>
                        </div>
                        <div class="cols">
                            <div class="label"> {__('City')}{if $form->address.city->getOption('required')}*{/if}
                            </div>
                            <span> <div class="form-errors">{$form.address.city->getError()}</div> 
                                <input type="text" class="red-input CustomerAddressForNewMeeting" size="30" name="city" value="{$item->getCustomer()->getAddress()->get('city')}"/>                                
                                <div id="cities-container"></div>
                            </span>
                        </div>
                    </div>                                        
</fieldset>  
        
<script type="text/javascript">
    
    $(".CustomerAddressForNewMeeting[name=postcode]").keyup(function() {
          if ($(this).val().length<=2)
          {                              
             $("#cities-container").html('');  
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
                                $("#cities-container").html('<select id="cities"></select>');  
                                $.each(response,function () {
                                    $("#cities").append('<option value="'+this.postalcode+'|'+this.city+'">'+this.postalcode+' '+this.city+'</option>');
                                });
                            }
                            else
                                $("#cities-container").html("{__('no city exists')}");
                      }
                 });     
                      
    });    
         
    $(".CustomerForNewMeeting.Date").datepicker();         
    
     $(document).on('click',"#cities",function () { 
             city_postcode=$("#cities").val().split('|');
             $(".CustomerAddressForNewMeeting[name=postcode]").val(city_postcode[0]);
             $(".CustomerAddressForNewMeeting[name=city]").val(city_postcode[1]);
     });
    
</script>    