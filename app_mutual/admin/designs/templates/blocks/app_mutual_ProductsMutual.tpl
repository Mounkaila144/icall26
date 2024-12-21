{messages class="meeting-mutual-products-Messages"}
<div id="CustomerMeetingMutual-Ctn" class="widget-content-Mutual">
    <div id="CustomerMeetingMutualProductNewCtn">
        {if !$form->getMutuals()->isEmpty()}
        <div class="NewProduct col-md-10 editMycv"> {*panel panel-default*}
            <div class="col-md-8 editBlocksMutuals  no_padding">
                <select class="selectpicker MutualPartner-ViewMeeting" name="mutual" data-live-search="true" {if $form->getMutuals()->count()==1}style="display: none;"{/if}>
                    {foreach $form->getMutuals() as $mutual}
                        <option data-tokens="{$mutual}" value="{$mutual->get('id')}">{$mutual}</option>
                        {$form->getMutuals()->isInSelect($mutual->get('id'))}
                    {/foreach}
                </select>
                <span class="MutualPartner-Label-ViewMeeting" value="{if $form->getMutuals()->getFirst()->get('id')}{$form->getMutuals()->getFirst()->get('id')}{/if}" {if $form->getMutuals()->count()>1}style="display: none;"{/if}>{if $form->getMutuals()->getFirst()->get('id')}{$form->getMutuals()->getFirst()}{/if}</span>

                <select class="selectpicker CustomerMeetingMutualProduct-Select-New" name="product_id" data-live-search="true" {if $form->getMutuals()->getFirst()->getProducts()->count()==1}style="display: none;"{/if}>
                    {foreach $form->getMutuals()->getFirst()->getProducts() as $product}
                        <option data-tokens="{$product}" value="{$product->get('id')}" data-meeting="{$meeting->get('id')}">{$product}</option>
                        {$form->getMutuals()->getFirst()->getProducts()->isInSelect($product->get('id'))}
                    {/foreach}
                </select>
                
                <span class="CustomerMeetingMutualProduct-Label-New" value="{if $form->getMutuals()->getFirst()->getProducts()->getFirst()}{$form->getMutuals()->getFirst()->getProducts()->getFirst()->get('id')} {/if}" {if $form->getMutuals()->getFirst()->getProducts()->count()>=1}style="display: none;"{/if}>{if $form->getMutuals()->getFirst()->getProducts()->getFirst()}{$form->getMutuals()->getFirst()->getProducts()->getFirst()}{/if}</span>
                
                <a id="AddCustomerMeetingMutualProduct-ViewMeeting" href="javascript:void(0);" class="btn btn-default"><i class="fa fa-plus"></i></a>
            </div>
            
            <div style="clear: both"></div>
        </div>
        {else}
            {__('No mutuals')}
        {/if}
    </div>
    
    <div id="ViewMeetingMutualProduct-Ctn" style="clear: both;">
        
    </div>

    <div id="CustomerMeetingMutualProductsContainer">
        {foreach $form->getSelectedMutuals() as $mutual}
            <div id="{$mutual->get('id')}" class="CustomerMeetingMutualProductsList no_padding" style="display: inline-block;">
                {foreach $mutual->getSelection() as $meeting_product}
                    <div id="CustomerMeetingMutualProduct-ListProducts-{$meeting_product->get('id')}" class="CustomerMeetingMutualProductCmp col-md-6" data-id="{$meeting_product->get('id')}" data-price="{$meeting_product->getSalePriceWithTaxI18n()}" data-mutual='{$meeting_product->getProduct()->getMutualPartner()->toJsonForSelect()}'>
                        <span>{$mutual|upper}</span>
                        <span id="{$meeting_product->get('id')}">{$meeting_product->getProduct()|upper}</span>
                        <br/>
                        <span>{__("Sale price with tax")}</span>
                        <input type="text" class="CustomerMeetingMutualProduct-ListProducts" name="sale_price_with_tax" data-id="{$meeting_product->get('id')}" value="{$meeting_product->getSalePriceWithTaxI18n()}" data-product-id="{$meeting_product->getProduct()->get('id')}"/>
                        <a id="{$meeting_product->get('id')}" href="javascript:void(0);" class="DeleteCustomerMeetingMutualProduct btn btn-default" data-price="{$meeting_product->getSalePriceWithTaxI18n()}"><i class="fa fa-trash"></i><span style="display: none" class="bullInfo">{__('Delete Meeting Product')}</span></a>    
                    </div>
                {/foreach}
                <div style="clear: both"></div>
            </div>  
        {/foreach}
    </div>
    <div class="actionsHeaderCv" style="clear: both; text-align: center;">
        <a href="javascript:void(0);" class="SaveCustomerMeetingMutualProduct-New btn btn-default"><i class="fa fa-save" style="margin-right: 10px;"></i>{__('Save')}</a>
    </div> 
</div>

