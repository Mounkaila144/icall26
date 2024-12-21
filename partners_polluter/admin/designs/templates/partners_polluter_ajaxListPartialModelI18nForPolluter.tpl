{messages class="site-errors"}
<h3>{__('Models for polluter [%s]',$polluter->get('name'))}</h3>    
{if $polluter->isLoaded()}
<div>
   <a href="#" id="PolluterModel-Cancel" class="btn"> <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
   <a href="#" class="btn" id="PolluterModel-New" title="{__('New model')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>
      {__('New model')}</a>    
   <a href="#" class="btn" id="PolluterModel-NewPDF" title="{__('New PDF model')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>
      {__('New PDF model')}</a> 
    <a href="#" class="btn" id="PolluterModel-NewDoc" title="{__('New Doc model')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>
      {__('New Doc model')}</a> 
    <a href="#" class="btn" id="PolluterModel-ImportPDF" title="{__('Import PDF models archive')}" ><i class="fa fa-download" style="margin-right:10px;"></i>
        {__('Import PDF models archive')}</a>  
     <a target="_blank" href="{url_to('partners_polluter',['action'=>'ExportModelsForPolluter'])}?token={mfForm::getToken('ExportMultipleModelForPolluterForm')}&polluter={$polluter->get('id')}&selection=" class="btn" id="PolluterModel-ExportPDF" title="{__('Export PDF models archive')}" ><i class="fa fa-upload" style="margin-right:10px;"></i>
        {__('Export PDF models archive')}</a>  
      <a target="_blank" href="{url_to('partners_polluter',['action'=>'ExportExtendedModelsForPolluter'])}?token={mfForm::getToken('ExportMultipleExtendedModelForPolluterForm')}&polluter={$polluter->get('id')}&selection=" class="btn" id="PolluterModel-ExportExtendedPDF"  title="{__('Export Extended PDF models archive')}" ><i class="fa fa-upload" style="margin-right:10px;"></i>
        {__('Export Extended PDF models archive')}</a>  
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="PolluterModel"}
<button id="PolluterModel-filter" class="btn-table" style="width:auto">{__("Filter")}</button>   
<button id="PolluterModel-init" class="btn-table">{__("Init")}</button>
<div>       
    <img class="PolluterModel" id="{$formFilter.lang}" name="lang" src="{url("/flags/`$formFilter.lang|default:"__"`.png","picture")}" title="{if $formFilter.lang->hasError()}{$formFilter.lang}{else}{format_country($formFilter.lang)}{/if}" />
    <style> .ui-dialog { font-size: 62.5%; }</style> 
    <a id="PolluterModel-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a>
    {component name="/site_languages/dialogListLanguagesFrontend" selected=$formFilter.lang}   
</div>
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0"> 
    <thead>
    <tr class="list-header">    
        <th>#</th>     
        <th></th>   
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('ID')}</span>          
        </th>
        <th  class="footable-first-column" data-toggle="true">
            <span>{__('Name')}</span>          
        </th>
        <th  class="footable-first-column" data-toggle="true">
            <span>{__('Value')}</span>
           {* <div>
                <a href="#" class="PolluterModel-order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="name"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                <a href="#" class="PolluterModel-order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="name"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
            </div>  *}
        </th>
         <th data-hide="phone" style="display: table-cell;">
            <span>{__('File')}</span>                 
        </th>     
        <th>
            <span>{__('Doc?')}</span>  
        </th>
        <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
    </tr>
