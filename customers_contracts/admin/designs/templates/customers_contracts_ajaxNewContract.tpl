{messages class="site-contract-errors-new"}
<div id="customer-contracts-tabs">
     <ul>       
        <li class="tabs-sites">               
            <a href="#tab-customer-contracts-contract-new">                
                 <span>{__('Contract')}</span>                    
            </a>                            
        </li>     
        <li class="tabs-sites">               
            <a href="#tab-customer-contracts-customer-new">                
                 <span>{__('Customer')}</span>                    
            </a>                            
        </li> 
         <li class="tabs-sites">               
            <a href="#tab-customer-contracts-attributions-new">                
                 <span>{__('Attributions')}</span>                    
            </a>                            
        </li>
        {* {component name="/customers_meetings/tabsNew"} *}
         <li class="tabs-sites">               
            <a href="#tab-customer-contracts-products-new">                
                 <span>{__('Sold products')}</span>                    
            </a>                            
        </li>  
     </ul>
     <div id="tab-customer-contracts-contract-new">
        {include file="./includes/new_contract.tpl"}
     </div>     
     <div id="tab-customer-contracts-customer-new">           
       {component name="/customers/newForNewContract"}
     </div>
     <div id="tab-customer-contracts-attributions-new">           
       {component name="/customers_contracts/attributionsForNewContract"}
     </div>
      <div id="tab-customer-contracts-products-new">           
        {component name="/customers_contracts/productsForNewContract"}
     </div>
</div>    
<div>   
    <a href="#" id="CustomerContract-New-Save" style="display:none" class="btn">{__('Save')}</a>     
</div>                 
<script type="text/javascript">
    
     $("#customer-contracts-tabs").tabs();         
     
     $(".CustomerContractForNewContract.date").datepicker();
      
     $(".CustomerContractForNewContract,.ProductsForNewContract,.CustomerAddressForNewContract,.CustomerForNewContract").click(function() { $("#CustomerContract-New-Save").show(); });
 
     $("#CustomerContract-New-Save").click(function(){ 
            var params= { CustomerContract: { 
                            contract: { },
                            customer: { },
                            address: { },     
                            attributions : { 
                                        team_id : $(".ContractContributorsNewContract[name=team_id]").val(),
                                        contributors : { } 
                            },
                            products : { count : $(".product-form").length,collection: { } },
                            token :'{$form->getCSRFToken()}'
            } };
            // Customer
            $("input.CustomerForNewContract[type=text]").each(function() { params.CustomerContract.customer[this.name]=$(this).val(); });
            $("input.CustomerForNewContract[type=radio]:checked").each(function() { params.CustomerContract.customer[this.name]=$(this).val(); }); 
            // Address
            $("input.CustomerAddressForNewContract[type=text]").each(function() { params.CustomerContract.address[this.name]=$(this).val(); });            
            // Contract
            $("input.CustomerContractForNewContract,select.CustomerContractForNewContract").each(function() { params.CustomerContract.contract[this.name]=$(this).val(); });
            $("input.CustomerContractForNewContract[type=checkbox]").each(function() {  params.CustomerContract.contract[this.name]=($(this).prop("checked")?"YES":"NO");  });                                 
            $(".product-form").each(function(idx) {               
                params.CustomerContract.products.collection[idx]={ 
                        product_id: $("select.ProductsForNewContract[id=id-"+idx+"] option:selected").val(),
                        details: $("input.ProductsForNewContract[id="+idx+"]").val()
                };                
            });
            // Attributions
            $(".ContractContributorsForNewContractList").each(function() {              
               contributor=$(this).attr('name');
               params.CustomerContract.attributions.contributors[contributor]={ };
               $(".ContractContributorsForNewContract-"+contributor+" option:selected").each(function() {                   
                   params.CustomerContract.attributions.contributors[contributor][$(this).parent().attr('name')]=$(this).val();
               });
       });
                      
        //    alert("Params="+params.toSource()); //return false;           
            
            return $.ajax2({   data: params, 
                                url: "{url_to('customers_contracts_ajax',['action'=>'NewContract'])}", 
                                errorTarget: ".site-contract-errors-new",
                                loading: "#tab-site-dashboard-customers-contract-loading",                          
                                target: "#tab-site-panel-dashboard-customers-contract-New"
                                }); 
         });
</script>    