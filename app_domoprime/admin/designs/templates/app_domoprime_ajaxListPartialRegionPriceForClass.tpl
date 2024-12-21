{messages class="site-errors"}
<h3>{__('Pricing for product for class [%s]',(string)$class->getI18n())}</h3>  
{if $class->isLoaded()}
<div> 
  <a href="#" class="btn" id="DomoprimeRegionPriceClass-New" title="{__('New price')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>{__('New price')}</a>     
  <a href="#" id="DomoprimeRegionPriceClass-Cancel" class="btn"><i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="DomoprimeRegionPriceClass"}
<button id="DomoprimeRegionPriceClass-filter" class="btn-table">{__("Filter")}</button>   <button id="DomoprimeRegionPriceClass-init" class="btn-table">{__("Init")}</button>
<div  class="containerDivResp">
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0">  
    <thead>
    <tr class="list-header">    
    <th>#</th>
        <th>&nbsp;</th>            
        <th class="footable-first-column" data-toggle="true">
            <span>{__('Region')}</span>                
        </th>      
           <th data-hide="phone" style="display: table-cell;">
            <span>{__('Number of people')}</span>      
           
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
    <tr class="DomoprimeRegionPriceClass list" name="DomoprimeRegionPriceClass-{$item->get('id')}"> 
        <td class="DomoprimeRegionPriceClass-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
           
                <td>  
                     
                </td>
               <td>        
                    {if $item->hasRegion()}
                        {$item->getRegion()->get('name')}
                    {else}
                        {__('No region')}
                    {/if}  
                </td>
            <td>                
               {$item->get('number_of_people')}
            </td>                 
            <td>
                 {$item->get('price')}   
            </td>            
            <td>               
                <a href="#" title="{__('edit')}" class="DomoprimeRegionPriceClass-View" id="{$item->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a> 
                <a href="#" title="{__('delete')}" class="DomoprimeRegionPriceClass-Delete" id="{$item->get('id')}"  name="">
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
        <input type="checkbox" id="DomoprimeRegionPriceClass-all" /> 
          <a style="opacity:0.5" class="DomoprimeRegionPriceClass-actions_items" href="#" title="{__('Delete')}" id="DomoprimeRegionPriceClass-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="DomoprimeRegionPriceClass"}
