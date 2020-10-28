<?php

namespace App\Http\Controllers;

//use App\Http\Requests;
//use App\Models\Appointment;
use App\Models\Listq;
//use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ListRequest;

class ListqController extends Controller
{
    public function index()
    {

        $listq = Listq::all();
        return $listq;
    }

    public function create()
    {
        //
    }

    public function store(ListRequest $request)
    {
        
        try{
            DB::transaction(function () use ($request) {
                $us = $request->all();
                $listq = new Listq;

                $listq->name = $us['name'];
                $listq->frequency = $us['frequency'];
                $listq->hour = $us['hour'];
                
    
                $listq->user_id = $us['user_id'];
                $listq->category_id = $us['category_id'];

                $listq->save();

                 

                //return $listq;
                return response('Lista criada com sucesso', 201);
            });
        }
        catch(\Exception $erro){
            return $erro->getMessage();
        }

        
    }

      public function show(int $user_id)
     {
         //retorna uma lista de um usuario especifico
        $listq = Listq::where('user_id',$user_id)->get();
        return $listq; 
     }

    // public function edit(User $user)
    // {
    //     //
    // }

    public function update(ListRequest $request, $id)
    {
        try{

            $listq = Listq::find($id);

            $listq->name = $request->name;
            $listq->frequency = $request->frequency;
            $listq->user_id = $request->user_id;
            $listq->category_id = $request->category_id;

            $listq->save();

            //return $listq;
            return response('Lista atualizada com sucesso', 200);

        }
        catch(\Exception $erro) {
            return $erro->getMessage();       
        }
    }

    public function destroy($id)
    {
        $listq = Listq::find($id);
        $listq->delete();
    }
}
