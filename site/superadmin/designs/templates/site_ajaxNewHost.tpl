{messages class="errors"}
<h3>{__("new host")|capitalize}</h3>
<div>
    <a href="#" id="Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
<div>
    <div>{$form.site_host->getError()}</div>
    <label>{__("domain")|capitalize}:</label><input type="text" class="site" name="site_host" value="{$host->get('site_host')|escape}"/>{if $form->getValidator('site_host')->getOption('required')}*{/if}
    <div><label>{__("site")|capitalize}:</label>{html_options class="site" name="site_db_name" options=$form->site_db_name->getOption('choices') selected=$host->get('site_db_name')|escape}</div>
    <div><label>{__("admin theme")|capitalize}:</label>{html_options class="site" name="site_admin_theme" options=$form->site_admin_theme->getOption('choices') selected=$host->get('site_admin_theme')|escape}</div> 
    <div><label>{__("frontend theme")|capitalize}:</label>{html_options class="site" name="site_frontend_theme" options=$form->site_frontend_theme->getOption('choices') selected=$host->get('site_frontend_theme')|escape}</div>
    <div><label>{__("type")|capitalize}:</label>{html_options_format class="site" name="site_type" options=$form->site_type->getOption('choices') selected=$host->get('site_type')|escape format='__'}</div>    
</div>
<script type="text/javascript">
        
        $('#Save').click(function(){
            params={ Site : { token :'{$form->getCSRFToken()}' } };
            $("input.site, select.site").each(function() { params.Site[this.name]=this.value; });            
            return $.ajax2({ data: params, 
                           url: '{url_to('site_ajax',['action'=>'NewHost'])}',
                           target: "#tab-Dashboard-Site"
                        }); 
        });
        
        $(".site").click(function () { $("#Save").show(); });
        
        $('#Cancel').click(function(){  return $.ajax2({ url: '{url_to('site_ajax',['action'=>'ListPartial'])}',target: "#tab-Dashboard-Site" }); });
        
</script>




    