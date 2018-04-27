<?php

use Phinx\Migration\AbstractMigration;

class PaymentFields extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change() {
        $users = $this->table('users');
		if ( !$users->hasColumn('stripe_id') ) {
            $users->addColumn('stripe_id', 'string', array('null' => true))->save();
        }
        $users->addColumn('is_pro', 'integer', array('null' => true))->save();
        $users->addColumn('last_four', 'string', array('null' => true, 'limit' => 4))->save();


        $usersClients = $this->table('users_clients');
        $usersClients->addColumn('payment_plan', 'string', array('default' => 'free'))->save();
        $usersClients->addColumn('subscription_id', 'string', array('null' => true))->save();
        $usersClients->addColumn('subscription_ends_at', 'datetime', array('null' => true))->save();
    }
}
