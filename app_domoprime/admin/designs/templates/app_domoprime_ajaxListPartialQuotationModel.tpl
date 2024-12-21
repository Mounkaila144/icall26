{messages class="site-errors"}
<h3>{__('Quotation models')}</h3>    
<div>
  <a href="#" class="btn" id="QuotationModel-New" title="{__('New model')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>{__('New model')}</a>   

</div>
{* {include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="QuotationModel"}
<button  id="QuotationModel-filter" class="btn-table">{__("Filter")}</button>   <button class="btn-table" id="QuotationModel-init">{__("Init")}</button> *}
<div>       
    <img class="QuotationModel" id="{$formFilter.lang}" name="lang" src="{url("/flags/`$formFilter.lang|default:"__"`.png","picture")}" title="{if $formFilter.lang->hasError()}{$formFilter.lang}{else}{format_country($formFilter.lang)}{/if}" />
    <style> .ui-dialog { font-size: 62.5%; }</style> 
    <a id="QuotationModel-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a>
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
                <a href="#" class="QuotationModel-order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="name"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="QuotationModel-order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="name"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div> 
        </th>         
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('Value')}</span>      
            <div>
                <a href="#" class="QuotationModel-order{$formFilter.order.value->getValueExist('asc','_active')}" id="asc" name="value"><img  src='{url("/icons/sort_asc`$formFilter.order.value->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="QuotationModel-order{$formFilter.order.value->getValueExist('desc','_active')}" id="desc" name="value"><img  src='{url("/icons/sort_desc`$formFilter.order.value->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
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
    <tr class="QuotationModel-list list" {if $item->hasDomoprimeQuotationModelI18n()}id="QuotationModel-{$item->getDomoprimeQuotationModelI18n()->get('id')}" name="{$item->getDomoprimeQuotationModelI18n()->get('id')}"{/if}> 
        <td class="QuotationModel-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
            {if $pager->getNbItems()>5}
                <td>        
                    {if $item->hasDomoprimeQuotationModelI18n()}
                    <input class="QuotationModel-selection" type="checkbox" id="{$item->getDomoprimeQuotationModelI18n()->get('id')}" name="{$item->getDomoprimeQuotationModelI18n()->get('name')}"/>   
                    {/if}
                </td>
            {/if}          
            <td>                
                    {$item->getDomoprimeQuotationModel()->get('name')}
            </td>            
            <td>
                {if $item->hasDomoprimeQuotationModelI18n()}
                     {$item->getDomoprimeQuotationModelI18n()->get('value')}
                {else}
                    {__('----')}
                {/if}    
            </td>             
            <td>               
                <a href="#" title="{__('Edit')}" class="QuotationModel-View" id="{$item->getDomoprimeQuotationModel()->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a>              
                {if $item->hasDomoprimeQuotationModelI18n()}<a href="#" title="{__('Delete')}" class="QuotationModel-Delete" id="{$item->getDomoprimeQuotationModelI18n()->get('id')}"  name="{$item->getDomoprimeQuotationModelI18n()->get('value')}">
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
        <input type="checkbox" id="QuotationModel-all" /> 
          <a style="opacity:0.5" class="QuotationModel-actions_items" href="#" title="{__('delete')}" id="QuotationModel-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{* {include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="QuotationModel"} *}
<script type="text/javascript">
 
        function getSiteDomoprimeQuotationModelFilterParameters()
        {
            var params={ filter: {  order : { }, 
                                    search : { },
                                    equal: { 
                                         name : $("[name=QuotationModel-name] option:selected").val()  
                                    },
                                lang: $("img.QuotationModel").attr('id'),                                                                                                               
                              //  nbitemsbypage: $("[name=QuotationModel-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".QuotationModel-order_active").attr("name"))
                 params.filter.order[$(".QuotationModel-order_active").attr("name")] =$(".QuotationModel-order_active").attr("id");   
            $(".QuotationModel-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteDomoprimeQuotationModelFilter()
        {            
           return $.ajax2({ data: getSiteDomoprimeQuotationModelFilterParameters(), 
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialQuotationModel'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",
                            target: "#actions"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".QuotationModel-pager .QuotationModel-active").html()?parseInt($(".QuotationModel-pager .QuotationModel-active").html()):1;
           records_by_page=$("[name=QuotationModel-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".QuotationModel-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#QuotationModel-nb_results").html())-n;
           $("#QuotationModel-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#QuotationModel-end_result").html($(".QuotationModel-count:last").html());
        }
        
           {* ===================== L A N G U A G E =============================== *}
         
            $("#QuotationModel-ChangeLang").click(function() {      
                   $("#dialogListLanguages").dialog("open");
            });
            
            $("#dialogListLanguages").bind('select',function(event){                
                $(".QuotationModel[name=lang]").attr({                           
                                      id: event.selected.id,
                                      src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                      title: event.selected.lang
                                      });
               $("#QuotationModelChangeLang").show();
               updateSiteDomoprimeQuotationModelFilter();
            });   
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#QuotationModel-init").click(function() {   
              
               $.ajax2({ url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialQuotationModel'])}",
                         errorTarget: ".site-errors",
                         loading: "#tab-site-dashboard-x-settings-loading",                         
                         target: "#actions"}); 
           }); 
    
          $('.QuotationModel-order').click(function() {
                $(".QuotationModel-order_active").attr('class','QuotationModel-order');
                $(this).attr('class','QuotationModel-order_active');
                return updateSiteDomoprimeQuotationModelFilter();
           });
           
            $(".QuotationModel-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteQuotationModelFilter();
            });
            
          $("#QuotationModel-filter").click(function() { return updateSiteDomoprimeQuotationModelFilter(); }); 
          
          $("[name=QuotationModel-nbitemsbypage]").change(function() { return updateSiteDomoprimeQuotationModelFilter(); }); 
          
         // $("[name=QuotationModel-name]").change(function() { return updateSiteQuotationModelFilter(); }); 
           
           $(".QuotationModel-pager").click(function () {      
              
                return $.ajax2({ data: getSiteDomoprimeQuotationModelFilterParameters(), 
                                 url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialQuotationModel'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 target: "#actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#QuotationModel-New").click( function () { 
            
            return $.ajax2({
                data : { lang : { lang: $("img.QuotationModel[name=lang]").attr('id'),token: "{mfForm::getToken('LanguageFrontendForm')}" } },                
                url: "{url_to('app_domoprime_ajax',['action'=>'NewQuotationModelI18n'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         });
         
         $(".QuotationModel-View").click( function () { 
                
                return $.ajax2({ data : { DomoprimeQuotationModelI18n : { 
                                                model_id: $(this).attr('id'),
                                                lang: $("img.QuotationModel[name=lang]").attr('id')                                              
                                    } },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('app_domoprime_ajax',['action'=>'ViewQuotationModelI18n'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });                        
         
        $(".QuotationModel-list").dblclick( function () {               
            
                return $.ajax2({ data : { DomoprimeQuotationModelI18n : { 
                                                model_id: $(this).attr('name'),
                                                lang: $("img.QuotationModel[name=lang]").attr('id')                                              
                                    } },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('app_domoprime_ajax',['action'=>'ViewQuotationModelI18n'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });    
         
          $(".QuotationModel-Delete").click( function () { 
                if (!confirm('{__("Model \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ DomoprimeQuotationModelI18n: $(this).attr('id') },
                                 url :"{url_to('app_domoprime_ajax',['action'=>'DeleteQuotationModelI18n'])}",
                                 errorTarget: ".site-errors",     
                                 loading: "#tab-site-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='DeleteModelI18n')
                                       {    
                                          $("tr#QuotationModel-"+resp.id).remove();  
                                          if ($('.QuotationModel-list').length==0)
                                          {
                                              return $.ajax2({ url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialQuotationModel'])}",
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