{messages class="site-app-mutual-commession-errors"}
<h3>{__('Product [%s] Commissions',$product->get('name'))}</h3>    
<div>
    <a href="#" class="btn" id="MutualProductCommission-Cancel" title="{__('return')}" ><i class="fa fa-arrow-left" style="margin-right:10px;"></i>{__('Return')}</a>   
    <a href="#" class="btn" id="MutualProductCommission-New" title="{__('new commession')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>{__('New commission')}</a>   
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="MutualProductCommission"}
<button id="MutualProductCommission-filter" class="btn-table">{__("Filter")}</button> 
<button id="MutualProductCommission-init" class="btn-table">{__("Init")}</button>
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0"> 
    <thead> 
    <tr class="list-header">    
        <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}
        <th class="footable-first-column" data-toggle="true">
            <span>{__('From')}</span>
        </th>
        <th class="footable-first-column" data-toggle="true">
            <span>{__('To')}</span>
        </th>
        <th class="footable-first-column" data-toggle="true">
            <span>{__('Rate')}</span>
        </th>
        <th class="footable-first-column" data-toggle="true">
            <span>{__('Started at')}</span>
        </th>
        <th class="footable-first-column" data-toggle="true">
            <span>{__('Ended at')}</span>
        </th>
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('State')}</span>          
        </th>
        <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
    </tr>
    </thead>
    {* search/equal/range *}
    <tr class="input-list">
        <td>{* # *}</td>
        {if $pager->getNbItems()>5}<td></td>{/if}
        <td>{* from *}</td>
        <td>{* to *}</td>
        <td>{* rate *}</td>
        <td>{* started_at *}</td>
        <td>{* ended_at *}</td>
        <td>{* status *}</td>
        <td>{* actions *}</td>
    </tr>
    {foreach $pager as $item}
    <tr class="MutualProductCommission list" id="MutualProductCommission-{$item->get('id')}"> 
        <td class="MutualProductCommission-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
        {if $pager->getNbItems()>5}
            <td>                           
                <input class="MutualProductCommission-selection" type="checkbox" id="{$item->get('id')}" name="{$item->get('name')}"/>                      
            </td>
        {/if}
        <td>{$item->get('from')}</td>
        <td>{$item->get('to')}</td>
        <td>{$item->getRatePercent()}</td>
        <td>{$item->getStartedAt()}</td>
        <td>{$item->getEndedAt()}</td>
        <td>                
            <a href="#" class="MutualProductCommission-ChangeIsActive" name="{$item->get('id')}" id="{$item->get('is_active')}"><img src="{url('/icons/','picture')}{$item->get('is_active')}.gif" alt='{__($item->get("is_active"))}' title='{__($item->get("is_active"))}'/></a>                           
        </td>
        <td> 
            <a id="{$item->get('id')}" href="javascript:void(0);" class="MutualProductCommission-View" title="{__('edit')}"><i class="fa fa-pencil-square-o fa-lg"></i></a>            
            {if $item->get('status')=='ACTIVE'}
                <a href="javascript:void(0);" title="{__('Disable')}" class="MutualProductCommission-Status Delete" id="{$item->get('id')}" name="{$item}"><i class="fa fa-trash fa-lg"></i></a>
            {else}
                <a href="javascript:void(0);" title="{__('Enable')}" class="MutualProductCommission-Status Recycle" id="{$item->get('id')}" name="{$item}"><i class="fa fa-recycle fa-lg"></i></a>
            {/if}
            <a id="{$item->get('id')}" href="javascript:void(0);" class="MutualProductCommission-Delete" title="{__('delete')}" name="{$item}"><i class="fa fa-trash-o fa-lg"></i></a>            
            <a href="javascript:void(0);" title="{__('Remove')}" class="MutualProductCommission-Remove" id="{$item->get('id')}"  name="{$item}"><i class="fa fa-times fa-lg"></i></a>
        </td>
    </tr>    
    {/foreach}  
</table>    
{if !$pager->getNbItems()}
    <span>{__('No commission')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="MutualProductCommission-all" /> 
        <a style="opacity:0.5" class="MutualProductCommission-actions_items" href="#" title="{__('delete')}" id="MutualProductCommission-Deletes">
            <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
        </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="MutualProductCommission"} 
  
<script type="text/javascript">
    
    function getSiteMutualProductCommissionFilterParameters()
    {
        var params={ filter: {  order : { }, 
                                search : { },
                                equal: { 
                                    name : $("[name=MutualProductCommission-name] option:selected").val()  
                                },                                                                                                           
                            nbitemsbypage: $("[name=MutualProductCommission-nbitemsbypage]").val(),
                            token:'{$formFilter->getCSRFToken()}'
                    }, MutualProduct : {$product->get('id')} };
        if ($(".MutualProductCommission-order_active").attr("name"))
            params.filter.order[$(".MutualProductCommission-order_active").attr("name")] = $(".MutualProductCommission-order_active").attr("id");   
        $(".MutualProductCommission-search").each(function() { params.filter.search[$(this).attr('name')] = $(this).val(); });            
        return params;                  
    }

    function updateSiteMutualProductCommissionFilter()
    {   
        return $.ajax2({ data: getSiteMutualProductCommissionFilterParameters(), 
                        url:"{url_to('app_mutual_ajax',['action'=>'ListPartialMutualProductCommission'])}" , 
                        errorTarget: ".site-app-mutual-commession-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions"
                    });
    }

    function updateSitePager(n)
    {
        page_active=$(".MutualProductCommission-pager .MutualProductCommission-active").html()?parseInt($(".MutualProductCommission-pager .MutualProductCommission-active").html()):1;
        records_by_page=$("[name=MutualProductCommission-nbitemsbypage]").val();
        start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
        $(".MutualProductCommission-count").each(function(id) { $(this).html(start+id) }); // Update index column           
        nb_results=parseInt($("#MutualProductCommission-nb_results").html())-n;
        $("#MutualProductCommission-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
        $("#MutualProductCommission-end_result").html($(".MutualProductCommission-count:last").html());
    }
    
    function changeMutualProductCommissionIsActiveState(resp) 
    {
        $.each(resp.selection?resp.selection:[resp.id], function () {              
            sel="a.MutualProductCommission-ChangeIsActive[name="+this+"]";
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
          
    {* =====================  P A G E R  A C T I O N S =============================== *}  
      
    $("#MutualProductCommission-init").click(function() {   
        $.ajax2({ data: { MutualProduct : {$product->get('id')} },
                url:"{url_to('app_mutual_ajax',['action'=>'ListPartialMutualProductCommission'])}",
                errorTarget: ".site-app-mutual-commession-errors",
                loading: "#tab-site-dashboard-x-settings-loading",                         
                target: "#actions"}); 
    }); 

    $('.MutualProductCommission-order').click(function() {
        $(".MutualProductCommission-order_active").attr('class','MutualProductCommission-order');
        $(this).attr('class','MutualProductCommission-order_active');
        return updateSiteMutualProductCommissionFilter();
    });

    $(".MutualProductCommission-search").keypress(function(event) {
        if (event.keyCode==13)
            return updateSiteMutualProductCommissionFilter();
    });

    $("#MutualProductCommission-filter").click(function() { return updateSiteMutualProductCommissionFilter(); }); 

    $("[name=MutualProductCommission-nbitemsbypage]").change(function() { return updateSiteMutualProductCommissionFilter(); }); 

    // $("[name=MutualProductCommission-name]").change(function() { return updateSiteMutualProductCommissionFilter(); }); 

    $(".MutualProductCommission-pager").click(function () {     
        return $.ajax2({ data: getSiteMutualProductCommissionFilterParameters(), 
                        url:"{url_to('app_mutual_ajax',['action'=>'ListPartialMutualProductCommission'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                        errorTarget: ".site-app-mutual-commession-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions"
        });
    });
    
    {* =====================  A C T I O N S =============================== *}  
    
    $("#MutualProductCommission-Cancel").click( function () {   
        return $.ajax2({ data : { MutualPartner : {$product->getMutualPartner()->get('id')} },                   
                        url: "{url_to('app_mutual_ajax',['action'=>'ListPartialMutualProduct'])}",
                        errorTarget: ".site-app-mutual-commession-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions"
        });
    });
    
    $("#MutualProductCommission-New").click( function () {    
        return $.ajax2({ data : { MutualProduct : {$product->get('id')} },                    
                        url: "{url_to('app_mutual_ajax',['action'=>'NewMutualProductCommission'])}",
                        errorTarget: ".site-app-mutual-commession-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions"
        });
    });

    $(".MutualProductCommission-View").click( function () {                    
        return $.ajax2({ data : { MutualProductCommission : $(this).attr('id') },
                        loading: "#tab-site-dashboard-x-settings-loading",
                        url:"{url_to('app_mutual_ajax',['action'=>'ViewMutualProductCommission'])}",
                        errorTarget: ".site-app-mutual-commession-errors",
                        target: "#actions"
        });
    });
    
    $(".MutualProductCommission-Delete").click( function () { 
        if (!confirm('{__("Status \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
        return $.ajax2({ data :{ MutualProductCommission: $(this).attr('id') },
                        url :"{url_to('app_mutual_ajax',['action'=>'DeleteMutualProductCommission'])}",
                        errorTarget: ".site-app-mutual-commession-errors",    
                        loading: "#tab-site-site-x-settings-loading",
                        success : function(resp) {
                            if (resp.action=='DeleteMutualProductCommission')
                            {    
                                $("tr#MutualProductCommission-"+resp.id).remove();  
                                if ($('.MutualProductCommission').length==0)
                                    return $.ajax2({ data : { MutualProductCommission : $(this).attr('id') }, 
                                                    url:"{url_to('app_mutual_ajax',['action'=>'ListPartialMutualProductCommission'])}",
                                                    errorTarget: ".site-app-mutual-commession-errors",
                                                    target: "#tab-dashboard-site-x-settings"});
                                updateSitePager(1);
                            }       
                        }
        });                                        
    });
    
    $(".MutualProductCommission-Remove").click( function () { 
        if (!confirm('{__("Commission \"#0#\" will be removed. Confirm ?")}'.format($(this).attr('name')))) return false; 
        return $.ajax2({ 
            data :{ MutualProductCommission: $(this).attr('id') },
            url :"{url_to('app_mutual_ajax',['action'=>'RemoveMutualProductCommission'])}",
            errorTarget: ".site-app-mutual-products-errors",    
            loading: "#tab-site-site-x-settings-loading",
            success : function(resp) {
                if (resp.action=='RemoveMutualProductCommission')
                {    
                    $("tr#MutualProductCommission-"+resp.id).remove();  
                    if ($('.MutualProductCommission').length==0)
                        return $.ajax2({ url:"{url_to('app_mutual_ajax',['action'=>'ListPartialMutualProductCommission'])}",
                                        errorTarget: ".site-app-mutual-decommission-errors",
                                        loading: "#tab-site-site-x-settings-loading",
                                        target: "#tab-dashboard-site-x-settings"});
                    updateSitePager(1);
                }       
            }
        });                                        
    });
    
    $(".MutualProductCommission-Status").click(function () {
        if ($(this).hasClass('Delete'))
        {
            if (!confirm('{__("Commission \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false;
            return $.ajax2({
                data : { MutualProductCommission: $(this).attr('id') },
                url: "{url_to('app_mutual_ajax',['action'=>'DisabledStatusMutualProductCommission'])}",
                success: function (resp)
                        {
                            if (resp.action=='DisableMutualProductCommission')
                            {
                                $(".StatusMutualProductCommission[id="+resp.id+"]").attr('title',"{__('Recycle')}");
                                $(".StatusMutualProductCommission[id="+resp.id+"]").html("{__("Commission_DELETE")}");
                                $(".MutualProductCommission-Status[id="+resp.id+"]").addClass("Recycle").removeClass('Delete');
                                $(".MutualProductCommission-Status[id="+resp.id+"]").html('<i class="fa fa-recycle"></i>');
                            }
                        }
            });
        }
        else
        {
            if (!confirm('{__("Commission \"#0#\" will be recycled. Confirm ?")}'.format($(this).attr('name')))) return false;
            return $.ajax2({
                data : { MutualProductCommission: $(this).attr('id') },
                url: "{url_to('app_mutual_ajax',['action'=>'EnabledStatusMutualProductCommission'])}",
                success: function (resp)
                        {
                            if (resp.action=='EnableMutualProductCommission')
                            {
                                $(".StatusMutualProductCommission[id="+resp.id+"]").attr('title',"{__('Delete')}");
                                $(".StatusMutualProductCommission[id="+resp.id+"]").html("{__("Commission_ACTIVE")}");
                                $(".MutualProductCommission-Status[id="+resp.id+"]").html('<i class="fa fa-trash"></i>');
                                $(".MutualProductCommission-Status[id="+resp.id+"]").addClass("Delete").removeClass('Recycle');
                            }
                        }
            });
        }
    });
    
    $(".MutualProductCommission-ChangeIsActive").click( function () { 
        return $.ajax2({ data: { MutualProductCommission : { id: this.name, value: this.id, token: '{mfForm::getToken("ChangeForm")}' } },
                        url: "{url_to('app_mutual_ajax',['action'=>'ChangeIsActiveCommission'])}",
                        errorTarget: ".site-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        success: function(resp) {
                                    if (resp.action=='ChangeIsActiveCommission')
                                        changeMutualProductCommissionIsActiveState(resp);
                                }
        });    
    });
    
    
    {* ========================== AUTHER ACTIONS ============================ *}
     
    $(function () {
       $('.footable').footable();
    });
    
</script>    