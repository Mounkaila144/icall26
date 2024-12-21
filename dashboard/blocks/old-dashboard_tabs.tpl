<div id="dashboard-tabs" style="min-height: 600px">    
     <ul id="dashboard-tabs-ctn">
        {foreach $tabs->getSortedTabs() as $name=>$tab} 
            {if $user->hasCredential($tab->get('credentials'))}    
            <li class="site" id="site-{$name}" aria-controls='site-panel-{$name}' name="site-panel-{$name}">            
                <a href="{if $tab.route}{$tab->getRoute()}{else}#tab-{$name}{/if}" id="site-panel-{$name}-link" title="{__($tab.title)}" name="tab-{$name}" class="tab-site tabSiteWidth">         
                     {*if $tab.icon}<i class="fa fa-{$tab.icon}"></i>
                     {elseif $tab.picture}<img height="32" width="32" src="{url($tab.picture,'web')}" alt="{__($tab.title)|capitalize}"/>
                     {/if*}
                     <span class="name-tabs">{__($tab.title)|upper}</span>    

                     <img id="tab-site-{$name}-loading" class="loading" style="display:none;" style="z-index: 500" height="16px" width="16px" src="{url('/icons/loader.gif','picture')}" alt="loader"/>
                </a>              
                <span style="display:none;" id="item_tab{$name|upper}">{__($tab.help)|default:'&nbsp;'}</span>    
            </li>
           {/if}  
        {/foreach}
        <div id="myProfile"> 
           <div class="topIconsContainer">
               {*<div class="topIcon"><li class="user-function">{component name="/users_guard/connectedAsUser"}</li></div>*}
               {component name="/users_tutorials/info"} 
               {component name="/users_guard/ReConnectedAsUser"} 
               {component name="/users_guard/connectedAsActiveUserByFunction"}
               {component name="/users/functions"}
               {component name="/system_versions/versionsLink"}
               {component name="/system_debug/Link"}
               {component name="/server_hotline/info"}
               {component name="/users_messages/MessagesLink"}
               {component name="/users_guard/user"}
               <div class="topIcon"><i class="liDisplayTabs fa fa-bars fa-1x"></i></div>
           </div>
        </div>   
     </ul>
   {foreach $tabs->getComponents() as $name=>$tab}     
        {if $user->hasCredential($tab->get('credentials'))}   
            {if !$tab.route}        
                <div id="tab-{$name}" name="{if $tab.route}{$tab->getRoute()}{/if}">
                   {component name=$tab.component}  
                </div>   
            {/if} 
        {/if}
    {/foreach} 
</div>

