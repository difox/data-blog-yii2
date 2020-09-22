<?php
namespace app\modules\users\models;

use app\components\helpers\Utilities;

/**
 * This is the model class for table "{{%users}}".
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $login
 * @property string $phone
 * @property int $hash
 * @property int $status
 */
class User extends \app\modules\users\components\UserIdentity
{
    const SCENARIO_SIGNUP = 'signup';
    const SCENARIO_SIGNUP_CONFIRM = 'signup_confirm';
    const SCENARIO_LOGIN = 'login';
    const SCENARIO_CREATE = 'insert';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            [['hash', 'status'], 'integer'],
            [['email'], 'string', 'max' => 200],
            [['password', 'auth_key'], 'string', 'max' => 255],
            [['login'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 32],
            [['email'], 'email'],
            [['status'], 'default', 'value'=>self::STATUS_ACTIVE],
            [['passwordGenerated'], 'safe'],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();

        $scenarios[self::SCENARIO_CREATE] = ['email','password','phone','login','status'];

        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
            'login' => 'Name',
            'status' => 'Status',
            'role' => 'Role',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (in_array($this->scenario, [self::SCENARIO_SIGNUP, self::SCENARIO_CHANGE_PASSWORD, self::SCENARIO_PROFILE_CHANGE_PASSWORD])) {
                $this->password = $this->encryptPassword($this->password);
            }
            
            return true;
        }
        
        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
        if (in_array($this->scenario, [self::SCENARIO_CREATE])) {
            \Yii::$app->authManager->assign(\Yii::$app->authManager->getRole('registered'), $this->id);
        }

        return parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @inheritdoc
     * @return \app\modules\users\queries\UserBackendQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\users\queries\UserQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function getRole()
    {
        $roles = \Yii::$app->authManager->getRolesByUser($this->id);
        reset($roles);

        return key($roles);
    }
}
