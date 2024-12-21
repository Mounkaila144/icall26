{$meeting->getCustomer()|upper}
{messages class="site-log-comments-errors"}  
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="LogComment"}
<button class="btn-table" id="LogComment-filter">{__("Filter")}</button>   
<button class="btn-table" id="LogComment-init">{__("Init")}</button>
<table class="tabl-list footable table" cellpadding="0" cellspacing="0"> 
    <thead>
    <tr class="list-header">
        <th>#</th>       
        <th  data-hide="phone" style="display: table-cell;">
            <span>{__('Created at')|capitalize}</span>
            <div>
                <a href="#" class="LogComment-order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="LogComment-order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>  
        <th class="footable-first-column" data-toggle="true">
            <span>{__('Log')|capitalize}</span>
         <div>
                <a href="#" class="LogComment-order{$formFilter.order.comment->getValueExist('asc','_active')}" id="asc" name="comment"><img  src='{url("/icons/sort_asc`$formFilter.order.comment->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="LogComment-order{$formFilter.order.comment->getValueExist('desc','_active')}" id="desc" name="comment"><img  src='{url("/icons/sort_desc`$formFilter.order.comment->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>
        <th  data-hide="phone" style="display: table-cell;">
            <span>{__('User')|capitalize}</span>           
        </th>                 
    </tr>
</thead>
    {foreach $pager as $item}
    <tr class="LogComment-list list" id="LogComment-{$item->getComment()->get('id')}"> 
            <td class="LogComment-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>                       
            <td>                
               {format_date($item->getComment()->get('created_at'),['d','q'])}  
            </td>                       
            <td>
                {$item->getComment()->getCensoredText()} 
            </td> 
            <td>
                {$item->getUser()}{if $item->getUser()->isSuperAdministrator()}&nbsp;({__('Superadmin')}){/if} 
            </td>         
    </tr>    
    {/foreach}  
</table>  
{if !$pager->hasItems()}
     <span>{__('No log')}</span>   
{/if}
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="LogComment"}


<script type="text/javascript">
    
    function getSiteCustomerLogCommentsFilterParameters()
        {
            var params={   Meeting: "{$meeting->get('id')}",
                           filter: {  order : { }, 
                                    search : { },
                                    equal: { },                                                                                                                                 
                                nbitemsbypage: $("[name=LogComment-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".LogComment-order_active").attr("name"))
                 params.filter.order[$(".LogComment-order_active").attr("name")] =$(".LogComment-order_active").attr("id");   
            $(".LogComment-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteCustomerLogCommentsFilter()
        {          
           return $.ajax2({ data: getSiteCustomerLogCommentsFilterParameters(), 
                            url:"{url_to('customers_meetings_comments_ajax',['action'=>'ListPartialLogComment'])}" , 
                            errorTarget: ".site-log-comments-errors",
                           loading: "#tab-site-dashboard-site-customers-meeting-loading",                    
                            target: "#tab-customer-meetings-customer-meeting-log-comments-{$meeting->get('id')}"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".LogComment-pager .LogComment-active").html()?parseInt($(".LogComment-pager .LogComment-active").html()):1;
           records_by_page=$("[name=LogComment-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".LogComment-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#LogComment-nb_results").html())-n;
           $("#LogComment-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#LogComment-end_result").html($(".LogComment-count:last").html());
        }
        
        {* =====================  P A G E R  A C T I O N S =============================== *}  
      
          $("#LogComment-init").click(function() {               
               $.ajax2({    data : { Meeting: "{$meeting->get('id')}" },
                            url:"{url_to('customers_meetings_comments_ajax',['action'=>'ListPartialLogComment'])}",
                            errorTarget: ".site-log-comments-errors",
                            loading: "#tab-site-dashboard-site-customers-meeting-loading",                   
                            target: "#tab-customer-meetings-customer-meeting-log-comments-{$meeting->get('id')}"
                       }); 
           }); 
           
            $('.LogComment-order').click(function() {
                $(".LogComment-order_active").attr('class','LogComment-order');
                $(this).attr('class','LogComment-order_active');
                return updateSiteCustomerLogCommentsFilter();
           });
           
            $(".LogComment-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteLogCommentsFilter();
            });
            
          $("#LogComment-filter").click(function() { return updateSiteCustomerLogCommentsFilter(); }); 
          
          $("[name=LogComment-nbitemsbypage]").change(function() { return updateSiteCustomerLogCommentsFilter(); }); 
          
         // $("[name=Comment-name]").change(function() { return updateSiteCommentFilter(); }); 
           
           $(".LogComment-pager").click(function () {                       
                return $.ajax2({ data: getSiteCustomerCommentsFilterParameters(), 
                                 url:"{url_to('customers_communication_emails_ajax',['action'=>'ListPartialLogCommentForMeeting'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-log-comments-errors",                                   
                                 loading: "#tab-site-dashboard-site-customers-meeting-loading",
                                 target: "#actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}   
         
    {*   $('.footable').footable(); *}
</script>    