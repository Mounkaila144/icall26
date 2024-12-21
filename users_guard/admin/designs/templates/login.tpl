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
                <h3>{__("login")|capitalize}</h3>
                {if $time_out>0}
                <div>
                    {__("The session has expired")}
                </div>
                {/if}
                <form  class="login-form"name="f_authent" id="f_authent" action="" method="post">
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td></td>
                            <td>{$form->getErrorSchema()->getError('username')}</td>
                        </tr>
                        <tr>
                            <td class="label">
                                <label>{__("Username")}</label>
                            </td>
                            <td>
                                <input type="text" id="f_login" name="signin[username]" />
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>{$form->getErrorSchema()->getError('password')}</td>
                        </tr>
                        <tr>
                            <td class="label">
                                <label>{__("Password")}</label>
                            </td>
                            <td>
                                <input type="password" id="f_password" name="signin[password]"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>{__("Remember me")}</label>
                            </td>
                            <td>
                                <input type="checkbox" name="signin[remember]" {if $smarty.post.signin.remember}checked="checked"{/if}/>
                            </td>
                        </tr>
                        <tr>
                            <td class="btn-login">
                        <center> <a href="#" class="enter">{__('Login')}<i class="fa fa-chevron-right" style="margin-left: 10px;"></i>{*<img src="{url('/icons/login.gif','picture')}" alt="login"/>*}</a> </center>
                           <td>
                        </tr>
                    </table>
                    <input type="hidden" class="site" name="signin[token]"  value="{$form->getCSRFToken()}" />  
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