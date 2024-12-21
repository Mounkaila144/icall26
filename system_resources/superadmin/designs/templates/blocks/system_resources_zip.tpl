 <tr>
     <td>Zip</td>          
     <td>{if $settings->isResourceAvailable('zip')}{$settings->getResourceVersion('zip')}{else}{__('---')}{/if}</td>                   
     <td>{if $settings->isResourceAvailable('zip')}{__('Available')}{else}{__('Not available')}{/if}</td>                   
</tr>
