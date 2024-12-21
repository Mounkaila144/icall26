{messages class="site-errors"}
<h3>{__('Occupation')}</h3>    
<div>
  <a href="#" class="btn" id="DomoprimeOccupation-New" title="{__('New occupation')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>{*<img  src="{url('/icons/new.gif','picture')}" alt="{__('new')}"/>*}{__('New occupation')}</a>   
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="DomoprimeOccupation"}
<div>       
    <img class="DomoprimeOccupation" id="{$formFilter.lang}" name="lang" src="{url("/flags/`$formFilter.lang|default:"__"`.png","picture")}" title="{if $formFilter.lang->hasError()}{$formFilter.lang}{else}{format_country($formFilter.lang)}{/if}" />
    <style> .ui-dialog { font-size: 62.5%; }</style> 
    <a id="DomoprimeOccupation-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a>
    {component name="/site_languages/dialogListLanguagesFrontend" selected=$formFilter.lang}   
</div>
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0"> 
    <thead>
    <tr class="list-header">    
    <th>#</th>        
        <th  class="footable-first-column" data-toggle="true">
            <span>{__('Name')}</span>    
            <div>
                <a href="#" class="DomoprimeOccupation-order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="name"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="DomoprimeOccupation-order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="name"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>        
           <th data-hide="phone" style="display: table-cell;">
            <span>{__('Value')}</span>      
            <div>
                <a href="#" class="DomoprimeOccupation-order{$formFilter.order.value->getValueExist('asc','_active')}" id="asc" name="value"><img  src='{url("/icons/sort_asc`$formFilter.order.value->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="DomoprimeOccupation-order{$formFilter.order.value->getValueExist('desc','_active')}" id="desc" name="value"><img  src='{url("/icons/sort_desc`$formFilter.order.value->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
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
    <tr class="DomoprimeOccupation list" {if $item->hasI18n()}id="DomoprimeOccupation-{$item->getI18n()->get('id')}"{/if}> 
        <td class="DomoprimeOccupation-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>        
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
                <a href="#" title="{__('Edit')}" class="DomoprimeOccupation-View" id="{$item->get('id')}">
                    <i class="fa fa-edit"/>
                </a> 
                {if $item->hasI18n()}<a href="#" title="{__('delete')}" class="DomoprimeOccupation-Delete" id="{$item->getI18n()->get('id')}"  name="{$item->getI18n()->get('value')}">
                   <i class="fa fa-trash"/>
                </a>
                {/if}
            </td>
    </tr>    
    {/foreach}    
</table>    
{if !$pager->getNbItems()}
     <span>{__('No occupation')}</span>
{else}
  {*  {if $pager->getNbItems()>5}
        <input type="checkbox" id="DomoprimeOccupation-all" /> 
          <a style="opacity:0.5" class="DomoprimeOccupation-actions_items" href="#" title="{__('delete')}" id="DomoprimeOccupation-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if} *}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="DomoprimeOccupation"}
<script type="text/javascript">
 
        function getSiteDomoprimeOccupationFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: { 
                                         name : $("[name=DomoprimeOccupation-name] option:selected").val()  
                                    },
                                lang: $("img.DomoprimeOccupation").attr('id'),                                                                                                               
                                nbitemsbypage: $("[name=DomoprimeOccupation-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".DomoprimeOccupation-order_active").attr("name"))
                 params.filter.order[$(".DomoprimeOccupation-order_active").attr("name")] =$(".DomoprimeOccupation-order_active").attr("id");   
            $(".DomoprimeOccupation-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteDomoprimeOccupationFilter()
        {
           $(".dialogs").dialog("destroy").remove();   
           return $.ajax2({ data: getSiteDomoprimeOccupationFilterParameters(), 
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialOccupation'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",
                            target: "#actions"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".DomoprimeOccupation-pager .DomoprimeOccupation-active").html()?parseInt($(".DomoprimeOccupation-pager .DomoprimeOccupation-active").html()):1;
           records_by_page=$("[name=DomoprimeOccupation-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".DomoprimeOccupation-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#DomoprimeOccupation-nb_results").html())-n;
           $("#DomoprimeOccupation-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#DomoprimeOccupation-end_result").html($(".DomoprimeOccupation-count:last").html());
        }
        
           {* ===================== L A N G U A G E =============================== *}
         
            $("#DomoprimeOccupation-ChangeLang").click(function() {      
                   $("#dialogListLanguages").dialog("open");
            });
            
            $("#dialogListLanguages").bind('select',function(event){                
                $(".DomoprimeOccupation[name=lang]").attr({                           
                                      id: event.selected.id,
                                      src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                      title: event.selected.lang
                                      });
               $("#DomoprimeOccupationChangeLang").show();
               updateSiteDomoprimeOccupationFilter()
            });   
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomoprimeOccupation-init").click(function() {                   
               $.ajax2({ url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialOccupation'])}",
                         errorTarget: ".site-errors",
                         loading: "#tab-site-dashboard-x-settings-loading",                         
                         target: "#actions"}); 
           }); 
    
          $('.DomoprimeOccupation-order').click(function() {
                $(".DomoprimeOccupation-order_active").attr('class','DomoprimeOccupation-order');
                $(this).attr('class','DomoprimeOccupation-order_active');
                return updateSiteDomoprimeOccupationFilter();
           });
           
            $(".DomoprimeOccupation-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteDomoprimeOccupationFilter();
            });
            
          $("#DomoprimeOccupation-filter").click(function() { return updateSiteDomoprimeOccupationFilter(); }); 
          
          $("[name=DomoprimeOccupation-nbitemsbypage]").change(function() { return updateSiteDomoprimeOccupationFilter(); }); 
          
         // $("[name=DomoprimeOccupation-name]").change(function() { return updateSiteDomoprimeOccupationFilter(); }); 
           
           $(".DomoprimeOccupation-pager").click(function () {                      
                return $.ajax2({ data: getSiteDomoprimeOccupationFilterParameters(), 
                                 url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialOccupation'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 target: "#actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#DomoprimeOccupation-New").click( function () {             
            return $.ajax2({
                data : { lang : { lang: $("img.DomoprimeOccupation[name=lang]").attr('id'),token: "{mfForm::getToken('LanguageFrontendForm')}" } },                
                url: "{url_to('app_domoprime_iso_ajax',['action'=>'NewOccupationI18n'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         });
         
         $(".DomoprimeOccupation-View").click( function () {                
                return $.ajax2({ data : { DomoprimeOccupationI18n : { 
                                                occupation_id: $(this).attr('id'),
                                                lang: $("img.DomoprimeOccupation[name=lang]").attr('id')                                              
                                    } },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('app_domoprime_iso_ajax',['action'=>'ViewOccupationI18n'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
                    
         
          $(".DomoprimeOccupation-Delete").click( function () { 
                if (!confirm('{__("Status \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ DomoprimeOccupationI18n: $(this).attr('id') },
                                 url :"{url_to('app_domoprime_iso_ajax',['action'=>'DeleteOccupationI18n'])}",
                                 errorTarget: "site-errors",     
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='DeleteOccupationI18n')
                                       {    
                                          $("tr#DomoprimeOccupation-"+resp.id).remove();  
                                          if ($('.DomoprimeOccupation').length==0)
                                              return $.ajax2({ url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialOccupation'])}",
                                                               errorTarget: ".site-errors",
                                                               target: "#tab-dashboard-site-x-settings"});
                                          updateSitePager(1);
                                        }       
                                 }
                     });                                        
            });
            

         
  $('.footable').footable();
	
</script>    