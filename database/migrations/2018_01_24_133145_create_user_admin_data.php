<?php


use CodeFlix\Models\User;
use Illuminate\Database\Migrations\Migration;

class CreateUserAdminData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        User::create([
            'name'     => env('ADMIN_DEFAULT_NAME'),
            'email'    => env('ADMIN_DEFAULT_EMAIL'),
            'password' => bcrypt(env('ADMIN_DEFAULT_PASSWORD')),
            'role'     => User::ROLE_ADMIN
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $user = User::where('email', env('ADMIN_DEFAULT_EMAIL'))->first();
        if ($user instanceof User)
        {
            $user->delete();
        }
    }
}