</thead> 
    {* search/equal/range *}
    <tr class="input-list">
       <td>{* # *}</td>
       <td>{* # *}</td>
       <td></td>
       <td>{* name *}
           
       </td>
       <td>{* name *}
           
       </td>       
       <td>{* phone *}
          
       </td> 
       <td>
          {html_options name="document" class="PolluterModel-equal" options=$formFilter->equal.document->getChoices() selected=$formFilter.equal.document}
       </td>
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="PolluterModel list" id="PolluterModel-{$item->get('id')}"> 
        <td class="PolluterModel-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>      
            <td>
                <input type="checkbox" class="selected" id="{$item->get('id')}"/>
            </td>
             <td>                
               {$item->get('id')}    
            </td>
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
                {if $item->hasDocument()}
                    {__('Used')}
                {else}
                {__('Not used')}    
                {/if}
            </td>
            <td>               
                {if $item->hasI18n() && $item->getI18n()->hasFile()}
                    {if $item->getI18n()->isPdf()}
                    <a href="#" title="{__('Edit PDF')}" class="PolluterModel-ViewPDF" id="{$item->get('id')}">
                     <i class="fa fa-edit"/></a>   
                   {else} 
                    <a href="#" title="{__('Edit Doc')}" class="PolluterModel-ViewDoc" id="{$item->get('id')}">
                     <i class="fa fa-edit"/></a>   
                   {/if}
                {else}
                     <a href="#" title="{__('Edit')}" class="PolluterModel-View" id="{$item->get('id')}">
                     <i class="fa fa-edit"/></a>  
                {/if}  
                {if $user->hasCredential([['superadmin']])}
                <a target="_blank" href="{url_to('partners_polluter',['action'=>'ExportXMLModel'])}?model={$item->get('id')}" title="{__('xml')}">
                     <i class="fa fa-file-code-o"/></a> 
                     {/if}
                <a target="_blank" href="{url_to('partners_polluter',['action'=>'PreviewModel'])}?model={$item->get('id')}" title="{__('Preview')}">
                     <i class="fa fa-eye"/></a> 
                 {if $item->hasI18n() && $item->getI18n()->hasFile() && $item->getI18n()->isDocX()}
                    <a target="_blank" href="{url_to('partners_polluter',['action'=>'PreviewDocModelPdf'])}?model={$item->get('id')}" title="{__('Preview DOCX in PDF')}">
                     <i class="fa fa-file-pdf-o"/></a>  
                 {/if}    
                <a href="#" title="{__('Delete')}" class="PolluterModel-Delete" id="{$item->get('id')}"  name="{if $item->hasI18n()}{$item->getI18n()->get('value')}{/if}">
                   <i class="fa fa-trash"/>
                </a>                      
            </td>
    </tr>    
    {/foreach}    
</table>    
{if !$pager->getNbItems()}
     <span>{__('No model')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="PolluterModel-all" /> 
          <a style="opacity:0.5" class="PolluterModel-actions_items" href="#" title="{__('Delete')}" id="DomomprimeZone-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="PolluterModel"}
<script type="text/javascript">
 {* ===================== L A N G U A G E =============================== *}
         
            $("#PolluterModel-ChangeLang").click(function() {      
                   $("#dialogListLanguages").dialog("open");
            });
            
            $("#dialogListLanguages").bind('select',function(event){                
                $(".PolluterModel[name=lang]").attr({                           
                                      id: event.selected.id,
                                      src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                      title: event.selected.lang
                                      });
               $("#PolluterModel-ChangeLang").show();
               updateSitePolluterModelFilter();
            });   
            
        function getSitePolluterModelFilterParameters()
        {
            var params={ Polluter: '{$polluter->get('id')}', 
                         filter: {  order : { }, 
                                    search : { },
                                    equal: { },   
                                     lang: $("img.PolluterModel").attr('id'),           
                                nbitemsbypage: $("[name=PolluterModel-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".PolluterModel-order_active").attr("name"))
                 params.filter.order[$(".PolluterModel-order_active").attr("name")] =$(".PolluterModel-order_active").attr("id");   
            $(".PolluterModel-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            $(".PolluterModel-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });  
            $(".PolluterModel-equal option:selected").each(function() { params.filter.equal[$(this).parent().attr('name')] =$(this).val(); });  
            return params;                  
        }
        
        function updateSitePolluterModelFilter()
        {           
           return $.ajax2({ data: getSitePolluterModelFilterParameters(), 
                            url:"{url_to('partners_polluter_ajax',['action'=>'ListPartialModelI18nForPolluter'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",
                            target: "#actions"
                             });
        }
    
        function updateSitePager(n)
        {
           var page_active=$(".PolluterModel-pager .PolluterModel-active").html()?parseInt($(".PolluterModel-pager .PolluterModel-active").html()):1;
           var records_by_page=$("[name=PolluterModel-nbitemsbypage]").val();
           var start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".PolluterModel-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           var nb_results=parseInt($("#PolluterModel-nb_results").html())-n;
           $("#PolluterModel-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#PolluterModel-end_result").html($(".PolluterModel-count:last").html());
        }
        
           
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#PolluterModel-init").click(function() {                  
               $.ajax2({ data : { Polluter: '{$polluter->get('id')}' },
                        url:"{url_to('partners_polluter_ajax',['action'=>'ListPartialModelI18nForPolluter'])}",
                        errorTarget: ".site-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions"}); 
           }); 
    
          $('.PolluterModel-order').click(function() {
                $(".PolluterModel-order_active").attr('class','PolluterModel-order');
                $(this).attr('class','PolluterModel-order_active');
                return updateSitePolluterModelFilter();
           });
           
            $(".PolluterModel-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSitePolluterModelFilter();
            });
            
          $("#PolluterModel-filter").click(function() { return updateSitePolluterModelFilter(); }); 
          
          $("[name=PolluterModel-nbitemsbypage],.PolluterModel-equal").change(function() { return updateSitePolluterModelFilter(); }); 
          
         // $("[name=PolluterModel-name]").change(function() { return updateSitePolluterModelFilter(); }); 
           
           $(".PolluterModel-pager").click(function () {                    
                return $.ajax2({ data: getSitePolluterModelFilterParameters(), 
                                url:"{url_to('partners_polluter_ajax',['action'=>'ListPartialModelI18nForPolluter'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                errorTarget: ".site-errors",
                                loading: "#tab-site-dashboard-x-settings-loading",
                                target: "#actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#PolluterModel-New").click( function () {             
            return $.ajax2({   
                data : { Polluter: '{$polluter->get('id')}', lang : { lang: $("img.PolluterModel[name=lang]").attr('id'),token: "{mfForm::getToken('LanguageFrontendForm')}" } },                
                url: "{url_to('partners_polluter_ajax',['action'=>'NewModelI18nForPolluter'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         });
         
         $(".PolluterModel-View").click( function () {                       
                return $.ajax2({  data : { PolluterModelI18n : { 
                                                model_id: $(this).attr('id'),
                                                lang: $("img.PolluterModel[name=lang]").attr('id')                                              
                                    } }, 
                                url :"{url_to('partners_polluter_ajax',['action'=>'ViewModelI18nForPolluter'])}",
                                errorTarget: ".site-errors",
                                loading: "#tab-site-dashboard-x-settings-loading",
                                target: "#actions"});
         });
         
         
       
            $(".PolluterModel-ViewPDF").click( function () {                       
                return $.ajax2({  data : { PolluterModelI18n : { 
                                                model_id: $(this).attr('id'),
                                                lang: $("img.PolluterModel[name=lang]").attr('id')                                              
                                    } }, 
                                url :"{url_to('partners_polluter_ajax',['action'=>'ViewPDFModelI18nForPolluter'])}",
                                errorTarget: ".site-errors",
                                loading: "#tab-site-dashboard-x-settings-loading",
                                target: "#actions"});
         });
                    
         
          $(".PolluterModel-Delete").click( function () { 
                if (!confirm('{__("Model \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ Model: $(this).attr('id') },
                                url :"{url_to('partners_polluter_ajax',['action'=>'DeleteModel'])}",
                                errorTarget: ".site-errors",
                                loading: "#tab-site-dashboard-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='DeleteModel')
                                       {    
                                          $("tr#PolluterModel-"+resp.id).remove();  
                                          if ($('.PolluterModel').length==0)
                                            return $.ajax2({ url:"{url_to('partners_polluter_ajax',['action'=>'ListPartialPollutingCompany'])}",
                                            errorTarget: ".site-servers-errors",
                                            loading: "#tab-site-dashboard-x-settings-loading"});
                                          updateSitePager(1);
                                        }       
                                 }
                     });                                        
            });
            
         
            
       $("#PolluterModel-Cancel").click( function () {              
                return $.ajax2({ loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialPollutingCompany'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
         
              
        $("#PolluterModel-NewPDF").click( function () {             
            return $.ajax2({   
                data : { Polluter: '{$polluter->get('id')}', lang : { lang: $("img.PolluterModel[name=lang]").attr('id'),token: "{mfForm::getToken('LanguageFrontendForm')}" } },                
                url: "{url_to('partners_polluter_ajax',['action'=>'NewPDFModelI18nForPolluter'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         }); 
	
        
         $("#PolluterModel-ImportPDF").click( function () {
     return $.ajax2({
         data : { Polluter: '{$polluter->get('id')}' },
         url: "{url_to('partners_polluter_ajax',['action'=>'ImportPDFArchiveForPolluter'])}",
         errorTarget: ".site-errors",
         loading: "#tab-site-dashboard-x-settings-loading",
         target: "#actions"
     });
 });
 
        $(".selected").click(function () {       
            var selection= [ ];
            $(".selected:checked").each(function () { selection.push($(this).attr('id')); });            
            $("#PolluterModel-ExportExtendedPDF").attr('href',"{url_to('partners_polluter',['action'=>'ExportExtendedModelsForPolluter'])}?token={mfForm::getToken('ExportMultipleModelForPolluerForm')}&polluter={$polluter->get('id')}&selection="+selection.join(','));
            $("#PolluterModel-ExportPDF").attr('href',"{url_to('partners_polluter',['action'=>'ExportModelsForPolluter'])}?token={mfForm::getToken('ExportMultipleModelForPolluerForm')}&polluter={$polluter->get('id')}&selection="+selection.join(','));
        });
        
        
          $("#PolluterModel-NewDoc").click( function () {             
            return $.ajax2({   
                data : { Polluter: '{$polluter->get('id')}', lang : { lang: $("img.PolluterModel[name=lang]").attr('id'),token: "{mfForm::getToken('LanguageFrontendForm')}" } },                
                url: "{url_to('partners_polluter_ajax',['action'=>'NewDocModelI18nForPolluter'])}",
                errorTarget: ".site-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
           });
         }); 
         
         
         $(".PolluterModel-ViewDoc").click( function () {                       
                return $.ajax2({  data : { PolluterModelI18n : { 
                                                model_id: $(this).attr('id'),
                                                lang: $("img.PolluterModel[name=lang]").attr('id')                                              
                                    } }, 
                                url :"{url_to('partners_polluter_ajax',['action'=>'ViewDocModelI18nForPolluter'])}",
                                errorTarget: ".site-errors",
                                loading: "#tab-site-dashboard-x-settings-loading",
                                target: "#actions"});
         });
</script>    
{else}
    {__('Polluter is invalid.')}
{/if}    
