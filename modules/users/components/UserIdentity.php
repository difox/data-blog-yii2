<?php
namespace app\modules\users\components;

use yii\base\NotSupportedException;

abstract class UserIdentity extends \yii\db\ActiveRecord  implements \yii\web\IdentityInterface
{
    const IDENTITY_USER_CLASS = 'app\modules\users\models\User';

    const IDENTITY_USER = 'user';
    
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_BANNED = 2;
    
    public static $statusesList = [
        self::STATUS_ACTIVE => 'Активный',
        self::STATUS_BANNED => 'Забанен',
    ];

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

	/**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public function getId()
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password);
    }

    public function encryptPassword($password)
    {
        return \Yii::$app->getSecurity()->generatePasswordHash($password);
    }
}