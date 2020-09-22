<?php

namespace app\modules\blog\models;

use app\modules\blog\queries\PostCommentQuery;
use app\modules\users\models\User;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "posts_comments".
 *
 * @property int $id
 * @property int $post_id
 * @property int $user_id
 * @property string|null $text
 * @property int|null $hide
 * @property string $created_at
 */
class PostComment extends ActiveRecord
{
    const SCENARIO_ADD_COMMENT_FORM = 'add_comment_form';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'posts_comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_id'], 'required'],
            [['post_id', 'user_id', 'hide'], 'integer'],
            [['created_at'], 'default', 'value' => date('Y-m-d H:i:s')],
            [['user_id'], 'default', 'value' => 1],
            [['text'], 'safe'],
            [['created_at'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return array_merge(parent::scenarios(), [
             self::SCENARIO_ADD_COMMENT_FORM => ['text', 'post_id', 'user_id', 'created_at'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'user_id' => 'User ID',
            'user.login' => 'User',
            'text' => 'Text',
            'hide' => 'Hide',
            'created_at' => 'Created At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return PostCommentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostCommentQuery(get_called_class());
    }

    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
