<?php

namespace tests\unit\models;

use app\modules\users\forms\LoginForm;

class LoginFormTest extends \Codeception\Test\Unit
{
    private $model;

    protected function _after()
    {
        Yii::$app->user->logout();
    }

    public function testLoginNoUser()
    {
        $this->model = new LoginForm([
            'email' => 'noexist@dataart.ru',
            'password' => 'wrong_password',
        ]);

        expect_not($this->model->login());
        expect_that(Yii::$app->user->isGuest);
    }

    public function testLoginWrongPassword()
    {
        $this->model = new LoginForm([
            'username' => 'test@dataart.ru',
            'password' => 'wrong_password',
        ]);

        expect_not($this->model->login());
        expect_that(Yii::$app->user->isGuest);
        expect($this->model->errors)->hasKey('password');
    }

    public function testLoginCorrect()
    {
        $this->model = new LoginForm([
            'username' => 'test@dataart.ru',
            'password' => '12345',
        ]);

        expect_that($this->model->login());
        expect_not(Yii::$app->user->isGuest);
        expect($this->model->errors)->hasntKey('password');
    }

}
