{if !$meeting->isHold()}        
    <div>
    <a target="_blank" href="{url_to('app_domoprime',['action'=>'ExportPolluterPreMeetingDocumentPdfForMeeting'])}?Meeting={$meeting->get('id')}" title="{__('Pre Meeting Document')}">
        <i class="fa fa-file-pdf-o" style="font-size: 16px;"/>
        <span>{__('Pre Meeting Document')}</span></a>                       
    </div>    
 {/if}

