<?php
namespace app\modules\users;

class UsersModule extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\users\controllers';

    public function bootstrap($app)
    {
        $app->getUrlManager()->addRules([
            '/login' => 'users/user/login',
            '/logout' => 'users/user/logout',
            '/signup' => 'users/user/signup',
        ], false);
    }
}

