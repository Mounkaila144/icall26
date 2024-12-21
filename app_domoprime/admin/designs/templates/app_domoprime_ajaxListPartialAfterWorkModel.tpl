{messages class="site-errors"}
<h3>{__('After work models')}</h3>    
<div>
  <a href="#" class="btn" id="Model-New" title="{__('New model')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>{__('New model')}</a>   
   <a href="#" class="btn" id="Model-NewPDF" title="{__('New PDF model')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>
      {__('New PDF model')}</a>  
</div>
{* {include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="AfterWorkModel"}
<button  id="AfterWorkModel-filter" class="btn-table">{__("Filter")}</button>   <button class="btn-table" id="AfterWorkModel-init">{__("Init")}</button> *}
<div>       
    <img class="AfterWorkModel" id="{$formFilter.lang}" name="lang" src="{url("/flags/`$formFilter.lang|default:"__"`.png","picture")}" title="{if $formFilter.lang->hasError()}{$formFilter.lang}{else}{format_country($formFilter.lang)}{/if}" />
    <style> .ui-dialog { font-size: 62.5%; }</style> 
    <a id="AfterWorkModel-ChangeLang" href="#" title="{__('Change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a>
    {component name="/site_languages/dialogListLanguagesFrontend" selected=$formFilter.lang}   
