<?php
namespace  App\Http\Repositories;

use App\Http\Interfaces\UserInterface;
use App\Http\Traits\ImagesTriat;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;


class UserRepo implements UserInterface
{
    protected $models = ['users','categories' ,'products'];
    use ImagesTriat;

    public function __construct()
    {
      /*  $this->middleware(['permissions:read_users'])->only('index');
        $this->middleware(['permissions:create_users'])->only('admin.create');
        $this->middleware(['permissions:update_users'])->only('admin.update');
        $this->middleware(['permissions:delete_users'])->only('admin.delete');*/
    }

    public function index($request)
    {
        if($request->has('search'))
        {
            $users = User::where(function ($q) use ($request)
            {
               return $q->when($request->search,function ($query) use ($request)
               {
                   return $query->where('first_name' , 'like' , '%' . $request->search . '%')
                       ->orWhere('last_name' ,'like' , '%' .$request->search . '%');
               }) ;
            })->get();
        }
        else{
            $users = User::get();
        }
        return view('admin.pages.users.index' , compact('users'));

    }
    public function create()
    {
       $models = $this->models;
        return view('admin.pages.users.create',compact('models'));
    }
    public function store($request)
    {
        $image = $request->image;
        $imageName = time() . '_user.jpg';
        $this->UploadImage($image, $imageName,'user');
        $user = User::create(
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email'        => $request->email,
                'password' => Hash::make($request->password),
                'image'     =>   $imageName,
            ]
        );
        $user->attachRole('admin');
        if($request->has('permissions'))
        {
            $user->syncPermissions($request->permissions);
        }
        Alert::success('Create User ', 'Create User Successfully !');
        return redirect()->back();
    }


    public function edit($id)
    {
        $user = User::find($id);
        $models = $this->models;
        return view('admin.pages.users.edit' , compact('user','models'));
    }
    public function update($request)
    {
        $user = User::find($request->user_id);
        if($request->has('image'))
        {
            $image = $request->image;
            $imageName = time() . 'user.' . $request->image->extension();
            $this->UploadImage($image, $imageName,'user' , $user->imageUrl);
        }
        $user->update(
                [
                    'first_name' => ($request->has('first_name')) ? $request->first_name  : $user->first_name,
                    'last_name' => ($request->has('last_name')) ? $request->last_name  : $user->last_name,
                    'password' => ($request->has('password')) ? Hash::make($request->password)  : $user->password,
                    'image' => (isset($imageName)) ? $imageName : $user->image,
                ]
            );
        $user->syncPermissions($request->permissions);
        Alert::success('Update User' , "Update Successfully" );
        return  redirect(route('admin.users.index'));
    }
    public function delete($request)
    {
            $user = User::find($request->user_id);
            $imageName = explode('\\',$user->imageUrl);
            $imageName= $imageName[count($imageName)-1];

          if($imageName == '')
            {
                $user->delete();
            }
            else{
                unlink(public_path($user->imageUrl));
                $user->delete();
            }
        return redirect(route('admin.users.index'));
    }
}
