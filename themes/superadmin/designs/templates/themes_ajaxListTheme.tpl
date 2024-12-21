{component name="/site/info"}
{component name="/site/sublink"} 
<div id="actions">
    {include file="themes_ajaxListPartialTheme.tpl"}
</div>
<script type="text/javascript">        
     {JqueryScriptsReady}   
      // Other actions        
        $('.sublink').click(function() {  return $.ajax2({ url:this.id,target: "#middle"}); });

     {/JqueryScriptsReady}  
    
</script>