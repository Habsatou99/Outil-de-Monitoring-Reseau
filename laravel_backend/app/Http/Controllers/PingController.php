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
 
    //if($i==true)
    return response()->json($p,200); 
   }

   //register ping
  public function createPing($ip)
    {
      $match = "/temps[=<](\d+) [mM]s/"; 
      $res=utf8_encode(shell_exec("ping -n 3 $ip"));
      $test=preg_match($match,$res, $matches);
      //dd($matches);
      if($test==true){
        $pings=new Ping([
          'ip_adress'=>$ip,
          'result'=>$res,
          'time'=>(int) $matches[1],
      ]);
     
      }
      else{
        $pings=new Ping([
          'ip_adress'=>$ip,
          'result'=>$res, 
          'time'=>0,
        ]);
     
      }
     //dd($pings);
      //$i=$pings['result'];
 
      //dd($i);
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

    public function time()
    {
 // Exécute la commande ping
$host = 'www.example.com';
exec("ping -n 3 $host", $output);

// Utilise des expressions régulières pour extraire le maximum et le minimum
if (preg_match('/Minimum = ([\d\+]) ms/', end($output), $matches)) {
    $min = $matches[1];
    $max = $matches[2];
}

// Affiche le temps maximum et minimum
//echo "Temps maximum: $max ms\n";
echo "Temps minimum: $min ms\n";


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
