<style>
    .changes { border: 1px solid #b7b7b7; border-radius: 5px; padding: 5px; }
</style>
<div class="">
    {foreach $system_version->getVersions() as $key=>$version}
        <div class="" style="padding: 5px;">{*border-radius: 5px;border: 1px solid #ABA6A6; width: 20%;*}
            <a href="javascript:void(0);" title="{__($key)}" class="">{__("V %s",$key)}</a>
            <span>{$version->getDateVersion()}</span>
            <a href="javascript:void(0);" id="{$key}" class="linkVersion plus" title="{__($key)}" >+</a>
            <div id="details-{$key}" style="display: none;" class="changes">
                {foreach $version->getDetails() as $detail}
                    <div>
                        <span>{$detail@iteration}. {$detail->getChanges()}</span>{*->ucfirst()*}
                    </div>
                {/foreach}
            </div>
        </div>
    {/foreach}
</div>
  
<script type="text/javascript">

    $(".linkVersion").click(function(){
        $("div[id='details-"+$(this).attr('id')+"']").slideToggle();
        if($(this).hasClass("plus"))
        {
            $(this).text("-");
            $(this).removeClass("plus").addClass("minus");
        }
        else
        {
            $(this).text("+");
            $(this).removeClass("minus").addClass("plus");
        }
    });
 
</script>    