{messages class="site-services-errors"}
    <h3>{__('Servers')}</h3>    
    <div>
      <a href="#" class="btn" id="SiteServicesServer-New" title="{__('New server')}" >
           <i class="fa fa-plus" style="margin-right: 10px"></i>{__('New server')}</a>  
      <a href="#" class="btn" id="SiteServicesServer-Cancel" title="{__('Cancel')}" >
           <i class="fa fa-arrow-left" style="margin-right: 10px"></i>{__('Cancel')}</a>  
    </div>        
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="SiteServicesServer"}
    <button class="btn-table" id="SiteServicesServer-filter">{__("Filter")}</button>   
    <button class="btn-table" id="SiteServicesServer-init">{__("Init")}</button> 
    <div class="containerDivResp">
    <table class="tabl-list" id="ServerServices" cellpadding="0" cellspacing="0">    
        <tr class="list-header">
            <th>#</th>                  
             <th></th>    
            <th>
                <span>{__('Host')}</span>
                <div>
                    <a href="#" class="SiteServicesServer-order{$formFilter.order.host->getValueExist('asc','_active')}" id="asc" name="host"><img  src='{url("/icons/sort_asc`$formFilter.order.host->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                    <a href="#" class="SiteServicesServer-order{$formFilter.order.host->getValueExist('desc','_active')}" id="desc" name="host"><img  src='{url("/icons/sort_desc`$formFilter.order.host->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div>
            </th> 
              <th>
                <span>{__('Name')}</span>
                 <div>
                    <a href="#" class="SiteServicesServer-order{$formFilter.order.name->getValueExist('asc','_active')}" id="asc" name="name"><img  src='{url("/icons/sort_asc`$formFilter.order.name->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                    <a href="#" class="SiteServicesServer-order{$formFilter.order.name->getValueExist('desc','_active')}" id="desc" name="name"><img  src='{url("/icons/sort_desc`$formFilter.order.name->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div>
            </th> 
            <th>
                <span>{__('IP')}</span>
                 <div>
                    <a href="#" class="SiteServicesServer-order{$formFilter.order.ip->getValueExist('asc','_active')}" id="asc" name="ip"><img  src='{url("/icons/sort_asc`$formFilter.order.ip->getValueExist("asc","_h")`.gif","picture")}' alt="{__('order_asc')}"/></a>
                    <a href="#" class="SiteServicesServer-order{$formFilter.order.ip->getValueExist('desc','_active')}" id="desc" name="ip"><img  src='{url("/icons/sort_desc`$formFilter.order.ip->getValueExist("desc","_h")`.gif","picture")}' alt="{__('order_desc')}"/></a>
                </div>
            </th>       
              <th>
                <span>{__('Actions')}</span>    
            </th>      
        </tr>
           <tr>
            <td>{* # *}
            </td>
            <td>
                <input id="SiteServicesServer-All" type="checkbox"/>
            </td>          
              <td>{* date *}
                  <input class="SiteServicesServer-search" type="text" size="10" name="host" value="{$formFilter.search.host}"> 
            </td> 
            <td> 
                  <input class="SiteServicesServer-search" type="text" size="10" name="name" value="{$formFilter.search.name}"> 
            </td>
            <td>
                  <input class="SiteServicesServer-search" type="text" size="10" name="ip" value="{$formFilter.search.ip}">                
            </td>
            <td></td>

        </tr>
        {foreach $pager as $item}
        <tr class="SiteServicesServer-list list" id="SiteServicesServer-{$item->get('id')}"> 
                <td class="SiteServicesServer-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>                       
                <td>
                    <input class="SiteServicesServer-selection" type="checkbox" id="{$item->get('id')}" name="{$item->get('host')}" {if $formFilter->getSelected()->in($item->get('id'))}checked=""}{/if}/>
                </td>
                <td>                
                   {$item->get('host')}
                </td>                       
                <td>
                    {$item->get('name')}
                </td>  
                <td>
                    {$item->get('ip')}     
                </td> 
                <td>
                     <a href="#" title="{__('Ping')}" class="SiteServicesServer-Ping" id="{$item->get('id')}">
                         <i style="font-size: 16px;" class="fa fa-share-alt"/>
                    </a> 
                    <a href="#" title="{__('Refresh')}" class="SiteServicesServer-Refresh" id="{$item->get('id')}">
                         <i style="font-size: 16px;" class="fa fa-refresh"/>
                    </a> 
                    <a href="#" title="{__('Explore')}" class="SiteServicesServer-Explore" id="{$item->get('id')}">
                         <i style="font-size: 16px;" class="fa fa-eye"/>
                    </a> 
                    <a href="#" title="{__('Edit')}" class="SiteServicesServer-View" id="{$item->get('id')}">
                        <i style="font-size: 16px;" class="fa fa-edit"/>
                    </a>  
                    <a href="#" title="{__('Delete')}" class="SiteServicesServer-Delete" id="{$item->get('id')}" name="{$item->get('name')}" >
                       <i style="font-size: 16px;" class="fa fa-trash"/></a>                              
                </td>

        </tr>    
        {/foreach}  
    </table> 
    </div>
    {if !$pager->hasItems()}
         <span>{__('No server')}</span>   
    {/if}
    {include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="SiteServicesServer"}

        
    <div id="SiteServicesServer-Dialog" title="{__('Services')}"></div>
    
    <script type="text/javascript">
        
        $("#actions-site-services").data('mode','Servers');
        
        $("#actions-site-services").data('servers_selected',{$formFilter->getSelected()->toJson()});
        
        $(".SiteServicesServer-selection").click(function () {               
              if ($(this).prop('checked'))                                                  
                  $("#actions-site-services").data("servers_selected").push($(this).attr("id"));                                 
              else              
                  $("#actions-site-services").data("servers_selected").splice($.inArray($(this).attr("id"),$("#actions-site-services").data("servers_selected")),1);                                              
        });
        
        function getSiteServicesServerFilterParameters()
        {
            var params={   
                           filter: {  order : { }, 
                                    search : { },
                                    equal: {  },    
                                selected: $("#actions-site-services").data("servers_selected"),  
                                nbitemsbypage: $("[name=SiteServicesServer-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".SiteServicesServer-order_active").attr("name"))
                 params.filter.order[$(".SiteServicesServer-order_active").attr("name")] =$(".SiteServicesServer-order_active").attr("id");   
            $(".SiteServicesServer-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });                                            
            $(".SiteServicesServer-equal option:selected").each(function() { params.filter.equal[$(this).parent().attr('name')] =$(this).val(); }); 
            return params;                  
        }
        
        function updateSiteServicesServerFilter()
        {          
           return $.ajax2({ data: getSiteServicesServerFilterParameters(), 
                            url:"{url_to('site_services_ajax',['action'=>'ListPartialSiteServicesServers'])}" , 
                            loading: "#tab-dashboard-site-services-loading",
                            errorTarget: ".site-services-errors",
                            target: "#actions-site-services"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".SiteServicesServer-pager .SiteServicesServer-active").html()?parseInt($(".SiteServicesServer-pager .SiteServicesServer-active").html()):1;
           records_by_page=$("[name=SiteServicesServer-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".SiteServicesServer-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#SiteServicesServer-nb_results").html())-n;
           $("#SiteServicesServer-nb_results").html((nb_results>1?nb_results+" {__('results')}":"{__('one result')}"));
           $("#SiteServicesServer-end_result").html($(".SiteServicesServer-count:last").html());
        }
        
        {* =====================  P A G E R  A C T I O N S =============================== *}  
      
          $("#SiteServicesServer-init").click(function() {                    
               return $.ajax2({ 
                            data: { filter : $.extend({ selected: $("#actions-site-services").data("servers_selected"),token:'{$formFilter->getCSRFToken()}' },{$formFilter->getDefaultValues()->toJson()}) },
                            url:"{url_to('site_services_ajax',['action'=>'ListPartialSiteServicesServers'])}",
                            loading: "#tab-dashboard-site-services-loading",
                            errorTarget: ".site-services-errors",
                            target: "#actions-site-services"
                       }); 
           }); 
           
            $('.SiteServicesServer-order').click(function() {
                $(".SiteServicesServer-order_active").attr('class','SiteServicesServer-order');
                $(this).attr('class','SiteServicesServer-order_active');
                return updateSiteServicesServerFilter();
           });
           
            $(".SiteServicesServer-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteServicesServerFilter();
            });
            
            $(".SiteServicesServer-equal[name=status],.SiteServicesServer-equal[name=category_id]").change(function() { return updateSiteServicesServerFilter(); }); 
             
          $("#SiteServicesServer-filter").click(function() { return updateSiteServicesServerFilter(); }); 
          
          $("[name=SiteServicesServer-nbitemsbypage]").change(function() { return updateSiteServicesServerFilter(); }); 
                  
           
           $(".SiteServicesServer-pager").click(function () {                       
                return $.ajax2({ data: getSiteServicesServerFilterParameters(), 
                                 url:"{url_to('site_services_ajax',['action'=>'ListPartialSiteServicesServers'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                loading: "#tab-dashboard-site-services-loading",
                                errorTarget: ".site-services-errors",
                                target: "#actions-site-services"
                });
        });
        
        
        {* ===========================  A C T I O N S =============================== *} 
        

        $("#SiteServicesServer-New").click(function(){         
            return $.ajax2({                              
               url:"{url_to('site_services_ajax',['action'=>'NewSiteServicesServer'])}",
               loading: "#tab-dashboard-site-services-loading",
               errorTarget: ".site-services-errors",
               target: "#actions-site-services"
            });
        
        });
        
        
        $("#SiteServicesServer-Cancel").click(function(){         
            return $.ajax2({                              
               url:"{url_to('site_services_ajax',['action'=>'ListPartialSiteServices'])}",
               loading: "#tab-dashboard-site-services-loading",
               errorTarget: ".site-services-errors",
              target: "#actions-site-services"
            });
        
        });
        
        $('.SiteServicesServer-View').click(function(){
            
            return $.ajax2({  
               data:{ SiteServicesServer: $(this).attr('id')},
               url:"{url_to('site_services_ajax',['action'=>'ViewSiteServicesServer'])}",
               loading: "#tab-dashboard-site-services-loading",
               errorTarget: ".site-services-errors",
              target: "#actions-site-services"
            });
  
        });
        
        
        $('.SiteServicesServer-Delete').click(function(){
        if (!confirm('{__("Server \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
            return $.ajax2({  
               data:{ SiteServicesServer: $(this).attr('id')},
               url:"{url_to('site_services_ajax',['action'=>'DeleteSiteServicesServer'])}",
               loading: "#tab-dashboard-site-loading",
               errorTarget: ".site-services-errors",
               success: function (resp)
                {
                  if (resp.action=='DeleteSiteServicesServer')
                  {                                  
                     $("#SiteServicesServer-"+resp.id).remove();    
                  if ($(".SiteServicesServer-list").length==0)
                  {
                       $("#SiteServicesServer-list").after("{__("No server")}")
                  } 
                  updateSitePager(1);
                  }    
                }
            });
        
         });
         
         
          $('.SiteServicesServer-Ping').click(function(){
            
            return $.ajax2({  
               data:{ Server: $(this).attr('id')},
               url:"{url_to('server_services_ajax',['action'=>'PingServer'])}",
               loading: "#tab-dashboard-site-services-loading",
               errorTarget: ".site-services-errors"
               
            });
  
        });
        
        $('.SiteServicesServer-Explore').click(function(){
            $("#SiteServicesServer-Dialog").dialog( {  autoOpen: false,  height: 'auto', width:'30%',  modal: true });
            return $.ajax2({  
               data:{ SiteServicesServer: $(this).attr('id')},
               url:"{url_to('server_services_ajax',['action'=>'ExploreSiteServicesServer'])}",
               loading: "#tab-dashboard-site-services-loading",
               errorTarget: ".site-services-errors",
               target: "#SiteServicesServer-Dialog",
               success: function ()
                    {
                        $("#SiteServicesServer-Dialog").dialog('open');
                    }
            });
  
        }); 
        
        
         $('.SiteServicesServer-Refresh').click(function(){
            
            return $.ajax2({  
               data:{ Server: $(this).attr('id')},
               url:"{url_to('server_services_ajax',['action'=>'RefreshServer'])}",
               loading: "#tab-dashboard-site-services-loading",
               errorTarget: ".site-services-errors"
               
            });
  
        });
    </script>