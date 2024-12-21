{if $meeting->isLoaded()}
    {if $meeting->getStatus()->get('icon')} 
                        <img src="{$meeting->getStatus()->getIcon()->getURL()}" height="16" width="16" alt="{__('icon')}"/> 
                     {elseif $meeting->getStatus()->get('color')}
                     <span style="background:{$meeting->getStatus()->get('color')};float:left;margin-right:4px; display:block; height:15px; width: 15px;">&nbsp;</span>                
                     {/if}
    {$meeting->getHour()}:{$meeting->getMinute()}
    {$meeting->getCustomer()}{__('Phone')}:{$meeting->getCustomer()->getPhone()}{__('Mobile')}:{$meeting->getCustomer()->getMobile()}
    {__('Address')}:
    {$meeting->getCustomer()->getAddress()->get('address1')}
    {$meeting->getCustomer()->getAddress()->get('address2')}
    {$meeting->getCustomer()->getAddress()->get('postcode')}
    {$meeting->getCustomer()->getAddress()->get('city')}
    {__('Telepro')}:{$meeting->getTelepro()}
    {__('Saleman')}:{$meeting->getSale()}
    {__('Meeting is taken at')}{format_date($meeting->get('created_at'),["d","q"])}
     {if $meeting->isConfirmed()}
                     <a href="#" title="{__('Click to cancel confirmation')}" class="CustomerMeetings-Confirm" id="{$meeting->get('id')}" name="Cancel">
                     <img class="CustomerMeetings-Confirm-img" id="{$meeting->get('id')}" src="{url('/icons/approved16x16.png','picture')}" alt='{__("Confirmed")}'/></a> 
                {else}
                    <a href="#" title="{__('Click to confirm')}" class="CustomerMeetings-Confirm" id="{$meeting->get('id')}" name="Confirm">
                    <img class="CustomerMeetings-Confirm-img" id="{$meeting->get('id')}" src="{url('/icons/refused16x16.png','picture')}" alt='{__("Refused")}'/></a>  
                {/if}
      <a href="#" title="{__('edit')}" class="CustomerMeetings-View" id="{$meeting->get('id')}" name="{$meeting->getCustomer()}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a> 
      <a href="#" title="{__('delete')}" class="CustomerMeetings-Delete" id="{$meeting->get('id')}"  name="{$meeting->getCustomer()}">
          <img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/>
      </a>
{else}
    <span>{__('Meeting is invalid.')}</span>
{/if} 

<script type="text/javascript">
    
    $(".CustomerMeetings-View").click(function() { 
            addTabField("customers-planning",$(this).attr('id'),$(this).attr('name'));  
            return $.ajax2({ data :{ Meeting: $(this).attr('id'), target: "" },
                                 url :"{url_to('customers_meeting_ajax',['action'=>'ViewMeeting'])}",
                                 errorTarget: ".customers-planning-site-errors",     
                                  loading: "#tab-site-dashboard-customers-planning-loading",
                                 target: "#tab-site-panel-dashboard-customers-planning-"+$(this).attr('id')
                     });  
    });
    
    $(".CustomerMeetings-Delete").click( function () { 
                if (!confirm('{__("Meeting \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ Meeting: $(this).attr('id') },
                                 url :"{url_to('customers_meeting_ajax',['action'=>'DeleteMeeting'])}",
                                 errorTarget: ".customers-planning-site-errors",     
                                 loading: "#tab-site-dashboard-customers-planning-loading",
                                 success : function(resp) {
                                       if (resp.action=='DeleteMeeting')
                                       {    
                                          $("#Meeting").html("");
                                          $(".Meetings[id="+resp.id+"]").remove();
                                          count=parseInt($("#Meeting-Number").attr('name'))-1;                                         
                                          if (count == 0)
                                              text="{__("no meeting")}";
                                          else if (count == 1)
                                            text="{__("one meeting")}";
                                          else
                                             text=count+"{__(" meetings")}";
                                          $("#Meeting-Number").html(text);
                                          $("#Meeting-Number").attr('name',count);
                                       }       
                                 }
                     });                                        
      });
      
       $(".CustomerMeetings-Confirm").click( function () {   
            if ($(this).attr('name')=='Confirm')
            {
               return $.ajax2({     
                    data : { Meeting: $(this).attr('id') },
                    url: "{url_to('customers_meeting_ajax',['action'=>'ConfirmMeeting'])}",
                    errorTarget: ".customers-planning-site-errors",  
                    loading: "#tab-site-dashboard-customers-planning-loading",
                    success: function (resp)
                             {
                                if (resp.action=='ConfirmMeeting')
                                {                                        
                                      $(".CustomerMeetings-Confirm[id="+resp.id+"]").attr({ name:"Cancel", title: "{__('Click to cancel confirmation')}" });
                                      $(".CustomerMeetings-Confirm-img[id="+resp.id+"]").attr({ 
                                              src: "{url('/icons/approved16x16.png','picture')}",
                                              alt: "{__('cancel')}"
                                      });  
                                }
                             }
                 });
            }    
            else
            {
                return $.ajax2({     
                    data : { Meeting: $(this).attr('id') },
                    url: "{url_to('customers_meeting_ajax',['action'=>'CancelMeeting'])}",
                    errorTarget: ".customers-planning-site-errors",  
                    loading: "#tab-site-dashboard-customers-planning-loading",
                    success: function (resp)
                             {
                                if (resp.action=='CancelMeeting')
                                {                                        
                                      $(".CustomerMeetings-Confirm[id="+resp.id+"]").attr({ name: "Confirm", title: "{__('Click to confirm')}" });                                     
                                      $(".CustomerMeetings-Confirm-img[id="+resp.id+"]").attr({ 
                                              src: "{url('/icons/refused16x16.png','picture')}",
                                              alt: "{__('confirm')}"
                                      });  
                                }
                             }
                 });
            }    
         return false;           
     });
</script>    