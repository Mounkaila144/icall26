{messages class="site-customer-meeting-comments-errors"}
{if $meeting->isLoaded()}      
    <h3>{__("New comment for")} {$meeting->getCustomer()->getFirstname()} {$meeting->getCustomer()->getLastname()} {$meeting->getCustomer()->getPhone()}</h3>
    <div>
                 <div class="CustomerMeetingCommentDialogError" name="comment">{$form.comment->getError()}</div>                   
                 <textarea rows="3" cols="80" class="CustomerMeetingCommentDialog Input" name="comment">{$item->get('comment')}</textarea>
    </div>
    <br/>
    <div  style="text-align: center;">
          <a href="#" id="CustomerMeetingCommentDialog-Save" class="btn" style="display:none"><i class="fa fa-save"></i>{__('Save')}</a>
    </div>
    <script type="text/javascript">

         {* =================== F I E L D S ================================ *}
         $(".CustomerMeetingCommentDialog").click(function() {  $('#CustomerMeetingCommentDialog-Save').show(); });                         
          
         {* =================== A C T I O N S ================================ *}
         $('#CustomerMeetingCommentDialog-Save').click(function(){   
                  var params= { 
                             CustomerMeeting: "{$meeting->get('id')}",
                             CustomerMeetingComment : {
                                    token :'{$form->getCSRFToken()}'
                             }
                  };
                  $(".CustomerMeetingCommentDialog.Input").each(function() { params.CustomerMeetingComment[$(this).attr('name')]=$(this).val(); });
                //  alert("Params="+params.toSource());   return ;
                 return $.ajax2({ data : params,          
                                  url : "{url_to('customers_meetings_comments_ajax',['action'=>'NewCommentDialog'])}",
                                  errorTarget: ".site-customer-meeting-comments-errors",
                                  loading: "#tab-site-dashboard-customers-meeting-loading",                                                              
                                  success: function (response)
                                    {
                                        if (response.errors) 
                                        {
                                            $.each(response.errors,function (error,text) { $(".CustomerMeetingCommentDialogError[name="+error+"]").html(text); });
                                            return;
                                        }    
                                        $(".CustomerMeetings[id=CustomerMeetings-"+response.id+"]").attr('title',response.comments);
                                        $("#dialog-customer-meeting-comment").dialog("close");
                                    }    
                                }); 
          });

    </script>      
{else}
    <span>{__("Meeting is invalid.")}</span>
{/if}    