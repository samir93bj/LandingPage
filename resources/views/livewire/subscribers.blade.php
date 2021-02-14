    <div class="p-6 bg-white border-b border-gray-200">
        <p class="text-3xl text-center font-bold mb-6 underline  text-indigo-600">Subscribers</p>
        <div>
            <x-input
                type="text"
                class="rounded-lg border float-right border-gray-300 mb-4 w-1/3 pl-8"
                placeholder="Search"
                wire:model="search"
            ></x-input>

                @if ($subscribers->isEmpty())
                <div class="flex w-full bg-red-100 p-5 rounded-lg">
                    <p class=" text-red-400">
                        No Subscribers Found
                    </p>
                </div>
            @else
                <table class="w-full ">
                    <thead class="border-b-2 border-gray-300 text-indigo-600">
                        <tr>
                            <th class="px-6 py-3 text-left">Email</th>
                            <th class="px-6 py-3 text-left">Verified</th>
                            <th class="px-6 py-3 text-left"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subscribers as $subscriber)
                            <tr class="text-sm text-indigo-900 border-b border-gray-400">
                                <td class="px-6 py-4">{{ $subscriber->email }}</td>

                                {{--diffForHumans Retornara solo si el valor es not null--}}
                                <td class="px-6 py-4">{{ optional($subscriber->email_verified_at)->diffForHumans() ?? 'Never' }}</td> 
                                <td class="py-4">
                                    <x-button class="border border-red-500 bg-red-50 text-red-500 hover:bg-red-100" wire:click="delete({{$subscriber->id}})">
                                        Delete 
                                    </x-button>
                                </td>
                                <td class="py-4">
                                    <x-button class="border border-red-500 bg-red-50 text-red-500 hover:bg-red-100" wire:click="delete({{$subscriber->id}})">
                                        Edit 
                                    </x-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
            @endif
        </div>
    </div>
