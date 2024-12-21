{messages class="site-errors"}
<h3>{__('Customer union')}</h3>    
<div>
  <a href="#" id="CustomerUnion-New" title="{__('new union')}" ><img  src="{url('/icons/new.gif','picture')}" alt="{__('new')}"/>{__('New union')}</a>   

</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="`$site->getSiteID()`-CustomerUnion"}
<button id="CustomerUnion-filter">{__("Filter")}</button>   <button id="CustomerUnion-init">{__("Init")}</button>
<div>       
    <img class="CustomerUnion" id="{$formFilter.lang}" name="lang" src="{url("/flags/`$formFilter.lang|default:"__"`.png","picture")}" title="{if $formFilter.lang->hasError()}{$formFilter.lang}{else}{format_country($formFilter.lang)}{/if}" />
    <style> .ui-dialog { font-size: 62.5%; }</style> 
    <a id="CustomerUnion-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a>
    {component name="/site_languages/dialogListLanguagesFrontend" selected=$formFilter.lang site=$formFilter->getSite()}   
</div>
<table cellpadding="0" cellspacing="0">     
    <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}
        <th>
            <span>{__('id')|capitalize}</span>
            <div>
                <a href="#" class="CustomerUnion-order{$formFilter.order.id->getValueExist('asc','_active')}" id="asc" name="id"><img  src='{url("/icons/sort_asc`$formFilter.order.id->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerUnion-order{$formFilter.order.id->getValueExist('desc','_active')}" id="desc" name="id"><img  src='{url("/icons/sort_desc`$formFilter.order.id->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>       
        <th>
            <span>{__('name')|capitalize}</span>    
            <div>
                <a href="#" class="CustomerUnion-order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="name"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerUnion-order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="name"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>       
           <th>
            <span>{__('value')|capitalize}</span>      
            <div>
                <a href="#" class="CustomerUnion-order{$formFilter.order.value->getValueExist('asc','_active')}" id="asc" name="value"><img  src='{url("/icons/sort_asc`$formFilter.order.value->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="CustomerUnion-order{$formFilter.order.value->getValueExist('desc','_active')}" id="desc" name="value"><img  src='{url("/icons/sort_desc`$formFilter.order.value->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
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
    <tr class="CustomerUnion" {if $item->hasCustomerUnionI18n()}id="CustomerUnion-{$item->getCustomerUnionI18n()->get('id')}"{/if}> 
        <td class="CustomerUnion-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            {if $pager->getNbItems()>5}
                <td>        
                    {if $item->hasCustomerUnionI18n()}
                    <input class="CustomerUnion-selection" type="checkbox" id="{$item->getCustomerUnionI18n()->get('id')}" name="{$item->getCustomerUnionI18n()->get('name')}"/>   
                    {/if}
                </td>
            {/if}
            <td><span>{$item->getCustomerUnion()->get('id')|escape|truncate}</span></td>
            <td>                
                    {$item->getCustomerUnion()->get('name')}
            </td>           
            <td>
                {if $item->hasCustomerUnionI18n()}
                     {$item->getCustomerUnionI18n()->get('value')}
                {else}
                    {__('----')}
                {/if}    
            </td>            
            <td>               
                <a href="#" title="{__('edit')}" class="CustomerUnion-View" id="{$item->getCustomerUnion()->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a> 
                {if $item->hasCustomerUnionI18n()}<a href="#" title="{__('delete')}" class="CustomerUnion-Delete" id="{$item->getCustomerUnionI18n()->get('id')}"  name="{$item->getCustomerUnionI18n()->get('value')}">
                   <img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/>
                </a>
                {/if}
            </td>
    </tr>    
    {/foreach}    
</table>    
{if !$pager->getNbItems()}
     <span>{__('No union')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="CustomerUnion-all" /> 
          <a style="opacity:0.5" class="CustomerUnion-actions_items" href="#" title="{__('delete')}" id="CustomerUnion-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="`$site->getSiteID()`-CustomerUnion"}
<script type="text/javascript">
 
        function getSiteCustomerUnionFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: { 
                                         name : $("[name=CustomerUnion-name] option:selected").val()  
                                    },
                                lang: $("img.CustomerUnion").attr('id'),                                                                                                               
                                nbitemsbypage: $("[name=CustomerUnion-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".CustomerUnion-order_active").attr("name"))
                 params.filter.order[$(".CustomerUnion-order_active").attr("name")] =$(".CustomerUnion-order_active").attr("id");   
            $(".CustomerUnion-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteCustomerUnionFilter()
        {
           $(".-dialogs").dialog("destroy").remove();   
           return $.ajax2({ data: getSiteCustomerUnionFilterParameters(), 
                            url:"{url_to('customers_ajax',['action'=>'ListPartialUnion'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-site-x-settings-loading",
                            target: "#actions"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".CustomerUnion-pager .CustomerUnion-active").html()?parseInt($(".CustomerUnion-pager .CustomerUnion-active").html()):1;
           records_by_page=$("[name=CustomerUnion-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".CustomerUnion-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#CustomerUnion-nb_results").html())-n;
           $("#CustomerUnion-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#CustomerUnion-end_result").html($(".CustomerUnion-count:last").html());
        }
        
           {* ===================== L A N G U A G E =============================== *}
         
            $("#CustomerUnion-ChangeLang").click(function() {      
                   $("#dialogListLanguages").dialog("open");
            });
            
            $("#dialogListLanguages").bind('select',function(event){                
                $(".CustomerUnion[name=lang]").attr({                           
                                      id: event.selected.id,
                                      src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                      title: event.selected.lang
                                      });
               $("#CustomerUnionChangeLang").show();
               updateSiteCustomerUnionFilter()
            });   
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#CustomerUnion-init").click(function() {   
               $(".-dialogs").dialog("destroy").remove();   
               $.ajax2({ url:"{url_to('customers_ajax',['action'=>'ListPartialUnion'])}",
                         errorTarget: ".site-errors",
                         loading: "#tab-site-dashboard-site-x-settings-loading",                         
                         target: "#actions"}); 
           }); 
    
          $('.CustomerUnion-order').click(function() {
                $(".CustomerUnion-order_active").attr('class','CustomerUnion-order');
                $(this).attr('class','CustomerUnion-order_active');
                return updateSiteCustomerUnionFilter();
           });
           
            $(".CustomerUnion-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteCustomerUnionFilter();
            });
            
          $("#CustomerUnion-filter").click(function() { return updateSiteCustomerUnionFilter(); }); 
          
          $("[name=CustomerUnion-nbitemsbypage]").change(function() { return updateSiteCustomerUnionFilter(); }); 
          
         // $("[name=CustomerUnion-name]").change(function() { return updateSiteCustomerUnionFilter(); }); 
           
           $(".CustomerUnion-pager").click(function () {      
                $(".-dialogs").dialog("destroy").remove();   
                return $.ajax2({ data: getSiteCustomerUnionFilterParameters(), 
                                 url:"{url_to('customers_ajax',['action'=>'ListPartialUnion'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-dashboard-site-x-settings-loading",
                                 target: "#actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#CustomerUnion-New").click( function () { 
            $(".dialogs").dialog("destroy").remove();      
            return $.ajax2({
                data : { lang : { lang: $("img.{$site->getSiteId()}-CustomerUnion[name=lang]").attr('id'),token: "{mfForm::getToken('LanguageFrontendForm')}" } },                
                url: "{url_to('customers_ajax',['action'=>'NewUnionI18n'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-site-x-settings-loading",
                target: "#actions"
           });
         });
         
         $(".CustomerUnion-View").click( function () { 
                $(".-dialogs").dialog("destroy").remove();       
                return $.ajax2({ data : { CustomerUnionI18n : { 
                                                union_id: $(this).attr('id'),
                                                lang: $("img.CustomerUnion[name=lang]").attr('id')                                              
                                    } },
                                loading: "#tab-site-dashboard-site-x-settings-loading",
                                url:"{url_to('customers_ajax',['action'=>'ViewUnionI18n'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
                    
         
          $(".CustomerUnion-Delete").click( function () { 
                if (!confirm('{__("Union \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ CustomerUnionI18n: $(this).attr('id') },
                                 url :"{url_to('customers_ajax',['action'=>'DeleteUnionI18n'])}",
                                 errorTarget: ".dashboard-site-errors",     
                                 loading: "#tab-site-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='deleteUnionI18n')
                                       {    
                                          $("tr#CustomerUnion-"+resp.id).remove();  
                                          if ($('.CustomerUnion').length==0)
                                              return $.ajax2({ url:"{url_to('customers_ajax',['action'=>'ListPartialUnion'])}",
                                                               errorTarget: ".site-errors",
                                                               target: "#tab-dashboard-site-x-settings"});
                                          updateSitePager(1);
                                        }       
                                 }
                     });                                        
            });
            
      
</script>    