{messages class="site-errors"}
<h3>{__("View decommission for produit: %s.",$item->getMutualProduct()->get('name'))}</h3>
<div>
    <a href="#" id="MutualDecommission-Save" style="display:none" class="btn"><i class="fa fa-floppy-o" style="margin-right: 10px;"></i>{__('Save')}</a>
    <a href="#" id="MutualDecommission-Cancel" class="btn"><i class="fa fa-times" style="margin-right: 10px;"></i>{__('Cancel')}</a>
</div>

<table class="tab-form">
    <tr>
        <td class="label"><span>{__("From")}</span></td>
        <td>
            <div class="error-form">{$form.from->getError()}</div>               
            <input type="text" class="MutualDecommission" name="from" size="64" value="{$item->get('from')}"/> 
            {if $form->from->getOption('required')}*{/if} 
        </td>
    </tr>
    <tr>
        <td class="label"><span>{__("To")}</span></td>
        <td>
            <div class="error-form">{$form.to->getError()}</div>               
            <input type="text" class="MutualDecommission" name="to" size="64" value="{$item->get('to')}"/> 
            {if $form->to->getOption('required')}*{/if} 
        </td>
    </tr>
    <tr>
        <td class="label"><span>{__("Rate")}</span></td>
        <td>
            <div class="error-form">{$form.rate->getError()}</div>               
            <input type="text" class="MutualDecommission" name="rate" size="64" value="{$item->getRatePercent()}"/> 
            {if $form->rate->getOption('required')}*{/if} 
        </td>
    </tr>
    <tr>
        <td class="label"><span>{__("Fix")}</span></td>
        <td>
            <div class="error-form">{$form.fix->getError()}</div>               
            <input type="text" class="MutualDecommission" name="fix" size="64" value="{$item->get('fix')}"/> 
            {if $form->fix->getOption('required')}*{/if} 
        </td>
    </tr>
    <tr>
        <td class="label"><span>{__("Started at")}</span></td>
        <td>
            <div class="error-form">{$form.started_at->getError()}</div>               
            <input type="text" class="MutualDecommission datepicker" name="started_at" size="64" value="{$item->getStartedAt()}"/> 
            {if $form->started_at->getOption('required')}*{/if} 
        </td>
    </tr>
    <tr>
        <td class="label"><span>{__("Ended at")}</span></td>
        <td>
            <div class="error-form">{$form.ended_at->getError()}</div>               
            <input type="text" class="MutualDecommission datepicker" name="ended_at" size="64" value="{$item->getEndedAt()}"/> 
            {if $form->ended_at->getOption('required')}*{/if} 
        </td>
    </tr> 
</table>

<script type="text/javascript">
    
    {* =================== F I E L D S ================================ *}
    $('.datepicker').datepicker();
    $(".MutualDecommission").click(function() {  $('#MutualDecommission-Save').show(); });    
    
    {* =================== A C T I O N S ================================ *}
    $('#MutualDecommission-Cancel').click(function(){                           
        return $.ajax2({ data : { MutualProduct : "{$item->getMutualProduct()->get('id')}" },                              
                        url : "{url_to('app_mutual_ajax',['action'=>'ListPartialMutualProductDecommission'])}",
                        loading: "#tab-site-dashboard-x-settings-loading",     
                        errorTarget: ".site-errors",
                        target: "#actions" }); 
    });
    
    $('#MutualDecommission-Save').click(function(){                             
        var  params= {  MutualProduct : "{$item->getMutualProduct()->get('id')}",      
                        MutualProductDecommission: { 
                            id: {$item->get('id')},
                            token :'{$form->getCSRFToken()}'
                        } 
                    };                
        $("input.MutualDecommission[type=text]").each(function() {  params.MutualProductDecommission[$(this).attr('name')]=$(this).val();  });             
        $("input.MutualDecommission[type=radio]:checked").each(function() { params.MutualProductDecommission[$(this).attr('name')]=$(this).val(); }); 
        
        return $.ajax2({ data : params,                    
                        url: "{url_to('app_mutual_ajax',['action'=>'SaveMutualProductDecommission'])}",
                        loading: "#tab-site-dashboard-x-settings-loading",             
                        errorTarget: ".site-errors",
                        target: "#actions" }); 
    });  
     
    
</script>