</div>
<div class="containerDivResp">
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0">
    <thead>
    <tr class="list-header">    
    <th>#</th>      
        <th class="footable-first-column" data-toggle="true">
            <span>{__('Name')}</span>    
            <div>
                <a href="#" class="AfterWorkModel-order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="name"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="AfterWorkModel-order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="name"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>         
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('Value')}</span>      
            <div>
                <a href="#" class="AfterWorkModel-order{$formFilter.order.value->getValueExist('asc','_active')}" id="asc" name="value"><img  src='{url("/icons/sort_asc`$formFilter.order.value->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="AfterWorkModel-order{$formFilter.order.value->getValueExist('desc','_active')}" id="desc" name="value"><img  src='{url("/icons/sort_desc`$formFilter.order.value->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
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
       <td>{* name *}</td>      
         <td>{* name *}</td>      
       <td>{* value *}</td>         
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="AfterWorkModel-list list" {if $item->hasI18n()}id="AfterWorkModel-{$item->getI18n()->get('id')}" name="{$item->getI18n()->get('id')}"{/if}> 
       <td class="AfterWorkModel-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>                                
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
                    <a href="#" title="{__('Edit PDF')}" class="AfterWorkModel-ViewPDF" id="{$item->get('id')}">
                     <i class="fa fa-edit"/></a>              
                {else}
                     <a href="#" title="{__('Edit')}" class="AfterWorkModel-View" id="{$item->get('id')}">
                     <i class="fa fa-edit"/></a>  
                {/if}   
                <a target="_blank" href="{url_to('app_domoprime',['action'=>'PreviewAfterWorkModel'])}?model={$item->get('id')}" title="{__('Preview')}">
                     <i class="fa fa-eye"/></a> 
                <a href="#" title="{__('Delete')}" class="AfterWorkModel-Delete" id="{$item->get('id')}"  name="{if $item->hasI18n()}{$item->getI18n()->get('value')}{/if}">
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
        <input type="checkbox" id="AfterWorkModel-all" /> 
          <a style="opacity:0.5" class="AfterWorkModel-actions_items" href="#" title="{__('Delete')}" id="AfterWorkModel-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{* {include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="AfterWorkModel"} *}
<script type="text/javascript">
 
        function getSiteDomoprimeAfterWorkModelFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: { 
                                         name : $("[name=AfterWorkModel-name] option:selected").val()  
                                    },
                                lang: $("img.AfterWorkModel").attr('id'),                                                                                                               
                              //  nbitemsbypage: $("[name=AfterWorkModel-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".AfterWorkModel-order_active").attr("name"))
                 params.filter.order[$(".AfterWorkModel-order_active").attr("name")] =$(".AfterWorkModel-order_active").attr("id");   
            $(".AfterWorkModel-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteDomoprimeAfterWorkModelFilter()
        {            
           return $.ajax2({ data: getSiteDomoprimeAfterWorkModelFilterParameters(), 
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialAfterWorkModel'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",
                            target: "#actions"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".AfterWorkModel-pager .AfterWorkModel-active").html()?parseInt($(".AfterWorkModel-pager .AfterWorkModel-active").html()):1;
           records_by_page=$("[name=AfterWorkModel-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".AfterWorkModel-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#AfterWorkModel-nb_results").html())-n;
           $("#AfterWorkModel-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#AfterWorkModel-end_result").html($(".AfterWorkModel-count:last").html());
        }
        
           {* ===================== L A N G U A G E =============================== *}
         
            $("#AfterWorkModel-ChangeLang").click(function() {      
                   $("#dialogListLanguages").dialog("open");
            });
            
            $("#dialogListLanguages").bind('select',function(event){                
                $(".AfterWorkModel[name=lang]").attr({                           
                                      id: event.selected.id,
                                      src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                      title: event.selected.lang
                                      });
               $("#AfterWorkModelChangeLang").show();
               updateSiteDomoprimeAfterWorkModelFilter();
            });   
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#AfterWorkModel-init").click(function() {   
              
               $.ajax2({ url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialAfterWorkModel'])}",
                         errorTarget: ".site-errors",
                         loading: "#tab-site-dashboard-x-settings-loading",                         
                         target: "#actions"}); 
           }); 
    
          $('.AfterWorkModel-order').click(function() {
                $(".AfterWorkModel-order_active").attr('class','AfterWorkModel-order');
                $(this).attr('class','AfterWorkModel-order_active');
                return updateSiteDomoprimeAfterWorkModelFilter();
           });
           
            $(".AfterWorkModel-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteAfterWorkModelFilter();
            });
            
          $("#AfterWorkModel-filter").click(function() { return updateSiteDomoprimeAfterWorkModelFilter(); }); 
          
          $("[name=AfterWorkModel-nbitemsbypage]").change(function() { return updateSiteDomoprimeAfterWorkModelFilter(); }); 
          
         // $("[name=AfterWorkModel-name]").change(function() { return updateSiteAfterWorkModelFilter(); }); 
           
           $(".AfterWorkModel-pager").click(function () {      
              
                return $.ajax2({ data: getSiteDomoprimeAfterWorkModelFilterParameters(), 
                                 url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialAfterWorkModel'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 target: "#actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#Model-New").click( function () { 
            
            return $.ajax2({
                data : { lang : { lang: $("img.AfterWorkModel[name=lang]").attr('id'),token: "{mfForm::getToken('LanguageFrontendForm')}" } },                
                url: "{url_to('app_domoprime_ajax',['action'=>'NewAfterWorkModelI18n'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         });
         
         $(".AfterWorkModel-View").click( function () { 
                
                return $.ajax2({ data : { DomoprimeAfterWorkModelI18n : { 
                                                model_id: $(this).attr('id'),
                                                lang: $("img.AfterWorkModel[name=lang]").attr('id')                                              
                                    } },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('app_domoprime_ajax',['action'=>'ViewAfterWorkModelI18n'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         }); 
         
         
          $(".AfterWorkModel-ViewPDF").click( function () {             
             return $.ajax2({  data : { AfterWorkModelI18n : { 
                                                model_id: $(this).attr('id'),
                                                lang: $("img.AfterWorkModel[name=lang]").attr('id')                                              
                                    } }, 
                                url :"{url_to('app_domoprime_ajax',['action'=>'ViewPDFAfterWorkModelI18n'])}",
                                errorTarget: ".site-errors",
                                loading: "#tab-site-dashboard-x-settings-loading",
                                target: "#actions"});
         }); 
         
        $(".AfterWorkModel-list").dblclick( function () {               
            
                return $.ajax2({ data : { DomoprimeAfterWorkModelI18n : { 
                                                model_id: $(this).attr('name'),
                                                lang: $("img.AfterWorkModel[name=lang]").attr('id')                                              
                                    } },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('app_domoprime_ajax',['action'=>'ViewAfterWorkModelI18n'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });    
         
          $(".AfterWorkModel-Delete").click( function () { 
                if (!confirm('{__("Model \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ DomoprimeAfterWorkModel: $(this).attr('id') },
                                 url :"{url_to('app_domoprime_ajax',['action'=>'DeleteAfterWorkModel'])}",
                                 errorTarget: ".site-errors",     
                                 loading: "#tab-site-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='DeleteModel')
                                       {    
                                          $("tr#AfterWorkModel-"+resp.id).remove();  
                                          if ($('.AfterWorkModel-list').length==0)
                                          {
                                              return  updateSiteDomoprimeAfterWorkModelFilter();
                                          }         
                                          updateSitePager(1);
                                        }       
                                 }
                     });                                        
            });
            
            
       $("#Model-NewPDF").click( function () {             
            return $.ajax2({   
                data : { lang : { lang: $("img.AfterWorkModel[name=lang]").attr('id'),token: "{mfForm::getToken('LanguageFrontendForm')}" } },                
                url: "{url_to('app_domoprime_ajax',['action'=>'NewPDFAfterWorkModelI18n'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         }); 
</script>    