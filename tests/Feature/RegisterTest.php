<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Modules\User\Entities\User;

class RegisterTest extends TestCase
{
	use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUser()
    {
    	$this->post('user', [
    		"_token" => "ulS0fVbFoFlVPEGu3DiiShur5XWrHJxpjNRceZOf",
    		"name" => "Saaad",
    		"email" => "saad@gmail.coom",
    		"role" => "1",
    		"password" => "123456",
    		"password_re" => "123456"
    		]);
    	$this->assertDatabaseHas('users', ['email' => 'saad@gmail.coom']);
    	$user = User::where('email', 'saad@gmail.coom')->get();
    	$this->assertDatabaseHas('role_user', ['user_id' => $user[0]->id]);
    }
}
