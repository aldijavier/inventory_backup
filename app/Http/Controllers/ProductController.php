<?php

namespace App\Http\Controllers;

use App\Category;
use App\Exports\ExportProduct;
use App\Product;
use DB;
use PDF;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Excel;
use App\Imports\ProductsImport;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin,staff');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryz = DB::table('categories')
            ->get()
            ->pluck('name','id');
        
        $products = DB::table('list_categories')->pluck("name","id");

        $category = Category::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');

        $producs = Product::all();
        return view('products.index', compact('category', 'products', 'categoryz'));
    }

    public function getStates($id) 
    {        
        $states = DB::table("categories")->where("category",$id)->pluck("name", "name");
        return json_encode($states);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function ImportExcel(Request $request)
    {
        //Validasi
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        if ($request->hasFile('file')) {
            //UPLOAD FILE
            $file = $request->file('file'); //GET FILE
            Excel::import(new ProductsImport, $file); //IMPORT FILE
            return redirect()->back()->with(['success' => 'Upload file data Products !']);
        }

        return redirect()->back()->with(['error' => 'Please choose file before!']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Category::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');

        $this->validate($request , [
            'nama'          => 'required|string',
            'category_id'   => 'required',
        ]);

        $input = $request->all();
        $input['image'] = null;

        if ($request->hasFile('image')){
            $input['image'] = '/upload/products/'.str_slug($input['nama'], '-').'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('/upload/products/'), $input['image']);
        }

        Product::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Products Created'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');
        $product = Product::find($id);
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');

        $this->validate($request , [
            'nama'          => 'required|string',
            // 'harga'         => 'required',

//            'image'         => 'required',
            'category_id'   => 'required',
        ]);

        $input = $request->all();
        $produk = Product::findOrFail($id);

        $input['image'] = $produk->image;

        if ($request->hasFile('image')){
            if (!$produk->image == NULL){
                unlink(public_path($produk->image));
            }
            $input['image'] = '/upload/products/'.str_slug($input['nama'], '-').'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('/upload/products/'), $input['image']);
        }

        $produk->update($input);

        return response()->json([
            'success' => true,
            'message' => 'Products Update'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if (!$product->image == NULL){
            unlink(public_path($product->image));
        }

        Product::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'Products Deleted'
        ]);
    }

    public function apiProducts(){
        $product = Product::all();

        return Datatables::of($product)
            // ->addColumn('category_name', function ($product){
            //     return $product->category->name;
            // })
            // ->addColumn('show_photo', function($product){
            //     if ($product->image == NULL){
            //         return 'No Image';
            //     }
            //     return '<img class="rounded-square" width="50" height="50" src="'. url($product->image) .'" alt="">';
            // })
            ->addColumn('action', function($product){
                return
                    '<a onclick="editForm('. $product->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $product->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['action'])->make(true);

    }

    public function exportProductAll()
    {
        $productsAll = Product::all();
        // $productsz = ListCategory::all();
        $pdf = PDF::loadView('products.productAllPDF',compact('productsAll'));
        return $pdf->download('Products.pdf');
    }

    public function exportProduct($id)
    {
        $productsAll = Product::findOrFail($id);
        $productsz = ListCategory::all();
        $pdf = PDF::loadView('productsAll.productPDF', compact('productsAll', 'productsz'));
        return $pdf->download($productsAll->id.'_productsAll.pdf');
    }

    public function exportExcel()
    {
        return (new ExportProduct)->download('product.xlsx');
    }
}
