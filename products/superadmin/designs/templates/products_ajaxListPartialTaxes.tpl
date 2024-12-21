{messages class="{$site->getSiteID()}-site-errors"}
<h3>{__('Taxes')}</h3>    
<div>
  <a href="#" id="{$site->getSiteID()}-Tax-New" title="{__('new tax')}" ><img  src="{url('/icons/new.gif','picture')}" alt="{__('new')}"/>{__('New tax')}</a>   

</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="`$site->getSiteID()`-Tax"}
<button id="{$site->getSiteID()}-Tax-filter">{__("Filter")}</button> 
<button id="{$site->getSiteID()}-Tax-init">{__("Init")}</button>
 <table cellpadding="0" cellspacing="0">     
    <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}
        <th>
            <span>{__('id')|capitalize}</span>             
        </th>       
        <th>
            <span>{__('name')|capitalize}</span>          
        </th>
         <th>
            <span>{__('rate')|capitalize}</span>               
        </th>        
        <th>{__('actions')|capitalize}</th>
    </tr> 
    {* search/equal/range *}
     <tr>
       <td>{* # *}</td>
       {if $pager->getNbItems()>5}<td></td>{/if}
       <td>{* id *}</td>
       <td>{* name *}</td>         
        <td>{* rate *}</td> 
       <td>{* actions *}</td>
    </tr>
        {foreach $pager as $item}
    <tr class="{$site->getSiteID()}-Tax" id="{$site->getSiteID()}-Tax-{$item->get('id')}"> 
        <td class="{$site->getSiteID()}-Tax-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            {if $pager->getNbItems()>5}
                <td>                           
                    <input class="{$site->getSiteID()}-Tax-selection" type="checkbox" id="{$item->get('id')}" name="{$item->get('description')}"/>                      
                </td>
            {/if}
            <td><span>{$item->get('id')}</span></td>
            <td>                
                    {$item->get('description')}
            </td>
            <td> 
                {format_pourcentage($item->get('rate'))}
            </td>            
            <td>               
                <a href="#" title="{__('Edit')}" class="{$site->getSiteID()}-Tax-View" id="{$item->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("Edit")}'/></a>                 
                <a href="#" title="{__('Delete')}" class="{$site->getSiteID()}-Tax-Delete" id="{$item->get('id')}"  name="{$item->get('meta_title')}">
                   <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
                </a>               
            </td>
    </tr>    
    {/foreach}  
</table>    
 {if !$pager->getNbItems()}
     <span>{__('No tax')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="{$site->getSiteID()}-Tax-all" /> 
          <a style="opacity:0.5" class="{$site->getSiteID()}-Tax-actions_items" href="#" title="{__('delete')}" id="Tax-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="`$site->getSiteID()`-Tax"} 
  
<script type="text/javascript">
    
        function getSite{$site->getSiteKey()}TaxFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: { 
                                         name : $("[name={$site->getSiteID()}-Tax-name] option:selected").val()  
                                    },
                                lang: $("img.{$site->getSiteID()}-Tax").attr('id'),                                                                                                               
                                nbitemsbypage: $("[name={$site->getSiteID()}-Tax-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".{$site->getSiteID()}-Tax-order_active").attr("name"))
                 params.filter.order[$(".{$site->getSiteID()}-Tax-order_active").attr("name")] =$(".{$site->getSiteID()}-Tax-order_active").attr("id");   
            $(".{$site->getSiteID()}-Tax-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSite{$site->getSiteKey()}TaxFilter()
        {
           $(".{$site->getSiteKey()}-dialogs").dialog("destroy").remove();   
           return $.ajax2({ data: getSite{$site->getSiteKey()}TaxFilterParameters(), 
                            url:"{url_to('products_ajax',['action'=>'ListPartialTax'])}" , 
                            errorTarget: ".{$site->getSiteID()}-site-errors",
                            loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                            target: "#{$site->getSiteID()}-actions"
                             });
        }
    
        function updateSite{$site->getSiteKey()}Pager(n)
        {
           page_active=$(".{$site->getSiteID()}-Tax-pager .Tax-active").html()?parseInt($(".{$site->getSiteID()}-Tax-pager .Tax-active").html()):1;
           records_by_page=$("[name={$site->getSiteID()}-Tax-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".{$site->getSiteID()}-Tax-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#{$site->getSiteID()}-Tax-nb_results").html())-n;
           $("#{$site->getSiteID()}-Tax-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#{$site->getSiteID()}-Tax-end_result").html($(".{$site->getSiteID()}-Tax-count:last").html());
        }
                   
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#{$site->getSiteID()}-Tax-init").click(function() {                
               $.ajax2({ url:"{url_to('products_ajax',['action'=>'ListPartialTaxes'])}",
                         errorTarget: ".{$site->getSiteID()}-site-errors",
                         loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",                         
                         target: "#{$site->getSiteID()}-actions"}); 
           }); 
    
          $('.{$site->getSiteID()}-Tax-order').click(function() {
                $(".{$site->getSiteID()}-Tax-order_active").attr('class','{$site->getSiteID()}-Tax-order');
                $(this).attr('class','{$site->getSiteID()}-Tax-order_active');
                return updateSite{$site->getSiteKey()}TaxFilter();
           });
           
            $(".{$site->getSiteID()}-Tax-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSite{$site->getSiteKey()}TaxFilter();
            });
            
          $("#{$site->getSiteID()}-Tax-filter").click(function() { return updateSite{$site->getSiteKey()}TaxFilter(); }); 
          
          $("[name={$site->getSiteID()}-Tax-nbitemsbypage]").change(function() { return updateSite{$site->getSiteKey()}TaxFilter(); }); 
          
         // $("[name=Tax-name]").change(function() { return updateSite{$site->getSiteKey()}TaxFilter(); }); 
           
           $(".{$site->getSiteID()}-Tax-pager").click(function () {                    
                return $.ajax2({ data: getSite{$site->getSiteKey()}TaxFilterParameters(), 
                                 url:"{url_to('products_ajax',['action'=>'ListPartialTaxes'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".{$site->getSiteID()}-site-errors",
                                 loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                 target: "#{$site->getSiteID()}-actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#{$site->getSiteID()}-Tax-New").click( function () {            
            return $.ajax2({                    
                url: "{url_to('products_ajax',['action'=>'NewTaxes'])}",
                errorTarget: ".{$site->getSiteID()}-site-errors",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                target: "#{$site->getSiteID()}-actions"
           });
         });
         
         $(".{$site->getSiteID()}-Tax-View").click( function () {                    
                return $.ajax2({ data : { Tax : $(this).attr('id') },
                                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                url:"{url_to('products_ajax',['action'=>'ViewTax'])}",
                                errorTarget: ".{$site->getSiteID()}-site-errors",
                                target: "#{$site->getSiteID()}-actions"});
         });
                     
         
          $(".{$site->getSiteID()}-Tax-Delete").click( function () { 
                if (!confirm('{__("Tax \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ Tax: $(this).attr('id') },
                                 url :"{url_to('products_ajax',['action'=>'DeleteTax'])}",
                                 errorTarget: ".{$site->getSiteID()}-site-errors",    
                                 loading: "#tab-site-{$site->getSiteID()}-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='delete')
                                       {    
                                          $("tr#{$site->getSiteID()}-Tax-"+resp.id).remove();  
                                          if ($('.{$site->getSiteID()}-Tax').length==0)
                                              return $.ajax2({ url:"{url_to('products_ajax',['action'=>'ListPartialTaxes'])}",
                                                               errorTarget: ".{$site->getSiteID()}-site-errors",
                                                               target: "#tab-{$site->getSiteID()}-dashboard-site-x-settings"});
                                          updateSite{$site->getSiteKey()}Pager(1);
                                        }       
                                 }
                     });                                        
            });
            
      
 
 </script>    