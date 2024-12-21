{messages class="errors"}
<h3>{__("new site")|capitalize}</h3>
<div>
    <a href="#" class="btn" id="Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" class="btn" id="Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
<div>
    <div>{$form.site_host->getError()}</div>
    <label>{__("domain")|capitalize}:</label><input type="text" size="48" class="site" name="site_host" value="{$form.site_host|escape}"/>{if $form->site_host->getOption('required')}*{/if}<div></div>  
    <div>&nbsp;{$form.site_db_name->getError()}</div> 
    <label>{__("database")|capitalize}:</label><input type="text" size="48" class="site" name="site_db_name" value="{$form.site_db_name|escape}"/>{if $form->site_db_name->getOption('required')}*{/if}<div></div>   
    <h4>{__("database server")|capitalize}</h4>
    <div>&nbsp;{$form.site_db_host->getError()}</div> 
    <label>{__("host")|capitalize}:</label><input type="text"  size="48" class="site" name="site_db_host" value="{$form.site_db_host|escape}"/>{if $form->site_db_host->getOption('required')}*{/if}<div></div>   
    <div>&nbsp;{$form.site_db_login->getError()}</div> 
    <label>{__("login")|capitalize}:</label><input type="text" size="48" class="site" name="site_db_login" value="{$form.site_db_login|escape}"/>{if $form->site_db_login->getOption('required')}*{/if}<div></div>   
    <div>&nbsp;{$form.site_db_password->getError()}</div> 
    <label>{__("password"|capitalize)}:</label><input type="text" size="48" class="site" name="site_db_password" value="{$form.site_db_password|escape}"/>{if $form->site_db_password->getOption('required')}*{/if}<div></div>   
    <div>&nbsp;{$form.site_admin_theme->getError()}</div> 
    <label>{__("admin theme")|capitalize}:</label>{html_options class="site" name="site_admin_theme" options=$form->site_admin_theme->getOption('choices') selected=$form.site_admin_theme|escape}<br/>
    <div>&nbsp;{$form.site_admin_theme_base->getError()}</div> 
    <label>{__("admin theme base")}:</label>{html_options class="site" name="site_admin_theme_base" options=$form->site_admin_theme_base->getOption('choices') selected=$form.site_admin_theme_base}<br/>
    <div>&nbsp;{$form.site_frontend_theme->getError()}</div> 
    <label>{__("frontend theme")|capitalize}:</label>{html_options class="site" name="site_frontend_theme" options=$form->site_frontend_theme->getOption('choices') selected=$form.site_frontend_theme|escape}<br/>
    <div>&nbsp;{$form.site_frontend_theme->getError()}</div> 
    <label>{__("frontend theme base")}:</label>{html_options class="site" name="site_frontend_theme_base" options=$form->site_frontend_theme_base->getOption('choices') selected=$form.site_frontend_theme_base}<br/>
    <label>{__("type")|capitalize}:</label>{html_options_format class="site" name="site_type" options=$form->site_type->getOption('choices') selected=$form.site_type|escape format='__'}<br/>
  
</div>
<script type="text/javascript">
         
        $('#Save').click(function(){
            var params={ 
                         Site : {
                                   token :'{$form->getCSRFToken()}'
                                }
                       };
            
            $("input.site, select.site").each(function() {  params.Site[this.name]=this.value; });  
           // alert("params="+params.toSource()); return ;
            return $.ajax2({ data: params,url: '{url_to('site_ajax',['action'=>'NewSite'])}',target: "#tab-Dashboard-Site" }); 
        });
        
        $(".site").click(function () { $("#Save").show(); });
        
        $('#Cancel').click(function(){
              return $.ajax2({ url: '{url_to('site_ajax',['action'=>'ListPartial'])}',target: "#tab-Dashboard-Site" }); 
        });

</script>




    