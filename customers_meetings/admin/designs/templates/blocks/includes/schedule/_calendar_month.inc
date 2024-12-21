
<table class="tab-calendar_m tabl-list footable table">    
    <thead>
    <tr class="header-day"> 
        <th>{* hours *}</th>
        {foreach $formFilter->getCalendar()->getDays() as $day}
            <th class="day" data-hide="phone" style="display: table-cell;">{__($day->getDayName())|capitalize}</th>
        {/foreach}
    </tr>
    </thead>
    <tbody>
    <tr class="header-month">              
        <td>{* hours *}</td>
            {foreach $formFilter->getCalendar()->getDays() as $day}                          
                <td>
                    <div>{$day->getDay()} {__($day->getMonthName())}</div>
                </td>                
            {/foreach}       
    </tr> 
     <tr class="header-meeting">              
        <td>{* hours *}</td>
            {foreach $formFilter->getCalendar()->getDays() as $day}                       
                <td>
                    {format_number_choice('[0]no meeting|[1]one meeting|(1,Inf]%s meetings',$day->getNumberOfMeetings(),$day->getNumberOfMeetings())}                  
                </td>               
            {/foreach}       
    </tr> 
    {foreach $formFilter->getCalendar()->getHours() as $time}
    <tr class="list-calendar">        
        <td>{$time->getHour()}{__('H')}
        </td>    
        {foreach $formFilter->getCalendar()->getDays() as $day}
        <td class="container"> 
         
            {if $day->getScheduleTime($time->getTime())->hasMeeting()}
               {foreach $day->getScheduleTime($time->getTime())->getMeetings() as $meeting}
                 {*  {$meeting->getStatus()->getCustomerMeetingStatusI18n()->get('value')}  *} 
                 <div id="{$meeting->get('id')}" class="Meetings meetting-block                  
                 {if $day->getScheduleTime($time->getTime())->getNumberOfMeetings()==2}md-meeting
                 {elseif $day->getScheduleTime($time->getTime())->getNumberOfMeetings()>2}small-meeting{/if}">
                     
                     {if $meeting->getStatus()->get('icon')} 
                        <img src="{$meeting->getStatus()->getIcon()->getURL()}" height="16" width="16" alt="{__('icon')}"/> 
                     {elseif $meeting->getStatus()->get('color')}
                     <span style="background:{$meeting->getStatus()->get('color')};float:left;margin-right:4px; display:block; height:15px; width: 15px;">&nbsp;</span>                
                     {/if}  
                  {*  {$meeting->get('id')} *}
                     {$meeting->getCustomer()->getAddress()->get('postcode')}
                     {$meeting->getCustomer()->getAddress()->get('city')}
          
                   </div>
               {/foreach}    
            {/if}  
        </td>       
        {/foreach}
    </tr>    
    {/foreach}  
</tbody>
</table>