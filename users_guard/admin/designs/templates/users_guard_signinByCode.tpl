<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  lang="{$_request->getCountry()}">
    <head>{header} 
    {*    <link rel="stylesheet" type="text/css" href="http://www.ewebsolutionskech-dev.com/admin/web/css/main.css"/>
   <!--  <script type="text/javascript" src="http://www.ewebsolutionskech-dev.com/admin/web/js/jquery-1.7.min.js"></script> -->  *}
    <meta name="viewport" content=" user-scalable=yes,initial-scale=1.0"/>
     <link rel="stylesheet" type="text/css" href="/web/css/font-awesome-4.1.0/css/font-awesome.min.css"/>
     <link rel="stylesheet" type="text/css" href="/admin/web/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="/admin/web/css/bootstrap-theme.min.css"/>
<script src="/admin/web/js/bootstrap.min.js" type="text/javascript"></script>
     <style>
         .focusStyle{
         border: 2px solid #79BB35;
         }
     </style>
    </head>  
   <body class="loginBody">
     <div class="container">    
      <div id="loginbox" style="margin-top:76px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
        <div class="panel panel-info" >   
        <div id="body" class="body-login">
             
            <div id="middle" class="middle-login">
                <div class="login-p">
                <div class="imgLogo">
                   <img style="padding: 8px 138px;" src="{url('/icons/logo.png','picture')}"/>
                </div>
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
                            <td class="label3">
                                <label>{__("Username")}</label>
                            </td>
                            <td>
                                <input type="text" id="f_login" class="focusInputU form-control" name="signin[username]"   placeholder="Identifiant"/>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>{$form->getErrorSchema()->getError('password')}</td>
                        </tr>
                        <tr>
                            <td class="label3">
                                <label>{__("Password")}</label>
                            </td>
                            <td>
                                <input type="password" class="focusInputU form-control" id="f_password" name="signin[password]" placeholder="Mot de passe"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="label3">{__("Remember me")}</label>
                            </td>
                            <td>
                                <input type="checkbox" class="check1"  name="signin[remember]" {if $smarty.post.signin.remember}checked="checked"{/if}/>
                            </td>
                        </tr>
                        <tr>
                            <td class="btn-login">
                               {*  <input type="submit" style="font-size: 6pt" value="."/>  *}
                        <center> <a href="#" class="enter">{__('Se connecter')}<i class="fa fa-chevron-right" style="margin-left: 10px;"></i>{*<img src="{url('/icons/login.gif','picture')}" alt="login"/>*}</a> </center>
                           </td>
                        </tr>
                    </table>
                     {component name="/system_versions/DisplayLastVersion"}
                    <input type="hidden" class="site" name="signin[token]"  value="{$form->getCSRFToken()}" />  
                    {component name="/site/copyrights"}
                </form>
                </div>
            </div>
            <div id="bottom">
            </div>
        </div>
        </div>
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
