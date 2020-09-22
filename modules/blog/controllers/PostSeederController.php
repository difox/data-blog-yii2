<?php
namespace app\modules\blog\controllers;

use app\modules\blog\models\Post;
use app\modules\blog\models\PostComment;
use tebazil\yii2seeder\Seeder;
use yii\console\Controller;

/**
 * Seed Post table
 */
class PostSeederController extends Controller
{
    public function actionIndex()
    {
        $seeder = new Seeder();
        $generator = $seeder->getGeneratorConfigurator();
        $faker = $generator->getFakerConfigurator();

        // clear post table for Dev
        if (YII_ENV_DEV) {
            Post::deleteAll();
            PostComment::deleteAll();
        }

        $seeder->table('posts')->columns([
            'id',
            'user_id' => 1,
            'title' => $faker->sentence(6),
            'description' => $faker->text(500),
            'published' => 1,
            'url' => $faker->slug,
            'created_at' => $faker->date('Y-m-d H:i:s'),
        ])->rowQuantity(10);

        $seeder->refill();

        $posts = Post::find()->all();

        foreach ($posts as $post) {
            for ($i = 1; $i <= 3; $i++) {
                $postComment = new PostComment();
                $postComment->post_id = $post->id;
                $postComment->user_id = 1;
                $postComment->text = 'Test comment ' . $i;
                $postComment->created_at = date('Y-m-d H:i:s');

                if (!$postComment->save()) {
                    echo '<pre>'; die(var_dump($postComment->getErrors())); echo '</pre>';
                }
            }
        }
    }
}