<?php

use yii\db\Migration;
use yii\db\Schema;

class m160329_131531_create_profile_table extends Migration
{
	public function safeUp()
	{
		$this->createTable('profile', [
			'user_id' => Schema::TYPE_PK,
			'avatar' => Schema::TYPE_STRING,
			'first_name' => Schema::TYPE_STRING . '(32)',
			'second_name' => Schema::TYPE_STRING . '(32)',
			'middle_name' => Schema::TYPE_STRING . '(32)',
			'birthday' => Schema::TYPE_INTEGER,
			'gender' => Schema::TYPE_SMALLINT,
		]);
		$this->addForeignKey(
				'profile_user' /*название связи*/,
				'profile' /*таблица которую связываем*/,
				'user_id', //поле для связи таблицы которую связываем
				'user', //таблица с которой связываем
				'id', //поле для связи таблицы с которой связываем
				'cascade', // при удалении автоматически удаляется строка у связанной таблицы
				'cascade' // при изменении первичного ключа автоматически изменяется ключ у связанной таблицы
		);
	}

	public function safeDown() // откат защищённой миграции
	{
		$this->dropForeignKey('profile_user', 'profile'); // удалить связь profile_user
		$this->dropTable('profile'); // удалить таблицу profile
	}
}
