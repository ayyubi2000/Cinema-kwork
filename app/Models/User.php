<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Constants\GeneralStatus;
use App\Models\UserRoles;

/**
 * App\Models\User
 *
 * @OA\Schema (
 *   description="User model",
 *   title="User",
 *   required={},
 *   @OA\Property(type="integer",description="id of User",title="id",property="id",example="1",readOnly="true"),
 *   @OA\Property(type="string",description="first_name of User",title="first_name",property="first_name",example="Lorem"),
 *   @OA\Property(type="string",description="last_name of User",title="last_name",property="last_name",example="Lorem"),
 *   @OA\Property(type="string",description="middle_name of User",title="middle_name",property="middle_name",example="Lorem"),
 *   @OA\Property(type="string",description="username of User",title="username",property="username",example="example"),
 *   @OA\Property(title="roles",property="roles",type="array",
 *     @OA\Items(
 *          @OA\Property(type="integer",description="id of Role",title="id",property="id",example="1",readOnly="true"),
 *          @OA\Property(type="string",description="Name of Role",title="role",property="role",example="Merchant",readOnly="true"),
 *          @OA\Property(type="integer",description="Status of Role",title="status",property="status",example="20",readOnly="true"),
 * ),
 *   ),
 *   @OA\Property(type="dateTime",title="created_at",property="created_at",example="2022-07-04T02:41:42.336Z",readOnly="true"),
 *   @OA\Property(type="dateTime",title="updated_at",property="updated_at",example="2022-07-04T02:41:42.336Z",readOnly="true"),
 * )
 * @OA\Schema (
 *   schema="Users",
 *   title="Users",
 *   @OA\Property(title="data",property="data",type="array",
 *     @OA\Items(type="object",ref="#/components/schemas/User"),
 *   ),
 *   @OA\Property(title="links",property="links",type="object",
 *   @OA\Property(type="string", title="first",property="first",example="http://localhost:8080/api/users?page=1"),
 *   @OA\Property(type="string", title="last",property="last",example="http://localhost:8080/api/users?page=3"),
 *   @OA\Property(type="string", title="prev",property="prev",example="null"),
 *   @OA\Property(type="string", title="next",property="next",example="http://localhost:8080/api/users?page=2"),
 *   ),
 *   @OA\Property(title="meta",property="meta",type="object",
 *   @OA\Property(type="integer", title="current_page",property="current_page",example="1"),
 *   @OA\Property(type="integer", title="from",property="from",example="1"),
 *   @OA\Property(type="integer", title="last_page",property="last_page",example="3"),
 *   @OA\Property(type="string", title="path",property="path",example="http://localhost:8080/api/users"),
 *   @OA\Property(type="integer", title="per_page",property="per_page",example="1"),
 *   @OA\Property(type="integer", title="total",property="total",example="3"),
 *   @OA\Property(title="links",property="links",type="array",
 *     @OA\Items(type="object",
 *          @OA\Property(type="string",title="url",property="url",example="http://localhost:8080/api/users?page=2"),
 *          @OA\Property(type="string",title="label",property="label",example="1"),
 *          @OA\Property(type="bool",title="active",property="active",example="true"),
 *      ),
 *   ),
 *   )
 * )
 * @OA\Parameter (
 *      parameter="User--id",
 *      in="path",
 *      name="user_id",
 *      required=true,
 *      description="Id of User",
 *      @OA\Schema(
 *          type="integer",
 *          example="1",
 *      )),
 */
class User extends BaseModel
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'name',
        'surename',
        'password',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public array $translatable = [];

    protected $with = ['roles'];

    public function roles(): HasMany
    {
        return $this->hasMany(UserRoles::class);
    }

    public function getActiveRole()
    {
        return $this->roles()
            ->where('status', GeneralStatus::STATUS_ACTIVE)
            ->first();
    }
}