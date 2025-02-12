<?

namespace App\Validations\Exceptions;

use League\Route\Http\Exception;

class CsrfTokenException extends Exception {

    public function __construct(string $message = 'csrf token mismatch', ?Exception $previous = null, int $code = 0)
    {
        parent::__construct(422, $message, $previous, [], $code);
    }
}