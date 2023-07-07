<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    public function get_all_produtos() {
        $produtos = Produto::with('marca')->get();

        return response()->json([
            'produtos' => $produtos
        ], 200);
    }

    public function search_produtos(Request $request) {
        $search = $request->get('s');
        if ($search != null) {
            $produtos = Produto::with('marca')->where('nome', 'LIKE', "%$search%")->get();
            return response()->json([
                'produtos' => $produtos
            ], 200);
        } else {
            // Se a busca nao retornou dados, devolve todos os Produtos para o Front
            return $this->get_all_produtos();
        }
    }

    public function add_produto(Request $request){
        $dados_produto['id_marca'] = $request->input('marca_id');
        $dados_produto['nome'] = $request->input('nome');
        $dados_produto['preco'] = $request->input('preco');

        $produto = Produto::create($dados_produto);
    }

    public function edit_produto($id){
        $produto = Produto::with('marca')->find($id);
        return response()->json([
            'produto' => $produto,
        ], 200);
    }

    public function update_produto(Request $request, $id){
        $produto = Produto::where('id', $id)->first();

        $produto->nome = $request->nome;
        $produto->preco = $request->preco;
        $produto->id_marca = $request->id_marca;

        $produto->update($request->all());
    }

    public function delete_produto($id){
        $produto = Produto::findOrFail($id);
        $produto->delete();
    }

    public function verifica_produtos_marca($id){
        $produtos = Produto::with('marca')->where('id_marca', '=', $id)->get();;
        return response()->json([
            'produtos' => $produtos,
        ], 200);
    }
}
