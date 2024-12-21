{messages class="customers-comments-errors"}
<h3>{__('Customer Logs')}</h3>  
<div>  
   <a href="#" id="CustomerCommentLog-Cancel" class="btn"><i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="CustomerCommentLog"}
<div style="float:left">
        <button style="width:135px" class="btn-table" id="filter">{__("Filter")}</button> 
        <button style="width:135px" class="btn-table" id="init">{__("Init")}</button>
</div>
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0">
      <thead>
        <tr class="list-header">    
        <th>#</th>        
        <th>{__('id')}
             <div>
             
             </div> 
         </th>  
         <th>{__('Customer')}
             <div>
             
             </div> 
         </th>  
         <th>{__('Comment')}
               <div>
              </div> 
         </th>
         <th>{__('By')}
              <div>
               </div> 
         </th>                               
          <th>{__('Date creation')}
                <div>
                  </div>
          </th>
         
                
     </tr>
     </thead> 
     <tr class="input-list">
            <td></td>
            <td>
            </td>  
            <td>
                 <input class="CustomerCommentLog-search" type="text" size="80" name="lastname" value="{$formFilter.search.lastname}">                
            </td>  
            <td>
                <input class="CustomerCommentLog-search" type="text" size="80" name="comment" value="{$formFilter.search.comment}">
            </td>                 
            <td></td>
            <td></td>                                                               
        </tr>       
        {foreach $pager as $item}
        <tr class="CustomerCommentLog list" id="{$item->get('id')}">
            <td class="CustomerCommentLog-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>            
            <td>
                {$item->getId()}
            </td>           
            <td style="width:200px">
                {$item->getComment()->getCustomer()|upper}  {$item->getComment()->getCustomer()->getFormattedPhone()} 
            </td>
            <td>
                {$item->getComment()->get('comment')|escape} 
            </td>
             <td>
                 {$item->getUser()|upper}{if $item->getUser()->isSuperAdministrator()}&nbsp;({__('Superadmin')}){/if} 
            </td>                                
            <td>
                {format_date($item->get('created_at'),['d','q'])}
            </td>                       
           
        </tr>
        {/foreach}
</table>

{if !$pager->getNbItems()}  
     {__("No log")}
{else}
 
    
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="CustomerCommentLog"} 
<script type="text/javascript">
    
        function getCustomerCommentLogFilterParameters()
        {
            params={ filter: {  order : { }, 
                                     search: {  }, 
                                     nbitemsbypage: $("[name=CustomerCommentLog-nbitemsbypage]").val(),
                                     token:'{$formFilter->getCSRFToken()}'
                                  }};
            params.filter.order[$(".CustomerCommentLog-order_active").attr("name")] =$(".CustomerCommentLog-order_active").attr("id");
            $(".CustomerCommentLog-search").each(function(id) { params.filter.search[this.name] =this.value; });                               
            return params;                  
        }
        
        function updateCustomerCommentLogFilter()
        {
           return $.ajax2({ data: getCustomerCommentLogFilterParameters(), 
                            url:"{url_to('customers_comments_ajax',['action'=>'ListPartialLog'])}" , 
                            errorTarget: ".customers-comments-errors",
                                loading: "#tab-site-dashboard-x-customers-loading",
                                target: "#tab-site-panel-dashboard-x-customers-base" });
        }
        
        function updatePager(n)
        {
           page_active=$(".CustomerCommentLog-pager .CustomerCommentLog-active").html()?parseInt($(".CustomerCommentLog-pager .CustomerCommentLog-active").html()):1;
           records_by_page=$("[name=CustomerCommentLog-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".CustomerCommentLog_count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#nb_results").html())-n;
           $("#CustomerCommentLog-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#CustomerCommentLog-end_result").html($(".CustomerCommentLog-customers_count:last").html());
        }                
         // {* PAGER - begin *}
         $('.CustomerCommentLog-order').click(function() {
             $(".CustomerCommentLog-order_active").attr('class','CustomerCommentLog-order');
             $(this).attr('class','CustomerCommentLog-order_active');
             return updateCustomerCommentLogFilter();
         });
         
          $("[name=CustomerCommentLog-nbitemsbypage],[name=CustomerCommentLog-is_active]").change(function() {  return updateCustomerCommentLogFilter(); }); 
          
          $(".CustomerCommentLog-search").keypress(function(event) {
                        if (event.keyCode==13)
                        return updateCustomerCommentLogFilter();
          });
                   
          $("#filter").click(function() {  return updateCustomerCommentLogFilter(); }); 
          
          $("#init").click(function() { return $.ajax2({ url:"{url_to('customers_comments_ajax',['action'=>'ListPartialLog'])}",
                                                         errorTarget: ".customers-comments-errors",
                                loading: "#tab-site-dashboard-x-customers-loading",
                                target: "#tab-site-panel-dashboard-x-customers-base"}); }); 
          
          $(".pager").click(function () {
             return $.ajax2({ data: getCustomerCommentLogFilterParameters(), 
                              url:"{url_to('customers_comments_ajax',['action'=>'ListPartialLog'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                              errorTarget: ".customers-comments-errors",
                                loading: "#tab-site-dashboard-x-customers-loading",
                                target: "#tab-site-panel-dashboard-x-customers-base"});
          });
          
 {* =================== A C T I O N S ================================ *}
     $('#CustomerCommentLog-Cancel').click(function(){   
            // $(".dialogs").dialog("destroy").remove(); 
             return $.ajax2({  url : "{url_to('customers_ajax',['action'=>'ListPartial'])}",
                                errorTarget: ".customers-comments-errors",
                                loading: "#tab-site-dashboard-x-customers-loading",
                                target: "#tab-site-panel-dashboard-x-customers-base"}); 
      });
</script>