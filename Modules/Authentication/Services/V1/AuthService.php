<?php

namespace Modules\Authentication\Services\V1;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Modules\Authentication\Exceptions\V1\UserAlreadyExistException;
use Modules\Authentication\Repositories\V1\AuthRepositoryInterface;
use Modules\User\Models\User;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Response;

class AuthService
{
    /**
     * @var AuthRepositoryInterface
     */
    private AuthRepositoryInterface $authRepository;

    /**
     * @param AuthRepositoryInterface $authRepository
     */
    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * @param array $parameters
     * @return array
     * @throws Exception
     */
    public function register(array $parameters = []): array
    {
        DB::beginTransaction();
        try {
            $user = User::query()
                ->where("email", $parameters["email"])
                ->first();
            if ($user) {
                throw new UserAlreadyExistException(
                    Lang::get("authentication::messages.user_already_exists")
                );
            }

            /** @var User $user */
            $user = $this->authRepository->storeUser($parameters);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return array_merge($user->toArray(), ["token" => $this->createToken($user)]);
    }

    /**
     * @param array $parameters
     * @return array
     * @throws Exception
     */
    public function login(array $parameters = []): array
    {
        $user = User::query()
            ->whereEmail($parameters["email"])
            ->first();

        if (!Auth::attempt($parameters)) {
            throw new BadRequestException(
                Lang::get("authentication::messages.incorrect_request"),
                Response::HTTP_BAD_REQUEST
            );
        }

        return array_merge($user->toArray(), ["token" => $this->createToken($user)]);
    }

    /**
     * @param User $user
     * @return string
     */
    private function createToken(User $user): string
    {
        return $user->createToken("Personal Access Token")->accessToken;
    }
}
