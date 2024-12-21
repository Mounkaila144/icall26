{if $user->hasCredential([['superadmin','meeting_view_list_comments']])}
     <fieldset class="tab-form" >    
          <legend><h3>{__('Comments')}</h3></legend>
<div id="customer-meeting-view-comments-{$meeting->get('id')}">      
   {include file="../customers_meetings_comments_ajaxListPartialCommentForViewMeeting.tpl"}
</div>
     </fieldset>
{/if}
