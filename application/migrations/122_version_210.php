<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Version_210 extends CI_Migration {

    function __construct() {
        parent::__construct();
    }

    public function up() {
        //===================add fee_groups table=========
        $this->dbforge->add_field(
                array(
                    'id' => array(
                        'type' => 'INT',
                        'constraint' => 11,
                        'unsigned' => true,
                        'auto_increment' => true
                    ),
                    'name' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                        'null' => true,
                        'default' => NULL,
                    ),
                    'description' => array(
                        'type' => 'TEXT',
                        'null' => true,
                    ),
                    'is_active' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '10',
                        'default' => 'no'
                    ),
                    'created_at' => array(
                        'type' => 'timestamp'
                    ),
                )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('fee_groups');


        //===============Add Colomn in feetype=========================

        $fields = array(
            'code' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
                'after' => 'type'
            )
        );

        $this->dbforge->add_column('feetype', $fields);
		
        $fields = array(
            'description' => array(
                'type' => 'TEXT',               
                'null' => false
            )
        );

        $this->dbforge->add_column('feetype', $fields);		
        //===================add fee_session_groups table=========
        $this->dbforge->add_field(
                array(
                    'id' => array(
                        'type' => 'INT',
                        'constraint' => 11,
                        'unsigned' => true,
                        'auto_increment' => true
                    ),
                    'fee_groups_id' => array(
                        'type' => 'INT',
                        'constraint' => 11,
                        'null' => true,
                        'default' => NULL,
                    ),
                    'session_id' => array(
                        'type' => 'INT',
                        'constraint' => 11,
                        'null' => true,
                        'default' => NULL,
                    ),
                    'is_active' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '10',
                        'default' => 'no'
                    ),
                    'created_at' => array(
                        'type' => 'timestamp'
                    ),
                )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('fee_session_groups');
     
        //===================add fee_groups_feetype table=========
        $this->dbforge->add_field(
                array(
                    'id' => array(
                        'type' => 'INT',
                        'constraint' => 11,
                        'unsigned' => true,
                        'auto_increment' => true
                    ),
                    'fee_session_group_id' => array(
                        'type' => 'INT',
                        'constraint' => 11,
                        'null' => true,
                        'default' => NULL,
                    ),
                    'fee_groups_id' => array(
                        'type' => 'INT',
                        'constraint' => 11,
                        'null' => true,
                        'default' => NULL,
                    ),
                    'feetype_id' => array(
                        'type' => 'INT',
                        'constraint' => 11,
                        'null' => true,
                        'default' => NULL,
                    ),
                    'session_id' => array(
                        'type' => 'INT',
                        'constraint' => 11,
                        'null' => true,
                        'default' => NULL,
                    ),
                    'due_date' => array(
                        'type' => 'date',
                        'null' => true,
                        'default' => NULL,
                    ),
                    'amount' => array(
                        'type' => 'DECIMAL',
                        'constraint' => '10,2',
                        'default' => 0.00,
                        'null' => true,
                        'default' => NULL,
                    ),
                    'is_active' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '10',
                        'default' => 'no'
                    ),
                    'created_at' => array(
                        'type' => 'timestamp'
                    ),
                )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('fee_groups_feetype');
      


        //===================add student_fees_master table=========
        $this->dbforge->add_field(
                array(
                    'id' => array(
                        'type' => 'INT',
                        'constraint' => 11,
                        'unsigned' => true,
                        'auto_increment' => true
                    ),
                    'student_session_id' => array(
                        'type' => 'INT',
                        'constraint' => 11,
                        'null' => true,
                        'default' => NULL,
                    ),
                    'fee_session_group_id' => array(
                        'type' => 'INT',
                        'constraint' => 11,
                        'null' => true,
                        'default' => NULL,
                    ),
                    'is_active' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '10',
                        'default' => 'no'
                    ),
                    'created_at' => array(
                        'type' => 'timestamp'
                    ),
                )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('student_fees_master');
      

        //===================add student_fees_deposite table=========
        $this->dbforge->add_field(
                array(
                    'id' => array(
                        'type' => 'INT',
                        'constraint' => 11,
                        'unsigned' => true,
                        'auto_increment' => true
                    ),
                    'student_fees_master_id' => array(
                        'type' => 'INT',
                        'constraint' => 11,
                        'null' => true,
                        'default' => NULL,
                    ),
                    'fee_groups_feetype_id' => array(
                        'type' => 'INT',
                        'constraint' => 11,
                        'null' => true,
                        'default' => NULL,
                    ),
                    'amount_detail' => array(
                        'type' => 'TEXT',
                        'null' => true,
                        'default' => NULL,
                    ),
                    'is_active' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '10',
                        'default' => 'no'
                    ),
                    'created_at' => array(
                        'type' => 'timestamp'
                    ),
                )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('student_fees_deposite');
        //===================add fees_discounts table=========
        $this->dbforge->add_field(
                array(
                    'id' => array(
                        'type' => 'INT',
                        'constraint' => 11,
                        'unsigned' => true,
                        'auto_increment' => true
                    ),
                      'session_id' => array(
                        'type' => 'INT',
                        'constraint' => 11,
                        'null' => true,
                        'default' => NULL,
                    ),
                    'name' => array(
                     'type' => 'VARCHAR',
                        'constraint' => '100',
                        'null' => true,
                        'default' => NULL,
                    ),
                    'code' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '100',
                        'null' => true,
                        'default' => NULL,
                    ),
                    'amount' => array(
                           'type' => 'DECIMAL',
                        'constraint' => '10,2',
                        'default' => 0.00,
                        'null' => true,
                        'default' => NULL,
                    ),
                    'description' => array(
                        'type' => 'TEXT',
                        'null' => true,
                        'default' => NULL,
                    ),
                     
                    'is_active' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '10',
                        'default' => 'no'
                    ),
                    'created_at' => array(
                        'type' => 'timestamp'
                    ),
                )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('fees_discounts');
