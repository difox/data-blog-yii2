<?php
namespace app\modules\users\migrations;

use yii\db\Migration;
use yii\rbac\Item;

/**
 * Class m200922_092144_add_rbac_roles
 */
class m200922_092144_add_rbac_roles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%auth_item}}', [
            'name' => 'administrator',
            'type' => Item::TYPE_ROLE,
            'description' => 'Администратор сайта',
        ]);

        $this->insert('{{%auth_item}}', [
            'name' => 'registered',
            'type' => Item::TYPE_ROLE,
            'description' => 'Зарегистрированный пользователь',
        ]);

        \Yii::$app->authManager->addChild(
            \Yii::$app->authManager->getRole('administrator'),
            \Yii::$app->authManager->getRole('registered')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200922_092144_add_rbac_roles cannot be reverted.\n";

        return false;
    }
}
