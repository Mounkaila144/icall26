{messages class="customers-meetings-forms-documents-errors"}
{if $documents && !$documents->isEmpty()}
{foreach $documents as $document}
    <div>
    <img src="{url('/icons/files/pdf.gif','picture')}" title='{$document->get('name')}'/>
    <a target="_blank" href="{url_to('app_domoprime_document_file_class',['file'=>$document->getNameWithExtension(),'contract'=>$contract->get('id')])}">{$document->get('name')}</a>
    </div>
{/foreach}    
{else}
   {__('No document available')} 
{/if}    

