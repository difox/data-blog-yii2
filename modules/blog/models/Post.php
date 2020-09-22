<?php

namespace app\modules\blog\models;

use app\modules\blog\models\PostComment;
use app\modules\blog\queries\PostQuery;
use app\modules\users\models\User;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string $url
 * @property int|null $user_id
 * @property string $created_at
 * @property string|null $updated_at
 */
class Post extends \yii\db\ActiveRecord
{
    const SHORT_DESCRIPTION_LENGTH = 200;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'url'], 'required'],
            [['description'], 'string'],
            [['user_id'], 'integer'],
            [['user_id'], 'default', 'value' => \Yii::$app->user->id],
            [['created_at'], 'default', 'value' => date('Y-m-d H:i:s')],
            [['updated_at'], 'default', 'value' => date('Y-m-d H:i:s')],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 512],
            [['url'], 'string', 'max' => 1024],
            [['url'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'url' => 'Url',
            'user_id' => 'User ID',
            'user.login' => 'User',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return PostQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostQuery(get_called_class());
    }

    public function getComments()
    {
        return $this->hasMany(PostComment::className(), ['post_id' => 'id'])
            ->andWhere('[[hide]] = 0')
            ->orderBy(['created_at' => SORT_DESC]);
    }
    
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getShortDescription()
    {
        return \Yii::$app->text->cut($this->description, self::SHORT_DESCRIPTION_LENGTH);
    }
}
