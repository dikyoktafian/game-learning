<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;


// Additional
use Illuminate\Support\Facades\Storage; // added by dandisy
use File;
use Auth;


// Models
use App\Models\User;
use App\Models\Subject;
use App\Models\Role;

class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $users = $this->userRepository->all();

        return view('admin.users.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        $auth = Auth::user()->id;
        $auth = User::where('id', $auth)->with('role')->first()->toArray();
        
        $subject = Subject::pluck('name', 'id');
        $role = Role::pluck('name', 'id');

        return view('admin.users.create')
            ->with('subject', $subject)
            ->with('role', $role)
            ->with('auth', $auth);
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();

        // CREATE FOLDER
        $pathImage = 'public/user';
        $dir = Storage::directories();
        if (!in_array($pathImage , $dir)) {
            Storage::makeDirectory($pathImage);
        }

        // UPLOAD IMAGE
        if (@$input['photo']) {
            $cover = $input['photo'];
            if (!empty($cover)) {                    
                $fileCover = uniqid() .'.'. $cover->getClientOriginalExtension();
                Storage::put($pathImage . '/' . $fileCover, File::get($cover));
                $input['photo'] = $fileCover;
            }
        }

        $user = $this->userRepository->create($input);

        Flash::success('User saved successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('admin.users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $auth = Auth::user()->id;
        $auth = User::where('id', $auth)->with('role')->first()->toArray();

        $user = User::with(['role', 'subject'])->find($id);
        $subject = Subject::pluck('name', 'id');
        $role = Role::pluck('name', 'id');

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('admin.users.edit')
            ->with('user', $user)
            ->with('subject', $subject)
            ->with('role', $role)
            ->with('auth', $auth);
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->find($id);
        $input = $request->all();

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        // CREATE FOLDER
        $pathImage = 'public/user';
        $dir = Storage::directories();
        if (!in_array($pathImage , $dir)) {
            Storage::makeDirectory($pathImage);
        }

        // UPLOAD IMAGE
        if (@$input['photo']) {
            $cover = $input['photo'];
            if (!empty($cover)) {                    
                $fileCover = uniqid() .'.'. $cover->getClientOriginalExtension();
                Storage::put($pathImage . '/' . $fileCover, File::get($cover));
                $input['photo'] = $fileCover;
                if($input['photo'] !== '' && $input['photo'] !== $fileCover){
                    @Storage::delete($pathImage . $input['photo']);
                }
            }
        }

        $user = $this->userRepository->update($input, $id);

        Flash::success('User updated successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('users.index'));
    }
}
