{if $user->hasCredential([['superadmin','app_domoprime_contract_schedule_export']])} 
    <div>
 <a class="btn widthAFilter" target="_blank" href="{url_to('app_domoprime',['action'=>'ExportForInstallers'])}?{$formFilter->getParametersForUrl(['equal','in','begin','search','range','rangeOr','date_install','date_sav'])}" title="{__('Export')}" >      
     <div style="width:100px">
      <i class="fa fa-caret-square-o-down" style="margin-right: 10px"></i>{__('Export<br>for installers')}
     </div>
  </a>   
    </div>
{/if}