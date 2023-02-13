<?php

use yii\db\Migration;

/**
 * Class m230212_141855_research_table
 */
class m230212_141855_research_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('research_table', [
            'id' => $this->primaryKey(),
            'uid' => $this->integer(8)->notNull(),
            'url' => $this->string(255)->notNull(),
            'start_time' => $this->integer(11)->notNull(),
            'end_time' => $this->integer(11)->notNull(),
            'status' => $this->string(175)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		$this->dropTable('research_table');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230212_141855_research_table cannot be reverted.\n";

        return false;
    }
    */
}
