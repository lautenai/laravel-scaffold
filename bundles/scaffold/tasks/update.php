<?php

use Laravel\CLI\Command;

class Scaffold_Update_Task {

	/**
	 * Create a new scaffold.
	 *
	 * @param  array  $arguments
	 * @return void
	 */
	public function run($arguments)
	{
		Command::run(array('scaffold::make'));
	}
}