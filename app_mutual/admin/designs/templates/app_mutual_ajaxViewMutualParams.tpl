{messages class="MutualPartner-errors"}
<h3>{__("View params for mutual: %s.",$item->getMutualPartner()->get('name'))}</h3>
<div>
    <a href="#" id="MutualPartnerParams-Save" class="btn" style="display:none"><i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="#" id="MutualPartnerParams-Cancel" class="btn"><i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>

<table class="tab-form">
    <tr>
        <td class="label">{__("Taxe")}</td>
        <td> 
            <div class="error-form">{$form.taxe->getError()}</div>       
            <input type="text" class="MutualPartnerParams" name="taxe" size="64" value="{if $form->hasErrors()}{$item->get('taxe')}{else}{$item->getTaxePercent()}{/if}"/> 
           {if $form->taxe->getOption('required')}*{/if}
        </td>
    </tr>
    <tr>
        <td class="label"><span>{__("Fees")}</span></td>
        <td>
            <div class="error-form">{$form.fees->getError()}</div>               
            <input type="text" class="MutualPartnerParams" name="fees" size="64" value="{$item->getFeesI18n()}"/> 
            {if $form->fees->getOption('required')}*{/if} 
        </td>
    </tr> 
    <tr>
        <td class="label"><span>{__("Started at")}</span></td>
        <td>
            <div class="error-form">{$form.started_at->getError()}</div>               
            <input type="text" class="MutualPartnerParams datepicker" name="started_at" size="64" value="{$item->getStartedAt()}"/> 
            {if $form->started_at->getOption('required')}*{/if} 
        </td>
    </tr> 
    <tr>
        <td class="label" >{__("Ended at")}</td>
        <td> 
            <div class="error-form">{$form.ended_at->getError()}</div> 
            <input type="text" class="MutualPartnerParams datepicker" name="ended_at" size="64" value="{$item->getEndedAt()|escape}" size="30"/>
            {if $form->ended_at->getOption('required')}*{/if} 
        </td>             
    </tr>  
</table>

<script type="text/javascript">
    
     {* =================== F I E L D S ================================ *}
    $('.datepicker').datepicker();
    $(".MutualPartnerParams").click(function() {  $('#MutualPartnerParams-Save').show(); });       
    
     {* =================== A C T I O N S ================================ *}
    $('#MutualPartnerParams-Cancel').click(function(){                           
        return $.ajax2({ data : { MutualPartner : "{$item->getMutualPartner()->get('id')}" },                              
                        url : "{url_to('app_mutual_ajax',['action'=>'ListPartialMutualPartner'])}",
                        errorTarget: ".MutualPartner-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",                         
                        target: "#actions" }); 
    });
      
    $('#MutualPartnerParams-Save').click(function(){                             
        var  params= {            
                        MutualPartner: {$mutual->get('id')},
                        MutualPartnerParams: {  
                            financial_partner_id: {$mutual->get('id')},
                            country : $(".MutualPartnerParams[name=country] option:selected").val() ,                                   
                            token :'{$form->getCSRFToken()}'
                        } };                
        $("input.MutualPartnerParams[type=text]").each(function() {  params.MutualPartnerParams[this.name]=$(this).val();  });
        return $.ajax2({ data : params,                            
                        errorTarget: ".MutualPartner-errors",
                        url: "{url_to('app_mutual_ajax',['action'=>'SaveMutualParams'])}",
                        target: "#actions" }); 
    });  
     
</script>