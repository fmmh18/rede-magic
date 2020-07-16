<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Filme;
use Illuminate\Support\Facades\Validator;

class FilmeController extends Controller
{

    public function index()
    {
        return Filme::all();
    }


    public function store(Request $request)
    {

        $input = $request->all();

        $messages = [
            'required' => 'O campo :attribute é obrigatório.',
            'numeric' => 'O campo :attribute é numérico.',
        ];

        $rules = [ 
            'nome' => 'required',
            'ano' => 'required|numeric',
            'atores' => 'required',
            'diretor' => 'required',
            'classificacao_filme' => 'required|numeric'
        ];

        if($request->hasFile('cartaz')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cartaz')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cartaz')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cartaz')->storeAs('public/cartaz', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.png';
        }
            
        $validatedData = Validator::make($input,$rules, $messages);
       
        if($validatedData->fails())
        {
            return $validatedData->messages();
        }
        else
        {
            $result = Filme::create([
                'nome' => $request->nome, 
                'ano' => $request->ano, 
                'atores' => $request->atores, 
                'diretor' => $request->diretor, 
                'classificacao_filme' => $request->classificacao_filme, 
                'cartaz' => $fileNameToStore
            ]);

            return $result->id;
        }
        
    }

    public function show($id)
    {
        $filme = Filme::findOrfail($id);

        return $filme;
    }

    public function update(Request $request, $id)
    {
       
        $filme = Filme::findOrfail($id);

        $input = $request->all();

        $messages = [
            'required' => 'O campo :attribute é obrigatório.',
            'numeric' => 'O campo :attribute é numérico.',
        ];

        $rules = [ 
            'nome' => 'required',
            'ano' => 'required|numeric',
            'atores' => 'required',
            'diretor' => 'required',
            'classificacao_filme' => 'required|numeric'
        ];
            
        $validatedData = Validator::make($input,$rules, $messages);
       
        if($validatedData->fails())
        {
            return $validatedData->messages();
        }
        else
        {
            return $filme->update($request->all());
        }
 
    }

    public function destroy($id)
    {
        $filme = Filme::findOrfail($id);
        $filme->delete();
    }
}
