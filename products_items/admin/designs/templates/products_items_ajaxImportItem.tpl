{messages class="errors"} 
<h3>{__("Import items")}</h3>
<div>
    <a href="#" id="Save" class="btn btn-primary" style="display:none"><i class="fa fa-save"></i>{__('Save')}</a>
    <a href="#" id="Cancel" class="btn btn-primary"><i class="fa fa-times"></i>{__('Cancel')}</a>
   
</div>
<table cellpadding="0" cellspacing="0">  
     <tr>
        <td>{__('File')}:</td>
        <td>
            <div>{$form.file->getError()}</div> 
            <input class="files" type="file" name="Import[file]"/> 
         </td>
    </tr>      
</table>
 <div>
    <a target="_blank" href="{url('/module/products_items/models/items.csv','web')}">{__('Download model')}</a> 
    </div>            
<script type="text/javascript">    
    
      $('#Cancel').click(function(){               
             return $.ajax2({ url : "{url_to('products_items_ajax',['action'=>'ListPartialItem'])}",
                              target: "#actions"}); 
      });
      
      $('.files').click(function() { $('#Save').show(); });
      
      $('#Save').click(function(){ 
              var params= { iFrame:true, Import: { token :'{$form->getCSRFToken()}' } };        
              return $.ajax2({ data: params, 
                               files: ".files",
                               url: "{url_to('products_items_ajax',['action'=>'ImportItem'])}",
                               target: "#actions"
                               }); 
        });  
    
</script> 