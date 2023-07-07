<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;

class MarcaController extends Controller
{
    public function all_marcas(){
        $marcas = Marca::orderBy('nome', 'ASC')->get();

        return response()->json([
            'marcas' => $marcas
        ], 200);
    } 

    public function search_marcas(Request $request) {
        $search = $request->get('s');
        if ($search != null) {
            $marcas = Marca::where('nome', 'LIKE', "%$search%")->get();
            return response()->json([
                'marcas' => $marcas
            ], 200);
        } else {
            // Se a busca nao retornou dados, devolve todas as Marcas para o Front
            return $this->all_marcas();
        }
    }

    public function add_marca(Request $request){

        $dados_marca['nome'] = $request->input('nome');

        $marca = Marca::create($dados_marca);

    }

    public function edit_marcas($id){
        $marca = Marca::find($id);
        return response()->json([
            'marca' => $marca,
        ], 200);
    }

    public function update_marca(Request $request, $id){
        $marca = Marca::where('id', $id)->first();
        $marca->nome = $request->nome;
        $marca->update($request->all());
    }

    public function delete_marca($id){
        $marca = Marca::findOrFail($id);
        $marca->delete();
    }
}
