{messages class="site-meeting-errors"}
<div id="customer-meetings-tabs">
     <ul>       
        <li class="tabs-sites">               
            <a href="#tab-customer-meetings-meeting">                
                 <span>{__('Meeting')}</span>                    
            </a>                            
        </li>     
        <li class="tabs-sites">               
            <a href="#tab-customer-meetings-customer">                
                 <span>{__('Customer')}</span>                    
            </a>                            
        </li>  
         <li class="tabs-sites">               
            <a href="#tab-customer-meetings-products">                
                 <span>{__('Products')}</span>                    
            </a>                            
        </li>  
     </ul>      
    <div id="tab-customer-meetings-meeting">
        <table class="tab-form">
            <tr>
                <td class="label">{__('Teleprospector')}
                </td>
                <td>
                    <div class="form-errors">{$form.meeting.telepro_id->getError()}</div> 
                    {html_options_format format="__" class="CustomerMeeting" name="telepro_id" options=$form->meeting.telepro_id->getOption('choices') selected=$item->get('telepro_id')}                    
                </td>
            </tr>
            <tr>
                <td class="label">{__('Sale1')}
                </td>
                <td>
                    <div class="form-errors">{$form.meeting.sales_id->getError()}</div> 
                   {html_options_format format="__" class="CustomerMeeting" name="sales_id" options=$form->meeting.sales_id->getOption('choices') selected=$item->get('sales_id')}
                </td>
            </tr>
             <tr>
                <td class="label">{__('Sale2')}
                </td>
                <td>
                    <div class="form-errors">{$form.meeting.sale2_id->getError()}</div> 
                   {html_options_format format="__" class="CustomerMeeting" name="sale2_id" options=$form->meeting.sale2_id->getOption('choices') selected=$item->get('sale2_id')}
                </td>
            </tr>
            <tr>
                <td class="label">{__('Date')}
                </td>
                <td>
                    <div class="form-errors">{$form.meeting.in_at->getError()}</div> 
                    <input id="in_at" type="text" class="CustomerMeeting" name="in_at[date]" value="{if $form->hasErrors()}{$form.meeting.in_at.date}{else}{format_date($item->get('in_at'),"a")}{/if}"/>
                </td>
            </tr>
             <tr>
                <td class="label">{__('Time')}
                </td>
                <td>
                    {html_options class="CustomerMeeting"  name="in_at[hour]" options=$form->meeting.in_at->getOption('choices_hour') selected=$form.meeting.in_at.hour}                   
                    {html_options class="CustomerMeeting"  name="in_at[minute]" options=$form->meeting.in_at->getOption('choices_minute') selected=$form.meeting.in_at.minute}
                </td>
            </tr>
             <tr>
                <td class="label">{__('State')}
                </td>
                <td>
                    <div class="form-errors">{$form.meeting.state_id->getError()}</div> 
                    {html_options_format format="__" class="CustomerMeeting" name="state_id" options=$form->meeting.state_id->getOption('choices') selected=$item->get('state_id')}
                </td>
            </tr>
        </table>      
    </div>  

    <div id="tab-customer-meetings-customer">
        {component name="/customers/newForNewMeeting"}
        <fieldset>
            <legend><h3>{__('Meeting information')}</h3></legend>
             <table class="tab-form-style">
                <tr>
                    <td class="label">
                        {__('See both')}
                    </td>
                    <td>
                         <div class="form-errors">{$form.meeting.see_both->getError()}</div> 
                         
                         <input type="checkbox" class="CustomerMeeting" name="see_both" {if $item->get('see_both')=='YES'}checked=""{/if}/>
                    </td>
               </tr>  
               <tr>
                    <td class="label">
                         {__('See with')}
                    </td>
                    <td>
                         <div class="form-errors">{$form.meeting.see_with_mr->getError()}</div> 
                        
                         <input type="checkbox" class="CustomerMeeting" name="see_with_mr" {if $item->get('see_with_mr')=='YES'}checked=""{/if}/>
                         {__('Mister')}
                   </td>
               </tr>
               <tr>
                   <td class="label">   
                       {__('Madam')}
                   </td>
                   <td>
                         <div class="form-errors">{$form.meeting.see_with_mrs->getError()}</div> 
                         <input type="checkbox" class="CustomerMeeting" name="see_with_mrs" {if $item->get('see_with_mrs')=='YES'}checked=""{/if}/>
                       
                    </td>  
               </tr>                                
            </table>
        </fieldset>
      {*  {component name="/customers/newOccupationForNewMeeting"}  *}
      {*  {component name="/customers_meetings/newConditionsForNewMeeting"} *}
        {component name="/customers/newHouseForNewMeeting"}
        {component name="/customers/newFinancialForNewMeeting"}        
    </div> 
    <div id="tab-customer-meetings-products">
       {component name="/customers_meetings/newProductsMultiple"} 
    </div> 
    
