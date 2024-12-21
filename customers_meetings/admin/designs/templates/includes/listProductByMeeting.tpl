<div>
            <a href="#" class="btn" id="CustomerMeetings-NewMeetingProduct" title="{__('new product')}" ><img  src="{url('/icons/new.gif','picture')}" alt="{__('new')}"/>{__('New product')}</a>
</div>
{if $meeting->hasMeetingProducts()}   
    <table id="CustomerMeetings-Product-List" class="tabl-list">
        <tr class="list-header">
            <th>{__('Product')}
            </th>
            <th>{__('Detail')}
            </th>
            <th>{__('Actions')}
            </th>
        </tr>
    {foreach $meeting->getMeetingProducts() as $meeting_product}
        <tr class="CustomerMeetingsProduct list" id="CustomerMeetingsProduct-{$meeting_product->get('id')}">
            <td> {$meeting_product->getProduct()->get('meta_title')}     
            </td>
            <td>{$meeting_product->get('details')} 
            </td>   
            <td>
                <a href="#" title="{__('Edit')}" class="CustomerMeetings-ViewProduct" id="{$meeting_product->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("Edit")}'/></a> 
                 <a href="#" title="{__('Delete')}" class="CustomerMeetings-DeleteProduct" id="{$meeting_product->get('id')}"  name="{$meeting_product->getProduct()->get('meta_title')}">
                   <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
                </a>   
            </td>
        </tr>
    {/foreach}    
    </table>    
{else}
    <span>{__('No product available.')}</span>
{/if}    
<script type="text/javascript">
        
       $(".CustomerMeetings-DeleteProduct").click( function () {    
            if (!confirm('{__("Product \"#0#\" will be deleted. Confirm ?")}'.format(this.name))) return false; 
            return $.ajax2({     
                data : { MeetingProduct: $(this).attr('id') },
                url: "{url_to('customers_meeting_ajax',['action'=>'DeleteMeetingProduct'])}",
                errorTarget: ".customers-meeting-site-errors",
                loading: "#tab-site-dashboard-site-customers-meeting-loading",
                success: function (resp)
                         {
                             if (resp.action=='DeleteMeetingProduct')
                             {
                                 $("#CustomerMeetingsProduct-"+resp.id).remove();    
                                 if ($(".CustomerMeetingsProduct").length==0)
                                 {
                                      $("#CustomerMeetings-Product-List").after("{__("No product")}");
                                 }    
                             }    
                         }
           });
       });
       
       $(".CustomerMeetings-ViewProduct").click( function () {                           
            return $.ajax2({     
                data : { MeetingProduct: $(this).attr('id') },
                url: "{url_to('customers_meeting_ajax',['action'=>'ViewMeetingProduct'])}",
                errorTarget: ".customers-meeting-site-errors",
                loading: "#tab-site-dashboard-site-customers-meeting-loading",                           
                target: "#tab-customer-meetings-products-{$meeting->get('id')}"
           });
       });
       
        $("#CustomerMeetings-NewMeetingProduct").click( function () {                           
            return $.ajax2({     
                data : { Meeting: "{$meeting->get('id')}" },
                url: "{url_to('customers_meeting_ajax',['action'=>'NewMeetingProduct'])}",
                errorTarget: ".customers-meeting-site-errors",
                loading: "#tab-site-dashboard-site-customers-meeting-loading",                          
                target: "#tab-customer-meetings-products-{$meeting->get('id')}"
           });
       });
        
    </script>