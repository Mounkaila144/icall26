<?php


class default_stats_sqlActionComponent extends mfActionComponent {

        
    function execute(mfWebRequest $request)
    {      
        $this->getController()->setRenderMode(mfView::RENDER_STRING);
        $count=mfSiteDatabase::getCountQuery();
        return "<div>".__("number of %s :%d",array(($count==1?__("query"):__("queries")),$count))."</div>";
    } 
    

}

