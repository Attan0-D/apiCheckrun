<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{

    public function index()
    {
        $user = User::all('id', 'name','email');
        return $user;
    }

    public function create()
    {
        //
    }

    public function store(UserStoreRequest $request)
    {
        try{
            $us = $request->all();
            $user = new User;

            $user->name = $us['name'];
            $user->email = $us['email'];
            $user->password = $us['password'];
            $confirmPassword = $us['confirmPassword'];

            //verifica se o email ja existe no banco
            $userExists = User::where('email', $us['email'])->first();

            if($userExists){
                return response('Email Não Permitido: Outro usuario já esta cadastrado com esse email.', 400);
            }

            //verifica a compatibilidade com os campos senha e confirmar senha
            if ($user->password != $confirmPassword ){
                return response ('As senhas não coicidem', 400);
            };

            $user->password = Hash::make($user->password);

            $user->save();

            return $user;

        }
        catch(\Exception $erro)
        {
            return $erro->getMessage();
        }
    }
    public function show(int $user_id)
    {
        //retorna o usuario e suas listas de um id específico
        return User::with('listqs')->find($user_id);
    }
    public function edit(User $user)
    {
        //
    }

    public function update(UserUpdateRequest $request, $id)
    {
        try{

            $user = User::find($id);

                $user->name = $request->name;

                //variavel para a segunda condição abaixo
                $oldemail = $user->email;

                $user->email = $request->email;
                $user->password = $request->password;

                //verifica se o email digitado já esta em uso.
                $userExists = User::where('email', $user->email)->first();

                // para verificar a existencia do email no banco, e se o mesmo ja
                // sendo utilizado pelo usuario em questão.
                if($userExists && $userExists->email != $oldemail){
                        return response('Email Não Permitido:
                        Outro usuario já esta cadastrado com esse email.', 400);
                }

                $user->save();
                return response('Usuario atualizado com sucesso', 200);

        }catch(\Exception $erro) {
            return $erro->getMessage();
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
    }

    public function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');

        //condição que verifica se o password ou email são ou não válidos
        if (!$email || !$password) {
            return response('Credenciais inválidas.', 400);
        }

        $user = User::where('email', $email)->first();

        //conversão da senha digitada transformada em hash, para a válidação dessas credencias
        if(!$user || !Hash::check($password, $user->password)){
            return response('Credenciais inválidas.', 400);
        }


       return $user;
    }
}
