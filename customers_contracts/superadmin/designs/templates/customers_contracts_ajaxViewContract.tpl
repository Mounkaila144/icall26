{messages class="site-contract-errors-{$contract->get('id')}"}
 {if $contract->isLoaded()}              
    <div id="customer-contracts-tabs-{$contract->get('id')}">
         <ul>       
            <li class="tabs-sites">               
                <a href="#tab-customer-contracts-contract-{$contract->get('id')}">                
                     <span>{__('Contract')}</span>                    
                </a>                            
            </li>     
            <li class="tabs-sites">               
                <a href="#tab-customer-contracts-customer-{$contract->get('id')}">                
                     <span>{__('Customer')}</span>                    
                </a>                            
            </li>  
             <li class="tabs-sites">               
                <a href="#tab-customer-contracts-products-{$contract->get('id')}">                
                     <span>{__('Sold products')}</span>                    
                </a>                            
            </li>  
            {component name="/customers_contracts/tabs" contract=$contract key=$contract->get('id')} 
         </ul>      
        <div id="tab-customer-contracts-contract-{$contract->get('id')}">
            <div>{$contract->getCustomer()}</div>
            {include file="./includes/contract.tpl"}
            <div>  
                <a href="#" id="CustomerContract-Save-{$contract->get('id')}" style="display:none" class="btn">{__('Save')}</a>     
            </div>     
        </div>
        <div id="tab-customer-contracts-customer-{$contract->get('id')}">
             <div>{$contract->getCustomer()}</div>
            {component name="/customers/info" customer=$contract->getCustomer()}
        </div>
        <div id="tab-customer-contracts-products-{$contract->get('id')}">
            <div>{$contract->getCustomer()}</div>
            {include file="./includes/listProductByContract.tpl"}
        </div>
        {component name="/customers_contracts/tabsPanel" contract=$contract key=$contract->get('id')}
    </div>                 
{else}
    <span>{__('Contract is invalid.')}</span>
{/if}
<script type="text/javascript">
    
    {JqueryScriptsReady}
        
    {/JqueryScriptsReady}
        
    $(".CustomerContract.date").datepicker();
    
    $("#customer-contracts-tabs-{$contract->get('id')}").tabs( {* { 
                            ajaxOptions: { 
                                    type: "POST",
                                    data: {  Meeting: "{$meeting->get('id')}" },
                                    statusCode: {
                                            401: function() { $(".errors").messagesManager('error',$.ajax2Settings('getMessage','401')); },
                                            403: function() { document.location=window.location.pathname; }, // Redirection to Login 
                                            404: function() { $(".errors").messagesManager('error',$.ajax2Settings('getMessage','404').format(this.url)); }
                                        }
                                 } } *}
    );     
   
    $(".CustomerContract").click(function(){ 
            $("#CustomerContract-Save-{$contract->get('id')}").show();
    });
    
     $("#CustomerContract-Save-{$contract->get('id')}").click(function(){ 
            var params= { Contract: { 
                                        id:"{$contract->get('id')}",                                  
                                        token :'{$form->getCSRFToken()}'
                                    }
                        };
            $("input.CustomerContract[type=text]").each(function() { params.Contract[this.name]=$(this).val(); });
            $(".CustomerContract.options option:selected").each(function() { params.Contract[$(this).parent().attr('name')]=$(this).val(); });
           // alert("Params="+params.toSource()); return false;
            return $.ajax2({   data: params, 
                                url: "{url_to('customers_contracts_ajax',['action'=>'SaveContract'])}", 
                                errorTarget: ".site-meeting-errors-{$contract->get('id')}",
                                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-contract-loading",                          
                                target: "#tab-site-panel-{$site->getSiteID()}-dashboard-site-customers-contract-{$contract->get('id')}"
                                }); 
     });                   
</script>        