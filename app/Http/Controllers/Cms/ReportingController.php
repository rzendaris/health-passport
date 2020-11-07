<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Storage;
use Exception;
use Excel;
use App\Exports\DownloadExport;

use App\User;
use App\Model\Table\DownloadApps;

class ReportingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(function ($request, $next) {
        //     if (Auth::user()->role_id != 1){
        //         return redirect('family-tree')->with('access_message', 'Akses untuk Menu Report Ditolak!');
        //     }
        //     return $next($request);
        // });

    }
    public function Report()
    {
        return view('report/index');
    }
    public function exportExcel(Request $request)
    {

        $from_date=$request->from_date;
        $to_date = $request->to_date;
        if ($from_date > $to_date) {
            return redirect()->back()->with('err_message', 'Tanggal Awal Tidak boleh lebih besar dari Tanggal Akhir!');
        }else{
            $nama_file = 'Report_Etalase_Apps'.date('Y-m-d_H-i-s').'.xlsx';
            return Excel::download(new DownloadExport($from_date,$to_date), $nama_file);
        }

    }
}
