<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="{$_request->getCountry()}" xml:lang="{$_request->getCountry()}">
    <head>{header}</head>
    <body>
        <div id="body">
            <div id="middle">
                <h3>{__("login (default)")|capitalize}</h3>
            </div>
            <div id="bottom">
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function()
            {
                   $(".enter").click(function() {   
                       $('#f_authent').submit(); 
                   });
                   $(document).keypress(function(event) {
                        if (event.keyCode==13)
                              $('#f_authent').submit();
                   });
            });
        </script>
    </body>
</html>

