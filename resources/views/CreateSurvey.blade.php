<x-app-layout>
<div class="min-h-screen h-fit items-center max-w-none-xl p-4" style="background: #3e06b6; color: #C1A4FF">  
  <form action="{{ route('StoreSurvey') }}" method="post">
    @csrf
      <div class="flex justify-center items-center rounded-lg">
        <div class="w-4/12">
          <input class="shadow appearance-none border-none placeholder-white rounded w-full py-2 px-3 text-white" id="" name="title" type="text" placeholder="Survey Name" style="background-color: #2B047E;">
        </div>
      </div>  
    
      <div class="pt-6 flex justify-center items-center">
        <div class="shadow-md rounded px-6 pt-6 pb-12 mb-1/2 w-6/12" style="background-color: #2B047E;">
          <div class="mb-1 w-7/12">
            <label class="block text-white text-sm font-bold mb-2">
              Point Reward
            </label>
            <label class="block text-white font-bold mb-2" style="font-size: 65px;">
              100 POINTS
            </label>
          </div>
        </div>
      </div>

      <div id="questions-container"></div>
      
      <div class="pt-6 flex justify-center items-center">
        <button type="button" onclick="addQuestion()" class="text-white font-bold py-2 px-4 rounded" style="background-color: #4417A3;">
          Add Question
        </button>
      </div>
      <div class="pt-6 flex justify-center items-center">
        <button type="submit" class="text-white font-bold py-2 px-4 rounded" style="background-color: #4417A3;">
          Create Survey
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
            <input class="shadow appearance-none border-none placeholder-white rounded w-3/4 py-2 px-3 text-white" name="questions[]" type="text" placeholder="Question Text" style="background-color: #4417A3;">
          </div>
          <input disabled class="shadow appearance-none border-none placeholder-white rounded w-full py-2 px-3 text-white" name="answers[]" type="text" placeholder="Write Your Answer Here" style="background-color: #4417A3;">
        </div>
      `;
      questionContainer.appendChild(newQuestion);
    }
  </script>
