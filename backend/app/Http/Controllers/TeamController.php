<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

class TeamController extends Controller
{
    public function all() {
        $allTeams = Team::all();
        if (count($allTeams) > 0) 
            return response()->json([
                'data' => $allTeams
            ], 200);
        else 
            return response()->json([
                'message' => "Nenhum time cadastrado"
            ], 404);
    }

    public function store(Request $request) {
        try {
            $newTeam = Team::create([
                'name' => $request->teamName
            ]);
            return response()->json([
                'message' => 'Time cadastrado com sucesso!', 
                'data' => $newTeam
            ], 201);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Falha ao cadastrar novo time', 
                'error' => $e
            ], 500);
        }
    }
}
