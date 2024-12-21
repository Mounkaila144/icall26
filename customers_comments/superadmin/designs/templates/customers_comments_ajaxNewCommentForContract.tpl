{messages class="{$site->getSiteID()}-site-comments-errors"}
<h3>{__("New comment")}</h3>
{if $contract->isLoaded()}
    <div>
        <a href="#" id="{$site->getSiteID()}-Comment-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
        <a href="#" id="{$site->getSiteID()}-Comment-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
    </div>

    <table cellpadding="0" cellspacing="0">      
        <tr>
            <td><span>{__("Comment")}</span></td>
            <td>
                 <div>{$form.comment->getError()}</div>                   
                 <textarea rows="3" cols="80" class="{$site->getSiteID()}-Comment" name="comment">{$item->get('comment')}</textarea>
            </td>
        </tr>  
    </table>    

    <script type="text/javascript">

         {* =================== F I E L D S ================================ *}
         $(".{$site->getSiteID()}-Comment").click(function() {  $('#{$site->getSiteID()}-Comment-Save').show(); });                         

         {* =================== A C T I O N S ================================ *}
         $('#{$site->getSiteID()}-Comment-Cancel').click(function(){               
                 return $.ajax2({ data : { Contract: "{$contract->get('id')}"  },          
                                  url : "{url_to('customers_comments_ajax',['action'=>'ListPartialCommentForContract'])}",
                                  errorTarget: ".{$site->getSiteID()}-site-comments-errors",
                                  loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-contract-loading",                             
                                  target: "#tab-customer-contracts-customer-comments-{$contract->get('id')}"
                                }); 
          });
          
         {* =================== A C T I O N S ================================ *}
         $('#{$site->getSiteID()}-Comment-Save').click(function(){   
                  var params= { 
                             Contract: "{$contract->get('id')}",
                             Comment : {
                                    token :'{$form->getCSRFToken()}'
                             }
                  };
                  $("textarea.{$site->getSiteID()}-Comment").each(function() { params.Comment[this.name]=$(this).val(); });
                //  alert("Params="+params.toSource());   return ;
                 return $.ajax2({ data : params,          
                                  url : "{url_to('customers_comments_ajax',['action'=>'NewCommentForContract'])}",
                                  errorTarget: ".{$site->getSiteID()}-site-comments-errors",
                                  loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-contract-loading",                             
                                  target: "#tab-customer-contracts-customer-comments-{$contract->get('id')}"
                                }); 
          });

    </script>      
{else}
    <span>{__("Contract is invalid.")}</span>
{/if}    