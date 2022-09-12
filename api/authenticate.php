<?php
declare(strict_types=1);
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
require 'vendor/autoload.php';

class Authenticate {
    private $secret_key;
    private $date;
    private $expire_at_access;
    private $expire_at_refresh;
    private $token_jwt_access;
    private $token_jwt_refresh;

    public function __construct($domain_name,$email)
    {
        self::setSecretKey();
        self::setDate();
        self::setExprireAtAccess();
        self::generateAccessJWT($domain_name,$email);
        // self::validateJWT();
        self::setExprireAtRefresh();
        self::generateRefreshJWT($domain_name,$email);
    }
    /**
     * @return mixed
     */
    public function getSecretKey()
    {
        return $this->secret_key;
    }
    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }
    /**
     * @return mixed
     */
    public function getExprireAtAccess()
    {
        return $this->expire_at_access;
    }
        /**
     * @return mixed
     */
    public function getExprireAtRefresh()
    {
        return $this->expire_at_refresh;
    }
    /**
     * @return mixed
     */
    public function getTokenAccessJWT()
    {
        return $this->token_jwt_access;
    }
    /**
     * @return mixed
     */
    public function getTokenRefreshJWT()
    {
        return $this->token_jwt_refresh;
    }
    /**
     * @param mixed $setSecretKey
     */
    public function setSecretKey()
    {
        $this->secret_key = '68V0zWFrS72GbpPreidkQFLfj4v9m3Ti+DXc8OB0gcM=';
    }
    /**
     * @param mixed $setDate
     */
    public function setDate()
    {
        $this->date =  new DateTimeImmutable();
    }
    /**
     * @param mixed $setDate
     */
    public function setExprireAtAccess()
    {
        $this->expire_at_access = $this->date->modify('+6 minutes')->getTimestamp();
    }
        /**
     * @param mixed $setDate
     */
    public function setExprireAtRefresh()
    {
        $this->expire_at_refresh = $this->date->modify('+31 days')->getTimestamp();
    }
    /**
    * @return mixed
    */
    public function generateAccessJWT($domain_name,$email)
    {
        $request_data = [
            'iat'  => $this->getDate()->getTimestamp(),           // Issued at: time when the token was generated
            'iss'  => $domain_name,                    // Issuer
            'nbf'  => $this->getDate()->getTimestamp(),         // Not before
            'exp'  => $this->getExprireAtAccess(),             // Expire
            'email' => $email,                     // email
        ];
        
        return $this->token_jwt_access = JWT::encode(
            $request_data,
            $this->getSecretKey(),
            'HS512'
        );
    }
    /**
     * The method support validateJWT data
     */
    public function validateJWT() {
        $headers = getallheaders();
        if (! preg_match('/Bearer\s(\S+)/', $headers["Authorization"], $matches)) {
            header('HTTP/1.0 400 Bad Request');
            echo 'Token not found in request '. $matches;
            exit;
        }
        $jwt = $matches[1];
        $secret_Key = $this->getSecretKey();
        if (! $jwt) {
            // No token was able to be extracted from the authorization header
            header('HTTP/1.0 400 Bad Request');
            exit;
        } else {
            try {
                $token = JWT::decode($jwt, new Key($secret_Key,'HS512'));
                echo json_encode(array(
                    "message" => "Access granted:"
                ));
                $now = new DateTimeImmutable();
                $serverName = $_SERVER['HTTP_HOST'];
        
                if ($token->iss !== $serverName ||
                    $token->nbf > $now->getTimestamp() ||
                    $token->exp < $now->getTimestamp())
                {
                    header('HTTP/1.1 401 Unauthorized');
                    exit;
                } else {
                    echo 'next';
                    return true;
                }
            } catch (\Exception $e) {
                http_response_code(401);

                echo json_encode(array(
                    "message" => "Access denied.",
                    "error mess" => $e->getMessage()
                ));
            }
        }
    }
    /**
    * @return mixed
    */
    public function generateRefreshJWT($domain_name,$email)
    {
        $request_data = [
            'iat'  => $this->getDate()->getTimestamp(),           // Issued at: time when the token was generated
            'iss'  => $domain_name,                    // Issuer
            'nbf'  => $this->getDate()->getTimestamp(),         // Not before
            'exp'  => $this->getExprireAtRefresh(),            // Expire
            'email' => $email,                     // email
        ];
        
        return $this->token_jwt_refresh = JWT::encode(
            $request_data,
            $this->getSecretKey(),
            'HS512'
        );
    }
}
