<?php

namespace Cuadrantes\Http\Controllers;


use Cuadrantes\Commons\Roles;
use Cuadrantes\Commons\UserContract;
use Cuadrantes\Entities\User;
use Cuadrantes\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Yajra\Datatables\Facades\Datatables;

class UserController extends Controller
{
	protected $defaultPagination = 25;
	protected $icon              = 'fa fa-users';
	protected $titleResume       = 'pages/user.title';
	protected $titleNew          = 'pages/user.new_button';

	protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository   = $userRepository;
    }

	protected function userValidation(Request $request)
	{
		$this->validate($request, [
			UserContract::NAME      => 'required|string',
			UserContract::SURNAME   => 'required|string',
			UserContract::TELEPHONE => 'numeric',
			UserContract::EMAIL     => 'required|email',
			UserContract::ROLE      => 'string',
		]);
	}

	protected function getTableActionButtons(User $user)
	{
		return '<div class="btn-group">
                    <a href="'.route('user.details', $user->id).'" data-toggle="tooltip" data-original-title="'.trans('general.edit').'" data-placement="bottom" class="btn btn-success btn-xs">
                        <i class="fa fa-edit"></i>
                    </a>
                </div>
                
                <div class="btn-group">
                    <a href="'.route('user.delete', $user->id).'" data-toggle="tooltip" data-original-title="'.trans('general.remove').'" data-placement="bottom" class="btn btn-danger btn-xs btn-delete">
                        <i class="fa fa-trash-o"></i>
                    </a>
                </div>';
	}

	public function ajaxResume()
	{
		return Datatables::of($this->userRepository->getAll())
				->addColumn('role', function (User $user) {
					return trans("general.{$user->role}");
				})
                ->addColumn('actions', function (User $user) {
	                 return $this->getTableActionButtons($user);
                })
                ->make(true);
	}

	private function sendEmailToNewUser(User $user, $password)
	{
		Mail::send('emails.new_user', ['user' => $user, 'password' => $password], function ($m) use ($user) {
			$m->from('no-reply.intercitybus@auret.es', 'Intercity Bus Cuadrantes Software');

			$m->to($user->email, $user->name)->subject('[Cuadrantes] Has sido registrado correctamente');
		});

		return response();
	}

    public function resume()
    {
	    $users = $this->userRepository->getAllPaginated($this->defaultPagination);
	    return view('pages.users.resume', ['title' => trans($this->titleResume), 'iconClass' => $this->icon, 'users' => $users]);
    }

	public function create()
	{
		$roles = [Roles::ADMIN, Roles::USER];
		return view('pages.users.details', ['title' => trans($this->titleNew), 'iconClass' => $this->icon, 'roles' => $roles]);
	}

	public function store(Request $request)
	{
		$this->userValidation($request);
		try {
			$password = str_random(10);
			$user = $this->userRepository->store($request->only([UserContract::NAME, UserContract::SURNAME, UserContract::ROLE,
																 UserContract::TELEPHONE, UserContract::EMAIL]), $password);

			$this->sendEmailToNewUser($user, $password);
			session()->flash('success', trans('pages/user.store_success',['Name' => $user->completeName]));
		} catch (\PDOException $exception) {
			session()->flash( 'info', trans( 'pages/user.store_exists', [ 'Name' => "{$request->get('name')} {$request->get('surname')}" ] ) );
		} catch (\Exception $exception) {
			dd($exception);
		} finally {
			return $this->resume();
		}
	}

	public function details($id)
	{
		$user = $this->userRepository->findOrFail($id);
		$roles = [Roles::ADMIN, Roles::USER];

		return view('pages.users.details', ['title' => $user->completeName, 'iconClass' => $this->icon, 'roles' => $roles, 'user' => $user]);
	}

	public function update(Request $request, $id)
	{
		$this->userValidation($request);
		try {
			$user = $this->userRepository->update($id, $request->only([UserContract::NAME, UserContract::SURNAME, UserContract::ROLE,
																	   UserContract::TELEPHONE, UserContract::EMAIL]));

			session()->flash('success', trans('pages/user.update_success',['Name' => $user->completeName]));
		} catch (\PDOException $exception) {
			session()->flash( 'info', trans( 'pages/user.update_exists', [ 'Email' => $request->get(UserContract::EMAIL)] ) );
		} catch (\Exception $exception) {
			dd($exception);
		} finally {
			return Redirect::route('user.details', $id);
		}
	}

	public function delete($id)
	{
		$user = $this->userRepository->deleteById($id);
		session()->flash('success', trans('pages/user.delete_success',['Name' => $user->completeName]));
		return $this->resume();
	}
}
