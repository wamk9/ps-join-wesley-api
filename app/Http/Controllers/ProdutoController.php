<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdutoController extends Controller
{
    public function create(Request $request)
    {
        $requestData = [
            'id_categoria_produto',
            'nome_produto',
            'valor_produto'
        ];

        $validateProduto = Validator::make($request->only($requestData),
        [
            'nome_produto' => 'required|max:150',
            'valor_produto' => ['required','regex:/^[0-9]{1,10}[.][0-9]{0,2}$/'],
            'id_categoria_produto' => 'required|numeric'
        ]);

        if($validateProduto->fails()){
            return response()->json([
                'message' => 'Produto não foi salvo devido a um problema de validação.',
                'errors' => $validateProduto->errors()
            ], 400);
        }

        $produto = new Produto($request->only($requestData));
        $produto->save();

        return response()->json(['message' => "Produto salvo com sucesso."], 201);
    }

    public function update(Request $request)
    {
        $produto = Produto::where('id_produto', $request->route('id'));

        if (!$produto)
            return response()->json(['message' => "Produto não encontrado."], 204);

        $requestData = [
            'id_categoria_produto',
            'nome_produto',
            'valor_produto'
        ];

        $validateProduto = Validator::make($request->only($requestData),
        [
            'nome_produto' => 'required|max:150',
            'valor_produto' => ['required','regex:/^[0-9]{1,10}[.][0-9]{0,2}$/'],
            'id_categoria_produto' => 'required|numeric'
        ]);

        if($validateProduto->fails()){
            return response()->json([
                'message' => 'Produto não foi salvo devido a um problema de validação.',
                'errors' => $validateProduto->errors()
            ], 400);
        }

        $produto->update($request->only($requestData));

        return response()->json(['message' => "Produto atualizado com sucesso."], 200);
    }

    public function show(Request $request)
    {
        $produto = Produto::where('id_produto', $request->route('id'))->first();

        if (!$produto)
            return response()->json(['message' => "Produto não encontrado."], 204);

        $produto->categoriaProduto;

        return response()->json(['message' => $produto], 200);
    }

    public function delete(Request $request)
    {
        $produto = Produto::where('id_produto', $request->route('id'));

        if (!$produto)
            return response()->json(['message' => "Produto não encontrado."], 204);

        $produto->delete();

        return response()->json(['message' => "Produto deletada com sucesso."], 200);
    }

    public function showList()
    {
        $produtos = Produto::all();

        if (!$produtos)
            return response()->json(['message' => "Sistema sem produtos cadastrados."], 204);

        $return = [];

        foreach ($produtos as $produto)
        {
            $produto->categoriaProduto;

            $return[] = $produto;
        }

        return response()->json(['message' => $return], 200);
    }
}
