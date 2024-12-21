 <tr>
     <td>Ghostscript</td>          
     <td>{if $settings->isResourceAvailable('ghostscript')}{$settings->getResourceVersion('ghostscript')}{else}{__('---')}{/if}</td>                   
     <td>{if $settings->isResourceAvailable('ghostscript')}{__('Available')}{else}{__('Not available')}{/if}</td>                   
</tr>
