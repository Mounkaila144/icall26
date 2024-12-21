{messages class="site-errors"}
<h3>{__('Classes')}</h3>    
<div>
  <a href="#" class="btn" id="DomoprimeClass-New" title="{__('New class')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>{__('New class')}</a>     
 
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="DomoprimeClass"}
<button id="DomoprimeClass-filter" class="btn-table" style="width:auto">{__("Filter")}</button>   
<button id="DomoprimeClass-init" class="btn-table">{__("Init")}</button>
<div>       
    <img class="DomoprimeClass" id="{$formFilter.lang}" name="lang" src="{url("/flags/`$formFilter.lang|default:"__"`.png","picture")}" title="{if $formFilter.lang->hasError()}{$formFilter.lang}{else}{format_country($formFilter.lang)}{/if}" />
    <style> .ui-dialog { font-size: 62.5%; }</style> 
    <a id="DomoprimeClass-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a>
    {component name="/site_languages/dialogListLanguagesFrontend" selected=$formFilter.lang}   
</div>
<div  class="containerDivResp">
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0">  
    <thead>
    <tr class="list-header">    
    <th>#</th>
        <th>&nbsp;</th>            
        <th class="footable-first-column" data-toggle="true">
            <span>{__('Name')}</span>    
            <div>
                <a href="#" class="DomoprimeClass-order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="name"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="DomoprimeClass-order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="name"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>      
           <th data-hide="phone" style="display: table-cell;">
            <span>{__('Value')}</span>      
            <div>
                <a href="#" class="DomoprimeClass-order{$formFilter.order.value->getValueExist('asc','_active')}" id="asc" name="value"><img  src='{url("/icons/sort_asc`$formFilter.order.value->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="DomoprimeClass-order{$formFilter.order.value->getValueExist('desc','_active')}" id="desc" name="value"><img  src='{url("/icons/sort_desc`$formFilter.order.value->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div>
        </th> 
  <th data-hide="phone" style="display: table-cell;">
            <span>{__('Coef')}</span>              
        </th>  
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('Multiple')}</span>              
        </th>  
          <th data-hide="phone" style="display: table-cell;">
            <span>{__('Multiple floor')}</span>              
        </th> 
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('Multiple top')}</span>              
        </th> 
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('Multiple wall')}</span>              
        </th> 
        <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
    </tr> 
