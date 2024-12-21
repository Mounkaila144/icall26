{messages class="customers-meetings-forms-documents-errors"}
{if $documents && !$documents->isEmpty()}
{foreach $documents as $document}
    <div>
    <img src="{url('/icons/files/pdf.gif','picture')}" title='{$document->get('name')}'/>
    <a target="_blank" href="{url_to('app_domoprime_document_file_class',['file'=>$document->getNameWithExtension(),'contract'=>$contract->get('id'),'document'=>$document->get('id')])}">{$document->get('name')}</a>
    </div>
{/foreach}    
{else}
   {__('No document available')} 
{/if}    
<script type="text/javascript">
 
          
           $("#RefreshDocumentClass").click(function() {                                  
                return $.ajax2({     
                    data : { Contract: $(this).attr('id') },
                    url: "{url_to('app_domoprime_ajax',['action'=>'ListDocumentClassForContract'])}",                                             
                    errorTarget: ".customers-contract-errors",
                    loading: "#tab-site-dashboard-customers-contract-loading",  
                    target: "#tab-site-panel-dashboard-customers-contract-document-form-"+$(this).attr('id')
               }); 
           });
           
                     
</script>  
