{messages class="site-errors"}
<h3>{__('Taxes')}</h3>    
<div>
    <a href="#" id="Tax-New" class="btn" title="{__('new tax')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>{*<img  src="{url('/icons/new.gif','picture')}" alt="{__('new')}"/>*}{__('New tax')}</a>   
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="Tax"}
<button id="Tax-filter" class="btn-table">{__("Filter")}</button> 
<button id="Tax-init" class="btn-table">{__("Init")}</button>
 <table cellpadding="0" cellspacing="0" class="tabl-list footable table">
     <thead>
     <tr class="list-header">    
    <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}
        <th>
            <span>{__('id')|capitalize}</span>             
        </th>       
        <th class="footable-first-column" data-toggle="true">
            <span>{__('name')|capitalize}</span>          
        </th>
         <th data-hide="phone" style="display: table-cell;">
            <span>{__('rate')|capitalize}</span>               
        </th>        
        <th data-hide="phone" style="display: table-cell;">{__('actions')|capitalize}</th>
    </tr> 
</thead>
    {* search/equal/range *}
     <tr class="input-list">
       <td>{* # *}</td>
       {if $pager->getNbItems()>5}<td></td>{/if}
       <td>{* id *}</td>
       <td>{* name *}</td>         
        <td>{* rate *}</td> 
       <td>{* actions *}</td>
    </tr>
        {foreach $pager as $item}
    <tr class="Tax list" id="Tax-{$item->get('id')}"> 
        <td class="Tax-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            {if $pager->getNbItems()>5}
                <td>                           
                    <input class="Tax-selection" type="checkbox" id="{$item->get('id')}" name="{$item->get('description')}"/>                      
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
                <a href="#" title="{__('Edit')}" class="Tax-View" id="{$item->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("Edit")}'/></a>                 
                <a href="#" title="{__('Delete')}" class="Tax-Delete" id="{$item->get('id')}"  name="{$item->get('description')}">
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
        <input type="checkbox" id="Tax-all" /> 
          <a style="opacity:0.5" class="Tax-actions_items" href="#" title="{__('delete')}" id="Tax-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="Tax"} 
  
<script type="text/javascript">
    
        function getSiteTaxFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: { 
                                         name : $("[name=Tax-name] option:selected").val()  
                                    },
                                lang: $("img.Tax").attr('id'),                                                                                                               
                                nbitemsbypage: $("[name=Tax-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".Tax-order_active").attr("name"))
                 params.filter.order[$(".Tax-order_active").attr("name")] =$(".Tax-order_active").attr("id");   
            $(".Tax-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteTaxFilter()
        {
           $(".-dialogs").dialog("destroy").remove();   
           return $.ajax2({ data: getSiteTaxFilterParameters(), 
                            url:"{url_to('products_ajax',['action'=>'ListPartialTaxes'])}" , 
                            errorTarget: ".site-errors",
                             loading: "#tab-site-dashboard-x-settings-loading",  
                            target: "#actions"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".Tax-pager .Tax-active").html()?parseInt($(".Tax-pager .Tax-active").html()):1;
           records_by_page=$("[name=Tax-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".Tax-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#Tax-nb_results").html())-n;
           $("#Tax-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#Tax-end_result").html($(".Tax-count:last").html());
        }
                   
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#Tax-init").click(function() {                
               $.ajax2({ url:"{url_to('products_ajax',['action'=>'ListPartialTaxes'])}",
                         errorTarget: ".site-errors",
                         loading: "#tab-site-dashboard-x-settings-loading",                         
                         target: "#actions"}); 
           }); 
    
          $('.Tax-order').click(function() {
                $(".Tax-order_active").attr('class','Tax-order');
                $(this).attr('class','Tax-order_active');
                return updateSiteTaxFilter();
           });
           
            $(".Tax-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteTaxFilter();
            });
            
          $("#Tax-filter").click(function() { return updateSiteTaxFilter(); }); 
          
          $("[name=Tax-nbitemsbypage]").change(function() { return updateSiteTaxFilter(); }); 
          
         // $("[name=Tax-name]").change(function() { return updateSiteTaxFilter(); }); 
           
           $(".Tax-pager").click(function () {                    
                return $.ajax2({ data: getSiteTaxFilterParameters(), 
                                 url:"{url_to('products_ajax',['action'=>'ListPartialTaxes'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 target: "#actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#Tax-New").click( function () {            
            return $.ajax2({                    
                url: "{url_to('products_ajax',['action'=>'NewTaxes'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         });
         
         $(".Tax-View").click( function () {                    
                return $.ajax2({ data : { Tax : $(this).attr('id') },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('products_ajax',['action'=>'ViewTaxes'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
                     
         
          $(".Tax-Delete").click( function () { 
                if (!confirm('{__("Tax \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ Tax: $(this).attr('id') },
                                 url :"{url_to('products_ajax',['action'=>'DeleteTaxes'])}",
                                 errorTarget: ".site-errors",    
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='deleteTaxes')
                                       {    
                                          $("tr#Tax-"+resp.id).remove();  
                                          if ($('.Tax').length==0)
                                              return $.ajax2({ url:"{url_to('products_ajax',['action'=>'ListPartialTaxes'])}",
                                                               errorTarget: ".site-errors",
                                                               target: "#actions"});
                                          updateSitePager(1);
                                        }       
                                 }
                     });                                        
            });
            
    $('.footable').footable();  
 
 </script>    