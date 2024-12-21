<fieldset>  
   <table>
        <tr>
            <td>
                <fieldset>                  
                    <table>                       
                        <tr>
                            <td>
                                {__('id')}
                            </td>
                            <td>
                                {$customer->get('id')}
                            </td>
                        </tr>                        
                         <tr>
                            <td>{__("title")}</td>
                            <td>
                                <span>{format_gender($customer->get('gender'),1,true)|capitalize}</span>                                 
                            </td>
                       </tr>  
                        <tr>
                            <td>{__('Firstname')} </td>
                            <td>                               
                                <span>{$customer->get('firstname')}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>{__('Last name')}
                            </td>
                            <td>                                  
                                {$customer->get('lastname')}
                            </td>
                        </tr>
                        <tr>
                            <td>{__('Age')}
                            </td>
                            <td>
                                {$customer->get('age')}
                            </td>
                        </tr>
                         <tr>
                            <td> {__('Phone')}
                            </td>
                            <td>
                                
                                {$customer->get('phone')}
                            </td>
                        </tr>
                         <tr>
                            <td> {__('Mobile')}
                            </td>
                            <td>
                                
                                {$customer->get('mobile')}
                            </td>
                        </tr>
                         <tr>
                            <td> {__('Email')}
                            </td>
                            <td>
                                {$customer->get('email')}
                            </td>
                        </tr>
                        <tr>
                            <td> {__('Address')}
                            </td>
                            <td>                                                     
                                {$customer->getAddress()->get('address1')}
                                {$customer->getAddress()->get('address2')}
                            </td>
                        </tr>
                         
                         <tr>
                            <td> {__('Post code')}
                            </td>
                            <td> 
                               {$customer->getAddress()->get('postcode')}
                            </td>
                        </tr>
                         <tr>
                            <td> {__('City')}
                            </td>
                            <td> 
                                {$customer->getAddress()->get('city')}
                            </td>
                        </tr>
                        <tr>
                            <td>{__('Coordinates')}
                            </td>
                            <td>
                                  <div>(<span id="contract-coordinates">{if $customer->getAddress()->get('coordinates')}{$customer->getAddress()->getCoordinates()}{else}{__('No coordinate')}{/if}</span>)</div>
                                  <a href="#" id="CustomerContractAddress-Calculation" title="{__('Coordinates calculation')}"><img height="16px" width="16px" src="{url('/icons/bousole32x32.png','picture')}" alt="{__('Calculation')}"/></a>                                                               
                            </td>
                        </tr>
                    </table>
                </fieldset>
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
            </td>
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
    <a href="#" id="CustomerContract-Modify" class="btn">{__('Modify')}</a>    
</fieldset>       

<script type="text/javascript">
 
    $("#CustomerContract-Modify").click(function(){
       return $.ajax2({                    
                data : { Contract: "{$contract->get('id')}" },
                url: "{url_to('customers_ajax',['action'=>'ModifyCustomerForContract'])}",
                errorTarget: ".site-contract-errors-{$contract->get('id')}",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-contract-loading",                          
                target: "#tab-customer-contracts-customer-{$contract->get('id')}"
           });  // tab-customer-contracts-customer-4
    
    });
    
    $("#CustomerContractAddress-Calculation").click(function() { 
                return $.ajax2({   data: { Customer: {$customer->get('id')} }, 
                                url: "{url_to('customers_ajax',['action'=>'CoordinateCalculation'])}", 
                                errorTarget: ".site-contract-errors-{$contract->get('id')}",
                                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-contract-loading",  
                                success: function (resp)
                                         {                                            
                                            if (resp.action=='CoordinateCalculation')
                                                $("#contract-coordinates").html(resp.coordinates);
                                         }
                                }); 
         });
</script> 