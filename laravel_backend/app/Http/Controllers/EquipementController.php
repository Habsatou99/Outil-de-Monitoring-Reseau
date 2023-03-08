<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipement;

class EquipementController extends Controller
{
    public function equipement()
    {
        $equipements=Equipement::all();
        return response()->json($equipements);
    }
   //create equipement
    public function store(Request $request)
    {
      $equipements=new Equipement([
        'name'=>$request->input('name'),
        'description'=>$request->input('description'),
        'ip_adress'=>$request->input('ip_adress'),
        'type'=>$request->input('type'),
      ]);
      $equipements->save();
      return response()->json('Equipement created!');
    }

    //delete
    public function destroy($id)
    {
        $equipements=Equipement::find($id);
        $equipements->delete();
        return response()->json('deleted!');
    }
}
