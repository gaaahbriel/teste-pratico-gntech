<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Clima;

class WeatherController extends Controller
{
    public function index($city)
    {
        $apiKey = env('OPENWEATHER_API_KEY');

        $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
            'q' => $city,
            'appid' => $apiKey,
            'units' => 'metric',
            'lang' => 'pt_br'
        ]);

        if ($response->failed()) {
            return response()->json(
                [
                    'error' => 'Não foi possível obter os dados do clima.'
                ],
                500
            );
        }

        $dados = $response->json();

        $clima = Clima::create([
            'cidade' => $dados['name'],
            'temperatura' => $dados['main']['temp'] . ' °C',
            'sensacao_termica' => $dados['main']['feels_like'] . ' °C',
            'umidade' => $dados['main']['humidity'] . '%',
            'clima' => $dados['weather'][0]['description'],
            'vento' => $dados['wind']['speed'] . ' m/s'
        ]);

        return response()->json([
            'mensagem' => 'Dados do clima obtidos com sucesso.',
            'dados' => $clima
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
