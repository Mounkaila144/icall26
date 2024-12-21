{messages class="TextI18n-errors"}
<h3>{__("edit text")|capitalize}</h3>
<div>
    <a href="#" id="TextI18n-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="TextI18n-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
    </div>
{if $item && $item->isLoaded()}
    <div>
           {if $item->get('lang')}<img  src="{url("/flags/`$item->get('lang')|default:"__"`.png","picture")}" title="{format_country($item->get('lang'))}" />{/if}    
    </div>
    <div>{$item->get('key')|escape}</div>
    <textarea class="TextI18n editor" name="text" rows="40" cols="80">{$item->get('text')|escape}</textarea>     
{else}
    <span>{__("this text doesn't exist")}</span>
{/if}
<script type="text/javascript"> 
    
        $('#TextI18n-Cancel').click(function(){                                
             return $.ajax2({ url:"{url_to('utils_ajax_textI18n',['class'=>$class,'action'=>'ListTextI18n'])}",target: "#TextI18n-actions"}); 
        });
        
        $('#TextI18n-Save').click(function(){ 
                  
          var params= { textI18n: { lang: "{$item->get('lang')}",
                                    key:"{$item->get('key')}",
                                    text:$(".TextI18n[name=text]").val(),
                                    token:"{mfForm::getToken('TextI18nForm')}" } };          
             // alert("Params="+params.toSource()); return ;
                  return $.ajax2({ data : params,
                                   url: "{url_to('utils_ajax_textI18n',['class'=>$class,'action'=>'SaveTextI18n'])}",
                                   target: "#TextI18n-actions"}); 
         });
         
        {JqueryScriptsReady} 
             
          $('.editor[name=text]').tinymce({
                        mode : "exact",
                        width: "500",
                        height: "500",
                        setup : function (ed) {
                                        ed.onKeyPress.add(
                                            function (ed, evt) {
                                                $('#TextI18n-Save').show();
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
                        relative_urls : false,
                        remove_script_host : false
                       
	   }); 
 
   
        {/JqueryScriptsReady} 
</script>