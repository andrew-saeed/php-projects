<?

namespace App\Validations\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class ExistsInDatabaseException extends ValidationException {

    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'not already exists'
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => 'already exists'
        ]
    ];
}