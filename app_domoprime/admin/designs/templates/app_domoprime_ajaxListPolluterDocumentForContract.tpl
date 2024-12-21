{if !$documents->isEmpty()}
{foreach $documents as $document}
    <div>
    <img src="{url('/icons/files/pdf.gif','picture')}" title='{$document->getDocument()->get('name')}'/>
    <a target="_blank" href="{url_to('app_domoprime_polluter_document_file',['document'=>$document->get('id'),'contract'=>$contract->get('id'),'file'=>$document->getNameWithExtension()])}">{$document->getDocument()->get('name')} ({$document->getPolluter()->get('name')|upper})</a>
    </div>
{/foreach}    
{else}
   {__('No document available')} 
{/if}  
