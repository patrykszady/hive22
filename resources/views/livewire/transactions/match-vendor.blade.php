<div>
    <form wire:submit.prevent="{{$view_text['form_submit']}}">
        @foreach($merchant_names as $merchant_name => $merchant_transactions)          
            <x-cards.wrapper class="max-w-2xl lg:max-w-3xl mx-auto">
                <x-cards.heading>
                    <x-slot name="left">
                        <h1>{{$merchant_name}}</h1>
                    </x-slot>
                    <x-slot name="right">
                        {{-- <x-cards.button href="{{route('expenses.index')}}">
                            No Click
                        </x-cards.button> --}}
                    </x-slot>
                </x-cards.heading>
                <x-cards.body :class="'space-y-4 my-4'">
                    <x-lists.ul>
                        @foreach($merchant_transactions as $transaction)
                            @php
                                $line_details = [
                                    1 => [
                                        'text' => $transaction->posted_date->format('m/d/Y'),
                                        'icon' => 'M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z'
                                        ],
                                    2 => [
                                        'text' => $transaction->plaid_merchant_description,
                                        'icon' => 'M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z'
                                        ],
                                    3 => [
                                        'text' => $transaction->bank_account->bank->name . ' | ' . $transaction->bank_account->type,
                                        'icon' => 'M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z'
                                        ],
                                    ];
                            @endphp
                
                            <x-lists.search_li
                                href=""
                                :line_details="$line_details"
                                :line_title="money($transaction['amount'])"
                                :bubble_message="'Success'"
                                >
                            </x-lists.search_li>                        
                        @endforeach
                    </x-lists.ul>
                    <hr>
                    <x-forms.row 
                        wire:model="match_merchant_names.{{ $loop->index }}.match_desc" 
                        errorName="match_merchant_names.{{ $loop->index }}.match_desc"
                        name="match_merchant_names.{{ $loop->index }}.match_desc" 
                        text="Match As"
                        type="text"
                        >
                    </x-forms.row>
                    <x-forms.row 
                        wire:model.debounce.250ms="match_merchant_names.{{ $loop->index }}.vendor_id" 
                        errorName="match_merchant_names.{{ $loop->index }}.vendor_id" 
                        name="match_merchant_names.{{ $loop->index }}.vendor_id" 
                        text="Vendor"
                        type="dropdown"
                        >
                        <option value="" readonly>Select Vendor</option>
                        <option value="NEW">NEW Retail Vendor</option>
                        <option value="DEPOSIT">Deposit Transaction</option>
                        <option value="CHECK">Check Paid</option>
                        <option value="TRANSFER">Transfer/Zelle Out</option>
                        <option value="CASH">Cash Withdrawal</option>
                        <hr>
                        @foreach ($vendors as $index => $vendor)
                            <option value="{{$vendor->id}}">{{$vendor->business_name}}</option>
                        @endforeach
                    </x-forms.row>
                    <x-forms.row 
                        wire:model="match_merchant_names.{{ $loop->index }}.options" 
                        errorName="match_merchant_names.{{ $loop->index }}.options" 
                        name="match_merchant_names.{{ $loop->index }}.options" 
                        text="Options" 
                        type="text" 
                        radioHint="Bank Specific"
                        placeholder="regex"
                        >
                        <x-slot name="radio">
                            <input 
                                wire:model="match_merchant_names.{{ $loop->index }}.bank_specific" 
                                id="match_merchant_names.{{ $loop->index }}.bank_specific" 
                                name="match_merchant_names.{{ $loop->index }}.bank_specific" 
                                type="checkbox"
                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded ml-2"
                            >
                        </x-slot>
                    </x-forms.row>
                </x-cards.body>
            </x-cards.wrapper>        
        @endforeach

        <x-cards.wrapper class="max-w-2xl lg:max-w-3xl mx-auto">
            <x-cards.footer>
                <button 
                    type="button"
                    {{-- class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" --}}
                    > 
                    {{-- Cancel --}}
                </button>
                <button 
                    type="submit"
                    {{-- wire:model="match_merchant_names.{{ $key }}"  --}}
                    {{-- x-bind:disabled="expense.project_id" --}}
                    class="ml-3 inline-flex justify-center disabled:opacity-50 py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{$view_text['button_text']}}
                </button>
            </x-cards.footer>
        </x-cards.wrapper>
    </form> 
</div>
