<?php
namespace app\modules\users\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m200922_092129_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'email' => $this->string(200)
                ->notNull()
                ->comment('Email'),
            'password' => $this->string(255)
                ->notNull()
                ->comment('Password'),
            'login' => $this->string(100)
                ->comment('Name'),
            'status' => $this->integer()
                ->comment('Status'),
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
