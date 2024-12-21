<?php

//require_once dirname(__FILE__)."/../locales/FormFilters/CustomersFormFilter.class.php";

// www.projet3.net/admin/module/site/test/admin/Test
class test_ajaxTestAction extends mfAction {
    
    function execute(mfWebRequest $request)
    {           
        //var_dump(ProductUtils::getProductsAndItemsWithMaster());
        /*die(__METHOD__);
        $messages = mfMessages::getInstance(); 
        try
        {
            $settings = new UserGuardSecuritySettings();
            $options = array(
                                "min_length"=>$settings->get('length_of_pass'),"max_length"=>$settings->get('length_of_pass'),
                                "number_of_special"=>$settings->get('nb_of_specific_chars'),'number_of_digit'=>$settings->get('nb_numbers'),
                                "number_of_upper"=>$settings->get('nb_uppercase'),'special_list'=>$settings->get('list_of_specific_chars'),
                            );
            $case1 = new mfValidatorSecurePassword($options);
            echo " ===================== C1 = 00A./aaa valid ================== <br />";
            var_dump($case1->isValid("00A./aaa"));
            echo " ===================== C2 = 12Aaa##a valide ================== <br />";
            $case2 = new mfValidatorSecurePassword($options);
            var_dump($case2->isValid("12Aaa##a"));
            echo " ===================== C3 = 12U##/., valide ================== <br />";
            $case3 = new mfValidatorSecurePassword($options);
            var_dump($case3->isValid("12U##/.,"));
            echo " ===================== C4 = ZZzz11## valide ================== <br />";
            $case4 = new mfValidatorSecurePassword($options);
            var_dump($case4->isValid("ZZzz11##"));
            echo " ===================== C5 = AAzz..00 valid ================== <br />";
            $case5 = new mfValidatorSecurePassword($options);
            var_dump($case5->isValid("AAzz..00"));
            echo " ===================== C6 = ABab12!! valid ================== <br />";
            $case6 = new mfValidatorSecurePassword($options);
            var_dump($case6->isValid("ABab12!!"));
            echo " ===================== C7 = AaAb2!2. valid ================== <br />";
            $case7 = new mfValidatorSecurePassword($options);
            var_dump($case7->isValid("AaAb2!2."));
            echo " ===================== C8 = aaaaaa11 invalid ================== <br />";
            $case8 = new mfValidatorSecurePassword($options);
            var_dump($case8->isValid("aaaaaa11"));
            echo " ===================== C9 = 11111111 invalid ================== <br />";
            $case9 = new mfValidatorSecurePassword($options);
            var_dump($case9->isValid("11111111"));
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        } */       
    } 
}

