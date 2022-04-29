<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Event;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
  
class FullCalenderController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request)
    {
        if (!Auth::check()) {
            // The user is not logged in...
            return redirect("login");
        }
  
        if($request->ajax()) {
       
             $data = Event::whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)
                       ->get(['id', 'title','color', 'start', 'end', 'tecnico_id']);
  
             return response()->json($data);
        }
  
    // return $request;
        return view('fullcalender');
    }
 
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function ajax(Request $request)
    {
        
        $tipo = $request->type;
        
        if($request->add){
            $tipo = "add";
        }
        if($request->update){
            $tipo = "update";
        }
        switch ($tipo) {
           case 'add':
              $event = Event::create([
                  'title' => $request->title,
                  'color' => $request->color,
                  'start' => $request->start,
                  'end' => $request->end,
                  'tecnico_id' => $request->tecnico_id,
              ]);
              return response()->json($event);
             break;
  
           case 'update':
              $event = Event::find($request->id)->update([
                  'title' => $request->title,
                  'color' => $request->color,
                  'start' => $request->start,
                  'end' => $request->end,
                  'tecnico_id' => $request->tecnico_id,
              ]);
 
              return response()->json($event);
             break;
  
           case 'delete':
              $event = Event::find($request->id)->delete();
  
              return response()->json($event);
             break;
             
           default:
             # code...
             break;
        }
    }
}
