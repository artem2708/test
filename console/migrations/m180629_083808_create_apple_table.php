<?php

use yii\db\Migration;

/**
 * Class m180629_083808_add_hdd
 */
class m180629_083808_create_apple_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('apples',
            [
                'id' => $this->primaryKey(),
                'color' => $this->string(255),
                'created_time' => $this->integer(11),
                'fall_time' => $this->integer(11),
                'percent' => $this->float(3)->defaultValue('100'),
                'status' => "ENUM('UP', 'DOWN', 'ROTTEN') DEFAULT 'UP'",
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('apples');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180629_083808_add_hdd cannot be reverted.\n";

        return false;
    }
    */
}
