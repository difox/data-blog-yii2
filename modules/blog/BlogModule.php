<?php
namespace app\modules\blog;

class BlogModule extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\blog\controllers';

    public function bootstrap()
    {
        \Yii::$app->getUrlManager()->addRules([            
            [
                'class' => 'app\modules\blog\components\UrlRule',
            ],
            '/blog/<id:\w+>' => 'blog/post/view',
            '/blog' => 'blog/post/index',
            '/comment-add' => 'blog/post-comment/create',
        ], true);

        return parent::init();
    }
}
