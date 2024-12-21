{messages class="site-app-mutual-decommission-errors"}
<h3>{__('Product [%s] Decommissions',$product->get('name'))}</h3>    
<div>
    <a href="#" class="btn" id="MutualProductDecommission-Cancel" title="{__('return')}" ><i class="fa fa-arrow-left" style="margin-right:10px;"></i>{__('Return')}</a>   
    <a href="#" class="btn" id="MutualProductDecommission-New" title="{__('new decommession')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>{__('New decommission')}</a>   
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="MutualProductDecommission"}
<button id="MutualProductDecommission-filter" class="btn-table">{__("Filter")}</button> 
<button id="MutualProductDecommission-init" class="btn-table">{__("Init")}</button>
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
            <span>{__('Fix')}</span>
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
        <td>{* fix *}</td>
        <td>{* started_at *}</td>
        <td>{* ended_at *}</td>
        <td>{* status *}</td>
        <td>{* actions *}</td>
    </tr>
    {foreach $pager as $item}
    <tr class="MutualProductDecommission list" id="MutualProductDecommission-{$item->get('id')}"> 
        <td class="MutualProductDecommission-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
        {if $pager->getNbItems()>5}
            <td>                           
                <input class="MutualProductDecommission-selection" type="checkbox" id="{$item->get('id')}" name="{$item->get('name')}"/>                      
            </td>
        {/if}
        <td>{$item->get('from')}</td>
        <td>{$item->get('to')}</td>
        <td>{$item->getRatePercent()}</td>
        <td>{$item->get('fix')}</td>
        <td>{$item->getStartedAt()}</td>
        <td>{$item->getEndedAt()}</td>
        <td>                
            <a href="#" class="MutualProductDecommission-ChangeIsActive" name="{$item->get('id')}" id="{$item->get('is_active')}"><img src="{url('/icons/','picture')}{$item->get('is_active')}.gif" alt='{__($item->get("is_active"))}' title='{__($item->get("is_active"))}'/></a>                           
        </td>
        <td> 
            <a id="{$item->get('id')}" href="javascript:void(0);" class="MutualProductDecommission-View" title="{__('edit')}"><i class="fa fa-pencil-square-o fa-lg"></i></a>            
            {if $item->get('status')=='ACTIVE'}
                <a href="javascript:void(0);" title="{__('Disable')}" class="MutualProductDecommission-Status Delete" id="{$item->get('id')}" name="{$item}"><i class="fa fa-trash fa-lg"></i></a>
            {else}
                <a href="javascript:void(0);" title="{__('Enable')}" class="MutualProductDecommission-Status Recycle" id="{$item->get('id')}" name="{$item}"><i class="fa fa-recycle fa-lg"></i></a>
            {/if}
            <a id="{$item->get('id')}" href="javascript:void(0);" class="MutualProductDecommission-Delete" title="{__('delete')}" name="{$item}"><i class="fa fa-trash-o fa-lg"></i></a>       
            <a href="javascript:void(0);" title="{__('Remove')}" class="MutualProductDecommission-Remove" id="{$item->get('id')}"  name="{$item}"><i class="fa fa-times fa-lg"></i></a>
        </td>
    </tr>    
    {/foreach}  
</table>    
{if !$pager->getNbItems()}
    <span>{__('No decommission')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="MutualProductDecommission-all" /> 
        <a style="opacity:0.5" class="MutualProductDecommission-actions_items" href="#" title="{__('delete')}" id="MutualProductDecommission-Deletes">
            <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
        </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="MutualProductDecommission"} 
  
