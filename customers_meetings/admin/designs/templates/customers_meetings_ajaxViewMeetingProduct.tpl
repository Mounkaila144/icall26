{messages class="site-meeting-errors-{$item->getMeeting()->get('id')}"}
<h3>{__("View product")|capitalize}</h3>
<div>
    <a href="#" class="btn" id="CustomerMeetings-Save" style="display:none"><i class="fa fa-floppy-o" style="margin-right: 10px"></i>
{*<img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>*}{__('save')}</a>
    <a href="#" class="btn" id="CustomerMeetings-Cancel"><i class="fa fa-times" style="margin-right: 10px"></i>
{*<img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>*}{__('cancel')}</a>   
</div>
{if $item->isLoaded()}
    <table class="tab-form" id="Product-form">                
    <tr>
        <td class="label">{__("Product")}
        </td>
        <td>                    
           <div class="product-errors-form error-form">{$form.product_id->getError()}</div>
            {html_options name="product_id" class="Products-{$item->get('id')}" options=$form->product_id->getOption('choices') selected=$item->get('product_id')} 
        </td>
    </tr>            
    <tr>
        <td class="label">{__("Details")}
        </td>
        <td>
            <div class="product-errors-form error-form">{$form.details->getError()}</div>  
            <input type="text" id="" class="Products-{$item->get('id')}" name="details" value="{$item->get('details')|escape}" size="30"/>          
        </td>
    </tr>
</table>   
{else}      
    <span>{__('Meeting is invalid.')}</span> 
{/if}    

  <script type="text/javascript">
       
        $(".Products-{$item->get('id')}").click(function() { $("#CustomerMeetings-Save").show(); });
    
        $(".Products-{$item->get('id')}").change(function() { $("#CustomerMeetings-Save").show(); });
    
        $("#CustomerMeetings-Save").click( function () {    
            var params= { MeetingProduct: { id: "{$item->get('id')}",
                                            product_id: $(".Products-{$item->get('id')}[name=product_id] option:selected").val(),
                                            token :'{$form->getCSRFToken()}' } };
             $("input.Products-{$item->get('id')}[type=text]").each(function() { params.MeetingProduct[this.name]=$(this).val(); });
            // alert("Params="+params.products.toSource()); return false;           
            return $.ajax2({     
                data : params,
                url: "{url_to('customers_meeting_ajax',['action'=>'SaveMeetingProduct'])}",
                errorTarget: ".customers-meeting-site-errors",
                loading: "#tab-site-dashboard-customers-meeting-loading",                          
                target: "#tab-customer-meetings-products-{$item->getMeeting()->get('id')}"
           });
       });
       
       $("#CustomerMeetings-Cancel").click( function () {                           
            return $.ajax2({     
                data : { Meeting: {$item->getMeeting()->get('id')} },
                url: "{url_to('customers_meeting_ajax',['action'=>'ListMeetingProduct'])}",
                errorTarget: ".customers-meeting-site-errors",
                loading: "#tab-site-dashboard-customers-meeting-loading",                          
                target: "#tab-customer-meetings-products-{$item->getMeeting()->get('id')}"
           });
       });
        
</script>