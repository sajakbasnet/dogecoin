<?php

namespace App\Http\Controllers\system\category2;

use App\Http\Controllers\Controller;
use App\Http\Requests\system\categoryRequest;
use App\Model\Category;
use Illuminate\Http\Request;

class categoryController2 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Category $category){
        $this->category = $category;
        $this->redirectUrl = url('/'.PREFIX.'/categories2');
    }

    public function index(Request $request)
    {
        $data['title'] = 'Categories';
        $data['categories'] = $this->category->getAllData($request);
        return view('system.oldCategory.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Category';
        return view('system.oldCategory.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(categoryRequest $request)
    {
        $data = $request->except('_token');
        $this->category->create($data);
        return redirect($this->redirectUrl)->withErrors(['alert-success' => 'Successfully created.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['category'] = $this->category->findOrFail($id);
        $data['title'] = 'Category';
        return view('system.oldCategory.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(categoryRequest $request, $id)
    {
        $category = $this->category->findOrFail($id);
        $data = $request->except('_token');
        $category->update($data);
        return redirect($this->redirectUrl)->withErrors(['alert-success' => 'Successfully updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->category->findOrFail($id);
        $category->delete();
        return redirect($this->redirectUrl)->withErrors(['alert-success' => 'Successfully deleted.']);
    }
}
