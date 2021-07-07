<?php

namespace App\Http\Controllers;

use App\Imports\HealthFacilityImport;
use App\Imports\SpoImport;
use App\Imports\UsersImport;
use Exception;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ExcelImportController extends Controller
{
    public function uploadCbo()
    {
        try {
            Excel::import(new UsersImport, 'cbosexcel.xlsx');
        } catch (Exception $exception) {
            return back()->withError('An error occured while parsing the file please check the file and try again')->withInput();
        }

        Session::flash('flash_message', 'Cbo parsed from excel file Added Successfully');
        return redirect('/cbo');
    }

    public function uploadSpo()
    {
        try {
            Excel::import(new SpoImport, 'SPOs.xlsx');
        } catch (Exception $exception) {
            return back()->withError('An error occured while parsing the file please check the file and try again')->withInput();
        }
        
        Session::flash('flash_message', 'Spo parsed from excel file Added Successfully');
        return redirect('/spo_add');

    }

    public function uploadHealthFacility()
    {

        try {
            Excel::import(new HealthFacilityImport, 'health_facilities.xlsx');
        } catch (Exception $exception) {
            return back()->withError('An error occured while parsing the file please check the file and try again')->withInput();
        }
        Session::flash('flash_message', 'Health facility parsed from excel file Added Successfully');
        return redirect('/healthfacilities');

    }
}
