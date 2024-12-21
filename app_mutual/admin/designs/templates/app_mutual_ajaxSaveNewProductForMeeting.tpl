{if $meeting->isLoaded()}
    {if $form->isValid()} 
        {foreach $meeting_products as $meeting_product}
        <div class="CustomerMeetingMutualProductCmp-Ctn-{$meeting_product->get('id')}" data-id="{$meeting_product->get('id')}">
            {include file="app_mutual_ajaxViewProductForMeeting.tpl"}    
        </div>
        {/foreach}
    {else}
        {foreach $meeting_products as $key=>$meeting_product}
            <div id="CustomerMeetingMutualProduct-ViewMeeting-{$key}" data-mutual='{$meeting_product->getProduct()->getMutualPartner()->toJsonForSelect()}'>   
                <div class="AddProductMutualForViewMeeting" data-id="{$meeting_product->get('product_id')}">
                    <span>{$meeting_product->getProduct()->getMutualPartner()->get('name')|upper}</span>
                    <span>{$meeting_product->getProduct()|upper}</span>
                    <span>{__("Sale price with tax")}</span>
                    <span class="form-errors">{$form.collection[$key].sale_price_with_tax->getError()}</span>
                    <input type="text" class="CustomerMeetingMutualProduct-ViewMeeting" name="sale_price_with_tax" data-product-id="{$meeting_product->get('product_id')}" value="{$meeting_product->get('sale_price_with_tax')}"/>
                    <a data-product-id="{$meeting_product->get('product_id')}" href="javascript:void(0);" class="DeleteCustomerMeetingMutualProduct-ViewMeeting-{$key} btn btn-default"><i class="fa fa-trash"></i><span style="display: none" class="bullInfo">{__('Delete Product')}</span></a>    
                </div>             
                <script type="text/javascript">

                    $(".DeleteCustomerMeetingMutualProduct-ViewMeeting-{$key}").click(function () {      
                        if($("#ViewMeetingMutualProduct-Ctn").data("products").indexOf($(this).attr("data-product-id"))!=-1)
                        {
                            $("#ViewMeetingMutualProduct-Ctn").data("products").splice($("#ViewMeetingMutualProduct-Ctn").data("products").indexOf($(this).attr("data-product-id")),1);
                        }
                        //updateMutualDropDown
                        var mutual_update = $("#CustomerMeetingMutualProduct-ViewMeeting-{$key}").data("mutual");
                        if($(".MutualPartner-ViewMeeting[name='mutual'] option[value='"+mutual_update.id+"']").length==0)
                        {
                            var option = "<option data-tokens='"+mutual_update.name+"' value='"+mutual_update.id+"'>"+mutual_update.name+"</option>";
                            $(".MutualPartner-ViewMeeting[name='mutual']").append(option); 
                            $(".MutualPartner-ViewMeeting[name='mutual']").selectpicker('refresh');
                        }

                        //end
                        $(".MutualPartner-ViewMeeting[name='mutual']").trigger('change');    
                        $("#CustomerMeetingMutualProduct-ViewMeeting-{$key}").remove();  
                    });

                </script>  

            </div>
        {/foreach}
    {/if}    
{else}
    {__('Meeting is invalid.')}
{/if}    
