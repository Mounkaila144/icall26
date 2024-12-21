{messages class="site-contract-meeting-comments-errors"}
<h3>{__("New comment")}</h3>
{if $contract->isLoaded() && $contract->getMeeting()->isLoaded()}
    <div>
        <a href="#" id="ContractMeetingComment-Save-{$contract->get('id')}" class="btn" style="display:none"><i class="fa fa-floppy-o" style="margin-right: 10px;"></i>{__('Save')}</a>
        <a href="#" id="ContractMeetingComment-Cancel-{$contract->get('id')}" class="btn"><i class="fa fa-times" style="margin-right: 10px;"></i>{__('Cancel')}</a>
    </div>

    <table class="tab-form" cellpadding="0" cellspacing="0">      
        <tr>
            <td class="label"><span>{__("comment")}</span></td>
            <td>
                <div class="error-form">{$form.comment->getError()}</div>                   
                 <textarea rows="3" cols="80" class="ContractMeetingComment-{$contract->get('id')}" name="comment">{$item->get('comment')}</textarea>
            </td>
        </tr>  
    </table>    

    <script type="text/javascript">

         {* =================== F I E L D S ================================ *}
         $(".ContractMeetingComment-{$contract->get('id')}").click(function() {  $('#ContractMeetingComment-Save-{$contract->get('id')}').show(); });                         

         {* =================== A C T I O N S ================================ *}
         $('#ContractMeetingComment-Cancel-{$contract->get('id')}').click(function(){               
                 return $.ajax2({ data : {  Contract: "{$contract->get('id')}"  },          
                                  url : "{url_to('customers_meetings_comments_ajax',['action'=>'ListPartialCommentForContract'])}",
                                   errorTarget: ".site-contract-meeting-comments-errors",
                                loading: "#tab-site-dashboard-customers-contract-loading",
                                target: "#tab-customer-contracts-contract-25-meeting-comments-{$contract->get('id')}"
                                }); 
          });
          
         {* =================== A C T I O N S ================================ *}
         $('#ContractMeetingComment-Save-{$contract->get('id')}').click(function(){   
                  var params= { 
                             Contract: "{$contract->get('id')}",
                             ContractMeetingComment : {
                                    token :'{$form->getCSRFToken()}'
                             }
                  };
                  $("textarea.ContractMeetingComment-{$contract->get('id')}").each(function() { params.ContractMeetingComment[this.name]=$(this).val(); });
                //  alert("Params="+params.toSource());   return ;
                 return $.ajax2({ data : params,          
                                  url : "{url_to('customers_meetings_comments_ajax',['action'=>'NewCommentForContract'])}",
                                  errorTarget: ".site-contract-meeting-comments-errors",
                                loading: "#tab-site-dashboard-customers-contract-loading",
                                target: "#tab-customer-contracts-contract-25-meeting-comments-{$contract->get('id')}"
                                }); 
          });

    </script>      
{else}
    <span>{__("Meeting is invalid.")}</span>
{/if}    
