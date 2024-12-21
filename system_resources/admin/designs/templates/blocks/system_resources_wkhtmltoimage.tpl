 <tr>
     <td>Wkhtmltoimage</td>          
     <td>{if $settings->isResourceAvailable('wkhtmltoimage')}{$settings->getResourceVersion('wkhtmltoimage')}{else}{__('---')}{/if}</td>                   
     <td>{if $settings->isResourceAvailable('wkhtmltoimage')}{__('Available')}{else}{__('Not available')}{/if}</td>                   
</tr>
