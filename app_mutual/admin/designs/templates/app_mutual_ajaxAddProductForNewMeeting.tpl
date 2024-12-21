<div id="CustomerMeetingMutualProduct-NewMeeting-{$key}" data-mutual='{$meeting_product->getProduct()->getMutualPartner()->toJsonForSelect()}'>   
    <div class="AddProductMutualForNewMeeting" data-id="{$meeting_product->get('product_id')}">
        <span>{$meeting_product->getProduct()->getMutualPartner()|upper}</span>
        <span>{$meeting_product->getProduct()|upper}</span>
        <span>{__("Sale price with tax")}</span>
        <input type="text" class="CustomerMeetingMutualProduct-NewMeeting" name="sale_price_with_tax" data-product-id="{$meeting_product->get('product_id')}"/>
        <a data-product-id="{$meeting_product->get('product_id')}" href="javascript:void(0);" class="DeleteCustomerMeetingMutualProduct-NewMeeting-{$key} btn btn-default"><i class="fa fa-trash"></i><span style="display: none" class="bullInfo">{__('Delete Product')}</span></a>    
    </div>             

<script type="text/javascript">
    
    $(".DeleteCustomerMeetingMutualProduct-NewMeeting-{$key}").click(function () {      
        if($("#NewMeetingMutualProduct-Ctn").data("products").indexOf($(this).attr("data-product-id"))!=-1)
        {
            $("#NewMeetingMutualProduct-Ctn").data("products").splice($("#NewMeetingMutualProduct-Ctn").data("products").indexOf($(this).attr("data-product-id")),1);
        }
        //updateMutualDropDown
        var mutual_update = $("#CustomerMeetingMutualProduct-NewMeeting-{$key}").data("mutual");
        if($(".MutualPartner-NewMeeting[name='mutual'] option[value='"+mutual_update.id+"']").length==0)
        {
            var option = "<option data-tokens='"+mutual_update.name+"' value='"+mutual_update.id+"'>"+mutual_update.name+"</option>";
            $(".MutualPartner-NewMeeting[name='mutual']").append(option); 
            $(".MutualPartner-NewMeeting[name='mutual']").selectpicker('refresh');
        }
        
        //end
        $(".MutualPartner-NewMeeting[name='mutual']").trigger('change');    
        $("#CustomerMeetingMutualProduct-NewMeeting-{$key}").remove();  
    });
    
</script>  

</div>