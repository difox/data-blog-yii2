<?php
namespace app\modules\blog\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%posts}}`.
 */
class m200922_045814_create_posts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%posts}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(512)->notNull(),
            'description' => $this->text(),
            'url' => $this->string(1024)->notNull(),
            'user_id' => $this->integer(),
            'published' => $this->boolean(),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%posts}}');
    }
}
