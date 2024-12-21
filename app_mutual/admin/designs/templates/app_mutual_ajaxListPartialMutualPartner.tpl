{messages class="site-app-mutual-partner-errors"}
<h3>{__('Mutuals')}</h3>    
<div>
    <a href="javascript:void(0);" class="btn" id="MutualPartner-New" title="{__('new mutual')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>{__('New mutual')}</a>   
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="MutualPartner"}
<button id="MutualPartner-filter" class="btn-table">{__("Filter")}</button> 
<button id="MutualPartner-init" class="btn-table">{__("Init")}</button>
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0"> 
    <thead> 
    <tr class="list-header">    
        <th>#</th>
        {if $pager->getNbItems()>5}<th>&nbsp;</th>{/if}      
        <th class="footable-first-column" data-toggle="true">
            <span>{__('Name')}</span>
        </th>
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('Post code')}</span>               
        </th>
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('City')}</span>  
        </th>
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('Phone')}</span>                 
        </th> 
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('Taxe')}</span>                 
        </th> 
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('Fees')}</span>                 
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
        <td>{* name *}</td>
        <td>{* post code *}</td>
        <td>{* city *}</td>
        <td>{* phone *}</td> 
        <td>{* taxe *}</td> 
        <td>{* fees *}</td> 
        <td>{* is_active *}</td> 
        <td>{* actions *}</td>
    </tr>
    {foreach $pager as $item}
    <tr class="MutualPartner list" id="MutualPartner-{$item->get('id')}"> 
        <td class="MutualPartner-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>
        {if $pager->getNbItems()>5}
            <td>                           
                <input class="MutualPartner-selection" type="checkbox" id="{$item->get('id')}" name="{$item->get('name')}"/>                      
            </td>
        {/if}
        <td>{$item->get('name')}</td>
        <td>{$item->get('postcode')}</td>
        <td>{$item->get('city')}</td>
        <td>{$item->get('phone')}</td>  
        <td>{$item->getParams()->getTaxePercent()}</td>  
        <td>{$item->getParams()->getFeesI18n()}</td>
        <td>                
            <a href="javascript:void(0);" class="MutualPartner-ChangeIsActive" name="{$item->get('id')}" id="{$item->get('is_active')}"><img src="{url('/icons/','picture')}{$item->get('is_active')}.gif" alt='{__($item->get("is_active"))}' title='{__($item->get("is_active"))}'/></a>                           
        </td>
        <td> 
            <a href="javascript:void(0);" title="{__('Edit')}" class="MutualPartner-View" id="{$item->get('id')}"><i class="fa fa-edit fa-lg"></i></a> 
            <a href="javascript:void(0);" title="{__('Contacts')}" class="MutualPartner-Contacts" id="{$item->get('id')}"><i class="fa fa-user fa-lg"></i></a>  
            <a id="{$item->get('id')}" href="javascript:void(0);" class="MutualPartner-Products" title="{__('products list')}"><i class="fa fa-tasks fa-lg"></i></a>
            <a id="{$item->get('id')}" href="javascript:void(0);" class="MutualPartner-Params" title="{__('params')}"><i class="fa fa-info-circle fa-lg"></i></a>
            {if $item->get('status')=='ACTIVE'}
                <a href="javascript:void(0);" title="{__('Disable')}" class="MutualPartner-Status Delete" id="{$item->get('id')}" name="{$item->get('name')}"><i class="fa fa-trash fa-lg"></i></a>
            {else}
                <a href="javascript:void(0);" title="{__('Enable')}" class="MutualPartner-Status Recycle" id="{$item->get('id')}" name="{$item->get('name')}"><i class="fa fa-recycle fa-lg"></i></a>
            {/if}
            <a href="javascript:void(0);" title="{__('Delete')}" class="MutualPartner-Delete" id="{$item->get('id')}"  name="{$item->get('name')}"><i class="fa fa-trash-o fa-lg"></i></a> 
            <a href="javascript:void(0);" title="{__('Remove')}" class="MutualPartner-Remove" id="{$item->get('id')}"  name="{$item->get('name')}"><i class="fa fa-times fa-lg"></i></a> 
        </td>
    </tr>    
    {/foreach}  
</table>    
{if !$pager->getNbItems()}
    <span>{__('No mutuals')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="MutualPartner-all" /> 
        <a style="opacity:0.5" class="MutualPartner-actions_items" href="#" title="{__('delete')}" id="MutualPartner-Deletes">
            <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
        </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="MutualPartner"} 
  
