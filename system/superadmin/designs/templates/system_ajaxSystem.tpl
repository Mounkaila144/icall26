{component name="/dashboard/sublink"} 
{messages class="site-errors"}
 <fieldset>   
     <h3>{__('System')}</h3>
     <table cellspacing="0" width="25%">
         <tr>
             <td>
                 {__('Post Max size')}
             </td>
             <td>
                 {format_size($config->getPostMaxSize())}
             </td>
            <td>
                 {__('Max Execution Time')}
             </td>
             <td>
                {$config->getMaxExecutionTime()} s
             </td>
         </tr>           
          <tr>
             <td>
                 {__('Max File Uploads')}
             </td>
             <td>
                {$config->getMaxFileUploads()} 
             </td>        
             <td>
                 {__('Memory limit')}
             </td>
             <td>
                {$config->getMemoryLimit()} 
             </td>
         </tr>  
         <tr>
             <td>
                 {__('File uploads')}
             </td>
             <td>
                {$config->getFileUploads()} 
             </td>        
             <td>
                 
             </td>
             <td>
                
             </td>
         </tr>
     </table>
</fieldset>
 
           