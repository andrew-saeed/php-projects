<?

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser;

class User extends EloquentUser {

    protected $table = 'users';

    protected $guarded = ['id'];
}