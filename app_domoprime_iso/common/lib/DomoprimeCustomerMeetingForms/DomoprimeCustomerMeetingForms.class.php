<?php

 
class DomoprimeCustomerMeetingForms extends CustomerMeetingForms {
     
    static protected $settings=array();
    
    static function initializeSettings($site=null)
    {
        $settings=new DomoprimeSettings(null,$site);
        self::$settings['surface_wall']=$settings->getSurfaceWallFormField();
        self::$settings['surface_wall']->getForm();
        self::$settings['surface_top']=$settings->getSurfaceTopFormField();
        self::$settings['surface_top']->getForm();
        self::$settings['surface_floor']=$settings->getSurfaceFloorFormField();
        self::$settings['surface_floor']->getForm();
        self::$settings['number_of_people']=$settings->getNumberOfPeopleFormField();
        self::$settings['number_of_people']->getForm();
        self::$settings['revenue']=$settings->getRevenueFormField();
        self::$settings['revenue']->getForm();
        self::$settings['owner']=$settings->getOwnerFormField();
        self::$settings['owner']->getForm();
        self::$settings['energy']=$settings->getEnergyFormField();
        self::$settings['energy']->getForm();
        self::$settings['energies']= DomoprimeEnergy::getEnergiesByNameI18n($site);
        self::$settings['occupations']= DomoprimeOccupation::getOccupationsByNames($site);                
        self::$settings['type_layers']= DomoprimeTypeLayer::getLayersByNames($site);     
    }
    
