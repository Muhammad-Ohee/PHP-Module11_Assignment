<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function createForm()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        DB::table('products')->insert([
            'name' => $request->input('name'),
            'quantity' => $request->input('quantity'),
            'price' => $request->input('price'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/dashboard')->with('success', 'Product added successfully!');
    }

    // public function sell(Request $request, $id)
    // {
    //     $request->validate([
    //         'quantity' => 'required|integer',
    //     ]);

    //     $product = DB::table('products')->find($id);

    //     if (!$product) {
    //         return redirect('/dashboard')->with('error', 'Product not found!');
    //     }

    //     if ($product->quantity < $request->input('quantity')) {
    //         return redirect('/dashboard')->with('error', 'Not enough quantity in stock!');
    //     }

    //     DB::table('products')->where('id', $id)->decrement('quantity', $request->input('quantity'));

    //     return redirect('/dashboard')->with('success', 'Product sold successfully!');
    // }

    // public function changePrice($id, $price)
    // {
    //     $product = DB::table('products')->find($id);

    //     if (!$product) {
    //         return redirect('/dashboard')->with('error', 'Product not found!');
    //     }

    //     DB::table('products')->where('id', $id)->update(['price' => $price]);

    //     return redirect('/dashboard')->with('success', 'Product price changed successfully!');
    // }

    public function dashboard()
    {
        $todaySales = $this->getSalesForDate(now());
        $yesterdaySales = $this->getSalesForDate(now()->subDay());
        $thisMonthSales = $this->getSalesForDateRange(now()->startOfMonth(), now());
        $lastMonthSales = $this->getSalesForDateRange(now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth());

        return view('dashboard', compact('todaySales', 'yesterdaySales', 'thisMonthSales', 'lastMonthSales'));
    }

    public function transactions()
    {
        $transactions = DB::table('products')->orderBy('created_at', 'desc')->paginate(4);

        return view('transactions', compact('transactions'));
    }

    private function getSalesForDate($date)
    {
        return DB::table('products')->whereDate('created_at', $date)->sum('price');
    }

    private function getSalesForDateRange($startDate, $endDate)
    {
        return DB::table('products')->whereBetween('created_at', [$startDate, $endDate])->sum('price');
    }









    public function sellForm($id)
    {
        $product = DB::table('products')->find($id);

        if (!$product) {
            return redirect('/dashboard')->with('error', 'Product not found!');
        }

        return view('sell', compact('product'));
    }

    public function sell(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer',
        ]);

        $product = DB::table('products')->find($id);

        if (!$product) {
            return redirect('/dashboard')->with('error', 'Product not found!');
        }

        if ($product->quantity < $request->input('quantity')) {
            return redirect('/dashboard')->with('error', 'Not enough quantity in stock!');
        }

        // Perform the sale transaction
        DB::transaction(function () use ($id, $request, $product) {
        // Update product quantity
        DB::table('products')->where('id', $id)->decrement('quantity', $request->input('quantity'));

        // Insert into sale_transactions table
        DB::table('sale_transactions')->insert([
            'product_name' => $product->name,
            'quantity_sold' => $request->input('quantity'),
            'total_amount' => $product->price * $request->input('quantity'),
            'transaction_date' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        });

        return redirect('/dashboard')->with('success', 'Product sold successfully!');
    }

    public function changePriceForm($id)
    {
        $product = DB::table('products')->find($id);

        if (!$product) {
            return redirect('/dashboard')->with('error', 'Product not found!');
        }

        return view('change_price', compact('product'));
    }

    public function changePrice(Request $request, $id)
    {
        $request->validate([
            'price' => 'required|numeric',
        ]);

        DB::table('products')->where('id', $id)->update(['price' => $request->input('price')]);

        return redirect('/dashboard')->with('success', 'Product price changed successfully!');
    }


    public function salesHistory()
    {
        $sales = DB::table('sale_transactions')->get();

        return view('sales_history', compact('sales'));
    }

}
