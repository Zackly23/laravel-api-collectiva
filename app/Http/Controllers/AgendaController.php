<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    //
    public function getAllAgendas() {
        $agendas = Agenda::latest()->get();

        return response()->json($agendas, 200);
    }

    public function storeAgenda(Request $request) {
        $agenda = Agenda::create($request->all());

        return response()->json(["message" => "Store Succesfully"], 200);
    }
}
