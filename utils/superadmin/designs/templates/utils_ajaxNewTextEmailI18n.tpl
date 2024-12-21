{messages class="TextEmailI18n-errors"}
<h3>{__("new text")|capitalize}</h3>
<div>
    <a href="#" id="TextEmailI18n-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="TextEmailI18n-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
    </div>    
    {component name="/languages/dialogListLanguagesFrontend" selected=$form.lang site=$item->getSite()}  
    <table cellpadding="0" cellspacing="0">
        <tr>
            <td>{__('language')}</td>
            <td>
                <img  id="{$language}" class="TextEmailI18n" name="lang" src="{url("/flags/`$language`.png","picture")}" title="{format_country($language)}" />
                <a id="ChangeLanguage" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("change a language")}'/></a>  </td>    
            <td> 
            </td>
        </tr>
        <tr>
            <td>{__('name')}:
            </td>
            <td>
                <div>{$form.key->getError()}</div>
                <input type="text" class="TextEmailI18n" name="key" value="{$item->get('key')|escape}"/>
            </td>
        </tr>
         <tr>
            <td>{__('email subject')}:
            </td>
            <td> <div>{$form.subject->getError()}</div>
                <input type="text" class="TextEmailI18n" name="subject" size="80" value="{$item->get('subject')|escape}"/>    
            </td>
        </tr>
        <tr>
            <td>{__('email body')}:
            </td>
            <td> <div>{$form.body->getError()}</div>
                <textarea class="TextEmailI18n editor" name="body" rows="40" cols="80">{$item->get('body')|escape}</textarea>   
            </td>
        </tr>
    </table>
    
<script type="text/javascript"> 
       
        
        $('#TextEmailI18n-Cancel').click(function(){                
             return $.ajax2({ data : { filter : { module: "{$form.module}",token: "{mfForm::getToken('TextEmailI18nFormFilter')}"} },
                              url:"{url_to('utils_ajax_textemaili18n',['action'=>'List'])}",
                              target: "#TextEmailI18n-actions"}); 
        });
        
        $('#TextEmailI18n-Save').click(function(){ 
            
          var params= { textEmailI18n: {           
                                  lang :  $("img.TextEmailI18n[name=lang]").attr('id'),
                                  module : "{$form.module}",
                                  token:"{mfForm::getToken('TextEmailI18nForm')}" } 
                                  };     
              $("input.TextEmailI18n,textarea.TextEmailI18n").each(function() { params.textEmailI18n[this.name]=$(this).val(); });
             // alert("Params="+params.toSource()); return ;
                  return $.ajax2({ data : params,
                                   url: "{url_to('utils_ajax_textemaili18n',['action'=>'New'])}",
                                   target: "#TextEmailI18n-actions"}); 
         });
         
         $("#ChangeLanguage").click(function () { 
                $("#dialogListLanguages").dialog("open");           
         }); 
         
         $(".TextEmailI18n").click(function(){ 
            $("#TextEmailI18n-Save").show();
         });
         
        $("#dialogListLanguages").bind('select',function(event){
                $("#TextEmailI18n-Save").show();
                $(".TextEmailI18n[name=lang]").attr({
                                               id: event.selected.id,
                                              src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                              title: event.selected.lang
                                              });
        });
        
        {JqueryScriptsReady} 
             
         $('.editor[name=body]').tinymce({
                        mode : "exact",
                        width: "500",
                        height: "500",
                        setup : function (ed) {
                                        ed.onKeyPress.add(
                                            function (ed, evt) {
                                                $('#TextEmailI18n-Save').show();
                                            }
                                   );
                        },
                        elements : 'nourlconvert', //'absurls',
			// Location of TinyMCE script
			script_url : "{url('/js/tiny_mce/3.4.6/tiny_mce.js','web','frontend')}",
                        language : '{$language}',			
			theme : "advanced",  //,print,save
			// Theme widget
                        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
                        theme_advanced_buttons3 : "",
                        theme_advanced_buttons4 : "",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : false,
                        relative_urls : true, // false,
                        remove_script_host : false            
                       
	   }); 
 
   
        {/JqueryScriptsReady} 
</script>