<?php

namespace App\OAuth;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Hashing\Hasher;
use Laravel\Passport\Bridge\User;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\UserEntityInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;
use RuntimeException;

class PassportUserRepository implements UserRepositoryInterface
{
    /**
     * The hasher implementation.
     *
     * @var \Illuminate\Contracts\Hashing\Hasher
     */
    protected $hasher;

    /**
     * Create a new repository instance.
     *
     * @param  \Illuminate\Contracts\Hashing\Hasher  $hasher
     * @return void
     */
    public function __construct(Hasher $hasher)
    {
        $this->hasher = $hasher;
    }

    /**
     * {@inheritdoc}
     */
    public function getUserEntityByUserCredentials($username, $password, $grantType, ClientEntityInterface $clientEntity)
    {
        $guard = config('auth.passport.guard'); // obtain current guard name from config
        $provider = config('auth.guards.'.$guard.'.provider');
        $userProvider = app('auth')->createUserProvider($provider);
        
        if ($userProvider instanceof EloquentUserProvider &&
            method_exists($model = $userProvider->getModel(), 'findForPassport')) {
            $user = (new $model)->findForPassport($username);
        } else {
            $user = $userProvider->retrieveById($username);
        }

        if (!$user) {
            return;
        }

        if (method_exists($user, 'validateForPassportPasswordGrant')) {
            if (!$user->validateForPassportPasswordGrant($password)) {
                return;
            }
        } else {
            if (!$userProvider->validateCredentials($user, ['password' => $password])) {
                return;
            }
        }

        if ($user instanceof UserEntityInterface) {
            return $user;
        }

        return new User($user->getAuthIdentifier());
    }
}