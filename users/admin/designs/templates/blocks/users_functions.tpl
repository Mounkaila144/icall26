<span id="UserFunctions">
{foreach $functions_i18n as $function}{$function->get('value')}{if !$function@last},{/if}{/foreach}  
</span>    
<div id="Credentials" class="filter-content">
    <table>
    {foreach $user->getCredentials() as $credential}
        {if $credential@index % 4==0}<tr>{/if}
            <td>{__($credential,'','permissions')}</td>
        {if $credential@index % 4==4}</tr>{/if}
    {/foreach}    
    </table>
</div>
<script type="text/javascript">
    
  $(document).ready(function(){
        
        $("#UserFunctions").click(function(){ 
            $("#Credentials").show();
        });
  });
  
</script>  