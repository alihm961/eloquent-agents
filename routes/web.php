<?php


use App\Models\Agent;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

Route::get('/agents/cursor', function() {
    foreach(Agent::where('active', true)->cursor() as $agent) {
        echo $agent->name
    }
});

Route::get('/agents/chunkById', function () {
    Agent::chunkById(100, function(Collection $agents) {
        foreach($agents as $agent) {
            echo $agent->name
        }
    });
});

Route::get('/agents/lazyById', function (){
    foreach (Agent::lazyById() as $agent) {
        echo $agent->name
    }
});

Route::get('/agents/sybquery', function () {
    $results = Agent::addSelect([
        'latest_name' => Agent::select('name')
        ->whereColumn('agents.id', 'agents.id')
        ->orderByDesc('id')
        ->limit(1)
    ])->get()

        return $results
    
});


