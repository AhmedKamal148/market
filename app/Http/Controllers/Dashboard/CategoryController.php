<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\CategoryInterface;
use App\Http\Requests\category\CreateCategoryRequest;
use App\Http\Requests\category\DeleteCategoryRequest;
use App\Http\Requests\category\UpdateCategoryRequest;
use App\Http\Requests\user\UpdateUserRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    protected $categoryInterface;

    public function __construct(CategoryInterface $categoryInterface)
    {
        return $this->categoryInterface = $categoryInterface;
    }

    public function index(Request $request)
    {
        return $this->categoryInterface->index($request);
    }

    public function create()
    {
        return $this->categoryInterface->create();
    }

    public function store(CreateCategoryRequest $request)
    {
        return $this->categoryInterface->store($request);

    }

    public function show($id)
    {
        return $this->categoryInterface->show($id);

    }

    public function edit($id)
    {
        return $this->categoryInterface->edit($id);

    }
    public function update(UpdateCategoryRequest $request)
    {
        return $this->categoryInterface->update($request);

    }
    public function delete(DeleteCategoryRequest $request )
    {
        return $this->categoryInterface->delete($request);

    }
}
