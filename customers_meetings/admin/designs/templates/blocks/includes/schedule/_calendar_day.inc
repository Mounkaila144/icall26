<div>{__('Day')} {$formFilter->getCalendar()->getDate()}</div>   
 <table class="tab-calendar">        
 {foreach $formFilter->getCalendar()->getHours() as $time}
    <tr>        
        <td>{$time->getHour()}{__('H')}
        </td>   
         {foreach $formFilter->getCalendar()->getDays() as $day}
        <td>          
            {if $day->getScheduleTime($time->getTime())->hasMeeting()}
               {foreach $day->getScheduleTime($time->getTime())->getMeetings() as $meeting}
                 {*  {$meeting->getStatus()->getCustomerMeetingStatusI18n()->get('value')}  *}
                   <div id="{$meeting->get('id')}" class="Meetings">
                     {if $meeting->getStatus()->get('icon')} 
                        <img src="{$meeting->getStatus()->getIcon()->getURL()}" height="16" width="16" alt="{__('icon')}"/> 
                     {elseif $meeting->getStatus()->get('color')}
                     <span style="background:{$meeting->getStatus()->get('color')}; display:block; height:15px; width: 15px;">&nbsp;</span>                
                     {/if}  
                  {*  {$meeting->get('id')} *}
                     {$meeting->getCustomer()->getAddress()->get('city')}
                   </div>
               {/foreach}    
            {/if}    
        </td>       
        {/foreach}
    </tr>    
    {/foreach}   
</table>    