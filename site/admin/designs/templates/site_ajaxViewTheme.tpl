{messages class="errors"}
<h3>{__("Theme site")}</h3>
 <div>
        <a id="Save" href="#" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')|capitalize}</a>
        <a href="#" id="Cancel"><img src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>
            {__('cancel')|capitalize}
        </a>
 </div>
{if $site}
    <table>       
        {foreach $form->theme->getOption('choices') as $theme}
            {if $theme@index % 2 ==0}<tr>{/if}
                <td class="Themes {if $theme->get('name')==$site->get('site_frontend_theme')}selected{/if}" name="{$theme->get('name')}">
                      {if $theme->get('preview')}<img  height="100" width="100" src="{$theme->getPreview()->getURL()}" alt="{__($theme->getName())}"/>{/if}
                      <div>{__($theme->getName())}</div>
                </td>
            {if $theme@index % 2 == 2}</tr>{/if}
        {/foreach}    
    </table>
{else}
    <span>{__('site is invalid.')}</span>
{/if}    
<script type="text/javascript">        
     
    
    $('#Cancel').click(function () {
         return $.ajax2({ url: "{url_to('site_admin_ajax',['action'=>'List'])}", target: "#middle"});
    });
   
    {if $site}
    $('#Save').click(function () {
         var  params= { Site: {    site_id : "{$site->get('site_id')}",
                                    theme : $(".Themes.selected").attr('name'),
                                    token :'{mfForm::getToken('SiteThemeForm')}' } };   
             
         return $.ajax2({ data : params,url: "{url_to('site_admin_ajax',['action'=>'SaveTheme'])}",target: "#middle"}); 
    });
    {/if}

    $(".Themes").click(function () {      
            $(".Themes").removeClass('selected');
            $(this).toggleClass('selected');               
            $("#Save").show();
    });
</script>    