<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipement;
use App\Models\Ping;
class EquipementController extends Controller
{
  //return all equipement
    public function equipements()
    {
        $equipements=Equipement::all();
        return response()->json($equipements,200);
    }

    //return equipement by Id
    public function getEquipementById($id)
    {
      
      $equipements=Equipement::find($id);
      
      if(is_null($equipements)){
        return response()->json(['message'=>'Equipement Not Found'],400);
      }
      return response()->json($equipements::find($id),200);
    }

   //create equipement
    public function create(Request $request)
    {
      $equipements=new Equipement([
        'name'=>$request->input('name'),
        'description'=>$request->input('description'),
        'ip_adress'=>$request->input('ip_adress'),
        'type'=>$request->input('type'),
      ]);
      $equipements->save();
      return response()->json('Equipement created!',201);
    }
     
    //update
    public function update(Request $request,$id)
    {
      $equipements=Equipement::find($id);
      if(is_null($equipements)){
        return response()->json(['message'=>'Equipement Not Found'],404);
      }
      $equipements->update($request->all());
      return response()->json('Equipement updated',200);
    }

    //delete
    public function destroy($id)
    {
        $equipements=Equipement::find($id);
        $ip=Equipement::find($id)['ip_adress'];
        $p1=Ping::all();
  
  
       
        //dd($p);
        if(is_null($equipements)){
          return response()->json(['message'=>'Equipement Not Found'],404);
        }
        $equipements->delete();
        foreach ($p1 as $ping) {
          if($ping->ip_adress==$ip){
            $p=Ping::find($ping->id);
            $p->delete();
            
          }
      }
     
        return response()->json('deleted!',204);
    }
}
