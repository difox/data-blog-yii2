<?php
namespace app\modules\blog\components;

use app\modules\blog\models\Post;

class UrlRule extends \yii\base\BaseObject implements \yii\web\UrlRuleInterface
{
    public function createUrl($manager, $route, $params)
    {
        return false;
    }

    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();

        // Check is URL blog's post permalink
        $post = Post::find()->byUrl(trim($pathInfo, '/'))->one();

        if ($post) {
            return ['blog/post/view', ['id' => $post->id]];
        }

        return false;
    }
}