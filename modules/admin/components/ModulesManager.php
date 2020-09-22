<?php
namespace app\modules\admin\components;

use \yii\helpers\FileHelper;

class ModulesManager implements \yii\base\BootstrapInterface
{
    // List of applied modules
    public $modules;

    public function bootstrap($app)
    {
        // Check modules folder for modules list
        $modulesDirs = FileHelper::findDirectories(\Yii::$app->basePath.'/modules', [
            'recursive' => false,
        ]);

        // Init every modules
        foreach ($modulesDirs as $moduleDir) {
            $module = basename($moduleDir);
            $moduleNamespace = 'app\modules\\'.$module;
            \Yii::$app->setModule($module, [
                'class' => $moduleNamespace.'\\'.ucfirst($module).'Module',
            ]);

            // call module bootstrap function
            if (method_exists(\Yii::$app->getModule($module), 'bootstrap')) {
                \Yii::$app->getModule($module)->bootstrap(\Yii::$app);
            }

            // add module migrations to migrate action
            if (isset(\Yii::$app->controllerMap['migrate'])) {
                \Yii::$app->controllerMap['migrate']['migrationNamespaces'][] = $moduleNamespace.'\\migrations';
            }

            // set module alias
            \Yii::setAlias('@'.$module, $moduleDir);
        }

    }
}