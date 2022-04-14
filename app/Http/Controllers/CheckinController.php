<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Funcionarios;
use App\Models\Checkin;

use DataTables;
use Carbon\Carbon;


class CheckinController extends Controller
{
    function index()
    {
        return view('checkin');
    }
    function checkcpf(Request $request)
    {
        $this->validate($request, [
            'cpf'  => 'required|min:14'
           ]);

        $cpf_raw = $request->get('cpf');//only('cpf')[0]
        $cpf = preg_replace('/[^0-9]/', '', $cpf_raw);  

        try{
            $funcionario = Funcionarios::where('cpf', $cpf)->firstOrFail();
            $checkin = Checkin::create(['func_cpf' =>$cpf]);

            return back()->with('success', "CPF $cpf_raw validado com sucesso!");
        }
        catch(ModelNotFoundException $e){
            return back()->with('error', 'CPF informado não corresponde com nossos registros.');
        }
        
    
    }
    function datatable(Request $request)
    {
        if ($request->ajax()) {

            $startDate = $request->get('from');
            $endDate = $request->get('to');

            //Comentario do server-side do DataTable, mas pelo tempo escasso foi desativado

            // $limit_val = $request->input('length');
            // $start_val = $request->input('start');
            // $order_val = $columns_list[$request->input('order.0.column')];
            // $dir_val = $request->input('order.0.dir');


            $query = Checkin::latest();

            if($startDate && $endDate) {
                $query->whereDate('created_at', '>=', $startDate)
                ->whereDate('created_at', '<=', $endDate);
            }

            // if(empty($request->input('search.value')))
            // {
            //     $query->offset($start_val)
            //     ->limit($limit_val)
            //     ->orderBy($order,$dir_val);
            // }
            // else {
            //     $search_text = $request->input('search.value');
                 
            //     $query->where('func_cpf','LIKE',"%{$search_text}%")
            //     ->orWhere('funcionario.nome', 'LIKE',"%{$search_text}%")
            //     ->offset($start_val)
            //     ->limit($limit_val)
            //     ->orderBy($order,$dir_val);
            //     }            
            

            $data = $query->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                   ->addColumn('funcionario', function($row){
                    return $row->Funcionario()->first()->nome;

             })
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="'.url("/checkin/edit/{$row->id}").'"><span class="fa icon-pencil" style="margin-left:5px;margin-right:5px;"/></a><a href="'.url("/checkin/delete/{$row->id}").'"><span class="fa icon-trash" style="margin-left:5px;margin-right:5px;"/></a>';
     
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return response()->json(['status' => 500,'error' => 'Rota não permitida!'], 500);

    }
    function inserirCheckinView()
    {
        return view('manage/inserirchekin');
    }
    function inserirCheckin(Request $request)
    {
        $this->validate($request, [
            'cpf'  => 'required|min:14',
            'data'  => 'required|date_format:d/m/Y H:i'
            ]);

        $date_raw = $request->get('data');
        $cpf_raw = $request->get('cpf');//only('cpf')[0]
        
        $date = Carbon::createFromFormat('d/m/Y H:i', $date_raw);
        //$date = date("Y-m-d H:i:s",strtotime( $date_raw));
        $cpf = preg_replace('/[^0-9]/', '', $cpf_raw);
        try{
        $funcionario = Funcionarios::where('cpf', $cpf)->firstOrFail();
        $checkin = Checkin::create(['func_cpf' =>$cpf,'created_at'=>$date]);
        return back()->with('success', "CPF $cpf_raw cadastrado com sucesso!");
        }
        catch(ModelNotFoundException $e){
            return back()->with('error', 'CPF informado já existe em nossos registros.');
        }
    }

    function editcheckinView($id,Request $request)
    {
        try{
            $checkin = Checkin::findOrFail($id);
            $funcionario = Funcionarios::where('cpf', $checkin->func_cpf)->firstOrFail();
            $created_at = date("d/m/Y H:i",strtotime( $checkin->created_at));
            $updated_at = date("d/m/Y H:i",strtotime( $checkin->updated_at));
            $dados= ['created_at'=>$created_at,'updated_at'=> $updated_at,'func_cpf'=>$checkin->func_cpf,'nome'=>$funcionario->nome];
        return view('manage/editcheckin', compact('dados','id'));
        }catch(ModelNotFoundException $e){
            return back()->with('error', 'Erro ao localizar o Check-in.');
        }
        
    }
    function editcheckin($id,Request $request)
    {
        $this->validate($request, [
            'data'  => 'required|date_format:d/m/Y H:i'
            ]);

        $date_raw = $request->get('data');

        $date = Carbon::createFromFormat('d/m/Y H:i', $date_raw, 'America/Sao_Paulo');
        try{
            $checkin_outdatted = Checkin::findOrFail($id);
            $checkin_outdatted->update(['created_at'=>$date]);
            $checkin = Checkin::findOrFail($id);
            $funcionario = Funcionarios::where('cpf', $checkin->func_cpf)->firstOrFail();
            $created_at = date("d/m/Y H:i",strtotime( $checkin->created_at));
            $updated_at = date("d/m/Y H:i",strtotime( $checkin->updated_at)); 
            $dados= ['created_at'=>$created_at,'updated_at'=> $updated_at,'func_cpf'=>$checkin->func_cpf,'nome'=>$funcionario->nome];
            $success= "Checkin editado com sucesso!";
        return view("manage/editcheckin", compact('dados','success','id'));
        }catch(ModelNotFoundException $e){
            return back()->with('error', 'Erro ao localizar o Check-in.');
        }

    }

    function deletecheckin($id,Request $request)
    {
        try{
            $checkin = Checkin::findOrFail($id);
            if ($checkin->delete()){
                return back()->with('success', "Check-in deletado com sucesso!");
            }
            return back()->with('error', "Erro ao deletar o Check-in");
        
        }catch(ModelNotFoundException $e){
            return back()->with('error', 'Erro ao localizar o Check-in.');
        }


    }
}