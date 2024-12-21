{messages class="{$site->getSiteID()}-site-errors"}
<h3>{__('User attribution')}</h3>    
<div>
  <a href="#" id="{$site->getSiteID()}-UserAttribution-New" title="{__('new function')}" ><img  src="{url('/icons/new.gif','picture')}" alt="{__('new')}"/>{__('New attribution')}</a>   

</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="`$site->getSiteID()`-UserAttribution"}
<button id="{$site->getSiteID()}-UserAttribution-filter">{__("Filter")}</button>   <button id="{$site->getSiteID()}-UserAttribution-init">{__("Init")}</button>
<div>       
    <img class="{$site->getSiteID()}-UserAttribution" id="{$formFilter.lang}" name="lang" src="{url("/flags/`$formFilter.lang|default:"__"`.png","picture")}" title="{if $formFilter.lang->hasError()}{$formFilter.lang}{else}{format_country($formFilter.lang)}{/if}" />
    <style> .ui-dialog { font-size: 62.5%; }</style> 
    <a id="{$site->getSiteID()}-UserAttribution-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a>
    {component name="/site_languages/dialogListLanguagesFrontend" selected=$formFilter.lang site=$formFilter->getSite()}   
</div>
<table cellpadding="0" cellspacing="0">     
    <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}
        <th>
            <span>{__('id')|capitalize}</span>
            <div>
                <a href="#" class="{$site->getSiteID()}-UserAttribution-order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="{$site->getSiteID()}-UserAttribution-order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th> 
        </th>
           <th>
            <span>{__('name')|capitalize}</span>      
            <div>
                <a href="#" class="{$site->getSiteID()}-UserAttribution-order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="value"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="{$site->getSiteID()}-UserAttribution-order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="value"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div>
        </th>
        </th>
           <th>
            <span>{__('function')|capitalize}</span>      
            <div>
                <a href="#" class="{$site->getSiteID()}-UserAttribution-order{$formFilter.order.value->getValueExist('asc','_active')}" id="asc" name="value"><img  src='{url("/icons/sort_asc`$formFilter.order.value->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="{$site->getSiteID()}-UserAttribution-order{$formFilter.order.value->getValueExist('desc','_active')}" id="desc" name="value"><img  src='{url("/icons/sort_desc`$formFilter.order.value->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div>
        </th>         
        <th>{__('actions')|capitalize}</th>
    </tr>   
    {* search/equal/range *}
     <tr>
       <td>{* # *}</td>
       {if $pager->getNbItems()>5}<td></td>{/if}
       <td>{* id *}</td>     
       <td>{* name *}</td>      
       <td>{* value *}</td>      
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="{$site->getSiteID()}-UserAttribution" {if $item->hasUserAttributionI18n()}id="{$site->getSiteID()}-UserAttribution-{$item->getUserAttributionI18n()->get('id')}"{/if}> 
        <td class="{$site->getSiteID()}-UserAttribution-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            {if $pager->getNbItems()>5}
                <td>        
                    {if $item->hasUserAttributionI18n()}
                    <input class="{$site->getSiteID()}-UserAttribution-selection" type="checkbox" id="{$item->getUserAttributionI18n()->get('id')}" name="{$item->getUserAttributionI18n()->get('name')}"/>   
                    {/if}
                </td>
            {/if}
            <td><span>{$item->getUserAttribution()->get('id')}</span></td>         
            <td>                
                     {$item->getUserAttribution()->get('name')}                
            </td>  
            <td>
                {if $item->hasUserAttributionI18n()}
                     {$item->getUserAttributionI18n()->get('value')}
                {else}
                    {__('----')}
                {/if}    
            </td>            
            <td>               
                <a href="#" title="{__('edit')}" class="{$site->getSiteID()}-UserAttribution-View" id="{$item->getUserAttribution()->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a> 
                {if $item->hasUserAttributionI18n()}<a href="#" title="{__('delete')}" class="{$site->getSiteID()}-UserAttribution-Delete" id="{$item->getUserAttributionI18n()->get('id')}"  name="{$item->getUserAttributionI18n()->get('value')}">
                   <img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/>
                </a>
                {/if}
            </td>
    </tr>    
    {/foreach}    
</table>    
{if !$pager->getNbItems()}
     <span>{__('No attribution')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="{$site->getSiteID()}-UserAttribution-all" /> 
          <a style="opacity:0.5" class="{$site->getSiteID()}-UserAttribution-actions_items" href="#" title="{__('delete')}" id="UserAttribution-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="`$site->getSiteID()`-UserAttribution"}
<script type="text/javascript">
 
        function getSite{$site->getSiteKey()}UserAttributionFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: { 
                                         name : $("[name={$site->getSiteID()}-UserAttribution-name] option:selected").val()  
                                    },
                                lang: $("img.{$site->getSiteID()}-UserAttribution").attr('id'),                                                                                                               
                                nbitemsbypage: $("[name={$site->getSiteID()}-UserAttribution-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".{$site->getSiteID()}-UserAttribution-order_active").attr("name"))
                 params.filter.order[$(".{$site->getSiteID()}-UserAttribution-order_active").attr("name")] =$(".{$site->getSiteID()}-UserAttribution-order_active").attr("id");   
            $(".{$site->getSiteID()}-UserAttribution-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSite{$site->getSiteKey()}UserAttributionFilter()
        {
           $(".{$site->getSiteKey()}-dialogs").dialog("destroy").remove();   
           return $.ajax2({ data: getSite{$site->getSiteKey()}UserAttributionFilterParameters(), 
                            url:"{url_to('users_site_ajax',['action'=>'ListPartialAttribution'])}" , 
                            errorTarget: ".{$site->getSiteID()}-site-errors",
                            loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                            target: "#{$site->getSiteID()}-actions"
                             });
        }
    
        function updateSite{$site->getSiteKey()}Pager(n)
        {
           page_active=$(".{$site->getSiteID()}-UserAttribution-pager .UserAttribution-active").html()?parseInt($(".{$site->getSiteID()}-UserAttribution-pager .UserAttribution-active").html()):1;
           records_by_page=$("[name={$site->getSiteID()}-UserAttribution-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".{$site->getSiteID()}-UserAttribution-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#{$site->getSiteID()}-UserAttribution-nb_results").html())-n;
           $("#{$site->getSiteID()}-UserAttribution-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#{$site->getSiteID()}-UserAttribution-end_result").html($(".{$site->getSiteID()}-UserAttribution-count:last").html());
        }
        
           {* ===================== L A N G U A G E =============================== *}
         
            $("#{$site->getSiteID()}-UserAttribution-ChangeLang").click(function() {      
                   $("#{$site->getSiteID()}-dialogListLanguages").dialog("open");
            });
            
            $("#{$site->getSiteID()}-dialogListLanguages").bind('select',function(event){                
                $(".{$site->getSiteID()}-UserAttribution[name=lang]").attr({                           
                                      id: event.selected.id,
                                      src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                      title: event.selected.lang
                                      });
               $("#{$site->getSiteID()}-UserAttributionChangeLang").show();
               updateSite{$site->getSiteKey()}UserAttributionFilter()
            });   
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#{$site->getSiteID()}-UserAttribution-init").click(function() {   
               $(".{$site->getSiteKey()}-dialogs").dialog("destroy").remove();   
               $.ajax2({ url:"{url_to('users_site_ajax',['action'=>'ListPartialAttribution'])}",
                         errorTarget: ".{$site->getSiteID()}-site-errors",
                         loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",                         
                         target: "#{$site->getSiteID()}-actions"}); 
           }); 
    
          $('.{$site->getSiteID()}-UserAttribution-order').click(function() {
                $(".{$site->getSiteID()}-UserAttribution-order_active").attr('class','{$site->getSiteID()}-UserAttribution-order');
                $(this).attr('class','{$site->getSiteID()}-UserAttribution-order_active');
                return updateSite{$site->getSiteKey()}UserAttributionFilter();
           });
           
            $(".{$site->getSiteID()}-UserAttribution-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSite{$site->getSiteKey()}UserAttributionFilter();
            });
            
          $("#{$site->getSiteID()}-UserAttribution-filter").click(function() { return updateSite{$site->getSiteKey()}UserAttributionFilter(); }); 
          
          $("[name={$site->getSiteID()}-UserAttribution-nbitemsbypage]").change(function() { return updateSite{$site->getSiteKey()}UserAttributionFilter(); }); 
          
         // $("[name=UserAttribution-name]").change(function() { return updateSite{$site->getSiteKey()}UserAttributionFilter(); }); 
           
           $(".{$site->getSiteID()}-UserAttribution-pager").click(function () {      
                $(".{$site->getSiteKey()}-dialogs").dialog("destroy").remove();   
                return $.ajax2({ data: getSite{$site->getSiteKey()}UserAttributionFilterParameters(), 
                                 url:"{url_to('users_site_ajax',['action'=>'ListPartialAttribution'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".{$site->getSiteID()}-site-errors",
                                 loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                 target: "#{$site->getSiteID()}-actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#{$site->getSiteID()}-UserAttribution-New").click( function () { 
            $(".{$site->getSiteID()}-dialogs").dialog("destroy").remove();      
            return $.ajax2({
                data : { lang : { lang: $("img.{$site->getSiteId()}-UserAttribution[name=lang]").attr('id'),token: "{mfForm::getToken('LanguageFrontendForm')}" } },                
                url: "{url_to('users_site_ajax',['action'=>'NewAttributionI18n'])}",
                errorTarget: ".{$site->getSiteID()}-site-errors",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                target: "#{$site->getSiteID()}-actions"
           });
         });
         
         $(".{$site->getSiteID()}-UserAttribution-View").click( function () { 
                $(".{$site->getSiteKey()}-dialogs").dialog("destroy").remove();       
                return $.ajax2({ data : { UserAttributionI18n : { 
                                                function_id: $(this).attr('id'),
                                                lang: $("img.{$site->getSiteID()}-UserAttribution[name=lang]").attr('id')                                              
                                    } },
                                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                url:"{url_to('users_site_ajax',['action'=>'ViewAttributionI18n'])}",
                                errorTarget: ".{$site->getSiteID()}-site-errors",
                                target: "#{$site->getSiteID()}-actions"});
         });
                    
         
          $(".{$site->getSiteID()}-UserAttribution-Delete").click( function () { 
                if (!confirm('{__("Attribution \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ UserAttributionI18n: $(this).attr('id') },
                                 url :"{url_to('users_site_ajax',['action'=>'DeleteAttributionI18n'])}",
                                 errorTarget: ".{$site->getSiteID()}-dashboard-site-errors",     
                                 loading: "#tab-site-{$site->getSiteID()}-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='deleteAttributionI18n')
                                       {    
                                          $("tr#{$site->getSiteID()}-UserAttribution-"+resp.id).remove();  
                                          if ($('.{$site->getSiteID()}-UserAttribution').length==0)
                                              return $.ajax2({ url:"{url_to('users_site_ajax',['action'=>'ListPartialAttribution'])}",
                                                               errorTarget: ".{$site->getSiteID()}-site-errors",
                                                               target: "#tab-{$site->getSiteID()}-dashboard-site-x-settings"});
                                          updateSite{$site->getSiteKey()}Pager(1);
                                        }       
                                 }
                     });                                        
            });
            
      
</script>    