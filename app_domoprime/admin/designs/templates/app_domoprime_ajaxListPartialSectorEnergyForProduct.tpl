{messages class="site-errors"}
<h3>{__('Pricing for product for zone and energy [%s]',$product->get('meta_title'))}</h3>  
{if $product->isLoaded()}
<div>
  <a href="#" class="btn" id="DomoprimeSectorEnergyProduct-New" title="{__('New price')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>{__('New price')}</a>     
  <a href="#" id="DomoprimeSectorEnergyProduct-Cancel" class="btn"><i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="DomoprimeSectorEnergyProduct"}
<button id="DomoprimeSectorEnergyProduct-filter" class="btn-table">{__("Filter")}</button>   <button id="DomoprimeSectorEnergyProduct-init" class="btn-table">{__("Init")}</button>
<div  class="containerDivResp">
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0">  
    <thead>
    <tr class="list-header">    
    <th>#</th>
        <th>&nbsp;</th>            
        <th class="footable-first-column" data-toggle="true">
            <span>{__('Zone')}</span>                
        </th>      
           <th data-hide="phone" style="display: table-cell;">
            <span>{__('Energy')}</span>      
           
        </th> 
 <th data-hide="phone" style="display: table-cell;">
            <span>{__('Price')}</span>      
           
        </th>         
        <th data-hide="phone" style="display: table-cell;">{__('actions')|capitalize}</th>
    </tr> 
