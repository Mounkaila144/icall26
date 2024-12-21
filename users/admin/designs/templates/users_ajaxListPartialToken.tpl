{messages class="site-errors"}
<h3>{__('Tokens')}</h3>    
<div>
   
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="UserToken"}
<button id="UserToken-filter"  class="btn-table">{__("Filter")}</button>   <button id="UserToken-init"  class="btn-table">{__("Init")}</button> 
<div class="containerDivResp">
<table class="tabl-list  footable table" cellspacing="0">    
    <thead>
        <tr class="list-header">
            <th data-hide="phone" style="display: table-cell;">#</th>
       
         <th>
            <span>{__('ID')}</span>           
        </th>          
        </th>
           <th class="footable-first-column" data-toggle="true">
            <span>{__('Token')}</span>                  
        </th>
         <th class="footable-first-column" data-toggle="true">
            <span>{__('Message')}</span>                  
        </th>
     <th class="footable-first-column" data-toggle="true">
            <span>{__('Type')}</span>                 
        </th>
           <th data-hide="phone" style="display: table-cell;">
            <span>{__('User')}</span>                
        </th> 
         <th data-hide="phone" style="display: table-cell;">
            <span>{__('Created at')}</span>                
        </th> 
          <th data-hide="phone" style="display: table-cell;">
            <span>{__('State')}</span>                
        </th> 
        <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
    </tr>  
</thead>
    {* search/equal/range *}
    <tr class="input-list">
       <td>{* # *}</td>
 
       <td><input type="text" class="UserToken-search" name="id" value="{$formFilter.search.id}"/>
       </td>  
       <td>{* manager *}</td>
         <td>{* manager *}
             <input type="text" class="UserToken-search" name="message" value="{$formFilter.search.message}"/>
         </td>
         <td>
             {html_options name="type" class="UserToken-equal Select" options=$formFilter->equal.type->getCHoices()->toArray() selected=$formFilter.equal.type}
         </td>
          <td>
              {html_options name="user_id" class="UserToken-equal Select" options=$formFilter->equal.user_id->getCHoices()->toArray() selected=$formFilter.equal.user_id}
          </td>
       <td>{* actions *}</td>
       <td>
             {html_options name="status" class="UserToken-equal Select" options=$formFilter->equal.status->getCHoices() selected=$formFilter.equal.status}
       </td>
         <td>
                
            </td>
    </tr>   
    {foreach $pager as $item}
    <tr class="UserToken list"  id="{$item->get('id')}"> 
        <td class="UserToken-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            
                  
            <td>               
                 {$item->get('id')} 
            </td>   
            <td> {$item->get('token')|truncate:40}
            </td>
            <td>
               {$item->get('message')|truncate:40} 
            </td>
            <td>
               {$item->get('type')}   
            </td>
             <td>
                  {$item->getUser()|upper}   
            </td>
             <td>
                {$item->getCreatedAt()->getText()}
            </td>
             <td>
                {__($item->get('status'))}
            </td>
            <td>     
                 
                  
                <a href="#" title="{__('Delete')}" class="UserToken-Delete" id="{$item->get('id')}"  name="{$item->get('name')}">
                    <i class="fa fa-trash"></i></a> 
               
            </td>
    </tr>    
    {/foreach}    
</table> 
</div>
{if !$pager->getNbItems()}
     <span>{__('No token')}</span>
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="UserToken"}
<script type="text/javascript">
 
        function getSiteTokenFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: { },                                                                                                                                       
                            //{*   nbitemsbypage: $("[name=UserToken-nbitemsbypage]").val(), *}
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".UserToken-order_active").attr("name"))
                 params.filter.order[$(".UserToken-order_active").attr("name")] =$(".UserToken-order_active").attr("id");   
            $(".UserToken-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            $(".UserToken-equal.Select option:selected").each(function() { params.filter.equal[$(this).parent().attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteTokenFilter()
        {        
           return $.ajax2({ data: getSiteTokenFilterParameters(), 
                            url:"{url_to('users_ajax',['action'=>'ListPartialToken'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",
                            target: "#actions"
                             });
        }
    
        function updateSitePager(n)
        {
           var page_active=$(".UserToken-pager .UserToken-active").html()?parseInt($(".UserToken-pager .UserToken-active").html()):1;
           records_by_page=$("[name=UserToken-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".UserToken-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#UserToken-nb_results").html())-n;
           $("#UserToken-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#UserToken-end_result").html($(".Token-count:last").html());
        }                    
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#UserToken-init").click(function() {                
               $.ajax2({ url:"{url_to('users_ajax',['action'=>'ListPartialToken'])}",
                         errorTarget: ".site-errors",
                         loading: "#tab-site-dashboard-x-settings-loading",                         
                         target: "#actions"}); 
           }); 
    
          $('.UserToken-order').click(function() {
                $(".UserToken-order_active").attr('class','UserToken-order');
                $(this).attr('class','UserToken-order_active');
                return updateSiteTokenFilter();
           });
           
            $(".UserToken-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteTokenFilter();
            });
            
          $("#UserToken-filter").click(function() { return updateSiteTokenFilter(); }); 
          
          $("[name=UserToken-nbitemsbypage],.UserToken-equal.Select").change(function() { return updateSiteTokenFilter(); }); 
          
           
           $(".UserToken-pager").click(function () {                     
                return $.ajax2({ data: getSiteTokenFilterParameters(), 
                                 url:"{url_to('users_ajax',['action'=>'ListPartialToken'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 target: "#actions"
                });
        });
           

 
</script>       