<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Adress;
use Illuminate\Support\Facades\Auth;
use DB;
use Pusher\Pusher;
use App\Models\Message;
use App\Models\Business;

class AdressController extends Controller
{
    public function endereco($id)
    {
        $endereco = Adress::where('user_id', $id)->get()->toArray()[0];

        return view('pages.registerAdress', compact('endereco'));
    }

    public function save_adress(Request $request)
    {
        $address = new Adress;
        $address->logradouro = $request['logradouro'];
        $address->numero = $request['numero'];
        $address->bairro = $request['bairro'];
        $address->complemento = $request['complemento'];
        $address->cep = $request['cep'];
        $address->user_id = auth()->id();

        $address->save();
        return response()->json(['success' => 'Endereço registrado com sucesso!']);
    }

    public function update_adress(Request $request)
    {
        $address = Adress::find(auth()->id());
        $address->logradouro = $request['logradouro'];
        $address->numero = $request['numero'];
        $address->bairro = $request['bairro'];
        $address->complemento = $request['complemento'];
        $address->cep = $request['cep'];
        $address->user_id = auth()->id();

        $address->save();
        return response()->json(['success' => 'Endereço atualizado com sucesso!']);
    }
}
