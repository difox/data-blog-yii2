<?php
namespace app\modules\users\migrations;

use yii\db\Migration;

/**
 * Class m200922_092157_add_admin_to_users_table
 */
class m200922_092157_add_admin_to_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%users}}', [
            'id' => 1,
            'email' => 'test@dataart.ru',
            'password' => \Yii::$app->getSecurity()->generatePasswordHash('dataart'),
            'login' => 'Admin',
        ]);

        $userId  = $this->db->getLastInsertID();

        \Yii::$app->authManager->assign(\Yii::$app->authManager->getRole('administrator'), $userId);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200922_092157_add_default_user_to_users_table cannot be reverted.\n";

        return false;
    }
}
