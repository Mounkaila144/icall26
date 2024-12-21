{messages class="system-resources-errors"}
<h3>{__("Settings")}</h3>
 <div style="float:left">
     
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
     
   
    
</script>