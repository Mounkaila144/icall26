<?php

class UserGroupUtils extends UserGroupUtilsBase {
       
    static function getGroupsUserList(User $user)
    {
        if (!$user->isLoaded())
           return false;
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array($user->get('id')))
                ->setQuery("SELECT t_groups.id,t_groups.name,t_user_group.user_id
                            FROM t_groups
                            LEFT JOIN t_user_group ON t_user_group.group_id = t_groups.id AND user_id=%d
                            WHERE t_groups.application = @@APPLICATION@@
                            ")               
                ->makeSqlQuery($user->get('application'),$user->getSite()); 
        if (!$db->getNumRows())
            return false;
        $groups=array();
        while ($row=$db->fetchObject('Group'))
        {
           $groups[]=$row;
        }
        return $groups;
    }

   
}

