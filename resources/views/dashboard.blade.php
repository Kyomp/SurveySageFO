<x-app-layout>
    <div class="px-2 py-3">
        <h2 class="text-x leading-tight">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-row justify-between space-x-14">
                    <div class="rounded-lg overflow-hidden h-40 w-1/2 text-white p-3 m" style="background-color:#2B047E;">
                        {{__('Manage Your Surveys:')}}
                        @php
                          $count = 1;
                        @endphp
                        @foreach ($ownSurveys as $survey)
                            <div>
                                &emsp;{{$count}}. {{$survey->title}}
                            </div>
                            @php
                                $count++;
                            @endphp
                        @endforeach
                    </div>
                    <div class="rounded-lg overflow-hidden h-40 w-1/2 text-white p-3" style="background-color:#2B047E;">
                        {{__('You Have Collected:')}}
                        <div class="font-semibold text-5xl text-center mt-6">
                            {{$user->id}} Points
                        </div>
                    </div>
                </div>
            </div>
        </h2>

        <div class="m-3">
            <div class="font-black text-2xl text-center">
                {{__('Answer Surveys to Get Rewards')}}
            </div>
            <div class="flex space-x-10 mt-10">
                @foreach ($otherSurveys as $otherSurvey)
                    <div class="w-1/4 p-6 rounded-lg" style="background: #2B047E; color: #C1A4FF">
                        <div>
                            <p class="mb-2 text-xs font-normal text-inherit">
                                {{$otherSurvey->title}}
                            </p>
                        </div>
                        <h2 class="mb-3 text-center">
                            <div class="text-4xl font-semibold">
                                {{$otherSurvey->points}}
                            </div>
                            <div>
                                Points
                            </div>

                        </h2>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
