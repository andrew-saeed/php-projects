<?

namespace App\Validations\Rules;

use App\Core\Container;
use Illuminate\Database\DatabaseManager;
use Respect\Validation\Rules\Core\Simple;

class ExistsInDatabase extends Simple {

    public function __construct(protected string $table, protected string $column)
    {
        
    }

    public function isValid(mixed $input): bool
    {
        return Container::getInstance()->get(DatabaseManager::class)
        ->table($this->table)
        ->where($this->column, '=', $input)
        ->count() >= 1;
    }
}