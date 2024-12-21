 {component name="/site/sublink"} 
{messages class="SystemMenu-errors"}

<h3>{__("Menus")}</h3>
 {if !$node->isRoot()}
        <a class="btn btn-primary " href="#" id="Cancel">
            <i class="fa fa-times " style="margin-right:10px;"></i>{__('Cancel')}
           
        </a>
{/if}
  {if $node->length() > 1}
            <a class="btn btn-primary "  id="Positions"  href="#">
                <i class="fa fa-bars" style="margin-right: 5px;"></i> {__('Positions')}
               
            </a>
        {/if}    
 {include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="SystemMenu"}
 
<div class="containerDivResp">
<table class="table-bordered table" style="width: 50%;" id="SystemMenu" cellpadding="0" cellspacing="0" >
         <thead>
             <tr class="list-header" style="text-align: center;">                  
                    <th>{__('id')}</th>
                    <th>{__('Menu')}</th>
                     <th>{__('Title')}</th>
                    
                     <th>{__('Actions')}</th>
                    
                </tr>
            </thead>
            <tbody style="cursor: grab;">
        {foreach $pager as $item}
           <tr id="{$item->get('id')}" class="ui-function-default SystemMenu">
                <td class="position">{$item->get('id')}</td>
                <td>
                   {$item->get('name')} 
                </td>
                  <td>
                 {if $item->hasI18n()}{__($item->getI18n())}{/if} 
                </td>
                 
                 <td>
                  <a href="#" title="{__('edit')}" class="SystemMenu-View" id="{$item->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a> 
                      
                     {if $item->hasChildren()}
                       <a href="#" title="{__('edit')}" class="SystemMenu-menus" id="{$item->get('id')}">
                     <i class="fa fa-list"/></a> 
                      {/if}
                </td>
            </tr>     
            
        {/foreach} 
            </tbody>
    </table>
 </div>
   {include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="SystemMenu"} 
<script type="text/javascript">
       
         $(".SystemMenu-View").click( function () {                
                return $.ajax2({ data : { SystemMenuI18n : { 
                                                menu_id: $(this).attr('id'),
                                                lang:'fr'                                              
                                    } },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('dashboard_ajax',['action'=>'ViewSystemMenuI18n'])}",
                                errorTarget: ".SystemMenu-errors",
                                target: "#tab-dashboard-x-settings"});
         });
         
         
         
          $(".SystemMenu-menus").click( function () {                    
                  return $.ajax2({  data : { SystemMenuNode : { 
                                                node: $(this).attr('id'),
                                                lang: 'fr',
                                                token : '{mfForm::getToken('SystemMenuNodeForm')}'
                                    } },                            
                                  url:"{url_to('dashboard_ajax',['action'=>'ListPartialMenu'])}", 
                                  errorTarget: ".SystemMenu-errors",
                                target: "#tab-dashboard-x-settings"});
     });
      $("#Cancel").click( function () {                    
                  return $.ajax2({  data : { SystemMenuNode : { 
                                                node: $(this).attr('id'),
                                                lang: 'fr',
                                                token : '{mfForm::getToken('SystemMenuNodeForm')}'
                                    } },                            
                                  url:"{url_to('dashboard_ajax',['action'=>'ListPartialMenu'])}", 
                                  errorTarget: ".SystemMenu-errors",
                                   target: "#tab-dashboard-x-settings"});
     });
    
     function getFilterParameters()
        {
            var params={ SystemMenuNode : { node: '{$node->get('id')}', 
                                             lang :'fr', 
                                             token : '{mfForm::getToken('SystemMenuNodeForm')}' },
                          filter: {  order : { }, 
                                    search : { },
                                    equal: {
                                          //  is_active:$(".equal[name=is_active] option:selected").val(),
                                        },         
                                    range: { },  
                                nbitemsbypage: $("[name=SystemMenu-nbitemsbypage]").val(),                              
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            /* if($(".order_active").attr("name"))
                 params.filter.order[$(".order_active").attr("name")] =$(".order_active").attr("id");
            
            $(".search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });
            $(".equal option:selected").each(function() { params.filter.equal[$(this).parent().attr('name')] =$(this).val(); });
            $(".Range.Date").each(function () {
                if(!params.filter.range[$(this).attr('name')])
                    params.filter.range[$(this).attr('name')]= { };
                params.filter.range[$(this).attr('name')][$(this).attr('date-id')]= $(this).val();
            });*/
            return params;                  
        }
        
        function updateFilter()
        {          
           return $.ajax2({ data: getFilterParameters(), 
                            url:"{url_to('dashboard_ajax',['action'=>'ListPartialMenu'])}" ,
                              target: "#tab-dashboard-x-settings"});
        }
        
        function updatePager(n)
        {
           page_active=$(".pager .active").html()?parseInt($(".pager .active").html()):1;
           records_by_page=$("[name=nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#nb_results").html())-n;
           $("#nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#end_result").html($(".count:last").html());
        } 
        
        
            $(".SystemMenu-pager").click(function () {             
                return $.ajax2({ data: getFilterParameters(), 
                                 url:"{url_to('dashboard_ajax',['action'=>'ListPartialMenu'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".SystemMenu-errors",
                                 target: "#tab-dashboard-x-settings"});
                });
     
     
     $("[name=SystemMenu-nbitemsbypage]").change(function() { return updateFilter(); }); 
     
     
     {if !$node->isRoot()}     
 $("#Cancel").off('click');
   $('#Cancel').click(function(){   
             return $.ajax2({ data : {  SystemMenuNode : { node: '{$node->getFather()->get('id')}', 
                                             lang : 'fr', 
                                             token : '{mfForm::getToken('SystemMenuNodeForm')}' } },
                              url:"{url_to('dashboard_ajax',['action'=>'ListPartialMenu'])}", 
                             errorTarget: ".SystemMenu-errors",
                                 target: "#tab-dashboard-x-settings"});
     });  
     {/if}
 
     $("#Positions").click( function () {                
                return $.ajax2({  data : { SystemMenuI18n : { menu_id: '{$node->get('id')}', lang: "fr" } }, 
                                url:"{url_to('dashboard_ajax',['action'=>'PositionsMenu'])}",
                                errorTarget: ".SystemMenu-errors",
                                target: "#tab-dashboard-x-settings"});
         }); 
         
         
        
 </script>

