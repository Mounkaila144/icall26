{messages class="errors"}
{if $formFilter->getCalendar()->isDayMode()}   
     {include file="./includes/schedule/_calendar_day.inc"}
{else}    
    {include file="./includes/schedule/_calendar_month.inc"}
{/if} 