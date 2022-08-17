<?php
namespace  App\Http\Repositories;

use App\Http\Interfaces\CategoryInterface;
use App\Models\Category;
use RealRashid\SweetAlert\Facades\Alert;


class CategoryRepo implements CategoryInterface
{

    public function index($request)
    {

        if($request->has('search_category'))
        {
            $categories = Category::where(function ($query) use ($request)
            {
                return $query->where('name' ,'like' ,'%' . $request->search_category . '%');
;
            })->paginate(5);
        }
        else{
            $categories = Category::paginate(5);
        }
        return  view('admin.pages.category.index',compact('categories'));
    }
    public function create()
    {
        return  view('admin.pages.category.create');
    }
    public function store($request)
    {
        $category = Category::create([
            'name' => $request->name,
        ]);
        Alert::success('Create Category' , "Create {{$category->name}} Successfully!");
        return redirect()->back();
    }
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.pages.category.edit' ,compact('category'));
    }
    public function update($request)
    {


   $category = Category::find($request->category_id);

        $category->update(
            [
                'name' => ($request->has('name')) ? $request->name : $category->name,
            ]
        );
        Alert::success("Update Category" , "Update  Successfully !");
        return redirect(route('admin.category.index'));
    }

    public function delete($request)
    {
            $category = Category::find($request->category_id);
            $category->delete();
            Alert::error('Delete Category' , 'Deleted Successfully!');
            return redirect()->route('admin.category.index');

    }
}