<script type="text/javascript">
    
    function getSiteMutualProductDecommissionFilterParameters()
    {
        var params={ filter: {  order : { }, 
                                search : { },
                                equal: { 
                                    name : $("[name=MutualProductDecommission-name] option:selected").val()  
                                },                                                                                                           
                            nbitemsbypage: $("[name=MutualProductDecommission-nbitemsbypage]").val(),
                            token:'{$formFilter->getCSRFToken()}'
                    }, MutualProduct : {$product->get('id')} };
        if ($(".MutualProductDecommission-order_active").attr("name"))
            params.filter.order[$(".MutualProductDecommission-order_active").attr("name")] = $(".MutualProductDecommission-order_active").attr("id");   
        $(".MutualProductDecommission-search").each(function() { params.filter.search[$(this).attr('name')] = $(this).val(); });            
        return params;                  
    }

    function updateSiteMutualProductDecommissionFilter()
    {
        return $.ajax2({ data: getSiteMutualProductDecommissionFilterParameters(), 
                        url:"{url_to('app_mutual_ajax',['action'=>'ListPartialMutualProductDecommission'])}" , 
                        errorTarget: ".site-app-mutual-commession-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions"
                    });
    }

    function updateSitePager(n)
    {
        page_active=$(".MutualProductDecommission-pager .MutualProductDecommission-active").html()?parseInt($(".MutualProductDecommission-pager .MutualProductDecommission-active").html()):1;
        records_by_page=$("[name=MutualProductDecommission-nbitemsbypage]").val();
        start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
        $(".MutualProductDecommission-count").each(function(id) { $(this).html(start+id) }); // Update index column           
        nb_results=parseInt($("#MutualProductDecommission-nb_results").html())-n;
        $("#MutualProductDecommission-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
        $("#MutualProductDecommission-end_result").html($(".MutualProductDecommission-count:last").html());
    }
    
    function changeMutualProductDecommissionIsActiveState(resp) 
    {
        $.each(resp.selection?resp.selection:[resp.id], function () {              
            sel="a.MutualProductDecommission-ChangeIsActive[name="+this+"]";
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
      
    $("#MutualProductDecommission-init").click(function() {   
        $.ajax2({ data: { MutualProduct : {$product->get('id')} },
                url:"{url_to('app_mutual_ajax',['action'=>'ListPartialMutualProductDecommission'])}",
                errorTarget: ".site-app-mutual-commession-errors",
                loading: "#tab-site-dashboard-x-settings-loading",                         
                target: "#actions"}); 
    }); 

    $('.MutualProductDecommission-order').click(function() {
        $(".MutualProductDecommission-order_active").attr('class','MutualProductDecommission-order');
        $(this).attr('class','MutualProductDecommission-order_active');
        return updateSiteMutualProductDecommissionFilter();
    });

    $(".MutualProductDecommission-search").keypress(function(event) {
        if (event.keyCode==13)
            return updateSiteMutualProductDecommissionFilter();
    });

    $("#MutualProductDecommission-filter").click(function() { return updateSiteMutualProductDecommissionFilter(); }); 

    $("[name=MutualProductDecommission-nbitemsbypage]").change(function() { return updateSiteMutualProductDecommissionFilter(); }); 

    // $("[name=MutualProductDecommission-name]").change(function() { return updateSiteMutualProductDecommissionFilter(); }); 

    $(".MutualProductDecommission-pager").click(function () {    
        return $.ajax2({ data: getSiteMutualProductDecommissionFilterParameters(), 
                        url:"{url_to('app_mutual_ajax',['action'=>'ListPartialMutualProductDecommission'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                        errorTarget: ".site-app-mutual-commession-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions"
        });
    });
    
    {* =====================  A C T I O N S =============================== *}  
    
    $("#MutualProductDecommission-Cancel").click( function () {   
        return $.ajax2({ data : { MutualPartner : {$product->getMutualPartner()->get('id')} },                   
                        url: "{url_to('app_mutual_ajax',['action'=>'ListPartialMutualProduct'])}",
                        errorTarget: ".site-app-mutual-decommission-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions"
        });
    });
    
    $("#MutualProductDecommission-New").click( function () {      
        return $.ajax2({ data : { MutualProduct : {$product->get('id')} },                    
                        url: "{url_to('app_mutual_ajax',['action'=>'NewMutualProductDecommission'])}",
                        errorTarget: ".site-app-mutual-decommission-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions"
        });
    });

    $(".MutualProductDecommission-View").click( function () {                    
        return $.ajax2({ data : { MutualProductDecommission : $(this).attr('id') },
                        loading: "#tab-site-dashboard-x-settings-loading",
                        url:"{url_to('app_mutual_ajax',['action'=>'ViewMutualProductDecommission'])}",
                        errorTarget: ".site-app-mutual-decommission-errors",
                        target: "#actions"
        });
    });
    
    $(".MutualProductDecommission-Delete").click( function () { 
        if (!confirm('{__("Status \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
        return $.ajax2({ data :{ MutualProductDecommission: $(this).attr('id') },
                        url :"{url_to('app_mutual_ajax',['action'=>'DeleteMutualProductDecommission'])}",
                        errorTarget: ".site-app-mutual-decommission-errors",    
                        loading: "#tab-site-site-x-settings-loading",
                        success : function(resp) {
                            if (resp.action=='DeleteMutualProductDecommission')
                            {    
                                $("tr#MutualProductDecommission-"+resp.id).remove();  
                                if ($('.MutualProductDecommission').length==0)
                                    return $.ajax2({ data : { MutualProductDecommission : $(this).attr('id') }, 
                                                    url:"{url_to('app_mutual_ajax',['action'=>'ListPartialMutualProductDecommission'])}",
                                                    errorTarget: ".site-app-mutual-decommission-errors",
                                                    target: "#tab-dashboard-site-x-settings"});
                                updateSitePager(1);
                            }       
                        }
        });                                        
    });
    
    $(".MutualProductDecommission-Remove").click( function () { 
        if (!confirm('{__("Decommission \"#0#\" will be removed. Confirm ?")}'.format($(this).attr('name')))) return false; 
        return $.ajax2({ 
            data :{ MutualProductDecommission: $(this).attr('id') },
            url :"{url_to('app_mutual_ajax',['action'=>'RemoveMutualProductDecommission'])}",
            errorTarget: ".site-app-mutual-products-errors",    
            loading: "#tab-site-site-x-settings-loading",
            success : function(resp) {
                if (resp.action=='RemoveMutualProductDecommission')
                {    
                    $("tr#MutualProductDecommission-"+resp.id).remove();  
                    if ($('.MutualProductDecommission').length==0)
                        return $.ajax2({ url:"{url_to('app_mutual_ajax',['action'=>'ListPartialMutualProductDecommission'])}",
                                        errorTarget: ".site-app-mutual-decommission-errors",
                                        loading: "#tab-site-site-x-settings-loading",
                                        target: "#tab-dashboard-site-x-settings"});
                    updateSitePager(1);
                }       
            }
        });                                        
    });
    
    $(".MutualProductDecommission-Status").click(function () {
        if ($(this).hasClass('Delete'))
        {
            if (!confirm('{__("Decommission \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false;
            return $.ajax2({
                data : { MutualProductDecommission: $(this).attr('id') },
                url: "{url_to('app_mutual_ajax',['action'=>'DisabledStatusMutualProductDecommission'])}",
                success: function (resp)
                        {
                            if (resp.action=='DisableMutualProductDecommission')
                            {
                                $(".StatusMutualProductDecommission[id="+resp.id+"]").attr('title',"{__('Recycle')}");
                                $(".StatusMutualProductDecommission[id="+resp.id+"]").html("{__("Decommission_DELETE")}");
                                $(".MutualProductDecommission-Status[id="+resp.id+"]").addClass("Recycle").removeClass('Delete');
                                $(".MutualProductDecommission-Status[id="+resp.id+"]").html('<i class="fa fa-recycle"></i>');
                            }
                        }
            });
        }
        else
        {
            if (!confirm('{__("Decommission \"#0#\" will be recycled. Confirm ?")}'.format($(this).attr('name')))) return false;
            return $.ajax2({
                data : { MutualProductDecommission: $(this).attr('id') },
                url: "{url_to('app_mutual_ajax',['action'=>'EnabledStatusMutualProductDecommission'])}",
                success: function (resp)
                        {
                            if (resp.action=='EnableMutualProductDecommission')
                            {
                                $(".StatusMutualProductDecommission[id="+resp.id+"]").attr('title',"{__('Delete')}");
                                $(".StatusMutualProductDecommission[id="+resp.id+"]").html("{__("Decommission_ACTIVE")}");
                                $(".MutualProductDecommission-Status[id="+resp.id+"]").html('<i class="fa fa-trash"></i>');
                                $(".MutualProductDecommission-Status[id="+resp.id+"]").addClass("Delete").removeClass('Recycle');
                            }
                        }
            });
        }
    });
    
    $(".MutualProductDecommission-ChangeIsActive").click( function () { 
        return $.ajax2({ data: { MutualProductDecommission : { id: this.name, value: this.id, token: '{mfForm::getToken("ChangeForm")}' } },
                        url: "{url_to('app_mutual_ajax',['action'=>'ChangeIsActiveDecommission'])}",
                        errorTarget: ".site-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        success: function(resp) {
                                    if (resp.action=='ChangeIsActiveDecommission')
                                        changeMutualProductDecommissionIsActiveState(resp);
                                }
        });    
    });
    
    {* ========================== AUTHER ACTIONS ============================ *}
     
    $(function () {
       $('.footable').footable();
    });
    
</script>    