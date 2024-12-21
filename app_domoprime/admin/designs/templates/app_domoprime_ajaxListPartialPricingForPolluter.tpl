{messages class="site-errors"}
{if $polluter->isLoaded()}
<h3>{__('Pricing for [%s]',$polluter->get('name'))}</h3>    
<div>
      <a href="#" class="btn" id="DomomprimePolluterPricing-New" title="{__('New pricing')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>
      {__('New pricing')}</a>    
      <a href="#" class="btn" id="DomomprimePolluterPricing-Cancel" title="{__('Cancel')}" >
      <i class="fa fa-times" style="margin-right:10px;"></i>
      {__('Cancel')}</a>       
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="DomomprimePollutingPricing"}
<button id="DomomprimePolluterPricing-filter" class="btn-table" style="width:auto">{__("Filter")}</button>   
<button id="DomomprimePolluterPricing-init" class="btn-table">{__("Init")}</button>
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0"> 
    <thead>
    <tr class="list-header">    
    <th>#</th>              
         <th data-hide="phone" style="display: table-cell;">
              <span>{__('Class')}</span>               
        </th>
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('Coef.')}</span>   
        </th>  
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('Multiple floor')}</span>              
        </th> 
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('Multiple top')}</span>              
        </th> 
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('Multiple wall')}</span>              
        </th>     
        <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
    </tr>
</thead> 
 {foreach $pager as $item}
    <tr class="DomomprimePollutingPricing list" id="DomomprimePollutingPricing-{$item->get('id')}"> 
        <td class="DomomprimePollutingPricing-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>                                
            <td> 
               {$item->getClass()->getI18n()}
            </td>
            <td>
               {$item->getCoefficient()->getFormatted("#.000000")}
            </td> 
            <td>   
                  {if $item->hasMultipleFloor()}{$item->get('multiple_floor')}{else}{__('---')}{/if}  
            </td>
              <td>                
                {if $item->hasMultipleTop()}{$item->get('multiple_top')}{else}{__('---')}{/if}  
            </td>
              <td>                
                {if $item->hasMultipleWall()}{$item->get('multiple_wall')}{else}{__('---')}{/if}  
            </td>
            <td>
               <a href="#" title="{__('Edit')}" class="DomomprimePolluterPricing-View" id="{$item->get('id')}">
                     <i class="fa fa-edit" style="font-size: 16px;"></i></a>                            
                <a href="#" title="{__('Delete')}" class="DomomprimePolluterPricing-Delete" id="{$item->get('id')}"  name="{$item->getClass()->getI18n()}">
                   <i class="fa fa-remove" style="font-size: 16px;"></i>
                </a>  
            </td>           
    </tr>    
    {/foreach}    
</table>
{if !$pager->getNbItems()}
     <span>{__('No pricing')}</span>
{else}
 
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="DomomprimePollutingPricing"}
<script type="text/javascript">
 
    function getSiteDomomprimePolluterPricingFilterParameters()
        {
            var params={    Polluter : '{$polluter->get('id')}',
                            filter: {  order : { }, 
                                    search : { },
                                    equal: { },                                                                                                                                   
                                nbitemsbypage: $("[name=DomomprimePolluterPricing-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".DomomprimePolluterPricing-order_active").attr("name"))
                 params.filter.order[$(".DomomprimePolluterPricing-order_active").attr("name")] =$(".DomomprimePolluterPricing-order_active").attr("id");   
            $(".DomomprimePolluterPricing-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteDomomprimePolluterPricingFilter()
        {           
           return $.ajax2({ data: getSiteDomomprimePolluterPricingFilterParameters(), 
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialPricingForPolluter'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",
                            target: "#actions"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".DomomprimePolluterPricing-pager .DomomprimePolluterPricing-active").html()?parseInt($(".DomomprimePolluterPricing-pager .DomomprimePolluterPricing-active").html()):1;
           records_by_page=$("[name=DomomprimePolluterPricing-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".DomomprimePolluterPricing-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#DomomprimePolluterPricing-nb_results").html())-n;
           $("#DomomprimePolluterPricing-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#DomomprimePolluterPricing-end_result").html($(".DomomprimePolluterPricing-count:last").html());
        }
        
           
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomomprimePolluterPricing-init").click(function() {                  
               $.ajax2({ 
                        data : {  Polluter : '{$polluter->get('id')}' },
                        url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialPricingForPolluter'])}",
                        errorTarget: ".site-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions"}); 
           }); 
    
          $('.DomomprimePolluterPricing-order').click(function() {
                $(".DomomprimePolluterPricing-order_active").attr('class','DomomprimePolluterPricing-order');
                $(this).attr('class','DomomprimePolluterPricing-order_active');
                return updateSiteDomomprimePolluterPricingFilter();
           });
           
            $(".DomomprimePolluterPricing-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteDomomprimePolluterPricingFilter();
            });
            
          $("#DomomprimePolluterPricing-filter").click(function() { return updateSiteDomomprimePolluterPricingFilter(); }); 
          
          $("[name=DomomprimePolluterPricing-nbitemsbypage]").change(function() { return updateSiteDomomprimePolluterPricingFilter(); }); 
                 
           $(".DomomprimePolluterPricing-pager").click(function () {                    
                return $.ajax2({ data: getSiteDomomprimePolluterPricingFilterParameters(), 
                                url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialPricingForPolluter'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                errorTarget: ".site-errors",
                                loading: "#tab-site-dashboard-x-settings-loading",
                                target: "#actions"
                });
        });
        
          {* =====================  A C T I O N S =============================== *}  
      
          $("#DomomprimePolluterPricing-Cancel").click( function () {             
            return $.ajax2({              
                url: "{url_to('app_domoprime_ajax',['action'=>'ListPartialPollutingCompany'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         });
         
           $("#DomomprimePolluterPricing-New").click( function () {             
            return $.ajax2({    
                data : {  Polluter : '{$polluter->get('id')}' },
                url: "{url_to('app_domoprime_ajax',['action'=>'NewPricingForPolluter'])}",
               errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         });
         
         
           $(".DomomprimePolluterPricing-Delete").click( function () { 
                if (!confirm('{__("Pricing \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ PolluterClassPricing: $(this).attr('id') },
                                 url :"{url_to('app_domoprime_ajax',['action'=>'DeletePolluterPricing'])}",
                                 errorTarget: ".site-errors",     
                                 loading: "#tab-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='DeletePolluterPricing')
                                       {    
                                          $("#DomomprimePollutingPricing-"+resp.id).remove();  
                                          if ($('.DomomprimePollutingPricing.list').length==0)
                                              return $.ajax2({  data : {  Polluter : '{$polluter->get('id')}' },
                                                                url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialPollutingCompany'])}",
                                                               errorTarget: ".site-errors",
                                                               target: "#tab-dashboard-x-settings"});
                                          updateSitePager(1);
                                        }       
                                 }
                     });                                        
            });
    
         
         $(".DomomprimePolluterPricing-View").click( function () {             
            return $.ajax2({    
                data : {  PolluterClassPricing: $(this).attr('id') },
                url: "{url_to('app_domoprime_ajax',['action'=>'ViewPricingForPolluter'])}",
               errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         });
</script>    

{else}
    {__('Polluter is invalid.')}
{/if}    