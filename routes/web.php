<?php

use App\Events\OpenAIMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use OpenAI\Laravel\Facades\OpenAI;
use Gemini\Laravel\Facades\Gemini;


Route::get('/', function () {
    // $result = OpenAI::chat()->create([
    //     'model' => 'gpt-4o-mini',
    //     'messages' => [
    //         [
    //             'role' => 'user',
    //             'content' => "hello",
    //         ],
    //     ],
    // ]);

    // echo $result->choices[0]->message->content;

    return view('welcome');
});

Route::post('ask', function (Request $request) {
    // $result = OpenAI::chat()->create([
    //     'model' => 'gpt-4o-mini',
    //     'messages' => [
    //         [
    //             'role' => 'owner',
    //             'content' => $request->input('message'),
    //         ],
    //     ],
    // ]);

    // OpenAIMessage::dispatch($result->choices[0]->message->content);


    $stream = Gemini::geminiPro()
        ->streamGenerateContent($request->message);

    foreach ($stream as $response) {
        OpenAIMessage::dispatch($response->text());
    }
});