</thead>
    {* search/equal/range *}
     <tr class="input-list">
       <td>{* # *}</td>
  <td></td> 
       <td>{* name *}</td>
       <td>{* value *}</td>      
        <td>{* value *}</td>      
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="DomoprimeSectorEnergyProduct list" {if $item->hasI18n()}id="DomoprimeSectorEnergyProduct-{$item->getI18n()->get('id')}"{/if} name="DomoprimeSectorEnergyProduct-{$item->get('id')}"> 
        <td class="DomoprimeSectorEnergyProduct-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
           
                <td>                          
                </td>
               <td>        
                    {$item->getSector()->get('name')}
                </td>
            <td>                    
                {if $item->getEnergy()->hasI18n()}
                        {$item->getEnergy()->getI18n()->get('value')}     
                {else}
                    {__('---')}
                {/if}    
            </td>                 
            <td>
                 {$item->get('price')}   
            </td>            
            <td>               
                <a href="#" title="{__('edit')}" class="DomoprimeSectorEnergyProduct-View" id="{$item->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a> 
                <a href="#" title="{__('delete')}" class="DomoprimeSectorEnergyProduct-Delete" id="{$item->get('id')}"  name="">
                   <img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/>
                </a>                
            </td>
    </tr>    
    {/foreach}    
</table>   
</div>
{if !$pager->getNbItems()}
     <span>{__('No price')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="DomoprimeSectorEnergyProduct-all" /> 
          <a style="opacity:0.5" class="DomoprimeSectorEnergyProduct-actions_items" href="#" title="{__('Delete')}" id="DomoprimeSectorEnergyProduct-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="DomoprimeSectorEnergyProduct"}
<script type="text/javascript">
 
        function getSiteDomoprimeSectorEnergyProductFilterParameters()
        {
            var params={   Product : '{$product->get('id')}',
                           filter: {  order : { }, 
                                    search : { },
                                    equal: {  },                                
                                nbitemsbypage: $("[name=DomoprimeSectorEnergyProduct-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".DomoprimeSectorEnergyProduct-order_active").attr("name"))
                 params.filter.order[$(".DomoprimeSectorEnergyProduct-order_active").attr("name")] =$(".DomoprimeSectorEnergyProduct-order_active").attr("id");   
            $(".DomoprimeSectorEnergyProduct-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteDomoprimeSectorEnergyProductFilter()
        {           
           return $.ajax2({ data: getSiteDomoprimeSectorEnergyProductFilterParameters(), 
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialSectorEnergyForProduct'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",
                            target: "#actions"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".DomoprimeSectorEnergyProduct-pager .DomoprimeSectorEnergyProduct-active").html()?parseInt($(".DomoprimeSectorEnergyProduct-pager .DomoprimeSectorEnergyProduct-active").html()):1;
           records_by_page=$("[name=DomoprimeSectorEnergyProduct-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".DomoprimeSectorEnergyProduct-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#DomoprimeSectorEnergyProduct-nb_results").html())-n;
           $("#DomoprimeSectorEnergyProduct-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#DomoprimeSectorEnergyProduct-end_result").html($(".DomoprimeSectorEnergyProduct-count:last").html());
        }
        
          
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomoprimeSectorEnergyProduct-init").click(function() {   
             
               $.ajax2({ data : { Product : '{$product->get('id')}' },
                         url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialSectorEnergyForProduct'])}",
                         errorTarget: ".site-errors",
                         loading: "#tab-site-dashboard-x-settings-loading",                         
                         target: "#actions"}); 
           }); 
    
          $('.DomoprimeSectorEnergyProduct-order').click(function() {
                $(".DomoprimeSectorEnergyProduct-order_active").attr('class','DomoprimeSectorEnergyProduct-order');
                $(this).attr('class','DomoprimeSectorEnergyProduct-order_active');
                return updateSiteDomoprimeSectorEnergyProductFilter();
           });
           
            $(".DomoprimeSectorEnergyProduct-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteDomoprimeSectorEnergyProductFilter();
            });
            
          $("#DomoprimeSectorEnergyProduct-filter").click(function() { return updateSiteDomoprimeSectorEnergyProductFilter(); }); 
          
          $("[name=DomoprimeSectorEnergyProduct-nbitemsbypage]").change(function() { return updateSiteDomoprimeSectorEnergyProductFilter(); }); 
          
         // $("[name=DomoprimeSectorEnergyProduct-name]").change(function() { return updateSiteDomoprimeSectorEnergyProductFilter(); }); 
           
           $(".DomoprimeSectorEnergyProduct-pager").click(function () {      
               
                return $.ajax2({ data: getSiteDomoprimeSectorEnergyProductFilterParameters(), 
                                 url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialSectorEnergyForProduct'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 target: "#actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#DomoprimeSectorEnergyProduct-New").click( function () { 
            
            return $.ajax2({
                data : { Product: '{$product->get('id')}' },                
                url: "{url_to('app_domoprime_ajax',['action'=>'NewSectorEnergyPriceForProduct'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         });                
         
         $(".DomoprimeSectorEnergyProduct-View").click( function () { 
                  
                return $.ajax2({ data : { DomoprimeSectorEnergyProduct : $(this).attr('id')   },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('app_domoprime_ajax',['action'=>'ViewSectorEnergyPriceForProduct'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
                    
         
          $(".DomoprimeSectorEnergyProduct-Delete").click( function () { 
                if (!confirm('{__("Status \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ DomoprimeSectorEnergyProductI18n: $(this).attr('id') },
                                 url :"{url_to('app_domoprime_ajax',['action'=>'DeleteEnergyI18n'])}",
                                 errorTarget: ".site-errors",     
                                 loading: "#tab-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='DeleteEnergyI18n')
                                       {    
                                          $("tr#DomoprimeSectorEnergyProduct-"+resp.id).remove();  
                                          if ($('.DomoprimeSectorEnergyProduct').length==0)
                                              return $.ajax2({ url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialEnergy'])}",
                                                               errorTarget: ".site-errors",
                                                               target: "#tab-dashboard-x-settings"});
                                          updateSitePager(1);
                                        }       
                                 }
                     });                                        
            });
    
     $("#DomoprimeSectorEnergyProduct-all").click(function () {                
               $(".DomoprimeSectorEnergyProduct-selection").prop("checked",$(this).prop("checked"));             
               $(".DomoprimeSectorEnergyProduct-actions_items").css('opacity',($(this).prop("checked")?'1':'0.5'));
          });
    
    $(".DomoprimeSectorEnergyProduct-selection").click(function (){               
                $(".DomoprimeSectorEnergyProduct-actions_items").css('opacity',($(".DomoprimeSectorEnergyProduct-selection:checked").length?'1':'0.5'));
          });
          
    $("#DomoprimeSectorEnergyProduct-Delete").click( function () { 
             var params={ selection : {  } };
             text="";
             $(".DomoprimeSectorEnergyProduct-selection:checked").each(function (id) { 
                params.selection[id]=this.id;
                text+=this.name+",\n";
             });
             if ($.isEmptyObject(params.selection))
                return ;
             if (!confirm('{__('Status \u000A\u000A"#0#"\u000A\u000A will be deleted. Confirm ?')}'.format(text.substring(0,text.lastIndexOf(","))))) 
                 return false; 
             return $.ajax2({ 
                     data: params,                     
                     url: "{url_to('app_domoprime_ajax',['action'=>'DeletesEnergy'])}",
                     errorTarget: ".site-errors",     
                     loading: "#tab-site-x-settings-loading",
                     success: function(resp) {
                            if (resp.action=='DeletesEnergy')
                            {   
                                if ($(".DomoprimeSectorEnergyProduct").length-resp.parameters.length==0)
                                {    
                                  return $.ajax2({ url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialEnergy'])}",
                                                   errorTarget: ".dashboard-site-errors",     
                                                    loading: "#tab-site-x-settings-loading",                    
                                                    target: "#actions" });
                                }    
                                $.each(resp.parameters, function () {  $("tr[name=DomoprimeSectorEnergyProduct-"+this+"]").remove(); });
                                updateSitePager(resp.parameters.length); 
                                $("input#DomoprimeSectorEnergyProduct-all").attr("checked",false);                                    
                            }       
                         }
             });
          });
          
    
	    $('#DomoprimeSectorEnergyProduct-Cancel').click(function(){              
             return $.ajax2({ url : "{url_to('products_ajax',['action'=>'ListPartialProduct'])}",
                              errorTarget: ".DomoprimeEnergy-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions"}); 
      }); 
    
</script>    
{else}
    {__('Product is invalid.')}
{/if}    