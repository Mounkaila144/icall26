<div>
    <div id="Debug-Dialog-{$microtime}" title="{__('Debug')}" style="display:none;">
        
    {if !$messages->isEmpty()}
        {foreach $messages as $message}
            <div>
                {$message@iteration}:{$message}
            </div>
            <hr>
        {/foreach}    
    {else}
        {__('No message')}
    {/if}   
    </div>
    

    <div><a href="#" id="Debug-Display-{$microtime}">+</a>
    </div>   
    <script type="text/javascript">
       
           
            if ($("[aria-describedby=Debug-Dialog-{$microtime}]").length)
                $("[aria-describedby=Debug-Dialog-{$microtime}]").remove();
            
            $("#Debug-Dialog-{$microtime}").dialog( {  autoOpen: false,  height: 'auto', width: '100%', modal: true });  
             
            $("#Debug-Display-{$microtime}").click(function () { 
                  $("#Debug-Dialog-{$microtime}").dialog('open'); 
                  $(this).show();
            });
     
    </script>
</div>