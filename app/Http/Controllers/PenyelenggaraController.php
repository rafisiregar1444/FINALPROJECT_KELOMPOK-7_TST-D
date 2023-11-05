<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\YayasanPT;
use Datatables;

class PenyelenggaraController extends Controller
{
    public function index(){
        if(request()->ajax()) {
	        return datatables()->of(YayasanPT::select('*'))
	        ->addColumn('action', 'penyelenggara.action')
	        ->rawColumns(['action'])
	        ->addIndexColumn()
	        ->make(true);
	    }
	    return view('penyelenggara.yayasan');
    }

    public function create(){
        return view('penyelenggara.create');
    }

    public function list(){
        $data = DB::table('tbl_yayasan_pts')
            ->join('tbl_perguruan_tinggi', 'tbl_perguruan_tinggi.id_bp_pts', '=', 'tbl_yayasan_pts.id_yys_pt')
            ->paginate(10);

        return view('penyelenggara.list')->with('data', $data);

    }

    public function store(Request $request)
	{  

	    $yayasanId = $request->id_yys_pt;

	    $yayasan   =   YayasanPT::updateOrCreate(
	    	        [
	    	         'id_yys_pt' => $yayasanId
	    	        ],
	                [
	                'name' => $request->name, 
	                'email' => $request->email,
	                'address' => $request->address
	                ]);    
	                    
	    return Response()->json($yayasan);

	}
	 
	 
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\company  $company
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Request $request)
	{   
	    $where = array('id_yys_pt' => $request->id_yys_pt);
	    $yayasan  = YayasanPT::where($where)->first();
	 
	    return Response()->json($yayasan);
	}
	 
	 
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\company  $company
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request)
	{
	    $yayasan = YayasanPT::where('id_yys_pt',$request->id_yys_pt)->delete();
	 
	    return Response()->json($yayasan);
	}
}
