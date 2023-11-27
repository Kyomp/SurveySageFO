<x-app-layout>
    <div class="min-h-screen h-fit items-center max-w-none-xl p-4" style="background: #3e06b6; color: #C1A4FF">
        <div class="flex justify-center items-center rounded-lg">
            <div class="w-4/12">
            <input disabled class="shadow appearance-none border-none placeholder-white rounded w-full py-2 px-3 text-white" 
            id="" name="title" type="text" placeholder="{{$survey->title}}" 
            style="background-color: #2B047E;">
            </div>
        </div>  

        <div class="pt-6 flex justify-center items-center">
            <div class="shadow-md rounded px-6 pt-6 pb-12 mb-1/2 w-6/12" style="background-color: #2B047E;">
                <div class="mb-1 w-7/12">
                    <label class="block text-white text-sm font-bold mb-2">
                        Earn These Amounts of Points by taking the Survey
                    </label>
                    <label class="block text-white font-bold mb-2" style="font-size: 65px;">
                        {{$survey->points}} POINTS
                    </label>
                </div>
            </div>
        </div>

        <div class="pt-6 flex justify-center items-center">
            <a href="{{url('/survey/participate/answer/'.$survey->id.'/')}}">
                <button type="button" class="text-white font-bold py-2 px-4 rounded" style="background-color: #4417A3;">
                    Take Survey
                </button>
            </a>
        </div>

    </div>
</x-app-layout>
