<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteContato;
use App\Models\MotivoContato;

class ContatoController extends Controller
{
    public function contato(Request $request) {

        //dd($request);
        /*echo '<pre>';
        print_r($request->all());
        echo '</pre>';

        echo $request->input('mensagem');
        */

        if($_SERVER["REQUEST_METHOD"] == "POST"){

            /*$contato = new SiteContato();
            $contato->nome = $request->input('nome');
            $contato->telefone = $request->input('telefone');
            $contato->email = $request->input('email');
            $contato->motivo_contato = $request->input('motivo_contato');
            $contato->mensagem = $request->input('mensagem');

            //print_r($contato->getAttributes());
            $contato->save();*/

            //echo '<pre>';
            //print_r($_SERVER);
            //echo '<hr>';
            //print_r($request->all());
            //echo '</pre>';
        }

        /*
        $contato = new SiteContato();
        $contato->fill($request->all());
        $contato->save();
        */

        /*
        $contato = new SiteContato();
        $contato->create($request->all());
        */

        //print_r($contato->getAttributes());

        $motivo_contatos = MotivoContato::all();

        return view('site.contato', ['titulo' => 'Contato', 'motivo_contatos' => $motivo_contatos]);
    }

    public function salvar(Request $request){

        //dd($request);

        $regras = [
            'nome' => 'required|min:3|max:40',
            'telefone' => 'required',
            'email' => 'email',
            'motivo_contatos_id' => 'required',
            'mensagem' => 'required|max:2000'
        ];

        $feedback = [
            'nome.min' => 'O campo nome precisa ter no mínimo 3 caracteres',
            'nome.max' => 'O campo nome precisa ter no mínimo 3 caracteres',
            'email.email' => 'O campo email precisa ser preenchido no formato de email',
            'mensagem.max' => 'O campo mensagem precisa ter no máximo 2000 caracteres',

            'required' => 'O campo :attribute deve ser preenchido'
        ];

        $request->validate($regras,$feedback);

        SiteContato::create($request->all());
        return redirect()->route('site.index');
    }
}
