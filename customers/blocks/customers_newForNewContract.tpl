<fieldset class="tab-form">
    <legend><h3>{__('Customer informations')}</h3></legend>  
    <div class="form-inline">
        {if $user->hasCredential([['superadmin','contract_new_company']])}        
            <div class="cols">
               <div class="label">{__("Company")}</div>
               <span>                      
                    <div class="form-errors">{$form.customer.company->getError()}</div> 
                    <input type="text" class="red-input CustomerForNewContract" size="40" name="company" value="{$contract->getCustomer()->get('company')}"/>
               </span>
            </div> 
        {/if}  
        <div class="cols w-100" >
            <div class="label">{__("title")}</div><br>
            <div style="display: inline-block;">
                <div class="form-errors">{$form.customer.gender->getError()}</div> 
                 {foreach $form->customer.gender->getOption("choices") as $name=>$gender}
                         <input style="width: auto;" type="radio" class="CustomerForNewContract" name="gender" value="{$name}" {if $contract->getCustomer()->get('gender')==$name}checked="checked"{/if}/>
                         <span>{format_gender($gender,1,true)|capitalize}</span>
                  {/foreach} 
            </div>
        </div>
        <div class="cols">
            <div class="label">{__('Last name')}{if $form->customer.lastname->getOption('required')}*{/if}</div>
            <span style="display: inline-block;">  
                <div class="form-errors">{$form.customer.lastname->getError()}</div>
                <input type="text" class="red-input CustomerForNewContract" size="30" name="lastname" value="{$contract->getCustomer()->get('lastname')}"/>                
            </span>
        </div>
        <div class="cols">
            <div class="label">{__('Firstname')} {if $form->customer.firstname->getOption('required')}*{/if}</div>
            <span style="display: inline-block;">
                <div class="form-errors">{$form.customer.firstname->getError()}</div>
                <input type="text" class="red-input CustomerForNewContract" size="30" name="firstname" value="{$contract->getCustomer()->get('firstname')}"/>                
            </span>
        </div> 
         <div class="cols">
            <div class="label"> {__('Phone')}{if $form->customer.phone->getOption('required')}*{/if}</div>
            <span style="display: inline-block;">
                <div class="form-errors">{$form.customer.phone->getError()}</div>
                <input type="text" class="red-input CustomerForNewContract" name="phone" value="{$contract->getCustomer()->get('phone')}"/>                
            </span>
        </div>
        <div class="cols">
            <div class="label"> {__('Mobile 1')}{if $form->customer.mobile->getOption('required')}*{/if}</div>
            <span style="display: inline-block;">
                <div class="form-errors">{$form.customer.mobile->getError()}</div>
                <input type="text" class="red-input CustomerForNewContract" name="mobile" value="{$contract->getCustomer()->get('mobile')}"/>                
            </span>
        </div> 
        <div class="cols">
            <div class="label"> {__('Mobile 2')}{if $form->customer.mobile2->getOption('required')}*{/if} </div>
            <span style="display: inline-block;">
                 <div class="form-errors">{$form.customer.mobile2->getError()}</div>
                <input type="text" class="blue-input CustomerForNewContract" name="mobile2" value="{$contract->getCustomer()->get('mobile2')}" />                
            </span>
        </div>
        <div class="cols">
            <div class="label"> {__('Email')}{if $form->customer.email->getOption('required')}*{/if}</div>
            <span style="display: inline-block;">
                <div class="form-errors">{$form.customer.email->getError()}</div>
                <input type="text" class="blue-input CustomerForNewContract " size="30" name="email" value="{$contract->getCustomer()->get('email')}" />                
            </span>
        </div>
            
        <div class="cols">
            <div class="label"> {__('Address')}{if $form->address.address1->getOption('required')}*{/if}{if $form->address.address2->getOption('required')}*{/if}</div>
            <span style="display: inline-block;"> 
                <div class="form-errors">{$form.address.address1->getError()}</div>
                <input type="text" class="red-input CustomerAddressForNewContract" size="38" name="address1" value="{$contract->getCustomer()->getAddress()->getAddress1()->escapeHtml()}"/>
                        </span>
        </div>
             <div class="cols">
            <div class="label"> {__('Address complement')}{if $form->address.address2->getOption('required')}*{/if}</div>
            <span style="display: inline-block;"> 
                <div class="form-errors">{$form.address.address1->getError()}</div>
               <input type="text" class="blue-input CustomerAddressForNewContract" style=" " size="38" name="address2" value="{$contract->getCustomer()->getAddress()->getAddress2()->escapeHtml()}"/>                
                {component name="/services_impot_verif/ButtonAndDialogForNewContract"}                                
            </span>
        </div>
        <div class="cols">
            <div class="label"> {__('Post code')}{if $form->address.postcode->getOption('required')}*{/if}</div>
            <span style="display: inline-block;"> <div class="form-errors">{$form.address.postcode->getError()}</div> 
                <input type="text" class="red-input CustomerAddressForNewContract" name="postcode" value="{$contract->getCustomer()->getAddress()->get('postcode')}"/>               
            </span>
        </div>
        <div class="cols">
            <div class="label"> {__('City')}{if $form->address.city->getOption('required')}*{/if}</div>
            <span style="display: inline-block;"> <div class="form-errors">{$form.address.city->getError()}</div> 
                <input type="text" class="red-input CustomerAddressForNewContract" size="30" name="city" value="{$contract->getCustomer()->getAddress()->get('city')}"/>                
                <div id="cities-container-new"></div>
            </span>
        </div>
    </div>                         
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