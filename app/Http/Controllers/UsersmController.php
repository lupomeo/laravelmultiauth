<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UsersmController extends Controller
{

    public function index()
    {
        if (auth()->user()->id == 1 or auth()->user()->role == "Admin") {
            
            return view('usersm');
        } else  {
            return view('msg', ['msg' => 'Solo gli Amministratori hanno accesso a questa funzione.']);
        }
    }

    public function getUsersm(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'product-action')
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $student  = User::where($where)->first();

        return Response()->json($student);
    }

    public function store(Request $request)
    {

        $productId = $request->id;
/* 
        $request->validate([
            'first_name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => ['required', Password::min(6)->letters()->mixedCase()->symbols()]
        ]);
*/


        if(empty($request->password)) {
            $product = User::updateOrCreate(
                [
                'id' => $productId
                ],
                [
                'name' => $request->name,
                'email' => $request->email,
                'type' => $request->role,
                ]
            );
        } else {
            $product = User::updateOrCreate(
                [
                'id' => $productId
                ],
                [
                'name' => $request->name,
                'email' => $request->email,
                'type' => $request->role,
                'password' => Hash::make($request->password),
                'remember_token' => Str::random(10)
                ]
            );
        }
 
        return Response()->json($product);
    }

    public function saveprofile(Request $request)
    {

        $productId = $request->id;
        
            $product = User::updateOrCreate(
                [
                'id' => $productId
                ],
                [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'gender' => $request->gender,
                'address' => $request->address,
                'number' => $request->number,
                'city' => $request->city,
                'ZIP' => $request->ZIP
                ]
            );
        
       // return Response()->json($product);
       return redirect('profile')->with('status', 'Profilo Aggiornato');
    }

    public function destroy(Request $request)
    {
        $product = User::where('id', $request->id)->delete();

        return Response()->json($product);
    }


}