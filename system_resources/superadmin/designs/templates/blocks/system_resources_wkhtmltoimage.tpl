 <tr>
     <td>Wkhtmltoimage</td>          
     <td>{if $settings->isResourceAvailable('wkhtmltoimage')}{$settings->getResourceVersion('wkhtmltoimage')}{else}{__('---')}{/if}</td>                   
     <td>{if $settings->isResourceAvailable('wkhtmltoimage')}{__('Available')}
        <a href="{url_to('system_resources',['action'=>'WkhtmltoimageTest'])}" target="_blank"><i class="fa fa-picture-o"></i></a> 
         {else}{__('Not available')}{/if}
    
     </td>                   
</tr>
