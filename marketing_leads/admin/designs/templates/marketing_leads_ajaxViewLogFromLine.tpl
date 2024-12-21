{messages class="site-errors"}
<style>
    .field-error 
    {
        background-color: red;
    }
</style>
<h3>{__('Import files history')}</h3>    
<div>
    <a href="javascript:void(0);" class="btn" id="ImportFileLogNavView-Return" title="{__('Return')}"><i class="fa fa-arrow-left" style="margin-right:10px;"></i>{__('Return')}</a>  
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
    <tr class="ImportFileLogNav list" id="ImportFileLogNav-{$index}"> 
        <td class="ImportFileLogNav-count">{((($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration)+$form->getValue('Line')-1}</td>
        {foreach $item as $field=>$value}
        <td {if $form->isErrorField($field) && $form->isErrorLine((($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration)} class="field-error"{/if}> 
            <span >{$value}</span>
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

<script type="text/javascript">
    

    function updateSitePager(n)
    {
        page_active=$(".ImportFileLogNav-pager .ImportFile-active").html()?parseInt($(".ImportFileLogNav-pager .ImportFileLogNav-active").html()):1;
        records_by_page=$("[name=ImportFileLogNav-nbitemsbypage]").val();
        start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
        $(".ImportFileLogNav-count").each(function(id) { $(this).html(start+id) }); // Update index column           
        nb_results=parseInt($("#ImportFileLogNav-nb_results").html())-n;
        $("#ImportFileLogNav-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
        $("#ImportFileLogNav-end_result").html($(".ImportFileLogNav-count:last").html());
    }
    
    {* =====================  P A G E R  A C T I O N S =============================== *}  
    
    $(".ImportFileLogNav-pager").click(function () {                      
        return $.ajax2({ data: { Import: {$import->get('id')} }, 
                        url:"{url_to('marketing_leads_ajax',['action'=>'ViewLogFromLine'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                        errorTarget: ".site-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions-wp-landing-page-site-list"
        });
    });
    
    {* =====================  A C T I O N S =============================== *}  
        
    $("#ImportFileLogNavView-Return").click( function() {
        return $.ajax2({
            data: { Import: {$import->get('id')} }, 
            url: "{url_to('marketing_leads_ajax',['action'=>'ViewLogFileErrors'])}",
            errorTarget: ".site-errors",
            loading: "#tab-site-dashboard-x-settings-loading",
            target: "#actions-wp-landing-page-site-list"
        });
    });
    
</script>    