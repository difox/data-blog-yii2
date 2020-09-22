<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\blog\searches\PostCommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Post Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-comment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user.login',
            'text:ntext',
            [
                'attribute' => 'hide',
                'value' => function($model) {
                    return $model->hide ? 'Yes' : 'No';
                }
            ],
            //'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
