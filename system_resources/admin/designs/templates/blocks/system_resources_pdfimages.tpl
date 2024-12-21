 <tr>
     <td>pdfimages</td>          
     <td>{if $settings->isResourceAvailable('pdfimages')}{$settings->getResourceVersion('images')}{else}{__('---')}{/if}</td>                   
     <td>{if $settings->isResourceAvailable('images')}{__('Available')}{else}{__('Not available')}{/if}</td>                   
</tr>

