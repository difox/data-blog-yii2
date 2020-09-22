<?php
namespace app\modules\users\forms;

use app\modules\users\models\User;

class LoginForm extends \yii\base\Model
{
    const SCENARIO_LOGIN = 'login';

    public $email;

    public $login;

    public $password;
    
    public $rememberMe = true;

    private $_user = null;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email'], 'required', 'on' => [User::SCENARIO_LOGIN], 'message' => 'Email field must not be empty'],
            [['password'], 'required', 'on' => [User::SCENARIO_LOGIN], 'message' => 'Password field must not be empty'],
            [['email'], 'email'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

     /**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'email' => 'Email',
			'password' => 'Password',
			'login' => 'Login',
		];
    }
    
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Password or email is incorrect');
            }
        }
    }
    
    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        $user = $this->getUser();

        if (!$user) {
            $this->addError($attribute, 'User with such email is not registered');

            return false;
        }

        return \Yii::$app->user->login($user);
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function loginBackend()
    {
        $user = $this->getUser();

        return \Yii::$app->userBackend->login($user);
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::find()->byEmail($this->email)->one();
        }

        return $this->_user;
    }
}
