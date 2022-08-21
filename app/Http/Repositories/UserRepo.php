<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;


class UserRepo implements UserInterface
{
    protected $models = ['users', 'categories', 'products'];


    public function __construct()
    {
        /*  $this->middleware(['permissions:read_users'])->only('index');
          $this->middleware(['permissions:create_users'])->only('admin.create');
          $this->middleware(['permissions:update_users'])->only('admin.update');
          $this->middleware(['permissions:delete_users'])->only('admin.delete');*/
    }

    public function index($request)
    {
        if ($request->has('search')) {
            $users = User::where(function ($q) use ($request) {
                return $q->when($request->search, function ($query) use ($request) {
                    return $query->where('first_name', 'like', '%' . $request->search . '%')
                        ->orWhere('last_name', 'like', '%' . $request->search . '%');
                });
            })->with('roles')->paginate(3);
        } else {
            $users = User::with('roles')->paginate(3);
        }
        return view('admin.pages.users.index', compact('users'));

    }

    public function store($request)
    {
        if ($request->has('image')) {
            $img = Image::make($request->image);
            $imageName = $request->image->hashName();

            $img->save(
                public_path('images/user/') . $imageName, 100, $request->image->extension());
        }
        $user = User::create(
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'image' => (isset($imageName)) ? $imageName : 'default.jpg',
            ]
        );

        $user->attachRole('admin');
        if ($request->has('permissions')) {
            $user->syncPermissions($request->permissions);
        }

        Alert::success('Create User ', 'Create User Successfully !');
        return redirect()->back();
    }

    public function create()
    {
        $models = $this->models;
        return view('admin.pages.users.create', compact('models'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $models = $this->models;
        return view('admin.pages.users.edit', compact('user', 'models'));
    }

    public function update($request)
    {
        $user = User::find($request->user_id);
        // Check If Request Has Image && Image Not Equal Default Image ;
        if ($request->has('image')) {
            if ($user->image != 'default.jpg') {
                Storage::disk('public_uploads')->delete('/user/' . $user->image);
            }
            $img = Image::make($request->image);
            $imageName = $request->image->hashName();
            $img->save(public_path('images/user/' . $imageName));
        }

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'password' => Hash::make($request->password),
            'image' => (isset($imageName)) ? $imageName : $user->imageUrl,
        ]);

        $user->syncPermissions($request->permissions);
        Alert::success('Update User', "Update Successfully");
        return redirect(route('admin.users.index'));
    }

    public function delete($request)
    {
        $user = User::find($request->user_id);
        if ($user->image != 'default.jpg') {

            Storage::disk('public_uploads')->delete('/user/' . $user->image);
        }
        $user->delete();

        return redirect(route('admin.users.index'));
    }
}
