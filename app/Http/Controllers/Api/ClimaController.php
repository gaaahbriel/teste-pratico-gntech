<?php

namespace App\Http\Controllers\Api;

use OpenApi\Attributes as OA;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clima;

class ClimaController extends Controller
{
    #[OA\Get(
        path: "/api/climas",
        summary: "Exibe todos os climas",
        tags: ["Climas"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Sucesso"
            )
        ]
    )]

    public function index()
    {
        $climas = Clima::all();
        return response()->json([
            'mensagem' => 'Climas encontrados',
            'data' => $climas
        ]);
    }

    #[OA\Get(
        path: "/api/climas/{id}",
        summary: "Exibe um clima específico",
        tags: ["Climas"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Sucesso"
            )
        ]
    )]
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

        #[OA\Post(
        path: "/api/climas",
        summary: "Cria um novo clima",
        tags: ["Climas"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["cidade", "temperatura", "sensacao_termica", "umidade", "clima", "vento"],
                properties: [
                    new OA\Property(property: "cidade", type: "string"),
                    new OA\Property(property: "temperatura", type: "number", format: "float"),
                    new OA\Property(property: "sensacao_termica", type: "number", format: "float"),
                    new OA\Property(property: "umidade", type: "integer"),
                    new OA\Property(property: "clima", type: "string"),
                    new OA\Property(property: "vento", type: "number", format: "float")
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "Sucesso"
            )
        ]
    )]
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

        #[OA\Put(
        path: "/api/climas/{id}",
        summary: "Atualiza um clima específico",
        tags: ["Climas"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["cidade", "temperatura", "sensacao_termica", "umidade", "clima", "vento"],
                properties: [
                    new OA\Property(property: "cidade", type: "string"),
                    new OA\Property(property: "temperatura", type: "number", format: "float"),
                    new OA\Property(property: "sensacao_termica", type: "number", format: "float"),
                    new OA\Property(property: "umidade", type: "integer"),
                    new OA\Property(property: "clima", type: "string"),
                    new OA\Property(property: "vento", type: "number", format: "float")
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "Sucesso"
            )
        ]
    )]
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

        #[OA\Delete(
        path: "/api/climas/{id}",
        summary: "Deleta um clima específico",
        tags: ["Climas"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Sucesso"
            )
        ]
    )]
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
