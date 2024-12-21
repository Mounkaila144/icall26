{messages class="tabs-site-services-errors"}
<nav id="services_actions" class="clearfix service_nav">
			<div id="left_but"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
				<div class="base_element">
					<div class="internal_element">
                                             {foreach $tabs->getComponents() as $name=>$tab}   
                                                 {component name=$tab.component}
                                              {/foreach}												
					</div>
				</div>
			<div id="right_but"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
</nav>
<script type="text/javascript">
    
            $('#services_actions').data('place',0);
           /* $(window).resize(function(){
                    $('.base_element').width($(window).width()-100);
                    $('.base_element').scrollLeft(100*($('#services_actions').data('place')));
            }).trigger('resize');*/
    
            $('#left_but').click(function(){
                    $('#services_actions').data('place',($('#services_actions').data('place')==0)?$('.serviceSites-Action').length-1:$('#services_actions').data('place')-1) ;
                    $('.base_element').animate({ scrollLeft:((100)*($('#services_actions').data('place')))+'px' }, 300);
            });
            
            $('#right_but').click(function(){
                    $('#services_actions').data('place',($('#services_actions').data('place')==$('.serviceSites-Action').length-1)?0:$('#services_actions').data('place')+1) ;
                    $('.base_element').animate({ scrollLeft:((100)*($('#services_actions').data('place')))+'px' }, 300);
            });
            
            
    {*  $(".ServiceSiteActions").click(function () { 
                    var url="";
                    $(".ServiceSiteActions").removeClass('Selected');
                    $(this).addClass('Selected');                  
                    if ($(this).attr('data-forced'))
                    {                        
                        return $.ajax2({                                     
                                   url: $(this).attr('data-url') ,                             
                                   target : "#actions-site-services",
                                   errorTarget: ".tabs-site-services-errors",
                                   loading: "#tab-dashboard-site-services-loading"                             
                                });  
                    }
                    if ($("#actions-site-services").data('mode')=='Servers')
                    {                        
                        var params = { SiteServices : { servers: $("#ServerServices").data('selected'), token: '{mfForm::getToken('SiteServiceServersForm')}' } };                                              
                        url= $(this).attr('data-url');
                    }
                    else
                    {                                    
                        var params = {  SiteServices : { sites : $("#SitesList").data('selected') , token: '{mfForm::getToken('SiteServiceSitesForm')}' } };                                                                   
                        url= $(this).attr('data-url-sites');
                    }
                    return $.ajax2({  
                                   data : params,
                                   url: url ,                             
                                   target : "#actions-site-services",
                                   errorTarget: ".tabs-site-services-errors",
                                   loading: "#tab-dashboard-site-services-loading"                             
                                }); 
            }); *}
                
            $(".ServiceSiteActions").click(function () {             
                    $(".ServiceSiteActions").removeClass('Selected');
                    $(this).addClass('Selected');                                      
            });
</script>
