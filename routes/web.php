<?php


use App\Models\Agent;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;

Route::get('/agent/create', function () {
    Agent::create(['name' => 'AliBot', 'role' => 'Assistant']);
});

Route::get('/agents', function () {
    return Agent::all();
});

Route::get('/agent/update/{id}', function ($id) {
    $agent = Agent::find($id);
    $agent->role = 'Updated Role';
    $agent->save();
});

Route::get('/agent/delete/{id}', function ($id) {
    Agent::destroy($id);
});

Route::get('/agents/chunk', function () {
    Agent::chunk(100, function (Collection $agents) {
        foreach ($agents as $agent) {
            echo $agent->name . '<br>';
        }
    });
});

Route::get('/agents/lazy', function () {
    foreach (Agent::lazy() as $agent) {
        echo $agent->name . '<br>';
    }
});
