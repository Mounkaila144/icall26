
{messages class="site-customers-contract-company-errors"}
    <h3>{__('Contract companies')}</h3>    
    <div>   
      <a href="#" class="btn" id="CustomerContractCompany-New" title="{__('New company')}" >
           <i class="fa fa-plus" style="margin-right: 10px"></i>{__('New company')}</a>            
    </div>
    {include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="CustomerContractCompany"}
    <button class="btn-table" id="CustomerContractCompany-filter">{__("Filter")}</button>   
    <button class="btn-table" id="CustomerContractCompany-init">{__("Init")}</button> 
    <div class="containerDivResp">
    <table class="tabl-list" cellpadding="0" cellspacing="0">    
        <tr class="list-header">
            <th>#</th>       
            <th>
                <span>{__('Name')}</span>
            </th>  
            <th>
                <span>{__('Commercial Name')}</span>
            </th>   
              <th>
                <span>{__('Email')}</span>
            </th>    
            <th>
                <span>{__('Active')}</span>
            </th>                  
            <th>
                <span>{__('Actions')}</span>
            </th>                  
        </tr>
        <tr>
            <td>{* # *}
            </td>
            <td>{* date *}
                <input type="text" class="CustomerContractCompany-search" name="name"   size="5" value="{$formFilter.search.name}"/>
            </td> 
            <td>{* date *}
              
            </td>  
            <td>
                
            </td>
            <td>{* date *}
                {html_options class=" CustomerContractCompany-equal"  name="is_active" options=$formFilter->equal.is_active->getOption('choices') selected=(string)$formFilter.equal.is_active}
            </td>            
        </tr>
        {foreach $pager as $item}
            <tr class="CustomerContractCompany-list list" id="CustomerContractCompany-{$item->get('id')}"> 
                    <td class="CustomerContractCompany-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>                       
                    <td>                
                       {$item->get('name')}
                    </td>                                  
                    <td>
                       {__($item->get('postcodes'))}
                    </td>
                      <td>
                       {$item->get('email')}
                    </td>
                    <td>
                        <a href="#" class="CustomerContractCompany-status"  id="{$item->get('id')}"  name="{$item->get('is_active')}"><img src="{url('/icons/','picture')}{$item->get('is_active')}.gif" alt='{__("`$item->get("is_active")`")}' title='{__("`$item->get("is_active")`")}'/></a>
                    </td>
                    <td>

                         <a href="#" title="{__('Edit')}" class="CustomerContractCompany-View" id="{$item->get('id')}">
                              <i class="fa fa-edit" style="margin-right: 10px;font-size:15px;"></i>
                         </a>                   
                           <a href="#" title="{__('Remove')}" class="CustomerContractCompany-Remove" id="{$item->get('id')}" name="{$item->get('name')}" >
                                    <i class="fa fa-times" style="margin-right: 10px;font-size:15px;"></i>
                            </a>                            
                    </td>
            </tr>    
        {/foreach}  
    </table> 
    </div>
    {if !$pager->hasItems()}
         <span>{__('No company')}</span>   
    {/if}
    {include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="CustomerContractCompany"}

    <script type="text/javascript">


        function getCustomerContractCompanyFilterParameters()
        {
            var params={   
                           filter: {  order : { }, 
                                    search : { },
                                    equal: {  },                                                                                                                                 
                                nbitemsbypage: $("[name=CustomerContractCompany-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".CustomerContractCompany-order_active").attr("name"))
                 params.filter.order[$(".CustomerContractCompany-order_active").attr("name")] =$(".CustomerContractCompany-order_active").attr("id");   
            $(".CustomerContractCompany-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            {* ================ EQUAL ============================= *}
            $(".CustomerContractCompany-equal option:selected").each(function() { params.filter.equal[$(this).parent().attr('name')] =$(this).val(); });           
            return params;                  
        }
        
        function updateCustomerContractCompanyFilter()
        {          
           return $.ajax2({ data: getCustomerContractCompanyFilterParameters(), 
                            url:"{url_to('customers_contracts_ajax',['action'=>'ListPartialCompany'])}" , 
                            errorTarget: ".site-customers-contract-company-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",                             
                            target: "#actions"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".CustomerContractCompany-pager .CustomerContractCompany-active").html()?parseInt($(".CustomerContractCompany-pager .CustomerContractCompany-active").html()):1;
           records_by_page=$("[name=CustomerContractCompany-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".CustomerContractCompany-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#CustomerContractCompany-nb_results").html())-n;
           $("#CustomerContractCompany-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#CustomerContractCompany-end_result").html($(".CustomerContractCompany-count:last").html());
        }
        
        {* =====================  P A G E R  A C T I O N S =============================== *}  
      
          $("#CustomerContractCompany-init").click(function() {               
               $.ajax2({    
                            url:"{url_to('customers_contracts_ajax',['action'=>'ListPartialCompany'])}",
                            errorTarget: ".site-customers-contract-company-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",                             
                            target: "#actions"
                       }); 
           }); 
           
            $('.CustomerContractCompany-order').click(function() {
                $(".CustomerContractCompany-order_active").attr('class','CustomerContractCompany-order');
                $(this).attr('class','CustomerContractCompany-order_active');
                return updateCustomerContractCompanyFilter();
           });
           
            $(".CustomerContractCompany-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateCustomerContractCompanyFilter();
            });
            
          $(".CustomerContractCompany-equal[name=is_active]").change(function() { return updateCustomerContractCompanyFilter(); }); 
             
          $("#CustomerContractCompany-filter").click(function() { return updateCustomerContractCompanyFilter(); }); 
          
          $("[name=CustomerContractCompany-nbitemsbypage]").change(function() { return updateCustomerContractCompanyFilter(); }); 
                  
           
           $(".CustomerContractCompany-pager").click(function () {                       
                return $.ajax2({ data: getCustomerContractCompanyFilterParameters(), 
                                 url:"{url_to('customers_contracts_ajax',['action'=>'ListPartialCompany'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-customers-contract-company-errors",
                                loading: "#tab-site-dashboard-x-settings-loading",                             
                                target: "#actions"
                });
        });
        
        
        {* =====================  A C T I O N S =============================== *}   

        $("#CustomerContractCompany-New").click( function () {                     
                return $.ajax2({   
                    url: "{url_to('customers_contracts_ajax',['action'=>'NewCompany'])}",
                    errorTarget: ".site-customers-contract-company-errors",
                    loading: "#tab-site-dashboard-x-settings-loading",                             
                    target: "#actions"
               });  
        });
        
        $(".CustomerContractCompany-View").click( function () {                     
                return $.ajax2({   
                    data : { CustomerContractCompany: $(this).attr('id')  },
                    url: "{url_to('customers_contracts_ajax',['action'=>'ViewCompany'])}",
                    errorTarget: ".site-customers-contract-company-errors",
                    loading: "#tab-site-dashboard-x-settings-loading",                             
                    target: "#actions"
               });  
        });
      
   
       $(".CustomerContractCompany-Remove").click( function () { 
                
                if (!confirm('{__("Company \"#0#\" will be removed. Confirm ?")}'.format(this.name))) return false; 
                return $.ajax2({     
                    data : { CustomerContractCompany: $(this).attr('id') },
                    url: "{url_to('customers_contracts_ajax',['action'=>'DeleteCompany'])}",
                    errorTarget: ".site-customers-contract-company-errors",
                    loading: "#tab-site-dashboard-x-settings-loading",   
                    success: function (resp)
                            {
                                 if (resp.action=='DeleteCompany')
                                 {                                  
                                    $("#CustomerContractCompany-"+resp.id).remove();    
                                    if ($(".CustomerContractCompany-list").length==0)
                                    {
                                         $("#CustomerContractCompany-list").after("{__("No company")}")
                                    }  
                                 }    
                            }
               });
          
       });
       
         $('.CustomerContractCompany-status').click(function(){    
                var params = { CustomerContractCompany : { 
                                    value : $(this).attr('name'),
                                    id : $(this).attr('id'),
                                    token : '{mfForm::getToken('ChangeForm')}'
                             } };
                return $.ajax2({  
                   data: params,
                   url:"{url_to('customers_contracts_ajax',['action'=>'ChangeIsActiveCompany'])}", 
                   errorTarget: ".site-customers-contract-company-errors",
                   loading: "#tab-site-dashboard-x-settings-loading", 
                   success : function (resp){
                                if(resp.action=="ChangeIsActiveCompany")
                                {
                                    $(".CustomerContractCompany-status[id='"+resp.id+"'] img").attr({
                                        src :"{url('/icons/','picture')}"+resp.value+".gif",
                                        alt : (resp.value=='YES'?"{__('YES')}":"{__('NO')}"),
                                        title : (resp.value=='YES'?"{__('YES')}":"{__('NO')}")
                                    });
                                    $(".CustomerContractCompany-status[id='"+resp.id+"']").attr("name",resp.value);
                                }
                            }
                });
        });
        
      
        
    </script>  
   

