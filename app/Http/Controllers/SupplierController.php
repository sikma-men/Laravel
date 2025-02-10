<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard')->with(['success' => 'Login berhasil.', 'title' => 'Home']);
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }
    public function index()
    {
        $suppliers = Supplier::all();
        return response()->json($suppliers);
    }

    public function store(Request $request)
    {
        $supplier = Supplier::create($request->all());
        return response()->json(['message' => 'Supplier berhasil ditambahkan', 'data' => $supplier]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'description' => 'required|string',
            'company_name' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'zipcode' => 'required|string',
        ]);

        $supplier = new supplier();
        $supplier->first_name = $request->first_name;
        $supplier->last_name = $request->last_name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->description = $request->description;
        $supplier->company_name = $request->company_name;
        $supplier->city = $request->city;
        $supplier->state = $request->state;
        $supplier->country = $request->country;
        $supplier->zipcode = $request->zipcode;
        $supplier->save();

        return redirect()->route('table-supplier')->with('success', 'Location added successfully!');
    }

    public function table_supplier()
    {
        return view('account.table-supplier');
    }
    public function destroy($id)
    {
        try {
            $supplier = Supplier::findOrFail($id);
            $supplier->delete();
            return response()->json(['message' => 'Supplier berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
