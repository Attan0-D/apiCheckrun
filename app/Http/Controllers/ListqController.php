<?php

namespace App\Http\Controllers;

//use App\Http\Requests;
//use App\Models\Appointment;
use App\Models\Listq;
//use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ListRequest;
use App\Models\Appointment;

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
                $listq = new Listq();

                $listq->name = $us['name'];
                // $listq->frequency = $us['frequency'];
                // $listq->hour = $us['hour'];
                $listq->days = $us['days'];

                $listq->hour = Date("Y-m-d")."T".$us['hour'];

                $listq->user_id = $us['user_id'];
                $listq->category_id = $us['category_id'];

                

                $listq->save();
                $this->gerarQuestoes($listq, $us['questions']);
                $this->gerarAgendamentos($listq);


                return  response('Lista atualizada com sucesso', 201);
            });

        }
        catch(\Exception $erro){
            return $erro->getMessage();
        }
    }

    private function gerarQuestoes(Listq $listq, array $questions ){
        $listq->questions()->createMany(
            $questions
        );
    }

    private function gerarAgendamentos(Listq $listq){
        // $listq->appointments()->createOne(
           
        // );

        $semana = []; 
        $days = json_decode($listq->days);
        $days = str_replace('[', '', $days);
        $days = str_replace(']', '', $days);
        $days = explode(',', $days);

        for( $i=0; $i<=7; $i++ ){
            $diaAtual = date('Y-m-d H:i', strtotime("+$i days", strtotime($listq->hour)));
            $diaAtualNumero = (int) date('w', strtotime("+$i days", strtotime($listq->hour)));
            if (in_array($diaAtualNumero, $days)){
                $registro["date"] = $diaAtual; 
                $semana[] = $registro;
            }
        }
        
        $listq->appointments()->createMany($semana);
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
            $listq->days = $request->days;
            $listq->hour = $request->hour;

            $listq->user_id = $request->user_id;
            $listq->category_id = $request->category_id;

            $listq->save();

            //return $listq;
            return response('Lista atualizada com sucesso', 200);

        }catch(\Exception $erro) {
            return $erro->getMessage();
        }
    }

    public function destroy($id)
    {
        $listq = Listq::find($id);
        $listq->delete();
    }
}
