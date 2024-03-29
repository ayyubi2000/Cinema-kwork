<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserRoles;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Throwable;
use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;
use App\Constants\GeneralStatus;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function create($data): array |Collection|Builder|BaseModel|null
    {
        /**
         * @var $model User
         */
        $model = $this->getBaseModel();
        $model->fill($data);
        $model->save();
        if (isset($data['roles'])) {
            foreach ($data['roles'] as $role) {
                UserRoles::create([
                    'user_id' => $model->id,
                    'role_code' => $role['role_code'],
                    'status' => $role['status'] ? GeneralStatus::STATUS_ACTIVE : GeneralStatus::STATUS_NOT_ACTIVE,
                ]);
            }
        }

        return $model;
    }

    public function update($data, $id): BaseModel|array |Collection|Builder|null
    {
        /**
         * @var $model User
         */
        $model = $this->findById($id);
        $model->fill($data);
        $model->save();
        if (isset($data['roles'])) {
            $model->roles()->delete();
            foreach ($data['roles'] as $role) {
                UserRoles::create([
                    'user_id' => $model->id,
                    'role_code' => $role['role_code'],
                    'status' => $role['status'] ? GeneralStatus::STATUS_ACTIVE : GeneralStatus::STATUS_NOT_ACTIVE,
                ]);
            }
        }
        return $model;
    }


    /**
     * @throws Throwable
     */
    public function findByEmail($email)
    {
        $model = $this->getBaseModel();
        return $model::query()
            ->where('email', '=', $email)
            ->first();
    }
    /**
     * @throws Throwable
     */
    public function findByEmailOrName($emailOrName)
    {
        $model = $this->getBaseModel();
        return $model::query()
            ->where('email', '=', $emailOrName)
            ->orWhere('name', '=', $emailOrName)
            ->first();
    }

    /**
     * @param string $email
     * @return string
     * @throws Throwable
     */
    public function createToken(string $email): string
    {

        $model = $this->findByEmailOrName($email);
        return $model->createToken('auth_token')->plainTextToken;
    }

    /**
     * @param string|User $username
     * @return int
     * @throws Throwable
     */
    public function removeToken(string|User $email): int
    {
        if (is_string($email)) {
            $model = $this->findByEmail($email);
        } else {
            $model = $email;
        }
        return $model->tokens()->delete();
    }
}