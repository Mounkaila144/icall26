{messages class="site-errors"}
<h3>{__('Documents for polluter [%s]',$polluter->get('name'))}</h3>    
{if $polluter->isLoaded()}
   <div>
   <a href="#" id="PartnerPolluterDocuments-Cancel" class="btn"> <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>    
   <a target="_blank" href="{url_to('partners_polluter',['action'=>'ExportDocumentsForPolluter'])}?token={mfForm::getToken('ExportMultipleDocumentForPolluerForm')}&polluter={$polluter->get('id')}" class="btn" id="PolluterModel-ExportPDF" title="{__('Export PDF documents archive')}" ><i class="fa fa-upload" style="margin-right:10px;"></i>
        {__('Export PDF documents archive')}</a>  
</div>

{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="PartnerPolluterDocuments"}
<div>
        <button style="width:135px" id="PartnerPolluterDocuments-filter" class="btn-table">{__("Filter")}</button>
        <button style="width:135px" id="PartnerPolluterDocuments-init" class="btn-table">{__("Init")}</button>
    </div>
<div>       
    <img class="PartnerPolluterDocuments" id="{$formFilter.lang}" name="lang" src="{url("/flags/`$formFilter.lang|default:"__"`.png","picture")}" title="{if $formFilter.lang->hasError()}{$formFilter.lang}{else}{format_country($formFilter.lang)}{/if}" />
    <style> .ui-dialog { font-size: 62.5%; }</style> 
    <a id="PartnerPolluterDocuments-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a>
    {component name="/site_languages/dialogListLanguagesFrontend" selected=$formFilter.lang}   
</div>    
<div class="containerDivResp">
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0">  
    <thead>
    <tr class="list-header">    
    <th>#</th>                 
        <th class="footable-first-column" data-toggle="true">
            <span>{__('Name')}</span>                
        </th>  
        <th class="footable-first-column" data-toggle="true">
            <span>{__('Model')}</span>                
        </th>  
        <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
    </tr> 
</thead>
    {* search/equal/range *}
     <tr class="input-list">
       <td>{* # *}</td>           
       <td>{* name *}</td>  
       <td>{* name *}</td>  
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="PartnerPolluterDocuments list" id="PartnerPolluterDocuments-{$item->get('id')}"> 
        <td class="PartnerPolluterDocuments-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>                      
            <td>                
                {$item->getDocument()->get('name')}   
            </td> 
              <td>                
                {if $item->hasModel()}                       
                    {if $item->getModel()->hasI18n()}
                       {$item->getModel()->getI18n()}  ({$item->get('model_id')})
                    {else}
                        {__('No title')} 
                    {/if}    
                {else}
                    {__('---')}
                {/if}    
            </td>   
            <td>               
                <a href="#" title="{__('Edit')}" class="PartnerPolluterDocuments-View" id="{$item->getDocument()->get('id')}">
                    <i class="fa fa-edit" style="font-size: 16px;"></i> </a>                                             
            </td>
    </tr>    
    {/foreach}    
</table>  
</div>
{if !$pager->getNbItems()}
     <span>{__('No document')}</span>
{else}
    
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="PartnerPolluterDocuments"}

   <script type="text/javascript">
 $('.buttonSlide').click(function(){        $('#body').toggleClass('close-slide');   });
        
        function getSitePartnerPolluterDocumentsFilterParameters()
        {
            var params={    Polluter: '{$polluter->get('id')}',
                            filter: {  order : { }, 
                                    search : { },
                                    equal: { 
                                         name : $("[name=PartnerPolluterDocuments-name] option:selected").val()  
                                    },
                                lang: $("img.PartnerPolluterDocuments").attr('id'),                                                                                                               
                                nbitemsbypage: $("[name=PartnerPolluterDocuments-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".PartnerPolluterDocuments-order_active").attr("name"))
                 params.filter.order[$(".PartnerPolluterDocuments-order_active").attr("name")] =$(".PartnerPolluterDocuments-order_active").attr("id");   
            $(".PartnerPolluterDocuments-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSitePartnerPolluterDocumentsFilter()
        {           
           return $.ajax2({ data: getSitePartnerPolluterDocumentsFilterParameters(), 
                            url:"{url_to('partners_polluter_ajax',['action'=>'ListPartialDocumentForPolluter'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-x-settings-loading", 
                            target: "#actions"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".PartnerPolluterDocuments-pager .PartnerPolluterDocuments-active").html()?parseInt($(".PartnerPolluterDocuments-pager .PartnerPolluterDocuments-active").html()):1;
           records_by_page=$("[name=PartnerPolluterDocuments-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".PartnerPolluterDocuments-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#PartnerPolluterDocuments-nb_results").html())-n;
           $("#PartnerPolluterDocuments-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#PartnerPolluterDocuments-end_result").html($(".PartnerPolluterDocuments-count:last").html());
        }
        
         
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#PartnerPolluterDocuments-init").click(function() {                 
               $.ajax2({ data : { Polluter: '{$polluter->get('id')}' },
                         url:"{url_to('partners_polluter_ajax',['action'=>'ListPartialDocumentForPolluter'])}",
                         errorTarget: ".site-errors",
                         loading: "#tab-site-dashboard-x-settings-loading",                         
                         target: "#actions"}); 
           }); 
    
          $('.PartnerPolluterDocuments-order').click(function() {
                $(".PartnerPolluterDocuments-order_active").attr('class','PartnerPolluterDocuments-order');
                $(this).attr('class','PartnerPolluterDocuments-order_active');
                return updateSitePartnerPolluterDocumentsFilter();
           });
           
            $(".PartnerPolluterDocuments-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSitePartnerPolluterDocumentsFilter();
            });
            
          $("#PartnerPolluterDocuments-filter").click(function() { return updateSitePartnerPolluterDocumentsFilter(); }); 
          
          $("[name=PartnerPolluterDocuments-nbitemsbypage]").change(function() { return updateSitePartnerPolluterDocumentsFilter(); }); 
          
         // $("[name=PartnerPolluterDocuments-name]").change(function() { return updateSitePartnerPolluterDocumentsFilter(); }); 
           
           $(".PartnerPolluterDocuments-pager").click(function () {                     
                return $.ajax2({ data: getSitePartnerPolluterDocumentsFilterParameters(), 
                                 url:"{url_to('partners_polluter_ajax',['action'=>'ListPartialDocumentForPolluter'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 target: "#actions"
                });
        });
          {* =====================  A C T I O N S =============================== *}                               
         
         $(".PartnerPolluterDocuments-View").click( function () {                
                return $.ajax2({ data : { Polluter: '{$polluter->get('id')}', 
                                          Document:  $(this).attr('id')                                                             
                                        },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('partners_polluter_ajax',['action'=>'ViewDocumentForPolluter'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
                    
         
         
            
       $("#PartnerPolluterDocuments-Cancel").click( function () {              
                return $.ajax2({ loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialPollutingCompany'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
         
     
</script>    
{else}
    {__('Polluter is invalid.')}
{/if}    

