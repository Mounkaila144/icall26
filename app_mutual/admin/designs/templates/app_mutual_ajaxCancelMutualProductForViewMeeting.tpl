<div id="CancelCustomerMeetingMutualProduct-ViewMeeting-{$meeting_product->get('id')}" data-mutual='{$meeting_product->getProduct()->getMutualPartner()->toJsonForSelect()}'>   
    <div class="" data-id="{$meeting_product->get('id')}">
        <span>{$meeting_product->getProduct()->getMutualPartner()|upper}</span>
        <span id="{$meeting_product->get('id')}">{$meeting_product->getProduct()|upper}</span>
        <span class="CustomerMeetingMutualProduct-ListProducts" data-id="{$meeting_product->get('id')}" data-product-id="{$meeting_product->getProduct()->get('id')}" data-price="{$meeting_product->getSalePriceWithTaxI18n()}">{$meeting_product->getSalePriceWithTaxI18n()}</span>
        <a id="{$meeting_product->get('id')}" href="javascript:void(0);" class="DeleteCustomerMeetingMutualProduct-{$meeting_product->get('id')} btn btn-default" data-price="{$meeting_product->getSalePriceWithTaxI18n()}"><i class="fa fa-trash"></i><span style="display: none" class="bullInfo">{__('Delete Meeting Product')}</span></a>    
        <a id="{$meeting_product->get('id')}" href="javascript:void(0);" class="UpdateCustomerMeetingMutualProduct-{$meeting_product->get('id')} btn btn-default" data-price="{$meeting_product->getSalePriceWithTaxI18n()}"><i class="fa fa-edit"></i><span style="display: none" class="bullInfo">{__('Update Meeting Product')}</span></a> 
    </div>             

<script type="text/javascript">
    
    $(".DeleteCustomerMeetingMutualProduct-{$meeting_product->get('id')}").click(function () {       
        return $.ajax2({ data : { CustomerMeetingMutualProduct:  $(this).attr('id'),Meeting: {$meeting->get('id')} },
                        url : "{url_to('app_mutual_ajax',['action'=>'DeleteMutualProductForMeeting'])}", 
                        errorTarget: ".meeting-mutual-products-Messages",
                        loading: "#tab-site-dashboard-customers-meeting-loading",
                        success : function(response)
                                {                                              
                                    if (response.action=='DeleteCustomerMeetingMutualProduct')
                                    {    
                                        var mutual_update = $("#CustomerMeetingMutualProduct-ListProducts-"+response.id).data("mutual");
                                        if($(".MutualPartner-ViewMeeting[name='mutual'] option[value='"+mutual_update.id+"']").length==0)
                                        {
                                            var option = "<option data-tokens='"+mutual_update.name+"' value='"+mutual_update.id+"'>"+mutual_update.name+"</option>";
                                            $(".MutualPartner-ViewMeeting[name='mutual']").append(option); 
                                            $(".MutualPartner-ViewMeeting[name='mutual']").selectpicker('refresh');
                                        }
                                        $(".CustomerMeetingMutualProductCmp[data-id="+response.id+"]").remove(); 
                                        $(".MutualPartner-ViewMeeting[name='mutual']").trigger('change');
                                    }
                                    
                                }
                        });
    });
    
    $(".UpdateCustomerMeetingMutualProduct-{$meeting_product->get('id')}").click(function () {       
        var product = $(this).attr('id');
        return $.ajax2({ data : { CustomerMeetingMutualProduct:  $(this).attr('id'),Meeting: {$meeting->get('id')} },
                        url : "{url_to('app_mutual_ajax',['action'=>'UpdateProductForViewMeeting'])}", 
                        errorTarget: ".meeting-mutual-products-Messages",
                        loading: "#tab-site-dashboard-customers-meeting-loading",
                        success : function(response)
                                {                                              
                                    if (response.action)
                                    {  
                                    }
                                    else
                                    {
                                        $("#CustomerMeetingMutualProduct-ListProducts-"+product).html(response); 
                                    }
                                }
                        });
    });
    
    
</script>  

</div>