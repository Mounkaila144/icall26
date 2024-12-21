 <fieldset class="tab-form" style="width: auto;">
      <legend><h3>{__('Documents')}</h3></legend>    
       {if $meeting->hasPolluter() && $user->hasCredential([['app_domoprime_iso_meeting_view_documents_polluter_mandatory']]) || $user->hasCredential([['superadmin','app_domoprime_iso_meeting_view_documents_polluter_not_mandatory']])}
      {component name="/app_domoprime_iso/documentForViewMeeting" meeting=$meeting}             
      {component name="/app_domoprime_iso/quotationsForViewMeeting" meeting=$meeting}              
      {component name="/app_domoprime/billingsForViewMeeting" meeting=$meeting}        
      {else}
         {__('No polluter exists.')} 
      {/if}
 </fieldset>   
 
{component name="/customers_meetings_comments/listForViewMeeting" meeting=$meeting}    
