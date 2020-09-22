<?php

namespace app\modules\blog\queries;

/**
 * This is the ActiveQuery class for [[\app\modules\blog\models\Post]].
 *
 * @see \app\modules\blog\models\Post
 */
class PostQuery extends \yii\db\ActiveQuery
{
    /**
     * @return \app\modules\blog\queries\PostQuery
     */
    public function published()
    {
        return $this->andWhere('[[published]] = 1');
    }

    /**
     * @return \app\modules\blog\queries\PostQuery
     */
    public function byUrl(string $url)
    {
        return $this->andWhere(['url' => $url]);
    }

    /**
     * @return \app\modules\blog\queries\PostQuery
     */
    public function newToOld()
    {
        return $this->orderBy('created_at DESC');
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\blog\models\Post[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\blog\models\Post|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
