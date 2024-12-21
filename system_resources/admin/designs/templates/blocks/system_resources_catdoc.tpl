 <tr>
     <td>Catdoc</td>          
     <td>{if $settings->isResourceAvailable('catdoc')}{$settings->getResourceVersion('catdoc')}{else}{__('---')}{/if}</td>                   
     <td>{if $settings->isResourceAvailable('catdoc')}{__('Available')}{else}{__('Not available')}{/if}</td>                   
</tr>
