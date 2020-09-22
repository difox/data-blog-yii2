<?php

namespace app\modules\blog\queries;

/**
 * This is the ActiveQuery class for [[\app\modules\blog\models\PostComment]].
 *
 * @see \app\modules\blog\models\PostComment
 */
class PostCommentQuery extends \yii\db\ActiveQuery
{
    public function published()
    {
        return $this->andWhere('[[hide]] != 1');
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\blog\models\PostComment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\blog\models\PostComment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
