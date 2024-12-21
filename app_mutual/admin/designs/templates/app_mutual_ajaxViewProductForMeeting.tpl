<div class="GreenHeaderPanel MyCv">
    <div class="col-md-4" >    
        <div id="CustomerMeetingMutualProduct-ListProducts-{$meeting_product->get('id')}" class="CustomerMeetingMutualProductCmp actionsHeaderCv" data-mutual='{$meeting_product->getProduct()->getMutualPartner()->toJsonForSelect()}'>
            <span>{$meeting_product->getProduct()->getMutualPartner()->get('name')|upper}</span>
            <span id="{$meeting_product->get('id')}">{$meeting_product->getProduct()|upper}</span>
            <br/>
            <span>{__("Sale price with tax")}</span>
            <input type="text" class="CustomerMeetingMutualProduct-ListProducts" name="sale_price_with_tax" data-id="{$meeting_product->get('id')}" value="{$meeting_product->getSalePriceWithTaxI18n()}" data-product-id="{$meeting_product->getProduct()->get('id')}"/>
            <a id="{$meeting_product->get('id')}" data-product-id="{$meeting_product->get('product_id')}" href="javascript:void(0);" class="DeleteCustomerMeetingMutualProduct-{$meeting_product->get('id')} btn btn-default" data-price="{$meeting_product->getSalePriceWithTaxI18n()}"><i class="fa fa-trash"></i><span style="display: none" class="bullInfo">{__('Delete Meeting Product')}</span></a>    
        </div>
    </div>
</div>              

<script type="text/javascript">
    
    $(".DeleteCustomerMeetingMutualProduct-{$meeting_product->get('id')}").click(function () {    
        if($("#ViewMeetingMutualProduct-Ctn").data("products").indexOf($(this).attr("data-product-id"))!=-1)
        {
            $("#ViewMeetingMutualProduct-Ctn").data("products").splice($("#ViewMeetingMutualProduct-Ctn").data("products").indexOf($(this).attr("data-product-id")),1);
        }
        var mutual_update = $("#CustomerMeetingMutualProduct-ListProducts-"+$(this).attr('id')).data("mutual");

        if($(".MutualPartner-ViewMeeting[name='mutual'] option[value='"+mutual_update.id+"']").length==0)
        {
            var option = "<option data-tokens='"+mutual_update.name+"' value='"+mutual_update.id+"'>"+mutual_update.name+"</option>";
            $(".MutualPartner-ViewMeeting[name='mutual']").append(option); 
            $(".MutualPartner-ViewMeeting[name='mutual']").selectpicker('refresh');
        }
        
        //end
        $(".MutualPartner-ViewMeeting[name='mutual']").trigger('change');  
        $(".CustomerMeetingMutualProductCmp[data-id="+$(this).attr('id')+"]").remove();
        
    });
    
</script>                     