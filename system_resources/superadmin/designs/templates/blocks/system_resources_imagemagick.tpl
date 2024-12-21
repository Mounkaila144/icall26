 <tr>
     <td>ImageMagick</td>          
     <td>{if $settings->isResourceAvailable('imagemagick')}{$settings->getResourceVersion('imagemagick')}{else}{__('---')}{/if}</td>                   
     <td>{if $settings->isResourceAvailable('imagemagick')}{__('Available')}{else}{__('Not available')}{/if}</td>                   
</tr>

