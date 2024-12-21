<fieldset>
   <h3>{__('Contacts')}</h3>
   <table>
        <tr>
            <td>
                <fieldset>
                    <h3>{__('Main contact')}</h3>
                    <table>
                        {if $item->getCustomer()->isLoaded()}
                        <tr>
                            <td>
                                {__('id')}
                            </td>
                            <td>
                                {$item->getCustomer()->get('id')}
                            </td>
                        </tr>
                        {/if} 
                         <tr>
                            <td>{__("title")}</td>
                            <td>
                                <div>{$form.customer.gender->getError()}</div> 
                                 {foreach $form->customer.gender->getOption("choices") as $name=>$gender}
                                         <input type="radio" class="Customer" name="gender" value="{$name}" {if $item->getCustomer()->get('gender')==$name}checked="checked"{/if}/>
                                         <span>{format_gender($gender,1,true)|capitalize}</span>
                                  {/foreach} 
                            </td>
                       </tr>
                              <tr>
                            <td>{__('Last name')}
                            </td>
                            <td>  
                                <div class="form-errors">{$form.customer.lastname->getError()}</div>
                                <input type="text" class="Customer" size="48" name="lastname" value="{$item->getCustomer()->get('lastname')}"/>
                            </td>
                        </tr>
                        <tr>
                            <td>{__('Firstname')} </td>
                            <td>
                                <div class="form-errors">{$form.customer.firstname->getError()}</div>
                                <input type="text" class="Customer" size="48" name="firstname" value="{$item->getCustomer()->get('firstname')}"/>
                            </td>
                        </tr>                 
                        <tr>
                            <td>{__('Age')}
                            </td>
                            <td><div class="form-errors">{$form.customer.age->getError()}</div>
                                <input type="text" class="Customer" name="age" value="{$item->getCustomer()->get('age')}"/>
                            </td>
                        </tr>
                         <tr>
                            <td> {__('Phone')}
                            </td>
                            <td>
                                <div class="form-errors">{$form.customer.phone->getError()}</div>
                                <input type="text" class="Customer" name="phone" value="{$item->getCustomer()->get('phone')}"/>
                            </td>
                        </tr>
                         <tr>
                            <td> {__('Mobile')}
                            </td>
                            <td>
                                 <div class="form-errors">{$form.customer.mobile->getError()}</div>
                                <input type="text" class="Customer" name="mobile" value="{$item->getCustomer()->get('mobile')}"/>
                            </td>
                        </tr>
                         <tr>
                            <td> {__('Email')}
                            </td>
                            <td>
                                 <div class="form-errors">{$form.customer.email->getError()}</div>
                                <input type="text" class="Customer" size="48" name="email" value="{$item->getCustomer()->get('email')}"/>
                            </td>
                        </tr>
                        <tr>
                            <td> {__('Address')}
                            </td>
                            <td> 
                                <div class="form-errors">{$form.address.address1->getError()}</div>
                                <div>
                                <input type="text" class="CustomerAddress" size="64" name="address1" value="{$item->getCustomer()->getAddress()->get('address1')}"/>
                                </div>
                                <div>
                                <input type="text" class="CustomerAddress" size="64" name="address2" value="{$item->getCustomer()->getAddress()->get('address2')}"/>
                                </div>
                            </td>
                        </tr>
                         
                         <tr>
                            <td> {__('Post code')}
                            </td>
                            <td> <div class="form-errors">{$form.address.postcode->getError()}</div> 
                                <input type="text" class="CustomerAddress" name="postcode" value="{$item->getCustomer()->getAddress()->get('postcode')}"/>
                            </td>
                        </tr>
                         <tr>
                            <td> {__('City')}
                            </td>
                            <td> <div class="form-errors">{$form.address.city->getError()}</div> 
                                <input type="text" class="CustomerAddress" size="48" name="city" value="{$item->getCustomer()->getAddress()->get('city')}"/>
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
                                {html_options class="Customer" name="union_id" options=$form->customer.union_id->getOption('choices') selected=$item->getCustomer()->get('union_id')}
                            </td>
                        </tr>
                        <tr>
                            <td>{__('Salary')} </td>
                            <td>
                                <div class="form-errors">{$form.customer.salary->getError()}</div> 
                                <input type="text" class="Customer" size="48" name="salary" value="{$item->getCustomer()->get('salary')}"/>
                            </td>
                        </tr>
                         <tr>
                            <td>{__('Work')} </td>
                            <td>
                                 <div class="form-errors">{$form.customer.occupation->getError()}</div> 
                                <input type="text" class="Customer" size="48" name="occupation" value="{$item->getCustomer()->get('occupation')}"/>
                            </td>
                        </tr>
                    </table>
                </fieldset>            
            </td>
          {*  <td>
                <fieldset>
                 <h3>{__('Other contact')}</h3>
                    <table>
                         <tr>
                            <td>{__("title")}</td>
                            <td>
                                <div>{$form.contact.gender->getError()}</div> 
                                 {foreach $form->customer.gender->getOption("choices") as $name=>$gender}
                                         <input type="radio" class="CustomerContact" name="gender1" value="{$name}" {if $item->getCustomer()->getFirstContact()->get('gender')==$name}checked="checked"{/if}/>
                                         <span>{format_gender($gender,1,true)|capitalize}</span>
                                  {/foreach} 
                            </td>
                       </tr>
                        <tr>
                            <td>{__('Firstname')} </td>
                            <td>
                                <div>{$form.contact.firstname->getError()}</div> 
                                <input type="text" class="CustomerContact" size="48" name="firstname" value="{$item->getCustomer()->getFirstContact()->get('firstname')}"/>
                            </td>
                        </tr>
                        <tr>
                            <td>{__('Last name')}
                            </td>
                            <td>
                                <div>{$form.contact.lastname->getError()}</div> 
                                <input type="text" class="CustomerContact" size="48" name="lastname" value="{$item->getCustomer()->getFirstContact()->get('lastname')}"/>
                            </td>
                        </tr>
                          <tr>
                            <td>{__('Age')}
                            </td>
                            <td>
                                <div>{$form.contact.age->getError()}</div> 
                                <input type="text" class="CustomerContact" name="age" value="{$item->getCustomer()->getFirstContact()->get('age')}"/>
                            </td>
                        </tr>
                             <tr>
                            <td> {__('Phone')}
                            </td>
                            <td>
                                <div>{$form.contact.phone->getError()}</div> 
                                <input type="text" class="CustomerContact" name="phone" value="{$item->getCustomer()->getFirstContact()->get('phone')}"/>
                            </td>
                        </tr>
                         <tr>
                            <td> {__('Mobile')}
                            </td>
                            <td>
                                <div>{$form.contact.mobile->getError()}</div> 
                                <input type="text" class="CustomerContact" name="mobile" value="{$item->getCustomer()->getFirstContact()->get('mobile')}"/>
                            </td>
                        </tr>
                         <tr>
                            <td> {__('Email')}
                            </td>
                            <td>
                                <div>{$form.contact.email->getError()}</div> 
                                <input type="text" class="CustomerContact" size="48" name="email" value="{$item->getCustomer()->getFirstContact()->get('email')}"/>
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
                                <input type="text" class="CustomerContact" size="48" name="salary" value="{$item->getCustomer()->getFirstContact()->get('salary')}"/>
                            </td>
                        </tr>
                        <tr>
                            <td>{__('Work')} </td>
                            <td>
                                <div>{$form.contact.occupation->getError()}</div> 
                                <input type="text" class="CustomerContact" size="48" name="occupation" value="{$item->getCustomer()->getFirstContact()->get('occupation')}"/>
                            </td>
                        </tr>
                    </table>
                </fieldset>  
            </td> *}
        </tr>
    </table>  
</fieldset>                            