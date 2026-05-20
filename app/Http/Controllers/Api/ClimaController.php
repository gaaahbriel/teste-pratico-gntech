<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clima;

class ClimaController extends Controller
{
    // GET /api/climas
    public function index()
    {
        return response()->json([
            'mensagem' => 'Lista de climas',
            'data' => Clima::all()
        ]);
    }

    // GET /api/climas/{id}
    public function show(string $id)
    {
        $clima = Clima::find($id);
        if (!$clima) {
            return response()->json([
                'mensagem' => 'Clima não encontrado',
            ], 404);
        }
        return response()->json([
            'mensagem' => 'Clima encontrado',
            'data' => $clima
        ]);
    }

    // POST /api/climas
    public function store(Request $request)
    {

        $dados = $request->validate([
            'cidade' => 'required',
            'temperatura' => 'required|numeric',
            'sensacao_termica' => 'required|numeric',
            'umidade' => 'required|integer',
            'clima' => 'required',
            'vento' => 'required|numeric'
        ]);

        $clima = Clima::create($dados);

        return response()->json([
            'mensagem' => 'Registro criado com sucesso',
            'dados' => $clima
        ], 201);
    }

    // PUT /api/climas/{id}
    public function update(Request $request, string $id){
        $clima = Clima::find($id);
        if (!$clima) {
            return response()->json([
                'mensagem' => 'Clima não encontrado',
            ], 404);
        }

        $clima->update($request->all());

        return response()->json([
            'mensagem' => 'Registro atualizado com sucesso',
            'dados' => $clima
        ]);
    }

    // DELETE /api/climas/{id}
    public function destroy(string $id){
        $clima = Clima::find($id);
        if (!$clima) {
            return response()->json([
                'mensagem' => 'Clima não encontrado',
            ], 404);
        }

        $clima->delete();

        return response()->json([
            'mensagem' => 'Registro deletado com sucesso'
        ]);
    }
}
