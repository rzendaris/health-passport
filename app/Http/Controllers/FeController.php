<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Table\MstCountry;

class FeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function Register()
    {
        $country = MstCountry::all();
        $data = [
            'country' => $country
        ];
        return view('auth/register-page')->with($data);
    }
    public function Profile()
    {
        return view('auth/profile');
    }
    public function ProfilePassword()
    {
        return view('auth/profile-password');
    }
    public function EndUserManagement()
    {
        return view('end-user-management/index');
    }
    public function AddEndUser()
    {
        return view('end-user-management/add');
    }
    public function EditEndUser()
    {
        return view('end-user-management/edit');
    }
    public function DetailEndUser()
    {
        return view('end-user-management/detail');
    }

    public function DeveloperManagement()
    {
        return view('developer-management/index');
    }
    public function AddDeveloperManagement()
    {
        return view('developer-management/add');
    }
    public function EditDeveloperManagement()
    {
        return view('developer-management/edit');
    }
    public function DetailDeveloperManagement()
    {
        return view('developer-management/detail');
    }

    public function AppsManagement()
    {
        return view('apps-management/index');
    }
    public function AddAppsManagement()
    {
        return view('apps-management/add');
    }
    public function EditAppsManagement()
    {
        return view('apps-management/edit');
    }
    public function DetailAppsManagement()
    {
        return view('apps-management/detail');
    }
    public function ReviewInfo()
    {
        return view('apps-management/reviewinfo');
    }
    public function Approval()
    {
        return view('apps-management/approval');
    }
    public function PartnershipIndex()
    {
        return view('apps-management/index-partnership');
    }
    public function AddAppsPartnership()
    {
        return view('apps-management/add-apps-partnership');
    }
    public function EditAppsPartnership()
    {
        return view('apps-management/edit-apps-partnership');
    }

    public function IndexUserMan()
    {
        return view('user-man/index');
    }
    public function AddApp()
    {
        return view('apps-management/add-app');
    }
    public function UploadMedia()
    {
        return view('apps-management/upload-media');
    }
    public function UploadApp()
    {
        return view('apps-management/upload-app');
    }
    public function UploadExpansion()
    {
        return view('apps-management/upload-expansion');
    }

    public function Feedbacks()
    {
        return view('developer-feedbacks/index');
    }
    public function DevAdd()
    {
        return view('apps-developer/add-apps');
    }
    public function DevEdit()
    {
        return view('apps-developer/edit-apps');
    }
    public function DevDetail()
    {
        return view('apps-developer/detail');
    }
    
    public function AdsManagement()
    {
        return view('ads-management/index');   
    }
    public function Report()
    {
        return view('report/index');   
    }
}