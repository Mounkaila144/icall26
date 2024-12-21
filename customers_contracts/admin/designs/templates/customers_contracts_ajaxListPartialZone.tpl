
{messages class="site-customers-contract-zone-errors"}
    <h3>{__('Contract zone')}</h3>    
    <div>   
      <a href="#" class="btn" id="CustomerContractZone-New" title="{__('New zone')}" >
           <i class="fa fa-plus" style="margin-right: 10px"></i>{__('New zone')}</a>            
    </div>
    {include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="CustomerContractZone"}
    <button class="btn-table" id="CustomerContractZone-filter">{__("Filter")}</button>   
    <button class="btn-table" id="CustomerContractZone-init">{__("Init")}</button> 
    <div class="containerDivResp">
    <table class="tabl-list" cellpadding="0" cellspacing="0">    
        <tr class="list-header">
            <th>#</th>       
            <th>
                <span>{__('Name')}</span>
            </th>  
            <th>
                <span>{__('PostCodes')}</span>
            </th>   
              <th>
                <span>{__('Max contracts by day')}</span>
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
                <input type="text" class="CustomerContractZone-search" name="name"   size="5" value="{$formFilter.search.name}"/>
            </td> 
            <td>{* date *}
                <input type="text" class="CustomerContractZone-search" name="postcodes"   size="5" value="{$formFilter.search.postcodes}"/>
            </td>  
            <td>
                
            </td>
            <td>{* date *}
                {html_options class=" CustomerContractZone-equal"  name="is_active" options=$formFilter->equal.is_active->getOption('choices') selected=(string)$formFilter.equal.is_active}
            </td>            
        </tr>
        {foreach $pager as $item}
            <tr class="CustomerContractZone-list list" id="CustomerContractZone-{$item->get('id')}"> 
                    <td class="CustomerContractZone-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>                       
                    <td>                
                       {$item->get('name')}
                    </td>                                  
                    <td>
                       {__($item->get('postcodes'))}
                    </td>
                      <td>
                       {$item->get('max_contracts')}
                    </td>
                    <td>
                        <a href="#" class="CustomerContractZone-status"  id="{$item->get('id')}"  name="{$item->get('is_active')}"><img src="{url('/icons/','picture')}{$item->get('is_active')}.gif" alt='{__("`$item->get("is_active")`")}' title='{__("`$item->get("is_active")`")}'/></a>
                    </td>
                    <td>

                         <a href="#" title="{__('Edit')}" class="CustomerContractZone-View" id="{$item->get('id')}">
                              <i class="fa fa-edit" style="margin-right: 10px;font-size:15px;"></i>
                         </a>                   
                           <a href="#" title="{__('Remove')}" class="CustomerContractZone-Remove" id="{$item->get('id')}" name="{$item->get('name')}" >
                                    <i class="fa fa-times" style="margin-right: 10px;font-size:15px;"></i>
                            </a>                            
                    </td>
            </tr>    
        {/foreach}  
    </table> 
    </div>
    {if !$pager->hasItems()}
         <span>{__('No zone')}</span>   
    {/if}
    {include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="CustomerContractZone"}

    <script type="text/javascript">


        function getCustomerContractZoneFilterParameters()
        {
            var params={   
                           filter: {  order : { }, 
                                    search : { },
                                    equal: {  },                                                                                                                                 
                                nbitemsbypage: $("[name=CustomerContractZone-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".CustomerContractZone-order_active").attr("name"))
                 params.filter.order[$(".CustomerContractZone-order_active").attr("name")] =$(".CustomerContractZone-order_active").attr("id");   
            $(".CustomerContractZone-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            {* ================ EQUAL ============================= *}
            $(".CustomerContractZone-equal option:selected").each(function() { params.filter.equal[$(this).parent().attr('name')] =$(this).val(); });           
            return params;                  
        }
        
        function updateCustomerContractZoneFilter()
        {          
           return $.ajax2({ data: getCustomerContractZoneFilterParameters(), 
                            url:"{url_to('customers_contracts_ajax',['action'=>'ListPartialZone'])}" , 
                            errorTarget: ".site-customers-contract-zone-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",                             
                            target: "#actions"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".CustomerContractZone-pager .CustomerContractZone-active").html()?parseInt($(".CustomerContractZone-pager .CustomerContractZone-active").html()):1;
           records_by_page=$("[name=CustomerContractZone-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".CustomerContractZone-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#CustomerContractZone-nb_results").html())-n;
           $("#CustomerContractZone-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#CustomerContractZone-end_result").html($(".CustomerContractZone-count:last").html());
        }
        
        {* =====================  P A G E R  A C T I O N S =============================== *}  
      
          $("#CustomerContractZone-init").click(function() {               
               $.ajax2({    
                            url:"{url_to('customers_contracts_ajax',['action'=>'ListPartialZone'])}",
                            errorTarget: ".site-customers-contract-zone-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",                             
                            target: "#actions"
                       }); 
           }); 
           
            $('.CustomerContractZone-order').click(function() {
                $(".CustomerContractZone-order_active").attr('class','CustomerContractZone-order');
                $(this).attr('class','CustomerContractZone-order_active');
                return updateCustomerContractZoneFilter();
           });
           
            $(".CustomerContractZone-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateCustomerContractZoneFilter();
            });
            
          $(".CustomerContractZone-equal[name=is_active]").change(function() { return updateCustomerContractZoneFilter(); }); 
             
          $("#CustomerContractZone-filter").click(function() { return updateCustomerContractZoneFilter(); }); 
          
          $("[name=CustomerContractZone-nbitemsbypage]").change(function() { return updateCustomerContractZoneFilter(); }); 
                  
           
           $(".CustomerContractZone-pager").click(function () {                       
                return $.ajax2({ data: getCustomerContractZoneFilterParameters(), 
                                 url:"{url_to('customers_contracts_ajax',['action'=>'ListPartialZone'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-customers-contract-zone-errors",
                                loading: "#tab-site-dashboard-x-settings-loading",                             
                                target: "#actions"
                });
        });
        
        
        {* =====================  A C T I O N S =============================== *}   

        $("#CustomerContractZone-New").click( function () {                     
                return $.ajax2({   
                    url: "{url_to('customers_contracts_ajax',['action'=>'NewZone'])}",
                    errorTarget: ".site-customers-contract-zone-errors",
                    loading: "#tab-site-dashboard-x-settings-loading",                             
                    target: "#actions"
               });  
        });
        
        $(".CustomerContractZone-View").click( function () {                     
                return $.ajax2({   
                    data : { CustomerContractZone: $(this).attr('id')  },
                    url: "{url_to('customers_contracts_ajax',['action'=>'ViewZone'])}",
                    errorTarget: ".site-customers-contract-zone-errors",
                    loading: "#tab-site-dashboard-x-settings-loading",                             
                    target: "#actions"
               });  
        });
      
   
       $(".CustomerContractZone-Remove").click( function () { 
                
                if (!confirm('{__("Zone \"#0#\" will be removed. Confirm ?")}'.format(this.name))) return false; 
                return $.ajax2({     
                    data : { CustomerContractZone: $(this).attr('id') },
                    url: "{url_to('customers_contracts_ajax',['action'=>'DeleteZone'])}",
                    errorTarget: ".site-customers-contract-zone-errors",
                    loading: "#tab-site-dashboard-x-settings-loading",   
                    success: function (resp)
                            {
                                 if (resp.action=='DeleteZone')
                                 {                                  
                                    $("#CustomerContractZone-"+resp.id).remove();    
                                    if ($(".CustomerContractZone-list").length==0)
                                    {
                                         $("#CustomerContractZone-list").after("{__("No zone")}")
                                    }  
                                 }    
                            }
               });
          
       });
       
         $('.CustomerContractZone-status').click(function(){    
                var params = { CustomerContractZone : { 
                                    value : $(this).attr('name'),
                                    id : $(this).attr('id'),
                                    token : '{mfForm::getToken('ChangeForm')}'
                             } };
                return $.ajax2({  
                   data: params,
                   url:"{url_to('customers_contracts_ajax',['action'=>'ChangeIsActiveZone'])}", 
                   errorTarget: ".site-customers-contract-zone-errors",
                   loading: "#tab-site-dashboard-x-settings-loading", 
                   success : function (resp){
                                if(resp.action=="ChangeIsActiveZone")
                                {
                                    $(".CustomerContractZone-status[id='"+resp.id+"'] img").attr({
                                        src :"{url('/icons/','picture')}"+resp.value+".gif",
                                        alt : (resp.value=='YES'?"{__('YES')}":"{__('NO')}"),
                                        title : (resp.value=='YES'?"{__('YES')}":"{__('NO')}")
                                    });
                                    $(".CustomerContractZone-status[id='"+resp.id+"']").attr("name",resp.value);
                                }
                            }
                });
        });
        
      
        
    </script>  
   

