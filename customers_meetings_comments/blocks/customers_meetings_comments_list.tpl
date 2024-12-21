{$meeting->getCustomer()}
{messages class="site-comments-errors"}
<h3>{__('Comments')}</h3>   
<div>
  {if $user->hasCredential([['superadmin','admin','meeting_comments_new']])}
  <a href="#" class="btn" id="Comment-New" title="{__('new email')}" >
      <i class="fa fa-plus" style=" margin-right: 10px"></i>
      {*<img  src="{url('/icons/new.gif','picture')}" alt="{__('new')}"/>*}{__('New comment')}</a>   
  {/if}
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="Comment"}
<button class="btn-table" id="Comment-filter">{__("Filter")}</button>   
<button class="btn-table" id="Comment-init">{__("Init")}</button>
<table class="tabl-list footable table" cellpadding="0" cellspacing="0"> 
    <thead>
    <tr class="list-header">
        <th>#</th>       
        <th  data-hide="phone" style="display: table-cell;">
            <span>{__('Created at')|capitalize}</span>
            <div>
                <a href="#" class="Comment-order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="Comment-order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>  
        <th class="footable-first-column" data-toggle="true">
            <span>{__('Comment')|capitalize}</span>
         <div>
                <a href="#" class="Comment-order{$formFilter.order.comment->getValueExist('asc','_active')}" id="asc" name="comment"><img  src='{url("/icons/sort_asc`$formFilter.order.comment->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="Comment-order{$formFilter.order.comment->getValueExist('desc','_active')}" id="desc" name="comment"><img  src='{url("/icons/sort_desc`$formFilter.order.comment->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>
        <th  data-hide="phone" style="display: table-cell;">
            <span>{__('User')|capitalize}</span>           
        </th>       
        <th  data-hide="phone" style="display: table-cell;">
            {__('Actions')|capitalize}
        </th>      
    </tr>
</thead>
    {foreach $pager as $item}
    <tr class="Comment-list list" id="Comment-{$item->getComment()->get('id')}"> 
            <td class="Comment-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>                       
            <td>                
               {format_date($item->getComment()->get('created_at'),['d','q'])}  
            </td>                       
            <td>
                {$item->getComment()->getCensoredText()} 
            </td> 
            <td>
                {$item->getUser()}{if $item->getUser()->isSuperAdministrator()}&nbsp;({__('Superadmin')}){/if} 
            </td> 
        {*    <td>
            {if $user->hasCredential([['superadmin','admin','meeting_comments_modify']])}           
                 <a href="#" title="{__('edit')}" class="Comments-View" id="{$item->getComment()->get('id')}" name="{$item->getComment()->get('comment')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a>          
            {/if}
             {if $user->hasCredential([['superadmin','admin','meeting_comments_delete']])}          
             <a href="#" title="{__('Delete')}" class="Comments-Delete" id="{$item->getComment()->get('id')}"  name="{$item->getComment()->get('comment')}">
                   <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/></a>  
             {/if}
            </td> *}
    </tr>    
    {/foreach}  
</table>  
{if !$pager->hasItems()}
     <span>{__('No comment')}</span>   
{/if}
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="Comment"}


<script type="text/javascript">
    
    function getSiteCustomerCommentsFilterParameters()
        {
            var params={   Meeting: "{$meeting->get('id')}",
                           filter: {  order : { }, 
                                    search : { },
                                    equal: { },                                                                                                                                 
                                nbitemsbypage: $("[name=Comment-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".Comment-order_active").attr("name"))
                 params.filter.order[$(".Comment-order_active").attr("name")] =$(".Comment-order_active").attr("id");   
            $(".Comment-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteCustomerCommentsFilter()
        {          
           return $.ajax2({ data: getSiteCustomerCommentsFilterParameters(), 
                            url:"{url_to('customers_meetings_comments_ajax',['action'=>'ListPartialComment'])}" , 
                            errorTarget: ".site-comments-errors",
                            loading: "#tab-site-dashboard-site-customers-meeting-loading",                             
                            target: "#tab-customer-meetings-customer-meeting-comments-{$meeting->get('id')}"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".Comment-pager .Comment-active").html()?parseInt($(".Comment-pager .Comment-active").html()):1;
           records_by_page=$("[name=Comment-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".Comment-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#Comment-nb_results").html())-n;
           $("#Comment-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#Comment-end_result").html($(".Comment-count:last").html());
        }
        
        {* =====================  P A G E R  A C T I O N S =============================== *}  
      
          $("#Comment-init").click(function() {               
               $.ajax2({    data : { Meeting: "{$meeting->get('id')}" },
                            url:"{url_to('customers_meetings_comments_ajax',['action'=>'ListPartialComment'])}",
                            errorTarget: ".site-comments-errors",
                            loading: "#tab-site-dashboard-site-customers-meeting-loading",                             
                            target: "#tab-customer-meetings-customer-meeting-comments-{$meeting->get('id')}"
                       }); 
           }); 
           
            $('.Comment-order').click(function() {
                $(".Comment-order_active").attr('class','Comment-order');
                $(this).attr('class','Comment-order_active');
                return updateSiteCustomerCommentsFilter();
           });
           
            $(".Comment-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteCommentsFilter();
            });
            
          $("#Comment-filter").click(function() { return updateSiteCustomerCommentsFilter(); }); 
          
          $("[name=Comment-nbitemsbypage]").change(function() { return updateSiteCustomerCommentsFilter(); }); 
          
         // $("[name=Comment-name]").change(function() { return updateSiteCommentFilter(); }); 
           
           $(".Comment-pager").click(function () {                       
                return $.ajax2({ data: getSiteCustomerCommentsFilterParameters(), 
                                 url:"{url_to('customers_communication_emails_ajax',['action'=>'ListPartialCommentForMeeting'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-dashboard-site-x-settings-loading",
                                 target: "#actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}   
        
    $("#Comment-New").click( function () {                     
            return $.ajax2({   
                data : { Meeting: "{$meeting->get('id')}"  },
                url: "{url_to('customers_meetings_comments_ajax',['action'=>'NewComment'])}",
                errorTarget: ".site-comments-errors",
                loading: "#tab-site-dashboard-site-customers-meeting-loading",                             
                target: "#tab-customer-meetings-customer-meeting-comments-{$meeting->get('id')}"
           });
    });
    
     $(".Comments-View").click( function () {                     
            return $.ajax2({   
                data : { Comment: $(this).attr('id')  },
                url: "{url_to('customers_meetings_comments_ajax',['action'=>'ViewComment'])}",
                errorTarget: ".site-comments-errors",
                loading: "#tab-site-dashboard-site-customers-meeting-loading",                             
                target: "#tab-customer-meetings-customer-meeting-comments-{$meeting->get('id')}"
           });
    });
    
         $(".Comments-Delete").click( function () {    
            if (!confirm('{__("Meeting \"#0#\" will be deleted. Confirm ?")}'.format(this.name))) return false; 
            return $.ajax2({     
                data : { Meeting: $(this).attr('id') },
                url: "{url_to('customers_meetings_comments_ajax',['action'=>'DeleteComment'])}",
                errorTarget: ".site-comments-errors",
                loading: "#tab-site-dashboard-site-customers-meeting-loading",  
                success: function (resp)
                         {
                             if (resp.action=='DeleteComment')
                             {
                                 $("#Comment-"+resp.id).remove();    
                                 if ($(".Comment-list").length==0)
                                 {
                                      $("#Comment-list").after("{__("No comment")}")
                                 }    
                             }    
                         }
           });
       });
       $('.footable').footable();
</script>    