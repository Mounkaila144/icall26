<div style="height: 15px; width: 15px"><img id="dialogListFilterMultipleSites-loading" style="display:none;" src="{url('/icons/loader.gif','picture')}" alt="loader"/></div>
{messages class="dialogListFilterMultipleSites-errors"}
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="dialogListFilterMultipleSites"}
<button id="dialogListFilterMultipleSites-filter">{__("Filter")}</button>   <button id="dialogListFilterMultipleSites-init">{__("Init")}</button>
<table id="dialogListFilterMultipleSites-Pager" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
    <tr>
        <th>#</th>
         
            <th>
            <span>{__('id')|capitalize}</span>
                        </th>
 
            <th>
            <span>{__('host')|capitalize}</span>
                        </th>
 
            <th>
            <span>{__('name')|capitalize}</span>
                        </th>
    <tr>
        <td></td>
        {if $pager->getNbItems()>5}<td></td>{/if}
                     <td>
            </td>
                     <td>
            </td>
                     <td>
            </td>
            </tr>       
    {foreach $pager as $item}
    <tr class="dialogListFilterMultipleSites{if in_array($item->get('site_id'),(array)$formFilter.selected->getValue())} selected{/if}" id="{$item->get('site_id')}">
        <td class="dialogListFilterMultipleSites-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
                <td title="{$item->get('site_id')}" name="id">
            <span>{$item->get('site_id')|escape|truncate:20}</span>
   
        </td>
                <td title="{$item->get('site_host')}">
            <span>{$item->get('site_host')}</span>
   
        </td>
                <td title="{$item->get('name')}" name="name">
            <span>{$item->get('name')|escape}</span>
   
        </td>
            </tr>
    {/foreach}
</table>
{if !$pager->getNbItems()}  
    {__("no result")}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="dialogListFilterMultipleSites"}

<script type="text/javascript">
              
        function getDialogListFilterMultipleSitesFilterParameters()
        {
            var params={   
                      filter: {      selected: $("#dialogListFilterMultipleSites").data("selected"),  
                                     order : { }, 
                                     equal : { },
                                     search: { },
                                     nbitemsbypage: $("[name=dialogListFilterMultipleSites-nbitemsbypage]").val(),
                                     token:'{$formFilter->getCSRFToken()}'
                                  }};
          //  if ($(".order_active").attr("name"))
          //       params.filter.order[$(".order_active").attr("name")] =$(".order_active").attr("id");
          //  $(".search").each(function(id) { params.filter.search[this.name] =this.value; });                               
            return params;                  
        }
        
        function updateDialogListFilterMultipleSitesFilter()
        {
          return $.ajax2({ 
              loading: "#dialogListFilterMultipleSites-loading",
              errorTarget:".dialogListFilterMultipleSites-errors",
              data: getDialogListFilterMultipleSitesFilterParameters(), 
              url:"{url_to('sites_ajax',['action'=>'DialogListFilterMultipleSites'])}", 
              target: "#dialogListFilterMultipleSites" });  
        }
        
        function updateDialogListFilterMultipleSitesPager(n)
        {
           page_active=$(".dialogListFilterMultipleSites-pager .active").html()?parseInt($(".dialogListFilterMultipleSites-pager .active").html()):1;
           records_by_page=$("[name=dialogListFilterMultipleSites-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".dialogListFilterMultipleSites-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#dialogListFilterMultipleSites-nb_results").html())-n;
           $("#dialogListFilterMultipleSites-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#dialogListFilterMultipleSites-end_result").html($(".dialogListFilterMultipleSites-count:last").html());
        }
        
 {JqueryScriptsReady}   
 
        $("#dialogListFilterMultipleSites").data("selected",{$formFilter.selected->JSON()});
  
        $("[name=dialogListFilterMultipleSites-nbitemsbypage]").change(function() { return updateDialogListFilterMultipleSitesFilter(); }); 
        
        $("#dialogListFilterMultipleSites-filter").click(function() { return updateDialogListFilterMultipleSitesFilter(); }); 

        $("#dialogListFilterMultipleSites-init").click(function() { 
           $.ajax2({ 
               data : { filter: { selected: $("#dialogListFilterMultipleSites").data("selected"),token:'{$formFilter->getCSRFToken()}' } },
               errorTarget:".dialogListFilterMultipleSites-errors",
               loading: "#dialogListFilterMultipleSites-loading",
               url:"{url_to('sites_ajax',['action'=>'DialogListFilterMultipleSites'])}",
               target: "#dialogListFilterMultipleSites"}); 
        }); 

        $(".dialogListFilterMultipleSites").click(function () {             
            var selected=$("#dialogListFilterMultipleSites").data("selected");
            $(this).toggleClass('selected');
            if ($(this).hasClass('selected'))
               selected.push($(this).attr("id"));   
            else
               selected.splice($.inArray($(this).attr("id"),selected),1);                         
            $("#dialogListFilterMultipleSites").data("selected",selected);          
        });
        
        $(".dialogListFilterMultipleSites-pager").click(function () {                
             return $.ajax2({                  
                  loading: "#loadingDialogListFilterMultipleSites",
                  errorTarget:".dialogListFilterMultipleSites-errors",
                  data: getDialogListFilterMultipleSitesFilterParameters(), 
                  url:"{url_to('sites_ajax',['action'=>'DialogListFilterMultipleSites'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                  target: "#dialogListFilterMultipleSites"});
        });
   {/JqueryScriptsReady}         
</script>

