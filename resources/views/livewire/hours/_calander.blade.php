<div class="text-center m-4">
    <div class="flex items-center text-gray-900">
        <div class="flex-auto font-semibold">
            {{$this->selected_date->format('F Y')}}
        </div>
    </div>
    <div class="mt-6 grid grid-cols-7 text-xs leading-6 text-gray-500">
        <div>M</div>
        <div>T</div>
        <div>W</div>
        <div>T</div>
        <div>F</div>
        <div>S</div>
        <div>S</div>
    </div>
    <div class="isolate mt-2 grid grid-cols-7 gap-px rounded-lg bg-gray-200 text-sm shadow ring-1 ring-gray-200">
        <!--
            Always include: "py-1.5 hover:bg-gray-100 focus:z-10"
            Top left day, include: "rounded-tl-lg"
            Top right day, include: "rounded-tr-lg"
            Bottom left day, include: "rounded-bl-lg"
            Bottom right day, include: "rounded-br-lg"
            Is current month, include: "bg-white"
            Is today and is not selected, include: "text-indigo-600"
            Is not selected, is not today, and is current month, include: "text-gray-900"
            Is not selected, is not today, and is not current month, include: "text-gray-400"

            Is not current month, include: ""
            Is selected or is today, include: "font-semibold"
            Is selected, include: "text-white"
        -->
        @foreach ($days as $day)
            <button 
                type="button"
                wire:click="$emit('selectedDate', '{{$day['format']}}')"
                
                {{-- if date is in CONFIRMED ARRAY --}}
                @if(today()->format('Y-m-d') < $day['format'] || $day['confirmed_date'] == TRUE)
                    disabled
                @endif

                class="py-1.5 focus:z-10
                    @if(today()->format('Y-m-d') < $day['format'] || $day['confirmed_date'] == TRUE)
                        ' cursor-not-allowed text-gray-200 bg-gray-50 '
                    @else
                        ' hover:bg-gray-50 hover:text-gray-900 hover:font-semibold  '
                    @endif

                    @if(today()->format('Y-m-d') == $day['format'] && $day['has_hours'] == TRUE) 
                        ' text-white bg-green-500 ' 
                    @elseif(today()->format('Y-m-d') == $day['format']) 
                        ' font-semibold ' 
                    @elseif($day['month'] == today()->format('m') && $day['has_hours'] == TRUE && $day['confirmed_date'] == FALSE) 
                        ' bg-green-500 text-white ' 
                    @elseif($day['month'] == today()->format('m') && $day['has_hours'] == TRUE && $day['confirmed_date'] == TRUE) 
                        ' bg-green-100 text-white ' 
                    @elseif($day['month'] == today()->format('m')) 
                        '  bg-gray-100 ' 
                    @elseif($day['has_hours'] == TRUE) 
                        ' bg-green-500 ' 
                    @else 
                        ' bg-white text-gray-400 ' 
                    @endif 

                    @if($this->selected_date)
                        @if($this->selected_date->format('Y-m-d') == $day['format'])
                            ' font-semibold text-white bg-indigo-800 '
                        @endif
                    @endif

                    @if($loop->iteration == 1)
                        ' rounded-tl-lg'
                    @elseif($loop->iteration == 7)
                        ' rounded-tr-lg'
                    @elseif($loop->iteration == 15)
                        ' rounded-bl-lg'
                    @elseif($loop->iteration == 21)
                        ' rounded-br-lg'
                    @endif
                
                    ">
                <time datetime="{{$day['format']}}" class="mx-auto flex h-7 w-7 items-center justify-center rounded-full">{{$day['day']}}</time>
            </button>
        @endforeach
    </div>
</div>