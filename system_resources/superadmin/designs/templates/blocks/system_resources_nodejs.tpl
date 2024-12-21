 <tr>
     <td>Node.js</td>          
     <td>{if $settings->isResourceAvailable('node.js')}{$settings->getResourceVersion('node.js')}{else}{__('---')}{/if}</td>                   
     <td>{if $settings->isResourceAvailable('node.js')}{__('Available')}{else}{__('Not available')}{/if}</td>                   
</tr>

