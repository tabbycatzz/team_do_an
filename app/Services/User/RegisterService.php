<?php

namespace App\Services\User;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Services\User\BaseService;

class RegisterService extends BaseService
{
    /**
     * Create a new model instance.
     *
     * @param \App\Models\User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Store a newly created resource
     *
     * @param \App\Http\Requests\User\RegisterRequest $request
     * @return boolean
     */
    public function save($request)
    {
        DB::beginTransaction();
        
        try {
            $user = $this->model->create([
                'email' => $request->email,
                'password' => $request->password,
                'role' => UserRole::USER
            ]);

            $user->userProfile()->create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'avatar' => $this->imageChangeName($request),
                'address' => $request->address,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'province' => $request->province
            ]);

            DB::commit();

            return true;
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();

            return false;
        }
    }
}
