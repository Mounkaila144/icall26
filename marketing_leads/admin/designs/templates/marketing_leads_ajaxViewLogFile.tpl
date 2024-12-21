{messages class="site-errors"}
<h3>{__('Import files history')}</h3>    
<div>
    <a href="javascript:void(0);" class="btn" id="ImportFileLogView-Return" title="{__('Return')}"><i class="fa fa-arrow-left" style="margin-right:10px;"></i>{__('Return')}</a>  
</div>
<div class="containerDivResp">
<table cellpadding="0" cellspacing="0" class="tabl-list footable table"> 
    <thead>
        <tr  class="list-header">     
            <th data-hide="phone" style="display: table-cell;" >#</th> 
            {foreach $pager->getHeader() as $index=>$field}
            <th data-hide="phone" style="display: table-cell;">
                <span>{__($field)}</span>               
            </th>
            {/foreach}
        </tr>
    </thead>
    {foreach $pager as $index=>$item}
    <tr class="ImportFileLog list" id="ImportFileLog-{$index}"> 
        <td class="ImportFileLog-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
        {foreach $item as $field=>$value}
        <td> 
            <span>{$value}</span>
        </td>
        {/foreach}
    </tr>    
    {/foreach}
    
</table> 
</div>
{if !$pager->getNbItems()}
    <span>{__('No lines')}</span>
{else}
    
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="ImportFileLog"} 

<script type="text/javascript">
    

    function updateSitePager(n)
    {
        page_active=$(".ImportFileLog-pager .ImportFile-active").html()?parseInt($(".ImportFileLog-pager .ImportFileLog-active").html()):1;
        records_by_page=$("[name=ImportFileLog-nbitemsbypage]").val();
        start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
        $(".ImportFileLog-count").each(function(id) { $(this).html(start+id) }); // Update index column           
        nb_results=parseInt($("#ImportFileLog-nb_results").html())-n;
        $("#ImportFileLog-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
        $("#ImportFileLog-end_result").html($(".ImportFileLog-count:last").html());
    }


    {* =====================  P A G E R  A C T I O N S =============================== *}  
    
    $(".ImportFileLog-pager").click(function () {                      
        return $.ajax2({ data: { Import: {$import->get('id')} }, 
                        url:"{url_to('marketing_leads_ajax',['action'=>'ViewLogFile'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                        errorTarget: ".site-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions-wp-landing-page-site-list"
        });
    });
    
    {* =====================  A C T I O N S =============================== *}  
        
    $("#ImportFileLogView-Return").click( function() {
        return $.ajax2({
            url: "{url_to('marketing_leads_ajax',['action'=>'ListPartialFiles'])}",
            errorTarget: ".site-errors",
            loading: "#tab-site-dashboard-x-settings-loading",
            target: "#actions-wp-landing-page-site-list"
        });
    });
     
    $(".ViewErrors").click( function() {
        var params = { Import: $(this).attr("id"), line: $(this).attr("data-line") };
        alert(params.toSource()); return;
        return $.ajax2({
            data: params,
            url: "{url_to('marketing_leads_ajax',['action'=>'ListPartialFiles'])}",
            errorTarget: ".site-errors",
            loading: "#tab-site-dashboard-x-settings-loading",
            target: "#actions-wp-landing-page-site-list"
        });
    });
</script>    