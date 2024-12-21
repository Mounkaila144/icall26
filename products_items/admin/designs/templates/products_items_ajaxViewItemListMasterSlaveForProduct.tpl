<div style="height: 108vh;">
{messages class="ProductItems-errors"}
<h3>{__("View slaves for master [%s]",$form->getMaster()->get('reference'))}</h3>
<div>
    <a href="javascript:void(0);" id="ProductItems-Save" class="btn" style="display:none">
         <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="javascript:void(0);" id="ProductItems-Cancel" class="btn">
        <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>
{if $form->getMaster()->isLoaded()}        
    
            <div data-index="master" class="MasterItems " style="border:1px #C7F28F solid;">
                <h3 class="fieldset-title font-weight-bold"  style="background: #C7F28F;" > {$form->getMaster()->get('reference')}</h3>           
                <div class="row m-0 p-0 tab-form border-0 text-center ">
                     <span class="col-md-1"  > </span>
                        <div class="form-group col-md-3 m-0">
                                <label><span>{__("reference for display")|UPPER}{if $form->reference->getOption('required')}*{/if} </span></label>


                       </div>
                        {if $form->hasValidator('sale_price')}
                          <div class="form-group col-md-1 m-0">
                             <label>{__("Sale Price")|UPPER}{if $form->sale_price->getOption('required')}*{/if} </label>
                          </div>
                        {/if}
                        {if $form->hasValidator('tva_id')}
                            <div class="form-group col-md-1 m-0">
                                <label>{__("Tax")|UPPER}{if $form->tva_id->getOption('required')}*{/if} </label>
                            </div>
                        {/if}
                        <div class="form-group col-md-4 m-0">
                         <label>{__("Description")|UPPER}{if $form->description->getOption('required')}*{/if}</label>
                        </div> 
                         <div class="form-group col-md-2 m-0">

                        </div> 
                        <div class="form-group col-md-1 m-0">
                             <label>{__('ID master')}</label>                     
                        </div> 

                </div>
            <div  class="d-flex">       
              <fieldset class="tab-form bg-white row m-0 my-1 p-0 pt-2 ">

                 <span class="col-md-1 text-info text-right ProductItemsMaster ID" data-name="id" data-id="{$form->getMaster()->get('id')}" >{$form->getMaster()->get('id')}</span>
                    <div class="form-group col-md-3 ">

                             <div class="error-form">{$form.reference->getError()}</div>               
                              <input type="text" class="ProductItemsMaster Input form-control" name="reference" size="48" value="{if $form->hasErrors()}{$form.reference}{else}{$form->getMaster()->get('reference')}{/if}"/> 

                    </div>
                    {if $form->hasValidator('sale_price')}
                       <div class="form-group col-md-1">
                              <div class="error-form">{$form.sale_price->getError()}</div> 
                               <input type="text" class="ProductItemsMaster Input form-control w-100" name="sale_price" size="48" value="{if $form->hasErrors()}{$form.sale_price}{else}{$form->getMaster()->getFormatter()->getSalePrice()->getText('#.0000')}{/if}"/> 
 
                       </div>
                    {/if}
                    {if $form->hasValidator('tva_id')}
                       <div class="form-group col-md-1 ">                          
                              <div class="error-form">{$form.tva_id->getError()}</div> 
                                <select class="ProductItemsMaster Select form-control w-100" data-index="{$index}" name="tva_id">
                                    {foreach $form->tva_id->getOption('choices') as $key=>$tva}
                                      <option value="{$key}" {if $key=$form->getMaster()->get('tva_id')}selected=""{/if}>
                                          {$tva}
                                      </option>
                                    {/foreach}
                                </select>
{*                              {html_options class="ProductItemsMaster Select" name="tva_id" options=$form->tva_id->getOption('choices') selected=(string)$form->getMaster()->get('tva_id')}*}

                       </div>
                    {/if}
                    <div class="form-group col-md-4">
                          <div class="error-form">{$form.description->getError()}</div> 
                          <textarea  class="ProductItemsMaster Textarea w-100" cols="60" rows="1" name="description" >{if $form->hasErrors()}{$form.description}{else}{$form->getMaster()->get('description')}{/if}</textarea>               
                    </div> 
                    <div class="right-actions d-block text-info col-md-1">
{*                        <input data-index="master" class="ProductItems Checkbox" type="checkbox" id="is_master" name="is_master" value="YES">*}
                         <a data-index="master" id="{$form->getMaster()->get('id')}" class="ShowMasterItemDetails font-weight-bold" href="javascript:void(0);" ><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                         <a data-index="master" id="{$form->getMaster()->get('id')}" class="AddItemsForMaster font-weight-bold" href="javascript:void(0);" ><i class="fa fa-sitemap" aria-hidden="true"></i></a>
{*                         <a data-index="master" id="{$form->getMaster()->get('id')}" class="AddItem font-weight-bold" href="javascript:void(0);" ><i class="fa fa-plus" aria-hidden="true"></i></a>*}
{*                         <a data-index="master" id="{$form->getMaster()->get('id')}" class="DeleteItem font-weight-bold" href="javascript:void(0);" ><i class="fa fa-trash"></i></a>*}
                    </div> 
                     <div class="col-md-1">
                         {$form->getMaster()->get('id')}<span style="font-size: 12px"> ({$form->getMaster()})</span>
                     </div>  
                     <div class="col-12 row  MasterItem" data-index="master" style="margin:0;padding: 0;">
                     <div class="form-group col-md-4 toHide">
                         <label><span>{__("reference for document")|UPPER}{if $form->input1->getOption('required')}*{/if} </span></label>

                             <div class="error-form">{$form.input1->getError()}</div>               
                              <input type="text" class="ProductItemsMaster Input form-control" name="input1" size="48" value="{if $form->hasErrors()}{$form.input1}{else}{$form->getMaster()->get('input1')}{/if}"/> 

                      </div>     
                     {if $form->hasValidator('mark')}
                      <div class="form-group col-md-4 toHide">
                          <label>{__("Mark Item")|UPPER}{if $form->mark->getOption('required')}*{/if} </label>

                             <div class="error-form">{$form.mark->getError()}</div> 
                              <input type="text" title="isolation des combles : *Marque(s) :  - mark &#10 isolation des murs : *Marque(s) :  - mark &#10 Vide sanitaire et passage ouvert ou plancher bas : *Marque(s) :  - mark &#10 chaudiere : *Marque :  - mark &#10 chaudiere : *Référence :  - mark &#10 pac : *Marque :  - mark &#10 ballon : *Marque :  - mark" class="ProductItemsMaster Input form-control" name="mark" size="48" value="{if $form->hasErrors()}{$form.mark}{else}{$form->getMaster()->get('mark')}{/if}"/> 

                      </div>
                     {/if}
                     <div class="form-group col-md-4 toHide">
                         <label><span>{__("Input form-control2 Item")|UPPER}{if $form->input2->getOption('required')}*{/if} </span></label>

                             <div class="error-form">{$form.input2->getError()}</div>               
                              <input type="text" class="ProductItemsMaster Input form-control" title="chaudiere : *Classe du régulateur : - imput2" name="input2" size="48" value="{if $form->hasErrors()}{$form.input2}{else}{$form->getMaster()->get('input2')}{/if}"/> 

                      </div>   
                      {if $form->hasValidator('discount_price')}
                       <div class="form-group col-md-4 toHide">
                          <label>{__("Discount Price")|UPPER}{if $form->discount_price->getOption('required')}*{/if} </label>

                              <div class="error-form">{$form.discount_price->getError()}</div> 
                               <input type="text" class="ProductItemsMaster Input form-control" name="discount_price" size="48" value="{if $form->hasErrors()}{$form.discount_price}{else}{$form->getMaster()->getFormatter()->getDiscountPrice()->getText('#.0000')}{/if}"/> 

                       </div>
                      {/if}

                       {if $form->hasValidator('purchasing_price')}
                      <div class="form-group col-md-4 toHide">
                          <label>{__("Purchasing price")|UPPER}{if $form->purchasing_price->getOption('required')}*{/if} </label>

                              <div class="error-form">{$form.purchasing_price->getError()}</div> 
                               <input type="text" class="ProductItemsMaster Input form-control" name="purchasing_price" size="48" value="{if $form->hasErrors()}{$form['purchasing_price']}{else}{$form->getMaster()->getFormatter()->getPurchasingPrice()->getText('#.0000')}{/if}"/> 

                       </div>
                      {/if}                
                       {if $form->hasValidator('unit')}
                       <div class="form-group col-md-4 toHide">
                          <label>{__("Unit")|UPPER}{if $form->unit->getOption('required')}*{/if} </label>

                                <div class="error-form">{$form.unit->getError()}</div> 
                                <select class="ProductItemsMaster Select" data-index="{$index}" name="unit">
                                    {foreach $form->unit->getOption('choices')->toArray() as $key=>$unit}
                                      <option value="{$key}" {if $key=$form->getMaster()->get('unit')}selected=""{/if}>
                                          {$unit}
                                      </option>
                                    {/foreach}
                                </select>
{*                              {html_options class="ProductItemsMaster Select" name="unit" options=$form->unit->getOption('choices')->toArray() selected=(string)$form->getMaster()->get('unit')}*}

                       </div>
                      {/if}
                       {if $form->hasValidator('coefficient')}
                      <div class="form-group col-md-4 toHide">
                          <label>{__("Coefficient")|UPPER}{if $form->coefficient->getOption('required')}*{/if} </label>

                              <div class="error-form">{$form.coefficient->getError()}</div> 
                              <input type="text" class="ProductItemsMaster Input form-control" name="coefficient" size="48" value="{if $form->hasErrors()}{$form['coefficient']}{else}{$form->getMaster()->getFormatter()->getCoefficient()->getPourcentage()}{/if}"/> 

                       </div>
                      {/if}
                      {if $form->hasValidator('is_mandatory')}
                      <div class="form-group col-md-4 toHide">
                          <label>{__("Mandatory ?")|UPPER}</label>

                              <div class="error-form">{$form.is_mandatory->getError()}</div> 
                              <input type="checkbox" class="ProductItemsMaster Checkbox" name="is_mandatory"  {if  $form->hasValidator('is_mandatory')=='YES'}checked=""{/if}/> 

                       </div>
                      {/if}
                       {if $form->hasValidator('linked_id')}
                      <div class="form-group col-md-4 toHide">
                          <label>{__("Link")|UPPER}</label>

                              <div class="error-form">{$form.linked_id->getError()}</div> 
                              <select class="ProductItemsMaster Select" data-index="{$index}" name="linked_id">
                                  {foreach $form->linked_id->getChoices()->toArray() as $key=>$linked}
                                  <option value="{$key}" {if $key=$form->getMaster()->get('linked_id')}selected=""{/if}>
                                      {$linked}
                                  </option>
                                  {/foreach}
                              </select>
{*                          {html_options class="ProductItemsMaster Select" name="linked_id" options=$form->linked_id->getChoices()->toArray() selected=(string)$form->getMaster()->get('linked_id')}*}

                       </div>
                      {/if}
                        {if $form->hasValidator('thickness')}
                      <div class="form-group col-md-4 toHide">
                           <td class="label" >{__("Thickness")|UPPER}{if $form->thickness->getOption('required')}*{/if} </label>

                              <div class="error-form">{$form.thickness->getError()}</div> 
                               <input type="text" title="isolation des combles : *Épaisseur (mm) :  - tchickness &#10 isolation des murs : *Épaisseur (mm) :  - tchickness &#10 Vide sanitaire et passage ouvert ou plancher bas : *Epaisseur (mm) :  - tchickness" class="ProductItemsMaster Input form-control" name="thickness" size="48" value="{if $form->hasErrors()}{$form['coefficient']}{else}{$form->getMaster()->getFormatter()->getThickness()->getText()}{/if}"/> 

                       </div>
                      {/if}


                     {if $form->hasValidator('input3')}
                         <div class="form-group col-md-4 toHide">
                             <label>{__("Input form-control3")|UPPER}{if $form->input3->getOption('required')}*{/if} </label>

                                 <div class="error-form">{$form.input3->getError()}</div> 
                                 <textarea cols="60" rows="1" class="ProductItemsMaster Textarea" title="isolation des combles : *Résistance thermique : R (m²K/W) :  - input3 &#10 isolation des murs : *Résistance thermique : R (m²K/W) :  - input3 &#10 Vide sanitaire et passage ouvert ou plancher bas : *Résistance thermique : R (m²K/W) :  - input3 &#10 chaudiere : *Efficacité énergétique saisonnière (ηs) (en %) : - input3 &#10 pac : *Efficacité énergétique saisonnière (ηs) (en %) :  - input3 &#10 ballon : *COP :  - input3" name="input3" >{if $form->hasErrors()}{$form['input3']}{else}{$form->getMaster()->get('input3')}{/if}</textarea>

                          </div>
                     {/if}              
                       <div class="form-group col-md-4 toHide">
                          <td class="label" >{__("Content Item")|UPPER}{if $form->content->getOption('required')}*{/if} </label>

                              <div class="error-form">{$form.content->getError()}</div> 
                                <textarea   title="isolation des combles : *Référence(s) :  - content &#10 isolation des murs : *Référence(s) :  - content &#10 Vide sanitaire et passage ouvert ou plancher bas : *Référence(s) :  - content &#10 chaudiere : *Référence :  - content &#10 pac : *Référence :  - content &#10 ballon : *Référence :  - content" class="ProductItemsMaster Textarea" cols="60" rows="1" name="content">{if $form->hasErrors()}{$form['content']}{else}{$form->getMaster()->get('content')}{/if}</textarea>

                       </div>
                       <div class="form-group col-md-4 toHide">
                          <label>{__("Acermi")|UPPER}{if $form->details->getOption('required')}*{/if} </label>

                              <div class="error-form">{$form.details->getError()}</div> 
                                <textarea  class="ProductItemsMaster Textarea" title="chaudiere : *Marque :  - details" cols="60" rows="1" name="details">{if $form->hasErrors()}{$form['details']}{else}{$form->getMaster()->get('details')}{/if}</textarea>

                       </div>
                     </div>
              </fieldset>

                </div>
             </div>  
    
    
    
    
   {foreach $form->getSlaves()->byIndex() as $index=>$item}   

        <span>#{$index}</span>
            <div data-index="{$index}" class="Items " >
                <h3 class="fieldset-title font-weight-bold"  > {$form->getSlaves()->byIndex()->getItemByKey($index)->get('reference')}</h3>           
                <div class="row m-0 p-0 tab-form border-0 text-center ">
                     <span class="col-md-1"  > </span>
                        <div class="form-group col-md-3 m-0">
                                <label><span>{__("reference for display")|UPPER}{if $form->items[$index]['reference']->getOption('required')}*{/if} </span></label>
                       </div>
                        {if $form->items[$index]->hasValidator('sale_price')}
                          <div class="form-group col-md-1 m-0">
                             <label>{__("Sale Price")|UPPER}{if $form->items[$index]['sale_price']->getOption('required')}*{/if} </label>
                          </div>
                        {/if}
                        {if $form->items[$index]->hasValidator('tva_id')}
                            <div class="form-group col-md-1 m-0">
                                <label>{__("Tax")|UPPER}{if $form->items[$index]['tva_id']->getOption('required')}*{/if} </label>
                            </div>
                        {/if}
                        <div class="form-group col-md-4 m-0">
                         <label>{__("Description")|UPPER}{if $form->items[$index]['description']->getOption('required')}*{/if}</label>
                        </div> 
                         <div class="form-group col-md-2 m-0">

                        </div> 
                        <div class="form-group col-md-1 m-0">
                             <label>{__('ID master')}</label>                     
                        </div> 

                </div>
            <div  class="d-flex">       
              <fieldset class="tab-form bg-white row m-0 my-1 p-0 pt-2 ">

                 <span class="col-md-1 text-info text-right ProductItemsSlave ID" data-name="id" data-index="{$index}" data-id="{$form->getSlaves()->byIndex()->getItemByKey($index)->get('id')}" >{$form->getSlaves()->byIndex()->getItemByKey($index)->get('id')}</span>
                    <div class="form-group col-md-3 ">

                             <div class="error-form">{$form.items[$index].reference->getError()}</div>               
                              <input type="text" class="ProductItemsSlave Input form-control" data-index="{$index}" name="reference" size="48" value="{if $form->hasErrors()}{$form.items[$index].reference}{else}{$form->getSlaves()->byIndex()->getItemByKey($index)->get('reference')}{/if}"/> 

                    </div>
                    {if $form->items[$index]->hasValidator('sale_price')}
                       <div class="form-group col-md-1">
                              <div class="error-form">{$form.items[$index].sale_price->getError()}</div> 
                               <input type="text" class="ProductItemsSlave Input form-control w-100" data-index="{$index}" name="sale_price" size="48" value="{if $form->hasErrors()}{$form.items[$index].sale_price}{else}{$form->getSlaves()->byIndex()->getItemByKey($index)->getFormatter()->getSalePrice()->getText('#.0000')}{/if}"/> 
                       </div>
                    {/if}
                    {if $form->items[$index]->hasValidator('tva_id')}
                        <div class="form-group col-md-1">                           
                                <div class="error-form">{$form['items'][$index].tva_id->getError()}</div> 
                                <select class="ProductItemsSlave Select form-control w-100" data-index="{$index}" name="tva_id">
                                    {foreach $form->items[$index]['tva_id']->getOption('choices') as $key=>$tva}
                                        <option value="{$key}" {if $key==$form->getSlaves()->byIndex()->getItemByKey($index)->get('tva_id')}selected=""{/if}>
                                            {$tva}
                                        </option>
                                    {/foreach}
                                </select>
{*                               {html_options class="ProductItemsSlave Select" data-index="" name="tva_id" options=$form->items[$index]['tva_id']->getOption('choices') selected=(string)$form->getSlaves()->byIndex()->getItemByKey($index)->get('tva_id')}*}
                        </div>
                    {/if}
                    <div class="form-group col-md-4">
                          <div class="error-form">{$form.items[$index].description->getError()}</div> 
                          <textarea  class="ProductItemsSlave Textarea w-100" data-index="{$index}" cols="60" rows="1" name="description" >{if $form->hasErrors()}{$form.items[$index].description}{else}{$form->getSlaves()->byIndex()->getItemByKey($index)->get('description')}{/if}</textarea>               
                    </div> 
                    <div class="right-actions d-block text-info col-md-1">
{*                        <input data-index="{$index}" class="ProductItemsSlave Checkbox" data-index="{$index}" type="checkbox" id="is_master" name="is_master" value="YES">*}
{*                         <a data-index="{$index}" id="{$form->getSlaves()->byIndex()->getItemByKey($index)->get('id')}" class="ShowItemDetails font-weight-bold" href="javascript:void(0);" ><i class="fa fa-info-circle" aria-hidden="true"></i></a>*}
                         <a data-index="{$index}" id="{$form->getSlaves()->byIndex()->getItemByKey($index)->get('id')}" class="AddItem font-weight-bold" href="javascript:void(0);" ><i class="fa fa-plus" aria-hidden="true"></i></a>
                         {if !$item@first}<a data-index="{$index}" id="{$form->getSlaves()->byIndex()->getItemByKey($index)->get('id')}" class="DeleteItem font-weight-bold" href="javascript:void(0);" ><i class="fa fa-trash"></i></a>{/if}
                    </div>  
                     <div class="col-md-1">
                             {$item->getMasters()->getKeys()}
                     </div>  
                     {*<div class="form-group col-md-4 toHide">
                         <label><span>{__("reference for document")|UPPER}{if $form->items[$index]['input1']->getOption('required')}*{/if} </span></label>

                             <div class="error-form">{$form.items[$index].input1->getError()}</div>               
                              <input type="text" class="ProductItemsSlave Input form-control" data-index="{$index}" name="input1" size="48" value="{if $form->hasErrors()}{$form.items[$index].input1}{else}{$form->getSlaves()->byIndex()->getItemByKey($index)->get('input1')}{/if}"/> 

                      </div>     
                     {if $form->items[$index]->hasValidator('mark')}
                      <div class="form-group col-md-4 toHide">
                          <label>{__("Mark Item")|UPPER}{if $form->items[$index]['mark']->getOption('required')}*{/if} </label>

                             <div class="error-form">{$form.items[$index].mark->getError()}</div> 
                              <input type="text" data-index="{$index}" title="isolation des combles : *Marque(s) :  - mark &#10 isolation des murs : *Marque(s) :  - mark &#10 Vide sanitaire et passage ouvert ou plancher bas : *Marque(s) :  - mark &#10 chaudiere : *Marque :  - mark &#10 chaudiere : *Référence :  - mark &#10 pac : *Marque :  - mark &#10 ballon : *Marque :  - mark" class="ProductItemsSlave Input form-control" name="mark" size="48" value="{if $form->hasErrors()}{$form.items[$index].mark}{else}{$form->getSlaves()->byIndex()->getItemByKey($index)->get('mark')}{/if}"/> 

                      </div>
                     {/if}
                     <div class="form-group col-md-4 toHide">
                         <label><span>{__("Input form-control2 Item")|UPPER}{if $form->items[$index]['input2']->getOption('required')}*{/if} </span></label>

                             <div class="error-form">{$form.items[$index].input2->getError()}</div>               
                              <input type="text" data-index="{$index}" class="ProductItemsSlave Input form-control" title="chaudiere : *Classe du régulateur : - imput2" name="input2" size="48" value="{if $form->hasErrors()}{$form.items[$index].input2}{else}{$form->getSlaves()->byIndex()->getItemByKey($index)->get('input2')}{/if}"/> 

                      </div>   
                      {if $form->items[$index]->hasValidator('discount_price')}
                       <div class="form-group col-md-4 toHide">
                          <label>{__("Discount Price")|UPPER}{if $form->items[$index]['discount_price']->getOption('required')}*{/if} </label>

                              <div class="error-form">{$form.items[$index].discount_price->getError()}</div> 
                               <input type="text" data-index="{$index}" class="ProductItemsSlave Input form-control" name="discount_price" size="48" value="{if $form->hasErrors()}{$form.items[$index].discount_price}{else}{$form->getSlaves()->byIndex()->getItemByKey($index)->getFormatter()->getDiscountPrice()->getText('#.0000')}{/if}"/> 

                       </div>
                      {/if}

                       {if $form->items[$index]->hasValidator('purchasing_price')}
                      <div class="form-group col-md-4 toHide">
                          <label>{__("Purchasing price")|UPPER}{if $form->items[$index]['purchasing_price']->getOption('required')}*{/if} </label>

                              <div class="error-form">{$form.items[$index].purchasing_price->getError()}</div> 
                               <input type="text" data-index="{$index}" class="ProductItemsSlave Input form-control" name="purchasing_price" size="48" value="{if $form->hasErrors()}{$form['items'][$index]['purchasing_price']}{else}{$form->getSlaves()->byIndex()->getItemByKey($index)->getFormatter()->getPurchasingPrice()->getText('#.0000')}{/if}"/> 

                       </div>
                      {/if}                
                       {if $form->items[$index]->hasValidator('unit')}
                       <div class="form-group col-md-4 toHide">
                          <label>{__("Unit")|UPPER}{if $form->items[$index]['unit']->getOption('required')}*{/if} </label>

                              <div class="error-form">{$form.items[$index].unit->getError()}</div> 
                              <select class="ProductItemsSlave Select" data-index="{$index}" name="unit">
                                  {foreach $form->items[$index]['unit']->getOption('choices')->toArray() as $key=>$unit}
                                    <option value="{$key}" {if $key==$form->getSlaves()->byIndex()->getItemByKey($index)->get('unit')}selected="" {/if}>
                                        {$unit}
                                    </option>
                                  {/foreach}
                              </select>
{*                              {html_options class="ProductItemsSlave Select" name="unit" options=$form->items[$index]['unit']->getOption('choices')->toArray() selected=(string)$form->getSlaves()->byIndex()->getItemByKey($index)->get('unit')}*}

                      {* </div>
                      {/if}
                       {if $form->items[$index]->hasValidator('coefficient')}
                        <div class="form-group col-md-4 toHide">
                            <label>{__("Coefficient")|UPPER}{if $form->items[$index]['coefficient']->getOption('required')}*{/if} </label>

                                <div class="error-form">{$form.items[$index].coefficient->getError()}</div> 
                                <input type="text" class="ProductItemsSlave Input form-control" name="coefficient" size="48" value="{if $form->hasErrors()}{$form['items'][$index]['coefficient']}{else}{$form->getSlaves()->byIndex()->getItemByKey($index)->getFormatter()->getCoefficient()->getPourcentage()}{/if}"/> 

                         </div>
                      {/if}
                      {if $form->items[$index]->hasValidator('is_mandatory')}
                      <div class="form-group col-md-4 toHide">
                          <label>{__("Mandatory ?")|UPPER}</label>

                              <div class="error-form">{$form.items[$index].is_mandatory->getError()}</div> 
                              <input type="checkbox" class="ProductItemsSlave Checkbox" name="is_mandatory"  {if  $form->items[$index]->hasValidator('is_mandatory')=='YES'}checked=""{/if}/> 

                       </div>
                      {/if}
                       {if $form->items[$index]->hasValidator('linked_id')}
                      <div class="form-group col-md-4 toHide">
                          <label>{__("Link")|UPPER}</label>

                              <div class="error-form">{$form.items[$index].linked_id->getError()}</div> 
                              <select class="ProductItemsSlave Select" data-index="{$index}" name="linked_id">
                                  {foreach $form->items[$index]['linked_id']->getChoices()->toArray() as $key=>$linked}
                                  <option value="{$key}" {if $key=$form->getSlaves()->byIndex()->getItemByKey($index)->get('linked_id')}selected=""{/if}>
                                      {$linked}
                                  </option>
                                  {/foreach}
                              </select>
{*                              {html_options class="ProductItemsSlave Select" name="linked_id" options=$form->items[$index]['linked_id']->getChoices()->toArray() selected=(string)$form->getSlaves()->byIndex()->getItemByKey($index)->get('linked_id')}*}

                      {* </div>
                      {/if}
                        {if $form->items[$index]->hasValidator('thickness')}
                      <div class="form-group col-md-4 toHide">
                           <td class="label" >{__("Thickness")|UPPER}{if $form->items[$index]['thickness']->getOption('required')}*{/if} </label>

                              <div class="error-form">{$form.items[$index].thickness->getError()}</div> 
                               <input type="text" title="isolation des combles : *Épaisseur (mm) :  - tchickness &#10 isolation des murs : *Épaisseur (mm) :  - tchickness &#10 Vide sanitaire et passage ouvert ou plancher bas : *Epaisseur (mm) :  - tchickness" class="ProductItemsSlave Input form-control" name="thickness" size="48" value="{if $form->hasErrors()}{$form['items'][$index]['coefficient']}{else}{$form->getSlaves()->byIndex()->getItemByKey($index)->getFormatter()->getThickness()->getText()}{/if}"/> 

                       </div>
                      {/if}


                     {if $form->items[$index]->hasValidator('input3')}
                         <div class="form-group col-md-4 toHide">
                             <label>{__("Input form-control3")|UPPER}{if $form->items[$index]['input3']->getOption('required')}*{/if} </label>

                                 <div class="error-form">{$form.items[$index].input3->getError()}</div> 
                                 <textarea cols="60" rows="1" class="ProductItemsSlave Textarea" title="isolation des combles : *Résistance thermique : R (m²K/W) :  - input3 &#10 isolation des murs : *Résistance thermique : R (m²K/W) :  - input3 &#10 Vide sanitaire et passage ouvert ou plancher bas : *Résistance thermique : R (m²K/W) :  - input3 &#10 chaudiere : *Efficacité énergétique saisonnière (ηs) (en %) : - input3 &#10 pac : *Efficacité énergétique saisonnière (ηs) (en %) :  - input3 &#10 ballon : *COP :  - input3" name="input3" >{if $form->hasErrors()}{$form['items'][$index]['input3']}{else}{$form->getSlaves()->byIndex()->getItemByKey($index)->get('input3')}{/if}</textarea>

                          </div>
                     {/if}              
                       <div class="form-group col-md-4 toHide">
                          <td class="label" >{__("Content Item")|UPPER}{if $form->items[$index]['content']->getOption('required')}*{/if} </label>

                              <div class="error-form">{$form.items[$index].content->getError()}</div> 
                                <textarea   title="isolation des combles : *Référence(s) :  - content &#10 isolation des murs : *Référence(s) :  - content &#10 Vide sanitaire et passage ouvert ou plancher bas : *Référence(s) :  - content &#10 chaudiere : *Référence :  - content &#10 pac : *Référence :  - content &#10 ballon : *Référence :  - content" class="ProductItemsSlave Textarea" cols="60" rows="1" name="content">{if $form->hasErrors()}{$form['items'][$index]['content']}{else}{$form->getSlaves()->byIndex()->getItemByKey($index)->get('content')}{/if}</textarea>

                       </div>
                       <div class="form-group col-md-4 toHide">
                          <label>{__("Acermi")|UPPER}{if $form->items[$index]['details']->getOption('required')}*{/if} </label>

                              <div class="error-form">{$form.items[$index].details->getError()}</div> 
                                <textarea  class="ProductItemsSlave Textarea" title="chaudiere : *Marque :  - details" cols="60" rows="1" name="details">{if $form->hasErrors()}{$form['items'][$index]['details']}{else}{$form->getSlaves()->byIndex()->getItemByKey($index)->get('details')}{/if}</textarea>

                       </div>*}
            
              </fieldset>

</div>
             </div>  
    {/foreach}
     
{else}
    {__('Item is invalid.')}
{/if}    
  
</div>
<script type="text/javascript">
{*    $(document).off('click',".ShowItemDetails");        
    $(document).on('click',".ShowItemDetails", function(){
        $('.Items[data-index='+$(this).data("index")+'] .toHide').toggle();
        
    });*}
    $(document).off('click',".ShowMasterItemDetails");        
    $(document).on('click',".ShowMasterItemDetails", function(){
        $('.MasterItem[data-index='+$(this).data("index")+'] .toHide').toggle();
        
    });
     $('.toHide').hide();
     
     
        $(document).off('click',".DeleteItem");        
        $(document).on('click',".DeleteItem", function(){
             var item = $(this).attr('data-index');             
                 if (confirm("{__("Item number #0# will be deleted. Confirm ?")}".format($(this).attr('data-index')))) {
                        $(".Items[data-index="+item+"],.MasterItemsSlave[data-index="+item+"]").remove();
                   }                              
        }); 
        
         $(document).off('click',".AddItem");
    
    $(document).on('click',".AddItem",function(){ 
        var indexes=[];
        $('.ProductItemsSlave.ID').each(function(i){
            indexes.push($(this).data('index'));
        });
         var index = Math.max(...indexes)+1;   
           $(".Items[data-index="+ $(this).attr('data-index')+"]").after('<div data-index="'+index+'" class="Items"> '+ 
                   '<div class="row m-0 p-0 tab-form border-0 text-center ">'+
                     '<span class="col-md-1"  > </span>'+
                        '<div class="form-group col-md-3 m-0">'+
                                '<label><span>{__("reference for display")|UPPER}{if $form->items[0]['reference']->getOption('required')}*{/if} </span></label>'+
                       '</div>'+
                        {if $form->items[0]->hasValidator('sale_price')}
                          '<div class="form-group col-md-1 m-0">'+
                             '<label>{__("Sale Price")|UPPER}{if $form->items[0]['sale_price']->getOption('required')}*{/if} </label>'+
                          '</div>'+
                        {/if}
                        {if $form->items[$index]->hasValidator('tva_id')}
                            '<div class="form-group col-md-1 m-0">'+
                                '<label>{__("Tax")|UPPER}{if $form->items[0]['tva_id']->getOption('required')}*{/if} </label>'+
                            '</div>'+
                        {/if}
                        '<div class="form-group col-md-4 m-0">'+
                         '<label>{__("Description")|UPPER}{if $form->items[0]['description']->getOption('required')}*{/if}</label>'+
                        '</div> '+
                         '<div class="form-group col-md-2 m-0">'+

                        '</div> '+
                        '<div class="form-group col-md-1 m-0">'+
                             '<label>{__('ID master')}</label>'+                     
                        '</div> '+

                '</div>'+
       '<div class="d-flex">'+ 
        '<fieldset class="tab-form bg-white row m-0 my-1 p-0 pt-2 ">'+            
            '<span class="col-md-1 text-info text-right ProductItemsSlave ID" data-name="id" data-index="'+index+'" data-index="0"></span>'+
                '<div class="form-group col-md-3 ">'+                   
                        '<div class="error-form"> </div>'+               
                        {* '<input type="text" class="ProductItems Input form-control" name="reference" size="48" value=""/>'+ *}
                                '<input id="SearchProduct-'+index+'" data-index="'+index+'" name="reference" value="" data-id="" type="text" class="ProductItemsSlave Input form-control SearchProduct" autocomplete="off">'+
{*                                '<div data-index="'+index+'" class="AutoCompleteProduct autocomplete-product dropdown-menu" style="transform: translate3d(0px, 0px, 0px) !important;">'+*}
{*                                '<select class="AutoCompleteProductselect" data-index="'+index+'" ></select>'+*}
{*                                '</div>' +*}
                     '</div>'+
                {if $form->items[0]->hasValidator("sale_price")}
                  '<div class="form-group col-md-1">'+ 
                         '<div class="error-form"> </div> '+ 
                          '<input type="text" class="ProductItemsSlave Input form-control w-100"  data-index="'+index+'" name="sale_price" size="48" value=""/>'+ 

                  '</div>'+ 
                 {/if}
                {if $form->items[0]->hasValidator('tva_id')}
                  '<div class="form-group col-md-1">'+
                         '<div class="error-form">{$form.items[0].tva_id->getError()}</div>'+
                           '<select  data-index="'+index+'" class="ProductItemsSlave Select" name="tva_id">'+
                               {foreach $form->items[0]['tva_id']->getOption("choices") as $key=>$option}
                               {if $key}'<option value="{$key}">{$option|escape}</option>'+{else}'<option></option>'+{/if}
                               {/foreach}
                             ' </select> '+
                         {*html_options class="ProductItems Select" name="tva_id" options=$form->tva_id->getOption("choices") selected=""*}

                 '</div>'+
                 {/if}
                '<div class="form-group col-md-4">'+
                    '<div class="error-form"> </div> '+
                     '<textarea  class="ProductItemsSlave Textarea w-100"  data-index="'+index+'" cols="55" rows ="1" name="description"> </textarea> '+              
               '</div> '+
                '<div class="right-actions d-block text-info col-md-1">'+
{*                ' <input data-index="'+index+'" class="ProductItemsSlave Checkbox" type="checkbox" id="is_master" name="is_master" value="YES">'+*}
{*                '<a data-index="'+index+'"   class="ShowItemDetails font-weight-bold" href="javascript:void(0);" ><i class="fa fa-info-circle" aria-hidden="true"></i></a>'+*}
                '<a data-index="'+index+'"  class="AddItem font-weight-bold" href="javascript:void(0);" ><i class="fa fa-plus" aria-hidden="true"></i></a>'+
                '<a data-index="'+index+'"   class="DeleteItem font-weight-bold" href="javascript:void(0);" ><i class="fa fa-trash"></i></a>'+
               '</div>'+  
               ' <div class="col-md-1">'+
                    
                '</div> '+ 
                   {*' <div class="form-group col-md-4 toHide">'+
                    '<label><span>'+"{__("reference for document")|UPPER}{if $form->items[0]['input1']->getOption('required')}*{/if}"+' </span></label>'+

                        '<div class="error-form">{$form.items[0].input1->getError()}</div>'+               
                         '<input type="text" class="ProductItemsSlave Input form-control" data-index="'+index+'" name="input1" size="48" value=""/> '+

                ' </div>'+     
                {if $form->items[$index]->hasValidator('mark')}
                 '<div class="form-group col-md-4 toHide">'+
                     '<label>'+"{__("Mark Item")|UPPER}"+'</label>'+

                        '<div class="error-form">{$form.items[0].mark->getError()}</div>'+ 
                        ' <input type="text"  data-index="'+index+'" title="isolation des combles : *Marque(s) :  - mark &#10 isolation des murs : *Marque(s) :  - mark &#10 Vide sanitaire et passage ouvert ou plancher bas : *Marque(s) :  - mark &#10 chaudiere : *Marque :  - mark &#10 chaudiere : *Référence :  - mark &#10 pac : *Marque :  - mark &#10 ballon : *Marque :  - mark" class="ProductItemsSlave Input form-control" name="mark" size="48" value=""/>'+ 

                 '</div>'+
                {/if}
                '<div class="form-group col-md-4 toHide">'+
                    '<label><span>'+"{__("Input form-control2 Item")|UPPER}"+'  </span></label>'+

                        '<div class="error-form">{$form.items[0].input2->getError()}</div>'+               
                         '<input type="text"  data-index="'+index+'" class="ProductItemsSlave Input form-control" title="chaudiere : *Classe du régulateur : - imput2" name="input2" size="48" value=""/>'+ 

                 '</div>'+   
                 {if $form->items[0]->hasValidator('discount_price')}
                  '<div class="form-group col-md-4 toHide">'+
                     '<label>'+"{__("Discount Price")|UPPER}{if $form->items[0]['discount_price']->getOption('required')}*{/if}"+' </label>'+

                         '<div class="error-form">{$form.items[0].discount_price->getError()}</div>'+ 
                          '<input type="text"  data-index="'+index+'" class="ProductItemsSlave Input form-control" name="discount_price" size="48" value=" "/>'+ 

                  '</div>'+
                 {/if}

                  {if $form->items[0]->hasValidator('purchasing_price')}
                 '<div class="form-group col-md-4 toHide">'+
                     '<label>'+"{__("Purchasing price")|UPPER|escape}{if $form->items[0]['purchasing_price']->getOption('required')}*{/if}"+' </label>'+

                         '<div class="error-form">{$form.items[0].purchasing_price->getError()}</div> '+
                          '<input type="text"  data-index="'+index+'" class="ProductItemsSlave Input form-control" name="purchasing_price" size="48" value=""/>'+ 

                  '</div>'+
                 {/if}                
                  {if $form->items[0]->hasValidator('unit')}
                  '<div class="form-group col-md-4 toHide">'+
                     '<label>'+"{__("Unit")|UPPER}{if $form->items[0]['unit']->getOption('required')}*{/if}"+' </label>'+

                         '<div class="error-form">{$form.items[0].unit->getError()}</div>'+ 
                          '<select  data-index="'+index+'" class="ProductItemsSlave Select" name="unit">'+
                               {foreach $form->items[0]['unit']->getOption("choices") as $key=>$option}
                               {if $key}'<option value="{$key}">{$option|escape}</option>'+{else}'<option></option>'+{/if}
                               {/foreach}
                             ' </select> '+
                         {*html_options class="ProductItems Select" name="unit" options=$form->unit->getOption("choices") selected=""*}

                         {*'</div>'+
                 {/if}
                  {if $form->items[0]->hasValidator('coefficient')}
                 '<div class="form-group col-md-4 toHide">'+
                     '<label>'+"{__("Coefficient")|UPPER}{if $form->items[0]['coefficient']->getOption('required')}*{/if}"+' </label>'+

                         '<div class="error-form">{$form.items[0].coefficient->getError()}</div> '+
                         '<input type="text" data-index="'+index+'" class="ProductItemsSlave Input form-control" name="coefficient" size="48" value=""/> '+

                  '</div>'+
                 {/if}
                 {if $form->items[0]->hasValidator('is_mandatory')}
                 '<div class="form-group col-md-4 toHide">'+
                     '<label>'+"{__("Mandatory ?")|UPPER}"+'</label>'+

                         '<div class="error-form">{$form.items[0].is_mandatory->getError()}</div> '+
                         '<input type="checkbox"  data-index="'+index+'" class="ProductItemsSlave Checkbox" name="is_mandatory"   checked="" /> '+

                  '</div>'+
                 {/if}
                  {if $form->items[0]->hasValidator('linked_id')}
                 '<div class="form-group col-md-4 toHide">'+
                     '<label>'+"{__("Link")|UPPER}"+'</label>'+

                         '<div class="error-form">{$form.items[0].linked_id->getError()}</div> '+
                          '<select  data-index="'+index+'" class="ProductItemsSlave Select" name="linked_id">'+
                               {foreach $form->items[0].linked_id->getOption('choices') as $key=>$option}
                               {if $key}'<option value="{$key}">{$option|escape}</option>'+{else}'<option></option>'+{/if}
                               {/foreach}
                          ' </select> '+
                         {*html_options class="ProductItems Select" name="linked_id" options=$form->linked_id->getChoices()->toArray() selected=""*}

                         {*'</div>'+
                 {/if}
                   {if $form->items[0]->hasValidator('thickness')}
                 '<div class="form-group col-md-4 toHide">'+
                      '<td class="label" >'+"{__("Thickness")|UPPER}{if $form->items[0]['thickness']->getOption('required')}*{/if}"+' </label>'+

                         '<div class="error-form">{$form.items[0].thickness->getError()}</div>'+ 
                          '<input type="text"  data-index="'+index+'" title="isolation des combles : *Épaisseur (mm) :  - tchickness &#10 isolation des murs : *Épaisseur (mm) :  - tchickness &#10 Vide sanitaire et passage ouvert ou plancher bas : *Epaisseur (mm) :  - tchickness" class="ProductItemsSlave Input form-control" name="thickness" size="48" value=""/>'+ 

                  '</div>'+
                 {/if}


                {if $form->items[0]->hasValidator('input3')}
                    '<div class="form-group col-md-4 toHide">'+
                        '<label>'+"{__("Input form-control3")|UPPER}{if $form->items[0]['input3']->getOption('required')}*{/if}"+' </label>'+

                            '<div class="error-form">{$form.items[0].input3->getError()}</div>'+ 
                            '<textarea cols="60" rows="1"  data-index="'+index+'" class="ProductItemsSlave Textarea" title="isolation des combles : *Résistance thermique : R (m²K/W) :  - input3 &#10 isolation des murs : *Résistance thermique : R (m²K/W) :  - input3 &#10 Vide sanitaire et passage ouvert ou plancher bas : *Résistance thermique : R (m²K/W) :  - input3 &#10 chaudiere : *Efficacité énergétique saisonnière (ηs) (en %) : - input3 &#10 pac : *Efficacité énergétique saisonnière (ηs) (en %) :  - input3 &#10 ballon : *COP :  - input3" name="input3" > </textarea>'+

                     '</div>'+
                {/if}              
                  '<div class="form-group col-md-4 toHide">'+
                     '<td class="label" >'+"{__("Content Item")|UPPER}{if $form->items[0]['content']->getOption('required')}*{/if}"+' </label>'+

                         '<div class="error-form">{$form.items[0].content->getError()}</div>'+ 
                           '<textarea  data-index="'+index+'"  title="isolation des combles : *Référence(s) :  - content &#10 isolation des murs : *Référence(s) :  - content &#10 Vide sanitaire et passage ouvert ou plancher bas : *Référence(s) :  - content &#10 chaudiere : *Référence :  - content &#10 pac : *Référence :  - content &#10 ballon : *Référence :  - content" class="ProductItemsSlave Textarea" cols="60" rows="1" name="content"> </textarea>'+

                  '</div>'+
                  '<div class="form-group col-md-4 toHide">'+
                     '<label>'+"{__("Acermi")|UPPER}{if $form->items[0]['details']->getOption('required')}*{/if}" +'</label>'+

                         '<div class="error-form">{$form.items[0].details->getError()}</div>'+ 
                           '<textarea   data-index="'+index+'" class="ProductItemsSlave Textarea" title="chaudiere : *Marque :  - details" cols="60" rows="1" name="details"></textarea>'+
                  '</div>'+*}
                
         '</fieldset> '+
         '</div>'+
         
         '</div>');
                                        
           
           
          
        });
     {* =================== F I E L D S ================================ *}
     $(".ProductItemsMaster,.ProductItemsSlave").click(function() {  $('#ProductItems-Save').show(); });   
     $(document).on('click',".ProductItemsMaster,.ProductItemsSlave",function () {  
            $('#ProductItems-Save').show();
     });
  
     {* =================== A C T I O N S ================================ *}
     $('#ProductItems-Cancel').click(function(){

                    return $.ajax2({ data : {  Product: '{$form->getMaster()->getProduct()->get('id')}' },
                                url : "{url_to('products_items_ajax',['action'=>'ListPartialItemMaster'])}",
                                errorTarget: ".ProductItems-errors",
                                loading: "#tab-site-dashboard-x-settings-loading",                         
                                target: "#actions" });
      });
      
      $('#ProductItems-Save').click(function(){ 
      
            var  params= { 
                                ProductItem: '{$form->getMaster()->get('id')}',
                                ProductItems: {
                                  
                                                /*id:$('.ProductItems.Master.ID').data('id'),
                                                reference:$('.ProductItems.Master.Input[name=reference]').val(),
                                                sale_price:$('.ProductItems.Master.Input[name=sale_price]').val(),
                                                description:$('.ProductItems.Master.Textarea[name=description]').val(),
                                                //is_master:$(this).find('.ProductItems.Master.Checkbox:checked[name=is_master]').is(":checked"),
                                                input1:$('.ProductItems.Master.Input[name=input1]').val(),
                                                mark:$('.ProductItems.Master.Input[name=mark]').val(),
                                                input2:$('.ProductItems.Master.Input[name=input2]').val(),
                                                discount_price:$('.ProductItems.Master.Input[name=discount_price]').val(),
                                                purchasing_price:$('.ProductItems.Master.Input[name=purchasing_price]').val(),
                                                tva_id:$(".ProductItems.Master.Select[name=tva_id] option:selected").val(),
                                                unit:$(".ProductItems.Master.Select[name=unit] option:selected").val(),
                                                coefficient:$('.ProductItems.Master.Input[name=coefficient]').val(),
                                                is_mandatory:$('.ProductItems.Master.Checkbox:checked[name=is_mandatory]').is(":checked"),
                                                linked_id:$(".ProductItems.Master.Select[name=linked_id] option:selected").val(),
                                                thickness:$('.ProductItems.Master.Input[name=thickness]').val(),
                                                input3:$('.ProductItems.Master.Textarea[name=input3]').val(),
                                                content:$('.ProductItems.Master.Textarea[name=content]').val(),
                                                details:$('.ProductItems.Master.Textarea[name=details]').val(),*/
                                   
                                   items: [],
                                   token :'{$form->getCSRFToken()}'
                                } 
                        }; 
            //$(".ProductItemsMaster.ID").each(function() { params.ProductItems[$(this).data('name')]=$(this).data('id');  }); 
            $(".ProductItemsMaster.Input,.ProductItemsMaster.Textarea").each(function() {  params.ProductItems[this.name]=$(this).val();  }); 
            $(".ProductItemsMaster.Select option:selected").each(function() {  params.ProductItems[$(this).parent().attr('name')]=$(this).val();  });           
            $(".ProductItemsMaster.Checkbox:checked").each(function() {  params.ProductItems[$(this).attr('name')]='YES';  });   
             //params.ProductItems.items.filter(function(val){ return val});
             
            console.log($(".Items").length);
             
            $(".Items").each(function(id){ 
                console.log()
            });
             
            $(".Items").each(function(id){
                console.log('id='+id+" index="+$(this).attr('data-index'));
                var item={ }; //  'xx' : id , 'xy': 'test'  };                    
                    
                    $(".ProductItemsSlave.ID[data-index="+$(this).attr('data-index')+"]").each(function() { item[$(this).data('name')]=$(this).data('id');  }); 
                    $(".ProductItemsSlave.Input[data-index="+$(this).attr('data-index')+"],.ProductItemsSlave.Textarea[data-index="+$(this).attr('data-index')+"]").each(function() { item[this.name]=$(this).val();  }); 
                    $(".ProductItemsSlave.Select[data-index="+$(this).attr('data-index')+"] option:selected").each(function() {  item[$(this).parent().attr('name')]=$(this).val();  });           
                    $(".ProductItemsSlave.Checkbox[data-index="+$(this).attr('data-index')+"]:checked").each(function() {  item[$(this).attr('name')]='YES';  }); 
                    params.ProductItems.items.push(item);
                               });
            console.log(params);
            
         
                        
            
          {*$(".ProductItems.Input form-control,.ProductItems.Textarea").each(function() {  params.ProductItems[this.name]=$(this).val();  }); 
          $(".ProductItems.Select option:selected").each(function() {  params.ProductItems[$(this).parent().attr('name')]=$(this).val();  });           
          $(".ProductItems.Checkbox:checked").each(function() {  params.ProductItems[$(this).attr('name')]='YES';  });                    *}
          return $.ajax2({ data : params,                            
                           errorTarget: ".ProductItems-errors",
                           url: "{url_to('products_items_ajax',['action'=>'SaveItemListMasterSlaveForProductxxx'])}",
                           target: "#actions" }); 
        });  
        
        
       /*  $("#Product-Save").click(function () {       
            $(".Items").each(function () { 
            var item = { id : $(this).attr('id') };
            $(".ProductItems.Input[data-index="+$(this).attr('data-index')+"]").each(function () { item[$(this).attr('name')]=$(this).val(); });
            $(".ProductItems.Data[data-index="+$(this).attr('data-index')+"]").each(function () { item[$(this).attr('name')]=$(this).attr('data-id'); });
            $(".ProductItems.Select[data-index="+$(this).attr('data-index')+"] option:selected").each(function () { item[$(this).parent().attr('name')]=$(this).val(); });
            $(".ProductItems.Checkbox[data-index="+$(this).attr('data-index')+"]:checked").each(function () { item[$(this).attr('name')]=$(this).val(); }); 
          //  params.products.push(item);            
        });
           
        return $.ajax2({      
                         data : params,
{*                         url:"{url_to('customers_contract_ajax',['action'=>'SaveMultipleProductForContract'])}",        *}
                         spinner : '#spinner-product',
                         success : function (resp) { 
                             if (resp.errors)
                             {
                                
                                 return ;
                             }    
                             
                         }                         
                       });    
        }); */
    
       //$(document).off('keyup',".SearchProduct");

{*        $(document).on('keyup',".SearchProduct",function () { 
            var index=$(this).attr('data-index');
            if ($(this).val().length == 0)  
                $(".AutoCompleteProduct[data-index="+index+"]").hide();
            else 
                $(".AutoCompleteProduct[data-index="+index+"]").show();     
{*            if ($(this).val().length < 3 ) return ;    
            $(".AutoCompleteProduct[data-index="+index+"]").html();*}
            {*$(this).attr('data-product',null).attr('data-id',null);
            

            return $.ajax2({
                data:{ ProductItem: {$form->getMaster()->get('id')} },
                url : "{url_to('products_items_ajax',['action'=>'ListItemsForNewSlave'])}",
                errorTarget: ".ProductItems-errors",
                loading: "#tab-site-dashboard-x-settings-loading",                         
                success:function(resp){
                    if(resp.action!="ListItemsForNewSlave")
                        return;
                    $.each(resp.items,function(key,value){
                        //alert(key);
                        $('.AutoCompleteProductselect[data-index="+index+"]').append('<option>xxx</option>');
                        console.log(value);
                    });
                }
            });
            
        });*}
           
           $('.AddItemsForMaster').click(function(){
                return $.ajax2({
                data:{
                    ProductItem: $(this).attr('id'),
                    Action:'ListPartialItemMaster'
                },
                url : "{url_to('products_items_ajax',['action'=>'AddItemsForItemProduct'])}",
                errorTarget: ".ProductItems-errors",
                loading: "#tab-site-dashboard-x-settings-loading",                         
                target: "#actions",                         
            });
           });
    
</script>

