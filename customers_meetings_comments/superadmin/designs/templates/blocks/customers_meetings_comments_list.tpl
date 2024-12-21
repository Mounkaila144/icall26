{messages class="{$site->getSiteID()}-site-comments-errors"}
<h3>{__('Comments')}</h3>    
<div>
  <a href="#" class="btn" id="{$site->getSiteID()}-Comment-New" title="{__('new email')}" ><img  src="{url('/icons/new.gif','picture')}" alt="{__('new')}"/>{__('New comment')}</a>   
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="`$site->getSiteID()`-Comment"}
<button class="btn-table" id="{$site->getSiteID()}-Comment-filter">{__("Filter")}</button>   
<button class="btn-table" id="{$site->getSiteID()}-Comment-init">{__("Init")}</button>
<table class="tabl-list" cellpadding="0" cellspacing="0">    
    <tr class="list-header">
        <th>#</th>       
        <th>
            <span>{__('id')|capitalize}</span>
            <div>
                <a href="#" class="{$site->getSiteID()}-Comment-order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="{$site->getSiteID()}-Comment-order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>  
        <th>
            <span>{__('Comment')|capitalize}</span>
         <div>
                <a href="#" class="{$site->getSiteID()}-Comment-order{$formFilter.order.comment->getValueExist('asc','_active')}" id="asc" name="comment"><img  src='{url("/icons/sort_asc`$formFilter.order.comment->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="{$site->getSiteID()}-Comment-order{$formFilter.order.comment->getValueExist('desc','_active')}" id="desc" name="comment"><img  src='{url("/icons/sort_desc`$formFilter.order.comment->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>
        <th>
            <span>{__('User')|capitalize}</span>
           
        </th>
    </tr>
    {foreach $pager as $item}
    <tr class="{$site->getSiteID()}-Comment-list list"> 
            <td class="{$site->getSiteID()}-Comment-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>                       
            <td>                
               {$item->getComment()->get('created_at')}  
            </td>                       
            <td>
                {$item->getComment()->get('comment')} 
            </td> 
            <td>
                {$item->getUser()}{if $item->getUser()->isSuperAdministrator()}&nbsp;({__('Superadmin')}){/if} 
            </td>                       
    </tr>    
    {/foreach}  
</table>  
{if !$pager->hasItems()}
     <span>{__('No comment')}</span>   
{/if}
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="`$site->getSiteID()`-Comment"}


<script type="text/javascript">
    
    function getSite{$site->getSiteKey()}CustomerCommentsFilterParameters()
        {
            var params={   Meeting: "{$meeting->get('id')}",
                           filter: {  order : { }, 
                                    search : { },
                                    equal: { },                                                                                                                                 
                                nbitemsbypage: $("[name={$site->getSiteID()}-Comment-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".{$site->getSiteID()}-Comment-order_active").attr("name"))
                 params.filter.order[$(".{$site->getSiteID()}-Comment-order_active").attr("name")] =$(".{$site->getSiteID()}-Comment-order_active").attr("id");   
            $(".{$site->getSiteID()}-Comment-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSite{$site->getSiteKey()}CustomerCommentsFilter()
        {          
           return $.ajax2({ data: getSite{$site->getSiteKey()}CustomerCommentsFilterParameters(), 
                            url:"{url_to('customers_meetings_comments_ajax',['action'=>'ListPartialComment'])}" , 
                            errorTarget: ".{$site->getSiteID()}-site-comments-errors",
                            loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-meeting-loading",                             
                            target: "#tab-customer-meetings-customer-meeting-comments-{$meeting->get('id')}"
                             });
        }
    
        function updateSite{$site->getSiteKey()}Pager(n)
        {
           page_active=$(".{$site->getSiteID()}-Comment-pager .Comment-active").html()?parseInt($(".{$site->getSiteID()}-Comment-pager .Comment-active").html()):1;
           records_by_page=$("[name={$site->getSiteID()}-Comment-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".{$site->getSiteID()}-Comment-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#{$site->getSiteID()}-Comment-nb_results").html())-n;
           $("#{$site->getSiteID()}-Comment-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#{$site->getSiteID()}-Comment-end_result").html($(".{$site->getSiteID()}-Comment-count:last").html());
        }
        
        {* =====================  P A G E R  A C T I O N S =============================== *}  
      
          $("#{$site->getSiteID()}-Comment-init").click(function() {               
               $.ajax2({    data : { Meeting: "{$meeting->get('id')}" },
                            url:"{url_to('customers_meetings_comments_ajax',['action'=>'ListPartialComment'])}",
                            errorTarget: ".{$site->getSiteID()}-site-comments-errors",
                            loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-meeting-loading",                             
                            target: "#tab-customer-meetings-customer-meeting-comments-{$meeting->get('id')}"
                       }); 
           }); 
           
            $('.{$site->getSiteID()}-Comment-order').click(function() {
                $(".{$site->getSiteID()}-Comment-order_active").attr('class','{$site->getSiteID()}-Comment-order');
                $(this).attr('class','{$site->getSiteID()}-Comment-order_active');
                return updateSite{$site->getSiteKey()}CustomerCommentsFilter();
           });
           
            $(".{$site->getSiteID()}-Comment-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSite{$site->getSiteKey()}CommentsFilter();
            });
            
          $("#{$site->getSiteID()}-Comment-filter").click(function() { return updateSite{$site->getSiteKey()}CustomerCommentsFilter(); }); 
          
          $("[name={$site->getSiteID()}-Comment-nbitemsbypage]").change(function() { return updateSite{$site->getSiteKey()}CustomerCommentsFilter(); }); 
          
         // $("[name=Comment-name]").change(function() { return updateSite{$site->getSiteKey()}CommentFilter(); }); 
           
           $(".{$site->getSiteID()}-Comment-pager").click(function () {                       
                return $.ajax2({ data: getSite{$site->getSiteKey()}CustomerCommentsFilterParameters(), 
                                 url:"{url_to('customers_communication_emails_ajax',['action'=>'ListPartialCommentForMeeting'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".{$site->getSiteID()}-site-errors",
                                 loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                 target: "#{$site->getSiteID()}-actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}   
        
    $("#{$site->getSiteID()}-Comment-New").click( function () {                     
            return $.ajax2({   
                data : { Meeting: "{$meeting->get('id')}"  },
                url: "{url_to('customers_meetings_comments_ajax',['action'=>'NewComment'])}",
                errorTarget: ".{$site->getSiteID()}-site-comments-errors",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-meeting-loading",                             
                target: "#tab-customer-meetings-customer-meeting-comments-{$meeting->get('id')}"
           });
    });
    
   
</script>    