</thead>
    {* search/equal/range *}
     <tr class="input-list">
       <td>{* # *}</td>
  <td></td> 
       <td>{* name *}</td>
       <td>{* value *}</td>      
       <td>{* value *}</td>    
         <td>{* value *}</td>    
       <td>{* actions *}</td>
         <td>{* value *}</td>    
         <td>{* value *}</td>    
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="DomoprimeClass list" {if $item->hasI18n()}id="DomoprimeClass-{$item->getI18n()->get('id')}"{/if} name="DomoprimeClass-{$item->get('id')}"> 
        <td class="DomoprimeClass-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
           
                <td>        
                    {if $item->hasI18n()}
                    <input class="DomoprimeClass-selection" type="checkbox" id="{$item->get('id')}" name="{$item->getI18n()->get('value')}"/>   
                    {/if}
                </td>
              
            <td>                
                    {$item->get('name')}
            </td>                 
            <td>
                {if $item->hasI18n()}
                     {$item->getI18n()->get('value')}
                {else}
                    {__('----')}
                {/if}    
            </td>  
              <td>                
                    {$item->get('coef')}
            </td>
                <td>                
                    {$item->get('multiple')}
            </td>
              <td>   
                  {if $item->hasMultipleFloor()}{$item->get('multiple_floor')}{else}{__('---')}{/if}  
            </td>
              <td>                
                {if $item->hasMultipleTop()}{$item->get('multiple_top')}{else}{__('---')}{/if}  
            </td>
              <td>                
                {if $item->hasMultipleWall()}{$item->get('multiple_wall')}{else}{__('---')}{/if}  
            </td>
            <td>               
                <a href="#" title="{__('Edit')}" class="DomoprimeClass-View" id="{$item->get('id')}">
                         <i class="fa fa-edit" style="font-size: 16px;"></i></a></a> 
                   <a href="#" title="{__('Revenue')}" class="DomoprimeClass-Pricing" id="{$item->get('id')}">
                         <i class="fa fa-euro" style="font-size: 16px;"></i></a></a> 
                {if $item->hasI18n()}<a href="#" title="{__('Delete')}" class="DomoprimeClass-Delete" id="{$item->getI18n()->get('id')}"  name="{$item->getI18n()->get('value')}">
                       <i class="fa fa-trash" style="font-size: 16px;"></i></a>
                </a>
                {/if}
            </td>
    </tr>    
    {/foreach}    
</table>   
</div>
{if !$pager->getNbItems()}
     <span>{__('No class')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="DomoprimeClass-all" /> 
          <a style="opacity:0.5" class="DomoprimeClass-actions_items" href="#" title="{__('Delete')}" id="DomoprimeClass-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="DomoprimeClass"}
<script type="text/javascript">
 
        function getSiteDomoprimeClassFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: { 
                                         name : $("[name=DomoprimeClass-name] option:selected").val()  
                                    },
                                lang: $("img.DomoprimeClass").attr('id'),                                                                                                               
                                nbitemsbypage: $("[name=DomoprimeClass-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".DomoprimeClass-order_active").attr("name"))
                 params.filter.order[$(".DomoprimeClass-order_active").attr("name")] =$(".DomoprimeClass-order_active").attr("id");   
            $(".DomoprimeClass-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteDomoprimeClassFilter()
        {           
           return $.ajax2({ data: getSiteDomoprimeClassFilterParameters(), 
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialClass'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",
                            target: "#actions"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".DomoprimeClass-pager .DomoprimeClass-active").html()?parseInt($(".DomoprimeClass-pager .DomoprimeClass-active").html()):1;
           records_by_page=$("[name=DomoprimeClass-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".DomoprimeClass-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#DomoprimeClass-nb_results").html())-n;
           $("#DomoprimeClass-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#DomoprimeClass-end_result").html($(".DomoprimeClass-count:last").html());
        }
        
           {* ===================== L A N G U A G E =============================== *}
         
            $("#DomoprimeClass-ChangeLang").click(function() {      
                   $("#dialogListLanguages").dialog("open");
            });
            
            $("#dialogListLanguages").bind('select',function(event){                
                $(".DomoprimeClass[name=lang]").attr({                           
                                      id: event.selected.id,
                                      src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                      title: event.selected.lang
                                      });
               $("#DomoprimeClassChangeLang").show();
               updateSiteDomoprimeClassFilter()
            });   
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomoprimeClass-init").click(function() {   
             
               $.ajax2({ url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialClass'])}",
                         errorTarget: ".site-errors",
                         loading: "#tab-site-dashboard-x-settings-loading",                         
                         target: "#actions"}); 
           }); 
    
          $('.DomoprimeClass-order').click(function() {
                $(".DomoprimeClass-order_active").attr('class','DomoprimeClass-order');
                $(this).attr('class','DomoprimeClass-order_active');
                return updateSiteDomoprimeClassFilter();
           });
           
            $(".DomoprimeClass-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteDomoprimeClassFilter();
            });
            
          $("#DomoprimeClass-filter").click(function() { return updateSiteDomoprimeClassFilter(); }); 
          
          $("[name=DomoprimeClass-nbitemsbypage]").change(function() { return updateSiteDomoprimeClassFilter(); }); 
          
         // $("[name=DomoprimeClass-name]").change(function() { return updateSiteDomoprimeClassFilter(); }); 
           
           $(".DomoprimeClass-pager").click(function () {      
               
                return $.ajax2({ data: getSiteDomoprimeClassFilterParameters(), 
                                 url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialClass'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 target: "#actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#DomoprimeClass-New").click( function () { 
            
            return $.ajax2({
                data : { lang : { lang: $("img.DomoprimeClass[name=lang]").attr('id'),token: "{mfForm::getToken('LanguageFrontendForm')}" } },                
                url: "{url_to('app_domoprime_ajax',['action'=>'NewClassI18n'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         });                
         
         $(".DomoprimeClass-View").click( function () { 
                  
                return $.ajax2({ data : { DomoprimeClassI18n : { 
                                                class_id: $(this).attr('id'),
                                                lang: $("img.DomoprimeClass[name=lang]").attr('id')                                              
                                    } },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('app_domoprime_ajax',['action'=>'ViewClassI18n'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
                    
         
          $(".DomoprimeClass-Delete").click( function () { 
                if (!confirm('{__("Status \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ DomoprimeClassI18n: $(this).attr('id') },
                                 url :"{url_to('app_domoprime_ajax',['action'=>'DeleteClassI18n'])}",
                                 errorTarget: ".site-errors",     
                                 loading: "#tab-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='DeleteClassI18n')
                                       {    
                                          $("tr#DomoprimeClass-"+resp.id).remove();  
                                          if ($('.DomoprimeClass').length==0)
                                              return $.ajax2({ url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialClass'])}",
                                                               errorTarget: ".site-errors",
                                                               target: "#tab-dashboard-x-settings"});
                                          updateSitePager(1);
                                        }       
                                 }
                     });                                        
            });
    
     $("#DomoprimeClass-all").click(function () {                
               $(".DomoprimeClass-selection").prop("checked",$(this).prop("checked"));             
               $(".DomoprimeClass-actions_items").css('opacity',($(this).prop("checked")?'1':'0.5'));
          });
    
    $(".DomoprimeClass-selection").click(function (){               
                $(".DomoprimeClass-actions_items").css('opacity',($(".DomoprimeClass-selection:checked").length?'1':'0.5'));
          });
          
    $("#DomoprimeClass-Delete").click( function () { 
             var params={ selection : {  } };
             text="";
             $(".DomoprimeClass-selection:checked").each(function (id) { 
                params.selection[id]=this.id;
                text+=this.name+",\n";
             });
             if ($.isEmptyObject(params.selection))
                return ;
             if (!confirm('{__('Status \u000A\u000A"#0#"\u000A\u000A will be deleted. Confirm ?')}'.format(text.substring(0,text.lastIndexOf(","))))) 
                 return false; 
             return $.ajax2({ 
                     data: params,                     
                     url: "{url_to('app_domoprime_ajax',['action'=>'DeletesClass'])}",
                     errorTarget: ".site-errors",     
                     loading: "#tab-site-x-settings-loading",
                     success: function(resp) {
                            if (resp.action=='DeletesClass')
                            {   
                                if ($(".DomoprimeClass").length-resp.parameters.length==0)
                                {    
                                  return $.ajax2({ url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialClass'])}",
                                                   errorTarget: ".dashboard-site-errors",     
                                                    loading: "#tab-site-x-settings-loading",                    
                                                    target: "#actions" });
                                }    
                                $.each(resp.parameters, function () {  $("tr[name=DomoprimeClass-"+this+"]").remove(); });
                                updateSitePager(resp.parameters.length); 
                                $("input#DomoprimeClass-all").attr("checked",false);                                    
                            }       
                         }
             });
          });
          
     $(".DomoprimeClass-Pricing").click( function () { 
                  
                return $.ajax2({ data : { DomoprimeClass : $(this).attr('id') },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialRegionPriceForClass'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });   
    
</script>    