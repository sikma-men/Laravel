<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BuyerController extends Controller
{
    public function index()
    {
        $buyer = buyer::all();
        return response()->json($buyer);
    }

    public function table_buyer()
    {
        return view('account.tabel-buyer');
    }

    public function add_buyer()
    {
        return view('account.add-buyer');
    }

    public function store(Request $request)
    {
        $buyer = buyer::create($request->all());
        return response()->json(['message' => 'Supplier berhasil ditambahkan', 'data' => $buyer]);
    }

    public function getBuyers()
    {
        return response()->json(buyer::all());
    }

    public function addBuyerForm()
    {
        $title = "Add Buyer";
        return view('buyer.add-buyer', ['title' => $title]);
    }

    public function viewBuyers()
    {
        $title = "View Buyers";
        return view('buyer.view-buyers', ['title' => $title]);
    }

    public function edit($id)
    {
        $buyer = Buyer::find($id);

        if (!$buyer) {
            return redirect()->back()->with('error', 'Buyer not found.');
        }

        $title = "Edit Buyer";
        return view('buyer.edit-buyer', compact('buyer', 'title'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'description' => 'nullable|string',
            'company_name' => 'required|string|max:255',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'zipcode' => 'required|string|max:20'
        ]);

        $buyer = Buyer::findOrFail($id);
        $buyer->update($request->all());

        return redirect()->route('edit-buyer', $id)->with('success', 'Buyer updated successfully!');
    }

    public function destroy($id)
    {
        $buyer = Buyer::find($id);
        if ($buyer) {
            $buyer->delete();
            return response()->json(['message' => 'Buyer deleted successfully.']);
        }
        return response()->json(['error' => 'Buyer not found.'], 404);
    }
}
