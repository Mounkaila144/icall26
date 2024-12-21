<style> .ui-dialog { font-size: 62.5%; } </style>   
<div id="dialogListLanguages{if $name}-{$name}{/if}" class="dialogs" title="{__('language')}"  style="display:none"> 
    <table cellpadding="0" cellspacing="0" style="border-collapse : collapse;">
        <tr>
            <td></td>
            <td>{__('Country')}</td>
        </tr>
        {foreach $languages as $language}
        <tr class="dialogListLanguages{if $name}-{$name}{/if} {if $language->get('code')==$selected}selected{/if}" id="{$language->get('code')}" name="{$language->getI18nLanguage()}">
            <td name="lang" title="{$language->getI18nLanguage()}">
                <img src='{url("/flags/`$language->get('code')`.png","picture")}' alt="{$language->getI18nLanguage()}"/>                 
            </td>
            <td><span style="{if $language->get('is_active')=='NO'}font-style:italic{else}font-weight:bold{/if};">{$language->getI18nLanguage()}</span></td>
        </tr>
        {/foreach}
    </table>   
</div>

<script type="text/javascript">
    
    if ($("[aria-describedby=dialogListLanguages]").length)
        $("[aria-describedby=dialogListLanguages]").remove();
    
    $("#dialogListLanguages{if $name}-{$name}{/if}").dialog({
        autoOpen: false,
        height: 300,
        width: 180,
        resizable: false,
       // closeOnEscape: false,
        modal: true,
        buttons: {
            "{__('Select')}": function() {

                   selected={ 
                       id : $(".dialogListLanguages{if $name}-{$name}{/if}.selected").attr('id'),
                       lang : $(".dialogListLanguages{if $name}-{$name}{/if}.selected td[name=lang]").attr('title')
                   }; 
                   $("#dialogListLanguages{if $name}-{$name}{/if}").trigger({ type:'select', 
                           selected: selected
                   });
                    $( this ).dialog( "close" );
            },
            "{__('Cancel')}": function() {
                $( this ).dialog( "close" );
            }
        },
        open : function() {

        },
        close: function() {
            
        }
    });
            
    $(".dialogListLanguages{if $name}-{$name}{/if}").click(function () {
       $(".dialogListLanguages{if $name}-{$name}{/if}").removeClass('selected'); 
       $(this).toggleClass('selected'); 
    });
    
    $("#dialogListLanguages{if $name}-{$name}{/if}").unbind(); // Remove all events - mandatory in this place due to dialog init
</script>