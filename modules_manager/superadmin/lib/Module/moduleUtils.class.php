<?php


class moduleUtils {
    
    static function getModules()
    {
        return mfFileSystem::scandir(mfConfig::get('mf_modules_dir'));    
    }
}

