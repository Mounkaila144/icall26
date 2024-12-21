{messages class="mutual-products-for-new-meeting-messages"}
<div id="">
    
    <select class="selectpicker MutualPartner-NewMeeting" name="mutual" data-live-search="true" {if $form->getEmbeddedForm('mutual')->getMutuals()->count()==1}style="display: none;"{/if}>
        {foreach $form->getEmbeddedForm('mutual')->getMutuals() as $mutual}
            <option data-tokens="{$mutual}" value="{$mutual->get('id')}">{$mutual}</option>
        {/foreach}
    </select>
    <span class="MutualPartner-NewMeeting" value="{if $form->getEmbeddedForm('mutual')->getMutuals()->getFirst()->get('id')}{$form->getEmbeddedForm('mutual')->getMutuals()->getFirst()->get('id')}{/if}" {if $form->getEmbeddedForm('mutual')->getMutuals()->count()>1}style="display: none;"{/if}>{$mutual}</span>
    
    <select class="selectpicker CustomerMeetingMutualProduct-NewMeeting" name="product_id" data-live-search="true" {if $form->getEmbeddedForm('mutual')->getMutuals()->getFirst()->getProducts()->count()==1}style="display: none;"{/if}>
        {foreach $form->getEmbeddedForm('mutual')->getMutuals()->getFirst()->getProducts() as $product}
            <option data-tokens="{$product}" value="{$product->get('id')}">{$product}</option>
        {/foreach}
    </select>
    <span class="MutualPartner-NewMeeting" value="{if $form->getEmbeddedForm('mutual')->getMutuals()->getFirst()->getProducts()->getFirst()}{$form->getEmbeddedForm('mutual')->getMutuals()->getFirst()->getProducts()->getFirst()->get('id')} {/if}" {if $form->getEmbeddedForm('mutual')->getMutuals()->getFirst()->getProducts()->count()>1}style="display: none;"{/if}>{$product}</span>
    <a id="AddCustomerMeetingMutualProduct-NewMeeting" href="javascript:void(0);" class="btn btn-default"><i class="fa fa-plus"></i></a>
</div>
<div id="NewMeetingMutualProduct-Ctn">
    
</div>

<script type="text/javascript">
    
    $('.selectpicker').selectpicker();
    $(".CustomerMeetingMutualProduct-NewMeeting").change(function() { $("#Save").show(); });
    
    $(".MutualPartner-NewMeeting[name='mutual']").change(function () {    
        
        if($(".MutualPartner-NewMeeting[name='mutual'] option").length==0)
            return;
        
        return $.ajax2({    data : { MutualPartner:  $(this).val()},
                            url : "{url_to('app_mutual_ajax',['action'=>'GetProductsForMutualForNewMeeting'])}", 
                            errorTarget: ".mutual-products-for-new-meeting-messages",
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            success : function(response)
                                    {                                              
                                        if (response.action=='GetProductsForMutualForNewMeeting')
                                        {        
                                            var products_exist = ($("#NewMeetingMutualProduct-Ctn").data("products"))?$("#NewMeetingMutualProduct-Ctn").data("products"):[];
                                            $(".CustomerMeetingMutualProduct-NewMeeting[name='product_id']").html(""); 
                                            var has_item = false;
                                            $.each(response.items, function(key,item){
                                                if(products_exist.indexOf(item.id)==-1 || products_exist.length==0)
                                                {
                                                    has_item = true;
                                                    var option = "<option data-tokens='"+item.name+"' value='"+item.id+"'>"+item.name+"</option>";
                                                    $(".CustomerMeetingMutualProduct-NewMeeting[name='product_id']").append(option); 
                                                }
                                            });
                                            
                                            if(!has_item)
                                            {
                                                $(".MutualPartner-NewMeeting[name='mutual'] option[value='"+response.mutual+"']").remove();
                                                $(".MutualPartner-NewMeeting[name='mutual']").selectpicker('refresh');
                                            }
                                            
                                            $('.selectpicker.CustomerMeetingMutualProduct-NewMeeting').selectpicker('refresh');
                                            
                                        }
                                    }
                        });
    });
    
    $("#AddCustomerMeetingMutualProduct-NewMeeting").click(function() {
        var key=$.md5($.now().toString());
        var product = 0;
        $(".CustomerMeetingMutualProduct-NewMeeting[name='product_id'] option:selected").each(function() {
            product = $(this).val();
        });
        return $.ajax2({    data : { MutualProduct:  product, key: key},
                            url : "{url_to('app_mutual_ajax',['action'=>'AddProductForNewMeeting'])}", 
                            errorTarget: ".mutual-products-for-new-meeting-messages",
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            success : function(response)
                                    {                                              
                                        if (response.error) { }
                                        else
                                        {
                                            if(!$("#NewMeetingMutualProduct-Ctn").data("products")) {
                                                $("#NewMeetingMutualProduct-Ctn").data("products",[]);
                                            }
                                            
                                            $("#NewMeetingMutualProduct-Ctn").data("products").push(product);
                                            $("#NewMeetingMutualProduct-Ctn").append(response);
                                            $(".CustomerMeetingMutualProduct-NewMeeting[name='product_id'] option[value='"+product+"']").remove();
                                            //teste sur le count(options) dans la select (MutualPartner) => $('element').length si ==0 => suprimer si non lissé
                                            $('.selectpicker.CustomerMeetingMutualProduct-NewMeeting').selectpicker('refresh');
                                            //alert($(".CustomerMeetingMutualProduct-NewMeeting[name='product_id'] option").length);
                                            if($(".CustomerMeetingMutualProduct-NewMeeting[name='product_id'] option").length==0)
                                            {
                                                $(".MutualPartner-NewMeeting[name='mutual'] option:selected").remove();
                                                $(".selectpicker.MutualPartner-NewMeeting[name='mutual']").selectpicker('refresh');
                                                $(".MutualPartner-NewMeeting[name='mutual']").trigger('change');
                                            }
                                        }
                                    }
                        });
        
    });
    
    $("#tab-customer-meetings-customer-meeting-app-mutual-new").on('new_meeting', function(event,params) {
        params.Meeting.mutual= { collection: [] };
        
        $(".AddProductMutualForNewMeeting").each(function () { 
            var obj1 = { product_id: $(this).attr("data-id"), sale_price_with_tax: $(".CustomerMeetingMutualProduct-NewMeeting[name='sale_price_with_tax'][data-product-id='"+$(this).attr("data-id")+"']").val() };
            
            params.Meeting.mutual.collection.push(obj1);  
        });
    });
   
</script>    