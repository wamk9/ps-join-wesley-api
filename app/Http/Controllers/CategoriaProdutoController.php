<?php

namespace App\Http\Controllers;

use App\Models\CategoriaProduto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriaProdutoController extends Controller
{
    public function create(Request $request)
    {
        $requestData = [
            'nome_categoria'
        ];

        $validateCategoriaProduto = Validator::make($request->only($requestData),
        [
            'nome_categoria' => 'required|max:150'
        ]);

        if($validateCategoriaProduto->fails()){
            return response()->json([
                'message' => 'Categoria de produto não foi salva devido a um problema de validação',
                'errors' => $validateCategoriaProduto->errors()
            ], 400);
        }

        $categoriaProduto = new CategoriaProduto($request->only($requestData));
        $categoriaProduto->save();

        return response()->json(['message' => "Categoria de produto salva com sucesso."], 201);
    }

    public function update(Request $request)
    {
        $categoriaProduto = CategoriaProduto::where('id_categoria_planejamento', $request->route('id'));

        if (!$categoriaProduto)
            return response()->json(['message' => "Categoria de produto não encontrada."], 204);

        $requestData = [
            'nome_categoria'
        ];

        $validateCategoriaProduto = Validator::make($request->only($requestData),
        [
            'nome_categoria' => 'required|max:150'
        ]);

        if($validateCategoriaProduto->fails()){
            return response()->json([
                'message' => 'Categoria de produto não foi salva devido a um problema de validação',
                'errors' => $validateCategoriaProduto->errors()
            ], 400);
        }

        $categoriaProduto->update($request->only($requestData));

        return response()->json(['message' => "Categoria de produto atualizada com sucesso."], 200);
    }

    public function show(Request $request)
    {
        $categoriaProduto = CategoriaProduto::where('id_categoria_planejamento', $request->route('id'))->first();

        if (!$categoriaProduto)
            return response()->json(['message' => "Categoria de produto não encontrada."], 204);

        return response()->json(['message' => $categoriaProduto], 200);
    }

    public function delete(Request $request)
    {
        $categoriaProduto = CategoriaProduto::where('id_categoria_planejamento', $request->route('id'));

        if (!$categoriaProduto)
            return response()->json(['message' => "Categoria de produto não encontrada."], 204);

        $categoriaProduto->delete();

        return response()->json(['message' => "Categoria de produto deletada com sucesso."], 200);
    }

    public function showList()
    {
        $categoriasProduto = CategoriaProduto::all();

        if (!$categoriasProduto)
            return response()->json(['message' => "Sistema sem categorias cadastradas."], 204);

        return response()->json(['message' => $categoriasProduto], 200);
    }
}
