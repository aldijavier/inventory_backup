<?php

namespace App\Http\Controllers;


use App\Exports\ExportProdukMasuk;
use App\Product;
use App\Product_Masuk;
use App\Supplier;
use PDF;
use DB;
use App\Location;
use App\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class ProductMasukController extends Controller
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
        
        $productsz = DB::table('list_categories')->pluck("name","id");

        $category = Category::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');

        // $products = Product::orderBy('nama','ASC')
        //     ->get()
        //     ->pluck('nama','id');
        
        $location = Location::orderBy('lokasi')
            ->get()
            ->pluck('lokasi', 'lokasi');

        $invoice_data = Product_Masuk::all();
        return view('product_masuk.index', compact('invoice_data', 'categoryz', 'location', 'productsz', 'category'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function download($uuid)
    {
        $book = Product_Masuk::where('id', $uuid)->firstOrFail();
        $pathToFile = public_path('attachment_po'. '/' . $book->po);
        return response()->download($pathToFile);
    }

    public function downloadDO($uuid)
    {
        $book = Product_Masuk::where('id', $uuid)->firstOrFail();
        $pathToFile = public_path('attachment_do'. '/' . $book->do);
        return response()->download($pathToFile);
    }

    public function getStates1($id) 
    {        
        $states = DB::table("products")->where("category_id",$id)->pluck("nama", "id");
        return json_encode($states);
    }

    public function detail($id)
    {
        $title = 'Detail Produk Masuk';
        $dt = Product_Masuk::find($id);
        $invoice_data = Product_Masuk::all();

        return view('product_masuk.detail', compact('title', 'dt', 'invoice_data'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'product_id'     => 'required',
            'supplier_id'    => 'required',
            'qty'            => 'required',
            'tanggal'        => 'required'
        ]);

        $product = Product_Masuk::create($request->all());

        $created_date=Carbon::now();    
        if($product){
            // use within single line code
            error_log('Some message here.');
            $id=$product->id;

            //upload file
            if($request->file('po')){
                $extension1 = $request->file('po')->getClientOriginalExtension();
                $doc_name1 = $id.'po.'.$extension1;
                $store1 = $request->file('po')->storeAs('attachment_po', $doc_name1);
            }
            else{
                $doc_name1="";
            }

            if($request->file('do')){
                $extension2 = $request->file('do')->getClientOriginalExtension();
                $doc_name2 =  $id.'do.'.$extension2;
                $store2 = $request->file('do')->storeAs('attachment_do', $doc_name2);
            }
            else{
                $doc_name2="";
            }
           
            $insert_filename=Product_Masuk::where('id',$id)
                ->update([
                'po' => $doc_name1,
                'do' => $doc_name2,
            ]);
            
            $period_ticket = $created_date->format('ymd');
            //no urut akhir
            $noticket="$id"."/"."FPB-NAP"."/"."$period_ticket";
            
            
            $create_form=Product_Masuk::where('id',$id)
                ->update([
                'nomor_form' => $noticket
            ]);

            // dd($create_form);

            $addNol = '';
            if (strlen($id) == 1) {
                $addNol = "000$id";
            } elseif (strlen($id) == 2) {
                $addNol = "00$id";
            } elseif (strlen($id == 3)) {
                $addNol = "0$id";
            }

            $no_asset = $created_date->format('Y');
            //no urut akhir
            $noticket1="122.100-"."$addNol"."/"."NAP"."/"."$no_asset";
            
            
            $create_form1=Product_Masuk::where('id',$id)
                ->update([
                'nomor_asset' => $noticket1
            ]);

        $product = Product::findOrFail($request->product_id);
        $product->qty += $request->qty;
        $product->save();

        return response()->json([
            'success'    => true,
            'message'    => 'Products In Created'
        ]);
    }
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
        $product_masuk = Product_Masuk::find($id);
        return $product_masuk;
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
        $this->validate($request, [
            'product_id'     => 'required',
            'supplier_id'    => 'required',
            'qty'            => 'required',
            'tanggal'        => 'required'
        ]);

        $product_masuk = Product_Masuk::findOrFail($id);
        $product_masuk->update($request->all());

        $product = Product::findOrFail($request->product_id);
        $product->qty += $request->qty;
        $product->update();

        return response()->json([
            'success'    => true,
            'message'    => 'Product In Updated'
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
        Product_Masuk::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Products In Deleted'
        ]);
    }



    public function apiProductsIn(){
        $product = Product_Masuk::all();

        return Datatables::of($product)
            ->addColumn('products_name', function ($product){
                return $product->product->nama;
            })
            ->addColumn('supplier_name', function ($product){
                return $product->supplier->nama;
            })
            ->addColumn('action', function($product){
                return '<a href="#" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a> ' .
                    '<a onclick="editForm('. $product->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $product->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';


            })
            ->rawColumns(['products_name','supplier_name','action'])->make(true);

    }

    public function exportProductMasukAll()
    {
        $product_masuk = Product_Masuk::all();
        $pdf = PDF::loadView('product_masuk.productMasukAllPDF',compact('product_masuk'));
        return $pdf->download('product_masuk.pdf');
    }

    public function exportProductMasuk($id)
    {
        $product_masuk = Product_Masuk::findOrFail($id);
        $pdf = PDF::loadView('product_masuk.productMasukPDF', compact('product_masuk'));
        return $pdf->download($product_masuk->id.'_product_masuk.pdf');
    }

    public function exportExcel()
    {
        return (new ExportProdukMasuk)->download('product_masuk.xlsx');
    }
}
