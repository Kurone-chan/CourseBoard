<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');
	}

}

class UserTableSeeder extends Seeder {
	public function run()
    {
        User::create(array(
        	'email' => 'zdevine@me.com',
        	'password' => Hash::make('mnwGsQEjs7JbBaEGWLxDrPRCHGkU6t'),
        	'firstname' => 'Zack',
        	'lastname' => 'Devine',
        	'accessid' => 9,
          'acctype' => 'Student',
          'online' => 0
        ));
    }
}

class GroupTableSeeder extends Seeder {
  public function run()
  {
    Group::create(array(
      'uid' => 'testgroup',
      'name' => 'Test Workgroup',
      'about' => 'This is a test workgroup',
      'ownerid' => 1,
      'private' => false,
      'members' => serialize(array(1)),
      'boards' => serialize(array()),
      'files' => serialize(array())
    ));
  }
}

class CourseTableSeeder extends Seeder {
  public function run()
  {
    Course::create(array(
      'uid' => 'IT-210',
      'name' => 'Business Systems Analysis',
      'about' => '',
      'ownerid' => 1,
      'members' => serialize(array(1)),
      'boards' => serialize(array()),
      'files' => serialize(array())
    ));
  }
}