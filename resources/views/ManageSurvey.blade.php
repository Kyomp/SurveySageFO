<x-app-layout>
    <div class="px-2 py-3">
        <h2 class="text-x leading-tight">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-row justify-between space-x-14">
                    <div class="rounded-lg overflow-hidden h-20 w-full text-white p-3" style="background-color:#2B047E;">
                        <div class="font-semibold text-5xl text-center mt">
                             {{__('Manage Your Surveys')}}
                        </div>
                    </div>
                </div>
            </div>
        </h2>

        <div class="m-3 justify-start">
            <div class="flex flex-wrap flex-start justify-start max-w-8xl mx-auto mt-10">
            @foreach ($ownSurveys as $ownSurvey)

            <div class="flex flex-col justify-between w-1/5 rounded-lg mb-3 mx-2" style="background: linear-gradient(to bottom, #2B047E, #3e06b6); color: #C1A4FF">
                <div class="pt-2 h-1/5 break-all text-truncate px-2 text-xs">
                    <div>
                        {{$ownSurvey->title}}
                    </div>
                </div>
                <div class="flex flex-col text-center font-extrabold">
                    <div class="text-3xl">
                        {{$questions[$ownSurvey->id]}}
                    </div>
                    <div>
                        Questions
                    </div>
                </div>
                @if ($ownSurvey->open == 0)
                <div class="w-full flex flex-row justify-between text-sm ">
                    <a class="w-full rounded-bl-lg" href="{{url('/survey/edit/'.$ownSurvey->id)}}" class="overflow-hidden">
                        <div class="text-center rounded-bl-lg border-r border-black text-white bg-[#2B047E] hover:bg-[#C1A4FF]">
                            Edit Survey
                        </div>
                    </a>
                    <a class="w-full rounded-br-lg" href="{{url('/survey/open/'.$ownSurvey->id)}}" class="overflow-hidden">
                        <div class=" text-center rounded-br-lg border-l border-black text-white bg-[#2B047E] hover:bg-[#C1A4FF]">
                            Open Survey
                        </div>
                    </a>
                </div>
                    
                @else
                <a class="w-full rounded-b-lg" href="{{url('/survey/close/'.$ownSurvey->id)}}" class="overflow-hidden">
                    <div class=" text-center rounded-b-lg border-l border-black text-white bg-[#2B047E] hover:bg-[#C1A4FF]">
                        Close Survey
                    </div>
                </a>
                @endif
                
            </div>                    
            @endforeach
            
                {{-- Plus Button --}}
                <a href="{{url('/survey/create')}}" class="w-1/5 rounded-lg mb-3 mx-2 p-6 rounded-lg" style="background: #808080; color: #FFFFFF">
                    <h2 class="mb-3 text-center">
                        <div class="font-semibold text-5xl text-center mt">
                             {{__('+')}}
                        </div>
                       <div class="font-semibold text-2xl text-center mt">
                             {{__('Create Survey')}}
                        </div>
                    </h2>
                </a>
        </div>
    </div>
</x-app-layout>
