{if $html}
<a href="#" 
    title="{if $forbidden}{$forbidden}{else}{if $modulesToUpdate}{__('modules to uptodate')|capitalize}:&#10;{else}{__('site is uptodate')}{/if}{foreach $modulesToUpdate as $module}{$module}{if !$module@last},&#10;{/if}{/foreach}{/if}"  {if $uptodate||$forbidden}style="opacity: 0.4;" class="ModuleManagerSiteUpdated"{else}class="ModuleManagerSiteNotUpdated"{/if} id="{$site->get('site_id')}">
    {if $forbidden}
    <img src="{url('/icons/forbidden.png','picture')}" alt='{__("modules update")}'/>
    {else}
    <img src="{url('/icons/exec.gif','picture')}" alt='{__("modules update")}'/>
    {/if}
</a>
{else}
  $(".ModuleManagerSiteNotUpdated").click(function (){
    //alert("Module manager site (site="+this.id+")"); return;    
      if ($(this).attr('class')!='ModuleManagerSiteNotUpdated')        
        return ;     
      return $.ajax2({ data: { site : this.id }, 
                       url: "{url_to('modules_manager_ajax',['action'=>'UpdateSiteFromSiteList'])}",
                       errorTarget: ".errors-tab-dashboard-sites",
                       success: function(resp) {
                                    if (resp.site)
                                    {
                                        $(".ModuleManagerSiteNotUpdated[id="+resp.site+"]").css('opacity',0.4).attr('class','ModuleManagerSiteUpdated');
                                    }
                                }
                     });
  });
{/if}