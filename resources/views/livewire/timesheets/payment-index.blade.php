<div class="max-w-xl sm:px-6 mx-auto">
    <x-cards.wrapper>
        {{-- HEADING --}}
        <x-cards.heading>
            <x-slot name="left">
                <h1>Pay Team Members</h1>
            </x-slot>

            <x-slot name="right">
                {{-- <x-cards.button href="{{route('hours.create')}}">
                    Add Hours
                </x-cards.button> --}}
            </x-slot>
        </x-cards.heading>

        {{-- @dd($user_timesheets) --}}
        <x-lists.ul>
            @foreach($user_timesheets as $user => $unpaid_user_hours)
                <x-lists.search_li
                    href="{{route('timesheets.payment', $unpaid_user_hours->first()->user->id)}}"
                    :line_title="'Pay ' . $unpaid_user_hours->first()->user->first_name . ' ' . money($unpaid_user_hours->sum('amount'))"
                    :bubble_message="'Pay Timesheet'"
                    >
                </x-lists.search_li>
            @endforeach
        </x-lists.ul>
    </x-cards.wrapper>
</div>