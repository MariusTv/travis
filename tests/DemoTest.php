<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class DemoTest extends TestCase
{
	use DatabaseMigrations;
	 
    public function testVisitTestaiSeeText(){
		 $this->visit('testai')
			->see('Testai');
	}
	
	// public function testCreateUser(){
		// $user = User::create(['name' => 'Harry', 'email' => 'harry@potter.com', 'password' => bcrypt('pass')]);
		
		// $last_user = User::latest()->first();
		
		// $this->assertEquals($user->name, $last_user->name);
		// $this->assertEquals($user->email, $last_user->email);
		// $this->assertEquals($user->password, $last_user->password);
		
		// $this->seeInDatabase('users', ['name' => 'Harry', 'email' => 'harry@potter.com']);
		
	// }
	
	public function testClickLink(){
		$this->visit('testai')
			->click('Keywords')
			->seePageIs('/keywords')
			->see('Keyword tree');
			
	}
	
	public function testUserCreation() {
		$this->visit('testai/create-user');
		$this->seeInDatabase('users', ['name' => 'TestUser', 'email' => 'test@test.com']);
		
	}
	
	
}
