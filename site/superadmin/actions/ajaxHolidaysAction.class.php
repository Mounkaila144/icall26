<?php

class site_ajaxHolidaysAction extends mfAction {

    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();
        echo "<div>".__("not implemented: see ").__CLASS__." class </div>";
        return mfView::NONE;
    }

}

