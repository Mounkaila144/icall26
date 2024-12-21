{messages class="site-comments-errors"}
<h3>{__("New comment")}</h3>
{if $meeting->isLoaded()}
    <div>
        <a href="#" id="Comment-Save-{$token}" class="btn" style="display:none"><i class="fa fa-floppy-o" style="margin-right: 10px;"></i>{*<img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>*}{__('save')}</a>
        <a href="#" id="Comment-Cancel-{$token}" class="btn"><i class="fa fa-times" style="margin-right: 10px;"></i>{*<img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>*}{__('cancel')}</a>
    </div>

    <table class="tab-form" cellpadding="0" cellspacing="0">      
        <tr>
            <td class="label"><span>{__("comment")}</span></td>
            <td>
                <div class="error-form">{$form.comment->getError()}</div>                   
                 <textarea rows="3" cols="80" class="Comment-{$token}" name="comment">{$item->get('comment')}</textarea>
            </td>
        </tr>  
    </table>    

    <script type="text/javascript">

         {* =================== F I E L D S ================================ *}
         $(".Comment-{$token}").click(function() {  $('#Comment-Save-{$token}').show(); });                         

         {* =================== A C T I O N S ================================ *}
         $('#Comment-Cancel-{$token}').click(function(){               
                 return $.ajax2({ data : { Meeting: "{$meeting->get('id')}"  },          
                                  url : "{url_to('customers_meetings_comments_ajax',['action'=>'ListPartialComment'])}",
                                  errorTarget: ".site-comments-errors",
                                  loading: "#tab-site-dashboard-site-customers-meeting-loading",                             
                                  target: "#tab-customer-meetings-customer-meeting-comments-{$meeting->get('id')}"
                                }); 
          });
          
         {* =================== A C T I O N S ================================ *}
         $('#Comment-Save-{$token}').click(function(){   
                  var params= { 
                             Meeting: "{$meeting->get('id')}",
                             Comment : {
                                    token :'{$form->getCSRFToken()}'
                             }
                  };
                  $("textarea.Comment-{$token}").each(function() { params.Comment[this.name]=$(this).val(); });
                //  alert("Params="+params.toSource());   return ;
                 return $.ajax2({ data : params,          
                                  url : "{url_to('customers_meetings_comments_ajax',['action'=>'NewComment'])}",
                                  errorTarget: ".site-comments-errors",
                                  loading: "#tab-site-dashboard-site-customers-meeting-loading",                             
                                  target: "#tab-customer-meetings-customer-meeting-comments-{$meeting->get('id')}"
                                }); 
          });

    </script>      
{else}
    <span>{__("Meeting is invalid.")}</span>
{/if}    