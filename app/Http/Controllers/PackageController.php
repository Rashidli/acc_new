<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function group_payment(Request $request)
    {


        $selectedData = $request->selectedData;

        foreach ($selectedData as $data) {

            $values = explode(":", $data);

            $company = $values[0];
            $residualBasis = $values[1];
            $electInvoice = $values[2];

            $companyModel = Institution::where('title', $company)->first();

            $package = new Package();

            $package->title = $company;
            $package->voen = $companyModel->voen;
            $package->bank_account_number = $companyModel->bank_account_number;
            $package->bank_code = $companyModel->bank_code;
            $package->amount = $residualBasis;
            $package->elect_invoice = $electInvoice;

            $package->save();


        }
    }

    public function index()
    {
        $packages = Package::all();
        return view('package.index', compact('packages'));
    }

    public function destroy(Package $package)
    {

        $package->delete();

        return redirect()->back()->with('message', 'Paket silindi.');

    }
}
