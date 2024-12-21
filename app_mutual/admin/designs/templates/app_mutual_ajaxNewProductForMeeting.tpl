{messages class="customer-meeting-mutual-product-messages-new"}
<div class="NewProduct col-md-8 editMycv"> {*panel panel-default*}
    <div class="col-md-6 editBlocksDiplomas  no_padding">
        <select class="selectpicker MutualPartner" name="mutual" data-live-search="true">
            {foreach $form->getMutuals() as $mutual}
                <option data-tokens="{$mutual}" value="{$mutual->get('id')}">{$mutual}</option>
            {/foreach}
        </select>
        <select class="selectpicker CustomerMeetingMutualProduct-New-{$key}" name="product_id" data-live-search="true">
            {foreach $form->getProductsForFirstMutual() as $product}
                <option data-tokens="{$product}" value="{$product->get('id')}" data-meeting="{$meeting->get('id')}">{$product}</option>
            {/foreach}
        </select>
    </div>
    <div class="actionsHeaderCv col-md-2">
       <a href="javascript:void(0);" class="SaveCustomerMeetingMutualProduct-New-{$key} btn btn-default"><i class="fa fa-save"></i></a>
       <a href="javascript:void(0);" class="DeleteCustomerMeetingMutualProduct-New-{$key} btn btn-default"><i class="fa fa-trash"></i></a>    
    </div> 
   <div style="clear: both"></div>
</div>             
<script type="text/javascript">
    
    $('.selectpicker').selectpicker();    
    
    $(".MutualPartner[name='mutual']").change(function () {       
        return $.ajax2({     data : { MutualPartner:  $(this).val(), Meeting: {$meeting->get('id')} },
                            url : "{url_to('app_mutual_ajax',['action'=>'GetProductsForMutual'])}", 
                            errorTarget: ".customer-meeting-mutual-product-messages-new",
                            success : function(response)
                                    {                                              
                                        if (response.action=='GetProductsForMutual')
                                        {                     
                                            $(".CustomerMeetingMutualProduct-New-{$key}[name='product_id']").html("");
                                            $.each(response.items, function(key,item){
                                                var option = "<option data-tokens='"+item.name+"' value='"+item.id+"'>"+item.name+"</option>";
                                                $(".CustomerMeetingMutualProduct-New-{$key}[name='product_id']").append(option); 
                                            });
                                            $('.selectpicker.CustomerMeetingMutualProduct-New-{$key}').selectpicker('refresh');
                                        }
                                    }
                        });
    });
    
    $(".DeleteCustomerMeetingMutualProduct-New-{$key}").click(function () { $("#NewCustomerMeetingMutualProduct-Ctn-{$key}").remove(); });
    
    $(".SaveCustomerMeetingMutualProduct-New-{$key}").click(function () {            
        var params = {  key: '{$key}',
                        CustomerMeetingMutualProduct: {
                            meeting_id : "{$meeting->get('id')}",            
                            token : '{$form->getCSRFToken()}'         
                        } 
                    };
        $(".CustomerMeetingMutualProduct-New-{$key} option:selected").each(function () { 
            params.CustomerMeetingMutualProduct[$(this).parent().attr("name")] = ($(this).val());  
        });     
        return $.ajax2({    data : params,
                            url : "{url_to('app_mutual_ajax',['action'=>'SaveNewProductForMeeting'])}", 
                            errorTarget: ".customer-meeting-mutual-product-messages-new",                                  
                            success : function(response)
                                    {             
                                        $("#NewCustomerMeetingMutualProduct-Ctn-{$key}").html(response);
                                    }
                        }); 
    });
    
</script>           
    