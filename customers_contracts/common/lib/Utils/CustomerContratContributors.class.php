<?php

class CustomerContratContributors extends mfArray {
            
            
            
            function addContributor(CustomerContractContributor $contributor)
            {
                if ($contributor->isNotLoaded())
                    return $this;               
                $this->collection[$contributor->get('type')]=$contributor;
                return $this;
            }
            
            function hasType($type)
            {
                return isset($this->collection[$type]);
            }
            
            function getMissingTypes()
            {
                $types=array();
                foreach (array('telepro','sale_1','sale_2','assistant','manager','team') as $type)
                {
                    if ($this->hasType($type))
                        continue;
                    $types[]=$type;
                }        
                return $types;
            }
            
        }
