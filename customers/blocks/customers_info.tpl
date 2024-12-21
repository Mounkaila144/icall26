<table class="tab-form">                                                                     
                         <tr>
                            <td  class="label">{__("title")}  </td>
                            <td>
                                <span>: {format_gender($customer->get('gender'),1,true)|capitalize|upper}</span>                                 
                            </td>
                       </tr>                         
                        <tr>
                            <td  class="label">{__('Last name')}
                            </td>
                            <td>                                  
                               : {$customer->get('lastname')|upper}
                            </td>
                        </tr>
                         <tr>
                            <td  class="label">{__('Firstname')} </td>
                            <td>                               
                                <span>: {$customer->get('firstname')|upper}</span>
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
                                
                              : {$customer->get('phone')}
                            </td>
                        </tr>
                         <tr>
                            <td  class="label"> {__('Mobile 1')} 
                            </td>
                            <td>
                                
                                : <span class="yellow-input">{$customer->get('mobile')}</span>
                            </td>
                        </tr>
                         <tr>
                            <td  class="label"> {__('Mobile 2')} 
                            </td>
                            <td>
                                
                              : {$customer->get('mobile2')}
                            </td>
                        </tr>
                         <tr>
                            <td  class="label"> {__('Email')} 
                            </td>
                            <td>
                               : {$customer->get('email')|upper}
                            </td>
                        </tr>
                        <tr>
                            <td  class="label"> {__('Address')} 
                            </td>
                            <td>                                                     
                               : {$customer->getAddress()->getAddress1()->upper()}
                                 {$customer->getAddress()->getAddress2()->upper()}                                 
                            </td>
                        </tr>
                         
                         <tr>
                            <td  class="label"> {__('Post code')} 
                            </td>
                            <td> 
                               : {$customer->getAddress()->get('postcode')}
                            </td>
                        </tr>
                         <tr>
                            <td  class="label"> {__('City')} 
                            </td>
                            <td> 
                                : {$customer->getAddress()->get('city')|upper}
                            </td>
                        </tr>
                        {if $user->hasCredential([['superadmin','admin','contract_customer_coordinates']])} 
                        <tr>
                            <td  class="label">{__('Coordinates')} 
                            </td>
                            <td>
                                  <div>: (<span id="contract-coordinates">{if $customer->getAddress()->get('coordinates')}{$customer->getAddress()->getCoordinates()}{else}{__('No coordinate')}{/if}</span>)
                                      <a href="#" id="CustomerContractAddress-Calculation" title="{__('Coordinates calculation')}"><i class="fa fa-globe"/></a>                                                               
                                  </div>
                            </td>
                        </tr>
                        {/if}                         
          {*      <fieldset>                           
                    <table>
                        <tr>
                            <td>{__('Union')} </td>
                            <td>    
                                {$customer->getUnion('fr')->get('value')}
                            </td>
                        </tr>
                        <tr>
                            <td>{__('Salary')} </td>
                            <td>
                             {$customer->get('salary')}
                            </td>
                        </tr>
                         <tr>
                            <td>{__('Work')} </td>
                            <td>
                               {$customer->get('occupation')}
                            </td>
                        </tr>
                    </table>
                </fieldset>   *}         
       
        {*    <td style="vertical-align: top;">
                <fieldset>
                 <h3>{__('Other contact')}</h3>
                    <table>
                         <tr>
                            <td>{__("title")}</td>
                            <td>                                
                                <span>{format_gender($customer->getFirstContact()->get('gender'),1,true)|capitalize}</span>                               
                            </td>
                       </tr>
                        <tr>
                            <td>{__('Firstname')} </td>
                            <td>                               
                                {$customer->getFirstContact()->get('firstname')}
                            </td>
                        </tr>
                        <tr>
                            <td>{__('Last name')}
                            </td>
                            <td>                              
                                {$customer->getFirstContact()->get('lastname')}
                            </td>
                        </tr>
                          <tr>
                            <td>{__('Age')}
                            </td>
                            <td>                               
                                {$customer->getFirstContact()->get('age')}
                            </td>
                        </tr>
                             <tr>
                            <td> {__('Phone')}
                            </td>
                            <td>                              
                               {$customer->getFirstContact()->get('phone')}
                            </td>
                        </tr>
                         <tr>
                            <td> {__('Mobile')}
                            </td>
                            <td>                               
                                {$customer->getFirstContact()->get('mobile')}
                            </td>
                        </tr>
                         <tr>
                            <td> {__('Email')}
                            </td>
                            <td>                                
                               {$customer->getFirstContact()->get('email')}
                            </td>
                        </tr>                        
                    </table>
                </fieldset>
                 <fieldset>                           
                    <table>
                        <tr>
                            <td>{__('Salary')} </td>
                            <td>                             
                                {$customer->getFirstContact()->get('salary')}
                            </td>
                        </tr>
                        <tr>
                            <td>{__('Work')} </td>
                            <td>                                
                               {$customer->getFirstContact()->get('occupation')}
                            </td>
                        </tr>
                    </table>
                </fieldset>  
            </td>
        </tr> *}
    </table>       
    {if $contract && $contract->isHold()}
        
    {else}    
        {if $user->hasCredential([['superadmin','admin','contract_modify']])} 
            <a href="#" id="CustomerContract-Modify" class="btn" style=" clear: both"><i class="fa fa-pencil-square-o" style=" margin-right: 10px"></i>{__('Modify')}</a>    
        {/if}
    {/if}
<script type="text/javascript">
 
    $("#CustomerContract-Modify").click(function(){
       return $.ajax2({                    
                data : { Contract: "{$contract->get('id')}" },
                url: "{url_to('customers_ajax',['action'=>'ModifyCustomerForContract'])}",
                errorTarget: ".site-contract-errors-{$contract->get('id')}",
                loading: "#tab-site-dashboard-customers-contract-loading",                          
                target: "#tab-customer-contracts-customer-{$contract->get('id')}"
           });  // tab-customer-contracts-customer-4
    
    });
    
    $("#CustomerContractAddress-Calculation").click(function() { 
                return $.ajax2({   data: { Customer: {$customer->get('id')} }, 
                                url: "{url_to('customers_ajax',['action'=>'CoordinateCalculation'])}", 
                                errorTarget: ".site-contract-errors-{$contract->get('id')}",
                                 loading: "#tab-site-dashboard-customers-contract-loading",     
                                success: function (resp)
                                         {                                            
                                            if (resp.action=='CoordinateCalculation')
                                                $("#contract-coordinates").html(resp.coordinates);
                                         }
                                }); 
         });
</script> 

