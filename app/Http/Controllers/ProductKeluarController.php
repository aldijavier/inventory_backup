<?php

namespace App\Http\Controllers;

use App\Category;
use App\Customer;
use App\Exports\ExportProdukKeluar;
use App\Product;
use App\Product_Keluar;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use PDF;
use App\Departement;
use App\UserDemand;
use DB;
use Carbon\Carbon;
use App\Location;


class ProductKeluarController extends Controller
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
        
        $departements = DB::table('departements')->pluck("nama_departement","id");

        $departementspic = DB::table('user_demands')
            ->get()
            ->pluck('nama_karyawan','id');

        $deptpic = UserDemand::orderBy('nama_karyawan','ASC')
        ->get()
        ->pluck('nama_karyawan','id');

        $productawal = Product::orderBy('nama','ASC')
        ->get()
        ->pluck('nama','id');
        // $customers = Customer::orderBy('nama','ASC')
        //     ->get()
        //     ->pluck('nama','id');
        $productakhir = DB::table('products')
            ->get()
            ->pluck('nama','id');

        $invoice_data = Product_Keluar::all();
        return view('product_keluar.index', compact('invoice_data', 'categoryz', 'location', 'productsz', 'category', 'departements', 'departementspic', 'deptpic', 'productawal'));
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
        $book = Product_Keluar::where('id', $uuid)->firstOrFail();
        $pathToFile = public_path('spk'. '/' . $book->spk);
        return response()->download($pathToFile);
    }

    public function downloadDO($uuid)
    {
        $book = Product_Keluar::where('id', $uuid)->firstOrFail();
        $pathToFile = public_path('project_form'. '/' . $book->pform);
        return response()->download($pathToFile);
    }

    public function getStates2($id) 
    {        
        $states = DB::table("user_demands")->where("dept",$id)->pluck("nama_karyawan", "nama_karyawan");
        return json_encode($states);
    }

    public function detail($id)
    {
        $title = 'Detail Produk Masuk';
        $dt = Product_Keluar::find($id);
        $invoice_data = Product_Keluar::all();

        return view('product_keluar.detail', compact('title', 'dt', 'invoice_data'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
        //    'product_id'     => 'required',
        //    'customer_id'    => 'required',
        //    'qty'            => 'required',
        //    'tanggal'           => 'required'
        ]);

        // Product_Masuk::create($request->all());
        $product=Product_Keluar::create([
            'pic' => $request->pic,
            'jenis_kategori' => $request->jenis_kategori,
            'nama_kategori' => $request->nama_kategori,
            'product_id' => $request->product_id,
            'lokasi_pengambilan' => $request->lokasi_pengambilan,
            'tanggal_keluar' => $request->tanggal_keluar,
            'lokasi_pemasangan' => $request->lokasi_pemasangan,
            'departement' => $request->departement,
            'departement_pic' => $request->departement_pic,
            'qty' => $request->qty,
            'serial_number' => $request->serial_number,
            'remarks' => $request->remarks,
        ]);

        if($product){
            $created_date=Carbon::now(); 
        // use within single line code
            // error_log('Some message here.');
            $id=$product->id;

            //upload file
            if($request->file('spk')){
                $extension1 = $request->file('spk')->getClientOriginalExtension();
                $doc_name1 = $id.'spk.'.$extension1;
                $store1 = $request->file('spk')->storeAs('spk', $doc_name1);
            } else{
                $doc_name1="";
            }
                
            if($request->file('pform')){
                $extension2 = $request->file('pform')->getClientOriginalExtension();
                $doc_name2 =  $id.'pform.'.$extension2;
                $store2 = $request->file('pform')->storeAs('project_form', $doc_name2);
            }
            else{
                $doc_name2="";
            }
                
            $insert_filename=Product_Keluar::where('id',$id)
            ->update([
                'spk' => $doc_name1,
                'pform' => $doc_name2,
            ]);
                
            $period_ticket = $created_date->format('ymd');
            //no urut akhir
            $noticket="$id"."/"."FPB-NAP"."/"."$period_ticket";
            
            
            $create_form=Product_Keluar::where('id',$id)
            ->update([
                'nomor_form' => $noticket
            ]);
            
                
            // $product = Product_Keluar::create($request->all());
            $product = Product::findOrFail($request->product_id);
            if($product->qty >= $request->qty) {
                $product->qty -= $request->qty;
                $product->save();
                return response()->json([
                    'success'    => true,
                    'message'    => 'Products Out Created'
                ]);
            } else if($product->qty <= $request->qty){
                return redirect()->back()->withErrors($validator)->withInput();
            }
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
        $product_keluar = Product_Keluar::find($id);
        return $product_keluar;
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
            // 'product_id'     => 'required',
            // 'customer_id'    => 'required',
            // 'qty'            => 'required',
            // 'tanggal'           => 'required'
        ]);

        $product_keluar = Product_Keluar::findOrFail($id);
        $product = $product_keluar->update($request->all());

        $created_date=Carbon::now(); 
        if($product){
            // use within single line code
            error_log('Some message here.');
            $id=$product_keluar->id;

            //upload file
            if($request->file('spk')){
                $extension1 = $request->file('spk')->getClientOriginalExtension();
                $doc_name1 = $id.'spk.'.$extension1;
                $store1 = $request->file('spk')->storeAs('spk', $doc_name1);
            }
            else{
                $doc_name1="";
            }

            if($request->file('pform')){
                $extension2 = $request->file('pform')->getClientOriginalExtension();
                $doc_name2 =  $id.'pform.'.$extension2;
                $store2 = $request->file('pform')->storeAs('project_form', $doc_name2);
            }
            else{
                $doc_name2="";
            }
           
            $insert_filename=Product_Keluar::where('id',$id)
                ->update([
                'spk' => $doc_name1,
                'pform' => $doc_name2,
            ]);
            
            $period_ticket = $created_date->format('ymd');
            //no urut akhir
            $noticket="$id"."/"."FPB-NAP"."/"."$period_ticket";
            
            
            $create_form=Product_Keluar::where('id',$id)
                ->update([
                'nomor_form' => $noticket
            ]);

        $product = Product::findOrFail($request->product_id);
        $product->qty -= $request->qty;
        $product->update();

        return response()->json([
            'success'    => true,
            'message'    => 'Product Out Updated'
        ]);
    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product_Keluar::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Products Delete Deleted'
        ]);
    }



    public function apiProductsOut(){
        $product = Product_Keluar::all();
        $pic = UserDemand::all();

        return Datatables::of($product)
            ->addColumn('products_name', function ($product){
                return $product->product->nama;
            })
            // ->addColumn('dept_pic', function ($pic){
            //     return $pic->product->nama_karyawan;
            // })
            ->addColumn('action', function($product){
                return '<a href="/product_keluar/detail/'. $product->id .'" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a>' .
                    '<a onclick="editForm('. $product->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $product->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['products_name','action'])->make(true);

    }

    public function exportProductKeluarAll()
    {
        $product_keluar = Product_Keluar::all();
        $pdf = PDF::loadView('product_keluar.productKeluarAllPDF',compact('product_keluar'));
        return $pdf->download('product_keluar.pdf');
    }

    public function exportProductKeluar($id)
    {
        $product_keluar = Product_Keluar::findOrFail($id);
        $pdf = PDF::loadView('product_keluar.productKeluarPDF', compact('product_keluar'));
        return $pdf->download($product_keluar->id.'_product_keluar.pdf');
    }

    public function exportExcel()
    {
        return (new ExportProdukKeluar)->download('product_keluar.xlsx');
    }
}
