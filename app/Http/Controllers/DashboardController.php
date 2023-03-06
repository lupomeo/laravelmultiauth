<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function index()
    {

        $users_count = User::count();
        $last = User::find(User::max('id'));
        
        $day = [];
        for ($i=1 ; $i <= 32 ; $i++)
        {
            $day[$i] = "0";
        }
        $fromDate = Carbon::now()->startOfMonth()->toDateString();
        $tillDate = Carbon::now()->endOfMonth()->toDateString();
        $month = User::whereBetween('created_at',[$fromDate,$tillDate])->get();

        $index = "0";
        foreach ($month as $value) {
            $index = $value['created_at']->toDateString();
            $index = (int)substr($index,8);
            ++$day[$index];
        }
        
        return view('dashboard')
            ->with('utotal', $users_count)
            ->with('lastu', $last['name'])
            ->with('day', $day);
    }
    

    
}