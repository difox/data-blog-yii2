<?php
namespace app\modules\users\controllers;

use app\modules\users\forms\LoginForm;
use app\modules\users\forms\RecoveryPasswordForm;
use app\modules\users\models\User;
use yii\filters\ContentNegotiator;
use yii\web\Response;

class UserController extends \yii\web\Controller
{
    public function actionLogin()
    {
		if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        $model->scenario = User::SCENARIO_LOGIN;

        if ($model->load(\Yii::$app->request->post()) && $model->login()) {
            return \Yii::$app->controller->goBack();
        }

        $model->password = '';
        
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionSignup()
    {
        $model = new \app\modules\users\forms\SignupForm();

        if ($model->load(\Yii::$app->request->post())) {
            if ($model->signup()) {
                return [
                    'success' => true,
                ];
            }
            else {
                return [
                    'error' => true,
                    'errors' => $model->getErrors()
                ];
            }
        }

        return $this->notFound();
    }

    public function actionRecovery() {
        $model = new RecoveryPasswordForm();
        $model->scenario = User::SCENARIO_RECOVERY_PASSWORD;

        if ($model->load(\Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->recovery()) {
                    return [
                        'success' => true
                    ];
                }
                else {
                    return [
                        'error' => true,
                        'errors' => ['Ошибка авторизации']
                    ];
                }
            }
            else {
                return [
                    'error' => true,
                    'errors' => $model->getErrors()
                ];
            }
        }

        return $this->notFound();
    }

    public function actionLogout() {
        \Yii::$app->user->logout();

        return $this->redirect('/');
    }
}
