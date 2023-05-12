<?php

namespace App\Http\Controllers;

use App\Models\Equipement;
use App\Models\Ping;
use Hamcrest\Core\HasToString;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\String_;

use function GuzzleHttp\Promise\all;

class PingController extends Controller
{
  public function pings()
  {
      $pings=Ping::all();
      return response()->json($pings,200);
  }

    // return ping
   public function getPing($pings)
   {
 
    //$pings=Equipement::find('id')['ip_adress'];
    
   // dd($pings);
    if(is_null($pings)){
      return response()->json(['message'=>'Ping Not Found'],400);
    };
    
    $p1=Ping::all();
    //dd($p1);
  
    foreach ($p1 as $ping) {
      if($ping->ip_adress==$pings){
        $p[]=Ping::find($ping->id);
        //$i=true;
      }
      /*else
      {
        $i=false;
      }*/  
  }
 //dd($p);
    //if($i==true)
    return response()->json($p,200); 
   }

   //register ping
  public function createPing($ip)
    {
      $match = "/temps[=<](\d+) [mM]s/"; 
      $res=utf8_encode(shell_exec("ping -n 3 $ip"));
      $test=preg_match($match,$res, $matches);
     // $i="knk";
      //dd($test);
      if($test==true){
        $pings=new Ping([
          'ip_adress'=>$ip,
          'result'=>$res,
          'time'=>(int) $matches[1],
          //'color'=>$i
      ]);
     
      }
      else{
        $pings=new Ping([
          'ip_adress'=>$ip,
          'result'=>$res, 
          'time'=>0,
          //'color'=>$i
        ]);
     
      }
      $pings->save(); 
      return response()->json("Ping successful",200);
    }

    //delete ping
    public function destroy($id)
    {
        $pings=Ping::find($id);
        if(is_null($pings)){
          return response()->json(['message'=>'Ping Not Found'],404);
        }
        $pings->delete();
        return response()->json('deleted!',204);
    }
    //get date when one date
    public function getPingDate1($date)
    {
      $p=[]; 
      $p1 = Ping::orderBy('created_at', 'asc')->whereDate('created_at', $date)->get();
      foreach ($p1 as $ping) {
          $p[]=Ping::find($ping->id);
      }
      return response()->json($p);
    }
//get date when one date if specify ipAdress
public function getPingDate($date,$pings)
{
  $p=[];

  $p1 = Ping::orderBy('created_at', 'asc')->whereDate('created_at', $date)->get();
  //dd($p1);
   foreach ($p1 as $ping) {
     if($ping->ip_adress==$pings){
       $p[]=Ping::find($ping->id);
       //dd($p);
     }

  }


return response()->json($p);
}
//get data beetween two different dates 
public function getPingsBetweenDates1($start,$end)
{
  $p=[]; 
  $p1 = Ping::orderBy('created_at', 'asc')->whereBetween('created_at', [$start, $end])->get();
  foreach ($p1 as $ping) {
      $p[]=Ping::find($ping->id);
  }
   return response()->json($p);
}

//get data between two different dates if specify ipidress
public function getPingsBetweenDates($start, $end,$pings) {
  $p=[]; 
$p1 = Ping::orderBy('created_at', 'asc')->whereBetween('created_at', [$start, $end])->get();
  foreach ($p1 as $ping) {
    if($ping->ip_adress==$pings){
      $p[]=Ping::find($ping->id);
    }
   
}
return response()->json($p);
}




     //delete pingAll
    /* public function destroyAll($id)
     {
         $pings=Ping::find($id);
         if(is_null($pings)){
           return response()->json(['message'=>'Ping Not Found'],404);
         }
         $pings->delete();
         return response()->json('deleted!',204);
     }*/
}
