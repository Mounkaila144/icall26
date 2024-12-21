<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="{$_request->getCountry()}" xml:lang="{$_request->getCountry()}">
    <head>{header}    
    </head>
    <body>
        <div id="body">
            <div id="banner">{banner class="banner"}</div>
            <div id="top">{reference name="top"}</div>   
            <div style="height: 15px; width: 15px"><img id="loading" style="display:none;" src="{url('/icons/loader.gif','picture')}" alt="loader"/></div>
           {component name="/dashboard/sublink"} 
            <div id="middle">
                {include file="./themes_ajaxList.tpl"}
                
              
            </div>
            <div id="bottom">{reference name="bottom"}</div> 
        </div>
    </body>
</html>