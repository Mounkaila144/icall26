{component name="/dashboard/sublink"} 
<div id="actions" style="font-size: 20px;">
    <div>
        <table class="table" style="width: 100%;">
            <tr>
                <th>
                    {__('Updates')}
                </th>
                <th>
                    {__('Install')}
                </th>
                <th>
                    {__('Uninstall')}
                </th>
            </tr>
            {foreach $updates as $update}
            <tr>
                <td>
                    {$update}
                </td>
                <td>
                    <a href="javascript:void(0);" class="InstallUpdate" style="" name="{$update}"> <i style="font-size: 15px;color: green;" class="fa fa-check-circle" aria-hidden="true"></i></a>
                </td>
                <td>
                    <a href="javascript:void(0);" class="UninstallUpdate" name="{$update}"> <i style="font-size: 15px;color: red;" class="fa fa-minus-circle" aria-hidden="true"></i></a>
                </td>
            </tr>
            {/foreach}
        </table>
    </div>
</div>
        
        
        
<script type="text/javascript">
    
    
</script>