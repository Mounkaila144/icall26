{messages class="Partner-errors"}
<h3>{__("View contacts for partner: %s.",$item->get('name'))}</h3>
<div>
    <a href="#" id="PartnerContact-New" class="btn" title="{__('new contact')}" >
        <i class="fa fa-plus" style=" margin-right: 10px"></i>{__('New contact')}</a>   
        <a href="#" id="PartnerContact-Cancel" class="btn">
          <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>
{if $item->isLoaded()}
    {if $item->hasContacts()}
        <div><span>{format_number_choice('[1]one contact|(1,Inf]%s contacts',$item->getContacts()->count(),$item->getContacts()->count())}</span></div>
        <div class="containerDivResp">
        <table class="tabl-list footable table">
            <thead>
            <tr  class="list-header">
                <th></th>
                <th class="footable-first-column" data-toggle="true">{__("firstname")}</th>
                <th data-hide="phone" style="display: table-cell;">{__("lastname")}</th>
                <th data-hide="phone" style="display: table-cell;">{__("email")}</th> 
                <th data-hide="phone" style="display: table-cell;">{__("phone")}</th>
                <th data-hide="phone" style="display: table-cell;">{__("mobile")}</th>
                <th data-hide="phone" style="display: table-cell;">{__("fax")}</th>               
                <th data-hide="phone" style="display: table-cell;">{__("actions")}</th>
            </tr>
            </thead>
            {foreach $item->getContacts() as $contact}
            <tr class="PartnerContact list" id="PartnerContact-{$contact->get('id')}">            
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
                      <i class="fa fa-edit" style="font-size: 16px;"></i></a>                
                    <a href="#" title="{__('Delete')}" class="PartnerContact-Delete" id="{$contact->get('id')}"  name="{$contact}">
                       <i class="fa fa-remove" style="font-size: 16px;"></i>
                    </a>  
                </td>
         </tr>           
        {/foreach}
        </table>
        </div>
    {else}
        <span>{__('No contact.')}</span>
    {/if}
{else}
    <span>{__('Partner is invalid.')}</span>
{/if}   

<script type="text/javascript">
    
    $('#PartnerContact-Cancel').click(function(){                           
             return $.ajax2({                               
                              url : "{url_to('partners_layer_ajax',['action'=>'ListPartialLayerCompany'])}",
                              errorTarget: ".Partner-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions" }); 
    });
    
    $('#PartnerContact-New').click(function(){                           
             return $.ajax2({ data :{ PartnerLayer: "{$item->get('id')}" },                              
                              url : "{url_to('partners_layer_ajax',['action'=>'NewPartnerContact'])}",
                              errorTarget: ".Partner-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions" }); 
    });
    
    
     $('.PartnerContact-View').click(function(){         
           return $.ajax2({ data :{ PartnerLayerContact: $(this).attr('id') },                              
                              url : "{url_to('partners_layer_ajax',['action'=>'ViewPartnerContact'])}",
                              errorTarget: ".Partner-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions" });  
    });
    
     $(".PartnerContact-Delete").click( function () { 
                if (!confirm('{__("Contact \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ PartnerLayerContact: $(this).attr('id') },
                                 url :"{url_to('partners_layer_ajax',['action'=>'DeletePartnerContact'])}",
                                 errorTarget: ".Partner-errors",    
                                 loading: "#tab-site-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='DeletePartnerContact')
                                       {    
                                          $("tr#PartnerContact-"+resp.id).remove();  
                                          if ($('.PartnerContact').length==0)
                                              return $.ajax2({ url:"{url_to('partners_layer_ajax',['action'=>'ListPartialPartnerContact'])}",
                                                               errorTarget: ".site-errors",
                                                               target: "#tab-dashboard-site-x-settings"});                                        
                                        }       
                                 }
                     });                                        
            });
           
</script>   
