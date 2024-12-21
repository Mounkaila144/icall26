{messages class="site-errors"}
<h3>{__('Pollutings')}</h3>    
<div>    
  <a href="#" class="btn" id="DomomprimePollutingCompany-New" title="{__('New Polluting')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>
      {__('New polluting')}</a>    
{if $user->hasCredential([['superadmin']])}
   <a target="blank" href="{url_to('app_domoprime',['action'=>'ExportPolluters'])}" class="btn" title="{__('Export')}" ><i class="fa fa-upload" style="margin-right:10px;"></i>
      {__('Export')}</a>  
    <a id="Import" href="#" class="btn" title="{__('Import')}" ><i class="fa fa-download" style="margin-right:10px;"></i>
      {__('Import')}</a> 
{/if}
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="DomomprimePollutingCompany"}
<button id="DomomprimePollutingCompany-filter" class="btn-table" style="width:auto">{__("Filter")}</button>   
<button id="DomomprimePollutingCompany-init" class="btn-table">{__("Init")}</button>
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0"> 
    <thead>
    <tr class="list-header">    
    <th>#</th>      
        <th  class="footable-first-column" data-toggle="true">
            <span>{__('name')}</span>
            <div>
                <a href="#" class="DomomprimePollutingCompany-order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="name"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="DomomprimePollutingCompany-order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="name"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('commercial')}</span>             
        </th>
         <th data-hide="phone" style="display: table-cell;">
            <span>{__('post code')}</span>               
        </th>
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('city')}</span>  

        </th>  
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('phone')}</span>               
        </th>
          <th data-hide="phone" style="display: table-cell;">
            <span>{__('Default?')}</span>               
        </th>
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('Active')}</span>  

        </th>  
        <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
    </tr>
