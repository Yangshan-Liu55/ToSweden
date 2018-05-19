<?PHP

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;

use Illuminate\Http\Response;


class toSwedenControllers extends Controller{

   /* public function translate($lang)
    {
        Session::put('language','en');
    } */

    public function storeSessionData(Request $request){
        $request->session()->put('my_name','Virat Gandhi');
        echo "Data has been added to session";
     }

     public function accessSessionData(Request $request){
        if($request->session()->has('my_name'))
           echo $request->session()->get('my_name');
        else
           echo 'No data in the session';
     }


     // COOKIE
     public function setCookie(Request $request){
        $minutes = 5;
        $response = new Response('Hello Worlds');
        $response->withCookie(cookie('name', 'test', $minutes));
        return $response;
     }
     public function getCookie(Request $request){
        $value = $request->cookie('name');
        echo $value;
     }

     public function sample2($id)
     {
         Cookie::queue('name', $id, 60);
         return response('Set cookie');
     }
    
}

