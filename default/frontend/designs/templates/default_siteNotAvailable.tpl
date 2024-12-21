<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="{$_request->getCountry()}" xml:lang="{$_request->getCountry()}">
    <head>{header}       
    </head>
    <body>         
        {reference name="information"}
        <!-- theme base -->
        <div id="body">
            <div id="middle">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" >
                   {*  <tr>
                       <td align="center"> {if $site_pictures.banner} <img src="{$site_pictures.banner.pic_filename}" alt=""/> {/if} </td>
                    </tr> *}
                    <tr>
                        <td align="center"><img border="0" src="/web/pictures/en_travaux.gif" alt=""/></td>
                    </tr>
                    <tr><td align="center"><br/><br/></td></tr>
                    <tr>
                        <td align="center">
                            <table bgcolor="#009900" cellpadding="1" cellspacing="1" align="center">
                                <tr>
                                    <td align="center" valign="middle"><font color="#FFFFFF">{__("Site is not available")}</font></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table bgcolor="#FFFFFF">
                                            <tr><td align="center">{__("Site is not available")}</td></tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="bottom">
            </div>
        </div>
        <div id="trackings">
            {component name="/tracking/tag" uri="[not_available]"}
            {component name="/tracking_xiti/tag" uri="[not_available]"}
            
            {component name="/google_analytics/tag" uri="[not_available]"}
        </div>        
    </body>
</html>


