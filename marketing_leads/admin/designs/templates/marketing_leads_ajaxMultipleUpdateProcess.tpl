{messages class="site-errors"}
<h3>{__("Multiple update")}</h3>
{if $form}
<div>    
    {format_number_choice('[0] no selected element|[1]one selected element|(1,Inf]%s selected elements',$form->getSelectionCount(),$form->getSelectionCount())} 
</div>
<fieldset>    
<table>
    <tr>
        <td>{__('Actions')}</td>
        <td>{__('Parameters')}</td>
    </tr>   
    <tr>
        <td> 
            <input type="checkbox" class="MarketingLeadsMultipleActions" name="state" value="" {if $form->hasAction('state')}checked=""{/if}/>
        </td>
        <td>
            {__('State')}
        </td>
        <td>
            <div class="error-form">{$form.state->getError()}</div> 
            {html_options class="MarketingLeadsMultiple" name="state" options=$form->state->getOption('choices') selected=(string)$form.state} 
        </td>
    </tr>
    
</table>
<a href="javascript:void(0);" id="MutipleMarketingLeadsProcess" class="btn">{__('Process')}</a>  
</fieldset>
<script type="text/javascript">
    
    $("#MutipleMarketingLeadsProcess").click(function() { 
        var params={ 
            MutipleMarketingLeadsSelection : {
                actions: [],                   
                selection : {$form->getSelection()->toJson()},
                count : '{$form->getSelection()->count()}',
                token :'{$form->getCSRFToken()}'
            }
        };
        $(".MarketingLeadsMultipleActions:checked").each(function() { params.MutipleMarketingLeadsSelection.actions.push($(this).attr('name')); }); 
        $("select.MarketingLeadsMultiple option:selected").each(function() { params.MutipleMarketingLeadsSelection[$(this).parent().attr('name')]=$(this).val(); });          
        $("input.MarketingLeadsMultiple").each(function() { params.MutipleMarketingLeadsSelection[$(this).attr('name')]=$(this).val(); });
        
        return $.ajax2({                   
                data : params,
                url: "{url_to('marketing_leads_ajax',['action'=>'MultipleProcessSelection'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-customers-contract-loading",
                target: "#tab-site-panel-dashboard-marketing-leads-Multiple"
            });
    });
</script>   
{/if}
