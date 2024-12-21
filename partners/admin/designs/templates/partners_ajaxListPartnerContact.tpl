{messages class="Partner-errors"}
<h3>{__("View contacts for installer: %s.",$item->get('name'))}</h3>
<div>
    <a href="#" id="PartnerContact-New" title="{__('new contact')}" ><img  src="{url('/icons/new.gif','picture')}" alt="{__('new')}"/>{__('New contact')}</a>   
    <a href="#" id="PartnerContact-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
{if $item->isLoaded()}
    {if $item->hasContacts()}
        <div><span>{format_number_choice('[1]one contact|(1,Inf]%s contacts',$item->getContacts()->count(),$item->getContacts()->count())}</span></div>
        <table>
            <tr>
                <th></th>
                <th>{__("firstname")}</th>
                <th>{__("lastname")}</th>
                <th>{__("email")}</th> 
                <th>{__("phone")}</th>
                <th>{__("mobile")}</th>
                <th>{__("fax")}</th>               
                <th>{__("actions")}</th>
            </tr>
            {foreach $item->getContacts() as $contact}
            <tr class="PartnerContact" id="PartnerContact-{$contact->get('id')}">            
                <td>                 
                    {format_gender($contact->get('sex',1,true))|capitalize}               
                </td>                       
                <td>                            
                     {$contact->get('firstname')}                   
                </td>            
                <td>{$contact->get('lastname')}
                </td>                        
                <td>{$contact->get('email')|escape}               
                </td>                     
                <td>{$contact->get('phone')|escape}                
                </td>                    
                <td> 
                   {$contact->get('mobile')|escape}
                </td>                    
                <td> 
                   {$contact->get('fax')|escape}
                </td>                  
                <td>
                    <a href="#" title="{__('Edit')}" class="PartnerContact-View" id="{$contact->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("Edit")}'/></a>                
                    <a href="#" title="{__('Delete')}" class="PartnerContact-Delete" id="{$contact->get('id')}"  name="{$contact}">
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
    <span>{__('Partner is invalid.')}</span>
{/if}   

<script type="text/javascript">
    
    $('#PartnerContact-Cancel').click(function(){                           
             return $.ajax2({                               
                              url : "{url_to('partners_ajax',['action'=>'ListPartialPartner'])}",
                              errorTarget: ".Partner-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions" }); 
    });
    
    $('#PartnerContact-New').click(function(){                           
             return $.ajax2({ data :{ Partner: "{$item->get('id')}" },                              
                              url : "{url_to('partners_ajax',['action'=>'NewPartnerContact'])}",
                              errorTarget: ".Partner-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions" }); 
    });
    
    
     $('.PartnerContact-View').click(function(){         
           return $.ajax2({ data :{ PartnerContact: $(this).attr('id') },                              
                              url : "{url_to('partners_ajax',['action'=>'ViewPartnerContact'])}",
                              errorTarget: ".Partner-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions" });  
    });
    
     $(".PartnerContact-Delete").click( function () { 
                if (!confirm('{__("Status \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ PartnerContact: $(this).attr('id') },
                                 url :"{url_to('partners_ajax',['action'=>'DeletePartnerContact'])}",
                                 errorTarget: ".Partner-errors",    
                                 loading: "#tab-site-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='deletePartnerContact')
                                       {    
                                          $("tr#PartnerContact-"+resp.id).remove();  
                                          if ($('.PartnerContact').length==0)
                                              return $.ajax2({ url:"{url_to('partners_ajax',['action'=>'ListPartialPartnerCOntact'])}",
                                                               errorTarget: ".site-errors",
                                                               target: "#tab-dashboard-site-x-settings"});                                        
                                        }       
                                 }
                     });                                        
            });
</script>    