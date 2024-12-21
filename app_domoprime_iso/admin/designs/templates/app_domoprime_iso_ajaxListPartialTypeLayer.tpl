{messages class="site-errors"}
<h3>{__('Type Layer')}</h3>    
<div>
  <a href="#" class="btn" id="DomoprimeTypeLayer-New" title="{__('New type layer')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>{__('New type layer')}</a>   
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="DomoprimeTypeLayer"}
<div>       
    <img class="DomoprimeTypeLayer" id="{$formFilter.lang}" name="lang" src="{url("/flags/`$formFilter.lang|default:"__"`.png","picture")}" title="{if $formFilter.lang->hasError()}{$formFilter.lang}{else}{format_country($formFilter.lang)}{/if}" />
    <style> .ui-dialog { font-size: 62.5%; }</style> 
    <a id="DomoprimeTypeLayer-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a>
    {component name="/site_languages/dialogListLanguagesFrontend" selected=$formFilter.lang}   
</div>
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0"> 
    <thead>
    <tr class="list-header">    
    <th>#</th>        
        <th  class="footable-first-column" data-toggle="true">
            <span>{__('Name')}</span>    
            <div>
                <a href="#" class="DomoprimeTypeLayer-order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="name"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="DomoprimeTypeLayer-order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="name"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>        
           <th data-hide="phone" style="display: table-cell;">
            <span>{__('value')}</span>      
            <div>
                <a href="#" class="DomoprimeTypeLayer-order{$formFilter.order.value->getValueExist('asc','_active')}" id="asc" name="value"><img  src='{url("/icons/sort_asc`$formFilter.order.value->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="DomoprimeTypeLayer-order{$formFilter.order.value->getValueExist('desc','_active')}" id="desc" name="value"><img  src='{url("/icons/sort_desc`$formFilter.order.value->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div>
        </th>         
        <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
    </tr>
</thead> 
    {* search/equal/range *}
    <tr class="input-list">
       <td>{* # *}</td>
     {*  {if $pager->getNbItems()>5}<td></td>{/if} *}
     {*  <td>{* id *} {* </td> *}
       <td>{* name *}</td>      
       <td>{* value *}</td>      
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="DomoprimeTypeLayer list" {if $item->hasI18n()}id="DomoprimeTypeLayer-{$item->getI18n()->get('id')}"{/if}> 
        <td class="DomoprimeTypeLayer-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>        
            <td>                
                    {$item->get('name')}
            </td>           
            <td>
                {if $item->hasI18n()}
                     {$item->getI18n()->get('value')}
                {else}
                    {__('---')}
                {/if}    
            </td>            
            <td>               
                <a href="#" title="{__('Edit')}" class="DomoprimeTypeLayer-View" id="{$item->get('id')}">
                    <i class="fa fa-edit"/>
                </a> 
                {if $item->hasI18n()}<a href="#" title="{__('delete')}" class="DomoprimeTypeLayer-Delete" id="{$item->getI18n()->get('id')}"  name="{$item->getI18n()->get('value')}">
                   <i class="fa fa-trash"/>
                </a>
                {/if}
            </td>
    </tr>    
    {/foreach}    
</table>    
{if !$pager->getNbItems()}
     <span>{__('No type')}</span>
{else}
  {*  {if $pager->getNbItems()>5}
        <input type="checkbox" id="DomoprimeTypeLayer-all" /> 
          <a style="opacity:0.5" class="DomoprimeTypeLayer-actions_items" href="#" title="{__('delete')}" id="DomoprimeTypeLayer-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if} *}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="DomoprimeTypeLayer"}
<script type="text/javascript">
 
        function getSiteDomoprimeTypeLayerFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: { 
                                         name : $("[name=DomoprimeTypeLayer-name] option:selected").val()  
                                    },
                                lang: $("img.DomoprimeTypeLayer").attr('id'),                                                                                                               
                                nbitemsbypage: $("[name=DomoprimeTypeLayer-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".DomoprimeTypeLayer-order_active").attr("name"))
                 params.filter.order[$(".DomoprimeTypeLayer-order_active").attr("name")] =$(".DomoprimeTypeLayer-order_active").attr("id");   
            $(".DomoprimeTypeLayer-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteDomoprimeTypeLayerFilter()
        {
           $(".dialogs").dialog("destroy").remove();   
           return $.ajax2({ data: getSiteDomoprimeTypeLayerFilterParameters(), 
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialTypeLayer'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",
                            target: "#actions"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".DomoprimeTypeLayer-pager .DomoprimeTypeLayer-active").html()?parseInt($(".DomoprimeTypeLayer-pager .DomoprimeTypeLayer-active").html()):1;
           records_by_page=$("[name=DomoprimeTypeLayer-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".DomoprimeTypeLayer-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#DomoprimeTypeLayer-nb_results").html())-n;
           $("#DomoprimeTypeLayer-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#DomoprimeTypeLayer-end_result").html($(".DomoprimeTypeLayer-count:last").html());
        }
        
           {* ===================== L A N G U A G E =============================== *}
         
            $("#DomoprimeTypeLayer-ChangeLang").click(function() {      
                   $("#dialogListLanguages").dialog("open");
            });
            
            $("#dialogListLanguages").bind('select',function(event){                
                $(".DomoprimeTypeLayer[name=lang]").attr({                           
                                      id: event.selected.id,
                                      src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                      title: event.selected.lang
                                      });
               $("#DomoprimeTypeLayerChangeLang").show();
               updateSiteDomoprimeTypeLayerFilter()
            });   
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomoprimeTypeLayer-init").click(function() {                   
               $.ajax2({ url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialTypeLayer'])}",
                         errorTarget: ".site-errors",
                         loading: "#tab-site-dashboard-x-settings-loading",                         
                         target: "#actions"}); 
           }); 
    
          $('.DomoprimeTypeLayer-order').click(function() {
                $(".DomoprimeTypeLayer-order_active").attr('class','DomoprimeTypeLayer-order');
                $(this).attr('class','DomoprimeTypeLayer-order_active');
                return updateSiteDomoprimeTypeLayerFilter();
           });
           
            $(".DomoprimeTypeLayer-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteDomoprimeTypeLayerFilter();
            });
            
          $("#DomoprimeTypeLayer-filter").click(function() { return updateSiteDomoprimeTypeLayerFilter(); }); 
          
          $("[name=DomoprimeTypeLayer-nbitemsbypage]").change(function() { return updateSiteDomoprimeTypeLayerFilter(); }); 
          
         // $("[name=DomoprimeTypeLayer-name]").change(function() { return updateSiteDomoprimeTypeLayerFilter(); }); 
           
           $(".DomoprimeTypeLayer-pager").click(function () {                      
                return $.ajax2({ data: getSiteDomoprimeTypeLayerFilterParameters(), 
                                 url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialTypeLayer'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 target: "#actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#DomoprimeTypeLayer-New").click( function () {             
            return $.ajax2({
                data : { lang : { lang: $("img.DomoprimeTypeLayer[name=lang]").attr('id'),token: "{mfForm::getToken('LanguageFrontendForm')}" } },                
                url: "{url_to('app_domoprime_iso_ajax',['action'=>'NewTypeLayerI18n'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         });
         
         $(".DomoprimeTypeLayer-View").click( function () {                
                return $.ajax2({ data : { DomoprimeTypeLayerI18n : { 
                                                type_id: $(this).attr('id'),
                                                lang: $("img.DomoprimeTypeLayer[name=lang]").attr('id')                                              
                                    } },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('app_domoprime_iso_ajax',['action'=>'ViewTypeLayerI18n'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
                    
         
          $(".DomoprimeTypeLayer-Delete").click( function () { 
                if (!confirm('{__("Status \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ DomoprimeTypeLayerI18n: $(this).attr('id') },
                                 url :"{url_to('app_domoprime_iso_ajax',['action'=>'DeleteTypeLayerI18n'])}",
                                 errorTarget: "site-errors",     
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='DeleteTypeLayerI18n')
                                       {    
                                          $("tr#DomoprimeTypeLayer-"+resp.id).remove();  
                                          if ($('.DomoprimeTypeLayer').length==0)
                                              return $.ajax2({ url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialTypeLayer'])}",
                                                               errorTarget: ".site-errors",
                                                               target: "#tab-dashboard-site-x-settings"});
                                          updateSitePager(1);
                                        }       
                                 }
                     });                                        
            });
            

         
  $('.footable').footable();
	
</script>    
