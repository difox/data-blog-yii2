<?php
namespace app\modules\blog\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%posts_comments}}`.
 */
class m200922_083040_create_posts_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%posts_comments}}', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer()->notNull(),            
            'user_id' => $this->integer()->notNull(),
            'text' => $this->text(),
            'hide' => $this->boolean()->notNull(),
            'created_at' => $this->datetime()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%posts_comments}}');
    }
}
