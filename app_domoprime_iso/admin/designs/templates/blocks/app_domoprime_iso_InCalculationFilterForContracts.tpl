{if $formFilter->in->hasValidator('energy_id')} 
   {* ===================== ENERGY ======================== *}  
   <div class="filter" id="energy">    
      <span class="filter-btn name-filter btn-table" id="energy">{__('Energy')}<i id="energy" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
      <div class="filter-content" id="energy">
    {foreach $formFilter->in.energy_id->getChoices() as $name=>$energy}
        <div>           
             {if $name}
                    <input type="checkbox" class="CustomerContracts-in energy" name="energy_id" id="{$energy->get('id')}" {if $formFilter.in.energy_id->getArray()->in($energy->get('id'))}checked="checked"{/if}/>{$energy}
             {else}
                 <input type="checkbox" class="CustomerContracts-in energy" name="energy_id" id="" {if $formFilter.in.energy_id->getArray()->in($energy)}checked="checked"{/if}/>{__('Empty')}
             {/if}
        </div>   
    {/foreach}  
      <input type="checkbox" class="CustomerContracts-in-select" name="energy"/>{__('Select/unselect all')}
      </div>
  </div>  
   {/if}  

   {if $formFilter->in->hasValidator('class_id')} 
   {* ===================== CLASS ======================== *}  
   <div class="filter" id="class">    
      <span class="filter-btn name-filter btn-table" id="class">{__('Class')}<i id="class" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
      <div class="filter-content" id="class">
    {foreach $formFilter->in.class_id->getChoices() as $name=>$class}
        <div>           
             {if $name}
                    <input type="checkbox" class="CustomerContracts-in class" name="class_id" id="{$class->get('id')}" {if $formFilter.in.class_id->getArray()->in($class->get('id'))}checked="checked"{/if}/>{$class}
             {else}
                 <input type="checkbox" class="CustomerContracts-in class" name="class_id" id="" {if $formFilter.in.class_id->getArray()->in($class)}checked="checked"{/if}/>{__('Empty')}
             {/if}
        </div>   
    {/foreach}  
      <input type="checkbox" class="CustomerContracts-in-select" name="class"/>{__('Select/unselect all')}
      </div>
  </div>  
   {/if}  
   
   {if $formFilter->in->hasValidator('sector_id')} 
   {* ===================== CLASS ======================== *}  
   <div class="filter" id="sector">    
      <span class="filter-btn name-filter btn-table" id="sector">{__('Sector')}<i id="sector" class="iconfont fa fa-sort-desc" style="margin-left: 10px;"></i></span>
      <div class="filter-content" id="sector">
    {foreach $formFilter->in.sector_id->getChoices() as $name=>$sector}
        <div>           
             {if $name}
                    <input type="checkbox" class="CustomerContracts-in sector" name="sector_id" id="{$sector->get('id')}" {if $formFilter.in.sector_id->getArray()->in($sector->get('id'))}checked="checked"{/if}/>{$sector}
             {else}
                 <input type="checkbox" class="CustomerContracts-in sector" name="sector_id" id="" {if $formFilter.in.sector_id->getArray()->in($sector)}checked="checked"{/if}/>{__('Empty')}
             {/if}
        </div>   
    {/foreach}  
      <input type="checkbox" class="CustomerContracts-in-select" name="sector"/>{__('Select/unselect all')}
      </div>
  </div>  
   {/if}