<script type="text/javascript">
 
        function getSiteDomoprimeRegionPriceClassFilterParameters()
        {
            var params={   DomoprimeClass : '{$class->get('id')}',
                           filter: {  order : { }, 
                                    search : { },
                                    equal: {  },                                
                                nbitemsbypage: $("[name=DomoprimeRegionPriceClass-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".DomoprimeRegionPriceClass-order_active").attr("name"))
                 params.filter.order[$(".DomoprimeRegionPriceClass-order_active").attr("name")] =$(".DomoprimeRegionPriceClass-order_active").attr("id");   
            $(".DomoprimeRegionPriceClass-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteDomoprimeRegionPriceClassFilter()
        {           
           return $.ajax2({ data: getSiteDomoprimeRegionPriceClassFilterParameters(), 
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialRegionPriceForClass'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",
                            target: "#actions"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".DomoprimeRegionPriceClass-pager .DomoprimeRegionPriceClass-active").html()?parseInt($(".DomoprimeRegionPriceClass-pager .DomoprimeRegionPriceClass-active").html()):1;
           records_by_page=$("[name=DomoprimeRegionPriceClass-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".DomoprimeRegionPriceClass-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#DomoprimeRegionPriceClass-nb_results").html())-n;
           $("#DomoprimeRegionPriceClass-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#DomoprimeRegionPriceClass-end_result").html($(".DomoprimeRegionPriceClass-count:last").html());
        }
        
          
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomoprimeRegionPriceClass-init").click(function() {   
             
               $.ajax2({ data : { DomoprimeClass : '{$class->get('id')}' },
                         url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialRegionPriceForClass'])}",
                         errorTarget: ".site-errors",
                         loading: "#tab-site-dashboard-x-settings-loading",                         
                         target: "#actions"}); 
           }); 
    
          $('.DomoprimeRegionPriceClass-order').click(function() {
                $(".DomoprimeRegionPriceClass-order_active").attr('class','DomoprimeRegionPriceClass-order');
                $(this).attr('class','DomoprimeRegionPriceClass-order_active');
                return updateSiteDomoprimeRegionPriceClassFilter();
           });
           
            $(".DomoprimeRegionPriceClass-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteDomoprimeRegionPriceClassFilter();
            });
            
          $("#DomoprimeRegionPriceClass-filter").click(function() { return updateSiteDomoprimeRegionPriceClassFilter(); }); 
          
          $("[name=DomoprimeRegionPriceClass-nbitemsbypage]").change(function() { return updateSiteDomoprimeRegionPriceClassFilter(); }); 
          
         // $("[name=DomoprimeRegionPriceClass-name]").change(function() { return updateSiteDomoprimeRegionPriceClassFilter(); }); 
           
           $(".DomoprimeRegionPriceClass-pager").click(function () {      
               
                return $.ajax2({ data: getSiteDomoprimeRegionPriceClassFilterParameters(), 
                                 url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialZoneEnergyForProduct'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 target: "#actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#DomoprimeRegionPriceClass-New").click( function () { 
            
            return $.ajax2({
                data : { DomoprimeClass: '{$class->get('id')}' },                
                url: "{url_to('app_domoprime_ajax',['action'=>'NewRegionPriceForClass'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         });                
         
         $(".DomoprimeRegionPriceClass-View").click( function () { 
                  
                return $.ajax2({ data : { DomoprimeRegionPriceClass : $(this).attr('id')   },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('app_domoprime_ajax',['action'=>'ViewRegionPriceForClass'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
                    
         
          $(".DomoprimeRegionPriceClass-Delete").click( function () { 
                if (!confirm('{__("Status \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ DomoprimeRegionPriceClassI18n: $(this).attr('id') },
                                 url :"{url_to('app_domoprime_ajax',['action'=>'DeleteEnergyI18n'])}",
                                 errorTarget: ".site-errors",     
                                 loading: "#tab-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='DeleteEnergyI18n')
                                       {    
                                          $("tr#DomoprimeRegionPriceClass-"+resp.id).remove();  
                                          if ($('.DomoprimeRegionPriceClass').length==0)
                                              return $.ajax2({ url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialEnergy'])}",
                                                               errorTarget: ".site-errors",
                                                               target: "#tab-dashboard-x-settings"});
                                          updateSitePager(1);
                                        }       
                                 }
                     });                                        
            });
    
     $("#DomoprimeRegionPriceClass-all").click(function () {                
               $(".DomoprimeRegionPriceClass-selection").prop("checked",$(this).prop("checked"));             
               $(".DomoprimeRegionPriceClass-actions_items").css('opacity',($(this).prop("checked")?'1':'0.5'));
          });
    
    $(".DomoprimeRegionPriceClass-selection").click(function (){               
                $(".DomoprimeRegionPriceClass-actions_items").css('opacity',($(".DomoprimeRegionPriceClass-selection:checked").length?'1':'0.5'));
          });
          
    $("#DomoprimeRegionPriceClass-Delete").click( function () { 
             var params={ selection : {  } };
             text="";
             $(".DomoprimeRegionPriceClass-selection:checked").each(function (id) { 
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
                                if ($(".DomoprimeRegionPriceClass").length-resp.parameters.length==0)
                                {    
                                  return $.ajax2({ url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialEnergy'])}",
                                                   errorTarget: ".dashboard-site-errors",     
                                                    loading: "#tab-site-x-settings-loading",                    
                                                    target: "#actions" });
                                }    
                                $.each(resp.parameters, function () {  $("tr[name=DomoprimeRegionPriceClass-"+this+"]").remove(); });
                                updateSitePager(resp.parameters.length); 
                                $("input#DomoprimeRegionPriceClass-all").attr("checked",false);                                    
                            }       
                         }
             });
          });
          
    
	    $('#DomoprimeRegionPriceClass-Cancel').click(function(){              
             return $.ajax2({ url : "{url_to('app_domoprime_ajax',['action'=>'ListPartialClass'])}",
                              errorTarget: ".DomoprimeEnergy-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions"}); 
      }); 
    
</script>    
{else}
    {__('Class is invalid.')}
{/if}    
