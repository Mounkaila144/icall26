{messages class="errors"}
<h3>{__("Site Manager")}</h3>
<style> .ui-dialog { font-size: 62.5%; } </style>
<div id="help">&nbsp;</div>
<div id="tabs">
     <ul>
         <li>
             <a href="#tab_information" title="{__('information')}" name="tab_information" class="items_view">
                  <img height="32" width="32" src="{url('icons/info.png','picture')}" alt="{__('information')|capitalize}"/>                  
                  <span>{__('information')|capitalize}</span>
             </a>
             <span style="display:none;" id="item_tab_information">{__("help information")|default:'&nbsp;'}</span>
         </li>
     </ul>
          {* ============================== I N F O R M A T I O N =================================================  *}
    <div id="tab_information">        
        <div>
            <a href="#" id="Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>   
        </div>
        <table>
             <tr>
                <th>{__('domain')}
                </th>
                <th>{__('theme')}
                </th>
                <th>{__('actions')}
                </th>
            </tr>
            {foreach $master->getLinkedSites() as $site}
                <tr>
                    <td>{$site->get('site_host')}
                    </td>
                     <td>{__($site->getThemeFrontEnd())}
                    </td>
                    <td>
                           <a href="#" title="{__('edit')|capitalize}" class="ViewSite" id="{$site->get('site_id')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("edit")}'/></a>
                    </td>
                </tr>
            {/foreach}    
        </table>
    </div>
</div>   
    
    
<script type="text/javascript">        
     {JqueryScriptsReady} 
{* =========== T A B S ===================================== *}  

    $("#tabs").tabs().addClass('ui-tabs-vertical ui-helper-clearfix');

    $("#tabs li").removeClass('ui-corner-top').addClass('ui-corner-left'); 

// Help messages
    $('.items_view').mouseenter(function(){
        $("#help").html($("span#item_"+this.name).html());
    });

    $('.items_view').mouseleave(function(){
        $("#help").html("&nbsp;");
    }); 
    
    $('.ViewSite').click(function () {
                return $.ajax2({ data: { Site : $(this).attr('id') }, url: "{url_to('site_admin_ajax',['action'=>'ViewTheme'])}", target: "#middle"});
    });
    
    {/JqueryScriptsReady} 
</script>    