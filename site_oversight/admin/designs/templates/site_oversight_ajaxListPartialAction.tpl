{messages class="site-errors"}
<h3>{__("Actions")}</h3>
<div>    
   {* <a href="#" id="SiteOversightActionProcess" class="btn">
        <i class="fa fa-cog" style=" margin-right: 10px"></i>{__('Process')}</a>              
     <a href="#" id="SiteOversightActionSend" class="btn">
        <i class="fa fa-envelope" style=" margin-right: 10px"></i>{__('Send alert')}</a>  *}
   {*  <a href="#" id="SiteOversightActionSettings" class="btn">
        <i class="fa fa-cog" style=" margin-right: 10px"></i>{__('Settings')}</a>       *} 
</div>

{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="SiteOversightAction"}
<button id="SiteOversightAction-filter" class="btn-table">{__("Filter")}</button> 
<button id="SiteOversightAction-init" class="btn-table">{__("Init")}</button>
<div class="containerDivResp">
<table cellpadding="0" cellspacing="0" class="tabl-list footable table">  
    <thead> 
    <tr  class="list-header">     
        <th data-hide="phone" style="display: table-cell;" >#</th>  
        {if $user->hasCredential([['superadmin']])}
        <th data-hide="phone" style="display: table-cell;" >
            <span>{__('Module')}</span>               
        </th>          
         <th data-hide="phone" style="display: table-cell;" >
            <span>{__('Action')}</span>               
        </th>  
        {/if}
        <th data-hide="phone" style="display: table-cell;" >
            <span>{__('Message')}</span>               
        </th>           
         <th data-hide="phone" style="display: table-cell;" >
            <span>{__('User')}</span>               
        </th> 
         <th data-hide="phone" style="display: table-cell;" >
            <span>{__('IP')}</span>               
        </th> 
         <th data-hide="phone" style="display: table-cell;" >
            <span>{__('Creator')}</span>               
        </th>
          <th data-hide="phone" style="display: table-cell;" >
            <span>{__('Created at')}</span>               
        </th>  
        <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
    </tr>
    </thead>
    {* search/equal/range *}
    <tr class="input-list">
       <td>{* # *}</td>   
        {if $user->hasCredential([['superadmin']])}
       <td>{* module *}  
           <input class="search" name="module" type="text" value="{$formFilter.search.module}"/>
       </td>       
        <td>
            <input class="search" name="action" type="text" value="{$formFilter.search.action}"/>
       </td>  
       {/if}
       <td>{* message *}
          <input class="search" name="message" type="text" value="{$formFilter.search.message}"/>
       </td>        
        <td>{* message *}
          {html_options class="equal Select" name="user_id" options=$formFilter->equal.user_id->getChoices()->toArray() selected=$formFilter.equal.user_id}
       </td> 
         <td>{* message *}
         <input class="search" name="ip" type="text" value="{$formFilter.search.ip}"/>
       </td>
       <td>{* message *}
        {html_options class="equal Select" name="creator_id" options=$formFilter->equal.creator_id->getChoices()->toArray() selected=$formFilter.equal.creator_id}
       </td>  
       <td>{* message *}
        
       </td>  
       <td>{* actions *}</td>
    </tr>
    {foreach $pager as $item}
    <tr class="SiteOversightAction list" id="{$item->get('id')}"> 
        <td class="SiteOversightAction-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>          
        {if $user->hasCredential([['superadmin']])}
        <td> 
            <span>{$item->get('module')}</span>
        </td>         
         <td>
            {$item->get('action')}
        </td>  
        {/if}
        <td title="{$item->get('message')}">
            {$item->get('message')|truncate:80}
        </td>           
         <td>
             {if $item->hasUser()}
               {$item->getUser()|upper}  
              {else}
                  {__('---')}
              {/if}    
        </td> 
        <td>{$item->get('ip')}
        </td>
        <td>
             {$item->getCreator()|upper}  
        </td>
         <td>
            <span>{$item->getCreatedAt()->getFormatted()}</span>
        </td>
        <td>               
          {*  <a href="#" title="{__('Edit')}" class="SiteOversightAction-View" id="{$item->get('id')}">
                <img  src="{url('/icons/edit.gif','picture')}" alt='{__("Edit")}'/></a> *}                                     
           {* <a href="#" title="{__('Delete')}" class="SiteOversightAction-Delete" id="{$item->get('id')}"  name="{$item->get('operation_id')}">
                <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
            </a>  *}             
        </td>
    </tr>    
    {/foreach}  
</table> 
</div>
{if !$pager->getNbItems()}
    <span>{__('No action')}</span>
{else}
    {*
        <input type="checkbox" id="SiteOversightAction-all" /> 
        <a style="opacity:0.5" class="SiteOversightAction-actions_items" href="#" title="{__('delete')}" id="SiteOversightAction-Delete">
            <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
        </a>         
    *}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="SiteOversightAction"} 

