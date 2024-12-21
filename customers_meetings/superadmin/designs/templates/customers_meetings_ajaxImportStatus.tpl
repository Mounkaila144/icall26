{messages class="errors"} 
<h3>{__("Import file")|capitalize}</h3>
<div>
    <a href="#" id="Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
<table cellpadding="0" cellspacing="0">  
     <tr>
        <td>{__('file')}:</td>
        <td>
            <div>{$form.file->getError()}</div> 
            <input class="files" type="file" name="Import[file]"/> 
         </td>
    </tr>  
      <tr>
        <td>{__('ftp import file')}:</td>
        <td>
            <div>{$form.ftp->getError()}</div>                               
            <span class="import" id="{if $form->hasErrors() || $form.ftp->getValue()==null}{(string)$form.ftp}{else}{$form.ftp->getValue()->getName()}{/if}" name="ftp">{if $form->hasErrors() || $form.ftp->getValue()==null}{(string)$form.ftp}{else}{$form.ftp->getValue()->getName()}{/if}</span> 
            <a id="SelectFtpFileForImport" href="#" style="{if (string)$form.ftp}display:none{/if}">
                <img  src="{url('/icons/add.gif','picture')}" alt="{__('ftp')}"/>
                {__('file')}
            </a>
            <a id="ChangeFtpFileForImport" href="#" title="{__('change')}" style="{if !(string)$form.ftp}display:none{/if}">
                <img  src="{url('/icons/edit.gif','picture')}" alt='{__("ftp")}'/>
            </a>                       
            {component name="/utils/dialogFileManagerFtpForImport" path=$form->ftp->getOption('path')}
         </td>
    </tr>  
</table>
<script type="text/javascript">    
    
      $('#Cancel').click(function(){   
             $("#dialogFileManagerFtpForImport").dialog("destroy").remove();
             return $.ajax2({ url : "{url_to('customers_meeting_ajax',['action'=>'ListPartialStatus'])}",
                              target: "#{$site->getSiteId()}-actions"}); 
      });
      
      $('.import,.files').click(function() { $('#Save').show(); });
      
      $('#Save').click(function(){ 
              var params= { iFrame:true, Import: { ftp: $(".import[name=ftp]").attr('id'),token :'{$form->getCSRFToken()}' } };
              $("input.import").each(function() { params.Import[this.name]=this.value; });
              $("#dialogFileManagerFtpForImport").dialog("destroy").remove();
              return $.ajax2({ data: params, 
                               files: ".files",
                               url: "{url_to('customers_meeting_ajax',['action'=>'ImportStatus'])}",
                               target: "#{$site->getSiteId()}-actions"
                               }); 
        });  
     
      $("#SelectFtpFileForImport,#ChangeFtpFileForImport").click(function() {
        $("#Save").show();
        $("#dialogFileManagerFtpForImport").dialog("open");
      });    
      
      $("#dialogFileManagerFtpForImport").bind('select',function(event){       
         $(".import[name=ftp]").html(event.selected);
         $(".import[name=ftp]").attr('id',event.selected);
      });
</script> 