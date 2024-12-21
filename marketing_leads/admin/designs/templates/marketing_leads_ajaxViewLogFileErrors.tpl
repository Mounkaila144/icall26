{messages class="site-errors"}
<h3>{__('Import file errors history')}</h3>  

<div>
    <a href="javascript:void(0);" class="btn" id="ImportFileLogErrorsView-Return" title="{__('Return')}"><i class="fa fa-arrow-left" style="margin-right:10px;"></i>{__('Return')}</a>  
</div>

{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager class="ImportFileLogErrors" formfilter=$formFilter}
<button id="ImportFileLogErrors-filter" class="btn-table">{__("Filter")}</button> 
<button id="ImportFileLogErrors-init" class="btn-table">{__("Init")}</button>
<div class="containerDivResp">
<table cellpadding="0" cellspacing="0" class="tabl-list footable table"> 
    <thead>
        <tr  class="list-header">     
            <th data-hide="phone" style="display: table-cell;" >#</th> 
            <th data-hide="phone" style="display: table-cell;">
                <span>{__("Line")}</span>               
            </th>
            <th data-hide="phone" style="display: table-cell;">
                <span>{__("Errors")}</span>               
            </th>
        </tr>
    </thead>
    {foreach $pager as $index=>$item}
    <tr class="ImportFileLogErrors list" id="ImportFileLogErrors-{$item->get('id')}"> 
        <td class="ImportFileLogErrors-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
        <td><a id="{$item->get('id')}" class="ImportFileLogErrors-ViewLine" href="javascript:void(0);" data-line="{$item->get('line')}">{$item->get('line')}</a></td>
        <td> 
            <table style="width: 100%;">
                {foreach $item->dispalyErrorsAsTab() as $field=>$error}
                <tr>
                    <td id="{$item->get('id')}" class="error-field" data-field="{$field}">{$error}</td>
                </tr>
                {/foreach}
            </table>
        </td>
    </tr>    
    {/foreach}
    
</table> 
</div>
{if !$pager->getNbItems()}
    <span>{__('No lines')}</span>
{else}
    
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="ImportFileLogErrors"} 

<script type="text/javascript">
    

    function updateSitePager(n)
    {
        page_active=$(".ImportFileLogErrors-pager .ImportFile-active").html()?parseInt($(".ImportFileLogErrors-pager .ImportFileLogErrors-active").html()):1;
        records_by_page=$("[name=ImportFileLogErrors-nbitemsbypage]").val();
        start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
        $(".ImportFileLogErrors-count").each(function(id) { $(this).html(start+id) }); // Update index column           
        nb_results=parseInt($("#ImportFileLogErrors-nb_results").html())-n;
        $("#ImportFileLogErrors-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
        $("#ImportFileLogErrors-end_result").html($(".ImportFileLogErrors-count:last").html());
    }


    {* =====================  P A G E R  A C T I O N S =============================== *}  
    
    $(".ImportFileLogErrors-pager").click(function () {                      
        return $.ajax2({ data: { Import: {$import->get('id')} }, 
                        url:"{url_to('marketing_leads_ajax',['action'=>'ViewLogFileErrors'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                        errorTarget: ".site-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions-wp-landing-page-site-list"
        });
    });
    
    {* =====================  A C T I O N S =============================== *}  
        
    $("#ImportFileLogErrorsView-Return").click( function() {
        return $.ajax2({
            url: "{url_to('marketing_leads_ajax',['action'=>'ListPartialFiles'])}",
            errorTarget: ".site-errors",
            loading: "#tab-site-dashboard-x-settings-loading",
            target: "#actions-wp-landing-page-site-list"
        });
    });
    
    $(".ImportFileLogErrors-ViewLine").click( function() {
        var error_field = $(".error-field[id="+$(this).attr("id")+"]").attr("data-field");
        return $.ajax2({
            data: { Import: {$import->get('id')}, Line: $(this).attr("data-line"), Field: error_field, token: "{mfForm::getToken('MarketingLeadsWpFormsLeadsImportViewCsvFileForm')}" },
            url: "{url_to('marketing_leads_ajax',['action'=>'ViewLogFromLine'])}",
            errorTarget: ".site-errors",
            loading: "#tab-site-dashboard-x-settings-loading",
            target: "#actions-wp-landing-page-site-list"
        });
    });
    
</script>    