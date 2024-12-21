<!DOCTYPE html>
<html  lang="{$_request->getCountry()}">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>{header}
     <link rel="stylesheet" type="text/css" href="/web/css/font-awesome-4.1.0/css/font-awesome.min.css"/>
    </head>  
    <body>
        <div id="body" class="body-login">
            <div id="middle" class="middle-login">
                <div class="login-p">
                {messages class="errors"}
                <h3>{__("Authentification validation")}</h3>                
                <form  class="login-form"name="f_authent" id="f_authent" action="{url_to('users_guard_security_code',['action'=>'login'])}" method="POST">
                    <table cellpadding="0" cellspacing="0">                       
                        <tr>
                            <td class="label">
                                <label>{__("Code")}</label>
                            </td>
                            <td>
                                <input type="code" id="f_password" name="signin[code]"/>
                            </td>
                        </tr>                      
                        <tr>
                            <td class="btn-login">
                        <center> <a href="#" class="enter">{__('Send')}<i class="fa fa-chevron-right" style="margin-left: 10px;"></i></a> </center>
                           <td>
                        </tr>
                    </table>                    
                    <input type="hidden" class="site" name="signin[token]"  value="{mfForm::getToken('UserSecurityForm')}" />  
                </form>
                </div>
            </div>
            <div id="bottom">
            </div>
        </div>
        <script type="text/javascript">
            // ID=login[d56b699830e77ba53855679cb1d252da] {* mandatory md5(login) for iframe upload files not remove *}
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

