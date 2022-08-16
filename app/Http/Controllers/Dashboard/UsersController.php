<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\UserInterface;
use App\Http\Requests\user\CreateUserRequest;
use App\Http\Requests\user\DeleteUserRequest;
use App\Http\Requests\user\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
        protected  $userInterface;

        public function __construct(UserInterface $userInterface)
        {
            return $this->userInterface = $userInterface;
        }

       public function index(Request $request)
       {
           return $this->userInterface->index($request);
       }
       public function create()
       {
           return $this->userInterface->create();

       }

       public function store(CreateUserRequest $request)
       {
           return $this->userInterface->store($request);

       }
       public function show($id)
       {
           //
       }
       public function edit($id)
       {
           return $this->userInterface->edit($id);

       }

       public function update(UpdateUserRequest $request)
       {
           return $this->userInterface->update($request);

       }

       public function delete(DeleteUserRequest $request)
       {
           return $this->userInterface->delete($request);

       }
}
