 <fieldset class="tab-form" >
        <legend><h3>{__('Customer informations')}</h3></legend>
{if $meeting->isHold()}                   
                    <div class="form-inline">                                               
                        <div class="cols"> 
                            <div class="label">{__("title")}</div>
                            <span style="display: inline-block;">                                                             
                                   <input type="text" disabled="" size="48" value="{format_gender($meeting->getCustomer()->get('gender'),1,true)|capitalize}"/>                             
                            </span>
                       </div>                         
                        <div class="cols"> 
                            <div class="label">{__('Last name')}</div>
                            <span style="display: inline-block;">                                
                                   <input type="text" disabled="" size="48" value="{$meeting->getCustomer()->get('lastname')}"/>                               
                            </span>
                        </div>
                        <div class="cols"> 
                            <div class="label">{__('Firstname')} </div>
                            <span style="display: inline-block;">                              
                                    <input type="text" disabled="" size="48" value="{$meeting->getCustomer()->get('firstname')}"/>                               
                            </span>
                        </div>                  
                        <div class="cols">
                            <div class="label"> {__('Phone')}</div>
                            <span style="display: inline-block;">                                
                                 <input type="text" disabled="" size="48" value="{$meeting->getCustomer()->get('phone')}"/>                               
                            </span>
                        </div>
                        <div class="cols">
                            <div class="label"> {__('Mobile 1')}</div>
                            <span style="display: inline-block;">                                
                                   <input type="text"  disabled="" size="48" value="{$meeting->getCustomer()->get('mobile')}"/>                              
                            </span>
                        </div>
                        <div class="cols">
                            <div class="label"> {__('Mobile 2')}</div>
                            <span style="display: inline-block;">                                
                                <input type="text" class=""  disabled="" size="48" value="{$meeting->getCustomer()->get('mobile2')}" />                              
                            </span>
                        </div>
                        <div class="cols">
                            <div class="label"> {__('Email')}</div>
                            <span style="display: inline-block;">                                 
                                <input type="text" class="" disabled="" size="48" value="{$meeting->getCustomer()->get('email')}" />                              
                            </span>
                        </div>
                        <div class="cols">
                            <div class="label"> {__('Address')}</div>
                            <span style="display: inline-block;">   
                                {if $user->hasCredential([['admin','superadmin']])}
                                <div>(<span id="coordinates">{$meeting->getCustomer()->getAddress()->getCoordinates()}</span>)</div>
                                {/if}                                
                                <div>                                    
                                    <input type="text" disabled="" size="48" value="{$meeting->getCustomer()->getAddress()->getAddress1()->escapeHtml()}"/>                                                                     
                                </div>                                                                
                                <div>                                    
                                            <input type="text" size="48" disabled="" value="{$meeting->getCustomer()->getAddress()->getAddress2()->escapeHtml()}"/>                                    
                                </div>
                            </span>
                        </div>                         
                        <div class="cols">
                            <div class="label"> {__('Post code')}</div>
                            <span style="display: inline-block;">
                                <input type="text" disabled="" size="48" value="{$meeting->getCustomer()->getAddress()->get('postcode')}"/>                                   
                            </span>
                        </div>
                        <div class="cols">
                            <div class="label"> {__('City')}</div>
                            <span style="display: inline-block;">
                                <input type="text" disabled="" size="48" value="{$meeting->getCustomer()->getAddress()->get('city')}"/>                                   
                            </span>
                        </div>
                    </div>                                             
{else}    
    
            
                    <div class="form-inline">                                                  
                        <div class="cols w-100">
                            <div class="label">{__("title")}</div>
                            <span style="display: inline-block;">
                               {if $user->hasCredential([['superadmin','admin','meeting_modify']])} 
                                <div class="error-form">{$form.customer.gender->getError()}</div> 
                                 {foreach $form->customer.gender->getOption("choices") as $name=>$gender}
                                         <input type="radio" style="width:auto;" class="Customer-{$meeting->get('id')}" name="gender" value="{$name}" {if $meeting->getCustomer()->get('gender')==$name}checked="checked"{/if}/>
                                         <span>{format_gender($gender,1,true)|capitalize}</span>
                                  {/foreach} 
                               {else}
                                   <input type="text" disabled="" value="{format_gender($meeting->getCustomer()->get('gender'),1,true)|capitalize}"/>
                               {/if}    
                            </span>
                       </div>                         
                       <div class="cols">
                            <div class="label">{__('Last name')}{if $form->customer.lastname->getOption('required')}*{/if}</div>
                            <span style="display: inline-block;"> 
                                {if $user->hasCredential([['superadmin','admin','meeting_modify']])} 
                                <div class="form-errors">{$form.customer.lastname->getError()}</div>
                                <input type="text" class="red-input Customer-{$meeting->get('id')}" size="30" name="lastname" value="{$meeting->getCustomer()->get('lastname')}"/>
                                {else}
                                    <input type="text" disabled=""  class="red-input" value="{$meeting->getCustomer()->get('lastname')}"/> 
                                {/if}
                            </span>
                        </div>
                        <div class="cols">
                            <div class="label">{__('Firstname')} {if $form->customer.firstname->getOption('required')}*{/if}</div>
                            <span style="display: inline-block;">
                                {if $user->hasCredential([['superadmin','admin','meeting_modify']])} 
                                <div class="form-errors">{$form.customer.firstname->getError()}</div>
                                <input type="text" class="red-input Customer-{$meeting->get('id')}" size="30" name="firstname" value="{$meeting->getCustomer()->get('firstname')}"/>
                                {else}
                                    <input type="text" class="red-input" disabled="" value="{$meeting->getCustomer()->get('firstname')}"/>
                                {/if}
                            </span>
                        </div>                  
                        <div class="cols">
                            <div class="label"> {__('Phone')}{if $form->customer.phone->getOption('required')}*{/if}</div>
                            <span style="display: inline-block;">
                                 {if $user->hasCredential([['superadmin','admin','meeting_modify']])} 
                                <div class="form-errors">{$form.customer.phone->getError()}</div>
                                <input type="text" class="red-input Customer-{$meeting->get('id')} red-input" name="phone" value="{$meeting->getCustomer()->get('phone')}"/>
                                {else}
                                 <input type="text" disabled="" class="red-input" value="{$meeting->getCustomer()->get('phone')}"/>
                                 {/if}
                            </span>
                        </div>
                        <div class="cols">
                            <div class="label"> {__('Mobile 1')}{if $form->customer.mobile->getOption('required')}*{/if}</div>
                            <span style="display: inline-block;">
                                 {if $user->hasCredential([['superadmin','admin','meeting_modify']])} 
                                 <div class="form-errors">{$form.customer.mobile->getError()}</div>
                                <input type="text" class="red-input Customer-{$meeting->get('id')} red-input" name="mobile" value="{$meeting->getCustomer()->get('mobile')}"/>
                                {else}
                                    <input type="text" class="red-input"  disabled="" value="{$meeting->getCustomer()->get('mobile')}"/>
                                {/if}
                            </span>
                        </div>
                        <div class="cols">
                            <div class="label"> {__('Mobile 2')}</div>
                            <span style="display: inline-block;">
                                 {if $user->hasCredential([['superadmin','admin','meeting_modify']])} 
                                 <div class="form-errors">{$form.customer.mobile2->getError()}</div>
                                <input type="text" class="blue-input Customer-{$meeting->get('id')}" name="mobile2" value="{$meeting->getCustomer()->get('mobile2')}" />
                                {else}
                                    <input type="text" class="blue-input"  disabled="" value="{$meeting->getCustomer()->get('mobile2')}" />
                                {/if}
                            </span>
                        </div>
                        <div class="cols">
                            <div class="label"> {__('Email')}</div>
                            <span style="display: inline-block;">
                                {if $user->hasCredential([['superadmin','admin','meeting_modify']])} 
                                 <div class="form-errors">{$form.customer.email->getError()}</div>
                                <input type="text" class="blue-input Customer-{$meeting->get('id')} yellow-input" size="30" name="email" value="{$meeting->getCustomer()->get('email')}" />
                                {else}
                                    <input type="text" disabled="" class="blue-input" value="{$meeting->getCustomer()->get('email')}" />
                                {/if}
                            </span>
                        </div>
                        <div class="cols">
                            <div class="label"> {__('Address')}</div>
                            <span style="display: inline-block;">
                                {if $user->hasCredential([['admin','superadmin']])}
                                <div>(<span id="coordinates">{$meeting->getCustomer()->getAddress()->getCoordinates()}</span>)</div>
                                {/if}
                                <div class="form-errors">{$form.address.address1->getError()}</div>
                                <div>
                                    {if $user->hasCredential([['superadmin','admin','meeting_modify']])} 
                                        <input type="text" style="" class="red-input CustomerAddress-{$meeting->get('id')}" size="38" name="address1" value="{$meeting->getCustomer()->getAddress()->getAddress1()->escapeHtml()}"/>
                                    {else}
                                        <input type="text" disabled="" class="red-input" value="{$meeting->getCustomer()->getAddress()->get('address1')|upper}"/>
                                    {/if}
                                    <span style="font-size: 8px;">
                                    {if $user->hasCredential([['admin','superadmin']])}                                    
                                    <a href="#" id="CustomerAddress-Calculation" title="{__('Coordinates calculation')}">
                                    <i class="fa fa-globe fa-2x" style=" margin-right: 10px"></i></a>                                                               
                                    {/if}
                                     {component name="/services_impot_verif/ButtonAndDialog" meeting=$meeting}
                                    </span>
                                </div>                                                                
                                
                            </span>
                        </div>
                          <div class="cols">
                            <div class="label"> {__('Address complement')}</div>
                            <span style="display: inline-block;">
                              <div>
                                    {if $user->hasCredential([['superadmin','admin','meeting_modify']])} 
                                        <input type="text" class="CustomerAddress-{$meeting->get('id')} blue-input" size="38" name="address2" value="{$meeting->getCustomer()->getAddress()->getAddress2()->escapeHtml()}"/>
                                    {else}
                                        <input type="text" class="blue-input" disabled="" value="{$meeting->getCustomer()->getAddress()->get('address2')|upper}"/>
                                    {/if}
                                     
                                </div>
                            </span>
                        </div>
                        <div class="cols">
                            <div class="label"> {__('Post code')}{if $form->address.postcode->getOption('required')}*{/if}</div>
                            <span style="display: inline-block;">{if $user->hasCredential([['superadmin','admin','meeting_modify']])}  
                                <div class="form-errors">{$form.address.postcode->getError()}</div> 
                                <input type="text" class="red-input CustomerAddress-{$meeting->get('id')}" name="postcode" value="{$meeting->getCustomer()->getAddress()->get('postcode')}"/>                                
                                {else}
                                    <input type="text" disabled="" class="red-input" value="{$meeting->getCustomer()->getAddress()->get('postcode')}"/>    
                                {/if}
                            </span>
                        </div>
                        <div class="cols">
                            <div class="label"> {__('City')}</div>
                            <span style="display: inline-block;">{if $user->hasCredential([['superadmin','admin','meeting_modify']])}  
                                <div class="form-errors">{$form.address.city->getError()}</div> 
                                <input type="text" class="red-input CustomerAddress-{$meeting->get('id')}" size="30" name="city" value="{$meeting->getCustomer()->getAddress()->get('city')}"/>
                                <div id="cities-container-{$meeting->get('id')}"></div>
                                {else}
                                    <input type="text" class="red-input" disabled="" value="{$meeting->getCustomer()->getAddress()->get('city')}"/>    
                                {/if}
                            </span>
                        </div>
                    </div>                                                
        
                            </fieldset> 
<script type="text/javascript">
    
    $(".CustomerAddress-{$meeting->get('id')}[name=postcode]").keyup(function() {
          if ($(this).val().length<=2)
          {                              
             $("#cities-container-{$meeting->get('id')}").html('');  
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
                                $("#cities-container-{$meeting->get('id')}").html('<select id="cities-{$meeting->get('id')}"></select>');  
                                $.each(response,function () {
                                    $("#cities-{$meeting->get('id')}").append('<option value="'+this.postalcode+'|'+this.city+'">'+this.postalcode+' '+this.city+'</option>');
                                });
                            }
                            else
                                $("#cities-container-{$meeting->get('id')}").html("{__('no city exists')}");
                      }
                 });     
                      
    });
    
     $(document).on('click',"#cities-{$meeting->get('id')}",function () { 
             city_postcode=$("#cities-{$meeting->get('id')}").val().split('|');
             $(".CustomerAddress-{$meeting->get('id')}[name=postcode]").val(city_postcode[0]);
             $(".CustomerAddress-{$meeting->get('id')}[name=city]").val(city_postcode[1]);
     });
    
</script>   
{/if}