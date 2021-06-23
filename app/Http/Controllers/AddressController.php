<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\Helpers\Util;
use App\Http\Controllers\Helpers\Utils;
use App\Models\Address;
use App\Models\TypeUser;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    private $types = [
        TypeUser::ADMIN
    ];

    public function __construct()
    {
        $this->middleware(Util::buildRoles($this->types));
    }

    public function index()
    {
        //
    }
    
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public static function getAddress(Request $request)
    {
        try {
            return Address::where('state', 'like', '%'. $request->state .'%')
                ->where('city', 'like', '%'. $request->city .'%')
                ->where('neighborhood', 'like', '%'. $request->neighborhood .'%')
                ->get()->first();
        } catch (\Exception $e) {
            return $e->getMessage();
        }       
    }
}
