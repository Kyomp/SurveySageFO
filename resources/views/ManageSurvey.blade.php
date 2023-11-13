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

        <div class="m-3">
            <div class="flex flex-wrap justify-between max-w-7xl mx-auto mt-10">
            @foreach ($ownSurveys as $ownSurvey)

            <div class="w-1/5 rounded-lg mb-3 mx-2" style="background: linear-gradient(to bottom, #2B047E, #3e06b6); color: #C1A4FF">
                <div class="mt-2 flex flex-row justify-between mx-2 text-sm">
                    <div>
                        {{$ownSurvey->title}}
                    </div>
                </div>
                <div class="mt-4 mb-2 flex flex-col text-center font-extrabold">
                    <div class="text-3xl">
                        {{$questions[$ownSurvey->id]}}
                    </div>
                    <div>
                        Questions
                    </div>
                </div>
                <a href="{{url('/survey/edit/'.$ownSurvey->id)}}" class="overflow-hidden">
                    <div class="w-full text-center rounded-b-lg" style="color: white; background-color: #2B047E" >
                        Edit Survey
                    </div>
                </a>
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
