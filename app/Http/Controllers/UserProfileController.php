<?php

namespace Cuadrantes\Http\Controllers;


use Cuadrantes\Repositories\UserProfileRepository;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    protected $iconClass  = 'fa fa-user';
    protected $userProfileRepository;

    public function __construct(UserProfileRepository $userProfileRepository)
    {
        $this->userProfileRepository = $userProfileRepository;
    }

    protected function genericValidation(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|string',
            'surname'   => 'required|string',
            'telephone' => 'numeric',
            'email'     => 'required|email',
            'image'     => 'image|mimes:jpeg,jpg',
        ]);
    }

    public function resume(Guard $auth)
    {
        $user = $auth->user();
        return view('pages.user_profile', ['title' => $user->completeName, 'iconClass' => $this->iconClass, 'user' => $user]);
    }

    public function update(Request $request, Guard $auth)
    {
        $this->genericValidation($request);
        $this->userProfileRepository->update($auth, $request->get('name'), $request->get('surname'), $request->get('telephone'), $request->get('email'));
        if ($request->file('image') !== null) {
            $file = $request->file('image');
            Storage::disk('public')->put('avatar/'.$auth->user()->id.'.jpg', File::get($file));
        }
        session()->flash('success', trans('pages/user_profile.update_success'));
        return Redirect::route('user_profile.resume');
    }

    public function getProfileImage(Guard $auth)
    {
        $file = Storage::disk('public')->get('avatar/'.$auth->user()->id.'.jpg');
        return new Response($file, 200);
    }

	public function changePassword(Request $request)
	{
		if (!Hash::check($request->get('old_pswd'), Auth::user()->password)) {
			session()->flash( 'info', trans( 'pages/user_profile.update_pswd_error' ) );
		} else {
			$user = Auth::user();
			$user->password = Hash::make($request->get('new_pswd'));
			$user->save();
			session()->flash( 'success', trans( 'pages/user_profile.update_pswd_success' ) );
		}
		return Redirect::route('user_profile.resume');
	}
}
