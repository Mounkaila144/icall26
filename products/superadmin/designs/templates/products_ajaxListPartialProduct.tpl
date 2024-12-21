{messages class="{$site->getSiteID()}-site-errors"}
<h3>{__('Product')}</h3>    
<div>
  <a href="#" id="{$site->getSiteID()}-Product-New" title="{__('new product')}" ><img  src="{url('/icons/new.gif','picture')}" alt="{__('new')}"/>{__('New product')}</a>   

</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="`$site->getSiteID()`-Product"}
<button id="{$site->getSiteID()}-Product-filter">{__("Filter")}</button> 
<button id="{$site->getSiteID()}-Product-init">{__("Init")}</button>
 <table cellpadding="0" cellspacing="0">     
    <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}
        <th>
            <span>{__('id')|capitalize}</span>
            <div>
                <a href="#" class="{$site->getSiteID()}-Product-order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="{$site->getSiteID()}-Product-order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>       
        <th>
            <span>{__('reference')|capitalize}</span>          
        </th>
         <th>
            <span>{__('title')|capitalize}</span>               
        </th>
        <th>
            <span>{__('price')|capitalize}</span>  

        </th>        
        <th>
            <span>{__('state')|capitalize}</span>          
        </th>
        <th>{__('actions')|capitalize}</th>
    </tr> 
    {* search/equal/range *}
     <tr>
       <td>{* # *}</td>
       {if $pager->getNbItems()>5}<td></td>{/if}
       <td>{* id *}</td>
       <td>{* reference *}</td>
       <td>{* title *}</td>
       <td>{* price *}</td>      
        <td>{* is_active *}</td> 
       <td>{* actions *}</td>
    </tr>
        {foreach $pager as $item}
    <tr class="{$site->getSiteID()}-Product" id="{$site->getSiteID()}-Product-{$item->get('id')}"> 
        <td class="{$site->getSiteID()}-Product-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            {if $pager->getNbItems()>5}
                <td>                           
                    <input class="{$site->getSiteID()}-Product-selection" type="checkbox" id="{$item->get('id')}" name="{$item->get('name')}"/>                      
                </td>
            {/if}
            <td><span>{$item->get('id')}</span></td>
            <td>                
                    {$item->get('reference')}
            </td>
            <td> 
                {$item->get('meta_title')}
            </td>
            <td>{$item->get('price')}
            </td>           
               <td>                
                {$item->get('is_active')}                   
            </td> 
            <td>               
                <a href="#" title="{__('Edit')}" class="{$site->getSiteID()}-Product-View" id="{$item->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("Edit")}'/></a>                 
                <a href="#" title="{__('Delete')}" class="{$site->getSiteID()}-Product-Delete" id="{$item->get('id')}"  name="{$item->get('meta_title')}">
                   <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
                </a>               
            </td>
    </tr>    
    {/foreach}  
</table>    
 {if !$pager->getNbItems()}
     <span>{__('No product')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="{$site->getSiteID()}-Product-all" /> 
          <a style="opacity:0.5" class="{$site->getSiteID()}-Product-actions_items" href="#" title="{__('delete')}" id="Product-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="`$site->getSiteID()`-Product"} 
  
<script type="text/javascript">
    
        function getSite{$site->getSiteKey()}ProductFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: { 
                                         name : $("[name={$site->getSiteID()}-Product-name] option:selected").val()  
                                    },
                                lang: $("img.{$site->getSiteID()}-Product").attr('id'),                                                                                                               
                                nbitemsbypage: $("[name={$site->getSiteID()}-Product-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".{$site->getSiteID()}-Product-order_active").attr("name"))
                 params.filter.order[$(".{$site->getSiteID()}-Product-order_active").attr("name")] =$(".{$site->getSiteID()}-Product-order_active").attr("id");   
            $(".{$site->getSiteID()}-Product-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSite{$site->getSiteKey()}ProductFilter()
        {
           $(".{$site->getSiteKey()}-dialogs").dialog("destroy").remove();   
           return $.ajax2({ data: getSite{$site->getSiteKey()}ProductFilterParameters(), 
                            url:"{url_to('products_ajax',['action'=>'ListPartialProduct'])}" , 
                            errorTarget: ".{$site->getSiteID()}-site-errors",
                            loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                            target: "#{$site->getSiteID()}-actions"
                             });
        }
    
        function updateSite{$site->getSiteKey()}Pager(n)
        {
           page_active=$(".{$site->getSiteID()}-Product-pager .Product-active").html()?parseInt($(".{$site->getSiteID()}-Product-pager .Product-active").html()):1;
           records_by_page=$("[name={$site->getSiteID()}-Product-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".{$site->getSiteID()}-Product-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#{$site->getSiteID()}-Product-nb_results").html())-n;
           $("#{$site->getSiteID()}-Product-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#{$site->getSiteID()}-Product-end_result").html($(".{$site->getSiteID()}-Product-count:last").html());
        }
                   
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#{$site->getSiteID()}-Product-init").click(function() {   
               $(".{$site->getSiteKey()}-dialogs").dialog("destroy").remove();   
               $.ajax2({ url:"{url_to('products_ajax',['action'=>'ListPartialProduct'])}",
                         errorTarget: ".{$site->getSiteID()}-site-errors",
                         loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",                         
                         target: "#{$site->getSiteID()}-actions"}); 
           }); 
    
          $('.{$site->getSiteID()}-Product-order').click(function() {
                $(".{$site->getSiteID()}-Product-order_active").attr('class','{$site->getSiteID()}-Product-order');
                $(this).attr('class','{$site->getSiteID()}-Product-order_active');
                return updateSite{$site->getSiteKey()}ProductFilter();
           });
           
            $(".{$site->getSiteID()}-Product-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSite{$site->getSiteKey()}ProductFilter();
            });
            
          $("#{$site->getSiteID()}-Product-filter").click(function() { return updateSite{$site->getSiteKey()}ProductFilter(); }); 
          
          $("[name={$site->getSiteID()}-Product-nbitemsbypage]").change(function() { return updateSite{$site->getSiteKey()}ProductFilter(); }); 
          
         // $("[name=Product-name]").change(function() { return updateSite{$site->getSiteKey()}ProductFilter(); }); 
           
           $(".{$site->getSiteID()}-Product-pager").click(function () {      
                $(".{$site->getSiteKey()}-dialogs").dialog("destroy").remove();   
                return $.ajax2({ data: getSite{$site->getSiteKey()}ProductFilterParameters(), 
                                 url:"{url_to('products_ajax',['action'=>'ListPartialProduct'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".{$site->getSiteID()}-site-errors",
                                 loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                 target: "#{$site->getSiteID()}-actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#{$site->getSiteID()}-Product-New").click( function () { 
            $(".{$site->getSiteID()}-dialogs").dialog("destroy").remove();      
            return $.ajax2({                    
                url: "{url_to('products_ajax',['action'=>'NewProduct'])}",
                errorTarget: ".{$site->getSiteID()}-site-errors",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                target: "#{$site->getSiteID()}-actions"
           });
         });
         
         $(".{$site->getSiteID()}-Product-View").click( function () {                    
                return $.ajax2({ data : { Product : $(this).attr('id') },
                                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                url:"{url_to('products_ajax',['action'=>'ViewProduct'])}",
                                errorTarget: ".{$site->getSiteID()}-site-errors",
                                target: "#{$site->getSiteID()}-actions"});
         });
                     
         
          $(".{$site->getSiteID()}-Product-Delete").click( function () { 
                if (!confirm('{__("Product \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ Product: $(this).attr('id') },
                                 url :"{url_to('products_ajax',['action'=>'DeleteProduct'])}",
                                 errorTarget: ".{$site->getSiteID()}-site-errors",    
                                 loading: "#tab-site-{$site->getSiteID()}-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='delete')
                                       {    
                                          $("tr#{$site->getSiteID()}-Product-"+resp.id).remove();  
                                          if ($('.{$site->getSiteID()}-Product').length==0)
                                              return $.ajax2({ url:"{url_to('products_ajax',['action'=>'ListPartialProduct'])}",
                                                               errorTarget: ".{$site->getSiteID()}-site-errors",
                                                               target: "#tab-{$site->getSiteID()}-dashboard-site-x-settings"});
                                          updateSite{$site->getSiteKey()}Pager(1);
                                        }       
                                 }
                     });                                        
            });
            
      
 
 </script>    