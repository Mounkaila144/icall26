{messages class="{$site->getSiteID()}-CustomerMeetingForm-errors"}
<h3>{__("View form")|capitalize}</h3>
<div>
    <a href="#" id="CustomerMeetingForm-Save" class="btn" style="display:none">
        <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>
        {*<img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>*}{__('save')}</a>
    <a href="#" id="CustomerMeetingForm-Cancel" class="btn"><i class="fa fa-times" style="color:#000;margin-right:10px;"></i>
        {*<img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>*}{__('cancel')}</a>
</div>
{if $item->isLoaded()}      
    <div id="Form">        
        {foreach $form->fields->getSchema() as $index=>$formfield}  
        <div class="Survey-FormField" id="{$formfield@index}">  
            
            <div class="Survey-FormField-ctn" id="{$index}">
                <table class="form-full-style tab-form">
                    <tr>
                        <td>
                         <div id="{$index}">               
                               {foreach $form->fields[$index]['type']->getOption('choices') as $type}                
                               <input type="radio" class="Survey-Types" name="type-{$index}" {if $type==(string)$form.fields[$index].type}checked=""{/if} id="{$type}">{__($type)}                
                                {/foreach}    
                           </div> 
                        </td>
                    </tr>
                    <tr class="Survey-Request full-with" id="{$formfield@index}">
                        <td class="label">{__('Name')}
                        </td>
                        <td>
                            <div>{$form.fields[$index].name->getError()}</div>
                            <input class="formfields Name" size="30" name="name" id="{$form.fields[$index].formfield_id}" value="{$form.fields[$index].name}"/>
                        </td>   
                        <td>
                        </td>
                    </tr>
                    <tr class="Survey-Request" id="{$formfield@index}">
                        <td class="label">{__('Request')}
                        </td>
                        <td><div>{$form.fields[$index].request->getError()}</div>
                            <input class="formfields Request" size="80" name="request" value="{$form.fields[$index].request}"/>
                        </td>   
                        <td>
                        </td>
                    </tr>
                    <tr class="Survey-Answer full-with" id="{$formfield@index}">
                        <td class="label">{__('Answer')}
                        </td>
                        <td>              
                            {if (string)$form.fields.$index.type=='string'}
                            <input class="formfields Request" id="{$form.fields[$index].formfield_id}" disabled="disabled" size="{$form.fields[$index].size}" name="answer" value=""/>
                            <div class="Answer-info">
                                <div class="error-form">{$form.fields[$index].min_length->getError()}</div>
                                <div>{$form.fields[$index].max_length->getError()}</div>
                                <label>{__('Size')} : </label><input type="text" class="formfields Answer Size" size="5" name="size" id="{$form.fields[$index].formfield_id}" value="{$form.fields[$index].size}"/>                                                      
                                <label>{__('Min length')} : </label><input type="text" class="formfields Answer" size="5" name="min_length" value="{$form.fields[$index].min_length}"/>                                                      
                                <label>{__('Max length')} : </label><input type="text"class="formfields Answer" size="5" name="max_length" value="{$form.fields[$index].max_length}"/>
                                <label>{__('Required')} : </label><input type="checkbox" class="formfields Answer" name="required" {if $form.fields[$index].required->getValue()==true}checked=""{/if}/>
                            </div>
                            {elseif (string)$form.fields.$index.type=='integer'}
                                <input class="formfields Request" disabled="disabled" size="{$form.fields[$index].size}" name="request" value=""/>
                                <div class="Answer-info">
                                    <div>{$form.fields[$index].min->getError()}</div>
                                    <div>{$form.fields[$index].max->getError()}</div>
                                    <label>{__('Size')} : </label><input type="text" class="formfields Answer Size" size="5" name="size" value="{$form.fields[$index].size}"/>  
                                    <label>{__('Min')} : </label><input class="formfields Answer" size="5" name="min" value="{$form.fields[$index].min}"/>                      
                                    <label>{__('Max')} : </label><input class="formfields Answer" size="5" name="max" value="{$form.fields[$index].max}"/>
                                    <label>{__('Required')} : </label>:<input type="checkbox" class="formfields Answer" name="required" {if $form.fields[$index].required->getValue()==true}checked=""{/if}/>
                                </div>
                            {elseif (string)$form.fields.$index.type=='text'}
                            <textarea class="formfields Request" cols="{$form.fields[$index].cols}" rows="{$form.fields[$index].rows}" id="{$form.fields[$index].formfield_id}" disabled="disabled" name="answer"></textarea>
                            <div class="Answer-info">
                                <div>{$form.fields[$index].min_length->getError()}</div>
                                <div>{$form.fields[$index].max_length->getError()}</div>
                                <label>{__('Cols')} : </label><input type="text" class="formfields Answer Text" size="5" name="cols" id="{$form.fields[$index].formfield_id}" value="{$form.fields[$index].cols}"/>                                                      
                                <label>{__('Rows')} : </label><input type="text" class="formfields Answer Text" size="5" name="rows" id="{$form.fields[$index].formfield_id}" value="{$form.fields[$index].rows}"/>                                                      
                                <label>{__('Min length')} : </label><input type="text" class="formfields Answer" size="5" name="min_length" value="{$form.fields[$index].min_length}"/>                                                      
                                <label>{__('Max length')} : </label><input type="text"class="formfields Answer" size="5" name="max_length" value="{$form.fields[$index].max_length}"/>
                                <label>{__('Required')} : </label><input type="checkbox" class="formfields Answer" name="required" {if $form.fields[$index].required->getValue()==true}checked=""{/if}/>
                            </div>
                            {elseif (string)$form.fields.$index.type=='choice'}                                
                                {__('Required')}<input type="checkbox" class="formfields Answer" name="required"  {if $form.fields[$index].required->getValue()==true}checked=""{/if}/>
                                {__('Multiple')}<input type="checkbox" class="formfields Answer" name="multiple" {if $form.fields[$index].multiple->getValue()==true}checked=""{/if}/>                                                            
                            {elseif (string)$form.fields.$index.type=='boolean'}
                                <input type="checkbox" disabled="disabled" id="{$form.fields[$index].formfield_id}" value=""/>                                                      
                            {/if}
                        </td>
                        <td>                          
                            <a href="#" class="Survey-Actions" id="{$formfield@index}" name="Delete"><i class=" fa fa-trash fa-2x" style=" margin-right:10px;"></i></a>                          
                        </td>
                    </tr> 
                   {if (string)$form.fields.$index.type=='choice'}       
                       <tr id="{$index}" class="Survey-Choices  Survey-Choices-item full-with">
                           <td>
                            {foreach $form->getWidgetForChoices() as $choice}
                                <label>{__($choice)}</label><input class="Survey-Choices-Type" type="radio" class="Survey-Choices-Type" id="{$index}" name="choice-{$index}" value="{$choice}" {if (string)$form.fields.$index.widget==$choice}checked=""{/if}/>
                            {/foreach} 
                            </td>
                       </tr>  
                       {foreach $form.fields.$index.choices as $choice}
                       <tr id="{$index}" class="Survey-Choices-items Survey-Choices-item full-with">
                        <td>
                            <label>{__("Choice")}<span class="Survey-Choices-items-number" id="{$index}"> {$choice@index+1}</span></label><input id="{$index}" type="text" class="Survey-Choices-Input" value="{$form.fields.$index.choices[$choice@index]}"/>
                        </td>
                        <td>                          
                             <a href="#" class="Survey-Choices-Action-Delete" id="{$index}" name="Delete"><i class=" fa fa-trash" style=" margin-right:10px;"></i></a>                       
                        </td>
                     </tr>
                     {/foreach}
                     <tr id="{$index}" class="Survey-Choices-Actions-ctn Survey-Choices-item full-with"><td>
                        <a href="#" class="Survey-Choices-Actions" id="{$index}" name="Add"><i class=" fa fa-plus" style=" margin-right:10px;"></i></a>
                        </td>
                     </tr>
                   {/if}
                    
                 </table>  
            </div>
        </div>
        {/foreach}        
   </div>
  <a href="#" class="Survey-Actions btn" id="{$formfield@index}" name="Add"><i class=" fa fa-plus " style=" margin-right: 10px;"></i>{__('Add field')}</a>
{else}
    <span>{__('form is invalid.')}</span>
{/if}    
<script type="text/javascript">
     
     $(document).off('click','.Survey-Types');
     
     $(document).off('click','.Survey-Actions');
     
     $(document).off('keyup','.formfields.Answer.Size');
     
     $(document).off('keyup','.formfields.Answer.Text');
     
     $(document).off('click','.Survey-Choices-Actions');
     
     $(document).off('click','.Survey-Choices-Action-Delete');
      
     $(document).on('keyup','.formfields.Answer.Size',function() {
        $(".formfields.Request[id="+$(this).attr('id')+"]").attr('size',$(this).val());
     });
     
     $(document).on('keyup','.formfields.Answer.Text',function() {       
         $(".formfields.Request[id="+$(this).attr('id')+"]").attr($(this).attr('name'),$(this).val());
     });
    
     $(document).on('click','.Survey-Choices-Actions',function () {      
       // console.log($(".Survey-Choices-items[id="+$(this).attr('id')+"]").length);
       $(".Survey-Choices-items[id="+$(this).attr('id')+"]").last().after(({include file="./includes/ctn-choice-item.inc"}).format($(this).attr('id'),($(".Survey-Choices-items[id="+$(this).attr('id')+"]").length+1))); 
     });
     
     $(document).on('click','.Survey-Choices-Action-Delete',function () {        
         $(this).parent().parent().remove();
         $(".Survey-Choices-items-number[id="+$(this).attr('id')+"]").each(function (id){    $(this).html((id+1)); });        
     });
     
     $(document).on('click','.Survey-Types',function() {           
           $(".Survey-Choices-items[id="+$(this).parent().attr('id')+"]").hide();
           $(".Survey-Choices-item[id="+$(this).parent().attr('id')+"]").hide();
           if ($(this).attr('id')=='string')
           {                                        
                $(".Survey-Answer[id="+$(this).parent().attr('id')+"]").html(({include file="./includes/ctn-string.inc"}).format($(this).parent().attr('id'))); 
           }  
           else if ($(this).attr('id')=='integer')
           {                   
                $(".Survey-Answer[id="+$(this).parent().attr('id')+"]").html(({include file="./includes/ctn-integer.inc"}).format($(this).parent().attr('id'))); 
           }
           else if ($(this).attr('id')=='choice')
           {
               $(".Survey-Answer[id="+$(this).parent().attr('id')+"]").html(({include file="./includes/ctn-choice.inc"}).format($(this).parent().attr('id')));                
               if ($(".Survey-Choices-item[id="+$(this).parent().attr('id')+"]").length==0)
               {    
                    
                    $(".Survey-Answer[id="+$(this).parent().attr('id')+"]").after(({include file="./includes/ctn-choice-more.inc"}).format($(this).parent().attr('id'),1));  
                    $(".Survey-Choices-items[id="+$(this).parent().attr('id')+"]").after(({include file="./includes/ctn-choice-item-actions.inc"}).format($(this).parent().attr('id')));  
               }
               else
               {                 
                   $(".Survey-Choices-items[id="+$(this).parent().attr('id')+"]").show();
                   $(".Survey-Choices-item[id="+$(this).parent().attr('id')+"]").show();
               }
           }
           else if ($(this).attr('id')=='text')
           {               
                $(".Survey-Answer[id="+$(this).parent().attr('id')+"]").html(({include file="./includes/ctn-text.inc"}).format($(this).parent().attr('id'))); 
           }
           else if ($(this).attr('id')=='boolean')
           {               
                $(".Survey-Answer[id="+$(this).parent().attr('id')+"]").html(({include file="./includes/ctn-boolean.inc"}).format($(this).parent().attr('id'))); 
           } 
     });
     
     $(document).on('click','.Survey-Actions',function() {     
          if ($(this).attr('name')=='Add')
          {    
             $(".Survey-FormField").last().after(({include file="./includes/string.inc"}).format($(".Survey-FormField").length));            
          }
          else if ($(this).attr('name')=='Delete')
          {
              $(".Survey-FormField[id="+$(this).attr('id')+"]").remove();             
          }    
     });
     
     $(document).on('click','.formfields',function(){ $('#CustomerMeetingForm-Save').show();  });   
     {* =================== F I E L D S ================================ *}
          
    
     {* =================== A C T I O N S ================================ *}
     $('#CustomerMeetingForm-Cancel').click(function(){                           
             return $.ajax2({ data: { filter: { lang:"{$item->get('lang')}", token: "{mfForm::getToken('CustomerMeetingFormsFormFilter')}" } },                              
                              url : "{url_to('customers_meeting_forms_ajax',['action'=>'ListPartialForm'])}",
                              errorTarget: ".{$site->getSiteID()}-CustomerMeetingForm-errors",
                              loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",                         
                              target: "#{$site->getSiteID()}-actions" }); 
      });
      
      $('#CustomerMeetingForm-Save').click(function(){                             
            var  params= {      CustomerMeetingFormI18n: "{$item->get('id')}",     
                                CustomerMeetingFormFields: {  
                                   fields: [], 
                                   count : 0,
                                   token :'{$form->getCSRFToken()}'
                                } };
          $(".Survey-FormField").each(function(id){             
             var item={ 
                        type: $(this).find(".Survey-Types:checked").attr('id'),
                        request: $(this).find(".formfields.Request").val(),
                        name: $(this).find(".formfields.Name").val(),
                        formfield_id: $(this).find(".formfields.Name").attr('id')
                        };
             $(this).find("input[type=text].formfields.Answer").each(function(){  item[this.name]=$(this).val(); });     
             $(this).find("input[type=checkbox].formfields.Answer:checked").each(function(){  item[this.name]=1; });
             if ($(".Survey-Choices-Input").length)
             {    
                item.widget=$(this).find(".Survey-Choices-Type:checked").val();
                item.choices=[];                 
             }
             $(this).find(".Survey-Choices-Input").each(function() {  item.choices.push($(this).val());   });           
           //  alert("Params="+item.toSource());  return ;  
             params.CustomerMeetingFormFields.fields.push(item);
             params.CustomerMeetingFormFields.count=params.CustomerMeetingFormFields.fields.length;
             
          });                                
         // $("input.CustomerMeetingFormI18n").each(function() { params.CustomerMeetingFormI18n.form_i18n[this.name]=$(this).val(); });
         // $("input.CustomerMeetingForm").each(function() {  params.CustomerMeetingFormI18n.form[this.name]=$(this).val();  });  // Get foreign key  
         // alert("Params="+params.toSource());  return ;       
          return $.ajax2({ data : params,                            
                           errorTarget: ".{$site->getSiteID()}-CustomerMeetingForm-errors",
                           url: "{url_to('customers_meeting_forms_ajax',['action'=>'SaveFormFields'])}",
                           target: "#{$site->getSiteID()}-actions" }); 
        });  
     
</script>