<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateProfileRequest;
use App\Services\Admin\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * The service implementation.
     *
     * @var ProfileService
     */
    protected $profileService;

    /**
     * Create a new service instance.
     *
     * @param \App\Services\Admin\ProfileService $profileService
     */
    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * Show info admin
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $infoAdmin = $this->profileService->getAdmin();

        return view('admin.profile.index', compact('infoAdmin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Admin\UpdateProfileRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request)
    {
        if ($this->profileService->update($request)) {
            return redirect()->back()->with('success', __('messages.user.update_success'));
        }

        return redirect()->back()->with('error', __('messages.user.update_error'));
    }
}
