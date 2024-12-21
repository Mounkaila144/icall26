{messages class="site-app-mutual-meeting-calculation-errors"}
<h3>{__('Meeting calculation')}</h3>    
{*<div>
    <a id="MutualCalculationMeetingProcess-Test" href="javascript:void(0);" class="MutualCalculationMeetingProcess btn"><i class="fa fa-play" style="margin-right: 10px;"></i>{__('Process')}</a>
</div>*}
<div id="CalculationMeetingSchedulerTesterBlock">
    
</div>

{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="MutualCalculationMeeting"}
<button id="MutualCalculationMeeting-filter" class="btn-table">{__("Filter")}</button> 
<button id="MutualCalculationMeeting-init" class="btn-table">{__("Init")}</button>
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0"> 
    <thead> 
    <tr class="list-header">    
        <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}      
        <th class="footable-first-column" data-toggle="true">
            <span>{__('Meeting')}</span>
        </th>
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('Commission')}</span>               
        </th>
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('Decommission')}</span>  
        </th>
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('Calculation date')}</span>                 
        </th> 
        <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
    </tr>
    </thead>
    {* search/equal/range *}
    <tr class="input-list">
        <td>{* # *}</td>
        {if $pager->getNbItems()>5}<td></td>{/if}
        <td>{* meeting_id *}</td>
        <td>{* commission *}</td>
        <td>{* decommission *}</td>
        <td>{* date_calculation *}</td>
        <td>{* actions *}</td>
    </tr>
    {foreach $pager as $item}
    <tr class="MutualCalculationMeeting list" id="MutualCalculationMeeting-{$item->get('id')}"> 
        <td class="MutualCalculationMeeting-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
        {if $pager->getNbItems()>5}
            <td>                           
                <input class="MutualCalculationMeeting-selection" type="checkbox" id="{$item->get('id')}" name="{$item->get('name')}"/>                      
            </td>
        {/if}
        <td>{$item->getMeeting()->getCustomer()|upper}</td>
        <td>{$item->getCommissionI18n()}</td>
        <td>{$item->getDecommissionI18n()}</td>
        <td>{$item->getDateCalculation()}</td>  
        <td> 
            <a id="{$item->get('id')}" href="javascript:void(0);" class="MutualCalculationMeeting-Details" title="{__('calculation details')}"><i class="fa fa-tasks"></i></a>
            <div id="meeting-calculation-dialog-{$item->get('id')}" style="display:none" class="dialogs" title="{__('Details: %s',$item->get('id'))}">
                <div class="content">
                    <table class="tabl-list footable table">
                        <thead>
                            <tr class="list-header">
                                <th>{__('Mutual')}</th>
                                <th>{__('Products')}</th>
                                <th>{__('Commission')}</th>
                                <th>{__('Decommission')}</th>
                            </tr>
                        </thead>
                        <tbody>
                        {foreach $item->getMutualCalculations() as $mutual_calculation}
                            <tr class="list">
                                <td rowspan="{$mutual_calculation->getProductCalculations()->count()+1}">{$mutual_calculation->getMutualPartnerForEngine()}</td> 
                            </tr>
                            {foreach $mutual_calculation->getProductCalculations() as $product}
                            <tr class="list">
                                <td>{$product->geMutualProductForEngine()}</td>
                                <td>{$product->getCommissionI18n()}</td>
                                <td>{$product->getDecommissionI18n()}</td>
                            </tr>
                            {/foreach}
                        {/foreach}
                        </tbody>
                    </table>
                </div>
            </div>
        </td>
    </tr>    
    {/foreach}  
</table>    
{if !$pager->getNbItems()}
    <span>{__('No mutuals')}</span>
{else}
    {*{if $pager->getNbItems()>5}
        <input type="checkbox" id="MutualCalculationMeeting-all" /> 
        <a style="opacity:0.5" class="MutualCalculationMeeting-actions_items" href="#" title="{__('delete')}" id="MutualCalculationMeeting-Deletes">
            <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
        </a>         
    {/if}*}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="MutualCalculationMeeting"} 
  
