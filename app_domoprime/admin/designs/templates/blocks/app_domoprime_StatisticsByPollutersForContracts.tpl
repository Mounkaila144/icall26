 <h4>
<table>   
{foreach $polluters as $polluter}
    <tr>      
        <td>
            {if $polluter->isNotloaded()}{__('Not defined')}{else}{$polluter->get('name')|upper}{/if}
        </td>       
        <td>
             {__('Number of operations')}:<span style="color:#00ff00;">101:
             </span>{$polluter->getOperations()->getTotalTop()},
             <span style="color:#00ff00;">102:</span>{$polluter->getOperations()->getTotalWall()},
             <span style="color:#00ff00;">103:</span>{$polluter->getOperations()->getTotalFloor()}
             &nbsp;&nbsp;&nbsp;
             {__('Surfaces')}: 
             <span style="color:#00ff00;">101:</span>{$polluter->getSurfaces()->getSurfaceTop()} m², 
             <span style="color:#00ff00;">102:</span>{$polluter->getSurfaces()->getSurfaceWall()} m², 
             <span style="color:#00ff00;">103:</span>{$polluter->getSurfaces()->getSurfaceFloor()} m²  
             &nbsp;&nbsp;&nbsp;
             {__('Cumacs')} 
             <span style="color:#00ff00;">101:</span>{$polluter->getCumacs()->getTop()}, 
             <span style="color:#00ff00;">102:</span>{$polluter->getCumacs()->getWall()} , 
             <span style="color:#00ff00;">103:</span>{$polluter->getCumacs()->getFloor()}  
        </td>         
    </tr>    
{/foreach}    
</table>
 </h4>