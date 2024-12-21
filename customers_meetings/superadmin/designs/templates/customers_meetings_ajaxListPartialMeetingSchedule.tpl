{messages class="`$site->getSiteID()`-customers-planning-site-errors"}
{if !$formFilter->hasErrors()}
    {* ========== telepro ============ *}
    <div class="filter" id="telepro">   
        <span class="filter-btn name-filter btn-table" id="telepro">{__('Telepro')}<i id="telepro" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
        <div class="filter-content" id="telepro">
        {foreach $formFilter->in.telepro_id->getOption('choices') as $telepro}
            <div>
                <input type="checkbox" class="CustomerMeetingSchedule-in telepro" name="telepro_id" id="{$telepro->get('id')}" {if in_array($telepro->get('id'),(array)$formFilter.in.telepro_id->getValue())}checked="checked"{/if}/>{$telepro}
            </div>    
        {/foreach}    
        <input type="checkbox" class="CustomerMeetingSchedule-in" name="telepro"/>{__('Select/unselect all')}
        </div>
    </div>
    {* ========== sales ============ *}
    <div class="filter" id="sales">    
            <span class="filter-btn name-filter btn-table" id="sales">{__('Sales')}<i id="sales" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
            <div class="filter-content" id="sales">
        {foreach $formFilter->in.sales_id->getOption('choices') as $sale}
            <div>
                 <input type="checkbox" class="CustomerMeetingSchedule-in sales" name="sales_id" id="{$sale->get('id')}" {if in_array($sale->get('id'),(array)$formFilter.in.sales_id->getValue())}checked="checked"{/if}/>{if $sale->isLoaded()}{$sale}{else}{__('Empty')}{/if}
            </div>    
        {/foreach}  
          <input type="checkbox" class="CustomerMeetingSchedule-in" name="sales"/>{__('Select/unselect all')}
          </div>
    </div>
    {* ========== states ============ *}
    <div class="filter" id="sales">    
            <span class="filter-btn name-filter btn-table" id="states">{__('States')}<i id="states" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
            <div class="filter-content" id="states">
        {foreach $formFilter->in.state_id->getOption('choices') as $state}
            <div>
                 <input type="checkbox" class="CustomerMeetingSchedule-in states" name="state_id" id="{$state->get('status_id')}" {if in_array($state->get('status_id'),(array)$formFilter.in.state_id->getValue())}checked="checked"{/if}/>{if $state->isLoaded()}{$state->get('value')}{else}{__('Empty')}{/if}
            </div>    
        {/foreach}  
          <input type="checkbox" class="CustomerMeetingSchedule-in" name="states"/>{__('Select/unselect all')}
          </div>
    </div>
    <div style="clear: both"></div>          
    {* ========== Date ============ *}
    <div>{__('date')}<input type="text" id="{$site->getSiteID()}-date_in" name="date_in" value="{$formFilter->getDate()}"/>
        <a href="#" id="{$site->getSiteID()}-Filter">{__('Filter')}</a>
    </div>
    <div>
        {if $formFilter->getCalendar()->isDayMode()}  
        <a href="#" id="{$site->getSiteID()}-ModeWeek">{__('Week')}</a>
        {else}
        <a href="#" id="{$site->getSiteID()}-ModeDay">{__('Day')}</a>         
        {/if}        
    </div> 
    <div>
         <a href="#" id="{$site->getSiteID()}-Down"><<<</a>         
         {__('Week')} {$formFilter->getCalendar()->getDate()->getWeekNumber()}    
         <a href="#" id="{$site->getSiteID()}-Up">>>>></a>
     </div>   
     <div>{format_number_choice('[0]no meeting|[1]one meeting|(1,Inf]%s meetings',$formFilter->getNumberOfMeetings(),$formFilter->getNumberOfMeetings())}                  </div>   

        {if $formFilter->getCalendar()->isDayMode()}   
             {include file="./blocks/includes/schedule/_calendar_day.inc"}
        {else}    
            {include file="./blocks/includes/schedule/_calendar_month.inc"}
        {/if}
{else}
    <span>{__('Error')}</span>
{/if}    

