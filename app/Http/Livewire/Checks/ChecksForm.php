<?php

namespace App\Http\Livewire\Checks;

use App\Models\Check;
use App\Models\BankAccount;

use Livewire\Component;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ChecksForm extends Component
{
    use AuthorizesRequests;

    // public Check $check;
    public $check = NULL;
    public $check_input = NULL;

    // public $bank_accounts = NULL;

    // public $payment_type = NULL;

    protected $listeners = ['validateCheck'];

    protected function rules()
    {
        return [
            'check.date' => 'required',
            'check.paid_by' => 'required_without:check.bank_account_id',
            'check.bank_account_id' => 'required_without:check.paid_by',
            'check.check_type' => 'required_with:check.bank_account_id',
            'check.check_number' => 'required_if:check.check_type,Check',   
            'check.invoice' => 'required_with:check.paid_by',  
        ];
    }
    
    protected $messages = 
    [
        'check.check_number' => 'Check Number is required if Payment Type is Check',
    ];

    public function mount()
    {              
        //where ACtive on bank
        // dd(BankAccount::with('bank')->get());
        $this->bank_accounts = BankAccount::with('bank')->where('type', 'Checking')
        ->whereHas('bank', function ($query) {
            return $query->whereNotNull('plaid_access_token');
        })->get();

        if(isset($this->check)){          
            $this->view_text = [
                // 'card_title' => 'Update user',
                'button_text' => 'Update Payment',
                'form_submit' => 'store',             
            ];

            $this->check_input = TRUE;
        }else{
            $this->check = Check::make();
            
            $this->view_text = [
                // 'card_title' => 'Update user',
                'button_text' => 'Save Payment',
                'form_submit' => 'store',             
            ];
        }
    }

    public function updated($field) 
    {
        // if($field == 'check.check_type'){
        //     if($this->check->check_type == 'Check'){
        //         $this->check_input = TRUE;
        //     }else{
        //         $this->check->check_number = NULL;
        //         $this->check_input = FALSE;
        //     }
        // }

        $this->validateOnly($field);
    }

    public function validateCheck()
    {
        dd('in validateCheck');
        // $this->modal_show = TRUE;
    }

    public function store()
    {
        $this->validate();
        dd('in store Check');
        
        if($this->payment_type->getTable() == 'vendors'){
            // dd($this->payment_type->getTable());
            // dd('vendors table');
            //send to VendorPaymentForm
            // dd($this->check);
            $this->emit('vendorHasCheck', $this->check);
        }elseif($this->payment_type->getTable() == 'expenses'){
            $this->emit('hasCheck', $this->check);
        }
    }
    
    public function render()
    {
        $bank_accounts = BankAccount::where('type', 'Checking')->get();
        $employees = auth()->user()->vendor->users()->where('is_employed', 1)->whereNot('users.id', auth()->user()->id)->get();

        // $employees = $this->user->vendor->users()->where('is_employed', 1)->whereNot('users.id', $this->user->id)->get();

        return view('livewire.checks._payment_form', [
            'bank_accounts' => $bank_accounts,
            'employees' => $employees,
        ]);
    }
}