    function transfertToRequest()
    {
        if ($siret_layer=$this->getDataFromFieldname('poseur','siret',null))
        {
            $layer=new PartnerLayerCompany(array('siret'=>$siret_layer),$this->getSite());
            if ($layer->isLoaded())
            {                
                 $this->getMeeting()->set('partner_layer_id',$layer)->save();
            }
        }                                       
      //  $this->data='a:7:{s:3:"iso";a:15:{s:14:"surface_comble";i:0;s:11:"surface_mur";i:0;s:16:"surface_plancher";i:110;s:14:"numberofpeople";i:5;s:7:"revenue";i:44372;s:21:"nombre_foyers_fiscaux";s:0:"";s:23:"noms_prenoms_declarants";s:0:"";s:17:"REFERENCEDELAVIS1";s:14:"1189935276236C";s:14:"NUMEROSFISCAL1";s:11:"1677A035025";s:17:"REFERENCEDELAVIS2";s:0:"";s:13:"NUMEROSFISCAL";s:0:"";s:6:"energy";s:1:"4";s:5:"owner";s:1:"0";s:8:"batiment";s:1:"0";s:9:"type_pose";s:1:"0";}s:12:"STEPHANEPOSE";a:7:{s:10:"101deroule";s:0:"";s:11:"101Souflage";s:0:"";s:10:"102deroule";s:0:"";s:10:"103deroule";s:0:"";s:14:"102Polystyrene";s:0:"";s:14:"103Polystyrene";s:77:"110m2, dalle de béton , lampe et tuyauterie au plafond, chaudière a la cave";s:15:"commentairepose";s:0:"";}s:4:"free";a:99:{s:6:"champ0";s:0:"";s:6:"champ1";s:0:"";s:6:"champ7";s:1:"0";s:6:"champ2";s:0:"";s:6:"champ3";s:0:"";s:6:"champ4";s:0:"";s:6:"champ5";s:0:"";s:6:"champ6";s:0:"";s:6:"champ8";s:0:"";s:6:"champ9";s:1:"0";s:7:"champ10";s:1:"1";s:7:"champ11";s:0:"";s:7:"champ12";s:1:"1";s:7:"champ13";s:0:"";s:7:"champ14";s:0:"";s:7:"champ15";s:0:"";s:7:"champ16";s:0:"";s:7:"champ17";s:0:"";s:7:"champ20";s:1:"1";s:7:"champ21";s:0:"";s:7:"champ19";s:1:"0";s:7:"champ22";s:0:"";s:7:"champ23";s:0:"";s:7:"champ24";s:0:"";s:7:"champ25";s:0:"";s:7:"champ26";s:0:"";s:7:"champ27";s:0:"";s:7:"champ28";s:0:"";s:7:"champ29";s:0:"";s:7:"champ30";s:0:"";s:7:"champ31";s:0:"";s:7:"champ32";s:0:"";s:7:"champ33";s:0:"";s:7:"champ34";s:0:"";s:7:"champ35";s:0:"";s:7:"champ36";s:0:"";s:7:"champ37";s:0:"";s:7:"champ38";s:0:"";s:7:"champ39";s:0:"";s:7:"champ40";s:0:"";s:7:"champ41";s:0:"";s:7:"champ42";s:0:"";s:7:"champ43";s:0:"";s:7:"champ44";s:0:"";s:7:"champ45";s:0:"";s:7:"champ46";s:0:"";s:7:"champ47";s:0:"";s:7:"champ48";s:0:"";s:7:"champ49";s:0:"";s:7:"champ50";s:0:"";s:7:"champ51";s:0:"";s:7:"champ52";s:0:"";s:7:"champ53";s:0:"";s:7:"champ54";s:0:"";s:7:"champ55";s:0:"";s:7:"champ56";s:0:"";s:7:"champ57";s:0:"";s:7:"champ58";s:0:"";s:7:"champ59";s:0:"";s:7:"champ60";s:0:"";s:7:"champ61";s:0:"";s:7:"champ62";s:0:"";s:7:"champ63";s:0:"";s:7:"champ64";s:0:"";s:7:"champ65";s:0:"";s:7:"champ66";s:0:"";s:7:"champ67";s:0:"";s:7:"champ68";s:0:"";s:7:"champ69";s:0:"";s:7:"champ70";s:0:"";s:7:"champ71";s:0:"";s:7:"champ72";s:0:"";s:7:"champ73";s:0:"";s:7:"champ74";s:0:"";s:7:"champ75";s:0:"";s:7:"champ76";s:0:"";s:7:"champ77";s:0:"";s:7:"champ78";s:0:"";s:7:"champ79";s:0:"";s:7:"champ80";s:0:"";s:7:"champ81";s:0:"";s:7:"champ82";s:0:"";s:7:"champ83";s:0:"";s:7:"champ84";s:0:"";s:7:"champ85";s:0:"";s:7:"champ86";s:0:"";s:7:"champ87";s:0:"";s:7:"champ88";s:0:"";s:7:"champ89";s:0:"";s:7:"champ90";s:0:"";s:7:"champ91";s:0:"";s:7:"champ92";s:0:"";s:7:"champ93";s:0:"";s:7:"champ94";s:0:"";s:7:"champ95";s:0:"";s:7:"champ96";s:0:"";s:7:"champ97";s:0:"";s:7:"champ98";s:0:"";s:7:"champ99";s:0:"";}s:5:"free1";a:63:{s:8:"champ101";s:0:"";s:8:"champ102";s:0:"";s:8:"champ100";s:0:"";s:8:"champ103";s:0:"";s:8:"champ104";s:0:"";s:8:"champ105";s:0:"";s:8:"champ106";s:0:"";s:8:"champ107";s:0:"";s:8:"champ108";s:0:"";s:8:"champ109";s:0:"";s:8:"champ110";s:0:"";s:8:"champ111";s:0:"";s:8:"champ112";s:0:"";s:8:"champ113";s:0:"";s:8:"champ114";s:0:"";s:8:"champ115";s:0:"";s:8:"champ116";s:0:"";s:8:"champ117";s:0:"";s:8:"champ118";s:0:"";s:8:"champ119";s:0:"";s:8:"champ120";s:0:"";s:8:"champ121";s:0:"";s:8:"champ122";s:0:"";s:8:"champ123";s:0:"";s:8:"champ124";s:0:"";s:8:"champ125";s:0:"";s:8:"champ126";s:0:"";s:8:"champ127";s:0:"";s:8:"champ128";s:0:"";s:8:"champ129";s:0:"";s:8:"champ130";s:0:"";s:8:"champ131";s:0:"";s:8:"champ132";s:0:"";s:8:"champ133";s:0:"";s:8:"champ134";s:0:"";s:8:"champ135";s:0:"";s:8:"champ136";s:0:"";s:8:"champ137";s:0:"";s:8:"champ138";s:0:"";s:8:"champ139";s:0:"";s:8:"champ140";s:0:"";s:8:"champ141";s:0:"";s:8:"champ142";s:0:"";s:8:"champ143";s:0:"";s:8:"champ144";s:0:"";s:8:"champ145";s:0:"";s:8:"champ146";s:0:"";s:8:"champ147";s:0:"";s:8:"champ148";s:0:"";s:8:"champ149";s:0:"";s:8:"champ150";s:0:"";s:8:"champ151";s:0:"";s:8:"champ152";s:0:"";s:8:"champ153";s:0:"";s:8:"champ154";s:0:"";s:8:"champ155";s:0:"";s:8:"champ156";s:0:"";s:8:"champ157";s:0:"";s:8:"champ158";s:0:"";s:8:"champ159";s:0:"";s:8:"champ160";s:0:"";s:8:"champ161";s:0:"";s:8:"champ162";s:0:"";}s:10:"resistance";a:3:{s:24:"resistance_thermique_101";s:0:"";s:24:"resistance_thermique_102";s:0:"";s:24:"resistance_thermique_103";s:0:"";}s:6:"poseur";a:5:{s:3:"nom";s:0:"";s:6:"prenom";s:0:"";s:14:"raison_sociale";s:0:"";s:5:"siret";s:0:"";s:5:"EMAIL";s:0:"";}s:6:"others";a:3:{s:12:"surface_lead";s:0:"";s:17:"nb_personnes_lead";s:0:"";s:12:"revenue_lead";s:0:"";}}';       
        $request=new DomoprimeCustomerRequest(null,$this->getSite());
        $request->add(array(
                'surface_floor'=>$this->getDataFromFormField(self::$settings['surface_floor']), 
                'surface_wall'=>$this->getDataFromFormField(self::$settings['surface_wall']),  // iso.surface_mur
                'surface_top'=>$this->getDataFromFormField(self::$settings['surface_top']),    // iso.surface_comble
                'number_of_people'=>$this->getDataFromFormField(self::$settings['number_of_people']),   // iso.numberofpeople
                'revenue'=>$this->getDataFromFormField(self::$settings['revenue']),
                'number_of_fiscal'=>$this->getDataFromFieldname('iso','nombre_foyers_fiscaux',0),
                'parcel_reference'=>$this->getDataFromFieldname('cadastre','number',""),
                'parcel_surface'=>$this->getDataFromFieldname('cadastre','surface',0),
                'declarants'=>$this->getDataFromFieldname('iso','noms_prenoms_declarants',""),
                'meeting_id'=>$this->get('meeting_id'),
                'customer_id'=>$this->getMeeting()->get('customer_id'),
                'energy_id'=>$this->getEnergy($this->getDataFromFieldname('iso','energy',0)),    // iso.energy
                'occupation_id'=>$this->getOwner($this->getDataFromFieldname('iso','owner',0)),  // iso.owner
                'more_2_years'=>$this->getMore2years($this->getDataFromFieldname('iso','batiment',0)),   // iso.batiment
                'layer_type_id'=>$this->getTypeLayer($this->getDataFromFieldname('iso','type_pose',0))
            ));         
        return $request;
    }
    
