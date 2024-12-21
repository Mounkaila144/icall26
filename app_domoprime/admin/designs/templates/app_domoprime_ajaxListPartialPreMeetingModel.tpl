{messages class="site-errors"}
<h3>{__('Pre Meeting models')}</h3>    
<div>
  <a href="#" class="btn" id="Model-New" title="{__('New model')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>{__('New model')}</a>   
   <a href="#" class="btn" id="Model-NewPDF" title="{__('New PDF model')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>
      {__('New PDF model')}</a>  
</div>
{* {include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="PreMeetingModel"}
<button  id="PreMeetingModel-filter" class="btn-table">{__("Filter")}</button>   <button class="btn-table" id="PreMeetingModel-init">{__("Init")}</button> *}
<div>       
    <img class="PreMeetingModel" id="{$formFilter.lang}" name="lang" src="{url("/flags/`$formFilter.lang|default:"__"`.png","picture")}" title="{if $formFilter.lang->hasError()}{$formFilter.lang}{else}{format_country($formFilter.lang)}{/if}" />
    <style> .ui-dialog { font-size: 62.5%; }</style> 
    <a id="PreMeetingModel-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a>
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
                <a href="#" class="PreMeetingModel-order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="name"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="PreMeetingModel-order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="name"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>         
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('Value')}</span>      
            <div>
                <a href="#" class="PreMeetingModel-order{$formFilter.order.value->getValueExist('asc','_active')}" id="asc" name="value"><img  src='{url("/icons/sort_asc`$formFilter.order.value->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="PreMeetingModel-order{$formFilter.order.value->getValueExist('desc','_active')}" id="desc" name="value"><img  src='{url("/icons/sort_desc`$formFilter.order.value->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div>
        </th>   
         <th data-hide="phone" style="display: table-cell;">
            <span>{__('File')}</span>                 
        </th>                
        <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
    </tr> 
</thead>
    {* search/equal/range *}
     <tr class="input-list">
       <td>{* # *}</td>
       {if $pager->getNbItems()>5}<td></td>{/if}     
       <td>{* name *}</td>      
         <td>{* name *}</td>      
       <td>{* value *}</td>         
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="PreMeetingModel-list list" {if $item->hasI18n()}id="PreMeetingModel-{$item->getI18n()->get('id')}" name="{$item->getI18n()->get('id')}"{/if}> 
       <td class="PreMeetingModel-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>                                
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
               {if $item->hasI18n() && $item->getI18n()->hasFile()}
               <img src="{url("icons/files/`$item->getI18n()->getFile()->getExtension()`.gif",'picture')}" title="{$item->getI18n()->get('value')}" alt="{$item->getI18n()->get('value')}"/> 
               {/if}
            </td>           
            <td>               
                {if $item->hasI18n() && $item->getI18n()->hasFile()}
                    <a href="#" title="{__('Edit PDF')}" class="PreMeetingModel-ViewPDF" id="{$item->get('id')}">
                     <i class="fa fa-edit"/></a>              
                {else}
                     <a href="#" title="{__('Edit')}" class="PreMeetingModel-View" id="{$item->get('id')}">
                     <i class="fa fa-edit"/></a>  
                {/if}   
                <a target="_blank" href="{url_to('app_domoprime',['action'=>'PreviewPreMeetingModel'])}?model={$item->get('id')}" title="{__('Preview')}">
                     <i class="fa fa-eye"/></a> 
                <a href="#" title="{__('Delete')}" class="PolluterModel-Delete" id="{$item->get('id')}"  name="{if $item->hasI18n()}{$item->getI18n()->get('value')}{/if}">
                   <i class="fa fa-trash"/>
                </a>                      
            </td>
    </tr>    
    {/foreach}    
</table> 
</div>
{if !$pager->getNbItems()}
     <span>{__('No model')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="PreMeetingModel-all" /> 
          <a style="opacity:0.5" class="PreMeetingModel-actions_items" href="#" title="{__('Delete')}" id="PreMeetingModel-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{* {include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="PreMeetingModel"} *}
<script type="text/javascript">
 
        function getSiteDomoprimePreMeetingModelFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: { 
                                         name : $("[name=PreMeetingModel-name] option:selected").val()  
                                    },
                                lang: $("img.PreMeetingModel").attr('id'),                                                                                                               
                              //  nbitemsbypage: $("[name=PreMeetingModel-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".PreMeetingModel-order_active").attr("name"))
                 params.filter.order[$(".PreMeetingModel-order_active").attr("name")] =$(".PreMeetingModel-order_active").attr("id");   
            $(".PreMeetingModel-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteDomoprimePreMeetingModelFilter()
        {            
           return $.ajax2({ data: getSiteDomoprimePreMeetingModelFilterParameters(), 
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialPreMeetingModel'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",
                            target: "#actions"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".PreMeetingModel-pager .PreMeetingModel-active").html()?parseInt($(".PreMeetingModel-pager .PreMeetingModel-active").html()):1;
           records_by_page=$("[name=PreMeetingModel-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".PreMeetingModel-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#PreMeetingModel-nb_results").html())-n;
           $("#PreMeetingModel-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#PreMeetingModel-end_result").html($(".PreMeetingModel-count:last").html());
        }
        
           {* ===================== L A N G U A G E =============================== *}
         
            $("#PreMeetingModel-ChangeLang").click(function() {      
                   $("#dialogListLanguages").dialog("open");
            });
            
            $("#dialogListLanguages").bind('select',function(event){                
                $(".PreMeetingModel[name=lang]").attr({                           
                                      id: event.selected.id,
                                      src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                      title: event.selected.lang
                                      });
               $("#PreMeetingModelChangeLang").show();
               updateSiteDomoprimePreMeetingModelFilter();
            });   
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#PreMeetingModel-init").click(function() {   
              
               $.ajax2({ url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialPreMeetingModel'])}",
                         errorTarget: ".site-errors",
                         loading: "#tab-site-dashboard-x-settings-loading",                         
                         target: "#actions"}); 
           }); 
    
          $('.PreMeetingModel-order').click(function() {
                $(".PreMeetingModel-order_active").attr('class','PreMeetingModel-order');
                $(this).attr('class','PreMeetingModel-order_active');
                return updateSiteDomoprimePreMeetingModelFilter();
           });
           
            $(".PreMeetingModel-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSitePreMeetingModelFilter();
            });
            
          $("#PreMeetingModel-filter").click(function() { return updateSiteDomoprimePreMeetingModelFilter(); }); 
          
          $("[name=PreMeetingModel-nbitemsbypage]").change(function() { return updateSiteDomoprimePreMeetingModelFilter(); }); 
          
         // $("[name=PreMeetingModel-name]").change(function() { return updateSitePreMeetingModelFilter(); }); 
           
           $(".PreMeetingModel-pager").click(function () {      
              
                return $.ajax2({ data: getSiteDomoprimePreMeetingModelFilterParameters(), 
                                 url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialPreMeetingModel'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 target: "#actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#Model-New").click( function () { 
            
            return $.ajax2({
                data : { lang : { lang: $("img.PreMeetingModel[name=lang]").attr('id'),token: "{mfForm::getToken('LanguageFrontendForm')}" } },                
                url: "{url_to('app_domoprime_ajax',['action'=>'NewPreMeetingModelI18n'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         });
         
         $(".PreMeetingModel-View").click( function () { 
                
                return $.ajax2({ data : { DomoprimePreMeetingModelI18n : { 
                                                model_id: $(this).attr('id'),
                                                lang: $("img.PreMeetingModel[name=lang]").attr('id')                                              
                                    } },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('app_domoprime_ajax',['action'=>'ViewPreMeetingModelI18n'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         }); 
         
         
          $(".PreMeetingModel-ViewPDF").click( function () {             
             return $.ajax2({  data : { PreMeetingModelI18n : { 
                                                model_id: $(this).attr('id'),
                                                lang: $("img.PreMeetingModel[name=lang]").attr('id')                                              
                                    } }, 
                                url :"{url_to('app_domoprime_ajax',['action'=>'ViewPDFPreMeetingModelI18n'])}",
                                errorTarget: ".site-errors",
                                loading: "#tab-site-dashboard-x-settings-loading",
                                target: "#actions"});
         }); 
         
        $(".PreMeetingModel-list").dblclick( function () {               
            
                return $.ajax2({ data : { DomoprimePreMeetingModelI18n : { 
                                                model_id: $(this).attr('name'),
                                                lang: $("img.PreMeetingModel[name=lang]").attr('id')                                              
                                    } },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('app_domoprime_ajax',['action'=>'ViewPreMeetingModelI18n'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });    
         
          $(".PreMeetingModel-Delete").click( function () { 
                if (!confirm('{__("Model \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ DomoprimePreMeetingModelI18n: $(this).attr('id') },
                                 url :"{url_to('app_domoprime_ajax',['action'=>'DeletePreMeetingModelI18n'])}",
                                 errorTarget: ".site-errors",     
                                 loading: "#tab-site-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='deleteModelI18n')
                                       {    
                                          $("tr#PreMeetingModel-"+resp.id).remove();  
                                          if ($('.PreMeetingModel-list').length==0)
                                          {
                                              return $.ajax2({ url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialPreMeetingModel'])}",
                                                               errorTarget: ".site-errors",
                                                               target: "#tab-dashboard-site-x-settings"});
                                          }         
                                          updateSitePager(1);
                                        }       
                                 }
                     });                                        
            });
            
            
       $("#Model-NewPDF").click( function () {             
            return $.ajax2({   
                data : { lang : { lang: $("img.PreMeetingModel[name=lang]").attr('id'),token: "{mfForm::getToken('LanguageFrontendForm')}" } },                
                url: "{url_to('app_domoprime_ajax',['action'=>'NewPDFPreMeetingModelI18n'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         }); 
</script>    