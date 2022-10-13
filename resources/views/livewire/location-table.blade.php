<div>
@if ($location->lat != "")
        <table class="min-w-max w-full table-auto">
            <thead>
                <tr class="px-1 bg-gray-200 text-gray-600 uppercase text-xs leading-normal">
                    <th class="p-0 px-1 text-center">Day</th>
                    <th class="p-0 text-center"></th>
                    <th class="p-0 px-1 text-center">00:00</th>
                    <th class="p-0 px-1 text-center">01:00</th>
                    <th class="p-0 px-1 text-center">02:00</th>
                    <th class="p-0 px-1 text-center">03:00</th>
                    <th class="p-0 px-1 text-center">04:00</th>
                    <th class="p-0 px-1 text-center">05:00</th>
                    <th class="p-0 px-1 text-center">06:00</th>
                    <th class="p-0 px-1 text-center">07:00</th>
                    <th class="p-0 px-1 text-center">08:00</th>
                    <th class="p-0 px-1 text-center">09:00</th>
                    <th class="p-0 px-1 text-center">10:00</th>
                    <th class="p-0 px-1 text-center">11:00</th>
                    <th class="p-0 px-1 text-center">12:00</th>
                    <th class="p-0 px-1 text-center">13:00</th>
                    <th class="p-0 px-1 text-center">14:00</th>
                    <th class="p-0 px-1 text-center">15:00</th>
                    <th class="p-0 px-1 text-center">16:00</th>
                    <th class="p-0 px-1 text-center">17:00</th>
                    <th class="p-0 px-1 text-center">18:00</th>
                    <th class="p-0 px-1 text-center">19:00</th>
                    <th class="p-0 px-1 text-center">20:00</th>
                    <th class="p-0 px-1 text-center">21:00</th>
                    <th class="p-0 px-1 text-center">22:00</th>
                    <th class="p-0 px-1 text-center">23:00</th>
                </tr>
            </thead>
            <tbody class="text-gray-300 text-xs font-light">
                @foreach ($day_data as $day)
                    <tr class="border-b border-gray-300 hover:bg-gray-700">
                        <th class="p-2 text-center">{{ date('Y-m-d', $day[0]['Time']) }}</th>
                        <th class="p-2 text-center"><i class="fa-solid fa-wind"></i><br /><i class="fa-solid fa-cloud"></i></th>
                        @foreach ($day as $hour)
                            @if ($hour['Night'])
                                <td class="p-0 p-3 dark:bg-gray-400 text-gray-600 text-left whitespace-nowrap">
                            @else
                                <td class="p-0 p-3 dark:bg-gray-600 text-gray-500 text-left whitespace-nowrap">
                            @endif
                                @if($hour['Wind Speed'] == "")
                                    NA
                                @else
                                    {{ $hour['Wind Speed'] }} <br /> 
                                    {{ intval($hour['Cloud Cover'])*100 }}
                                @endif
                            </td>

                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
@else
            <div class="alert alert-warning">
                Location Unknown
            </div>
@endif

</div>
