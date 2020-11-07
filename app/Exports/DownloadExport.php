<?php

namespace App\Exports;

use App\Model\Table\DownloadApps;
use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Carbon\Carbon;

class DownloadExport implements FromView
{
      protected $from_date;
      protected $to_date;

      function __construct($from_date,$to_date) {
              $this->from_date = $from_date;
              $this->to_date = $to_date;
      }
    public function view(): View
    {
      if ($this->from_date == $this->to_date) {
        return view('report/export', [
            'datas' => DownloadApps::with(['endusers','apps'])->whereDate('created_at', '=', $this->from_date)->get()
        ]);
      }else{
        $to_date_parse = Carbon::createFromFormat('Y-m-d', $this->to_date);
        return view('report/export', [
            'datas' => DownloadApps::with(['endusers','apps'])->whereBetween('created_at',[ $this->from_date,$to_date_parse->addDays(1)])->get()
        ]);
      }

    }
}