<script type="text/javascript">
    var data_json_mutual = {$form->getMutuals()->toJsonForForm()};
    $('.selectpicker').selectpicker();
    
    $(".DeleteCustomerMeetingMutualProduct").click(function () {  
        
        //updateMutualDropDown
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
    
    {* ================================ NEW ACTIONS =========================== *}
    
    $(".MutualPartner-ViewMeeting[name='mutual']").change(function () {  
        if($(".MutualPartner-ViewMeeting[name='mutual'] option").length==0)
            return;
        return $.ajax2({    data : { MutualPartner:  $(this).val(), Meeting: {$meeting->get('id')} },
                            url : "{url_to('app_mutual_ajax',['action'=>'GetProductsForMutual'])}", 
                            errorTarget: ".meeting-mutual-products-Messages",
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            success : function(response)
                                    {                                              
                                        if (response.action=='GetProductsForMutual')
                                        {            
                                            var products_exist = ($("#ViewMeetingMutualProduct-Ctn").data("products"))?$("#ViewMeetingMutualProduct-Ctn").data("products"):[];
                                            $(".CustomerMeetingMutualProduct-Select-New[name='product_id']").html("");
                                            var has_item = false;
                                            $.each(response.items, function(key,item){
                                                if(products_exist.indexOf(item.id)==-1 || products_exist.length==0)
                                                {
                                                    has_item = true;
                                                    var option = "<option data-tokens='"+item.name+"' value='"+item.id+"'>"+item.name+"</option>";
                                                    $(".CustomerMeetingMutualProduct-Select-New[name='product_id']").append(option); 
                                                }
                                            });
                                            if(!has_item)
                                            {
                                                $(".MutualPartner-ViewMeeting[name='mutual'] option[value='"+response.mutual+"']").remove();
                                                $(".selectpicker.MutualPartner-ViewMeeting[name='mutual']").selectpicker('refresh');
                                            }
                                            $('.selectpicker.CustomerMeetingMutualProduct-Select-New').selectpicker('refresh');
                                        }
                                    }
                        });
    });
    
    $(".SaveCustomerMeetingMutualProduct-New").click(function () {     
        var params= { Meeting: {$meeting->get('id')},
                        CustomerMeetingMutualProduct: {  
                            collection: [],
                            token : '{$form->getCSRFToken()}'
                        }
                    };
        
        $(".AddProductMutualForViewMeeting").each(function () { 
            var obj1 = { product_id: $(this).attr("data-id"), sale_price_with_tax: $(".CustomerMeetingMutualProduct-ViewMeeting[name='sale_price_with_tax'][data-product-id='"+$(this).attr("data-id")+"']").val() };
            
            params.CustomerMeetingMutualProduct.collection.push(obj1);
        });
        
        $(".CustomerMeetingMutualProduct-ListProducts").each(function () { 
            var obj3 = { product_id: $(this).attr("data-product-id"), sale_price_with_tax: $(this).val() };
            
            params.CustomerMeetingMutualProduct.collection.push(obj3);
        });
        return $.ajax2({    data : params,
                            url : "{url_to('app_mutual_ajax',['action'=>'SaveNewProductForMeeting'])}", 
                            errorTarget: ".meeting-mutual-products-Messages",                                  
                            success : function(response)
                                    {             
                                        $("#ViewMeetingMutualProduct-Ctn").text('');
                                        $("#CustomerMeetingMutualProductsContainer").html(response);
                                        $(".MutualPartner-ViewMeeting[name='mutual']").trigger('change');
                                    }
                        }); 
    });
    
    $("#AddCustomerMeetingMutualProduct-ViewMeeting").click(function() {
        var key=$.md5($.now().toString());
        var product = 0;
        $(".CustomerMeetingMutualProduct-Select-New[name='product_id'] option:selected").each(function() {
            product = $(this).val();
        });
        return $.ajax2({    data : { MutualProduct:  product, key: key},
                            url : "{url_to('app_mutual_ajax',['action'=>'AddProductForViewMeeting'])}", 
                            errorTarget: ".meeting-mutual-products-Messages",
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            success : function(response)
                                    {                                              
                                        if (response.error) { }
                                        else
                                        {
                                            if(!$("#ViewMeetingMutualProduct-Ctn").data("products")) {
                                                $("#ViewMeetingMutualProduct-Ctn").data("products",[]);
                                            }
                                            
                                            $("#ViewMeetingMutualProduct-Ctn").data("products").push(product);
                                            $("#ViewMeetingMutualProduct-Ctn").append(response);
                                            $(".CustomerMeetingMutualProduct-Select-New[name='product_id'] option[value='"+product+"']").remove();
                                            //teste sur le count(options) dans la select (MutualPartner) => $('element').length si ==0 => suprimer si non lissé
                                            $('.selectpicker.CustomerMeetingMutualProduct-Select-New').selectpicker('refresh');
                                            //alert($(".CustomerMeetingMutualProduct-NewMeeting[name='product_id'] option").length);
                                            if($(".CustomerMeetingMutualProduct-Select-New[name='product_id'] option").length==0)
                                            {
                                                $(".MutualPartner-ViewMeeting[name='mutual'] option:selected").remove();
                                                $(".selectpicker.MutualPartner-ViewMeeting[name='mutual']").selectpicker('refresh');
                                                $(".MutualPartner-ViewMeeting[name='mutual']").trigger('change');
                                            }
                                        }
                                    }
                        });
        
    });
</script>   

