<div>
{if $engine->hasDocument()}    
<a href="{url_to("app_domoprime_iso",['action'=>'GenerateDocumentForContract'])}?Contract={$contract->get('id')}" target="_blank" title="{__('Document')}">
    <i class="fa fa-file-pdf-o" style="font-size: 16px"/>
    {__('AH Document')}
</a> 
{else}
    {__('AH Document')} : {__('No surface')}
{/if}    
</div>