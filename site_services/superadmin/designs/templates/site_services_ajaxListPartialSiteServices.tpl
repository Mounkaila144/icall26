{messages class="site-services-errors"}
   
<div>
        <a href="#" class="btn widthAFilter" id="SiteServices-Refresh">{__('Refresh')}</a> 
                 <a href="#" class="btn widthAFilter" id="SiteServices-Refresh2">{__('Refresh 2')}</a> 
        <a href="#" class="btn widthAFilter" id="SiteServices-Servers">{__('Servers')}</a> 
         <a href="{url_to('site_services_main',['action'=>'ExportCsvSites'])}?{$formFilter->getParametersForUrl( ['equal','search'])}" class="btn widthAFilter"  title="{__('Export')}" >
        <i class="fa fa-caret-square-o-down" style="margin-right: 10px"></i>{__('Export')}</a> 
         <a href="#" class="btn widthAFilter" id="SiteServices-Import">
             <i class="fa fa-download"></i>{__('Import info.')}</a> 
</div>      
  <span id="message" style="colot:green;"></span> 
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="SiteServicesSite"}

    <fieldset>
        <legend>{__('List Sites')}  {__('Last update')}:{if $settings->hasLastUpdate()}{$settings->getFormattedLastUpdate()}{else}{__('---')}{/if}</legend>        
        <button class="btn-table" id="SiteServicesSite-filter">{__("Filter")}</button>   
        <button class="btn-table" id="SiteServicesSite-init">{__("Init")}</button>
        <div class="containerDivResp">
        <table  id="SitesList" class="tabl-list  footable table" cellpadding="0" cellspacing="0">
            <tr class="list-header">
                 <th>#</th>   
                <th></th>   
                <th>
                    {__('Server')} 
                </th>
                <th>
                    {__('Host')}
                    <div>
                    <a href="#" class="SiteServicesSite-order{$formFilter.order.host->getValueExist('asc','_active')}" id="asc" name="host"><img  src='{url("/icons/sort_asc`$formFilter.order.host->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                    <a href="#" class="SiteServicesSite-order{$formFilter.order.host->getValueExist('desc','_active')}" id="desc" name="host"><img  src='{url("/icons/sort_desc`$formFilter.order.host->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                    </div>
                </th>
                 <th>
                   {__('Folder Size')} 
                </th>
                <th>
                    {__('Database name')}
                    <div>
                    <a href="#" class="SiteServicesSite-order{$formFilter.order.db_name->getValueExist('asc','_active')}" id="asc" name="db_name"><img  src='{url("/icons/sort_asc`$formFilter.order.db_name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                    <a href="#" class="SiteServicesSite-order{$formFilter.order.db_name->getValueExist('desc','_active')}" id="desc" name="db_name"><img  src='{url("/icons/sort_desc`$formFilter.order.db_name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                    </div>
                </th>
                <th>
                    {__('Database host')}
                    <div>
                    <a href="#" class="SiteServicesSite-order{$formFilter.order.db_host->getValueExist('asc','_active')}" id="asc" name="db_host"><img  src='{url("/icons/sort_asc`$formFilter.order.db_host->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                    <a href="#" class="SiteServicesSite-order{$formFilter.order.db_host->getValueExist('desc','_active')}" id="desc" name="db_host"><img  src='{url("/icons/sort_desc`$formFilter.order.db_host->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                    </div>
                </th>
                <th>
                   {__('Database Size')} 
                </th>
                <th>{__('Admin state')}</th>
                <th>{__('Frontend state')}</th>
                <th>
                <span>{__('Active')}</span>    
                </th> 
                <th>{__("Theme admin")}</th>                
                <th>{__('Global')}</th>
                
                <th>{__('Last connection')}</th>
                <th>{__('Company')}</th>
                 <th>{__('Description')}</th>
                <th>{__('Actions')}</th>
            </tr>
            <tr class='input-list'>
                <td></td>
                <td>
                     <input id="SiteServicesSite-All" type="checkbox"/>
                </td>
                <td>{* # *}
                    {html_options name="server_id" class="SiteServicesSite-equal Select" options=$formFilter->equal.server_id->getOption('choices') selected=(string)$formFilter.equal.server_id}
                </td>          
                <td>{* date *}
                      <input class="SiteServicesSite-search Input" type="text" size="10" name="host" value="{$formFilter.search.host}"> 
                </td> 
                <td></td>
                <td> 
                      <input class="SiteServicesSite-search Input" type="text" size="10" name="db_name" value="{$formFilter.search.db_name}"> 
                </td>                
                <td>
                      <input class="SiteServicesSite-search Input" type="text" size="10" name="db_host" value="{$formFilter.search.db_host}">                
                </td>
                <td></td>
                <td>{html_options name="admin_available" class="SiteServicesSite-equal Select" options=$formFilter->equal.admin_available->getOption('choices') selected=(string)$formFilter.equal.admin_available}</td>
                <td>{html_options name="frontend_available" class="SiteServicesSite-equal Select"  options=$formFilter->equal.frontend_available->getOption('choices') selected=(string)$formFilter.equal.frontend_available}</td>
                <td>{html_options name="is_active" class="SiteServicesSite-equal Select"  options=$formFilter->equal.is_active->getOption('choices') selected=(string)$formFilter.equal.is_active}</td>
                <td>{html_options name="admin_theme" class="SiteServicesSite-equal Select"  options=$formFilter->equal.admin_theme->getOption('choices') selected=(string)$formFilter.equal.admin_theme}</td>
                <td>{html_options name="available" class="SiteServicesSite-equal Select"  options=$formFilter->equal.available->getOption('choices') selected=(string)$formFilter.equal.available}</td>                
                <td></td>
                <td></td>
                <td> <input class="SiteServicesSite-search Input" type="text" size="10" name="company" value="{$formFilter.search.company}">                
                </td>
                 <td></td>                   
                <td></td>
            </tr>
            
            {foreach $pager as $item}
            <tr class="SiteServicesSite-FilterList list" id="{$item->get('id')}" title="{$item->get('description')}"> 
                <td>{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>  
                <td> 
                      <input class="SiteServicesSite-selection" type="checkbox" id="{$item->get('id')}" name="{$item->get('host')}" {if $formFilter->getSelected()->in($item->get('id'))}checked=""}{/if}/>   
                </td>
                <td >{$item->getServer()->get('name')}</td>
                <td>{$item->get('host')}</td>
                <td>{format_size($item->get('size'))}</td>
                <td>{$item->get('db_host')}</td>
                <td>{$item->get('db_name')}</td>
                  <td>{format_size($item->get('db_size'))}</td>
                <td><a href="#" class="SiteServicesSite-ChangeAdmin" id="{$item->get('id')}" name="{$item->get('admin_available')}"><img src="{url('/icons/','picture')}{$item->get('admin_available')}.gif" alt='{__("`$item->get("admin_available")`")}' title='{__("`$item->get("admin_available")`")}'/></a></td>
                <td><a href="#" class="SiteServicesSite-ChangeFrontend" id="{$item->get('id')}" name="{$item->get('frontend_available')}"><img src="{url('/icons/','picture')}{$item->get('frontend_available')}.gif" alt='{__("`$item->get("frontend_available")`")}' title='{__("`$item->get("frontend_available")`")}'/></a></td>
                 <td class="SiteServicesSite-IsExist-Text"  >
                   {__($item->get('is_active'))}
                </td> 
                <td><span title="{__($item->getThemeAdmin())|escape}">{__($item->getThemeAdmin())|escape|truncate:20}</span>
                    {if $item->hasThemeAdminBase()}<span>({__($item->getThemeAdminBase())|truncate:20})</span>{/if}
                </td>
               
                <td><a href="#" class="SiteServicesSite-ChangeGlobal" id="{$item->get('id')}" name="{$item->get('available')}"><img src="{url('/icons/','picture')}{$item->get('available')}.gif" alt='{__("`$item->get("available")`")}' title='{__("`$item->get("available")`")}'/></a></td>
                <td>{$item->last_connection}</td>
                <td>{$item->get('company')}</td>
                <td>{$item->get('description')|truncate:80}</td>
                <td>
                    <a href="#" class="SiteServicesSite-Edit" id="{$item->get('id')}"><i class="fa fa-edit"></i></a>
                    <a href="#" class="SiteServicesSite-SiteArchive" id="{$item->get('id')}"><i class="fa fa-archive" aria-hidden="true"></i></a>
                    <a href="#" name="{$item->getServer()->get('name')} - {$item->get('host')}" class="SiteServicesSite-Delete" id="{$item->get('id')}"><i class="fa fa-trash"></i></a>
                    {component name="/server_archive/actionCopy" item=$item}
                </td>
            </tr>
            {/foreach}
            
        </table>
             {if !$pager->hasItems()}
         <span>{__('No site')}</span>   
    {/if}
        </div>
   {include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="SiteServicesSite"}              
    </fieldset>
              
    
    <script type="text/javascript">

        $("#actions-site-services").data('mode','Sites');
        
        $("#actions-site-services").data('sites_selected',{$formFilter->getSelected()->toJson()});
        
        $(".SiteServicesSite-selection").click(function () {               
              if ($(this).prop('checked'))                                                  
                  $("#actions-site-services").data("sites_selected").push($(this).attr("id"));                                 
              else              
                  $("#actions-site-services").data("sites_selected").splice($.inArray($(this).attr("id"),$("#actions-site-services").data("sites_selected")),1);                                                           
        });
        
        
        function getSiteServicesSiteFilterParameters()
        {
            var params={   
                           filter: {  order : { }, 
                                    search : { },
                                    equal: {  },             
                                selected: $("#actions-site-services").data("sites_selected"),  
                                nbitemsbypage: $("[name=SiteServicesSite-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".SiteServicesSite-order_active").attr("name"))
                 params.filter.order[$(".SiteServicesSite-order_active").attr("name")] =$(".SiteServicesSite-order_active").attr("id");   
            $(".SiteServicesSite-search.Input").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });                                            
            $(".SiteServicesSite-equal option:selected").each(function() { params.filter.equal[$(this).parent().attr('name')] =$(this).val(); });             
            $(".SiteServicesSite-search option:selected").each(function() { params.filter.search[$(this).parent().attr('name')] =$(this).val(); });             
            return params;                  
        }
        
        function updateSiteServicesSiteFilter()
        {                     
           return $.ajax2({ data: getSiteServicesSiteFilterParameters(), 
                            url:"{url_to('site_services_ajax',['action'=>'ListPartialSiteServices'])}" , 
                            loading: "#tab-dashboard-site-services-loading",
                            errorTarget: ".site-services-errors",
                            target: "#actions-site-services"
                             });                              
        }
    
        function updateSitePager(n)
        {
           page_active=$(".SiteServicesSite-pager .SiteServicesSite-active").html()?parseInt($(".SiteServicesSite-pager .SiteServicesSite-active").html()):1;
           records_by_page=$("[name=SiteServicesSite-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".SiteServicesSite-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#SiteServicesSite-nb_results").html())-n;
           $("#SiteServicesSite-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#SiteServicesSite-end_result").html($(".SiteServicesSite-count:last").html());
        }
        
        {* ===========================  P A G E R  A C T I O N S =============================== *}  
      
          $("#SiteServicesSite-init").click(function() { 
              return $.ajax2({ 
                            data: { filter : $.extend({ selected: $("#actions-site-services").data("sites_selected"),token:'{$formFilter->getCSRFToken()}' },{$formFilter->getDefaultValues()->toJson()}) },
                            url:"{url_to('site_services_ajax',['action'=>'ListPartialSiteServices'])}",
                            loading: "#tab-dashboard-site-services-loading",
                            errorTarget: ".site-services-errors",
                            target: "#actions-site-services"
                       });                     
           }); 
           
            $('.SiteServicesSite-order').click(function() {
 
                $(".SiteServicesSite-order_active").attr('class','SiteServicesSite-order');
                $(this).attr('class','SiteServicesSite-order_active');
                return updateSiteServicesSiteFilter();
           });
           
            $(".SiteServicesSite-search").keypress(function(event) {

                if (event.keyCode==13)
                    return updateSiteServicesSiteFilter();
            });
            
          $(".SiteServicesSite-equal.Select,.SiteServicesSite-search.Select").change(function() { return updateSiteServicesSiteFilter(); }); 
             
          $("#SiteServicesSite-filter").click(function() { 
              return updateSiteServicesSiteFilter();
          }); 
          
          $("[name=SiteServicesSite-nbitemsbypage]").change(function() { 
              return updateSiteServicesSiteFilter();
          }); 
                  
           
           $(".SiteServicesSite-pager").click(function () {   
                                  
                return $.ajax2({ data: getSiteServicesSiteFilterParameters(), 
                                 url:"{url_to('site_services_ajax',['action'=>'ListPartialSiteServices'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                loading: "#tab-dashboard-site-services-loading",
                            errorTarget: ".site-services-errors",
                            target: "#actions-site-services"
                });
              
        });
        
        {* ==========================  A C T I O N S =============================== *}  
        
        $("#SiteServices-Refresh").click(function(){
                return $.ajax2({ 
                        url:"{url_to('server_services_ajax',['action'=>'Refresh'])}",
                         loading: "#tab-dashboard-site-services-loading",
                            errorTarget: ".site-services-errors",
                            target: "#actions-site-services"
            });
        });
        
        function updateSiteServicesChange(resp) 
        {         
            sel=".SiteServicesSite-"+resp.action+"[id="+resp.id+"]";
            if (resp.state=='YES'||resp.state=='NO') 
            {    
                $(sel+" img").attr({
                    src :"{url('/icons/','picture')}"+resp.state+".gif",
                    alt : (resp.state=='YES'?'{__("user_YES")}':'{__("user_NO")}'),
                    title : (resp.state=='YES'?'{__("user_YES")}':'{__("user_NO")}')
                });
                $(sel).attr("name",resp.state);
            }           
        }

        
        $(".SiteServicesSite-ChangeAdmin").click(function(){
                return $.ajax2({  data: { host : this.id, value: this.name },
                   loading: "#tab-dashboard-site-services-loading",
                   errorTarget: ".site-services-errors",                                                      
                   url:"{url_to('site_services_ajax',['action'=>'ChangeAdmin'])}", 
                   success: function (resp) {                       
                        if (resp.action=='ChangeAdmin')
                            updateSiteServicesChange(resp);                        
                  }  
                });
        });
        
        $(".SiteServicesSite-ChangeFrontend").click(function(){
                return $.ajax2({  data: { host : this.id, value: this.name },
                    loading: "#tab-dashboard-site-services-loading",
                   errorTarget: ".site-services-errors",                                                           
                   url:"{url_to('site_services_ajax',['action'=>'ChangeFrontend'])}", 
                   success: function (resp) {                        
                        if (resp.action=='ChangeFrontend')
                            updateSiteServicesChange(resp);
                  }  
                });
        });
        
        $(".SiteServicesSite-SiteArchive").click(function(){               
                return $.ajax2({  data: { host : this.id },
                   loading: "#tab-dashboard-site-services-loading",
                   errorTarget: ".site-services-errors",                                                          
                   url:"{url_to('site_services_ajax',['action'=>'SiteArchive'])}", 
                   success: function (resp) {                        
                        if (resp.action=='SiteArchive')
                            alert(resp.action);
                  }  
                });
    
        });

        $(".SiteServicesSite-ChangeGlobal").click(function(){
                return $.ajax2({  data: { host : this.id, value: this.name },
                    loading: "#tab-dashboard-site-services-loading",
                   errorTarget: ".site-services-errors",                                 
                   url:"{url_to('site_services_ajax',['action'=>'ChangeGlobal'])}", 
                   success: function (resp) {                      
                        if (resp.action=='ChangeGlobal')
                            updateSiteServicesChange(resp);
                  }  
                });
        });
        
        
        $("#SiteServices-Servers").click(function(){
            return $.ajax2({                              
                   url:"{url_to('site_services_ajax',['action'=>'ListPartialSiteServicesServers'])}",
                  loading: "#tab-dashboard-site-services-loading",
                   errorTarget: ".site-services-errors",    
                   target: "#actions-site-services"
                });
        
        });
        
           
         $(".SiteServicesSite-Delete").click(function(){     
          if (!confirm('{__("Site \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({  data: { SiteServicesSite : $(this).attr('id') },
                   loading: "#tab-dashboard-site-services-loading",
                   errorTarget: ".site-services-errors",                                                          
                   url:"{url_to('site_services_ajax',['action'=>'DeleteSite'])}", 
                   success: function (resp) {                        
                           if (resp.action!='DeleteSite') return ;
                           $(".SiteServicesSite-FilterList[id="+resp.id+"]").remove();
                  }  
                });
    
        });
        
        $(".SiteServicesSite-Edit").click(function(){               
                return $.ajax2({  data: { SiteServicesSite : $(this).attr('id') },
                   loading: "#tab-dashboard-site-services-loading",
                   errorTarget: ".site-services-errors",                                                          
                   url:"{url_to('site_services_ajax',['action'=>'ViewSite'])}", 
                     target: "#actions-site-services"
                });
    
        });
        
        $("#SiteServices-Import").click(function(){               
                return $.ajax2({  
                   loading: "#tab-dashboard-site-services-loading",
                   errorTarget: ".site-services-errors",                                                          
                   url:"{url_to('site_services_ajax',['action'=>'ImportInformation'])}", 
                     target: "#actions-site-services"
                });
    
        });
        
           $("#SiteServices-Refresh2").click(function(){
                return $.ajax2({ 
                        url:"{url_to('server_services_ajax',['action'=>'Refresh2'])}",
                         loading: "#tab-dashboard-site-services-loading",
                         errorTarget: ".site-services-errors",
                          success: function (resp) {                        
                            $("#message").html(resp.message);
                            if(resp.isFinished!=true)
                            {
                                $("#SiteServices-Refresh2").trigger("click"); 
                            }
                  }  
            });
        });
    </script>
    
    
{component name="/server_archive/javascript"}