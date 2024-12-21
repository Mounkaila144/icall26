{messages class="ContractAttributions-errors"}
<div>
    <a href="#" class="btn" id="ContractAttributions-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" class="btn" id="ContractAttributions-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>   
</div>
<table>    
    <tr>
        <td>{__('Team')}
        </td>
        <td>
          {html_options name="team_id" class="ContractAttributions" options=$form->team_id->getOption('choices') selected=$contract->get('team_id')}
        </td>
       
    </tr>
        {foreach $contract->getContributors() as $contributor}
            <tr class="ContractContributors" name="{$contributor->get('type')}" id="{$contributor->get('id')}">
                <td>{__($contributor->get('type'))}</td>
                <td>
                    {html_options name="user_id" class="ContractContributors ContractContributor-`$contributor->get('type')`" options=$form->contributors[$contributor->get('type')]['user_id']->getOption('choices') selected=$contributor->get('user_id')}
              {*  </td>
                <td> *}
                    {html_options name="attribution_id" class="ContractContributors ContractContributor-`$contributor->get('type')`" options=$form->contributors[$contributor->get('type')]['attribution_id']->getOption('choices') selected=$contributor->get('attribution_id')}
                </td>        
            </tr>    
        {/foreach} 
</table>    
    
<script type="text/javascript">
    
    $(".ContractAttributions,.ContractContributors").change(function(){ $("#ContractAttributions-Save").show(); });

    $("#ContractAttributions-Cancel").click(function(){            
       return $.ajax2({                    
                data : { Contract: "{$contract->get('id')}" },
                url: "{url_to('customers_contracts_ajax',['action'=>'ListAttributions'])}",
                errorTarget: ".ContractAttributions-errors",
                loading: "#tab-site-dashboard-site-customers-contract-loading",                          
                target: "#tab-customer-contracts-attributions-{$contract->get('id')}"
           });      
    });
    
    $("#ContractAttributions-Save").click(function(){
       var params = { 
                    Contract: "{$contract->get('id')}",
                    Attributions: { 
                            team_id : $(".ContractAttributions[name=team_id]").val(),
                            contributors : { },
                            token: "{$form->getCSRFToken()}"
                        }
       };
       
       $(".ContractContributors").each(function() {              
               contributor=$(this).attr('name');
               params.Attributions.contributors[contributor]={ };
               $(".ContractContributor-"+contributor+" option:selected").each(function() {                   
                   params.Attributions.contributors[contributor][$(this).parent().attr('name')]=$(this).val();
               });
       });
       
     //  alert("Params="+params.toSource()); return false;     
       
       return $.ajax2({                    
                data : params,
                url: "{url_to('customers_contracts_ajax',['action'=>'SaveAttributions'])}",
                errorTarget: ".ContractAttributions-errors",
                loading: "#tab-site-dashboard-site-customers-contract-loading",                          
                target: "#tab-customer-contracts-attributions-{$contract->get('id')}"
           });  // tab-customer-contracts-attributions
    
    });
</script>     