</div>   
<div>
    {if $item->isNotLoaded()}
    <a href="#" id="Save" style="display:none" class="btn">{__('Save')}</a>  
    {/if}
</div>                
<script type="text/javascript">
    {JqueryScriptsReady}   
        
         $("#customer-meetings-tabs").tabs();         
         
         $(".CustomerMeeting[id=in_at]").datepicker();
                
         $(".Products,.Customer,.CustomerContact,.CustomerMeeting,.CustomerAddress,.CustomerHouse,.CustomerFinancial").click(function() { $("#Save").show(); });
         
         $(".Products").change(function() { $("#Save").show(); });
         
         $("#Save").click(function(){ 
            var params= { Meeting: { 
                            meeting: { 
                                 in_at: { 
                                        date : $(".CustomerMeeting[name=in_at\\[date\\]]").val(),
                                        hour : $(".CustomerMeeting[name=in_at\\[hour\\]] option:selected").val(),
                                        minute : $(".CustomerMeeting[name=in_at\\[minute\\]] option:selected").val()
                                 },
                                 state_id: $(".CustomerMeeting[name=state_id] option:selected").val(), 
                                 sales_id: $(".CustomerMeeting[name=sales_id] option:selected").val(), 
                                 telepro_id: $(".CustomerMeeting[name=telepro_id] option:selected").val()
                            },
                            customer : { 
                                union_id: $(".Customer[name=union_id] option:selected").val()
                            },
                            address: { },
                            house: { },
                            financial: { },
                            contact: { gender : { } },
                            token :'{$form->getCSRFToken()}'
            } };
            // Customer
            $("input.Customer[type=text]").each(function() { params.Meeting.customer[this.name]=$(this).val(); });
            $("input.Customer[type=radio]:checked").each(function() { params.Meeting.customer[this.name]=$(this).val(); }); 
            // Address
            $("input.CustomerAddress[type=text]").each(function() { params.Meeting.address[this.name]=$(this).val(); });
            // Contact
            $("input.CustomerContact[type=text]").each(function() { params.Meeting.contact[this.name]=$(this).val(); }); 
            $("input.CustomerContact[type=radio]:checked").each(function() { params.Meeting.contact.gender=$(this).val(); });
            // Meeting
            $("input.CustomerMeeting[name!=in_at\\[date\\]],textarea.CustomerMeeting").each(function() { params.Meeting.meeting[this.name]=$(this).val(); });
            $("input.CustomerMeeting[type=checkbox]").each(function() {  params.Meeting.meeting[this.name]=($(this).prop("checked")?"YES":"NO");  });
            // House
            //$("input.CustomerHouse[type=checkbox]").each(function() { params.Meeting.house[this.name]=$(this).prop("checked")?"YES":"NO"; });
            $("input.CustomerHouse[type=text]").each(function() { params.Meeting.house[this.name]=$(this).val(); });
            // Financial
            $("input.CustomerFinancial[type=text]").each(function() { params.Meeting.financial[this.name]=$(this).val(); });
            
            params.Meeting.products={ count : $(".product-form").length, collection:  { } };
            $(".product-form").each(function(idx) {
                params.Meeting.products.collection[idx]={ 
                        product_id: $("select.Products[id=id-"+idx+"] option:selected").val(),
                        details: $("input.Products[id="+idx+"]").val()
                };                
            });
        //    alert("Params="+params.toSource()); return false;           
            
            return $.ajax2({   data: params, 
                                url: "{url_to('customers_meeting_ajax',['action'=>'NewMeeting'])}", 
                                errorTarget: ".site-meeting-errors",
                                loading: "#tab-site-dashboard-customers-meeting-loading",                          
                                target: "#tab-site-panel-dashboard-customers-meeting-New"
                                }); 
         });
         
         

    {/JqueryScriptsReady} 
</script> 