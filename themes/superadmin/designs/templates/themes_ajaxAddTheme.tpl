{messages class="errors"}
<h3>{__("Add Themes for frontend")}</h3>
<div>
    <a id="AddSelection" href="#" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')|capitalize}</a>
    <a href="#" id="Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('Cancel')}"/>{__('Cancel')}</a> 
</div>  
<h4>{__('Themes available')}</h4>
<table>
      
{foreach $form->getThemesAdmin() as $theme_admin}
    {if $theme_admin@index % 5 ==0}<tr>{/if}
       <td style="width: 150px;text-align: center;" class="Themes{if in_array($theme_admin->get('name'),$form.selection->getValue())} selected{/if}" id="{$theme_admin->get('name')}">            
            <div>
                <div>
                    {if $theme_admin->get('preview')}<img  height="100" width="100" src="{$theme_admin->getPreview()->getURL()}" alt="{__($theme_admin->getName())}"/>{/if}
                </div>
                <div style="text-align: center;">
                    {__($theme_admin->getName())}
                </div>
            </div>                         
       </td>        
    {if $theme_admin@index % 5 == 5}</tr>{/if}
{/foreach}
</table>
<script type="text/javascript">        
    $(".Themes").click(function () {                         
            $(this).toggleClass('selected');               
            $("#AddSelection").show();
    });
    
    $("#AddSelection").click(function () { 
       var params={ AddThemes: { selection: [],token:"{mfForm::getToken('AddThemeForm')}" } };
       $(".selected").each(function(){ 
           params.AddThemes.selection.push($(this).attr('id'));
       });
     //  alert("Params="+params.toSource());
       return $.ajax2({ data: params, url: "{url_to('themes_ajax_themes',['action'=>'AddTheme'])}",target: "#actions" });
    });
    
    $('#Cancel').click(function(){ return $.ajax2({ url: "{url_to('themes_ajax_themes',['action'=>'ListPartialTheme'])}",target: "#actions" }); });
         
</script>