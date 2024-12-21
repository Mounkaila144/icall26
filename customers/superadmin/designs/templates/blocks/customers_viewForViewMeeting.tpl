<fieldset>
   <h3>{__('Contacts')}</h3>
   <table>
        <tr>
            <td>
                <fieldset>
                    <h3>{__('Main contact')}</h3>
                    <table>
                        {if $meeting->getCustomer()->isLoaded()}
                        <tr>
                            <td>
                                {__('id')}
                            </td>
                            <td>
                                {$meeting->getCustomer()->get('id')}
                            </td>
                        </tr>
                        {/if} 
                         <tr>
                            <td>{__("title")}</td>
                            <td>
                                <div>{$form.customer.gender->getError()}</div> 
                                 {foreach $form->customer.gender->getOption("choices") as $name=>$gender}
                                         <input type="radio" class="Customer-{$meeting->get('id')}" name="gender" value="{$name}" {if $meeting->getCustomer()->get('gender')==$name}checked="checked"{/if}/>
                                         <span>{format_gender($gender,1,true)|capitalize}</span>
                                  {/foreach} 
                            </td>
                       </tr>  
                        <tr>
                            <td>{__('Firstname')} </td>
                            <td>
                                <div class="form-errors">{$form.customer.firstname->getError()}</div>
                                <input type="text" class="Customer-{$meeting->get('id')}" size="48" name="firstname" value="{$meeting->getCustomer()->get('firstname')}"/>
                            </td>
                        </tr>
                        <tr>
                            <td>{__('Last name')}
                            </td>
                            <td>  
                                <div class="form-errors">{$form.customer.lastname->getError()}</div>
                                <input type="text" class="Customer-{$meeting->get('id')}" size="48" name="lastname" value="{$meeting->getCustomer()->get('lastname')}"/>
                            </td>
                        </tr>
                        <tr>
                            <td>{__('Age')}
                            </td>
                            <td><div class="form-errors">{$form.customer.age->getError()}</div>
                                <input type="text" class="Customer-{$meeting->get('id')}" name="age" value="{$meeting->getCustomer()->get('age')}"/>
                            </td>
                        </tr>
                         <tr>
                            <td> {__('Phone')}
                            </td>
                            <td>
                                <div class="form-errors">{$form.customer.phone->getError()}</div>
                                <input type="text" class="Customer-{$meeting->get('id')}" name="phone" value="{$meeting->getCustomer()->get('phone')}"/>
                            </td>
                        </tr>
                         <tr>
                            <td> {__('Mobile')}
                            </td>
                            <td>
                                 <div class="form-errors">{$form.customer.mobile->getError()}</div>
                                <input type="text" class="Customer-{$meeting->get('id')}" name="mobile" value="{$meeting->getCustomer()->get('mobile')}"/>
                            </td>
                        </tr>
                         <tr>
                            <td> {__('Email')}
                            </td>
                            <td>
                                 <div class="form-errors">{$form.customer.email->getError()}</div>
                                <input type="text" class="Customer-{$meeting->get('id')}" size="48" name="email" value="{$meeting->getCustomer()->get('email')}"/>
                            </td>
                        </tr>
                        <tr>
                            <td> {__('Address')}
                            </td>
                            <td> 
                                <div>(<span id="coordinates">{$meeting->getCustomer()->getAddress()->getCoordinates()}</span>)</div>
                                <div class="form-errors">{$form.address.address1->getError()}</div>
                                <div>
                                <input type="text" class="CustomerAddress-{$meeting->get('id')}" size="64" name="address1" value="{$meeting->getCustomer()->getAddress()->get('address1')}"/>
                                <a href="#" id="CustomerAddress-Localisation" title="{__('Go to localisation')}"><img src="{url('/icons/map-marker32x32.png','picture')}" alt="{__('localisation')}"/></a>
                                <a href="#" id="CustomerAddress-Calculation" title="{__('Coordinates calculation')}"><img src="{url('/icons/bousole32x32.png','picture')}" alt="{__('Calculation')}"/></a>                                                               
                                </div>
                                <div>
                                <input type="text" class="CustomerAddress-{$meeting->get('id')}" size="64" name="address2" value="{$meeting->getCustomer()->getAddress()->get('address2')}"/>
                                </div>
                            </td>
                        </tr>
                         
                         <tr>
                            <td> {__('Post code')}
                            </td>
                            <td> <div class="form-errors">{$form.address.postcode->getError()}</div> 
                                <input type="text" class="CustomerAddress-{$meeting->get('id')}" name="postcode" value="{$meeting->getCustomer()->getAddress()->get('postcode')}"/>
                            </td>
                        </tr>
                         <tr>
                            <td> {__('City')}
                            </td>
                            <td> <div class="form-errors">{$form.address.city->getError()}</div> 
                                <input type="text" class="CustomerAddress-{$meeting->get('id')}" size="48" name="city" value="{$meeting->getCustomer()->getAddress()->get('city')}"/>
                            </td>
                        </tr>
                    </table>
                </fieldset>
                <fieldset>                           
                    <table>
                        <tr>
                            <td>{__('Union')} </td>
                            <td>
                                <div class="form-errors">{$form.customer.union_id->getError()}</div> 
                                {html_options class="Customer-{$meeting->get('id')}" name="union_id" options=$form->customer.union_id->getOption('choices') selected=$meeting->getCustomer()->get('union_id')}
                            </td>
                        </tr>
                        <tr>
                            <td>{__('Salary')} </td>
                            <td>
                                <div class="form-errors">{$form.customer.salary->getError()}</div> 
                                <input type="text" class="Customer-{$meeting->get('id')}" size="48" name="salary" value="{$meeting->getCustomer()->get('salary')}"/>
                            </td>
                        </tr>
                         <tr>
                            <td>{__('Work')} </td>
                            <td>
                                 <div class="form-errors">{$form.customer.occupation->getError()}</div> 
                                <input type="text" class="Customer-{$meeting->get('id')}" size="48" name="occupation" value="{$meeting->getCustomer()->get('occupation')}"/>
                            </td>
                        </tr>
                    </table>
                </fieldset>            
            </td>
       {*     <td style="vertical-align: top">
                <fieldset>
                 <h3>{__('Other contact')}</h3>
                    <table>
                         <tr>
                            <td>{__("title")}</td>
                            <td>
                                <div>{$form.contact.gender->getError()}</div> 
                                 {foreach $form->customer.gender->getOption("choices") as $name=>$gender}
                                         <input type="radio" class="CustomerContact-{$meeting->get('id')}" name="gender1" value="{$name}" {if $meeting->getCustomer()->getFirstContact()->get('gender')==$name}checked="checked"{/if}/>
                                         <span>{format_gender($gender,1,true)|capitalize}</span>
                                  {/foreach} 
                            </td>
                       </tr>
                        <tr>
                            <td>{__('Firstname')} </td>
                            <td>
                                <div>{$form.contact.firstname->getError()}</div> 
                                <input type="text" class="CustomerContact-{$meeting->get('id')}" size="48" name="firstname" value="{$meeting->getCustomer()->getFirstContact()->get('firstname')}"/>
                            </td>
                        </tr>
                        <tr>
                            <td>{__('Last name')}
                            </td>
                            <td>
                                <div>{$form.contact.lastname->getError()}</div> 
                                <input type="text" class="CustomerContact-{$meeting->get('id')}" size="48" name="lastname" value="{$meeting->getCustomer()->getFirstContact()->get('lastname')}"/>
                            </td>
                        </tr>
                          <tr>
                            <td>{__('Age')}
                            </td>
                            <td>
                                <div>{$form.contact.age->getError()}</div> 
                                <input type="text" class="CustomerContact-{$meeting->get('id')}" name="age" value="{$meeting->getCustomer()->getFirstContact()->get('age')}"/>
                            </td>
                        </tr>
                             <tr>
                            <td> {__('Phone')}
                            </td>
                            <td>
                                <div>{$form.contact.phone->getError()}</div> 
                                <input type="text" class="CustomerContact-{$meeting->get('id')}" name="phone" value="{$meeting->getCustomer()->getFirstContact()->get('phone')}"/>
                            </td>
                        </tr>
                         <tr>
                            <td> {__('Mobile')}
                            </td>
                            <td>
                                <div>{$form.contact.mobile->getError()}</div> 
                                <input type="text" class="CustomerContact-{$meeting->get('id')}" name="mobile" value="{$meeting->getCustomer()->getFirstContact()->get('mobile')}"/>
                            </td>
                        </tr>
                         <tr>
                            <td> {__('Email')}
                            </td>
                            <td>
                                <div>{$form.contact.email->getError()}</div> 
                                <input type="text" class="CustomerContact-{$meeting->get('id')}" size="48" name="email" value="{$meeting->getCustomer()->getFirstContact()->get('email')}"/>
                            </td>
                        </tr>                        
                    </table>
                </fieldset>
                 <fieldset>                           
                    <table>
                        <tr>
                            <td>{__('Salary')} </td>
                            <td>
                                <div>{$form.contact.salary->getError()}</div> 
                                <input type="text" class="CustomerContact-{$meeting->get('id')}" size="48" name="salary" value="{$meeting->getCustomer()->getFirstContact()->get('salary')}"/>
                            </td>
                        </tr>
                        <tr>
                            <td>{__('Work')} </td>
                            <td>
                                <div>{$form.contact.occupation->getError()}</div> 
                                <input type="text" class="CustomerContact-{$meeting->get('id')}" size="48" name="occupation" value="{$meeting->getCustomer()->getFirstContact()->get('occupation')}"/>
                            </td>
                        </tr>
                    </table>
                </fieldset>  
            </td> *}
        </tr>
    </table>  
</fieldset>                            