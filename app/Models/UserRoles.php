<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


/**
 * App\Models\Role
 *
 * @OA\Schema (
 *   description="UserRoles model",
 *   title="User Role",
 *   required={},
 *   @OA\Property(type="integer",description="id of Role",title="id",property="id",example="1",readOnly="true"),
 *   @OA\Property(type="string",description="name of Role",title="role_code",property="name",example="admin"),
 *   @OA\Property(type="integer",description="user_id of Role",title="user_id",property="user_id",example="1"),
 *   @OA\Property(type="integer",description="role_id of Role",title="role_id",property="role_id",example="1"),
 *   @OA\Property(type="integer",description="id of user",title="status",property="status",example="10"),
 *   @OA\Property(type="dateTime",title="created_at",property="created_at",example="2022-07-04T02:41:42.336Z",readOnly="true"),
 *   @OA\Property(type="dateTime",title="updated_at",property="updated_at",example="2022-07-04T02:41:42.336Z",readOnly="true"),
 * )
 * @OA\Parameter (
 *      parameter="Role--id",
 *      in="path",
 *      name="Role_id",
 *      required=true,
 *      description="Id of Role",
 *      @OA\Schema(
 *          type="integer",
 *          example="1",
 *      )),
 */
class UserRoles extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user() : object
    {
        return $this->belongsTo(User::class);
    }

}
