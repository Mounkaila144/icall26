<div id="UpdateCustomerMeetingMutualProduct-ViewMeeting-{$meeting_product->get('id')}" data-mutual='{$meeting_product->getProduct()->getMutualPartner()->toJsonForSelect()}'>   
    <div class="UpdateProductMutualForViewMeeting" data-id="{$meeting_product->get('id')}">
        <span>{$meeting_product->getProduct()->getMutualPartner()->get('name')|upper}</span>
        <span>{$meeting_product->getProduct()|upper}</span>
        <br/>
        <span>{__("Sale price with tax")}</span>
        <input type="text" class="UpdateCustomerMeetingMutualProduct-ViewMeeting" name="sale_price_with_tax" data-id="{$meeting_product->get('id')}" value="{$meeting_product->getSalePriceWithTaxI18n()}" data-product-id="{$meeting_product->getProduct()->get('id')}"/>
        <a data-id="{$meeting_product->get('id')}" href="javascript:void(0);" class="CancelCustomerMeetingMutualProduct-ViewMeeting-{$meeting_product->get('id')} btn btn-default"><i class="fa fa-share"></i><span style="display: none" class="bullInfo">{__('Cancel')}</span></a>    
    </div>             

<script type="text/javascript">
    
    $(".CancelCustomerMeetingMutualProduct-ViewMeeting-{$meeting_product->get('id')}").click(function () { 
        return $.ajax2({
            data: { CustomerMeetingMutualProduct: $(this).attr('data-id'), Meeting: {$meeting->get('id')} },
            url : "{url_to('app_mutual_ajax',['action'=>'CancelMutualProductForViewMeeting'])}", 
            errorTarget: ".meeting-mutual-products-Messages",
            loading: "#tab-site-dashboard-customers-meeting-loading",
            success : function(response)
                    {                                              
                        if (response.action)
                        {    
                        }
                        else
                        {
                            $("#CustomerMeetingMutualProduct-ListProducts-{$meeting_product->get('id')}").html(response);
                        }

                    }
        });
    });
    
</script>  

</div>