<script type="text/javascript">
    
    function getOversightActionFilterParameters()
    {
        var params={ filter: {  order : { }, 
                                search : { },
                                equal: { },                                                                                                                                    
                            nbitemsbypage: $("[name=SiteOversightAction-nbitemsbypage]").val(),
                            token:'{$formFilter->getCSRFToken()}'
                    } };
        if ($(".SiteOversightAction-order_active").attr("name"))
            params.filter.order[$(".SiteOversightAction-order_active").attr("name")] = $(".SiteOversightAction-order_active").attr("id");   
        $(".SiteOversightAction-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
        return params;                  
    }

    function updateOversightActionFilter()
    {          
         return $.ajax2({ data: getOversightActionFilterParameters(), 
                        url:"{url_to('site_oversight_ajax',['action'=>'ListPartialAction'])}" , 
                        errorTarget: ".site-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions"
                    });
    }

    function updatePager(n)
    {
        page_active=$(".SiteOversightAction-pager .SiteOversightAction-active").html()?parseInt($(".SiteOversightAction-pager .SiteOversightAction-active").html()):1;
        records_by_page=$("[name=SiteOversightAction-nbitemsbypage]").val();
        start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
        $(".SiteOversightAction-count").each(function(id) { $(this).html(start+id) }); // Update index column           
        nb_results=parseInt($("#SiteOversightAction-nb_results").html())-n;
        $("#SiteOversightAction-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
        $("#SiteOversightAction-end_result").html($(".SiteOversightAction-count:last").html());
    }


    {* =====================  P A G E R  A C T I O N S =============================== *}  

    $("#SiteOversightAction-init").click(function() {               
        $.ajax2({ url:"{url_to('site_oversight_ajax',['action'=>'ListPartialAction'])}",
                  errorTarget: ".site-errors",
                  loading: "#tab-site-dashboard-x-settings-loading",                         
                  target: "#actions"}); 
    }); 

    $('.SiteOversightAction-order').click(function() {
        $(".SiteOversightAction-order_active").attr('class','SiteOversightAction-order');
        $(this).attr('class','SiteOversightAction-order_active');
        return updateOversightActionFilter();
    });

    $(".SiteOversightAction-search").keypress(function(event) {
        if (event.keyCode==13)
            return updateOversightActionFilter();
    });

    $("#SiteOversightAction-filter").click(function() { return updateOversightActionFilter(); }); 

    $(".SiteOversightAction-equal[name=is_active],[name=SiteOversightAction-nbitemsbypage]").change(function() { return updateOversightActionFilter(); });     

    $(".SiteOversightAction-pager").click(function () {                      
        return $.ajax2({ data: getOversightActionFilterParameters(), 
                        url:"{url_to('site_oversight_ajax',['action'=>'ListPartialAction'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                        errorTarget: ".site-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions"
        });
    });  

 {* =================== A C T I O N S ================================ *}     
    
    $('#SiteOversightActionSettings').click(function(){                  
        return $.ajax2({ 
                    url: "{url_to('site_oversight_ajax',['action'=>'Settings'])}",
                    errorTarget: ".site-errors",
                    target: "#actions"}); 
    });
    
    $("#SiteOversightActionProcess").click(function(){                  
        return $.ajax2({ 
                    url: "{url_to('site_oversight_ajax',['action'=>'Process'])}",
                    errorTarget: ".site-errors",
                    target: "#actions"
                    }); 
    });
    
    
    $("#SiteOversightActionSend").click(function(){                  
        return $.ajax2({ 
                    url: "{url_to('site_oversight_ajax',['action'=>'SendAlert'])}",
                    errorTarget: ".site-errors",
                    
                    }); 
    });
    
</script>
