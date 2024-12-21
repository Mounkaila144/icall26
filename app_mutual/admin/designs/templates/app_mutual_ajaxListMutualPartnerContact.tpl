{messages class="MutualPartner-errors"}
<h3>{__("View contacts for mutual: %s.",$item->get('name'))}</h3>
<div>
    <a href="#" id="MutualPartnerContact-New" title="{__('new contact')}" class="btn"><i class="fa fa-floppy-o" style="color: #000; margin-right: 10px"></i>{__('New contact')}</a>   
    <a href="#" id="MutualPartnerContact-Cancel" class="btn"><i class="fa fa-times" style="color: #000; margin-right: 10px"></i>{__('Cancel')}</a>
</div>
{if $item->isLoaded()}
    {if $item->hasContacts()}
        <div><span>{format_number_choice('[1]one contact|(1,Inf]%s contacts',$item->getContacts()->count(),$item->getContacts()->count())}</span></div>
        <div class="containerDivResp">
        <table class="tabl-list footable table">
            <thead>
                <tr class="list-header">
                    <th></th>
                    <th class="footable-first-column" data-toggle="true">{__("Firstname")}</th>
                    <th data-hide="phone" style="display: table-cell;">{__("Lastname")}</th>
                    <th data-hide="phone" style="display: table-cell;">{__("Email")}</th> 
                    <th data-hide="phone" style="display: table-cell;">{__("Phone")}</th>
                    <th data-hide="phone" style="display: table-cell;">{__("Mobile")}</th>
                    <th data-hide="phone" style="display: table-cell;">{__("Fax")}</th>               
                    <th data-hide="phone" style="display: table-cell;">{__("Actions")}</th>
                </tr>
            </thead>
            {foreach $item->getContacts() as $contact}
            <tr class="MutualPartnerContact" id="MutualPartnerContact-{$contact->get('id')}">            
                <td>                 
                    {format_gender($contact->get('sex',1,true))|capitalize}               
                </td>                       
                <td>                            
                    {$contact->get('firstname')}                   
                </td>            
                <td>
                    {$contact->get('lastname')}
                </td>                        
                <td>
                    {$contact->get('email')|escape}               
                </td>                     
                <td>
                    {$contact->get('phone')|escape}                
                </td>                    
                <td> 
                   {$contact->get('mobile')|escape}
                </td>                    
                <td> 
                   {$contact->get('fax')|escape}
                </td>                  
                <td>
                    <a href="#" title="{__('Edit')}" class="MutualPartnerContact-View" id="{$contact->get('id')}"><i class="fa fa-edit"></i></a>                
                    <a href="#" title="{__('Delete')}" class="MutualPartnerContact-Delete" id="{$contact->get('id')}"  name="{$contact}"><i class="fa fa-times"></i></a> 
                </td>
            </tr>           
        {/foreach}
        </table>
        </div>
    {else}
        <span>{__('No contact.')}</span>
    {/if}
{else}
    <span>{__('MutualPartner is invalid.')}</span>
{/if}   

<script type="text/javascript">
    
    $('#MutualPartnerContact-Cancel').click(function(){                           
        return $.ajax2({                               
                        url : "{url_to('app_mutual_ajax',['action'=>'ListPartialMutualPartner'])}",
                        errorTarget: ".MutualPartner-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",                         
                        target: "#actions" }); 
    });
    
    $('#MutualPartnerContact-New').click(function(){                           
        return $.ajax2({ data :{ MutualPartner: "{$item->get('id')}" },                              
                        url : "{url_to('app_mutual_ajax',['action'=>'NewMutualPartnerContact'])}",
                        errorTarget: ".MutualPartner-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",                         
                        target: "#actions" }); 
    });
    
    
    $('.MutualPartnerContact-View').click(function(){         
        return $.ajax2({ data :{ MutualPartnerContact: $(this).attr('id') },                              
                        url : "{url_to('app_mutual_ajax',['action'=>'ViewMutualPartnerContact'])}",
                        errorTarget: ".MutualPartner-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",                         
                        target: "#actions" });  
    });
    
    $(".MutualPartnerContact-Delete").click( function () { 
        if (!confirm('{__("Contact \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
        return $.ajax2({ data :{ MutualPartnerContact: $(this).attr('id') },
                        url :"{url_to('app_mutual_ajax',['action'=>'DeleteMutualPartnerContact'])}",
                        errorTarget: ".MutualPartner-errors",    
                        loading: "#tab-site-site-x-settings-loading",
                        success : function(resp) {
                            if (resp.action=='DeleteMutualPartnerContact')
                            {    
                                $("tr#MutualPartnerContact-"+resp.id).remove();  
                                if ($('.MutualPartnerContact').length==0)
                                    return $.ajax2({ url:"{url_to('app_mutual_ajax',['action'=>'ListPartialMutualPartnerContact'])}",
                                                    errorTarget: ".site-errors",
                                                    target: "#tab-dashboard-site-x-settings"});                                        
                            }       
                        }
        });                                        
    });
</script>    