    function transfertToRequestContract()
    {
        if ($siret_layer=$this->getDataFromFieldname('poseur','siret',null))
        {
            $layer=new PartnerLayerCompany(array('siret'=>$siret_layer),$this->getSite());
            if ($layer->isLoaded())
            {                
                 $this->getContract()->set('partner_layer_id',$layer)->save();
            }
        }                                       
      //  $this->data='a:7:{s:3:"iso";a:15:{s:14:"surface_comble";i:0;s:11:"surface_mur";i:0;s:16:"surface_plancher";i:110;s:14:"numberofpeople";i:5;s:7:"revenue";i:44372;s:21:"nombre_foyers_fiscaux";s:0:"";s:23:"noms_prenoms_declarants";s:0:"";s:17:"REFERENCEDELAVIS1";s:14:"1189935276236C";s:14:"NUMEROSFISCAL1";s:11:"1677A035025";s:17:"REFERENCEDELAVIS2";s:0:"";s:13:"NUMEROSFISCAL";s:0:"";s:6:"energy";s:1:"4";s:5:"owner";s:1:"0";s:8:"batiment";s:1:"0";s:9:"type_pose";s:1:"0";}s:12:"STEPHANEPOSE";a:7:{s:10:"101deroule";s:0:"";s:11:"101Souflage";s:0:"";s:10:"102deroule";s:0:"";s:10:"103deroule";s:0:"";s:14:"102Polystyrene";s:0:"";s:14:"103Polystyrene";s:77:"110m2, dalle de béton , lampe et tuyauterie au plafond, chaudière a la cave";s:15:"commentairepose";s:0:"";}s:4:"free";a:99:{s:6:"champ0";s:0:"";s:6:"champ1";s:0:"";s:6:"champ7";s:1:"0";s:6:"champ2";s:0:"";s:6:"champ3";s:0:"";s:6:"champ4";s:0:"";s:6:"champ5";s:0:"";s:6:"champ6";s:0:"";s:6:"champ8";s:0:"";s:6:"champ9";s:1:"0";s:7:"champ10";s:1:"1";s:7:"champ11";s:0:"";s:7:"champ12";s:1:"1";s:7:"champ13";s:0:"";s:7:"champ14";s:0:"";s:7:"champ15";s:0:"";s:7:"champ16";s:0:"";s:7:"champ17";s:0:"";s:7:"champ20";s:1:"1";s:7:"champ21";s:0:"";s:7:"champ19";s:1:"0";s:7:"champ22";s:0:"";s:7:"champ23";s:0:"";s:7:"champ24";s:0:"";s:7:"champ25";s:0:"";s:7:"champ26";s:0:"";s:7:"champ27";s:0:"";s:7:"champ28";s:0:"";s:7:"champ29";s:0:"";s:7:"champ30";s:0:"";s:7:"champ31";s:0:"";s:7:"champ32";s:0:"";s:7:"champ33";s:0:"";s:7:"champ34";s:0:"";s:7:"champ35";s:0:"";s:7:"champ36";s:0:"";s:7:"champ37";s:0:"";s:7:"champ38";s:0:"";s:7:"champ39";s:0:"";s:7:"champ40";s:0:"";s:7:"champ41";s:0:"";s:7:"champ42";s:0:"";s:7:"champ43";s:0:"";s:7:"champ44";s:0:"";s:7:"champ45";s:0:"";s:7:"champ46";s:0:"";s:7:"champ47";s:0:"";s:7:"champ48";s:0:"";s:7:"champ49";s:0:"";s:7:"champ50";s:0:"";s:7:"champ51";s:0:"";s:7:"champ52";s:0:"";s:7:"champ53";s:0:"";s:7:"champ54";s:0:"";s:7:"champ55";s:0:"";s:7:"champ56";s:0:"";s:7:"champ57";s:0:"";s:7:"champ58";s:0:"";s:7:"champ59";s:0:"";s:7:"champ60";s:0:"";s:7:"champ61";s:0:"";s:7:"champ62";s:0:"";s:7:"champ63";s:0:"";s:7:"champ64";s:0:"";s:7:"champ65";s:0:"";s:7:"champ66";s:0:"";s:7:"champ67";s:0:"";s:7:"champ68";s:0:"";s:7:"champ69";s:0:"";s:7:"champ70";s:0:"";s:7:"champ71";s:0:"";s:7:"champ72";s:0:"";s:7:"champ73";s:0:"";s:7:"champ74";s:0:"";s:7:"champ75";s:0:"";s:7:"champ76";s:0:"";s:7:"champ77";s:0:"";s:7:"champ78";s:0:"";s:7:"champ79";s:0:"";s:7:"champ80";s:0:"";s:7:"champ81";s:0:"";s:7:"champ82";s:0:"";s:7:"champ83";s:0:"";s:7:"champ84";s:0:"";s:7:"champ85";s:0:"";s:7:"champ86";s:0:"";s:7:"champ87";s:0:"";s:7:"champ88";s:0:"";s:7:"champ89";s:0:"";s:7:"champ90";s:0:"";s:7:"champ91";s:0:"";s:7:"champ92";s:0:"";s:7:"champ93";s:0:"";s:7:"champ94";s:0:"";s:7:"champ95";s:0:"";s:7:"champ96";s:0:"";s:7:"champ97";s:0:"";s:7:"champ98";s:0:"";s:7:"champ99";s:0:"";}s:5:"free1";a:63:{s:8:"champ101";s:0:"";s:8:"champ102";s:0:"";s:8:"champ100";s:0:"";s:8:"champ103";s:0:"";s:8:"champ104";s:0:"";s:8:"champ105";s:0:"";s:8:"champ106";s:0:"";s:8:"champ107";s:0:"";s:8:"champ108";s:0:"";s:8:"champ109";s:0:"";s:8:"champ110";s:0:"";s:8:"champ111";s:0:"";s:8:"champ112";s:0:"";s:8:"champ113";s:0:"";s:8:"champ114";s:0:"";s:8:"champ115";s:0:"";s:8:"champ116";s:0:"";s:8:"champ117";s:0:"";s:8:"champ118";s:0:"";s:8:"champ119";s:0:"";s:8:"champ120";s:0:"";s:8:"champ121";s:0:"";s:8:"champ122";s:0:"";s:8:"champ123";s:0:"";s:8:"champ124";s:0:"";s:8:"champ125";s:0:"";s:8:"champ126";s:0:"";s:8:"champ127";s:0:"";s:8:"champ128";s:0:"";s:8:"champ129";s:0:"";s:8:"champ130";s:0:"";s:8:"champ131";s:0:"";s:8:"champ132";s:0:"";s:8:"champ133";s:0:"";s:8:"champ134";s:0:"";s:8:"champ135";s:0:"";s:8:"champ136";s:0:"";s:8:"champ137";s:0:"";s:8:"champ138";s:0:"";s:8:"champ139";s:0:"";s:8:"champ140";s:0:"";s:8:"champ141";s:0:"";s:8:"champ142";s:0:"";s:8:"champ143";s:0:"";s:8:"champ144";s:0:"";s:8:"champ145";s:0:"";s:8:"champ146";s:0:"";s:8:"champ147";s:0:"";s:8:"champ148";s:0:"";s:8:"champ149";s:0:"";s:8:"champ150";s:0:"";s:8:"champ151";s:0:"";s:8:"champ152";s:0:"";s:8:"champ153";s:0:"";s:8:"champ154";s:0:"";s:8:"champ155";s:0:"";s:8:"champ156";s:0:"";s:8:"champ157";s:0:"";s:8:"champ158";s:0:"";s:8:"champ159";s:0:"";s:8:"champ160";s:0:"";s:8:"champ161";s:0:"";s:8:"champ162";s:0:"";}s:10:"resistance";a:3:{s:24:"resistance_thermique_101";s:0:"";s:24:"resistance_thermique_102";s:0:"";s:24:"resistance_thermique_103";s:0:"";}s:6:"poseur";a:5:{s:3:"nom";s:0:"";s:6:"prenom";s:0:"";s:14:"raison_sociale";s:0:"";s:5:"siret";s:0:"";s:5:"EMAIL";s:0:"";}s:6:"others";a:3:{s:12:"surface_lead";s:0:"";s:17:"nb_personnes_lead";s:0:"";s:12:"revenue_lead";s:0:"";}}';       
        $request=new DomoprimeCustomerRequest(null,$this->getSite());
        $request->add(array(
                'surface_floor'=>$this->getDataFromFormField(self::$settings['surface_floor']), 
                'surface_wall'=>$this->getDataFromFormField(self::$settings['surface_wall']),  // iso.surface_mur
                'surface_top'=>$this->getDataFromFormField(self::$settings['surface_top']),    // iso.surface_comble
                'number_of_people'=>$this->getDataFromFormField(self::$settings['number_of_people']),   // iso.numberofpeople
                'revenue'=>$this->getDataFromFormField(self::$settings['revenue']),
                'number_of_fiscal'=>$this->getDataFromFieldname('iso','nombre_foyers_fiscaux',0),
                'parcel_reference'=>$this->getDataFromFieldname('cadastre','number',""),
                'parcel_surface'=>$this->getDataFromFieldname('cadastre','surface',0),
                'declarants'=>$this->getDataFromFieldname('iso','noms_prenoms_declarants',""),
                'contract_id'=>$this->get('contract_id'),
                'customer_id'=>$this->getContract()->get('customer_id'),
                'energy_id'=>$this->getEnergy($this->getDataFromFieldname('iso','energy',0)),    // iso.energy
                'occupation_id'=>$this->getOwner($this->getDataFromFieldname('iso','owner',0)),  // iso.owner
                'more_2_years'=>$this->getMore2years($this->getDataFromFieldname('iso','batiment',0)),   // iso.batiment
                'layer_type_id'=>$this->getTypeLayer($this->getDataFromFieldname('iso','type_pose',0))
            ));         
        return $request;
    }
    
    
    function getEnergy($energy)
    {
        $energies=array("Combustible",   // Combustible
                        "Electricité", // electricity
                        "Gaz naturel", // gaz naturel
                        "GPL", // gpl
                        "Fioul", // fioul
                        "Bois", // Bois
                        "Pompe à chaleur air eau", //Pompe à chaleur air eau
                        "Pompe à chaleur air air", // Pompe à chaleur air air
                        "Autre combustible"  // Autre combustible
                        ); // 0 Elec 1 autres
        $i18n=isset($energies[$energy])?$energies[$energy]:0;
        return self::$settings['energies'][$i18n]?self::$settings['energies'][$i18n]:0;
    }
    
