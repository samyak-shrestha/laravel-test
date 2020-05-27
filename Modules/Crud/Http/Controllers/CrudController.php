<?php

namespace Modules\Crud\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Crud\Entities\Crud;

use Modules\Crud\Repository\CrudRepository as repo;
use Illuminate\Support\Facades\Session;
use Modules\Crud\Http\Requests\CrudRequest;

// use App\Validation\PostValidator;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {

        $data = Crud::latest()->paginate(5);
        return view('crud::index', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

        //implement pagination
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('crud::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(CrudRequest $request)
    {
        $datas = $request->validated();
        Crud::create($datas);
        Session::flash('success', 'Data is successfully Stored');

        return response()->json([
            'errors'    => [],
            'redirect' => route('crud.index'),
            'message' => 'Data Saved Successfully',
            'status' => 200
        ], 200);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $data = Crud::findOrFail($id);
        return view('crud::show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id = NULL)
    {
        $data = Crud::findOrFail($id);
        return view('crud::edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(CrudRequest $request, $id)
    {
        $datas = $request->validated();

        Crud::whereId($id)->update($datas);

        return redirect('crud')->with('success', 'Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $data = Crud::findOrFail($id);
        $data->delete();

        return redirect('crud')->with('success', 'Data is successfully deleted');
    }
}
