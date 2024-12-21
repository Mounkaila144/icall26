<?php

class MoveMenuForm extends mfForm {
    
    function configure() {
        $this->setValidators(array(
            'node'=>new ObjectExistsValidator('SystemMenu',array('key'=>false)),
            'sibling_id'=>new ObjectExistsValidator('SystemMenu',array('key'=>false,'required'=>false,'empty_value'=>null)),
            'parent_id'=>new ObjectExistsValidator('SystemMenu',array('key'=>false,'required'=>false,'empty_value'=>null)),
        ));
    }
    
    function getNode()
    {
        return $this['node']->getValue();
    }
    
    function hasSibling()
    {
        return (boolean)$this['sibling_id']->getValue(); 
    }
    
    function getSibling()
    {
        return $this['sibling_id']->getValue();
    }
     function hasParent()
    {
        return (boolean)$this['parent_id']->getValue(); 
    }
    
    function getParent()
    {
        return $this['parent_id']->getValue();
    }
      function isValid()
    {
        if (parent::isValid())
        {
           
            if ($this->processed)
                return true;
            $this->processed=true;
            if($this->getSibling()!=$this->getNode() && $this->getParent()!=$this->getNode())
            {
                   if($this->hasSibling() && $this->isPositionnable())
                    {

                            $this->getNode()->moveTo($this->getSibling())
                                            ->asPrevSibling()
                                            ->save();

                    }
                    if($this->hasParent() && $this->isPositionnable())
                    {
                         $this->getNode()->moveTo($this->getParent())
                                    ->asFirstChild()
                                    ->save();
                    } 
            
            }
            return true;
        }
        return false;
    }
    
    function isPositionnable()
    {
        if($this->getNode()->getDepth()!=0)
        {
            if($this->hasSibling())
            {
                 if(($this->getSibling()->get('level')==3 && $this->getNode()->getDepth()>1)||
                    ($this->getSibling()->get('level')==4 && $this->getNode()->getDepth()>0))
                {
                    return false;
                }
            }
            if($this->hasParent())
            {
                if(($this->getParent()->get('level')==2 && $this->getNode()->getDepth()>1)||
                       ($this->getParent()->get('level')==3 && $this->getNode()->getDepth()>0))
               {
                   return false;
               }
            }
            
        }
        return true;
    }
}

class dashboard_ajaxMoveMenuAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {     
      $messages = mfMessages::getInstance();   
      try 
      {        
          
            $form = new MoveMenuForm();
            $form->bind($request->getPostParameter('SystemMenuPositions'));
            if (!$form->isValid())
            {
                  return array("action"=>"MoveMenu","errors"=>$form->getErrorSchema()->getErrorsMessage());
                //  throw new mfException(__('Form has some errors.'));
            }
         /*   if($form->hasSibling() && $form->isPositionnable() )
            {
                
                $form->getNode()->moveTo($form->getSibling())
                                ->asPrevSibling()
                                ->save();
            }
            if($form->hasParent())
            {
                 $form->getNode()->moveTo($form->getParent())
                            ->asFirstChild()
                            ->save();
            }*/
            // remove cache 
            $form->getNode()->save();
           // SystemMenu::reloadCache($form->getNode()->getRootFather()->get('name'));
            if ($form->getNode()->getRootFather())
                $form->getNode()->getRootFather()->loadCache();
        
            $response = array("action"=>"MoveMenu");
          
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}
