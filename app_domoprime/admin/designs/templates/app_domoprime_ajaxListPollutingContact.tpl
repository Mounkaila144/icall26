{messages class="Polluting-errors"}
<h3>{__("View contacts for Polluting: %s.",$item->get('name'))}</h3>
<div>
    <a href="#" id="DomomprimePollutingContact-New" class="btn" title="{__('new contact')}" ><img  src="{url('/icons/new.gif','picture')}" alt="{__('new')}"/>{__('New contact')}</a>   
    <a href="#" id="DomomprimePollutingContact-Cancel" class="btn"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
{if $item->isLoaded()}
    {if $item->hasContacts()}
        <div><span>{format_number_choice('[1]one contact|(1,Inf]%s contacts',$item->getContacts()->count(),$item->getContacts()->count())}</span></div>
        <table class="tabl-list  footable table" cellpadding="0" cellspacing="0">
            <tr class="list-header">
                <th >{__("sex")}</th>
                <th class="footable-first-column" data-toggle="true">{__("firstname")}</th>
                <th>{__("lastname")}</th>
                <th>{__("email")}</th> 
                <th>{__("phone")}</th>
                <th>{__("mobile")}</th>
                <th>{__("fax")}</th>               
                <th>{__("actions")}</th>
            </tr>
            {foreach $item->getContacts() as $contact}
            <tr class="DomomprimePollutingContact" id="DomomprimePollutingContact-{$contact->get('id')}">            
                <td>                 
                    {format_gender($contact->get('sex',1,true))|capitalize}               
                </td>                       
                <td>                            
                     {$contact->get('firstname')}                   
                </td>            
                <td>{$contact->get('lastname')}
                </td>                        
                <td>
                    {if $contact->get('email')}
                    {$contact->get('email')|escape} 
                    {else}
                        {__('---')}
                    {/if}
                </td>                     
                <td>
                    {if $contact->get('phone')} 
                    {$contact->get('phone')|escape} 
                    {else}
                        {__('---')}
                    {/if}
                </td>                    
                <td> 
                   {if $contact->get('mobile')}
                    {$contact->get('mobile')|escape}
                    {else}
                        {__('---')}
                    {/if}
                </td>                    
                <td>
                   {if $contact->get('fax')} 
                   {$contact->get('fax')|escape}
                    {else}
                        {__('---')}
                    {/if}
                </td>                  
                <td>
                    <a href="#" title="{__('Edit')}" class="DomomprimePollutingContact-View" id="{$contact->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("Edit")}'/></a>                
                    <a href="#" title="{__('Delete')}" class="DomomprimePollutingContact-Delete" id="{$contact->get('id')}"  name="{$contact->get('lastname')} {$contact->get('firstname')}">
                       <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
                    </a>  
                </td>
         </tr>           
        {/foreach}
        </table>
    {else}
        <span>{__('No contact.')}</span>
    {/if}
{else}
    <span>{__('Polluting is invalid.')}</span>
{/if}   

<script type="text/javascript">
    
    $('#DomomprimePollutingContact-Cancel').click(function(){                           
             return $.ajax2({                               
                              url : "{url_to('app_domoprime_ajax',['action'=>'ListPartialPollutingCompany'])}",
                              errorTarget: ".Polluting-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions" }); 
    });
    
    $('#DomomprimePollutingContact-New').click(function(){                           
             return $.ajax2({ data :{ Polluting: "{$item->get('id')}" },                              
                              url : "{url_to('app_domoprime_ajax',['action'=>'NewpollutingContact'])}",
                              errorTarget: ".Polluting-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions" }); 
    });
    
    
     $('.DomomprimePollutingContact-View').click(function(){         
           return $.ajax2({ data :{ PollutingContact: $(this).attr('id') },                              
                              url : "{url_to('app_domoprime_ajax',['action'=>'ViewPollutingContact'])}",
                              errorTarget: ".Polluting-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions" });  
    });
    
     $(".DomomprimePollutingContact-Delete").click( function () { 
                if (!confirm('{__("Status \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ PollutingContact: $(this).attr('id') },
                                 url :"{url_to('app_domoprime_ajax',['action'=>'DeletePollutingContact'])}",
                                 errorTarget: ".Polluting-errors",    
                                 loading: "#tab-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='DeletePollutingContact')
                                       {    
                                          $("tr#DomomprimePollutingContact-"+resp.id).remove();  
                                          if ($('.DomomprimePollutingContact').length==0)
                                              return $.ajax2({ url:"{url_to('app_domoprime_ajax',['action'=>'ListPollutingContact'])}",
                                                               errorTarget: ".site-errors",
                                                               target: "#tab-dashboard-x-settings"});                                        
                                        }       
                                 }
                     });                                        
            });
</script>    
