{if !$meeting->isHold()}        
    <div>
    <a target="_blank" href="{url_to('app_domoprime',['action'=>'ExportPolluterAfterWorkDocumentPdfForMeeting'])}?Meeting={$meeting->get('id')}" title="{__('After Work Document')}">
        <i class="fa fa-file-pdf-o" style="font-size: 16px;"/>
        <span>{__('After Work Document')}</span></a>                       
    </div>    
 {/if}

