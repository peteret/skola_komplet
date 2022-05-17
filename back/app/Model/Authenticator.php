<?php

namespace App\Model;

use App\Model\Repository\UserRepository;
use Nette;

class Authenticator implements Nette\Security\IAuthenticator
{
    public function __construct(
        private Nette\Security\Passwords $passwords,
        private UserRepository $userRepository
    ) {
    }

    public function authenticate(array $credentials): Nette\Security\IIdentity
    {
        [$nick, $password] = $credentials;

        $user = $this->userRepository->getUserByEmail($nick);

        if (!$user) {
            throw new Nette\Security\AuthenticationException('User not found.');
        }

        if (!$this->passwords->verify($password, $user->password)) {
            throw new Nette\Security\AuthenticationException('Invalid password.');
        }

        return new Nette\Security\Identity(
            $user->user_id,
            "none",
            ['name' => $user->nick]
        );
    }
}
