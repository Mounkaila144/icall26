{messages class="site-errors"}
<h3>{__('Product')}</h3>    
<div>
    <a href="#" class="btn" id="Product-New" title="{__('new product')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>{*<img  src="{url('/icons/new.gif','picture')}" alt="{__('new')}"/>*}{__('New product')}</a>     
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="Product"}
<button id="Product-filter" class="btn-table">{__("Filter")}</button> 
<button id="Product-init" class="btn-table">{__("Init")}</button>
 <table cellpadding="0" cellspacing="0" class="tabl-list footable table">  
     <thead> 
    <tr  class="list-header">     
    <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}
        <th>
            <span>{__('id')|capitalize}</span>
            <div>
                <a href="#" class="Product-order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="Product-order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>       
        <th class="footable-first-column" data-toggle="true">
            <span>{__('reference')|capitalize}</span>          
        </th>
         <th data-hide="phone" style="display: table-cell;" >
            <span>{__('title')|capitalize}</span>               
        </th>
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('price')|capitalize}</span>  

        </th>        
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('state')|capitalize}</span>          
        </th>
        <th data-hide="phone" style="display: table-cell;">{__('actions')|capitalize}</th>
    </tr>
</thead>
    {* search/equal/range *}
     <tr class="input-list">
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
    <tr class="Product list" id="Product-{$item->get('id')}"> 
        <td class="Product-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            {if $pager->getNbItems()>5}
                <td>                           
                    <input class="Product-selection" type="checkbox" id="{$item->get('id')}" name="{$item->get('name')}"/>                      
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
                <a href="#" title="{__('Edit')}" class="Product-View" id="{$item->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("Edit")}'/></a>                 
                      <a href="#" title="{__('Documents')}" class="Product-Documents" id="{$item->get('id')}">
                     <img  src="{url('/icons/doc16x16.png','picture')}" alt='{__("Documents")}'/></a>
                <a href="#" title="{__('Delete')}" class="Product-Delete" id="{$item->get('id')}"  name="{$item->get('meta_title')}">
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
        <input type="checkbox" id="Product-all" /> 
          <a style="opacity:0.5" class="Product-actions_items" href="#" title="{__('delete')}" id="Product-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="Product"} 
  
<script type="text/javascript">
   
	 // $('.footable').footable();
	
        function getSiteProductFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: { 
                                         name : $("[name=Product-name] option:selected").val()  
                                    },
                                lang: $("img.Product").attr('id'),                                                                                                               
                                nbitemsbypage: $("[name=Product-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".Product-order_active").attr("name"))
                 params.filter.order[$(".Product-order_active").attr("name")] =$(".Product-order_active").attr("id");   
            $(".Product-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteProductFilter()
        {
           $(".-dialogs").dialog("destroy").remove();   
           return $.ajax2({ data: getSiteProductFilterParameters(), 
                            url:"{url_to('products_ajax',['action'=>'ListPartialProduct'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",
                            target: "#actions"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".Product-pager .Product-active").html()?parseInt($(".Product-pager .Product-active").html()):1;
           records_by_page=$("[name=Product-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".Product-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#Product-nb_results").html())-n;
           $("#Product-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#Product-end_result").html($(".Product-count:last").html());
        }
                   
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#Product-init").click(function() {   
               $(".-dialogs").dialog("destroy").remove();   
               $.ajax2({ url:"{url_to('products_ajax',['action'=>'ListPartialProduct'])}",
                         errorTarget: ".site-errors",
                         loading: "#tab-site-dashboard-x-settings-loading",                         
                         target: "#actions"}); 
           }); 
    
          $('.Product-order').click(function() {
                $(".Product-order_active").attr('class','Product-order');
                $(this).attr('class','Product-order_active');
                return updateSiteProductFilter();
           });
           
            $(".Product-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteProductFilter();
            });
            
          $("#Product-filter").click(function() { return updateSiteProductFilter(); }); 
          
          $("[name=Product-nbitemsbypage]").change(function() { return updateSiteProductFilter(); }); 
          
         // $("[name=Product-name]").change(function() { return updateSiteProductFilter(); }); 
           
           $(".Product-pager").click(function () {      
                $(".-dialogs").dialog("destroy").remove();   
                return $.ajax2({ data: getSiteProductFilterParameters(), 
                                 url:"{url_to('products_ajax',['action'=>'ListPartialProduct'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 target: "#actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#Product-New").click( function () { 
            $(".dialogs").dialog("destroy").remove();      
            return $.ajax2({                    
                url: "{url_to('products_ajax',['action'=>'NewProduct'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         });
         
         $(".Product-View").click( function () {                    
                return $.ajax2({ data : { Product : $(this).attr('id') },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('products_ajax',['action'=>'ViewProduct'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
                     
         
          $(".Product-Delete").click( function () { 
                if (!confirm('{__("Product \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ Product: $(this).attr('id') },
                                 url :"{url_to('products_ajax',['action'=>'DeleteProduct'])}",
                                 errorTarget: ".site-errors",    
                                 loading: "#tab-site-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='delete')
                                       {    
                                          $("tr#Product-"+resp.id).remove();  
                                          if ($('.Product').length==0)
                                              return $.ajax2({ url:"{url_to('products_ajax',['action'=>'ListPartialProduct'])}",
                                                               errorTarget: ".site-errors",
                                                               target: "#tab-dashboard-site-x-settings"});
                                          updateSitePager(1);
                                        }       
                                 }
                     });                                        
            });
            
         $(".Product-Documents").click( function () {                    
                return $.ajax2({ data : { Product : $(this).attr('id') },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('products_documents_ajax',['action'=>'ListProductDocument'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
 
  $("#Product-Import").click( function () { 
                return $.ajax2({
                    url: "{url_to('products_ajax',['action'=>'ImportProduct'])}",
                    errorTarget: ".site-errors",
                    target: "#actions"
               });
          });  
 </script>    