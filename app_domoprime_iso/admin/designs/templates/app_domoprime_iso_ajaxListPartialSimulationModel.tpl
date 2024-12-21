{messages class="site-errors"}
<h3>{__('Simulation models')}</h3>    
<div>
  <a href="#" class="btn" id="SimulationModel-New" title="{__('New model')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>{__('New model')}</a>   

</div>
{* {include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="SimulationModel"}
<button  id="SimulationModel-filter" class="btn-table">{__("Filter")}</button>   <button class="btn-table" id="SimulationModel-init">{__("Init")}</button> *}
<div>       
    <img class="SimulationModel" id="{$formFilter.lang}" name="lang" src="{url("/flags/`$formFilter.lang|default:"__"`.png","picture")}" title="{if $formFilter.lang->hasError()}{$formFilter.lang}{else}{format_country($formFilter.lang)}{/if}" />
    <style> .ui-dialog { font-size: 62.5%; }</style> 
    <a id="SimulationModel-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a>
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
                <a href="#" class="SimulationModel-order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="name"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="SimulationModel-order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="name"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>         
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('Value')}</span>      
            <div>
                <a href="#" class="SimulationModel-order{$formFilter.order.value->getValueExist('asc','_active')}" id="asc" name="value"><img  src='{url("/icons/sort_asc`$formFilter.order.value->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="SimulationModel-order{$formFilter.order.value->getValueExist('desc','_active')}" id="desc" name="value"><img  src='{url("/icons/sort_desc`$formFilter.order.value->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
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
    <tr class="SimulationModel-list list" {if $item->hasI18n()}id="SimulationModel-{$item->getI18n()->get('id')}" name="{$item->getI18n()->get('id')}"{/if}> 
        <td class="SimulationModel-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            {if $pager->getNbItems()>5}
                <td>        
                    {if $item->hasI18n()}
                    <input class="SimulationModel-selection" type="checkbox" id="{$item->getI18n()->get('id')}" name="{$item->getI18n()->get('name')}"/>   
                    {/if}
                </td>
            {/if}          
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
                <a href="#" title="{__('Edit')}" class="SimulationModel-View" id="{$item->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a>              
                {if $item->hasI18n()}<a href="#" title="{__('Delete')}" class="SimulationModel-Delete" id="{$item->getI18n()->get('id')}"  name="{$item->getI18n()->get('value')}">
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
        <input type="checkbox" id="SimulationModel-all" /> 
          <a style="opacity:0.5" class="SimulationModel-actions_items" href="#" title="{__('delete')}" id="SimulationModel-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{* {include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="SimulationModel"} *}
<script type="text/javascript">
 
        function getSiteDomoprimeSimulationModelFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: { 
                                         name : $("[name=SimulationModel-name] option:selected").val()  
                                    },
                                lang: $("img.SimulationModel").attr('id'),                                                                                                               
                              //  nbitemsbypage: $("[name=SimulationModel-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".SimulationModel-order_active").attr("name"))
                 params.filter.order[$(".SimulationModel-order_active").attr("name")] =$(".SimulationModel-order_active").attr("id");   
            $(".SimulationModel-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteDomoprimeSimulationModelFilter()
        {            
           return $.ajax2({ data: getSiteDomoprimeSimulationModelFilterParameters(), 
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialSimulationModel'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",
                            target: "#actions"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".SimulationModel-pager .SimulationModel-active").html()?parseInt($(".SimulationModel-pager .SimulationModel-active").html()):1;
           records_by_page=$("[name=SimulationModel-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".SimulationModel-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#SimulationModel-nb_results").html())-n;
           $("#SimulationModel-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#SimulationModel-end_result").html($(".SimulationModel-count:last").html());
        }
        
           {* ===================== L A N G U A G E =============================== *}
         
            $("#SimulationModel-ChangeLang").click(function() {      
                   $("#dialogListLanguages").dialog("open");
            });
            
            $("#dialogListLanguages").bind('select',function(event){                
                $(".SimulationModel[name=lang]").attr({                           
                                      id: event.selected.id,
                                      src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                      title: event.selected.lang
                                      });
               $("#SimulationModelChangeLang").show();
               updateSiteDomoprimeSimulationModelFilter();
            });   
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#SimulationModel-init").click(function() {   
              
               $.ajax2({ url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialSimulationModel'])}",
                         errorTarget: ".site-errors",
                         loading: "#tab-site-dashboard-x-settings-loading",                         
                         target: "#actions"}); 
           }); 
    
          $('.SimulationModel-order').click(function() {
                $(".SimulationModel-order_active").attr('class','SimulationModel-order');
                $(this).attr('class','SimulationModel-order_active');
                return updateSiteDomoprimeSimulationModelFilter();
           });
           
            $(".SimulationModel-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteSimulationModelFilter();
            });
            
          $("#SimulationModel-filter").click(function() { return updateSiteDomoprimeSimulationModelFilter(); }); 
          
          $("[name=SimulationModel-nbitemsbypage]").change(function() { return updateSiteDomoprimeSimulationModelFilter(); }); 
          
         // $("[name=SimulationModel-name]").change(function() { return updateSiteSimulationModelFilter(); }); 
           
           $(".SimulationModel-pager").click(function () {      
              
                return $.ajax2({ data: getSiteDomoprimeSimulationModelFilterParameters(), 
                                 url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialSimulationModel'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 target: "#actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#SimulationModel-New").click( function () { 
            
            return $.ajax2({
                data : { lang : { lang: $("img.SimulationModel[name=lang]").attr('id'),token: "{mfForm::getToken('LanguageFrontendForm')}" } },                
                url: "{url_to('app_domoprime_iso_ajax',['action'=>'NewSimulationModelI18n'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         });
         
         $(".SimulationModel-View").click( function () { 
                
                return $.ajax2({ data : { DomoprimeSimulationModelI18n : { 
                                                model_id: $(this).attr('id'),
                                                lang: $("img.SimulationModel[name=lang]").attr('id')                                              
                                    } },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('app_domoprime_iso_ajax',['action'=>'ViewSimulationModelI18n'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });                        
         
        $(".SimulationModel-list").dblclick( function () {               
            
                return $.ajax2({ data : { DomoprimeSimulationModelI18n : { 
                                                model_id: $(this).attr('name'),
                                                lang: $("img.SimulationModel[name=lang]").attr('id')                                              
                                    } },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('app_domoprime_iso_ajax',['action'=>'ViewSimulationModelI18n'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });    
         
          $(".SimulationModel-Delete").click( function () { 
                if (!confirm('{__("Model \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ DomoprimeSimulationModelI18n: $(this).attr('id') },
                                 url :"{url_to('app_domoprime_iso_ajax',['action'=>'DeleteSimulationModelI18n'])}",
                                 errorTarget: ".site-errors",     
                                 loading: "#tab-site-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='DeleteModelI18n')
                                       {    
                                          $("tr#SimulationModel-"+resp.id).remove();  
                                          if ($('.SimulationModel-list').length==0)
                                          {
                                              return $.ajax2({ url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialSimulationModel'])}",
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