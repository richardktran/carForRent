<?php

namespace Khoatran\CarForRent\Service\Business;

use Khoatran\CarForRent\Exception\LoginException;
use Khoatran\CarForRent\Model\User;
use Khoatran\CarForRent\Repository\UserRepository;
use Khoatran\CarForRent\Request\LoginRequest;
use Khoatran\CarForRent\Service\Contracts\LoginServiceInterface;

class LoginService implements LoginServiceInterface
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param LoginRequest $loginRequest
     * @return User|null
     */
    public function login(LoginRequest $loginRequest): ?User
    {
        $user = $this->userRepository->findByUsername($loginRequest->getUsername());
        if ($user == null) {
            return null;
        }
        $checkPassword = password_verify($loginRequest->getPassword(), $user->getPassword());
        if (!$checkPassword) {
            return null;
        }
        return $user;
    }
}