//===================add student_fees_discounts table=========
        $this->dbforge->add_field(
                array(
                    'id' => array(
                        'type' => 'INT',
                        'constraint' => 11,
                        'unsigned' => true,
                        'auto_increment' => true
                    ),
                    'student_session_id' => array(
                        'type' => 'INT',
                        'constraint' => 11,
                        'null' => true,
                        'default' => NULL,
                    ),
                    'fees_discount_id' => array(
                        'type' => 'INT',
                        'constraint' => 11,
                        'null' => true,
                        'default' => NULL,
                    ),					
                    'status' => array(
                        'type' => 'VARCHAR',
                        'constraint' => 20,
                        'null' => true,
                        'default' => 'assigned',
                    ),
                    'payment_id' => array(
                        'type' => 'VARCHAR',
                        'constraint' => 50,
                        'null' => true,
                        'default' => NULL,
                    ),
                    'description' => array(
                        'type' => 'TEXT',                        
                        'null' => true,
                        'default' => NULL,
                    ),
                    'is_active' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '10',
                        'default' => 'no'
                    ),
                    'created_at' => array(
                        'type' => 'timestamp'
                    ),
                )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('student_fees_discounts');
      
//=========insert record in email_config table==========
                $this->dbforge->add_field(
                array(
                    'id' => array(
                        'type' => 'INT',
                        'constraint' => 11,
                        'unsigned' => true,
                        'auto_increment' => true
                    ),

                    'email_type' => array(
                         'type' => 'VARCHAR',
                        'constraint' => '100',
                        'null' => true,
                        'default' => NULL,
                    ),
                    'smtp_server' => array(
                         'type' => 'VARCHAR',
                        'constraint' => '100',
                        'null' => true,
                        'default' => NULL,
                    ),
                    'smtp_port' => array(
                       'type' => 'VARCHAR',
                        'constraint' => '100',
                        'null' => true,
                        'default' => NULL,
                    ), 
                    'smtp_username' => array(
                         'type' => 'VARCHAR',
                        'constraint' => '100',
                        'null' => true,
                        'default' => NULL,
                    ),
                      'smtp_password' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '100',
                        'null' => true,
                        'default' => NULL,
                    ),
                       'ssl_tls' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '100',
                        'null' => true,
                        'default' => NULL,
                    ),
                    'is_active' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '10',
                        'default' => 'no'
                    ),
                    'created_at' => array(
                        'type' => 'timestamp'
                    ),
                )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('email_config');

        $this->db->query("INSERT INTO `email_config` (`id`, `email_type`, `smtp_server`, `smtp_port`, `smtp_username`, `smtp_password`, `ssl_tls`, `is_active`) VALUES (NULL, 'smtp', 'smtp.gmail.com', '587', 'xxxx', 'xxxx', 'tls', 'enabled');");
//=========add keys==========
        $data = array(
            array('key' => 'fees_group'),
            array('key' => 'add_fees_group'),
            array('key' => 'fees_group_list'),
            array('key' => 'due_date'),
            array('key' => 'fees_code'),
            array('key' => 'fees_discount'),
            array('key' => 'edit_fees_discount'),
            array('key' => 'discount_code'),
            array('key' => 'fees_discount_list'),
            array('key' => 'add_fees_discount'),
            array('key' => 'all'),
            array('key' => 'assign_fees_discount'),
            array('key' => 'partial'),
            array('key' => 'applied'),
            array('key' => 'student_fees'),
            array('key' => 'confirmation'),
            array('key' => 'assign / view'),
            array('key' => 'edit_fees_group'),
            array('key' => 'edit_fees_type'),
            array('key' => 'edit_fees_master'),
            array('key' => 'apply_discount'),
            array('key' => 'discount_of'),
            array('key' => 'add_member'),
            array('key' => 'email_setting'),
            array('key' => 'email_engine'),
            array('key' => 'smtp_username'),
            array('key' => 'smtp_password'),
            array('key' => 'smtp_server'),
            array('key' => 'smtp_port'),
            array('key' => 'smtp_security'),
            array('key' => 'assigned'),
            array('key' => 'admin_users'),
            array('key' => 'add_admin_user'),
            array('key' => 'admin_name'),
            array('key' => 'admin_email'),
            array('key' => 'admin_password'),
			array('key' => 'forgot_password'),
			array('key' => 'assign_fees_group')
        );
        $this->db->insert_batch('lang_keys', $data);
    }

    public function down() {
        
    }

}
?>







