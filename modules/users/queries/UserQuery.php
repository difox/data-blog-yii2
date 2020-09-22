<?php

namespace app\modules\users\queries;

use app\components\helpers\Utilities;

/**
 * This is the ActiveQuery class for [[\app\modules\users\models\User]].
 *
 * @see \app\modules\users\models\User
 */
class UserQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['status' => User::STATUS_ACTIVE]);
    }

    public function byEmail($email)
    {
        return $this->andWhere(['email' => $email]);
    }
}
