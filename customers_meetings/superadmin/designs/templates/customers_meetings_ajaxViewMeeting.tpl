{messages class="site-meeting-errors-{$meeting->get('id')}"}
 {if $meeting->isLoaded()}
    <div id="customer-meetings-tabs-{$meeting->get('id')}">
         <ul>       
            <li class="tabs-sites">               
                <a href="#tab-customer-meetings-meeting-{$meeting->get('id')}">                
                     <span>{__('Meeting')}</span>                    
                </a>                            
            </li>     
            <li class="tabs-sites">               
                <a href="#tab-customer-meetings-customer-{$meeting->get('id')}">                
                     <span>{__('Customer')}</span>                    
                </a>                            
            </li>  
             <li class="tabs-sites">               
                <a href="#tab-customer-meetings-products-{$meeting->get('id')}">                
                     <span>{__('Proposed products')}</span>                    
                </a>                            
            </li>  
            {component name="/customers_meetings/tabs" key=$meeting->get('id')} 
         </ul>      
        <div id="tab-customer-meetings-meeting-{$meeting->get('id')}">            
            <table>
                <tr>
                    <td>
                        {__('id')}
                    </td>
                    <td>{$meeting->get('id')}
                    </td>
                </tr>
                <tr>
                    <td>{__('Teleprospector')}
                    </td>
                    <td>
                        <div>{$form.meeting.telepro_id->getError()}</div> 
                        {html_options_format format="__" class="CustomerMeeting-{$meeting->get('id')}" name="telepro_id" options=$form->meeting.telepro_id->getOption('choices') selected=$meeting->get('telepro_id')}                    
                    </td>
                </tr>
                <tr>
                    <td>{__('Sale')}
                    </td>
                    <td>
                        <div>{$form.meeting.sales_id->getError()}</div> 
                       {html_options_format format="__" class="CustomerMeeting-{$meeting->get('id')}" name="sales_id" options=$form->meeting.sales_id->getOption('choices') selected=$meeting->get('sales_id')}
                    </td>
                </tr>
                <tr>
                    <td>{__('Date')}
                    </td>
                    <td>
                        <div>{$form.meeting.in_at->getError()}</div> 
                        <input id="in_at" type="text" class="CustomerMeeting-{$meeting->get('id')}" name="in_at[date]" value="{if $form->hasErrors()}{$form.meeting.in_at.date}{else}{format_date($meeting->get('in_at'),"a")}{/if}"/>                       
                    </td>
                </tr>
                 <tr>
                    <td>{__('Time')}
                    </td>
                    <td>                       
                       {if $form->hasErrors()}
                           {html_options class="CustomerMeeting-`$meeting->get('id')`"  name="in_at[hour]" options=$form->meeting.in_at->getOption('choices_hour') selected=$form.meeting.in_at.hour}                   
                           {html_options class="CustomerMeeting-`$meeting->get('id')`"  name="in_at[minute]" options=$form->meeting.in_at->getOption('choices_minute') selected=$form.meeting.in_at.minute}
                       {else}
                           {html_options class="CustomerMeeting-`$meeting->get('id')`"  name="in_at[hour]" options=$form->meeting.in_at->getOption('choices_hour') selected=$meeting->getHour()}                   
                           {html_options class="CustomerMeeting-`$meeting->get('id')`"  name="in_at[minute]" options=$form->meeting.in_at->getOption('choices_minute') selected=$meeting->getMinute()}
                       {/if}                           
                    </td>
                </tr>
                 <tr>
                    <td>{__('State')}
                    </td>
                    <td>
                        <div>{$form.meeting.state_id->getError()}</div> 
                        {html_options_format format="__" class="CustomerMeeting-{$meeting->get('id')}" name="state_id" options=$form->meeting.state_id->getOption('choices') selected=$meeting->get('state_id')}
                    </td>
                </tr>
            </table>
              <div>           
        </div>
        </div>  
        <div id="tab-customer-meetings-customer-{$meeting->get('id')}">
            {component name="/customers/viewForViewMeeting"} 
             <fieldset>
             <h3>{__('Meeting information')}</h3>
            <table>
                <tr>
                    <td>
                         <div>{$form.meeting.see_both->getError()}</div> 
                         {__('See both')}
                         <input type="checkbox" class="CustomerMeeting" name="see_both" {if $meeting->get('see_both')=='YES'}checked=""{/if}/>
                    </td>
                    <td>
                         <div>{$form.meeting.see_with_mr->getError()}</div> 
                         {__('See with')}
                         <input type="checkbox" class="CustomerMeeting" name="see_with_mr" {if $meeting->get('see_with_mr')=='YES'}checked=""{/if}/>
                         {__('Mister')}
                   </td>
                   <td>                         
                         <div>{$form.meeting.see_with_mrs->getError()}</div> 
                         <input type="checkbox" class="CustomerMeeting" name="see_with_mrs" {if $meeting->get('see_with_mrs')=='YES'}checked=""{/if}/>
                         {__('Madam')}
                    </td>                   
                </tr>
                <tr>
                    <td >{__('Remarks')}
                    </td>
                    <td colspan="2">                   
                        <textarea class="CustomerMeeting" name="remarks" cols="80" rows="5">{$meeting->get('remarks')}</textarea>
                    </td>
                </tr>
            </table>
        </fieldset>
          {*  {component name="/customers/viewOccupationForViewMeeting"}   *}
          {*  {component name="/customers_meetings/viewConditionsForViewMeeting"} *}
            {component name="/customers/viewHouseForViewMeeting"}  
            {component name="/customers/viewFinancialForViewMeeting"}      
        </div> 
        <div id="tab-customer-meetings-products-{$meeting->get('id')}">
            {include file="./includes/listProductByMeeting.tpl"}
        </div> 
     {*  {component name="/customers_meetings/tabsPanel"  key="`$site->getSiteID()`-CustomerMeeting-`$meeting->get('id')`"}  *}
         {component name="/customers_meetings/tabsPanel"  key=$meeting->get('id')}
    </div>   
    <div>  
        <a href="#" id="Save-{$meeting->get('id')}" style="display:none" class="btn">{__('Save')}</a>     
    </div>      
{else}
    <span>{__('Meeting is invalid.')}</span>
{/if}
<script type="text/javascript">
    {JqueryScriptsReady}   
    $(".CustomerMeeting-{$meeting->get('id')}[id=in_at]").datepicker();
    
    $("#customer-meetings-tabs-{$meeting->get('id')}").tabs( {* { 
                            ajaxOptions: { 
                                    type: "POST",
                                    data: {  Meeting: "{$meeting->get('id')}" },
                                    statusCode: {
                                            401: function() { $(".errors").messagesManager('error',$.ajax2Settings('getMessage','401')); },
                                            403: function() { document.location=window.location.pathname; }, // Redirection to Login 
                                            404: function() { $(".errors").messagesManager('error',$.ajax2Settings('getMessage','404').format(this.url)); }
                                        }
                                 } } *}
    );     
     
    $("#CustomerAddress-Localisation").click(function(){ 
        $("#customer-meetings-tabs-{$meeting->get('id')}").tabs({ active : 3 });    
    });
           
    
    $(".Customer-{$meeting->get('id')},.CustomerContact-{$meeting->get('id')},.CustomerMeeting-{$meeting->get('id')},.CustomerAddress-{$meeting->get('id')},.CustomerHouse-{$meeting->get('id')},.CustomerFinancial-{$meeting->get('id')}").click(function() { $("#Save-{$meeting->get('id')}").show(); });
 
   {*  $(".CustomerMeeting-{$meeting->get('id')}").change(function() { $("#Save-{$meeting->get('id')}").show(); }); *}
      
    $("#Save-{$meeting->get('id')}").click(function(){ 
            var params= { Meeting: { 
                            id: "{$meeting->get('id')}",
                            meeting: {                                
                                 state_id: $(".CustomerMeeting-{$meeting->get('id')}[name=state_id] option:selected").val(), 
                                 sales_id: $(".CustomerMeeting-{$meeting->get('id')}[name=sales_id] option:selected").val(), 
                                 telepro_id: $(".CustomerMeeting-{$meeting->get('id')}[name=telepro_id] option:selected").val(),
                                 in_at: { 
                                        date : $(".CustomerMeeting-{$meeting->get('id')}[name=in_at\\[date\\]]").val(),
                                        hour : $(".CustomerMeeting-{$meeting->get('id')}[name=in_at\\[hour\\]] option:selected").val(),
                                        minute : $(".CustomerMeeting-{$meeting->get('id')}[name=in_at\\[minute\\]] option:selected").val()
                                 }
                            },
                            customer : { 
                                union_id: $(".Customer-{$meeting->get('id')}[name=union_id] option:selected").val()
                            },
                            address: { },
                            house: { },
                            financial: { },
                            products : { },
                            contact: { gender : { } },
                            token :'{$form->getCSRFToken()}'
            } };
            // Customer
            $("input.Customer-{$meeting->get('id')}[type=text]").each(function() { params.Meeting.customer[this.name]=$(this).val(); });
            $("input.Customer-{$meeting->get('id')}[type=radio]:checked").each(function() { params.Meeting.customer[this.name]=$(this).val(); }); 
            // Address
            $("input.CustomerAddress-{$meeting->get('id')}[type=text]").each(function() { params.Meeting.address[this.name]=$(this).val(); });
            // Contact
            $("input.CustomerContact-{$meeting->get('id')}[type=text]").each(function() { params.Meeting.contact[this.name]=$(this).val(); }); 
            $("input.CustomerContact-{$meeting->get('id')}[type=radio]:checked").each(function() { params.Meeting.contact.gender=$(this).val(); });
            // Meeting
            $("input.CustomerMeeting-{$meeting->get('id')}[name!=in_at\\[date\\]]").each(function() { params.Meeting.meeting[this.name]=$(this).val(); });
            // House
            //$("input.CustomerHouse[type=checkbox]").each(function() { params.Meeting.house[this.name]=$(this).attr("checked")?"YES":"NO"; });
            $("input.CustomerHouse-{$meeting->get('id')}[type=text]").each(function() { params.Meeting.house[this.name]=$(this).val(); });
            // Financial
            $("input.CustomerFinancial-{$meeting->get('id')}[type=text]").each(function() { params.Meeting.financial[this.name]=$(this).val(); });
            // Products
            params.products={ count : $(".{$site->getSiteID()}-product-form").length, collection:  { } };
            
//            alert("Params="+params.products.toSource()); return false;
            return $.ajax2({   data: params, 
                                url: "{url_to('customers_meeting_ajax',['action'=>'SaveMeeting'])}", 
                                errorTarget: ".site-meeting-errors-{$meeting->get('id')}",
                                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-meeting-loading",                          
                                target: "#tab-site-panel-{$site->getSiteID()}-dashboard-site-customers-meeting-{$meeting->get('id')}"
                                }); 
         });
         
         
         $("#CustomerAddress-Calculation").click(function() { 
                return $.ajax2({   data: { Customer: {$meeting->getCustomer()->get('id')} }, 
                                url: "{url_to('customers_ajax',['action'=>'CoordinateCalculation'])}", 
                                errorTarget: ".site-meeting-errors-{$meeting->get('id')}",
                                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-meeting-loading",  
                                success: function (resp)
                                         {                                            
                                            if (resp.action=='CoordinateCalculation')
                                                $("#coordinates").html(resp.coordinates);
                                         }
                                }); 
         });
    {/JqueryScriptsReady}   
</script>    