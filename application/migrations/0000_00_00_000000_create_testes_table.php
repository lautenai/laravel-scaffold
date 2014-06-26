<?php

class Create_Testes_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{	
		Schema::create('testes', function($table)
		{
			$table->increments('id');

			$table->string('nome');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('testes');
	}

}