<x-app-layout>
    <div class="min-h-screen h-fit items-center max-w-none-xl p-4" style="background: #3e06b6; color: #e3d6ff">
        <div class="shadow-md rounded mx-auto px-6 pt-6 pb-12 mb-1/2 w-11/12 mb-10" style="background-color: #2B047E;">
            <h1 class="text-3xl font-semibold mb-4">{{ $survey->title }} : {{ $survey->points }} points</h1>

            <div>
                Status :
                <span id="statusIndicator" class="ml-2">
                    @if ($survey->open == 1)
                        <span class="text-green-500">Open</span>
                    @else
                        <span class="text-red-500">Closed</span>
                    @endif
                </span>

                <button id="toggleStatus" onclick="toggleStatus()">
                    Toggle Status
                </button>
            </div>
        </div>

        <script>
            function toggleStatus() {
                var statusIndicator = document.getElementById('statusIndicator');
                var toggleButton = document.getElementById('toggleStatus');

                if (statusIndicator.textContent.trim() === 'Open') {
                    statusIndicator.innerHTML = '<span class="text-red-500">Closed</span>';
                    toggleButton.innerHTML = 'Open Survey';
                } else {
                    statusIndicator.innerHTML = '<span class="text-green-500">Open</span>';
                    toggleButton.innerHTML = 'Close Survey';
                }

                // Add logic to update the $survey->open accordingly (you might need to make an AJAX request here).
                // For simplicity, this example only updates the UI.
            }
        </script>


        @foreach ($questions as $question)
            @php
                $userResponses = []; // Reset the array for each question
            @endphp
            <div class="mb-4">
                @if ($question->question_type == 2)
                    <?php
                    // Extract the question text up until '[' character
                    $questionText = explode('[', $question->question)[0];
                    $chartId = 'chart_' . $question->id; // Unique identifier for each chart
                    preg_match_all('/\{(.*?)\}/', $question->question, $matches);
                    ?>

                    <div class="shadow-md rounded mx-auto px-6 pt-6 pb-12 mb-1/2 w-11/12"
                        style="background-color: #2B047E;">
                        <p class="text-xl font-semibold mb-2">{{ $questionText }}</p>


                        {{-- // getting answer array --}}
                        @foreach ($answer->where('question_id', $question->id) as $ans)
                            <?php $userResponses[] = $ans->answer; ?>
                        @endforeach


                        <div id="{{ $chartId }}" class="mt-8"></div>
                    </div>
                @else
                    <div class="shadow-md rounded mx-auto px-6 pt-6 pb-12 mb-1/2 w-11/12"
                        style="background-color: #2B047E;">
                        <p class="text-xl font-semibold mb-2">{{ $question->question }}</p>

                        <div style="overflow-y: auto; max-height: 200px;">
                            @foreach ($answer->where('question_id', $question->id) as $ans)
                                <p class="ml-4 mb-4" style="background-color: #43199f; padding: 10px; margin: 10px;">
                                    {{ $ans->answer }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            @if ($question->question_type == 2)
                <script type="text/javascript">
                    var userResponses = {!! json_encode($userResponses) !!};
                    var options = {!! json_encode($matches[1]) !!};

                    // Count the frequency of each choice
                    var choiceFrequency = userResponses.reduce(function(acc, choice) {
                        acc[choice - 1]++; // Choices are 1-indexed, so decrement to match array index
                        return acc;
                    }, Array(options.length).fill(0));

                    // Create data array for the histogram
                    var histogramData = choiceFrequency.map(function(frequency, index) {
                        return {
                            x: options[index],
                            y: frequency
                        };
                    });

                    // Update the options for the chart
                    var options = {
                        series: [{
                            name: 'Histogram',
                            data: histogramData
                        }],
                        chart: {
                            type: 'bar', // Change the chart type to 'bar' for a histogram
                            height: 300 // Adjust the height of the chart
                        },
                        plotOptions: {
                            bar: {
                                horizontal: true,
                                barHeight: '80%', // Adjust the height of the bars
                                colors: {
                                    ranges: [{
                                        from: 0,
                                        to: 0,
                                        color: '#ffffff' // Set the color of the bars
                                    }]
                                },
                            }
                        },
                        xaxis: {
                            title: {
                                text: 'Frequency',
                                style: {
                                    color: '#ffffff' // Set the color of the x-axis title
                                }
                            },
                            labels: {
                                style: {
                                    colors: '#ffffff' // Set the color of the x-axis labels
                                }
                            }
                        },
                        yaxis: {
                            labels: {
                                style: {
                                    colors: '#ffffff' // Set the color of the x-axis labels
                                }
                            }
                        },
                        fill: {
                            colors: ['#C885FF'] // Set the color of the bars
                        }
                    };

                    var chart = new ApexCharts(document.querySelector("#{{ $chartId }}"), options);
                    chart.render();
                </script>
            @endif
        @endforeach

        <div class="pt-6 flex justify-center items-center">
            <a href="{{url('/survey/delete/'.$survey->id)}}" class="text-white font-bold py-2 px-4 rounded"
                style="background-color: #4417A3;">
                Delete Survey
            </a>
        </div>
        <div class="pt-6 flex justify-center items-center">
            <a href="{{url('/survey/edit/'.$survey->id)}}" class="text-white font-bold py-2 px-4 rounded"
                style="background-color: #4417A3;">
                Edit Survey
            </a>
        </div>




    </div>
</x-app-layout>
