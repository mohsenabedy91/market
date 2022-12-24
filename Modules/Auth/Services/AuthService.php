<?php

namespace Modules\Auth\Services;

<<<<<<<<< Temporary merge branch 1
class AuthService
{
    public function register(array $parameters = [])
    {
        //
=========
use Exception;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Repositories\V1\AuthRepositoryInterface;
use Modules\User\Models\User;

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
            $parameters["password"] = bcrypt($parameters["password"]);

            $user = $this->authRepository->storeUser($parameters);

            $token = $this->createToken($user);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return array_merge([$user->toArray(), "token" => $token]);
    }

    private function createToken(User $user): string
    {
        return $user->createToken("Personal Access Token")->accessToken;
>>>>>>>>> Temporary merge branch 2
    }
}
