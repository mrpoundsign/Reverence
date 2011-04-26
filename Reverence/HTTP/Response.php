<?php
namespace Reverence\HTTP;
/**
 * User: bnelson
 * Date: 4/24/11
 * Time: 12:29 AM
 */
 
class Response {
    // 1xx Informational
    const HTTP_STATUS_100 = 'Continue';
    const HTTP_STATUS_101 = 'Switching Protocols';
    const HTTP_STATUS_102 = 'Processing';
    const HTTP_STATUS_122 = 'Request-URI Too Long';

    // 2xx Success
    const HTTP_STATUS_200 = 'OK';
    const HTTP_STATUS_202 = 'Accepted';
    const HTTP_STATUS_203 = 'Non-Authoritative Information';
    const HTTP_STATUS_204 = 'No Content';
    const HTTP_STATUS_205 = 'Reset Content';
    const HTTP_STATUS_206 = 'Partial Content';
    const HTTP_STATUS_207 = 'Multi-Status';
    const HTTP_STATUS_226 = 'IM Used';
    
    // 3xx Redirection
    const HTTP_STATUS_300 = 'Multiple Choices';
    const HTTP_STATUS_301 = 'Moved Permanently';
    const HTTP_STATUS_302 = 'Found';
    const HTTP_STATUS_303 = 'See Other';
    const HTTP_STATUS_304 = 'Not Modified';
    const HTTP_STATUS_305 = 'Use Proxy';
    const HTTP_STATUS_306 = 'Switch Proxy';
    const HTTP_STATUS_307 = 'Temporary Redirect';

    // 4xx Client Error
    const HTTP_STATUS_400 = 'Bad Request';
    const HTTP_STATUS_401 = 'Unauthorized';
    const HTTP_STATUS_402 = 'Payment Required';
    const HTTP_STATUS_403 = 'Forbidden';
    const HTTP_STATUS_404 = 'Not Found';
    const HTTP_STATUS_405 = 'Method Not Allowed';
    const HTTP_STATUS_406 = 'Not Acceptable';
    const HTTP_STATUS_407 = 'Proxy Authentication Required';
    const HTTP_STATUS_408 = 'Request Timeout';
    const HTTP_STATUS_409 = 'Conflict';
    const HTTP_STATUS_410 = 'Gone';
    const HTTP_STATUS_411 = 'Length Required';
    const HTTP_STATUS_412 = 'Precondition Failed';
    const HTTP_STATUS_413 = 'Request Entity Too Large';
    const HTTP_STATUS_414 = 'Request-URI Too Long';
    const HTTP_STATUS_415 = 'Unsupported Media Type';
    const HTTP_STATUS_416 = 'Requested Range Not Satisfiable';
    const HTTP_STATUS_417 = 'Expectation Failed';
    const HTTP_STATUS_418 = 'I\'m a teapot'; //This code was defined in 1998 as one of the traditional IETF April Fools' jokes, in RFC 2324, Hyper Text Coffee Pot Control Protocol, and is not expected to be implemented by actual HTTP servers.
    const HTTP_STATUS_422 = 'Unprocessable Entity';
    const HTTP_STATUS_423 = 'Locked';
    const HTTP_STATUS_424 = 'Failed Dependency';
    const HTTP_STATUS_425 = 'Unordered Collection';
    const HTTP_STATUS_426 = 'Upgrade Required';
    const HTTP_STATUS_444 = 'No Response';
    const HTTP_STATUS_449 = 'Retry With';
    const HTTP_STATUS_450 = 'Blocked by Windows Parental Controls';
    const HTTP_STATUS_499 = 'Client Closed Request';

    // 5xx Server Error
    const HTTP_STATUS_500 = 'Internal Server Error';
    const HTTP_STATUS_501 = 'Not Implemented';
    const HTTP_STATUS_502 = 'Bad Gateway';
    const HTTP_STATUS_503 = 'Service Unavailable';
    const HTTP_STATUS_504 = 'Gateway Timeout';
    const HTTP_STATUS_505 = 'HTTP Version Not Supported';
    const HTTP_STATUS_506 = 'Variant Also Negotiates';
    const HTTP_STATUS_507 = 'Insufficient Storage';
    const HTTP_STATUS_509 = 'Bandwidth Limit Exceeded';
    const HTTP_STATUS_510 = 'Not Extended';
                                                                                    


    public static function status($code) {
            if (!defined('self::HTTP_STATUS_'.$code)) {
                    throw new \Exception('Invalid Status Code');
            }

            $text=constant('self::HTTP_STATUS_'.$code);


            header($_SERVER['SERVER_PROTOCOL'].' '.$code.' '.$text);
            return $text;
    }

    public static function location($location, $code = null) {
        header(sprintf('Location: %s', $location));
        if ($code !== null) {
            self::status($code);
        }
    }

    public static function contentType($type) {
        header(sprintf('Content-type: %s', $type));
    }

}