    function getMore2years($more_two_years)
    {
        $values=array('YES','NO'); // 0 Oui 1 Non
        return isset($values[$more_two_years])?$values[$more_two_years]:"NO";
    }
    
    function getOwner($owner)
    {
        $values=array(
            2, //Propriétaire occupant
            1, // Proprietaire non ocupant
            0 // Locataire
        );
        return isset(self::$settings['occupations'][$values[$owner]])?self::$settings['occupations'][$values[$owner]]:0;
    }
    
    function getTypeLayer($layer)
    {
        $values=array(            
            0, // en comble perdus
            1 // en rampant de toitures           
        );
        return isset(self::$settings['type_layers'][$values[$layer]])?self::$settings['type_layers'][$values[$layer]]:0;
    }
    
    
    function transfertToRequestFromContract($request)
    {
        if ($siret_layer=$this->getDataFromFieldname('poseur','siret',null))
        {
            $layer=new PartnerLayerCompany(array('siret'=>$siret_layer),$this->getSite());
            if ($layer->isLoaded())
            {                
                 $this->getContract()->set('partner_layer_id',$layer)->save();
            }
        }                                                   
        $request->add(array(
                'surface_floor'=>$this->getDataFromFormField(self::$settings['surface_floor']), 
                'surface_wall'=>$this->getDataFromFormField(self::$settings['surface_wall']),  // iso.surface_mur
                'surface_top'=>$this->getDataFromFormField(self::$settings['surface_top']),    // iso.surface_comble
                'number_of_people'=>$this->getDataFromFormField(self::$settings['number_of_people']),   // iso.numberofpeople
                'revenue'=>$this->getDataFromFormField(self::$settings['revenue']),
                'number_of_fiscal'=>$this->getDataFromFieldname('iso','nombre_foyers_fiscaux',0),
                'parcel_reference'=>$this->getDataFromFieldname('cadastre','number',""),
                'parcel_surface'=>$this->getDataFromFieldname('cadastre','surface',0),
                'declarants'=>$this->getDataFromFieldname('iso','noms_prenoms_declarants',""),               
                'energy_id'=>$this->getEnergy($this->getDataFromFieldname('iso','energy',0)),    // iso.energy
                'occupation_id'=>$this->getOwner($this->getDataFromFieldname('iso','owner',0)),  // iso.owner
                'more_2_years'=>$this->getMore2years($this->getDataFromFieldname('iso','batiment',0)),   // iso.batiment
                'layer_type_id'=>$this->getTypeLayer($this->getDataFromFieldname('iso','type_pose',0))
            ));         
        return $request;
    }
}
