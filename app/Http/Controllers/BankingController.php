<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BankingDetails;
use Illuminate\Support\Facades\Validator;
use Auth;
use DataTables;

class BankingController extends Controller
{
    public function home(){

        $balance = User::join('banking_details','banking_details.fk_user_id','users.id')->where('users.id',Auth::user()->id)->select('amount','type','details')->get();
        if(count($balance)>0){
            foreach($balance as $balance){
                if($balance->type=='Credit'){
                    $deposit_balance = $balance->amount;
                }
                else if($balance->type=='Debit' && $balance->details=='Withdraw'){
                    $amount = $balance->amount;
                    $withdraw_balance = $deposit_balance-$amount;
                }else if($balance->type=='Debit' && $balance->details!='Withdraw' ){
                    $amount = $balance->amount;
                    if(isset($withdraw_balance)!=''){
                        $transfer_balance = $withdraw_balance-$amount;
                    }else{
                        $transfer_balance = $deposit_balance-$amount;
                    }
                }
            }

            if(isset($deposit_balance)!='' && isset($withdraw_balance)=='' && isset($transfer_balance)==''){
                $total_balance = $deposit_balance;
            }else if(isset($deposit_balance)!='' && isset($withdraw_balance)!='' && isset($transfer_balance)==''){
                $total_balance = $withdraw_balance;
            }else if(isset($deposit_balance)!='' && isset($withdraw_balance)=='' && isset($transfer_balance)!=''){
                $total_balance = $transfer_balance;
            }else if(isset($deposit_balance)!='' && isset($withdraw_balance)!='' && isset($transfer_balance)!=''){
                $total_balance = $transfer_balance;
            }

            $data = User::select('name','email')->where('id',Auth::user()->id)->first();
            return view('banking.view',compact('data','total_balance'));
        }else{
            $data = User::select('name','email')->where('id',Auth::user()->id)->first();
            return view('banking.view',compact('data'));
        }
       
    }

    //-------------deposit amount-----------------------//

    public function Deposit(){
        return view('banking.deposit');
    }
    
    public function addDeposit(Request $request){
        $validator = Validator::make($request->all(), [
            'deposit_amount'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status'=>false,'message'=>$validator->messages()->first()]);
        }
        else
        {
            $user = BankingDetails::create([
                'fk_user_id'=>Auth::user()->id,
                'amount' => $request->deposit_amount,
                'type'=>'Credit',
                'details'=>'Deposit',
                'balance'=>$request->deposit_amount,
            ]);
            return response()->json(['status' => true, 'message' => "Amount Deposited Successfully", 'data' =>[]], 200);
        }
    }

  
    //---------------------withdraw amount------------------------//

    public function Withdraw(){
        return view('banking.withdraw');
    }

    public function addWithdraw(Request $request){
        $messages = [
            'withdraw_amount.required'=>'Enter an amount',
        ];
        $validator = Validator::make($request->all(), [
            'withdraw_amount'=>'required',
        ],$messages);
        if ($validator->fails()) {
            return response()->json(['status'=>false,'message'=>$validator->messages()->first()]);
        }

        $deposit = BankingDetails::where('fk_user_id',Auth::user()->id)->select('amount')->first();
        if($deposit==''){
            return response()->json(['status' => false, 'message' => "There is no amount into your account for withdraw"]);
        }
        if($deposit->amount<=$request->withdraw_amount){
            return response()->json(['status' => false, 'message' => "There is no $request->withdraw_amount amount into your account for withdraw"]);
        }
        else
        {
            $user = BankingDetails::create([
                'fk_user_id'=>Auth::user()->id,
                'amount' => $request->withdraw_amount,
                'type'=>'Debit',
                'details'=>'Withdraw',
                'balance'=>$deposit->amount-$request->withdraw_amount,
            ]);
            
            return response()->json(['status' => true, 'message' => "Amount Withdrawed Successfully", 'data' =>[]], 200);
        }
    }

    //----------------------Transfer amount-------------------------//

    public function Transfer(){
        return view('banking.transfer');
    }

    public function addTransfer(Request $request){
        $messages = [
            'transfer_amount.required'=>'choose amount',
            'email'=>'choose email'
        ];
        $validator = Validator::make($request->all(), [
            'transfer_amount'=>'required',
            'email'=>'required',
        ],$messages);
      
        if ($validator->fails()) {
            return response()->json(['status'=>false,'message'=>$validator->messages()->first()]);
        }
        $deposit = BankingDetails::where('fk_user_id',Auth::user()->id)->select('amount')->first();
        if($deposit==''){
            return response()->json(['status' => false, 'message' => "There is no amount into your account for transfer"]);
        }
        if($deposit->amount<=$request->transfer_amount){
            return response()->json(['status' => false, 'message' => "There is no $request->transfer_amount amount into your account for transfer"]);
        }

        else
        {
            $amount = BankingDetails::where('fk_user_id',Auth::user()->id)->orderBy('id','desc')->select('amount','balance')->first();
            $user = BankingDetails::create([
                'fk_user_id'=>Auth::user()->id,
                'email'=>$request->email,
                'amount' => $request->transfer_amount,
                'type'=>'Debit',
                'details'=>'Transfer to' ." ". $request->email,
                'balance'=>$amount->balance-$request->transfer_amount,
            ]);
            return response()->json(['status' => true, 'message' => "Amount Transfered Successfully", 'data' =>[]], 200);
        }
    }
    
    //----------------bank statement-----------------------------//
    public function Statement(Request $request){
        if ($request->ajax()) {
            $data = User::join('banking_details','banking_details.fk_user_id','users.id')
            ->select('users.id as userId','users.name','users.email','users.created_at as created','banking_details.*')
            ->latest();
            
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('created_at', function($row){ 
                       $data = date('d-m-Y h:i:s a', strtotime($row->created_at));
                            return $data;
                    })
                    ->filter(function ($instance) use ($request) {

                        if (!empty($request->search['value'])) {

                            $instance->where(function($w) use($request){
                               $search = $request->search['value'];
                               $w->orWhere('banking_details.amount', 'LIKE', "%$search%")
                               ->orWhere('banking_details.type', 'LIKE', "%$search%")
                               ->orWhere('banking_details.details', 'LIKE', "%$search%")
                               ->orWhere('banking_details.created_at', 'LIKE', "%$search%");
                           });
                       }
                    })
                    ->rawColumns(['created_at'])
                    ->make(true);
        }
        return view('banking.statement');
    }
}
