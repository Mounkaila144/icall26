{messages class="site-errors"}
<h3>{__("Messages")}</h3>
{*
<div id="oversight-tabs" style="min-height: 600px">    
    <ul id="oversight-tabs-ctn">  
            <li class="site" id="site-tab1" aria-controls='site-panel-tab1' name="site-panel-tab1">            
                <a href="#tab-tab1" id="site-panel-tab1-link" title="{__('tab1')}" name="tab-tab1" class="tab-site tabSiteWidth">         
                    {if $tab.icon}<i class="fa fa-{$tab.icon}"></i>title)
                     {elseif $tab.picture}<img height="32" width="32" src="{url($tab.picture,'web')}" alt="{__($tab.title)|capitalize}"/>
                     {/if} 
                     <span class="name-tabs">{__('tab1')|capitalize}</span>    

                     <img id="tab-site-tab1-loading" class="loading" style="display:none;" style="z-index: 500" height="16px" width="16px" src="{url('/icons/loader.gif','picture')}" alt="loader"/>
                </a>              
            </li>
    </ul>       
    <div id="tab-tab1" name="">
        
    </div>   
</div>  *}
    
<div>    
    <a href="#" id="SiteOversightActions" class="btn">
        <i class="fa fa-cog" style=" margin-right: 10px"></i>{__('Actions')}</a>              
 {*    <a href="#" id="SiteOversightMessageSend" class="btn">
        <i class="fa fa-envelope" style=" margin-right: 10px"></i>{__('Send alert')}</a>  *}
   {*  <a href="#" id="SiteOversightMessageSettings" class="btn">
        <i class="fa fa-cog" style=" margin-right: 10px"></i>{__('Settings')}</a>       *} 
</div>

{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="SiteOversightMessage"}
<button id="SiteOversightMessage-filter" class="btn-table">{__("Filter")}</button> 
<button id="SiteOversightMessage-init" class="btn-table">{__("Init")}</button>
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
            <span>{__('Header')}</span>               
        </th>  
        {/if}
        <th data-hide="phone" style="display: table-cell;" >
            <span>{__('Message')}</span>               
        </th> 
          <th data-hide="phone" style="display: table-cell;" >
            <span>{__('Number of items')}</span>               
        </th> 
         <th data-hide="phone" style="display: table-cell;" >
            <span>{__('User')}</span>               
        </th> 
         <th data-hide="phone" style="display: table-cell;" >
            <span>{__('IP')}</span>               
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
            <input class="search" name="header" type="text" value="{$formFilter.search.header}"/>
       </td>  
       {/if}
       <td>{* message *}
          <input class="search" name="message" type="text" value="{$formFilter.search.message}"/>
       </td> 
        <td>{* message *}
        
       </td>
        <td>{* message *}
          {html_options class="equal Select" name="user_id" options=$formFilter->equal.user_id->getChoices()->toArray() selected=$formFilter.equal.user_id}
       </td> 
         <td>{* message *}
         <input class="search" name="ip" type="text" value="{$formFilter.search.ip}"/>
       </td>
       <td>{* message *}
        
       </td>  
       <td>{* actions *}</td>
    </tr>
    {foreach $pager as $item}
    <tr class="SiteOversightMessage list" id="SiteOversightMessage-{$item->get('id')}"> 
        <td class="SiteOversightMessage-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>          
        {if $user->hasCredential([['superadmin']])}
        <td> 
            <span>{$item->get('module')}</span>
        </td>         
         <td>
            {$item->get('header')|truncate:80}
        </td>  
        {/if}
        <td>
            {$item->get('message')|truncate:80}
        </td>  
         <td> {$item->get('number_of_items')}
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
            <span>{$item->getCreatedAt()->getFormatted()}</span>
        </td>
        <td>               
          {*  <a href="#" title="{__('Edit')}" class="SiteOversightMessage-View" id="{$item->get('id')}">
                <img  src="{url('/icons/edit.gif','picture')}" alt='{__("Edit")}'/></a> *}                                     
           {* <a href="#" title="{__('Delete')}" class="SiteOversightMessage-Delete" id="{$item->get('id')}"  name="{$item->get('operation_id')}">
                <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
            </a>  *}             
        </td>
    </tr>    
    {/foreach}  
