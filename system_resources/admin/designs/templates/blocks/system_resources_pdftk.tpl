 <tr>
     <td>PDFtk</td>          
     <td>{if $settings->isResourceAvailable('pdftk')}{$settings->getResourceVersion('pdftk')}{else}{__('---')}{/if}</td>                   
     <td>{if $settings->isResourceAvailable('pdftk')}{__('Available')}{else}{__('Not available')}{/if}</td>                   
</tr>

