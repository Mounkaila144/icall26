<div>
    {foreach $actions->getComponents() as $component}
        {component name=$component server=$item}
    {/foreach}    
</div>    