</table> 
</div>
{if !$pager->getNbItems()}
    <span>{__('No message')}</span>
{else}
    {*
        <input type="checkbox" id="SiteOversightMessage-all" /> 
        <a style="opacity:0.5" class="SiteOversightMessage-actions_items" href="#" title="{__('delete')}" id="SiteOversightMessage-Delete">
            <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
        </a>         
    *}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="SiteOversightMessage"} 

<script type="text/javascript">
    
    function getOversightMessageFilterParameters()
    {
        var params={ filter: {  order : { }, 
                                search : { },
                                equal: { },                                                                                                                                    
                            nbitemsbypage: $("[name=SiteOversightMessage-nbitemsbypage]").val(),
                            token:'{$formFilter->getCSRFToken()}'
                    } };
        if ($(".SiteOversightMessage-order_active").attr("name"))
            params.filter.order[$(".SiteOversightMessage-order_active").attr("name")] = $(".SiteOversightMessage-order_active").attr("id");   
        $(".SiteOversightMessage-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
        return params;                  
    }

    function updateOversightMessageFilter()
    {          
         return $.ajax2({ data: getOversightMessageFilterParameters(), 
                        url:"{url_to('site_oversight_ajax',['action'=>'ListPartialMessage'])}" , 
                        errorTarget: ".site-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions"
                    });
    }

    function updatePager(n)
    {
        page_active=$(".SiteOversightMessage-pager .SiteOversightMessage-active").html()?parseInt($(".SiteOversightMessage-pager .SiteOversightMessage-active").html()):1;
        records_by_page=$("[name=SiteOversightMessage-nbitemsbypage]").val();
        start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
        $(".SiteOversightMessage-count").each(function(id) { $(this).html(start+id) }); // Update index column           
        nb_results=parseInt($("#SiteOversightMessage-nb_results").html())-n;
        $("#SiteOversightMessage-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
        $("#SiteOversightMessage-end_result").html($(".SiteOversightMessage-count:last").html());
    }


    {* =====================  P A G E R  A C T I O N S =============================== *}  

    $("#SiteOversightMessage-init").click(function() {               
        $.ajax2({ url:"{url_to('site_oversight_ajax',['action'=>'ListPartialMessage'])}",
                  errorTarget: ".site-errors",
                  loading: "#tab-site-dashboard-x-settings-loading",                         
                  target: "#actions"}); 
    }); 

    $('.SiteOversightMessage-order').click(function() {
        $(".SiteOversightMessage-order_active").attr('class','SiteOversightMessage-order');
        $(this).attr('class','SiteOversightMessage-order_active');
        return updateOversightMessageFilter();
    });

    $(".SiteOversightMessage-search").keypress(function(event) {
        if (event.keyCode==13)
            return updateOversightMessageFilter();
    });

    $("#SiteOversightMessage-filter").click(function() { return updateOversightMessageFilter(); }); 

    $(".SiteOversightMessage-equal[name=is_active],[name=SiteOversightMessage-nbitemsbypage]").change(function() { return updateOversightMessageFilter(); });     

    $(".SiteOversightMessage-pager").click(function () {                      
        return $.ajax2({ data: getOversightMessageFilterParameters(), 
                        url:"{url_to('site_oversight_ajax',['action'=>'ListPartialMessage'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                        errorTarget: ".site-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions"
        });
    });  

 {* =================== A C T I O N S ================================ *}     
    
    $('#SiteOversightMessageSettings').click(function(){                  
        return $.ajax2({ 
                    url: "{url_to('site_oversight_ajax',['action'=>'Settings'])}",
                    errorTarget: ".site-errors",
                    target: "#actions"}); 
    });
    
     
    
    $("#SiteOversightActions").click(function(){                  
        return $.ajax2({ 
                    url: "{url_to('site_oversight_ajax',['action'=>'ListPartialAction'])}",
                    errorTarget: ".site-errors",
                    target: "#actions"
                    }); 
    });
    
</script>
