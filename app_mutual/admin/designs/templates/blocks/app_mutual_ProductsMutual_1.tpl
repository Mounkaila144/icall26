{messages class="meeting-mutual-products-Messages"}
<div id="CustomerMeetingMutual-Ctn" class="widget-content-Mutual">
    <div id="CustomerMeetingMutualProductNewCtn">
        {if !$form->getMutuals()->isEmpty()}
        <div class="NewProduct col-md-10 editMycv"> {*panel panel-default*}
            <div class="col-md-8 editBlocksDiplomas  no_padding">
                <select class="selectpicker MutualPartner" name="mutual" data-live-search="true">
                    {foreach $form->getMutuals() as $mutual}
                        <option data-tokens="{$mutual}" value="{$mutual->get('id')}">{$mutual}</option>
                    {/foreach}
                </select>
                <select class="selectpicker CustomerMeetingMutualProduct-Select-New" name="product_id" data-live-search="true">
                    {foreach $form->getMutuals()->getFirst()->getProducts() as $product}
                        <option data-tokens="{$product}" value="{$product->get('id')}" data-meeting="{$meeting->get('id')}">{$product}</option>
                    {/foreach}
                </select>
                {*<span>{__("Sale price with tax")}</span>
                <input type="text" class="CustomerMeetingMutualProduct-New" name="sale_price_with_tax"/>*}
            </div>
            <div class="actionsHeaderCv col-md-2">
               <a href="javascript:void(0);" class="SaveCustomerMeetingMutualProduct-New btn btn-default"><i class="fa fa-save"></i></a>
            </div> 
           <div style="clear: both"></div>
        </div>
        {else}
            {__('No mutuals')}
        {/if}
    </div>
    <div id="CustomerMeetingMutualProductsContainer">
        {foreach $form->getSelectedMutuals() as $mutual}
            <div id="{$mutual->get('id')}" class="CustomerMeetingMutualProductsList no_padding" >
                <div class="col-md-9" >
                    {foreach $mutual->getSelection() as $meeting_product}
                        <div class="CustomerMeetingMutualProductCmp col-md-4" data-id="{$meeting_product->get('id')}">
                            <span>{$mutual}</span>
                            <span id="{$meeting_product->get('id')}">{$meeting_product->getProduct()}</span>
                            <span>{$meeting_product->getSalePriceWithTaxI18n()}</span>
                            <a id="{$meeting_product->get('id')}" href="javascript:void(0);" class="DeleteCustomerMeetingMutualProduct btn btn-default"><i class="fa fa-trash"></i><span style="display: none" class="bullInfo">{__('Delete Meeting Product')}</span></a>    
                        </div>
                    {/foreach}
                </div>
                <div style="clear: both"></div>
            </div>  
        {/foreach}
    </div>
</div>

<script type="text/javascript">
    $('.selectpicker').selectpicker();
    
    $(".DeleteCustomerMeetingMutualProduct").click(function () {       
        return $.ajax2({ data : { CustomerMeetingMutualProduct:  $(this).attr('id'),Meeting: {$meeting->get('id')} },
                        url : "{url_to('app_mutual_ajax',['action'=>'DeleteMutualProductForMeeting'])}", 
                        errorTarget: ".meeting-mutual-products-Messages",
                        success : function(response)
                                {                                              
                                    if (response.action=='DeleteCustomerMeetingMutualProduct')
                                    {       
                                        $(".CustomerMeetingMutualProductCmp[data-id="+response.id+"]").remove(); 
                                        $(".MutualPartner[name='mutual']").trigger('change');
                                    }
                                    
                                }
                        });
    });
    
    {* ================================ NEW ACTIONS =========================== *}
    
    $(".MutualPartner[name='mutual']").change(function () {       
        return $.ajax2({     data : { MutualPartner:  $(this).val(), Meeting: {$meeting->get('id')} },
                            url : "{url_to('app_mutual_ajax',['action'=>'GetProductsForMutual'])}", 
                            errorTarget: ".meeting-mutual-products-Messages",
                            success : function(response)
                                    {                                              
                                        if (response.action=='GetProductsForMutual')
                                        {                     
                                            $(".CustomerMeetingMutualProduct-Select-New[name='product_id']").html("");
                                            $.each(response.items, function(key,item){
                                                var option = "<option data-tokens='"+item.name+"' value='"+item.id+"'>"+item.name+"</option>";
                                                $(".CustomerMeetingMutualProduct-Select-New[name='product_id']").append(option); 
                                            });
                                            if(Object.keys(response.items).length==0)
                                                $(".MutualPartner[name='mutual'] option[value='"+response.mutual+"']")
                                            $('.selectpicker.CustomerMeetingMutualProduct-Select-New').selectpicker('refresh');
                                            $(".selectpicker.MutualPartner[name='mutual']").selectpicker('refresh');
                                        }
                                    }
                        });
    });
    
    $(".SaveCustomerMeetingMutualProduct-New").click(function () {            
        var params = {  Meeting: {$meeting->get('id')},
                        CustomerMeetingMutualProduct: {                                    
                            token : '{$form->getCSRFToken()}'         
                        } 
                    };
        $(".CustomerMeetingMutualProduct-Select-New option:selected").each(function () { 
            params.CustomerMeetingMutualProduct[$(this).parent().attr("name")] = ($(this).val());  
        });     
        $(".CustomerMeetingMutualProduct-New").each(function () { 
            params.CustomerMeetingMutualProduct[$(this).attr("name")] = ($(this).val());  
        });     
        return $.ajax2({    data : params,
                            url : "{url_to('app_mutual_ajax',['action'=>'SaveNewProductForMeeting'])}", 
                            errorTarget: ".meeting-mutual-products-Messages",                                  
                            success : function(response)
                                    {             
                                        $("#CustomerMeetingMutualProductsContainer").append(response);
                                        $(".MutualPartner[name='mutual']").trigger('change');
                                    }
                        }); 
    });
    
</script>   

