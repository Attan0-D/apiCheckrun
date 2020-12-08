<?php

namespace App\Http\Controllers;

use App\Models\Listq;

use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    public function index()
    {
        $question = Question::all();
        return $question;
    }


    public function create()
    {
        //
    }

    public function store(QuestionRequest $request)
    {
        try{
                $us = $request->all();
                $question = new Question;

                $question->description = $us['description'];

                $question->yes = $us['yes'];
                $question->no = $us['no'];

                $question->list_id = $us['list_id'];

                $question->save();

                return response('Questão cadastrada com sucesso', 201);



        }catch(\Exception $erro) {
            return $erro->getMessage();
        }
    }

    public function show(int $listq_id)
    {
        //retornas as questões de uma lista em especifica
        $question = question::where('listq_id',$listq_id)->get();
        return $question;
    }

    public function edit(Question $question)
    {
        //
    }

    public function update(QuestionRequest $request, $id)
    {
        try{

                $question = Question::find($id);

                $question->description = $request->description;

                $question->save();


            return response('Questão atualizada com sucesso', 200);;

        }catch(\Exception $erro) {

            return $erro->getMessage();
        }
    }

    public function destroy($id)
    {
        $question = Question::find($id);
        $question->delete();
    }
}
