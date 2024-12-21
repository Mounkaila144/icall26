 <tr>
     <td>Libreoffice</td>          
     <td>{if $settings->isResourceAvailable('libreoffice')}{$settings->getResourceVersion('libreoffice')}{else}{__('---')}{/if}</td>                   
     <td>{if $settings->isResourceAvailable('libreoffice')}{__('Available')}
          <a href="{url_to('system_resources',['action'=>'LibreOfficeTest'])}" target="_blank"><i class="fa fa-file-pdf-o"></i></a>          
         {else}
             {__('Not available')}{/if}</td>                   
</tr>
