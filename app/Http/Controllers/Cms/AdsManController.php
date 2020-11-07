<?php

namespace App\Http\Controllers\Cms;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Model\Table\MstAds;
use App\Model\Table\MstCountry;

class AdsManController extends Controller
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
        //         return redirect('/')->with('access_message', 'Akses untuk Menu Ads Management Ditolak!');
        //     }
        //     return $next($request);
        // });

    }

    public function AdsMgmtInit(Request $request)
    {
        $paginate = 15;
        if (isset($request->query()['search'])){
            $search = $request->query()['search'];
            $ads = MstAds::where('name', 'like', "%" . $search. "%")->orderBy('orders', 'asc')->simplePaginate($paginate);
            $ads->appends(['search' => $search]);
        } else {
            $ads = MstAds::orderBy('orders', 'asc')->simplePaginate($paginate);
        }
        $count = count(MstAds::orderBy('orders', 'asc')->get())+2;
        $cek = MstAds::where('orders', '<=', $count)->orderBy('orders', 'asc')->get();
        $arry = MstAds::select('orders')->orderBy('orders', 'asc')->get();
        $result = array();
        foreach ($arry as $value => $res) {
          $result[$value] = $res->orders;
        }
        $count_range = range(1,$count);
        $orders = array_diff($count_range,$result);
        // print_r( $result);
        // print_r( $arr1);
        // print_r( $arr2);
        $no = 1;
        foreach($ads as $data){
            $data->no = $no;
            $no++;
        }
        $data = array(
          'count' => $count,
          'orders' => $orders,
          'ads' => $ads
        );

        return view('ads-management/index')->with('data', $data);

    }
    public function AdsMgmtInsert(Request $request)
    {

              if($request->photo){
                  $file_extention = $request->photo->getClientOriginalExtension();
                  $file_name = 'image_ads_'.$request->name.'_'.$request->id.'.'.$file_extention;
                  $fileSize = $request->photo->getSize();
                  $valid_extension = array("jpg","jpeg","png");
                  $maxFileSize = 2097152;
                  if(in_array(strtolower($file_extention),$valid_extension)){
                    // Check file size
                    if($fileSize <= $maxFileSize){
                      $file_path = $request->photo->move($this->MapPublicPath().'pictures',$file_name);
                    }else{
                      return redirect()->back()->with('err_message', 'File too large. File must be less than 2MB.');
                    }
                  }else{
                    return redirect()->back()->with('err_message', 'Invalid File Extension.');
                  }
              }else{
                $file_name="Photo not exists";
              }
              MstAds::create([
                  'name' => $request->name,
                  'link' => $request->link,
                  'orders' => $request->orders,
                  'picture' => $file_name,
                  'status' => 1,
                  'created_by' => Auth::user()->id,
                  // 'token' => Str::random(60),
              ]);
              return redirect('ads-management')->with('suc_message', 'Ads berhasil ditambahkan!');
          // } else {
          //     return redirect()->back()->with('err_message', 'Email telah digunakan! Gunakan alamat email yang belum terdaftar!');
          // }

    }

    public function AdsMgmtUpdate(Request $request)
    {
          $ads = MstAds::where('id', $request->id)->first();
          if(!empty($ads)){
            if($request->photo){
                $file_extention = $request->photo->getClientOriginalExtension();
                $file_name = 'image_ads_'.$request->name.'_'.$request->id.'.'.$file_extention;
                $fileSize = $request->photo->getSize();
                $valid_extension = array("jpg","jpeg","png");
                $maxFileSize = 2097152;
                if(in_array(strtolower($file_extention),$valid_extension)){
                  // Check file size
                  if($fileSize <= $maxFileSize){
                    $file_path = $request->photo->move($this->MapPublicPath().'pictures',$file_name);
                  }else{
                    return redirect()->back()->with('err_message', 'File too large. File must be less than 2MB.');
                  }
                }else{
                  return redirect()->back()->with('err_message', 'Invalid File Extension.');
                }
            }else{
              $file_name=$ads->picture;
            }
            MstAds::where('id', $request->id)
              ->update([
                'name' => $request->name,
                'link' => $request->link,
                'orders' => $request->orders,
                'picture' => $file_name,
                'status' => 1,
                'updated_by' => Auth::user()->id,
                  ]
                );
            return redirect('ads-management')->with('suc_message', 'Data telah diperbarui!');
          } else {
              return redirect()->back()->with('err_message', 'Data tidak ditemukan!');
          }
    }
    public function AdsMgmtDelete(Request $request)
    {
        $ads = MstAds::where('id', $request->id)->first();
        if(!empty($ads)){
            MstAds::where('id', $request->id)->delete();
            return redirect()->back()->with('suc_message', 'Data telah dihapus!');
        } else {
            return redirect()->back()->with('err_message', 'Data tidak ditemukan!');
        }
    }


}
