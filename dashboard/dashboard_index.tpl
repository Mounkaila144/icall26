<!DOCTYPE html>
<html lang="{$_request->getCountry()}">
    <head>{header}
    <link rel="stylesheet" type="text/css" href="web/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="web/css/FooTable-2/css/footable.core.css"/>
    <link rel="stylesheet" type="text/css" href="web/css/select2.min.css"/>    
    <script src="web/js/pooper.min.js" type="text/javascript"></script>
    <script src="web/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="web/js/FooTable-2/footable.js" type="text/javascript"></script>
    <script src="web/js/select2.min.js" type="text/javascript"></script>
          
    </head>
    <body> 
        <!-- Theme 13  -->
        <div id="body">            
            <div id="top">{reference name="top"}</div>          
            <div id="middle">              
               {* {component name="/dashboard/menu"}   *}   
                  
              {component name="/dashboard/tabs"}
            </div>
            <div id="bottom">{reference name="bottom"}</div>
        </div>
        {component name="/utils_editors_froala/resources"} 
        {component name="/utils_editors_ckeditor/resources"} 
        {component name="/utils_colorpicker_light/resources"}
        {*component name="/users_chat/chat"*}   
        {component name="/users_webrtc/resources"} 
        {component name="/users_webrtc_text/chatText"}	
        {*component name="/dashboard/notificationsManager"*}
        {* {component name="/customers_meetings/callbacks"} *}
        {*component name="/system_monitor/SendTag"*}
        {component name="/users_guard/activity"}        
        {component name="/users/logoutScheduler"}
        {*component name="/geoportal_maps/resources"*}
        {*component name="/users_messages/resources"*}
        {*component name="/utils_htmlcanvas/resources"*}
        {*component name="/server_messages/resources"*}
        {*component name="/server_messages/scheduler"*}
        {component name="/users_messages/GlobalMessageDisplay"}
        <script type="text/javascript">
            $(document).ready(function()
            {  
                    $(':input').on('focus', function () {
                        $(this).attr('autocomplete', 'off')
                    });

                    $('.liDisplayTabs').click(function (){                
                        $('#dashboard-tabs-ctn').toggleClass('dashboard-tabs-ctn1');
                    });

            });
        </script>        
    </body>
</html>

