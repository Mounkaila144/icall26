 <tr>
     <td>pdftotext</td>          
     <td>{if $settings->isResourceAvailable('pdftotext')}{$settings->getResourceVersion('pdftotext')}{else}{__('---')}{/if}</td>                   
     <td>{if $settings->isResourceAvailable('pdftotext')}{__('Available')}{else}{__('Not available')}{/if}</td>                   
</tr>

