{messages class="dialog-customers-contract-site-errors"}
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="Dialog-CustomerContracts"}
<button id="Dialog-CustomerContracts-filter" class="btn-table">{__("Filter")}</button>   
<button class="btn-table" id="Dialog-CustomerContracts-init">{__("Init")}</button>
<table id="Dialog-CustomerContracts-List" class="tabl-list" cellpadding="0" cellspacing="0">   
  <tr class="list-header">
    <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}                             
        <th>
            <span>{__('date')|capitalize}</span>  
            <div>
                <a href="#" class="Dialog-CustomerContracts-order{$formFilter.order.opened_at->getValueExist('asc','_active')}" id="asc" name="opened_at"><img  src='{url("/icons/sort_asc`$formFilter.order.opened_at->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="Dialog-CustomerContracts-order{$formFilter.order.opened_at->getValueExist('desc','_active')}" id="desc" name="opened_at"><img  src='{url("/icons/sort_desc`$formFilter.order.opened_at->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th> 
         <th>
            <span>{__('customer')|capitalize}</span> 
              <div>
                <a href="#" class="Dialog-CustomerContracts-order{$formFilter.order.lastname->getValueExist('asc','_active')}" id="asc" name="lastname"><img  src='{url("/icons/sort_asc`$formFilter.order.lastname->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="Dialog-CustomerContracts-order{$formFilter.order.lastname->getValueExist('desc','_active')}" id="desc" name="lastname"><img  src='{url("/icons/sort_desc`$formFilter.order.lastname->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th> 
         <th>
            <span>{__('phone')|capitalize}</span>  
              <div>
                <a href="#" class="Dialog-CustomerContracts-order{$formFilter.order.phone->getValueExist('asc','_active')}" id="asc" name="phone"><img  src='{url("/icons/sort_asc`$formFilter.order.phone->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="Dialog-CustomerContracts-order{$formFilter.order.phone->getValueExist('desc','_active')}" id="desc" name="phone"><img  src='{url("/icons/sort_desc`$formFilter.order.phone->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>            
        <th>
            <span>{__('postcode')|capitalize}</span>   
              <div>
                <a href="#" class="Dialog-CustomerContracts-order{$formFilter.order.postcode->getValueExist('asc','_active')}" id="asc" name="postcode"><img  src='{url("/icons/sort_asc`$formFilter.order.postcode->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="Dialog-CustomerContracts-order{$formFilter.order.postcode->getValueExist('desc','_active')}" id="desc" name="postcode"><img  src='{url("/icons/sort_desc`$formFilter.order.postcode->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>                
        <th>
            <span>{__('city')|capitalize}</span>   
              <div>
                <a href="#" class="Dialog-CustomerContracts-order{$formFilter.order.city->getValueExist('asc','_active')}" id="asc" name="city"><img  src='{url("/icons/sort_asc`$formFilter.order.city->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="Dialog-CustomerContracts-order{$formFilter.order.city->getValueExist('desc','_active')}" id="desc" name="city"><img  src='{url("/icons/sort_desc`$formFilter.order.city->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>       
        <th>{* commercial1 *}       
            <span>{__('commercial 1')|capitalize}</span>    
        </th>
        <th>{* commercial2 *}       
            <span>{__('commercial 2')|capitalize}</span>    
        </th>
        <th>{* telepro *}
           <span>{__('telepro')|capitalize}</span>        
        </th>
        <th>{* status *}
            <span>{__('State')}</span>         
        </th>      
   </tr>   
   <tr class="input-list">
       <td>{* # *}</td>
         {if $pager->getNbItems()>5}<td>&nbsp;</tdh>{/if}      
       <td>{* date *}       
        <div>
               {__('from')}
                <input class="Dialog-CustomerContracts range" id="opened_at_from" type="text" size="10" name="opened_at[from]" value="{format_date((string)$formFilter.range.opened_at.from,'a')}"/>
            </div>
            <div>
               {__('to')}
                <input  class="Dialog-CustomerContracts range" id="opened_at_to" type="text" size="10" name="opened_at[to]" value="{format_date((string)$formFilter.range.opened_at.to,'a')}"/>
            </div>                  
       </td>
       <td>{* customer *}
            <input class="Dialog-CustomerContracts-search" type="text" size="10" name="lastname" value="{$formFilter.search.lastname}"> 
       </td>            
       <td>{* phone *}
            <input class="Dialog-CustomerContracts-search" type="text" size="13" name="phone" value="{$formFilter.search.phone}"> 
       </td>
       <td>{* postcode *}
           <input class="Dialog-CustomerContracts-begin" type="text" size="5" name="postcode" value="{$formFilter.begin.postcode}"> 
       </td>
       <td>{* city *}
           <input class="Dialog-CustomerContracts-search" type="text" size="8"   name="city" value="{$formFilter.search.city}">            
       </td>
       <td>{* commercial1 *}
            {html_options class="Dialog-CustomerContracts-equal" style="width: 100px" name="sale_1_id" options=$formFilter->equal.sale_1_id->getOption('choices') selected=(string)$formFilter.equal.sale_1_id}
       </td>
       <td>{* commercial2 *}
            {html_options class="Dialog-CustomerContracts-equal" style="width: 100px" name="sale_2_id" options=$formFilter->equal.sale_2_id->getOption('choices') selected=(string)$formFilter.equal.sale_2_id}
       </td>
       <td>{* telepro *}
           {if count($formFilter->equal.telepro_id->getOption('choices')) > 1}
           {html_options class="Dialog-CustomerContracts-equal" style="width: 100px" name="telepro_id" options=$formFilter->equal.telepro_id->getOption('choices') selected=(string)$formFilter.equal.telepro_id}
           {else}
               ---
           {/if}
       </td>   
        <td>{* status *}
            {html_options class="Dialog-CustomerContracts-equal" name="state_id" options=$formFilter->equal.state_id->getOption('choices') selected=(string)$formFilter.equal.state_id}
       </td>
    </tr>       
     {foreach $pager as $item}         
    <tr class="Dialog-CustomerContracts list{if (string)$formFilter.selected==$item->get('id')} selected{/if}" id="{$item->get('id')}" name="{$item->getCustomer()}"> 
         <td class="Dialog-CustomerContracts-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            {if $pager->getNbItems()>5}
                <td>        
                    {if $item->hasCustomerContractStatusI18n()}
                    <input class="Dialog-CustomerContractsStatus-selection" type="checkbox" id="{$item->getCustomerContractStatusI18n()->get('id')}" name="{$item->getCustomerContractStatusI18n()->get('name')}"/>   
                    {/if}
                </td>
            {/if} 
         </td>          
         <td>{* date *}                             
               <div>
               {format_date($item->get('opened_at'),'p')}
               </div>
          </td> 
          <td>{* customer *} 
               {$item->getCustomer()->getLastname()} {$item->getCustomer()->getFirstname()}
          </td>                     
           <td>{* phone *}
                <div>{$item->getCustomer()->getFormattedPhone()}</div>
                 <div>{$item->getCustomer()->getFormattedMobile()}</div>
            </td>           
            <td>{* postcode *}
                 {$item->getCustomer()->getAddress()->get('postcode')}  
            </td>           
            <td>{* city *}
                 {$item->getCustomer()->getAddress()->get('city')}   
            </td>             
            <td>{* commercial1 *}
                {if $item->hasSale1()}
                    {$item->getSale1()->getName(false)}                      
                 {/if}
            </td>
            <td>{* commercial2 *}
                {if $item->hasSale2()}
                    {$item->getSale2()->getName(false)}                    
                {/if}
            </td>
             <td>{if $item->hasTelepro()}
                     {$item->getTelepro()->getName(false)}
                {/if}
            </td>
            <td>{* status *}               
                {if $item->hasStatus()}
                    {if $item->getStatus()->get('icon')} 
                       <img src="{$item->getStatus()->getIcon()->getURL()}" height="32" width="32" alt="{__('icon')}"/> 
                    {elseif $item->getStatus()->get('color')}
                    <div class="color" style="background:{$item->getStatus()->get('color')}; display:block; height:15px; width: 15px;">&nbsp;</div>                
                    {/if}&nbsp;               
                    {$item->getStatus()->getCustomerContractStatusI18n()->get('value')}
                {else}
                    {__('---')}
                {/if}
            </td>                         
    </tr>
    {/foreach}
</table>    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="Dialog-CustomerContracts"}


<script type="text/javascript">
    
     $("#dialogListFilterContracts").data('pager',[{foreach $pager as $item} { opened_at: "{format_date($item->get('opened_at'),'p')}" ,customer: "{$item->getCustomer()->getLastname()} {$item->getCustomer()->getFirstname()}" }, {/foreach}]);   
        
     $("#dialogListFilterContracts").data('selected',"{(string)$formFilter.selected}");  
        
        
    function getDialogContractsFilterParameters()
        {
                         
           var params={ filter: {  order : { }, 
                                     range: $(".Dialog-CustomerContracts.range").getFilter(),                                      
                                     equal : { },
                                     begin : { },
                                     search: {  },                                                                     
                                     nbitemsbypage: $("[name=Dialog-CustomerContracts-nbitemsbypage]").val(),
                                     token:'{$formFilter->getCSRFToken()}'
                                  }};
            {* ================ ORDER ============================= *}
            if ($(".Dialog-CustomerContracts-order_active").attr("name"))
                    params.filter.order[$(".Dialog-CustomerContracts-order_active").attr("name")] =$(".Dialog-CustomerContracts-order_active").attr("id");
            {* ================ SEARCH ============================= *}
            $(".Dialog-CustomerContracts-search").each(function() { params.filter.search[this.name] =this.value; });   
            {* ================ BEGIN ============================= *}
            $(".Dialog-CustomerContracts-begin").each(function() { params.filter.begin[this.name] =this.value; });              
            {* ================ EQUAL ============================= *}
            $(".Dialog-CustomerContracts-equal option:selected").each(function() { params.filter.equal[$(this).parent().attr('name')] =$(this).val(); });           
        //    alert("params="+params.toSource());
            return params;                  
        }
        
        function updateDialogContractsFilter()
        {
           return $.ajax2({ data: getDialogContractsFilterParameters(), 
                            url:"{url_to('customers_contracts_ajax',['action'=>'DialogListFilterContracts'])}" , 
                            errorTarget: ".dialog-customers-contract-site-errors",
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            target: "#dialogListFilterContracts" });
        }
        
         function updateSiteDialogPager(n)
        {
           page_active=$(".Dialog-CustomerContracts-pager .Dialog-CustomerContracts-active").html()?parseInt($(".Dialog-CustomerContracts-pager .Dialog-CustomerContracts-active").html()):1;
           records_by_page=$("[name=CustomerContracts-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".Dialog-CustomerContracts-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#CustomerContracts-nb_results").html())-n;
           $("#Dialog-CustomerContracts-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#Dialog-CustomerContracts-end_result").html($(".Dialog-CustomerContracts-count:last").html());
        }
        
        $('.Dialog-CustomerContracts-order').click(function() {
            $(".Dialog-CustomerContracts-order_active").attr('class','Dialog-CustomerContracts-order');
            $(this).attr('class','Dialog-CustomerContracts-order_active');
            return updateDialogContractsFilter();
        });

        $(".Dialog-CustomerContracts-search,.Dialog-CustomerContracts-begin").keypress(function(event) {
            if (event.keyCode==13)
                return updateDialogContractsFilter();
        });
        
        $(".Dialog-CustomerContracts-equal,[name=Dialog-CustomerContracts-nbitemsbypage]").change(function() { return updateDialogContractsFilter(); }); 
         
        $("#Dialog-CustomerContracts-filter").click(function() { return updateDialogContractsFilter(); }); 

       
        $("#Dialog-CustomerContracts-init").click(function() { $.ajax2({ 
                url:"{url_to('customers_contracts_ajax',['action'=>'DialogListFilterContracts'])}",
                errorTarget: ".dialog-customers-contract-site-errors",       
                loading: "#tab-site-dashboard-customers-contract-loading",
                target: "#dialogListFilterContracts" }); 
        }); 

        $(".Dialog-CustomerContracts-pager").click(function () {             
                return $.ajax2({ data: getDialogContractsFilterParameters(), 
                                 url:"{url_to('customers_contracts_ajax',['action'=>'DialogListFilterContracts'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".dialog-customers-contract-site-errors",
                                 loading: "#tab-site-dashboard-customers-contract-loading",
                                 target: "#dialogListFilterContracts"
                });
        });
 
          
        $(".Dialog-CustomerContracts.list").click(function () { 
            $(".Dialog-CustomerContracts.list").removeClass('selected');
            $(this).addClass('selected');
            $("#dialogListFilterContracts").data('selected',$(this).attr('id'));
            index=$(".Dialog-CustomerContracts.list.selected").index()-2;  {* 2 : number of <tr> before *}            
            $("#dialogListFilterContracts").data('object',$("#dialogListFilterContracts").data('pager')[index]);
        });
</script>    