<script type="text/javascript">
    
    function changeMutualCalculationMeetingIsActiveState(resp) 
    {
        $.each(resp.selection?resp.selection:[resp.id], function () {              
            var sel="a.MutualCalculationMeeting-ChangeIsActive[name="+this+"]";
            if (resp.state=='YES'||resp.state=='NO') 
            {    
                $(sel+" img").attr({
                    src :"{url('/icons/','picture')}"+resp.state+".gif",
                    alt : (resp.state=='YES'?'{__("YES")}':'{__("NO")}'),
                    title : (resp.state=='YES'?'{__("YES")}':'{__("NO")}')
                });
                $(sel).attr("id",resp.state);
            }
        });  
    }
    
    function getSiteMutualCalculationMeetingFilterParameters()
    {
        var params={ filter: {  order : { }, 
                                search : { },
                                equal: { 
                                    name : $("[name=MutualCalculationMeeting-name] option:selected").val()  
                                },
                            lang: $("img.MutualCalculationMeeting").attr('id'),                                                                                                               
                            nbitemsbypage: $("[name=MutualCalculationMeeting-nbitemsbypage]").val(),
                            token:'{$formFilter->getCSRFToken()}'
                    } };
        if ($(".MutualCalculationMeeting-order_active").attr("name"))
            params.filter.order[$(".MutualCalculationMeeting-order_active").attr("name")] =$(".MutualCalculationMeeting-order_active").attr("id");   
        $(".MutualCalculationMeeting-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
        return params;                  
    }

    function updateSiteMutualCalculationMeetingFilter()
    {  
        return $.ajax2({ data: getSiteMutualCalculationMeetingFilterParameters(), 
                        url:"{url_to('app_mutual_ajax',['action'=>'ListPartialMutualMeetingCalculation'])}" , 
                        errorTarget: ".site-app-mutual-partner-errors",
                        loading: "#tab-site-dashboard-app-mutual-engine-calculation-loading",
                        target: "#actions-meeting-calculation"
                    });
    }

    function updateSitePager(n)
    {
        page_active=$(".MutualCalculationMeeting-pager .MutualCalculationMeeting-active").html()?parseInt($(".MutualCalculationMeeting-pager .MutualCalculationMeeting-active").html()):1;
        records_by_page=$("[name=MutualCalculationMeeting-nbitemsbypage]").val();
        start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
        $(".MutualCalculationMeeting-count").each(function(id) { $(this).html(start+id) }); // Update index column           
        nb_results=parseInt($("#MutualCalculationMeeting-nb_results").html())-n;
        $("#MutualCalculationMeeting-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
        $("#MutualCalculationMeeting-end_result").html($(".MutualCalculationMeeting-count:last").html());
    }
          
    {* =====================  P A G E R  A C T I O N S =============================== *}  
      
    $("#MutualCalculationMeeting-init").click(function() {      
        $.ajax2({ url:"{url_to('app_mutual_ajax',['action'=>'ListPartialMutualMeetingCalculation'])}",
                errorTarget: ".site-app-mutual-partner-errors",
                loading: "#tab-site-dashboard-app-mutual-engine-calculation-loading",                         
                target: "#actions-meeting-calculation"}); 
    }); 

    $('.MutualCalculationMeeting-order').click(function() {
        $(".MutualCalculationMeeting-order_active").attr('class','MutualCalculationMeeting-order');
        $(this).attr('class','MutualCalculationMeeting-order_active');
        return updateSiteMutualCalculationMeetingFilter();
    });

    $(".MutualCalculationMeeting-search").keypress(function(event) {
        if (event.keyCode==13)
            return updateSiteMutualCalculationMeetingFilter();
    });

    $("#MutualCalculationMeeting-filter").click(function() { return updateSiteMutualCalculationMeetingFilter(); }); 

    $("[name=MutualCalculationMeeting-nbitemsbypage]").change(function() { return updateSiteMutualCalculationMeetingFilter(); }); 

    // $("[name=MutualCalculationMeeting-name]").change(function() { return updateSiteMutualCalculationMeetingFilter(); }); 

    $(".MutualCalculationMeeting-pager").click(function () {    
        return $.ajax2({ data: getSiteMutualCalculationMeetingFilterParameters(), 
                        url:"{url_to('app_mutual_ajax',['action'=>'ListPartialMutualMeetingCalculation'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                        errorTarget: ".site-app-mutual-partner-errors",
                        loading: "#tab-site-dashboard-app-mutual-engine-calculation-loading",
                        target: "#actions-meeting-calculation"
        });
    });
    
    {* =====================  A C T I O N S =============================== *}  
     
    $(".MutualCalculationMeeting-Details").click( function () {              
        $("#meeting-calculation-dialog-"+$(this).attr("id")).dialog( {  autoOpen: true,  height: 'auto', width:'50%',  modal: true });
    });
    
    $(".MutualCalculationMeeting-ChangeIsActive").click( function () { 
        return $.ajax2({ data: { MutualCalculationMeeting : { id: $(this).attr('name'), value: $(this).attr('id'), token: '{mfForm::getToken("ChangeForm")}' } },
                        url: "{url_to('app_mutual_ajax',['action'=>'ChangeIsActiveMutualCalculationMeeting'])}",
                        errorTarget: ".site-errors",
                        loading: "#tab-site-dashboard-app-mutual-engine-calculation-loading",
                        success: function(resp) {
                                    if (resp.action=='ChangeIsActiveMutualCalculationMeeting')
                                        changeMutualCalculationMeetingIsActiveState(resp);
                                }
        });    
    });
    
    {* ========================= TESTER ========================= *}
    $("#MutualCalculationMeetingProcess-Test").click( function () { 
        return $.ajax2({ 
{*                        data: { MutualCalculationMeeting : { id: $(this).attr('name'), value: $(this).attr('id'), token: '{mfForm::getToken("ChangeForm")}' } },*}
                        url: "{url_to('app_mutual_ajax',['action'=>'MeetingCalculationSchedulerTester'])}",
                        errorTarget: ".site-errors",
                        loading: "#tab-site-dashboard-app-mutual-engine-calculation-loading",
                        target: "#CalculationMeetingSchedulerTesterBlock",
                        {*success: function(resp) {
                                    if (resp.action=='ChangeIsActiveMutualCalculationMeeting')
                                        changeMutualCalculationMeetingIsActiveState(resp);
                                }*}
        });    
    });
    
</script>    