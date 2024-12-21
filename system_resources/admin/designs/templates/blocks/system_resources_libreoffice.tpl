 <tr>
     <td>Libreoffice</td>          
     <td>{if $settings->isResourceAvailable('libreoffice')}{$settings->getResourceVersion('libreoffice')}{else}{__('---')}{/if}</td>                   
     <td>{if $settings->isResourceAvailable('libreoffice')}{__('Available')}{else}{__('Not available')}{/if}</td>                   
</tr>
