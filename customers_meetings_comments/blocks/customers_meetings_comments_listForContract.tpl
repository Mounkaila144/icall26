{$contract->getCustomer()|upper}
{messages class="site-contract-meeting-comments-errors"}
<h3>{__('Comments')}</h3>   
{if $contract->getMeeting()->isLoaded()}
<div>
  {if $user->hasCredential([['superadmin','admin','contract_meeting_comments_new']])}
  <a href="#" class="btn" id="Comment-New" title="{__('New comment')}" >
      <i class="fa fa-plus" style=" margin-right: 10px"></i>{__('New comment')}</a>   
  {/if}
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="ContratMeetingComment"}
<button class="btn-table" id="ContratMeetingComment-filter">{__("Filter")}</button>   
<button class="btn-table" id="ContratMeetingComment-init">{__("Init")}</button>
<table class="tabl-list footable table" cellpadding="0" cellspacing="0"> 
    <thead>
    <tr class="list-header">
        <th>#</th>       
        <th  data-hide="phone" style="display: table-cell;">
            <span>{__('Created at')}</span>
            <div>
                <a href="#" class="ContratMeetingComment-order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="ContratMeetingComment-order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>  
        <th class="footable-first-column" data-toggle="true">
            <span>{__('Comment')}</span>
         <div>
                <a href="#" class="ContratMeetingComment-order{$formFilter.order.comment->getValueExist('asc','_active')}" id="asc" name="comment"><img  src='{url("/icons/sort_asc`$formFilter.order.comment->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="ContratMeetingComment-order{$formFilter.order.comment->getValueExist('desc','_active')}" id="desc" name="comment"><img  src='{url("/icons/sort_desc`$formFilter.order.comment->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>
        <th  data-hide="phone" style="display: table-cell;">
            <span>{__('User')}</span>           
        </th>       
            
    </tr>
</thead>
    {foreach $pager as $item}
    <tr class="ContratMeetingComment-list list" id="ContratMeetingComment-{$item->getComment()->get('id')}"> 
            <td class="ContratMeetingComment-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>                       
            <td>                
               {format_date($item->getComment()->get('created_at'),['d','q'])}  
            </td>                       
            <td>
                {$item->getComment()->getCensoredText()} 
            </td> 
            <td>
                {$item->getUser()|upper}{if $item->getUser()->isSuperAdministrator()}&nbsp;({__('Superadmin')|upper}){/if} 
            </td> 
        
    </tr>    
    {/foreach}  
</table>  
{if !$pager->hasItems()}
     <span>{__('No comment')}</span>   
{/if}
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="ContratMeetingComment"}


<script type="text/javascript">
    
    function getSiteCustomerContratMeetingCommentsFilterParameters()
        {
            var params={   Contract: "{$contract->get('id')}",
                           filter: {  order : { }, 
                                    search : { },
                                    equal: { },                                                                                                                                 
                                nbitemsbypage: $("[name=ContratMeetingComment-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".ContratMeetingComment-order_active").attr("name"))
                 params.filter.order[$(".ContratMeetingComment-order_active").attr("name")] =$(".ContratMeetingComment-order_active").attr("id");   
            $(".ContratMeetingComment-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteCustomerContratMeetingCommentsFilter()
        {          
           return $.ajax2({ data: getSiteCustomerContratMeetingCommentsFilterParameters(), 
                            url:"{url_to('customers_meetings_comments_ajax',['action'=>'ListPartialCommentForContract'])}" , 
                            errorTarget: ".site-contract-meeting-comments-errors",
                            loading: "#tab-site-dashboard-customers-contract-loading",                            
                            target: "#tab-customer-contracts-contract-25-meeting-comments-{$contract->get('id')}"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".ContratMeetingComment-pager .ContratMeetingComment-active").html()?parseInt($(".ContratMeetingComment-pager .ContratMeetingComment-active").html()):1;
           records_by_page=$("[name=ContratMeetingComment-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".ContratMeetingComment-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#ContratMeetingComment-nb_results").html())-n;
           $("#ContratMeetingComment-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#ContratMeetingComment-end_result").html($(".ContratMeetingComment-count:last").html());
        }
        
        {* =====================  P A G E R  A C T I O N S =============================== *}  
      
          $("#ContratMeetingComment-init").click(function() {               
               $.ajax2({    data : { Contract: "{$contract->get('id')}" },
                            url:"{url_to('customers_meetings_comments_ajax',['action'=>'ListPartialCommentForContract'])}",
                            errorTarget: ".site-contract-meeting-comments-errors",
                            loading: "#tab-site-dashboard-customers-contract-loading",                            
                            target: "#tab-customer-contracts-contract-25-meeting-comments-{$contract->get('id')}"
                       }); 
           }); 
           
            $('.ContratMeetingComment-order').click(function() {
                $(".ContratMeetingComment-order_active").attr('class','ContratMeetingComment-order');
                $(this).attr('class','ContratMeetingComment-order_active');
                return updateSiteCustomerContratMeetingCommentsFilter();
           });
           
            $(".ContratMeetingComment-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteContratMeetingCommentsFilter();
            });
            
          $("#ContratMeetingComment-filter").click(function() { return updateSiteCustomerContratMeetingCommentsFilter(); }); 
          
          $("[name=ContratMeetingComment-nbitemsbypage]").change(function() { return updateSiteCustomerContratMeetingCommentsFilter(); }); 
          
          
           $(".ContratMeetingComment-pager").click(function () {                       
                return $.ajax2({ data: getSiteCustomerContratMeetingCommentsFilterParameters(), 
                                 url:"{url_to('customers_meetings_comments_ajax',['action'=>'ListPartialCommentForMeeting'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-contract-meeting-comments-errors",
                                 loading: "#tab-site-dashboard-customers-contract-loading",
                                 target: "#tab-customer-contracts-contract-25-meeting-comments-{$contract->get('id')}"
                });
        });
         
          $("#Comment-New").click( function () {                     
            return $.ajax2({   
                data : { Contract: "{$contract->get('id')}"  },
                url: "{url_to('customers_meetings_comments_ajax',['action'=>'NewCommentForContract'])}",
                errorTarget: ".site-contract-meeting-comments-errors",
                loading: "#tab-site-dashboard-customers-contract-loading",
                target: "#tab-customer-contracts-contract-25-meeting-comments-{$contract->get('id')}"
           });
    });
       $('.footable').footable();
</script>    
{else}
    {__('No meeting')}
{/if}    