</thead> 
    {* search/equal/range *}
    <tr class="input-list">
       <td>{* # *}</td>
       <td>{* name *}
           <input type="text" class="DomomprimePollutingCompany-search" style="height: 15px;" name="name"  value="{$formFilter.search.name}">
       </td>
          <td>{* # *}</td>
       <td>{* post code *}
            <input type="text" class="DomomprimePollutingCompany-search" style="height: 15px;" name="postcode"  value="{$formFilter.search.postcode}">
       </td>
       <td>{* city *}
           <input type="text" class="DomomprimePollutingCompany-search" style="height: 15px;" name="city" value="{$formFilter.search.city}">
       </td>  
       <td>{* phone *}
           <input type="text" class="DomomprimePollutingCompany-search" style="height: 15px;" name="phone"  value="{$formFilter.search.phone}">
       </td>
       <td>
           
       </td>
       <td>{* state *}
       </td>  
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="DomomprimePollutingCompany list" id="DomomprimePollutingCompany-{$item->get('id')}"> 
        <td class="DomomprimePollutingCompany-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>                     
            <td>                
               {$item->get('name')}    
            </td>
             <td>                
               {$item->get('commercial')}    
            </td>
            <td> 
               {if $item->get('postcode')}
                {$item->get('postcode')}
                {else}
                        {__('---')}
                {/if}
            </td>
            <td>
               {if $item->get('city')}
                {$item->get('city')}  
                {else}
                        {__('---')}
                {/if}
            </td> 
            <td>
                {if $item->get('phone')}
                    {$item->get('phone')} 
                {else}
                    {__('---')}
                {/if}
            </td> 
            <td>
           {__($item->get('is_default'))}
       </td>
            <td>
                {__($item->get('is_active'))} 
            </td> 
            <td>               
                <a href="#" title="{__('Edit')}" class="DomomprimePollutingCompany-View" id="{$item->get('id')}">
                     <i class="fa fa-edit" style="font-size: 16px;"></i></a>              
                <a href="#" title="{__('Contacts')}" class="DomomprimePollutingCompany-Contacts" id="{$item->get('id')}">
                     <i class="fa fa-users" style="font-size: 16px;"></i></a> 
                <a href="#" title="{__('Pricing')}" class="DomomprimePollutingCompany-Pricing" id="{$item->get('id')}">
                     <i class="fa fa-eur" style="font-size: 16px;"></i></a>
                {if $user->hasCredential([['superadmin','app_domoprime_polluter_list_properties']])}
                 <a href="#" title="{__('Primes')}" class="DomomprimePollutingCompany-Primes" id="{$item->get('id')}">                     
                     <i class="fa fa-eur" style="font-size: 16px;color:red"></i></a>
                {/if}                   
                {component name="/app_domoprime_iso3/polluterList" item=$item}
                <a href="#" title="{__('Models')}" class="DomomprimePollutingCompany-Models" id="{$item->get('id')}">
                     <i class="fa fa-file-text-o" style="font-size: 16px;"></i></a>
                 <a href="#" title="{__('Documents')}" class="DomomprimePollutingDocuments-Models" id="{$item->get('id')}">
                     <i class="fa fa-file-text-o" style="font-size: 16px;color:green"></i></a>
                <a href="#" title="{__('Quotation model')}" class="DomomprimePollutingQuotation-model" id="{$item->get('id')}">
                     <i class="fa fa-file" style="font-size: 16px;"></i></a>
                 <a href="#" title="{__('Billing model')}" class="DomomprimePollutingBilling-model" id="{$item->get('id')}">
                     <i class="fa fa-file" style="font-size: 16px;color:red"></i></a>
                <a href="#" title="{__('Recipients')}" class="DomomprimePollutingRecipient" id="{$item->get('id')}">
                     <i class="fa fa-building-o" style="font-size: 16px;"></i></a>   
                <a target="blank" href="{url_to('app_domoprime',['action'=>'ExportPolluter'])}?Polluter={$item->get('id')}" title="{__('Export Polluter')}" >
                    <i class="fa fa-upload" style="font-size: 16px;"/>
               </a>  
                <a href="#" title="{__('Delete')}" class="DomomprimePollutingCompany-Delete" id="{$item->get('id')}"  name="{$item->get('name')}">
                   <i class="fa fa-remove" style="font-size: 16px;"></i>
                </a> 
                    <a href="#" title="{__('Remove')}" class="DomomprimePollutingCompany-Remove" id="{$item->get('id')}"  name="{$item->get('name')}">
                   <i class="fa fa-trash" style="font-size: 16px;"></i>
                </a> 
            </td>
    </tr>    
    {/foreach}    
</table>    
{if !$pager->getNbItems()}
     <span>{__('No polluter')}</span>
{else}
    {*if $pager->getNbItems()>5}
        <input type="checkbox" id="DomomprimePollutingCompany-all" /> 
          <a style="opacity:0.5" class="DomomprimePollutingCompany-actions_items" href="#" title="{__('Delete')}" id="DomomprimeZone-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if*}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="DomomprimePollutingCompany"}
<script type="text/javascript">
 
        function getSiteDomomprimePollutingCompanyFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: { },                                                                                                                                   
                                nbitemsbypage: $("[name=DomomprimePollutingCompany-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".DomomprimePollutingCompany-order_active").attr("name"))
                 params.filter.order[$(".DomomprimePollutingCompany-order_active").attr("name")] =$(".DomomprimePollutingCompany-order_active").attr("id");   
            $(".DomomprimePollutingCompany-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteDomomprimePollutingCompanyFilter()
        {           
           return $.ajax2({ data: getSiteDomomprimePollutingCompanyFilterParameters(), 
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialPollutingCompany'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",
                            target: "#actions"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".DomomprimePollutingCompany-pager .DomomprimePollutingCompany-active").html()?parseInt($(".DomomprimePollutingCompany-pager .DomomprimePollutingCompany-active").html()):1;
           records_by_page=$("[name=DomomprimePollutingCompany-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".DomomprimePollutingCompany-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#DomomprimePollutingCompany-nb_results").html())-n;
           $("#DomomprimePollutingCompany-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#DomomprimePollutingCompany-end_result").html($(".DomomprimePollutingCompany-count:last").html());
        }
        
           
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomomprimePollutingCompany-init").click(function() {                  
               $.ajax2({ url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialPollutingCompany'])}",
                        errorTarget: ".site-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions"}); 
           }); 
    
          $('.DomomprimePollutingCompany-order').click(function() {
                $(".DomomprimePollutingCompany-order_active").attr('class','DomomprimePollutingCompany-order');
                $(this).attr('class','DomomprimePollutingCompany-order_active');
                return updateSiteDomomprimePollutingCompanyFilter();
           });
           
            $(".DomomprimePollutingCompany-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteDomomprimePollutingCompanyFilter();
            });
            
          $("#DomomprimePollutingCompany-filter").click(function() { return updateSiteDomomprimePollutingCompanyFilter(); }); 
          
          $("[name=DomomprimePollutingCompany-nbitemsbypage]").change(function() { return updateSiteDomomprimePollutingCompanyFilter(); }); 
          
         // $("[name=DomomprimePollutingCompany-name]").change(function() { return updateSiteDomomprimePollutingCompanyFilter(); }); 
           
           $(".DomomprimePollutingCompany-pager").click(function () {                    
                return $.ajax2({ data: getSiteDomomprimePollutingCompanyFilterParameters(), 
                                url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialPollutingCompany'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                errorTarget: ".site-errors",
                                loading: "#tab-site-dashboard-x-settings-loading",
                                target: "#actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#DomomprimePollutingCompany-New").click( function () {             
            return $.ajax2({              
                url: "{url_to('app_domoprime_ajax',['action'=>'NewPolluting'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         });
         
         $(".DomomprimePollutingCompany-View").click( function () {                       
                return $.ajax2({ data : { Polluting : $(this).attr('id')  },
                                url :"{url_to('app_domoprime_ajax',['action'=>'ViewPollutingCompany'])}",
                                errorTarget: ".site-errors",
                                loading: "#tab-site-dashboard-x-settings-loading",
                                target: "#actions"});
         });
                    
         
          $(".DomomprimePollutingCompany-Delete").click( function () { 
                if (!confirm('{__("Polluting \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ Polluting: $(this).attr('id') },
                                url :"{url_to('app_domoprime_ajax',['action'=>'DeletePolluting'])}",
                                errorTarget: ".site-servers-errors",
                                loading: "#tab-site-dashboard-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='DeletePolluting')
                                       {    
                                          $("tr#DomomprimePollutingCompany-"+resp.id).remove();  
                                          if ($('.DomomprimePollutingCompany').length==0)
                                            return $.ajax2({ url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialPollutingCompany'])}",
                                            errorTarget: ".site-errors",
                                            loading: "#tab-site-dashboard-x-settings-loading"});
                                          updateSitePager(1);
                                        }       
                                 }
                     });                                        
            });
            
                     
          $(".DomomprimePollutingCompany-Contacts").click( function () {              
                return $.ajax2({ data : { DomoprimePolluting : $(this).attr('id') },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('app_domoprime_ajax',['action'=>'ListPollutingContact'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
            
       $(".DomomprimePollutingCompany-Pricing").click( function () {              
                return $.ajax2({ data : { Polluter : $(this).attr('id') },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialPricingForPolluter'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
         
              
       $(".DomomprimePollutingCompany-Models").click( function () {              
                return $.ajax2({ data : { Polluter : $(this).attr('id') },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('partners_polluter_ajax',['action'=>'ListPartialModelI18nForPolluter'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
         
         
          $(".DomomprimePollutingDocuments-Models").click( function () {              
                return $.ajax2({ data : { Polluter : $(this).attr('id') },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('partners_polluter_ajax',['action'=>'ListPartialDocumentForPolluter'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
         
         
          $(".DomomprimePollutingQuotation-model").click( function () {              
                return $.ajax2({ data : { Polluter : $(this).attr('id') },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('app_domoprime_ajax',['action'=>'ViewQuotationModelForPolluter'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
         
	  $('.footable').footable();
	
        
         $(".DomomprimePollutingCompany-Remove").click( function () { 
                if (!confirm('{__("Polluting \"#0#\" will be removed. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ Polluting: $(this).attr('id') },
                                url :"{url_to('app_domoprime_ajax',['action'=>'RemovePolluting'])}",
                                errorTarget: ".site-errors",
                                loading: "#tab-site-dashboard-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='RemovePolluting')
                                       {    
                                          $("tr#DomomprimePollutingCompany-"+resp.id).remove();  
                                          if ($('.DomomprimePollutingCompany').length==0)
                                            return $.ajax2({ url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialPollutingCompany'])}",
                                            errorTarget: ".site-servers-errors",
                                            loading: "#tab-site-dashboard-x-settings-loading"});
                                          updateSitePager(1);
                                        }       
                                 }
                     });                                        
            });
            
            
   $(".DomomprimePollutingRecipient").click( function () {              
                return $.ajax2({ data : { Polluter : $(this).attr('id') },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('app_domoprime_ajax',['action'=>'ViewRecipientForPolluter'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });      
         
           $(".DomomprimePollutingBilling-model").click( function () {              
                return $.ajax2({ data : { Polluter : $(this).attr('id') },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('app_domoprime_ajax',['action'=>'ViewBillingModelForPolluter'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
         
         
         
           $("#Import").click( function () {              
                return $.ajax2({ loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('app_domoprime_ajax',['action'=>'ImportPolluter'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
         
          {if $user->hasCredential([['superadmin','app_domoprime_polluter_list_properties']])} 
         $(".DomomprimePollutingCompany-Primes").click( function () {              
                return $.ajax2({ data : { Polluter : $(this).attr('id') },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('app_domoprime_ajax',['action'=>'ViewPropertiesForPolluter'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
         {/if} 
     
     
    {component name="/app_domoprime_iso3/polluterJavascript" COMMENT=false}  
</script>    