<script type="text/javascript">
    {JqueryScriptsReady}
        
    {/JqueryScriptsReady}
        
        function getMeetingScheduleFilterParameters()
        {
           var params={ filter: {     
                                     date_in: $("#{$site->getSiteID()}-date_in").val(),
                                     mode : "{$formFilter.mode}",
                                     in : {  telepro_id: [],sales_id: [],state_id: [] },                                    
                                     token:'{$formFilter->getCSRFToken()}'
                                  }};                 
            $(".CustomerMeetingSchedule-in[name=telepro_id]:checked").each(function() { params.filter.in[this.name].push($(this).attr('id')); }); 
            $(".CustomerMeetingSchedule-in[name=sales_id]:checked").each(function() { params.filter.in[this.name].push($(this).attr('id')); }); 
            $(".CustomerMeetingSchedule-in[name=state_id]:checked").each(function() { params.filter.in[this.name].push($(this).attr('id')); });            
          //  alert("params="+params.toSource())
            return params;                  
        }
        
        $("#{$site->getSiteID()}-date_in").datepicker();
        
        $("#{$site->getSiteID()}-Down").click(function() { $.ajax2({ 
                data: {   filter : {                
                                date_in: "{$formFilter->getDate()}",
                                action : "DOWN",
                                mode : "{$formFilter.mode}",
                                token:'{$formFilter->getCSRFToken()}'
                            }
                },
                url:"{url_to('customers_meeting_ajax',['action'=>'ListPartialMeetingSchedule'])}",
                errorTarget: ".{$site->getSiteID()}-customers-planning-site-errors",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-planning-loading",
                target: "#tab-site-panel-{$site->getSiteID()}-dashboard-site-customers-planning-base"}); 
        }); 
        
        $("#{$site->getSiteID()}-Up").click(function() { $.ajax2({ 
                data: {   filter : {                
                          date_in: "{$formFilter->getDate()}",
                          action : "UP",
                          mode : "{$formFilter.mode}",
                          token:'{$formFilter->getCSRFToken()}' }
                },
                url:"{url_to('customers_meeting_ajax',['action'=>'ListPartialMeetingSchedule'])}",
                errorTarget: ".{$site->getSiteID()}-customers-planning-site-errors",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-planning-loading",
                target: "#tab-site-panel-{$site->getSiteID()}-dashboard-site-customers-planning-base"}); 
        }); 
        
         $("#{$site->getSiteID()}-ModeDay").click(function() { $.ajax2({ 
                data: {   filter : {                
                          date_in: "{$formFilter->getDate()}",                         
                          mode : "DAY",
                          token:'{$formFilter->getCSRFToken()}' }
                },
                url:"{url_to('customers_meeting_ajax',['action'=>'ListPartialMeetingSchedule'])}",
                errorTarget: ".{$site->getSiteID()}-customers-planning-site-errors",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-planning-loading",
                target: "#tab-site-panel-{$site->getSiteID()}-dashboard-site-customers-planning-base"}); 
        }); 
        
          $("#{$site->getSiteID()}-ModeWeek").click(function() { $.ajax2({ 
                data: {   filter : {                
                          date_in: "{$formFilter->getDate()}",                         
                          mode : "WEEK",
                          token:'{$formFilter->getCSRFToken()}' }
                },
                url:"{url_to('customers_meeting_ajax',['action'=>'ListPartialMeetingSchedule'])}",
                errorTarget: ".{$site->getSiteID()}-customers-planning-site-errors",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-planning-loading",
                target: "#tab-site-panel-{$site->getSiteID()}-dashboard-site-customers-planning-base"}); 
        }); 
        
         $("#{$site->getSiteID()}-Filter").click(function() { $.ajax2({ 
                data: getMeetingScheduleFilterParameters(),
                url:"{url_to('customers_meeting_ajax',['action'=>'ListPartialMeetingSchedule'])}",
                errorTarget: ".{$site->getSiteID()}-customers-planning-site-errors",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-planning-loading",
                target: "#tab-site-panel-{$site->getSiteID()}-dashboard-site-customers-planning-base"}); 
        }); 
        
        
         $(".filter-btn").click(function() {   
            $('.filter-content[id='+$(this).attr('id')+"]").slideToggle();            
            $('.iconfont[id='+$(this).attr('id')+"]").toggleClass('fa fa-sort-desc fa fa-sort-asc');
        });

        $('.filter-content').mouseleave( function() { $('.filter-content').hide();} );
</script>    