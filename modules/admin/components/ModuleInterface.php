<?php
namespace app\modules\admin\components;

/**
 * Implements app modules required functionality
 */
interface ModuleInterface
{
    /**
     * Executed when app initialized
     *
     * @param type $app
     */
    public function bootstrap($app);
}
