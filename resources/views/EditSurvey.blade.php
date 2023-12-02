<x-app-layout>
<div class="min-h-screen h-fit items-center max-w-none-xl p-4" style="background: #3e06b6; color: #C1A4FF">  
  <form action="{{url('/survey/edit/'.$survey->id)}}" method="post">
    @csrf
      <div class="flex justify-center items-center rounded-lg">
        <div class="w-4/12">
          <input class="shadow appearance-none border-none placeholder-white rounded w-full py-2 px-3 text-white" 
          id="" name="title" type="text" placeholder="Survey Name" 
          @if ($survey->title!=NULL) 
            value="{{$survey->title}}"
          @endif
          style="background-color: #2B047E;">
        </div>
      </div>  
    
      <div class="pt-6 flex justify-center items-center">
        <div class="shadow-md rounded px-6 pt-6 pb-12 mb-1/2 w-6/12" style="background-color: #2B047E;">
          <div class="mb-1 w-7/12">
            <label class="block text-white text-sm font-bold mb-2">
              Point Reward
            </label>
            <label class="block text-white font-bold mb-2" style="font-size: 65px;">
              {{$survey->points}} POINTS
            </label>
          </div>
        </div>
      </div>
      <div id="questions-container">
        @foreach ($questions as $question)
          @if ($question->question_type == 1)
            <div class="pt-6 flex justify-center items-center">
              <div class="shadow-md rounded px-6 pt-6 pb-12 mb-1/2 w-6/12" style="background-color: #2B047E;">
                <div class="mb-5 w-7/12">
                  <input class="shadow appearance-none border-none placeholder-white rounded w-3/4 py-2 px-3 text-white" name="questions[]" type="text" placeholder="Question Text" value="{{$question->question}}" style="background-color: #4417A3;" required>
                </div>
                <input disabled class="shadow appearance-none border-none placeholder-white rounded w-full py-2 px-3 text-white" name="answers[]" type="text" placeholder="Write Your Answer Here" style="background-color: #4417A3;">
                <input type="hidden" name="id[]" value="{{$question->id}}" >
                <input type="hidden" name="type[]" value="{{$question->question_type}}">
              </div>
            </div>          
          @else
          <?php
          preg_match(
          '/\[(.*?)\]/',
          $question->question,
          $matches
          );
          $choicesString = $matches[1];
          preg_match_all(
            '/\{(.*?)\}/',
            $choicesString,
            $matches
            );
          $choices = $matches[1];
          $question->question = substr($question->question, 0, strlen($question->question)-strlen($choicesString)-2);?>
          <div class="pt-6 flex justify-center items-center">
          <div class="shadow-md rounded px-6 pt-6 pb-12 mb-1/2 w-6/12" style="background-color: #2B047E;">
            <div class="mb-5 w-7/12">
              <input class="shadow appearance-none border-none placeholder-white rounded w-3/4 py-2 px-3 text-white" name="questions[]" type="text" placeholder="Question Text" value="{{$question->question}}" style="background-color: #4417A3;" required>
            </div>
            <div class="mb-5 w-11/12">
              <input class="shadow appearance-none border-none placeholder-white rounded w-full py-2 px-3 text-white" name="choice1[]" type="text" placeholder="Choice1" value="{{$choices[0]}}" style=" background-color: #4417A3;" required>
            </div>
            <div class="mb-5 w-11/12">
              <input class="shadow appearance-none border-none placeholder-white rounded w-full py-2 px-3 text-white" name="choice2[]" type="text" placeholder="Choice2" value="{{$choices[1]}}" style=" background-color: #4417A3;" required>
            </div>
            <div class="mb-5 w-11/12">
              <input class="shadow appearance-none border-none placeholder-white rounded w-full py-2 px-3 text-white" name="choice3[]" type="text" placeholder="Choice3" value="{{$choices[2]}}" style=" background-color: #4417A3;" required>
            </div>
            <div class="mb-5 w-11/12">
              <input class="shadow appearance-none border-none placeholder-white rounded w-full py-2 px-3 text-white" name="choice4[]" type="text" placeholder="Choice4" value="{{$choices[3]}}" style="  background-color: #4417A3;" required>
            </div>

            <input type="hidden" name="id[]" value="{{$question->id}}">
            <input type="hidden" name="type[]" value="2">
          </div>
          </div>
          @endif
        @endforeach
      </div>
      
      <div class="pt-6 flex justify-center items-center">
        <button type="button" onclick="addQuestion()" class="text-white font-bold py-2 px-4 rounded" style="background-color: #4417A3;">
          Add Short-Answer Question
        </button>
      </div>
      <div class="pt-6 flex justify-center items-center">
        <button type="button" onclick="addMultipleChoiceQuestion()" class="text-white font-bold py-2 px-4 rounded" style="background-color: #4417A3;">
          Add Multiple-Choice Question
        </button>
      </div>
      <div class="pt-6 flex justify-center items-center">
        <button type="submit" class="text-white font-bold py-2 px-4 rounded" style="background-color: #4417A3;">
          Save Survey
        </button>
      </div>
  </form>
