 <tr>
     <td>Wkhtmltopdf</td>          
     <td>{if $settings->isResourceAvailable('wkhtmltopdf')}{$settings->getResourceVersion('wkhtmltopdf')}{else}{__('---')}{/if}</td>                   
     <td>{if $settings->isResourceAvailable('wkhtmltopdf')}{__('Available')}
            <a href="{url_to('system_resources',['action'=>'WkhtmltopdfTest'])}" target="_blank"><i class="fa fa-file-pdf-o"></i></a>
         {else}{__('Not available')}{/if}
     </td>                   
</tr>
