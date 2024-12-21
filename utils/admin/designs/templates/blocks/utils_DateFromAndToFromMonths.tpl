
<span class="dropdown-select {$class}">
    <span> <a id="{$class}_show" href="#" class="{$class}" style="font-size: 12px"><i class="fa fa-calendar"/></a></span>
  <div class="dropdown-select-content {$class}">
        <ul>
            {foreach $months as $day}
                <li class="{$class}_select"  data-value='{$day->getFormattedStartAndEndDateOfMonth()->toJson()}'>{$day->getMonthNameI18n()->ucfirst()} {$day->getYear()}</li>            
            {/foreach}    
        </ul>        
  </div>
</span>

<script type="text/javascript">
   $(".dropdown-select.{$class}").click(function () {      
        $('.dropdown-select-content.{$class}').toggleClass('select-display-class');
    });
    
    $(".{$class}_select").click(function () {  
        $(this).parent('ul').parent('.dropdown-select-content').hide();      
       $("#{$from}").val($(this).data('value').from);
       $("#{$to}").val($(this).data('value').to);
    });
    

</script>    