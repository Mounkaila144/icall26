{messages class="site-app-mutual-products-errors"}
<h3>{__('Mutual [%s] Products',$mutual->get('name'))}</h3>    
<div>
    <a href="#" class="btn" id="MutualProduct-Cancel" title="{__('return')}" ><i class="fa fa-arrow-left" style="margin-right:10px;"></i>{__('Return')}</a>   
    <a href="#" class="btn" id="MutualProduct-New" title="{__('new product')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>{__('New product')}</a>   
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="MutualProduct"}
<button id="MutualProduct-filter" class="btn-table">{__("Filter")}</button> 
<button id="MutualProduct-init" class="btn-table">{__("Init")}</button>
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0"> 
    <thead> 
    <tr class="list-header">    
        <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}
        <th class="footable-first-column" data-toggle="true">
            <span>{__('Name')}</span>
        </th>
        <th class="footable-first-column" data-toggle="true">
            <span>{__('Price')}</span>
        </th>
        <th class="footable-first-column" data-toggle="true">
            <span>{__('State')}</span>
        </th>
        <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
    </tr>
    </thead>
    {* search/equal/range *}
    <tr class="input-list">
        <td>{* # *}</td>
        {if $pager->getNbItems()>5}<td></td>{/if}
        <td>{* name *}</td>
        <td>{* Price *}</td>
        <td>{* status *}</td>
        <td>{* actions *}</td>
    </tr>
    {foreach $pager as $item}
    <tr class="MutualProduct list" id="MutualProduct-{$item->get('id')}"> 
        <td class="MutualProduct-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
        {if $pager->getNbItems()>5}
            <td>                           
                <input class="MutualProduct-selection" type="checkbox" id="{$item->get('id')}" name="{$item->get('name')}"/>                      
            </td>
        {/if}
        <td>{$item->get('name')}</td>
        <td>{$item->getPriceI18n()}</td>
        <td>                
            <a href="#" class="MutualProduct-ChangeIsActive" name="{$item->get('id')}" id="{$item->get('is_active')}"><img src="{url('/icons/','picture')}{$item->get('is_active')}.gif" alt='{__($item->get("is_active"))}' title='{__($item->get("is_active"))}'/></a>                           
        </td>
        <td> 
            <a id="{$item->get('id')}" href="javascript:void(0);" class="MutualProduct-View" title="{__('edit')}"><i class="fa fa-pencil-square-o fa-lg"></i></a>            
            <a id="{$item->get('id')}" href="javascript:void(0);" class="MutualProduct-Commession" title="{__('commission list')}"><i class="fa fa-plus-circle fa-lg"></i></a>
            <a id="{$item->get('id')}" href="javascript:void(0);" class="MutualProduct-Decommession" title="{__('decommission list')}"><i class="fa fa-minus-circle fa-lg"></i></a>
            {if $item->get('status')=='ACTIVE'}
                <a href="javascript:void(0);" title="{__('Disable')}" class="MutualProduct-Status Delete" id="{$item->get('id')}" name="{$item->get('name')}"><i class="fa fa-trash fa-lg"></i></a>
            {else}
                <a href="javascript:void(0);" title="{__('Enable')}" class="MutualProduct-Status Recycle" id="{$item->get('id')}" name="{$item->get('name')}"><i class="fa fa-recycle fa-lg"></i></a>
            {/if}
            <a id="{$item->get('id')}" href="javascript:void(0);" class="MutualProduct-Delete" title="{__('delete')}" name="{$item->get('name')}"><i class="fa fa-trash-o fa-lg"></i></a>
            <a href="javascript:void(0);" title="{__('Remove')}" class="MutualProduct-Remove" id="{$item->get('id')}"  name="{$item->get('name')}"><i class="fa fa-times  fa-lg"></i></a>
        </td>
    </tr>    
    {/foreach}  
</table>    
{if !$pager->getNbItems()}
    <span>{__('No products')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="MutualProduct-all" /> 
        <a style="opacity:0.5" class="MutualProduct-actions_items" href="#" title="{__('delete')}" id="MutualProduct-Deletes">
            <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
        </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="MutualProduct"} 
  
<script type="text/javascript">
    
    function getSiteMutualProductFilterParameters()
    {
        var params={ filter: {  order : { }, 
                                search : { },
                                equal: { 
                                    name : $("[name=MutualProduct-name] option:selected").val()  
                                },                                                                                                           
                            nbitemsbypage: $("[name=MutualProduct-nbitemsbypage]").val(),
                            token:'{$formFilter->getCSRFToken()}'
                    }, MutualPartner : {$mutual->get('id')} };
        if ($(".MutualProduct-order_active").attr("name"))
            params.filter.order[$(".MutualProduct-order_active").attr("name")] = $(".MutualProduct-order_active").attr("id");   
        $(".MutualProduct-search").each(function() { params.filter.search[$(this).attr('name')] = $(this).val(); });            
        return params;                  
    }

    function updateSiteMutualProductFilter()
    {
        return $.ajax2({ data: getSiteMutualProductFilterParameters(), 
                        url:"{url_to('app_mutual_ajax',['action'=>'ListPartialMutualProduct'])}" , 
                        errorTarget: ".site-app-mutual-products-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions"
                    });
    }

    function updateSitePager(n)
    {
        page_active=$(".MutualProduct-pager .MutualProduct-active").html()?parseInt($(".MutualProduct-pager .MutualProduct-active").html()):1;
        records_by_page=$("[name=MutualProduct-nbitemsbypage]").val();
        start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
        $(".MutualProduct-count").each(function(id) { $(this).html(start+id) }); // Update index column           
        nb_results=parseInt($("#MutualProduct-nb_results").html())-n;
        $("#MutualProduct-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
        $("#MutualProduct-end_result").html($(".MutualProduct-count:last").html());
    }
    
    function changeMutualProductIsActiveState(resp) 
    {
        $.each(resp.selection?resp.selection:[resp.id], function () {              
            sel="a.MutualProduct-ChangeIsActive[name="+this+"]";
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
      
    $("#MutualProduct-init").click(function() {   
        $.ajax2({ data: { MutualPartner : {$mutual->get('id')} },
                url:"{url_to('app_mutual_ajax',['action'=>'ListPartialMutualProduct'])}",
                errorTarget: ".site-app-mutual-products-errors",
                loading: "#tab-site-dashboard-x-settings-loading",                         
                target: "#actions"}); 
    }); 

    $('.MutualProduct-order').click(function() {
        $(".MutualProduct-order_active").attr('class','MutualProduct-order');
        $(this).attr('class','MutualProduct-order_active');
        return updateSiteMutualProductFilter();
    });

    $(".MutualProduct-search").keypress(function(event) {
        if (event.keyCode==13)
            return updateSiteMutualProductFilter();
    });

    $("#MutualProduct-filter").click(function() { return updateSiteMutualProductFilter(); }); 

    $("[name=MutualProduct-nbitemsbypage]").change(function() { return updateSiteMutualProductFilter(); }); 

    // $("[name=MutualProduct-name]").change(function() { return updateSiteMutualProductFilter(); }); 

    $(".MutualProduct-pager").click(function () {    
        return $.ajax2({ data: getSiteMutualProductFilterParameters(), 
                        url:"{url_to('app_mutual_ajax',['action'=>'ListPartialMutualProduct'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                        errorTarget: ".site-app-mutual-products-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions"
        });
    });
    
    {* =====================  A C T I O N S =============================== *}  
    
    $("#MutualProduct-Cancel").click( function () {      
        return $.ajax2({                   
                        url: "{url_to('app_mutual_ajax',['action'=>'ListPartialMutualPartner'])}",
                        errorTarget: ".site-app-mutual-products-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions"
        });
    });
    
    $("#MutualProduct-New").click( function () {     
        return $.ajax2({ data : { MutualPartner : {$mutual->get('id')} },                    
                        url: "{url_to('app_mutual_ajax',['action'=>'NewMutualProduct'])}",
                        errorTarget: ".site-app-mutual-products-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions"
        });
    });

    $(".MutualProduct-View").click( function () {                    
        return $.ajax2({ data : { MutualProduct : $(this).attr('id') },
                        loading: "#tab-site-dashboard-x-settings-loading",
                        url:"{url_to('app_mutual_ajax',['action'=>'ViewMutualProduct'])}",
                        errorTarget: ".site-app-mutual-products-errors",
                        target: "#actions"
        });
    });
    
    $(".MutualProduct-Delete").click( function () { 
        if (!confirm('{__("Status \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
        return $.ajax2({ data :{ MutualProduct: $(this).attr('id') },
                        url :"{url_to('app_mutual_ajax',['action'=>'DeleteMutualProduct'])}",
                        errorTarget: ".site-app-mutual-products-errors",    
                        loading: "#tab-site-site-x-settings-loading",
                        success : function(resp) {
                            if (resp.action=='DeleteMutualProduct')
                            {    
                                $("tr#MutualProduct-"+resp.id).remove();  
                                if ($('.MutualProduct').length==0)
                                    return $.ajax2({ data : { MutualProduct : $(this).attr('id') }, 
                                                    url:"{url_to('app_mutual_ajax',['action'=>'ListPartialMutualProduct'])}",
                                                    errorTarget: ".site-app-mutual-products-errors",
                                                    target: "#tab-dashboard-site-x-settings"});
                                updateSitePager(1);
                            }       
                        }
        });                                        
    });
    
    $(".MutualProduct-Remove").click( function () { 
        if (!confirm('{__("Product \"#0#\" will be removed. Confirm ?")}'.format($(this).attr('name')))) return false; 
        return $.ajax2({ 
            data :{ MutualProduct: $(this).attr('id') },
            url :"{url_to('app_mutual_ajax',['action'=>'RemoveMutualProduct'])}",
            errorTarget: ".site-app-mutual-products-errors",    
            loading: "#tab-site-site-x-settings-loading",
            success : function(resp) {
                if (resp.action=='RemoveMutualProduct')
                {    
                    $("tr#MutualProduct-"+resp.id).remove();  
                    if ($('.MutualProduct').length==0)
                        return $.ajax2({ url:"{url_to('app_mutual_ajax',['action'=>'ListPartialMutualProduct'])}",
                                        errorTarget: ".site-app-mutual-product-errors",
                                        loading: "#tab-site-site-x-settings-loading",
                                        target: "#tab-dashboard-site-x-settings"});
                    updateSitePager(1);
                }       
            }
        });                                        
    });
    
    $(".MutualProduct-Status").click(function () {
        if ($(this).hasClass('Delete'))
        {
            if (!confirm('{__("Product \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false;
            return $.ajax2({
                data : { MutualProduct: $(this).attr('id') },
                url: "{url_to('app_mutual_ajax',['action'=>'DisabledStatusMutualProduct'])}",
                success: function (resp)
                        {
                            if (resp.action=='DisableMutualProduct')
                            {
                                $(".StatusMutualProduct[id="+resp.id+"]").attr('title',"{__('Recycle')}");
                                $(".StatusMutualProduct[id="+resp.id+"]").html("{__("Product_DELETE")}");
                                $(".MutualProduct-Status[id="+resp.id+"]").addClass("Recycle").removeClass('Delete');
                                $(".MutualProduct-Status[id="+resp.id+"]").html('<i class="fa fa-recycle"></i>');
                            }
                        }
            });
        }
        else
        {
            if (!confirm('{__("Product \"#0#\" will be recycled. Confirm ?")}'.format($(this).attr('name')))) return false;
            return $.ajax2({
                data : { MutualProduct: $(this).attr('id') },
                url: "{url_to('app_mutual_ajax',['action'=>'EnabledStatusMutualProduct'])}",
                success: function (resp)
                        {
                            if (resp.action=='EnableMutualProduct')
                            {
                                $(".StatusMutualProduct[id="+resp.id+"]").attr('title',"{__('Delete')}");
                                $(".StatusMutualProduct[id="+resp.id+"]").html("{__("Product_ACTIVE")}");
                                $(".MutualProduct-Status[id="+resp.id+"]").html('<i class="fa fa-trash"></i>');
                                $(".MutualProduct-Status[id="+resp.id+"]").addClass("Delete").removeClass('Recycle');
                            }
                        }
            });
        }
    });
    
    $(".MutualProduct-ChangeIsActive").click( function () { 
        return $.ajax2({ data: { MutualProduct : { id: this.name, value: this.id, token: '{mfForm::getToken("ChangeForm")}' } },
                        url: "{url_to('app_mutual_ajax',['action'=>'ChangeIsActiveMutualProduct'])}",
                        errorTarget: ".site-app-mutual-products-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        success: function(resp) {
                                    if (resp.action=='ChangeIsActiveMutualProduct')
                                        changeMutualProductIsActiveState(resp);
                                }
        });    
    });
    
    {* ========================== AUTHER ACTIONS ============================ *}
        
    $(".MutualProduct-Commession").click( function () {              
        return $.ajax2({ data : { MutualProduct : $(this).attr('id') },
                        loading: "#tab-site-dashboard-x-settings-loading",
                        url:"{url_to('app_mutual_ajax',['action'=>'ListPartialMutualProductCommission'])}",
                        errorTarget: ".site-app-mutual-products-errors",
                        target: "#actions"});
    });
    
    $(".MutualProduct-Decommession").click( function () {              
        return $.ajax2({ data : { MutualProduct : $(this).attr('id') },
                        loading: "#tab-site-dashboard-x-settings-loading",
                        url:"{url_to('app_mutual_ajax',['action'=>'ListPartialMutualProductDecommission'])}",
                        errorTarget: ".site-app-mutual-products-errors",
                        target: "#actions"});
    });
        
     
    $(function () {
       $('.footable').footable();
    });
    
</script>    