<script type="text/javascript">
    
     $("#dashboard-tabs").data('ajax_off',false);
     // Bind to tabs event                   
     $( "#dashboard-tabs" ).on( "tabsbeforeload", function( event, ui ) {  
             if ($("#"+ui.tab.attr('name')+"-static").length==0)
             {    
                  //   alert('ui='+ui.tab.attr('name'));
                $("#"+ui.tab.attr('name')).append("<div style='min-height:1100px;padding=0px !important;' id='"+ui.tab.attr('name')+"-static' class='tab-sites-test' style=''>"+
                                                      "<ul id='tab-site-static-"+ui.tab.attr('name')+"-ctn' class'tab-content-item'>"+
                                                        "<li id='base'>"+
                                                            "<a href='#tab-"+ui.tab.attr('name')+"-base'>"+
                                                                "<img title='{__('tab')}' height='16px' width='16px' src='{url('/icons/info-btn.jpg','picture')}'/>"+
                                                            "</a>"+
                                                        "</li>"+
                                                      "</ul>"+
                                                      "<div id='tab-"+ui.tab.attr('name')+"-base'>"+
                                                      "</div>"+                                                    
                                                  "</div>"+
                                                  "" //<div id='"+ui.tab.attr('name')+"-dynamic'></div>"
                                                );
                $("#"+ui.tab.attr('name')+"-static").tabs();
             }      
             $("#"+ui.tab.attr('name')+"-static").triggerHandler('tabupdate',{ tab: "#"+ui.tab.attr('name')+"-static" });
             
             if ($("#dashboard-tabs").data('ajax_off'))
             {
                 $("#dashboard-tabs").data('ajax_off',false);
                 return false;
             }  
             $(document).off('click','.resteViewClose');
             $('.resteViewClose').remove(); 
             return $.ajax2({  url: $("#"+ui.tab.attr('name')+"-link").attr('href') ,                             
                               target : "#tab-"+ui.tab.attr('name')+"-base",
                               loading: "#tab-"+ui.tab.attr('id')+"-loading"                             
                            });  
     });
     
     $("#dashboard-tabs").tabs();                       
       
     function openTab(tab,ajax_off)
     {            
         $("#dashboard-tabs").data('ajax_off',ajax_off);
         $("#dashboard-tabs").tabs({ active: $("#dashboard-tabs li#site-dashboard-"+tab).index() });  
     }
     
     $("#dashboard-tabs").tabs().delegate( "span.ui-icon-close.close-site", "click", function() {          
                var tabName=$( this ).closest( "li" ).attr('name');               
                $( this ).closest( "li" ).remove().attr( "aria-controls" );    
                $("#"+$( this ).closest( "li" ).attr( "aria-controls" )).remove(); // remove panel
                $("#"+tabName).tabs("refresh");        
     });
     
        function isTabFieldExistAndOpen(tab,id)
        {                      
          if ($("#tab-site-field-"+tab+"-"+id).length > 0)
          {    
             $("#site-panel-dashboard-site-"+tab+"-static").tabs({ active : $("#tab-site-static-site-dashboard-customers-meeting-ctn li#tab-site-field-"+tab+"-"+id).index() });
             return true;
          }
          return false;
        }
     
        function closeTabField(tab,id)
        {          
            $("#tab-site-field-"+tab+"-"+id).remove().attr( "aria-controls" );
            $("#tab-site-panel-dashboard-"+tab+"-"+id).remove();           
            $("#site-panel-dashboard-"+tab+"-static").tabs("refresh");            
        }
        
        function hideTabField(tab,id)
        {          
            $("#tab-site-panel-dashboard-"+tab+"-"+id).hide();           
            $("#site-panel-dashboard-"+tab+"-static").tabs("refresh");
        }
        
        function isExistTabField(tab,id)
        {                      
          return  ($("#tab-site-field-"+tab+"-"+id).length > 0);         
        }
        
        function openTabField(tab,id)
        {
    //        $("#site-panel-dashboard-site-"+tab+"-static").tabs({ active : $("#tab-site-static-site-panel-dashboard-customers-meeting-ctn li#tab-site-field-"+tab+"-"+id).index() }); 
            $("#site-panel-dashboard-"+tab+"-static").tabs({ active: $('.ui-tabs-nav li#tab-site-field-'+tab+'-'+id).index() }); //Will activate already existing tab
        }
        

function closeAndOpenTabField(tab,id,title)
{
   if (isExistTabField(tab,id))
      closeTabField(tab,id);
    addTabField(tab,id,title);
}
         function addTabField(tab,id,title)
         {
            // alert("site="+site+" tab="+tab);
             if (isTabFieldExistAndOpen(tab,id))
                return true;      
             name="tab-site-panel-dashboard-"+tab+"-"+id; 
             href="#"+name; 
             tab_id="site-panel-dashboard-"+tab+"-static";
             tabTemplate = "<li id='tab-site-field-"+tab+"-"+id+"' name='"+tab_id+"'>"+
                            "<span class='ui-icon ui-icon-close close-site' title='{__('Close')}' role='presentation'>{__('Remove')}</span>"+
                            "<a href='"+href+"'>"+
                               // "<img width='32' height='32' alt='Sites' src='{url('/icons/website.png','picture')}'>"+
                                "<span>"+title+"</span>"+
                           "</a>"+                            
                      "</li>";  
              panelTemplate="<div id='"+name+"'>"+                            
                            "</div>";
             
              $("#tab-site-static-site-panel-dashboard-"+tab+"-ctn").append( tabTemplate ); 
              
              $("#tab-site-panel-dashboard-"+tab+"-base").after( panelTemplate ); 
              $("#site-panel-dashboard-"+tab+"-static").tabs( "refresh" ); 
              name="tab-site-field-"+tab+"-"+id;
              $("#site-panel-dashboard-"+tab+"-static").tabs({ active: $('.ui-tabs-nav li#tab-site-field-'+tab+'-'+id).index() }); //Will activate already existing tab
              //alert("idx="+$('.ui-tabs-nav li#'+name).index());
              return false;
         }
         
         function isActiveTab(tab)
         {
            {* var active_tab=$("#dashboard-tabs" ).tabs( "option", "active" );             
            // alert('active='+active_tab+' ='+$("#dashboard-tabs li#site-dashboard-"+tab).index());    *}         
             return ($("#dashboard-tabs" ).tabs( "option", "active" )==$("#dashboard-tabs li#site-dashboard-"+tab).index());
         }
</script>  