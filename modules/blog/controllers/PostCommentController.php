<?php

namespace app\modules\blog\controllers;

use app\modules\blog\models\PostComment;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * PostCommentController implements the CRUD actions for PostComment model.
 */
class PostCommentController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Creates a new PostComment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PostComment();
        $model->scenario = PostComment::SCENARIO_ADD_COMMENT_FORM;

        $model->load(Yii::$app->request->post());

        if ($model->save()) {
            Yii::$app->session->setFlash('success-comment-save', 'Comment saved successfuly');

            return $this->redirect('/' . $model->post->url);
        }

        return $this->redirect('/');
    }

    /**
     * Finds the PostComment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PostComment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PostComment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
