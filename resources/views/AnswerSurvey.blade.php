<x-app-layout>
    <div class="min-h-screen h-fit items-center max-w-none-xl p-4" style="background: #3e06b6; color: #C1A4FF">
        <form action="{{url('/survey/participate/answer/'.$survey->id)}}" method="post">
            @csrf
                @foreach ($questions as $question)
                    <div class="mt-20">
                        @if ($question->question_type == 1)
                            <div class="pt-6 flex justify-center items-center">
                                <div class="shadow-md rounded px-6 pt-6 pb-12 mb-1/2 w-11/12" style="background-color: #2B047E;">
                                    <div class="mb-1 w-10/12">
                                        <label class="block text-white font-bold mb-2" style="font-size: 50px;">
                                            {{$question->question}}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-6 flex justify-center items-center">
                                <div class="p mb-1/2 w-11/12">
                                    <input class="shadow appearance-none border-none placeholder-black rounded w-full text-black" name="answers[]" type="text" placeholder="Type Your Answer Here" style="background-color: #FFFFFF;">
                                </div>
                                <input type="hidden" name="UserId[]" value="{{$user->id}}">
                                <input type="hidden" name="QuestionId[]" value="{{$question->id}}">
                                <input type="hidden" name="SurveyId[]" value="{{$question->survey_id}}">
                            </div>
                        @else
                        <?php
                        preg_match('/\[(.*?)\]/',$question->question,$matches);
                        $choicesString = $matches[1];
                        preg_match_all('/\{(.*?)\}/',$choicesString,$matches);
                        $choices = $matches[1];
                        $question->question = substr($question->question, 0, strlen($question->question)-strlen($choicesString)-2);
                        ?>
                        <div class="pt-6 flex justify-center items-center">
                            <div class="shadow-md rounded px-6 pt-6 pb-12 mb-1/2 w-11/12" style="background-color: #2B047E;">
                                <div class="mb-1 w-10/12">
                                    <label class="block text-white font-bold mb-2" style="font-size: 50px;">
                                        {{$question->question}}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div id="questions-container" class="pt-6 flex justify-center items-center" >
                            <div class="p mb-1/2 w-11/12 text-white " style="background-color: #390e96;">
                                @foreach ($choices as $index => $choice)
                                    <div class="ml-5 mt-5 mb-5 flex items-center">
                                        <input type="radio" name="answers[{{$loop->parent->index}}]" value="{{ $index }}" class="mr-2">
                                        <label class="ml-2">{{ $choice }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <input type="hidden" name="UserId[]" value="{{$user->id}}">
                            <input type="hidden" name="QuestionId[]" value="{{$question->id}}">
                            <input type="hidden" name="SurveyId[]" value="{{$question->survey_id}}">
                        </div>
                        @endif
                    </div>
                @endforeach

            <div class="pt-6 flex justify-center items-center">
                <button type="submit" class="text-white font-bold py-2 px-4 rounded" style="background-color: #4417A3;">
                    Submit
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
