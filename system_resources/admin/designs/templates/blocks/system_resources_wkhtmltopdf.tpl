 <tr>
     <td>Wkhtmltopdf</td>          
     <td>{if $settings->isResourceAvailable('wkhtmltopdf')}{$settings->getResourceVersion('wkhtmltopdf')}{else}{__('---')}{/if}</td>                   
     <td>{if $settings->isResourceAvailable('wkhtmltopdf')}{__('Available')}{else}{__('Not available')}{/if}</td>                   
</tr>
