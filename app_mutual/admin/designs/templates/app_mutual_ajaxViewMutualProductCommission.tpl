{messages class="site-errors"}
<h3>{__("View commission for product: %s.",$item->getMutualProduct()->get('name'))}</h3>
<div>
    <a href="#" id="MutualProductCommission-Save" style="display:none" class="btn"><i class="fa fa-floppy-o" style="margin-right: 10px;"></i>{__('Save')}</a>
    <a href="#" id="MutualProductCommission-Cancel" class="btn"><i class="fa fa-times" style="margin-right: 10px;"></i>{__('Cancel')}</a>
</div>

<table class="tab-form">
    <tr>
        <td class="label"><span>{__("From")}</span></td>
        <td>
            <div class="error-form">{$form.from->getError()}</div>               
            <input type="text" class="MutualProductCommission" name="from" size="64" value="{$item->get('from')}"/> 
            {if $form->from->getOption('required')}*{/if} 
        </td>
    </tr>
    <tr>
        <td class="label"><span>{__("To")}</span></td>
        <td>
            <div class="error-form">{$form.to->getError()}</div>               
            <input type="text" class="MutualProductCommission" name="to" size="64" value="{$item->get('to')}"/> 
            {if $form->to->getOption('required')}*{/if} 
        </td>
    </tr>
    <tr>
        <td class="label"><span>{__("Rate")}</span></td>
        <td>
            <div class="error-form">{$form.rate->getError()}</div>               
            <input type="text" class="MutualProductCommission" name="rate" size="64" value="{$item->getRatePercent()}"/> 
            {if $form->rate->getOption('required')}*{/if} 
        </td>
    </tr>
    <tr>
        <td class="label"><span>{__("Started at")}</span></td>
        <td>
            <div class="error-form">{$form.started_at->getError()}</div>               
            <input type="text" class="MutualProductCommission datepicker" name="started_at" size="64" value="{$item->getStartedAt()}"/> 
            {if $form->started_at->getOption('required')}*{/if} 
        </td>
    </tr>
    <tr>
        <td class="label"><span>{__("Ended at")}</span></td>
        <td>
            <div class="error-form">{$form.ended_at->getError()}</div>               
            <input type="text" class="MutualProductCommission datepicker" name="ended_at" size="64" value="{$item->getEndedAt()}"/> 
            {if $form->ended_at->getOption('required')}*{/if} 
        </td>
    </tr>
</table>

<script type="text/javascript">
    
    {* =================== F I E L D S ================================ *}
    $('.datepicker').datepicker();
    $(".MutualProductCommission").click(function() {  $('#MutualProductCommission-Save').show(); });    
    
    {* =================== A C T I O N S ================================ *}
    $('#MutualProductCommission-Cancel').click(function(){                           
        return $.ajax2({ data : { MutualProduct : "{$item->getMutualProduct()->get('id')}" },                              
                        url : "{url_to('app_mutual_ajax',['action'=>'ListPartialMutualProductCommission'])}",
                        loading: "#tab-site-dashboard-x-settings-loading",        
                        errorTarget: ".site-errors",
                        target: "#actions" }); 
    });

    $('#MutualProductCommission-Save').click(function(){                             
        var  params= {  MutualProduct : "{$item->getMutualProduct()->get('id')}",      
                        MutualProductCommission: {   
                            id: {$item->get('id')},
                            token :'{$form->getCSRFToken()}'
                        } 
                    };                
        $("input.MutualProductCommission[type=text]").each(function() {  params.MutualProductCommission[$(this).attr('name')]=$(this).val();  });             
        $("input.MutualProductCommission[type=radio]:checked").each(function() { params.MutualProductCommission[$(this).attr('name')]=$(this).val(); }); 
        return $.ajax2({ data : params,                    
                        url: "{url_to('app_mutual_ajax',['action'=>'SaveMutualProductCommission'])}",
                        loading: "#tab-site-dashboard-x-settings-loading",       
                        errorTarget: ".site-errors",
                        target: "#actions" }); 
    });  
    
    
</script>