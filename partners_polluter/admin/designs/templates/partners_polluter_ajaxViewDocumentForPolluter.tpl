{messages class="site-errors"}
<h3>{__('Document [%s] for polluter [%s]',[$item->getDocument()->get('name'),$polluter->get('name')])}</h3>    
{if $polluter->isLoaded()}
   <div>
        <a href="#" class="btn" id="PolluterDocument-Save" style="display:none">
         <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
   <a href="#" id="PolluterDocument-Cancel" class="btn"> <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>    
</div>
   {html_options name="model_id" class="PolluterDocument Select" options=$form->model_id->getOption('choices') selected=$item->get('model_id')}
   
   
{else}
  {__('Polluter is invalid.')}   
{/if}  
 <script type="text/javascript">
  
        $(".PolluterDocument").click(function() {  $('#PolluterDocument-Save').show(); });    
       
            
       $("#PolluterDocument-Cancel").click( function () {              
                return $.ajax2({ data : { Polluter: '{$polluter->get('id')}' },
                         url:"{url_to('partners_polluter_ajax',['action'=>'ListPartialDocumentForPolluter'])}",
                         errorTarget: ".site-errors",
                         loading: "#tab-site-dashboard-x-settings-loading",                         
                         target: "#actions"});
         });
         
     $('#PolluterDocument-Save').click(function(){                             
            var  params= {      Polluter: '{$polluter->get('id')}', 
                                PolluterDocument : {                                  
                                document_id: '{$item->getDocument()->get('id')}',                                                                                                         
                                token :'{$form->getCSRFToken()}'
                                } };         
          $(".PolluterDocument.Select option:selected").each(function() {  params.PolluterDocument[$(this).parent().attr('name')]=$(this).val();  });  // Get foreign key  
        //      alert("Params="+params.toSource());   return ;
          
          return $.ajax2({ data : params,                             
                           url: "{url_to('partners_polluter_ajax',['action'=>'SaveDocumentForPolluter'])}",
                           errorTarget: ".site-errors",
                           loading: "#tab-site-dashboard-x-settings-loading",             
                           target: "#actions"}); 
        });   
</script>    