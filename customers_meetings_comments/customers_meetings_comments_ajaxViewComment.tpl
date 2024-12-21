{messages class="site-comments-errors"}
<h3>{__("View comment")}</h3>
{if $item->isLoaded()}
     <div>       
        <a href="#" id="Comment-Cancel" class="btn"><i class="fa fa-times" style="margin-right: 10px;"></i>{*<img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>*}{__('cancel')}</a>
    </div>
    <table class="tab-form" cellpadding="0" cellspacing="0">      
        <tr>
            <td class="label"><span>{__("comment")}</span></td>
            <td>                               
                 <textarea disabled="" rows="3" cols="80" class="Comment" name="comment">{$item->get('comment')}</textarea>
            </td>
        </tr>  
    </table>    

    <script type="text/javascript">

        
         {* =================== A C T I O N S ================================ *}
         $('#Comment-Cancel').click(function(){               
                 return $.ajax2({ data : { Meeting: "{$item->getCustomerMeeting()->get('id')}"  },          
                                  url : "{url_to('customers_meetings_comments_ajax',['action'=>'ListPartialComment'])}",
                                  errorTarget: ".site-comments-errors",
                                  loading: "#tab-site-dashboard-site-customers-meeting-loading",                             
                                  target: "#tab-customer-meetings-customer-meeting-comments-{$item->getCustomerMeeting()->get('id')}"
                                }); 
          });
          
         

    </script>      
{else}
    <span>{__("Comment is invalid.")}</span>
{/if}    