<script type="text/javascript">
    
    function changeMutualPartnerIsActiveState(resp) 
    {
        $.each(resp.selection?resp.selection:[resp.id], function () {              
            sel="a.MutualPartner-ChangeIsActive[name="+this+"]";
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
    
    function getSiteMutualPartnerFilterParameters()
    {
        var params={ filter: {  order : { }, 
                                search : { },
                                equal: { 
                                    name : $("[name=MutualPartner-name] option:selected").val()  
                                },
                            lang: $("img.MutualPartner").attr('id'),                                                                                                               
                            nbitemsbypage: $("[name=MutualPartner-nbitemsbypage]").val(),
                            token:'{$formFilter->getCSRFToken()}'
                    } };
        if ($(".MutualPartner-order_active").attr("name"))
            params.filter.order[$(".MutualPartner-order_active").attr("name")] =$(".MutualPartner-order_active").attr("id");   
        $(".MutualPartner-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
        return params;                  
    }

    function updateSiteMutualPartnerFilter()
    {  
        return $.ajax2({ data: getSiteMutualPartnerFilterParameters(), 
                        url:"{url_to('app_mutual_ajax',['action'=>'ListPartialMutualPartner'])}" , 
                        errorTarget: ".site-app-mutual-partner-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions"
                    });
    }

    function updateSitePager(n)
    {
        page_active=$(".MutualPartner-pager .MutualPartner-active").html()?parseInt($(".MutualPartner-pager .MutualPartner-active").html()):1;
        records_by_page=$("[name=MutualPartner-nbitemsbypage]").val();
        start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
        $(".MutualPartner-count").each(function(id) { $(this).html(start+id) }); // Update index column           
        nb_results=parseInt($("#MutualPartner-nb_results").html())-n;
        $("#MutualPartner-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
        $("#MutualPartner-end_result").html($(".MutualPartner-count:last").html());
    }
          
    {* =====================  P A G E R  A C T I O N S =============================== *}  
      
    $("#MutualPartner-init").click(function() {      
        $.ajax2({ url:"{url_to('app_mutual_ajax',['action'=>'ListPartialMutualPartner'])}",
                errorTarget: ".site-app-mutual-partner-errors",
                loading: "#tab-site-dashboard-x-settings-loading",                         
                target: "#actions"}); 
    }); 

    $('.MutualPartner-order').click(function() {
        $(".MutualPartner-order_active").attr('class','MutualPartner-order');
        $(this).attr('class','MutualPartner-order_active');
        return updateSiteMutualPartnerFilter();
    });

    $(".MutualPartner-search").keypress(function(event) {
        if (event.keyCode==13)
            return updateSiteMutualPartnerFilter();
    });

    $("#MutualPartner-filter").click(function() { return updateSiteMutualPartnerFilter(); }); 

    $("[name=MutualPartner-nbitemsbypage]").change(function() { return updateSiteMutualPartnerFilter(); }); 

    // $("[name=MutualPartner-name]").change(function() { return updateSiteMutualPartnerFilter(); }); 

    $(".MutualPartner-pager").click(function () {    
        return $.ajax2({ data: getSiteMutualPartnerFilterParameters(), 
                        url:"{url_to('app_mutual_ajax',['action'=>'ListPartialMutualPartner'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                        errorTarget: ".site-app-mutual-partner-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions"
        });
    });
    
    {* =====================  A C T I O N S =============================== *}  
     
    $(".MutualPartner-Products").click( function () {              
        return $.ajax2({ data : { MutualPartner : $(this).attr('id') },
                        loading: "#tab-site-dashboard-x-settings-loading",
                        url:"{url_to('app_mutual_ajax',['action'=>'ListPartialMutualProduct'])}",
                        errorTarget: ".site-app-mutual-partner-errors",
                        target: "#actions"});
    });
    
     
    $(".MutualPartner-Params").click( function () {              
        return $.ajax2({ data : { MutualPartner : $(this).attr('id') },
                        loading: "#tab-site-dashboard-x-settings-loading",
                        url:"{url_to('app_mutual_ajax',['action'=>'ViewMutualParams'])}",
                        errorTarget: ".site-app-mutual-partner-errors",
                        target: "#actions"});
    });
    
    $(".MutualPartner-Contacts").click( function () {              
        return $.ajax2({ data : { MutualPartner : $(this).attr('id') },
                        loading: "#tab-site-dashboard-x-settings-loading",
                        url:"{url_to('app_mutual_ajax',['action'=>'ListMutualPartnerContact'])}",
                        errorTarget: ".site-errors",
                        target: "#actions"});
 }  );
    
    $("#MutualPartner-New").click( function () {    
            return $.ajax2({                    
                url: "{url_to('app_mutual_ajax',['action'=>'NewMutualPartner'])}",
                errorTarget: ".site-app-mutual-partner-errors",
                loading: "#tab-site-dashboard-x-settings-loading",
                target: "#actions"
        });
    });

    $(".MutualPartner-View").click( function () {                    
        return $.ajax2({ data : { MutualPartner : $(this).attr('id') },
                        loading: "#tab-site-dashboard-x-settings-loading",
                        url:"{url_to('app_mutual_ajax',['action'=>'ViewMutualPartner'])}",
                        errorTarget: ".site-app-mutual-partner-errors",
                        target: "#actions"});
    });
    
    $(".MutualPartner-Delete").click( function () { 
        if (!confirm('{__("Mutual \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
        return $.ajax2({ 
                    data :{ MutualPartner: $(this).attr('id') },
                    url :"{url_to('app_mutual_ajax',['action'=>'DeleteMutualPartner'])}",
                    errorTarget: ".site-app-mutual-partner-errors",    
                    loading: "#tab-site-site-x-settings-loading",
                    success : function(resp) {
                        if (resp.action=='DeleteMutualPartner')
                        {    
                            $("tr#MutualPartner-"+resp.id).remove();  
                            if ($('.MutualPartner').length==0)
                                return $.ajax2({ url:"{url_to('app_mutual_ajax',['action'=>'ListPartialMutualPartner'])}",
                                                errorTarget: ".site-app-mutual-partner-errors",
                                                target: "#tab-dashboard-site-x-settings"});
                            updateSitePager(1);
                        }       
                    }
        });                                        
    });
    
    $(".MutualPartner-Remove").click( function () { 
        if (!confirm('{__("Mutual \"#0#\" will be removed. Confirm ?")}'.format($(this).attr('name')))) return false; 
        return $.ajax2({ 
            data :{ MutualPartner: $(this).attr('id') },
            url :"{url_to('app_mutual_ajax',['action'=>'RemoveMutualPartner'])}",
            errorTarget: ".site-app-mutual-partner-errors",    
            loading: "#tab-site-site-x-settings-loading",
            success : function(resp) {
                if (resp.action=='RemoveMutualPartner')
                {    
                    $("tr#MutualPartner-"+resp.id).remove();  
                    if ($('.MutualPartner').length==0)
                        return $.ajax2({ url:"{url_to('app_mutual_ajax',['action'=>'ListPartialMutualPartner'])}",
                                        errorTarget: ".site-app-mutual-partner-errors",
                                        loading: "#tab-site-site-x-settings-loading",
                                        target: "#tab-dashboard-site-x-settings"});
                    updateSitePager(1);
                }       
            }
        });                                        
    });
       
    $(".MutualPartner-ChangeIsActive").click( function () { 
        return $.ajax2({ data: { MutualPartner : { id: $(this).attr('name'), value: $(this).attr('id'), token: '{mfForm::getToken("ChangeForm")}' } },
                        url: "{url_to('app_mutual_ajax',['action'=>'ChangeIsActiveMutualPartner'])}",
                        errorTarget: ".site-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        success: function(resp) {
                                    if (resp.action=='ChangeIsActiveMutualPartner')
                                        changeMutualPartnerIsActiveState(resp);
                                }
        });    
    });
    
    $(".MutualPartner-Status").click(function () {
        if ($(this).hasClass('Delete'))
        {
            if (!confirm('{__("Mutual \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false;
            return $.ajax2({
                data : { MutualPartner: $(this).attr('id') },
                url: "{url_to('app_mutual_ajax',['action'=>'DisabledStatusMutualPartner'])}",
                success: function (resp)
                        {
                            if (resp.action=='DisableMutualPartner')
                            {
                                $(".StatusMutualPartner[id="+resp.id+"]").attr('title',"{__('Recycle')}");
                                $(".StatusMutualPartner[id="+resp.id+"]").html("{__("MutualPartner_DELETE")}");
                                $(".MutualPartner-Status[id="+resp.id+"]").addClass("Recycle").removeClass('Delete');
                                $(".MutualPartner-Status[id="+resp.id+"]").html('<i class="fa fa-recycle fa-lg"></i>');
                            }
                        }
            });
        }
        else
        {
            if (!confirm('{__("Mutual \"#0#\" will be recycled. Confirm ?")}'.format($(this).attr('name')))) return false;
            return $.ajax2({
                data : { MutualPartner: $(this).attr('id') },
                url: "{url_to('app_mutual_ajax',['action'=>'EnabledStatusMutualPartner'])}",
                success: function (resp)
                        {
                            if (resp.action=='EnableMutualPartner')
                            {
                                $(".StatusMutualPartner[id="+resp.id+"]").attr('title',"{__('Delete')}");
                                $(".StatusMutualPartner[id="+resp.id+"]").html("{__("MutualPartner_ACTIVE")}");
                                $(".MutualPartner-Status[id="+resp.id+"]").html('<i class="fa fa-trash fa-lg"></i>');
                                $(".MutualPartner-Status[id="+resp.id+"]").addClass("Delete").removeClass('Recycle');
                            }
                        }
            });
        }
    });
    
    $(function () {
        $('.footable').footable();
    });
    
</script>    