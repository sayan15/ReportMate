@vite(['resources/js/report.js'])
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
    var incidents = <?php echo json_encode($incidentLocations); ?>;

  </script>

<x-app-layout>
    <x-slot name="header">
        {{ __('Reports') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs" id="main_container">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            {{ __('Crime Reports Visualization') }}
        </h2>
        <div style="height:300px;display: flex; flex-direction: row; justify-content: center; align-items: center;">
            <!-- Your child elements go here -->
            <div class="pie-chart" style="height:300px;flex: 1; padding: 10px;">
                <canvas id="piechart"></canvas>
            </div>

            <div class="bar-chart" style="height:300px;flex: 1; padding: 10px;">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>

</x-app-layout>
