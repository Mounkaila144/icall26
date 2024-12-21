{messages class="site-errors"}
<h3>{__("New product for mutual: %s.",$partner->get('name'))}</h3>
<div>
    <a href="#" id="MutualProduct-Save" class="btn" style="display:none"><i class="fa fa-floppy-o" style="margin-right: 10px;"></i>{__('Save')}</a>
    <a href="#" id="MutualProduct-Cancel" class="btn"><i class="fa fa-times" style="margin-right: 10px;"></i>{__('Cancel')}</a>
</div>

<table class="tab-form">
    <tr>
        <td class=""><span>{__("Name")}</span></td>
        <td>
            <div class="error-form">{$form.name->getError()}</div>               
            <input type="text" class="MutualProduct" name="name" size="64" value="{$item->get('name')}"/> 
            {if $form->name->getOption('required')}*{/if} 
        </td>
        <td class=""><span>{__("Price")}</span></td>
        <td>
            <div class="error-form">{$form.price->getError()}</div>               
            <input type="text" class="MutualProduct" name="price" value="{$item->getPriceI18n()}"/> 
            {if $form->price->getOption('required')}*{/if} 
        </td>
    </tr>
</table>

<script type="text/javascript">
      
    {* =================== F I E L D S ================================ *}
    $(".MutualProduct").click(function() {  $('#MutualProduct-Save').show(); });    
    
    {* =================== A C T I O N S ================================ *}
    $('#MutualProduct-Cancel').click(function(){                           
        return $.ajax2({ data : { MutualPartner : "{$item->getMutualPartner()->get('id')}" },                              
                        url : "{url_to('app_mutual_ajax',['action'=>'ListPartialMutualProduct'])}",
                        loading: "#tab-site-dashboard-x-settings-loading",     
                        errorTarget: ".site-errors",
                        target: "#actions" }); 
    });

    $('#MutualProduct-Save').click(function(){                             
        var  params= {  MutualPartner: "{$item->getMutualPartner()->get('id')}",      
                        MutualProduct: {                                  
                            token :'{$form->getCSRFToken()}'
                        } 
                    };                
        $("input.MutualProduct[type=text]").each(function() {  params.MutualProduct[$(this).attr('name')]=$(this).val();  });  // Get foreign key                  
        $("input.MutualProduct[type=radio]:checked").each(function() { params.MutualProduct[$(this).attr('name')]=$(this).val(); }); 
       
        return $.ajax2({ data : params,                    
                        url: "{url_to('app_mutual_ajax',['action'=>'NewMutualProduct'])}",
                        loading: "#tab-site-dashboard-x-settings-loading",  
                        errorTarget: ".site-errors",
                        target: "#actions" }); 
    });  
     
</script>