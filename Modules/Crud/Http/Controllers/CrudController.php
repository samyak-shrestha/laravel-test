<?php

namespace Modules\Crud\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Crud\Entities\Crud;

use Modules\Crud\Repository\CrudRepository as repo;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\Facades\Session;

// use App\Validation\PostValidator;

class CrudController extends Controller
{
    public function __construct(repo $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(EntityManagerInterface $em)
    {
        $datas = $em->getRepository(Crud::class)->findAll();
        return View('crud::index')->with(['data' => $datas]);
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
    public function store(Request $request, EntityManagerInterface $em)
    {
        $request->validate([
            'first_name'    =>  'required',
            'last_name'     =>  'required',
        ]);

        $crud = new Crud(
            $request->get('first_name'),
            $request->get('last_name')
        );

        $em->persist($crud);
        $em->flush();

        // return response('Hello World', 200)
        //     ->json([
        //         'message' => 'created successfully',
        //         'status' => 200
        //     ])
        //     ->header('Content-Type', 'text/plain');

        return response()->json([
            'message' => 'created successfully',
            'status' => 200
        ]);

        // return redirect('crud')->with('success', 'Data Added successfully.');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show(EntityManagerInterface $em, $id)
    {
        $data = $em->getRepository(Crud::class)->find($id);
        return view('crud::show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id = NULL)
    {
        $data = $this->repo->postOfId($id);
        return View('crud::edit')->with(['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name'    =>  'required',
            'last_name'     =>  'required'
        ]);

        $all =  $request->except(['_token', '_method', 'edit']);

        $Id = $this->repo->postOfId($id);
        if (!is_null($Id)) {
            $this->repo->update($Id, $all);
            return redirect('crud')->with('success', 'Data is successfully updated');
        } else {
            $this->repo->create($this->repo->perpare_data($all));
            return redirect('crud')->with('error', 'errr occured');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $data = $this->repo->postOfId($id);
        if (!is_null($data)) {
            $this->repo->delete($data);
            return redirect('crud')->with('success', 'Data deleted successfully');
        } else {
            return redirect('crud')->with('error', 'Data deleted successfully');
        }
    }
}
