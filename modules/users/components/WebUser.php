<?php
namespace app\modules\users\components;

class WebUser extends \yii\web\User
{
    /**
     * Check user role
     * 
     * @param type $roleName
     * @return type
     */
    public function is($roleName)
    {
        $roles = \Yii::$app->authManager->getRolesByUser($this->id);

        return in_array($roleName, array_keys($roles));
    }
}