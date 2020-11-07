<?php

namespace App\Http\Controllers\Cms;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Model\Table\Apps;
use App\Model\Table\Notifikasi;
use App\Model\Table\MstCategories;
use App\Model\Table\Ratings;
use App\Model\View\AvgRatings;
use App\Model\Table\MstSdk;
use App\Model\Table\MstCountry;

class AppsManController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role_id != 1){
                return redirect('/')->with('access_message', 'Akses untuk Menu User Management Ditolak!');
            }
            return $next($request);
        });

    }

    public function AppsManInit(Request $request)
    {
        $paginate = 15;
        if (isset($request->query()['search'])){
            $search = $request->query()['search'];
            $appsapprove = AvgRatings::with(['categories'])->where('name', 'like', "%" . $search. "%")->where('is_approve', 1)->orderBy('name', 'asc')->simplePaginate($paginate);
            $apps = AvgRatings::with(['categories'])->where('name', 'like', "%" . $search. "%")->orderBy('name', 'asc')->simplePaginate($paginate);
            $apps->appends(['search' => $search]);
            $appsapprove->appends(['search' => $search]);
        } else {
          $appsapprove = AvgRatings::with(['categories'])->where('is_approve', 1)->orderBy('name', 'asc')->simplePaginate($paginate);
          $apps = AvgRatings::with(['categories'])->orderBy('name', 'asc')->simplePaginate($paginate);
        }

        // $appsapprove = AvgRatings::with(['categories'])->where('is_approve', 1)->get();
        // $apps = AvgRatings::with(['categories'])->get();
        $no = 1;
        foreach($apps as $data){
            $data->no = $no;
            $no++;
        }
        $data = array(
            'appsapprove' => $appsapprove,
            'apps' => $apps,
        );
        return view('apps-management/index')->with('data', $data);
    }
    public function AppsManAdd()
    {
        $country = MstCountry::all();
        $data = [
            'country' => $country
        ];
        return view('apps-management/add')->with($data);
    }
    public function AppsManEdit($id)
    {
        $apps = AvgRatings::with(['categories'])->where('id', $id)->first();
        $category = MstCategories::all();
        $data = array(
            'apps' => $apps,
            'category' => $category
        );
        return view('apps-management/edit')->with('data', $data);
    }
    public function ApprovalApps($id)
    {
        $apps = AvgRatings::with(['categories'])->where('id', $id)->first();
        $category = MstCategories::all();
        $user = User::with(['countrys'])->where('id', $apps->developer_id)->first();
        $data = array(
            'user' => $user,
            'apps' => $apps,
            'category' => $category
        );
        return view('apps-management/approval')->with('data', $data);
    }
    public function AppsManDetailInfo($id)
    {
        $apps = AvgRatings::with(['categories','ratings'])->where('id', $id)->first();
        $user = User::with(['countrys'])->where('id', $apps->developer_id)->first();
        $data = array(
            'user' => $user,
            'apps' => $apps
        );
        return view('apps-management/detail')->with('data', $data);
    }

    public function AddApps()
    {
      $category = MstCategories::all();
      $dev = User::with(['countrys'])->where('role_id', 2)->get();
      $data = array(
          'category' => $category,
          'devid' => '',
          'dev' => $dev
      );
        return view('apps-management/add-app')->with('data', $data);
    }
    public function getDownload($id)
    {
        $apps = Apps::where('id', $id)->first();
        //PDF file is stored under project/public/download/info.pdf
        $this->CheckApkPackage($apps->apk_file);
        $file= $this->MapPublicPath(). "apk/".$apps->apk_file;

        $headers = array(
                  'Content-Type: application/apk',
                );
        return response()->download($file, $apps->apk_file, $headers);
    }

    public function getDownloadExpansion($id)
    {
        $apps = Apps::where('id', $id)->first();
        //PDF file is stored under project/public/download/info.pdf
        $this->CheckExpFile($apps->expansion_file);
        $file= $this->MapPublicPath(). "exp_file/".$apps->expansion_file;

        $headers = array(
                  'Content-Type: application/obb',
                );
        return response()->download($file, $apps->expansion_file, $headers);
    }

    public function CreateApps(Request $request)
    {
      $apps = Apps::where('id', $request->id)->first();
        if(empty($apps)){
          if($request->photo){
              $named = str_replace(" ","_",$request->name);
              $file_extention = $request->photo->getClientOriginalExtension();
              $file_name = 'app_icon_'.$named.'.'.$file_extention;
              $fileSize = $request->photo->getSize();
              $valid_extension = array("jpg","jpeg","png");
              $maxFileSize = 2097152;
              if(in_array(strtolower($file_extention),$valid_extension)){
                // Check file size
                if($fileSize <= $maxFileSize){
                  $file_path = $request->photo->move($this->MapPublicPath().'apps',$file_name);
                }else{
                  return redirect()->back()->with('err_message', 'File too large. File must be less than 2MB.');
                }
              }else{
                return redirect()->back()->with('err_message', 'Invalid File Extension.');
              }
          }else{
            $file_name="Photo not exists";
          }
          // if($request->apk_file){
          //     $file_extention = $request->apk_file->getClientOriginalExtension();
          //     $apk_name = $request->id.'.'.$file_extention;
          //     $file_path = $request->apk_file->move($this->MapPublicPath().'apk',$apk_name);
          //     // call function from Controller.php to get sdk package
          //     $cek_sdk = $this->CheckApkPackage($apk_name);
          //
          // }else{
          //   $apk_name="APK File not exists";
          //   $cek_sdk = $this->CheckApkPackage($apk_name);
          // }
          // if($request->exp_file){
          //     $file_extention = $request->exp_file->getClientOriginalExtension();
          //     $expfile_name = 'exp_file_'.$request->id.'.'.$file_extention;
          //     $file_path = $request->exp_file->move($this->MapPublicPath().'exp_file',$expfile_name);
          // }else{
          //   $expfile_name="Exp File not exists";
          // }
          $created =  Apps::create([
                  'name' => $request->name,
                  'type' => $request->type,
                  'app_icon' => $file_name,
                  // 'eu_sdk_version' => $cek_sdk['min_sdk_level'],
                  // 'package_name' => $cek_sdk['package_name'],
                  'category_id' => $request->category,
                  'rate' => $request->rate,
                  // 'version' => $cek_sdk['version_name'],
                  // 'file_size' => '',
                  // 'apk_file' => $apk_name,
                  // 'expansion_file' => $expfile_name,
                  'description' => $request->description,
                  'updates_description' => $request->updates_description,
                  'developer_id'=>$request->developer,
                  'is_active'=>1,
                  'is_approve'=>1,
                  // 'is_partnership'=>1,
                  'created_at' => date('Y-m-d H:i:s'),
                  'created_by' => Auth::user()->email
                  ]
                );
            // $apps = Apps::where('id', $request->id)->first();
            // if(!empty($apps)){
              return redirect('upload-media/'.$created->id)->with('suc_message', 'Apps telah ditambahkan!');
            // }
        } else {
          return redirect()->back()->with('err_message', 'Apps Gagal ditambahkan!');
        }
    }
    public function UploadMedia($id)
    {
        $apps = Apps::with(['categories','ratings'])->where('id', $id)->first();
        $data = array(
            'apps' => $apps,
        );
        return view('apps-management/upload-media')->with('data', $data);
    }
    public function EditMedia($id)
    {
        $apps = Apps::with(['categories','ratings'])->where('id', $id)->first();
        $data = array(
            'apps' => $apps,
        );
        return view('apps-management/edited-media')->with('data', $data);
    }
    public function UploadApp($id)
    {
        $apps = Apps::with(['categories','ratings'])->where('id', $id)->first();
        $data = array(
            'apps' => $apps,
        );
        return view('apps-management/upload-app')->with('data', $data);
    }
    public function EditApp($id)
    {
        $apps = Apps::with(['categories','ratings'])->where('id', $id)->first();
        $data = array(
            'apps' => $apps,
        );
        return view('apps-management/edited-app')->with('data', $data);
    }
    public function UploadExpansion($id)
    {
        $apps = Apps::with(['categories','ratings'])->where('id', $id)->first();
        $data = array(
            'apps' => $apps,
        );
        return view('apps-management/upload-expansion')->with('data', $data);
    }
    public function EditExpansion($id)
    {
        $apps = Apps::with(['categories','ratings'])->where('id', $id)->first();
        $data = array(
            'apps' => $apps,
        );
        return view('apps-management/edited-expansion')->with('data', $data);
    }
    public function CreateMedia(Request $request)
    {
      $apps = Apps::where('id', $request->id)->first();
      if(!empty($apps)){
        // $SumSize = array_sum(array($request->file('filename')));
        $SumSize=0;
        $maxFileSize = 10097152;
        foreach ($request->file('filename') as $img) {
          $SumSize = $SumSize+$img->getSize();
        }
        echo $SumSize;
        $no=0;
        if($SumSize <= $maxFileSize){
            foreach ($request->file('filename') as $image) {
              $no++;
              $file_extention = $image->getClientOriginalExtension();
              $name='media_'.$request->id.'_'.$no.'.'.$file_extention;
              $valid_extension = array("jpg","jpeg","png","mp4","mkv");
              if(in_array(strtolower($file_extention),$valid_extension)){
                  $image->move($this->MapPublicPath().'media',$name);
              }else{
                return redirect()->back()->with('err_message', 'Invalid File Extension.');
              }
              $data["media".$no] = $name;
            }
        }else{
          return redirect()->back()->with('err_message', 'File too large. File must be less than 10MB.');
        }
        $updated = Apps::where('id', $request->id)->update([
              'media' => json_encode($data),
              'updated_at' => date('Y-m-d H:i:s'),
              'updated_by' => Auth::user()->email
              ]
            );
            return redirect('upload-app/'.$apps->id)->with('suc_message', 'Apps Media telah diperbarui!');
      }else{
        return redirect()->back()->with('err_message', 'Apps Gagal ditambahkan!');

      }
      // echo json_encode($data);
      // echo $SumSize;
    }
    public function UpdateMedia(Request $request)
    {
      $apps = Apps::where('id', $request->id)->first();
      if(!empty($apps)){
        // $SumSize = array_sum(array($request->file('filename')));
        $SumSize=0;
        $maxFileSize = 10097152;
        foreach ($request->file('filename') as $img) {
          $SumSize = $SumSize+$img->getSize();
        }
        echo $SumSize;
        $no=0;
        if($SumSize <= $maxFileSize){
            foreach ($request->file('filename') as $image) {
              $no++;
              $file_extention = $image->getClientOriginalExtension();
              $name='media_'.$request->id.'_'.$no.'.'.$file_extention;
              $valid_extension = array("jpg","jpeg","png","mp4","mkv");
              if(in_array(strtolower($file_extention),$valid_extension)){
                  $image->move($this->MapPublicPath().'media',$name);
              }else{
                return redirect()->back()->with('err_message', 'Invalid File Extension.');
              }
              $data["media".$no] = $name;
            }
        }else{
          return redirect()->back()->with('err_message', 'File too large. File must be less than 10MB.'.$SumSize);
        }
        Apps::where('id', $request->id)->update([
              'media' => json_encode($data),
              'updated_at' => date('Y-m-d H:i:s'),
              'updated_by' => Auth::user()->email
              ]
            );
            return redirect('apps-management')->with('suc_message', 'Apps Media telah diperbarui!');
      }else{
        return redirect()->back()->with('err_message', 'Apps Gagal ditambahkan!');

      }
      // echo json_encode($data);
      // echo $SumSize;
    }
    public function CreatedApp(Request $request) // not used right now
    {
        $apps = Apps::where('id', $request->id)->first();
        if(!empty($apps)){

          if($request->apk_file){
              $file_extention = $request->apk_file->getClientOriginalExtension();
              $apk_name = 'apps_'.$request->id.'.'.$file_extention;
              $fileSize = $request->apk_file->getSize();
              $valid_extension = array("apk");
              $maxFileSize = 100097152;
              if(in_array(strtolower($file_extention),$valid_extension)){
                // Check file size
                if($fileSize <= $maxFileSize){
                  $file_path = $request->apk_file->move($this->MapPublicPath().'apk',$apk_name);
                  $cek_sdk = $this->CheckApkPackage($apk_name);
                  if ($cek_sdk['version_code'] <= $apps->version) {
                     return redirect()->back()->with('err_message', 'Apps Gagal ditambahkan, Mohon Update Version Apps Lebih Tinggi!');
                  }
                }else{
                  return redirect()->back()->with('err_message', 'File too large. File must be less than 100MB.');
                }
              }else{
                return redirect()->back()->with('err_message', 'Invalid File Extension.');
              }
              // call function from Controller.php to get sdk package

          }else{
            $apk_name="APK File not exists";
            $cek_sdk = $this->CheckApkPackage($apps->apk_file);
          }

            Apps::where('id', $request->id)->update([
                  'eu_sdk_version' => $cek_sdk['min_sdk_level'],
                  'package_name' => $cek_sdk['package_name'],
                  'file_size' => $fileSize,
                  'apk_file' => $apk_name,
                  'version' => $cek_sdk['version_code'],
                  'updated_at' => date('Y-m-d H:i:s'),
                  'updated_by' => Auth::user()->email
                  ]
                );

            return redirect('upload-expansion/'.$apps->id)->with('suc_message', 'Apps telah diperbarui!');
        } else {
          return redirect()->back()->with('err_message', 'Apps Gagal ditambahkan!');
        }
    }
    public function UpdateApp(Request $request) // not used right now
    {
        $apps = Apps::where('id', $request->id)->first();
        if(!empty($apps)){

          if($request->apk_file){
              $file_extention = $request->apk_file->getClientOriginalExtension();
              $apk_name = 'apps_'.$request->id.'.'.$file_extention;
              $fileSize = $request->apk_file->getSize();
              $valid_extension = array("apk");
              $maxFileSize = 100097152;
              if(in_array(strtolower($file_extention),$valid_extension)){
                // Check file size
                if($fileSize <= $maxFileSize){
                  $file_path = $request->apk_file->move($this->MapPublicPath().'apk',$apk_name);
                  $cek_sdk = $this->CheckApkPackage($apk_name);
                  if ($cek_sdk['version_code'] <= $apps->version) {
                     return redirect()->back()->with('err_message', 'Apps Gagal ditambahkan, Mohon Update Version Apps Lebih Tinggi!');
                  }
                }else{
                  return redirect()->back()->with('err_message', 'File too large. File must be less than 100MB.');
                }
              }else{
                return redirect()->back()->with('err_message', 'Invalid File Extension.');
              }
              // call function from Controller.php to get sdk package

          }else{
            $apk_name="APK File not exists";
            $cek_sdk = $this->CheckApkPackage($apps->apk_file);
          }

            Apps::where('id', $request->id)->update([
                  'eu_sdk_version' => $cek_sdk['min_sdk_level'],
                  'package_name' => $cek_sdk['package_name'],
                  'file_size' => $fileSize,
                  'apk_file' => $apk_name,
                  'version' => $cek_sdk['version_code'],
                  'updated_at' => date('Y-m-d H:i:s'),
                  'updated_by' => Auth::user()->email
                  ]
                );
            if($request->submit_button == "save"){
              return redirect('apps-management')->with('suc_message', 'Apps telah diperbarui!');
            } else {
              return redirect('edit-expansion/'.$apps->id)->with('suc_message', 'Apps telah diperbarui!');
            }
        } else {
          return redirect()->back()->with('err_message', 'Apps Gagal ditambahkan!');
        }
    }
    public function UpdateExpansion(Request $request) // not used right now
    {
        $apps = Apps::where('id', $request->id)->first();
        if(!empty($apps)){

          if($request->exp_file){
              $file_extention = $request->exp_file->getClientOriginalExtension();
              $expfile_name = 'exp_file_apps'.$request->id.'.'.$file_extention;
              $fileSize = $request->exp_file->getSize();
              $valid_extension = array("obb");
              $maxFileSize = 100097152;
              if(in_array(strtolower($file_extention),$valid_extension)){
                // Check file size
                if($fileSize <= $maxFileSize){
                  $file_path = $request->exp_file->move($this->MapPublicPath().'exp_file',$expfile_name);

                }else{
                  return redirect()->back()->with('err_message', 'File too large. File must be less than 100MB.');
                }
              }else{
                return redirect()->back()->with('err_message', 'Invalid File Extension.');
              }
              // call function from Controller.php to get sdk package

          }else{
            $expfile_name="APK File not exists";
          }

            Apps::where('id', $request->id)->update([
                  'expansion_file' => $expfile_name,
                  'updated_at' => date('Y-m-d H:i:s'),
                  'updated_by' => Auth::user()->email
                  ]
                );

            return redirect('apps-management')->with('suc_message', 'Apps telah diperbarui!');
        } else {
          return redirect()->back()->with('err_message', 'Apps Gagal ditambahkan!');
        }
    }
    // public function AppsManInsert(Request $request) // not used right now
    // {
    //   $apps = Apps::where('id', $request->id)->first();
    //     if(!empty($apps)){
    //       if($request->photo){
    //           $file_extention = $request->photo->getClientOriginalExtension();
    //           $file_name = 'app_icon_'.$request->id.'.'.$file_extention;
    //           $file_path = $request->photo->move($this->MapPublicPath().'apps',$file_name);
    //       }else{
    //         $file_name=$apps->app_icon;
    //       }
    //       if($request->apk_file){
    //           $file_extention = $request->apk_file->getClientOriginalExtension();
    //           $apk_name = $request->id.'.'.$file_extention;
    //           $file_path = $request->photo->move($this->MapPublicPath().'apk',$apk_name);
    //       }else{
    //         $apk_name=$apps->app_icon;
    //       }
    //       if($request->exp_file){
    //           $file_extention = $request->exp_file->getClientOriginalExtension();
    //           $expfile_name = 'exp_file_apps'.$request->id.'.'.$file_extention;
    //           $file_path = $request->photo->move($this->MapPublicPath().'exp_file',$expfile_name);
    //       }else{
    //         $expfile_name=$apps->app_icon;
    //       }
    //         Apps::create([
    //             'name' => $request->name,
    //             'type' => $request->type,
    //             'app_icon' => $file_name,
    //             'eu_sdk_version' => $request->sdk,
    //             'category_id' => $request->category,
    //             'rate' => $request->rate,
    //             'version' => $request->version,
    //               'file_size' => '',
    //               'apk_file' => $apk_name,
    //               'expansion_file' => $expfile_name,
    //               'description' => $request->description,
    //               'updates_description' => $request->updates_description,
    //               'developer_id'=>33,
    //               'is_partnership'=>1,
    //               'created_at' => date('Y-m-d H:i:s'),
    //               'created_by' => Auth::user()->email
    //               ]
    //             );
    //
    //         return redirect('apps-management')->with('suc_message', 'Apps telah diperbarui!');
    //     } else {
    //       return redirect()->back()->with('err_message', 'Email telah digunakan! Gunakan alamat email yang belum terdaftar!');
    //     }
    // }
    public function AppsManUpdate(Request $request)
    {
        $apps = Apps::where('id', $request->id)->first();
        if(!empty($apps)){
          if($request->photo){
              $file_extention = $request->photo->getClientOriginalExtension();
              $file_name = 'app_icon_'.$request->id.'.'.$file_extention;
              $fileSize = $request->photo->getSize();
              $valid_extension = array("jpg","jpeg","png");
              $maxFileSize = 2097152;
              if(in_array(strtolower($file_extention),$valid_extension)){
                // Check file size
                if($fileSize <= $maxFileSize){
                  $file_path = $request->photo->move($this->MapPublicPath().'apps',$file_name);
                }else{
                  return redirect()->back()->with('err_message', 'File too large. File must be less than 2MB.');
                }
              }else{
                return redirect()->back()->with('err_message', 'Invalid File Extension.');
              }
          }else{
            $file_name=$apps->app_icon;
          }
            Apps::where('id', $request->id)
              ->update([
                  'name' => $request->name,
                  'type' => $request->type,
                  'app_icon' => $file_name,
                  'category_id' => $request->category,
                  'rate' => $request->rate,
                  'file_size' => $request->file_size,
                  'description' => $request->description,
                  'updates_description' => $request->updates_description,
                  'link' => $request->link,
                  'updated_at' => date('Y-m-d H:i:s'),
                  'updated_by' => Auth::user()->email
                  ]
                );

            return redirect('apps-management')->with('suc_message', 'Apps telah diperbarui!');
        } else {
            return redirect()->back()->with('err_message', 'Apps tidak ditemukan!');
        }
    }
    public function AppsManBlock(Request $request)
    {
        $apps = Apps::where('id', $request->id)->first();
        if(!empty($apps)){
            Apps::where('id', $request->id)
              ->update([
                    'is_active' => 0,
                  ]
                );

            return redirect()->back()->with('suc_message', 'Apps telah diblock!');
        } else {
            return redirect()->back()->with('err_message', 'Apps tidak ditemukan!');
        }
    }
    public function AppsManUnBlock(Request $request)
    {
        $apps = Apps::where('id', $request->id)->first();
        if(!empty($apps)){
            Apps::where('id', $request->id)
              ->update([
                    'is_active' => 1,
                  ]
                );

            return redirect()->back()->with('suc_message', 'Apps telah diunblock!');
        } else {
            return redirect()->back()->with('err_message', 'Apps tidak ditemukan!');
        }
    }
    public function Approved(Request $request)
    {
        $apps = Apps::where('id', $request->id)->first();
        if(!empty($apps)){
            Apps::where('id', $request->id)
              ->update([
                    'is_approve' => 1,
                  ]
                );
                $created = Notifikasi::create([
                    'to_users_id' => $apps->developer_id,
                    'from_users_id' => Auth::user()->id,
                    'content' => $apps->name." Approved oleh ".Auth::user()->email,
                    'apps_id' => $request->id,
                    // 'token' => Str::random(60),
                ]);

            return redirect('apps-management')->with('suc_message', 'Apps Approved !');
        } else {
            return redirect()->back()->with('err_message', 'Apps tidak ditemukan!');
        }
    }
    public function Rejected(Request $request)
    {
        $apps = Apps::where('id', $request->id)->first();
        if(!empty($apps)){
            Apps::where('id', $request->id)
              ->update([
                    'is_approve' => 2,
                    'reject_reason' => $request->reaseon
                  ]
                );
            $created = Notifikasi::create([
                'to_users_id' => $apps->developer_id,
                'from_users_id' => Auth::user()->id,
                'content' => $apps->name." Rejected oleh ".Auth::user()->email,
                'apps_id' => $request->id,
                // 'token' => Str::random(60),
            ]);

            return redirect('apps-management')->with('suc_message', 'Apps Rejected!');
        } else {
            return redirect()->back()->with('err_message', 'Apps tidak ditemukan!');
        }
    }
    public function AppsManDelete(Request $request)
    {
        $apps = Apps::where('id', $request->id)->first();
        if(!empty($apps)){
            Apps::where('id', $request->id)->delete();
            $created = Notifikasi::create([
                'to_users_id' => $apps->developer_id,
                'from_users_id' => Auth::user()->id,
                'content' => $apps->name." Deleted oleh ".Auth::user()->email,
                // 'token' => Str::random(60),
            ]);
            return redirect()->back()->with('suc_message', 'Apps telah dihapus!');
        } else {
            return redirect()->back()->with('err_message', 'Apps tidak ditemukan!');
        }
    }


    public function PartnershipIndex()
    {
        $apps = Apps::with(['categories','ratings'])->where('is_partnership', 1)->get();
        $no = 1;
        foreach($apps as $data){
            $data->no = $no;
            $no++;
        }
        $data = array(
            'apps' => $apps,
        );
        return view('apps-management/index-partnership')->with('data', $data);
    }
    public function AddAppsPartnership() // not used
    {
      $category = MstCategories::all();
      $dev = User::with(['countrys'])->where('role_id', 2)->get();
      $data = array(
          'category' => $category,
          'dev' => $dev
      );
        return view('apps-management/add-apps-partnership')->with('data', $data);
    }

    public function CreateAppsPartnership(Request $request) //not used
    {
      $apps = Apps::where('id', $request->id)->first();
        if(empty($apps)){
          if($request->photo){
              $file_extention = $request->photo->getClientOriginalExtension();
              $file_name = 'app_icon_'.$request->id.'.'.$file_extention;
              $file_path = $request->photo->move($this->MapPublicPath().'apps',$file_name);
          }else{
            $file_name="Photo not exists";
          }
          if($request->apk_file){
              $file_extention = $request->apk_file->getClientOriginalExtension();
              $apk_name = $request->id.'.'.$file_extention;
              $file_path = $request->apk_file->move($this->MapPublicPath().'apk',$apk_name);
              // call function from Controller.php to get sdk package
              $cek_sdk = $this->CheckApkPackage($apk_name);

          }else{
            $apk_name="APK File not exists";
            $cek_sdk = $this->CheckApkPackage($apk_name);
          }
          if($request->exp_file){
              $file_extention = $request->exp_file->getClientOriginalExtension();
              $expfile_name = 'exp_file_'.$request->id.'.'.$file_extention;
              $file_path = $request->exp_file->move($this->MapPublicPath().'exp_file',$expfile_name);
          }else{
            $expfile_name="Exp File not exists";
          }
            Apps::create([
                  'name' => $request->name,
                  'type' => $request->type,
                  'app_icon' => $file_name,
                  'eu_sdk_version' => $cek_sdk['min_sdk_level'],
                  'package_name' => $cek_sdk['package_name'],
                  'category_id' => $request->category,
                  'rate' => $request->rate,
                  'version' => $cek_sdk['version_code'],
                  'file_size' => '',
                  'apk_file' => $apk_name,
                  'expansion_file' => $expfile_name,
                  'description' => $request->description,
                  'updates_description' => $request->updates_description,
                  'developer_id'=>$request->developer,
                  'is_active'=>1,
                  'is_approve'=>0,
                  'is_partnership'=>1,
                  'created_at' => date('Y-m-d H:i:s'),
                  'created_by' => Auth::user()->email
                  ]
                );

            return redirect('apps-management')->with('suc_message', 'Apps telah ditambahkan!');
        } else {
          return redirect()->back()->with('err_message', 'Apps Gagal ditambahkan!');
        }
    }
    public function EditAppsPartnership($id)
    {
      $apps = Apps::with(['categories','ratings'])->where('id', $id)->first();
      $category = MstCategories::all();
      $dev = User::with(['countrys'])->where('role_id', 2)->get();
      $data = array(
          'apps' => $apps,
          'category' => $category,
          'dev' => $dev
      );
        return view('apps-management/edit-apps-partnership')->with('data', $data);
    }
    public function UpdateAppsPartnership(Request $request)
    {
      $apps = Apps::where('id', $request->id)->first();
        if(!empty($apps)){
          if($request->photo){
              $file_extention = $request->photo->getClientOriginalExtension();
              $file_name = 'app_icon_'.$request->id.'.'.$file_extention;
              $file_path = $request->photo->move($this->MapPublicPath().'apps',$file_name);
          }else{
            $file_name=$apps->app_icon;
          }
          if($request->apk_file){
              $file_extention = $request->apk_file->getClientOriginalExtension();
              $apk_name = $request->id.'.'.$file_extention;
              $file_path = $request->apk_file->move($this->MapPublicPath().'apk',$apk_name);
              // call function from Controller.php to get sdk package
              // $cek_sdk['package_name'].//com.example.rezkyflutter
              // $cek_sdk['version_name'].//1.0.0
              // $cek_sdk['version_code'].//1
              // $cek_sdk['min_sdk_level'].//16
              // $cek_sdk['min_sdk_platform']//Android 4.1,4.1.1
              $cek_sdk = $this->CheckApkPackage($apk_name);
              $package_name = $cek_sdk['package_name'];
              $sdk_version = $cek_sdk['min_sdk_level'];
              $version = $cek_sdk['version_code'];
              if ($cek_sdk['version_code'] <= $request->version) {
                 return redirect()->back()->with('err_message', 'Apps Gagal ditambahkan, Mohon Update Version Apps Lebih Tinggi!');
              }
          }else{
            $apk_name=$apps->apk_file;
            $package_name = $apps->package_name;
            $sdk_version = $apps->eu_sdk_version;
            $version = $apps->version;
          }
          if($request->exp_file){
              $file_extention = $request->exp_file->getClientOriginalExtension();
              $expfile_name = 'exp_file_'.$request->id.'.'.$file_extention;
              $file_path = $request->exp_file->move($this->MapPublicPath().'exp_file',$expfile_name);
          }else{
            $expfile_name=$apps->expansion_file;
          }
            Apps::where('id', $request->id)->update([
                  'name' => $request->name,
                  'type' => $request->type,
                  'app_icon' => $file_name,
                  'eu_sdk_version' => $sdk_version,
                  'package_name' => $package_name,
                  'category_id' => $request->category,
                  'rate' => $request->rate,
                  'version' => $version,
                  'file_size' => '',
                  'apk_file' => $apk_name,
                  'expansion_file' => $expfile_name,
                  'description' => $request->description,
                  'updates_description' => $request->updates_description,
                  'developer_id'=>$request->developer,
                  'updated_at' => date('Y-m-d H:i:s'),
                  'updated_by' => Auth::user()->email
                  ]
                );

            return redirect('apps-management')->with('suc_message', 'Apps telah ditambahkan!');
        } else {
          return redirect()->back()->with('err_message', 'Apps Gagal ditambahkan!');
        }
    }
}
