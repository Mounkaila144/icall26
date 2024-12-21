 <tr>
     <td>PdfJam</td>          
     <td>{if $settings->isResourceAvailable('pdfjam')}{$settings->getResourceVersion('pdfjam')}{else}{__('---')}{/if}</td>                   
     <td>{if $settings->isResourceAvailable('pdfjam')}{__('Available')}{else}{__('Not available')}{/if}</td>                   
</tr>
