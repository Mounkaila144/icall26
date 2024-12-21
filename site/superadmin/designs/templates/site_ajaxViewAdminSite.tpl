{messages class="errors"}
<h3>{__("edit site")|capitalize}</h3>
<div>
    <a href="#" class="btn" id="Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    {if $site->isSubDomain()}
        <a id="CreateRemoteSubDomain" class="btn" href="#"><img  src="{url('/icons/subdomain16x16.png','picture')}" alt="{__('sub domain')}"/>{__('sub domain')|capitalize}</a>
    {/if}
    <a href="#" class="btn" id="List"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
{if $site->isLoaded()}
<div>
    <div><label>{__("domain")}:</label><input style="background-color: #CCCCCC;" size="48" type="text" name="site_host" value="{$site->get('site_host')|escape}" readonly="readonly"/></div>
    <div><label>{__("database")}:</label><input style="background-color: #CCCCCC;" size="48" type="text" name="site_db_name" value="{$site->get('site_db_name')|escape}" readonly="readonly"/></div>
    <h4>{__("database server")|capitalize}</h4>
    <div>&nbsp;{$form.site_db_host->getError()}</div> 
    <label>{__("host")}:</label><input type="text" class="site" size="48" name="site_db_host" value="{$site->get('site_db_host')|escape}"/>{if $form->getValidator('site_db_host')->getOption('required')}*{/if}<div></div>   
    <div>&nbsp;{$form.site_db_login->getError()}</div> 
    <label>{__("login")}:</label><input type="text" class="site" size="48" name="site_db_login" value="{$site->get('site_db_login')|escape}"/>{if $form->getValidator('site_db_login')->getOption('required')}*{/if}<div></div>   
    <div>&nbsp;{$form.site_db_password->getError()}</div> 
    <label>{__("password")}:</label><input type="text" class="site" size="48" name="site_db_password" value="{$site->get('site_db_password')|escape}"/>{if $form->getValidator('site_db_password')->getOption('required')}*{/if}<div></div>    
    <div>&nbsp;{$form.site_admin_theme->getError()}</div> 
    <label>{__("admin theme")}:</label>{html_options class="site" name="site_admin_theme" options=$form->site_admin_theme->getOption('choices') selected=$site->get('site_admin_theme')}<br/>
    <div>&nbsp;{$form.site_admin_theme_base->getError()}</div> 
    <label>{__("Admin theme base")}:</label>{html_options class="site" name="site_admin_theme_base" options=$form->site_admin_theme_base->getOption('choices') selected=$site->get('site_admin_theme_base')}<br/>
    <div>&nbsp;{$form.site_frontend_theme->getError()}</div> 
    <label>{__("frontend theme")}:</label>{html_options class="site" name="site_frontend_theme" options=$form->site_frontend_theme->getOption('choices') selected=$site->get('site_frontend_theme')}<br/>    
    <div>&nbsp;{$form.site_frontend_theme->getError()}</div> 
    <label>{__("frontend theme base")}:</label>{html_options class="site" name="site_frontend_theme_base" options=$form->site_frontend_theme_base->getOption('choices') selected=$site->get('site_frontend_theme_base')}<br/>
    <label>{__("type")}:</label>{html_options_format class="site" name="site_type" options=$form->site_type->getOption('choices') selected=$site->get('site_type') format='__'}<br/>  
</div>
{else}
    {__('Site is invalid.')}
{/if}    
<script type="text/javascript">
        
        $(".site").click(function () { $("#Save").show(); });
        
        $('#List').click(function(){
           return $.ajax2({ url: '{url_to("site_ajax",["action"=>"ListPartial"])}', 
                            target: "#tab-Dashboard-Site" });  
        });
        
        $('#Save').click(function(){
            var params={ 
                          Site : { 
                                     site_id: '{$site->get("site_id")}',
                                     token :'{$form->getCSRFToken()}'
                                 }
                       };
            $("input.site, select.site").each(function(id) { params.Site[this.name]=this.value; });
            return $.ajax2({ data : params, 
                             url:'{url_to("site_ajax",["action"=>"SaveAdminSite"])}', 
                             target: "#tab-Dashboard-Site" }); 
        });
        
        $('#CreateRemoteSubDomain').click(function(){
            var params={  Site : '{$site->get("site_id")}' };
            $("input.site, select.site").each(function() { params.Site[this.name]=this.value; });
            return $.ajax2({ data : params, 
                             url:'{url_to("site_ajax",['action'=>'CreateFreeSubDomain'])}'                            
                         }); 
        });
</script>



