{messages class="errors"}
<h3>{__("new site")|capitalize}</h3>
<div>
    <a href="#" class="btn" id="Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" class="btn" id="Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
<div>
    <div>{$form.name->getError()}</div>
    <label>{__("name")|capitalize}:</label><input type="text" size="48" class="site" name="name" value="{$form.name|escape}"/>{if $form->name->getOption('required')}*{/if}<div></div>     
    <div>{$form.site_admin_theme->getError()}</div>
    <label>{__("admin theme")|capitalize}:</label>{html_options class="site" name="site_admin_theme" options=$form->site_admin_theme->getOption('choices') selected=$form.site_admin_theme|escape}<br/>
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
            return $.ajax2({ data: params,
                            url: '{url_to('site_ajax',['action'=>'NewSiteLight'])}',
                            loading: "#tab-dashboard-site-loading",
                            target: "#tab-Dashboard-Site" }); 
        });
        
        $(".site").click(function () { $("#Save").show(); });
        
        $('#Cancel').click(function(){
              return $.ajax2({ url: '{url_to('site_ajax',['action'=>'ListPartial'])}',
                               loading: "#tab-dashboard-site-loading",
                               target: "#tab-Dashboard-Site" }); 
        });

</script>




    