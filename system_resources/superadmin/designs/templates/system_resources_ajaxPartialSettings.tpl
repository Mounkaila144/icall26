{messages class="system-resources-errors"}
 <div style="float:left">
    <a href="#" id="Settings-Check" class="btn btn-primary">
         <i class="fa fa-cog" style="margin-right:10px;"></i>
        {__('Check resources')}</a>    
</div>
<div style="clear:both"></div>
<fieldset>
     {*<legend>{__('Options')}</legend> *}
     <table>
         <tr>
             <th>{__('Resource')}</th>
             <th>{__('Version')}</th>
             <th>{__('Installed')}</th>            
         </tr>
         {foreach $settings->getResources()->ksort() as $resource}
                {component name=$resource settings=$settings}
         {/foreach}    
     </table>
</fieldset>
<script type="text/javascript">
     
   $('#Settings-Check').click(function(){                             
               
          return $.ajax2({ errorTarget : ".system-resources-errors",
                           loading : '#tab-site-dashboard-x-settings-loading',
                           url: "{url_to('system_resources_ajax',['action'=>'Check'])}",                                                  
                           target: "#actions"}); 
        }); 
        
        
    
</script>