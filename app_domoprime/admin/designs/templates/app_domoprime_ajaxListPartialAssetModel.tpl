{messages class="site-errors"}
<h3>{__('Asset models')}</h3>    
<div>
  <a href="#" class="btn" id="EmailModel-New" title="{__('New model')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>{__('New model')}</a>   

</div>
{* {include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="EmailModel"}
<button  id="EmailModel-filter" class="btn-table">{__("Filter")}</button>   <button class="btn-table" id="EmailModel-init">{__("Init")}</button> *}
<div>       
    <img class="EmailModel" id="{$formFilter.lang}" name="lang" src="{url("/flags/`$formFilter.lang|default:"__"`.png","picture")}" title="{if $formFilter.lang->hasError()}{$formFilter.lang}{else}{format_country($formFilter.lang)}{/if}" />
    <style> .ui-dialog { font-size: 62.5%; }</style> 
    <a id="EmailModel-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a>
    {component name="/site_languages/dialogListLanguagesFrontend" selected=$formFilter.lang}   
</div>
<div class="containerDivResp">
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0">
    <thead>
    <tr class="list-header">    
    <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}           
        <th class="footable-first-column" data-toggle="true">
            <span>{__('Name')}</span>    
            <div>
                <a href="#" class="EmailModel-order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="name"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="EmailModel-order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="name"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>         
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('Value')}</span>      
            <div>
                <a href="#" class="EmailModel-order{$formFilter.order.value->getValueExist('asc','_active')}" id="asc" name="value"><img  src='{url("/icons/sort_asc`$formFilter.order.value->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="EmailModel-order{$formFilter.order.value->getValueExist('desc','_active')}" id="desc" name="value"><img  src='{url("/icons/sort_desc`$formFilter.order.value->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div>
        </th>       
        <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
    </tr> 
</thead>
    {* search/equal/range *}
     <tr class="input-list">
       <td>{* # *}</td>
       {if $pager->getNbItems()>5}<td></td>{/if}     
       <td>{* name *}</td>      
       <td>{* value *}</td>         
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="EmailModel-list list" {if $item->hasDomoprimeAssetModelI18n()}id="EmailModel-{$item->getDomoprimeAssetModelI18n()->get('id')}" name="{$item->getDomoprimeAssetModelI18n()->get('id')}"{/if}> 
        <td class="EmailModel-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            {if $pager->getNbItems()>5}
                <td>        
                    {if $item->hasDomoprimeAssetModelI18n()}
                    <input class="EmailModel-selection" type="checkbox" id="{$item->getDomoprimeAssetModelI18n()->get('id')}" name="{$item->getDomoprimeAssetModelI18n()->get('name')}"/>   
                    {/if}
                </td>
            {/if}          
            <td>                
                    {$item->getDomoprimeAssetModel()->get('name')}
            </td>            
            <td>
                {if $item->hasDomoprimeAssetModelI18n()}
                     {$item->getDomoprimeAssetModelI18n()->get('value')}
                {else}
                    {__('----')}
                {/if}    
            </td>             
            <td>               
                <a href="#" title="{__('Edit')}" class="EmailModel-View" id="{$item->getDomoprimeAssetModel()->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a>              
                {if $item->hasDomoprimeAssetModelI18n()}<a href="#" title="{__('Delete')}" class="EmailModel-Delete" id="{$item->getDomoprimeAssetModelI18n()->get('id')}"  name="{$item->getDomoprimeAssetModelI18n()->get('value')}">
                   <img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/>
                </a>
                {/if}
            </td>
    </tr>    
    {/foreach}    
</table> 
</div>
{if !$pager->getNbItems()}
     <span>{__('No model')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="EmailModel-all" /> 
          <a style="opacity:0.5" class="EmailModel-actions_items" href="#" title="{__('delete')}" id="EmailModel-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{* {include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="EmailModel"} *}
<script type="text/javascript">
 
        function getSiteDomoprimeAssetModelFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: { 
                                         name : $("[name=EmailModel-name] option:selected").val()  
                                    },
                                lang: $("img.EmailModel").attr('id'),                                                                                                               
                              //  nbitemsbypage: $("[name=EmailModel-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".EmailModel-order_active").attr("name"))
                 params.filter.order[$(".EmailModel-order_active").attr("name")] =$(".EmailModel-order_active").attr("id");   
            $(".EmailModel-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteDomoprimeAssetModelFilter()
        {            
           return $.ajax2({ data: getSiteDomoprimeAssetModelFilterParameters(), 
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialAssetModel'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",
                            target: "#actions"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".EmailModel-pager .EmailModel-active").html()?parseInt($(".EmailModel-pager .EmailModel-active").html()):1;
           records_by_page=$("[name=EmailModel-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".EmailModel-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#EmailModel-nb_results").html())-n;
           $("#EmailModel-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#EmailModel-end_result").html($(".EmailModel-count:last").html());
        }
        
           {* ===================== L A N G U A G E =============================== *}
         
            $("#EmailModel-ChangeLang").click(function() {      
                   $("#dialogListLanguages").dialog("open");
            });
            
            $("#dialogListLanguages").bind('select',function(event){                
                $(".EmailModel[name=lang]").attr({                           
                                      id: event.selected.id,
                                      src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                      title: event.selected.lang
                                      });
               $("#EmailModelChangeLang").show();
               updateSiteDomoprimeAssetModelFilter();
            });   
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#EmailModel-init").click(function() {   
              
               $.ajax2({ url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialAssetModel'])}",
                         errorTarget: ".site-errors",
                         loading: "#tab-site-dashboard-x-settings-loading",                         
                         target: "#actions"}); 
           }); 
    
          $('.EmailModel-order').click(function() {
                $(".EmailModel-order_active").attr('class','EmailModel-order');
                $(this).attr('class','EmailModel-order_active');
                return updateSiteDomoprimeAssetModelFilter();
           });
           
            $(".EmailModel-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteEmailModelFilter();
            });
            
          $("#EmailModel-filter").click(function() { return updateSiteDomoprimeAssetModelFilter(); }); 
          
          $("[name=EmailModel-nbitemsbypage]").change(function() { return updateSiteDomoprimeAssetModelFilter(); }); 
          
         // $("[name=EmailModel-name]").change(function() { return updateSiteEmailModelFilter(); }); 
           
           $(".EmailModel-pager").click(function () {      
              
                return $.ajax2({ data: getSiteDomoprimeAssetModelFilterParameters(), 
                                 url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialAssetModel'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 target: "#actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#EmailModel-New").click( function () { 
            
            return $.ajax2({
                data : { lang : { lang: $("img.EmailModel[name=lang]").attr('id'),token: "{mfForm::getToken('LanguageFrontendForm')}" } },                
                url: "{url_to('app_domoprime_ajax',['action'=>'NewAssetModelI18n'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         });
         
         $(".EmailModel-View").click( function () { 
                
                return $.ajax2({ data : { DomoprimeAssetModelI18n : { 
                                                model_id: $(this).attr('id'),
                                                lang: $("img.EmailModel[name=lang]").attr('id')                                              
                                    } },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('app_domoprime_ajax',['action'=>'ViewAssetModelI18n'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });                        
         
        $(".EmailModel-list").dblclick( function () {               
            
                return $.ajax2({ data : { DomoprimeAssetModelI18n : { 
                                                model_id: $(this).attr('name'),
                                                lang: $("img.EmailModel[name=lang]").attr('id')                                              
                                    } },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('app_domoprime_ajax',['action'=>'ViewAssetModelI18n'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });    
         
          $(".EmailModel-Delete").click( function () { 
                if (!confirm('{__("Model \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ DomoprimeAssetModelI18n: $(this).attr('id') },
                                 url :"{url_to('app_domoprime_ajax',['action'=>'DeleteAssetModelI18n'])}",
                                 errorTarget: ".site-errors",     
                                 loading: "#tab-site-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='deleteModelI18n')
                                       {    
                                          $("tr#EmailModel-"+resp.id).remove();  
                                          if ($('.EmailModel-list').length==0)
                                          {
                                              return $.ajax2({ url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialAssetModel'])}",
                                                               errorTarget: ".site-errors",
                                                               target: "#tab-dashboard-site-x-settings"});
                                          }         
                                          updateSitePager(1);
                                        }       
                                 }
                     });                                        
            });
            
            
            
		{* $('.footable').footable(); *}
	
      
</script>    