</div>
</x-app-layout>

<script>
    function addQuestion() {
      var questionContainer = document.getElementById('questions-container');
      var newQuestion = document.createElement('div');
      newQuestion.className = 'pt-6 flex justify-center items-center';

      newQuestion.innerHTML = `
        <div class="shadow-md rounded px-6 pt-6 pb-12 mb-1/2 w-6/12" style="background-color: #2B047E;">
          <div class="mb-5 w-7/12">
            <input class="shadow appearance-none border-none placeholder-white rounded w-3/4 py-2 px-3 text-white" name="questions[]" type="text" placeholder="Question Text" style="background-color: #4417A3;" required>
          </div>
          <input disabled class="shadow appearance-none border-none placeholder-white rounded w-full py-2 px-3 text-white" name="answers[]" type="text" placeholder="Write Your Answer Here" style="background-color: #4417A3;">
          <input type="hidden" name="id[]" value="-1">
          <input type="hidden" name="type[]" value="1">

        </div>
      `;
      questionContainer.appendChild(newQuestion);
    }

    function addMultipleChoiceQuestion() {
      var questionContainer = document.getElementById('questions-container');
      var newQuestion = document.createElement('div');
      newQuestion.className = 'pt-6 flex justify-center items-center';

      newQuestion.innerHTML = `
        <div class="shadow-md rounded px-6 pt-6 pb-12 mb-1/2 w-6/12" style="background-color: #2B047E;">
          <div class="mb-5 w-7/12">
            <input class="shadow appearance-none border-none placeholder-white rounded w-3/4 py-2 px-3 text-white" name="questions[]" type="text" placeholder="Question Text" style="background-color: #4417A3;" required>
          </div>
          <div class="mb-5 w-11/12">
            <input class="shadow appearance-none border-none placeholder-white rounded w-full py-2 px-3 text-white" name="choice1[]" type="text" placeholder="Choice1" style="background-color: #4417A3;" required>
          </div>
          <div class="mb-5 w-11/12">
            <input class="shadow appearance-none border-none placeholder-white rounded w-full py-2 px-3 text-white" name="choice2[]" type="text" placeholder="Choice2" style="background-color: #4417A3;" required>
          </div>
          <div class="mb-5 w-11/12">
            <input class="shadow appearance-none border-none placeholder-white rounded w-full py-2 px-3 text-white" name="choice3[]" type="text" placeholder="Choice3" style="background-color: #4417A3;" required>
          </div>
          <div class="mb-5 w-11/12">
            <input class="shadow appearance-none border-none placeholder-white rounded w-full py-2 px-3 text-white" name="choice4[]" type="text" placeholder="Choice4" style="background-color: #4417A3;" required>
          </div>

          <input type="hidden" name="id[]" value="-1">
          <input type="hidden" name="type[]" value="2">

        </div>
      `;
      questionContainer.appendChild(newQuestion);
    }
  </script>