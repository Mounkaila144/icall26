<div class="col-sm-6">
{if $error}<!-- Error from google: {$error} -->{/if} 
<a href="{if $auth_url}{$auth_url}{else}#{/if}" target="{$target}">
<button type="button" class="btn btn-sm btn-icon btn-icon-left btn-social-with-text btn-google-plus text-white waves-effect waves-light">
    <i class="ico fa fa-google-plus"></i>{__('Google')}
</button>
</a>
</div>