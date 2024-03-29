<head>@vite(['resources/css/tailwind.output.css','resources/js/dashboard.js'])</head>
<script type="text/javascript">
  var locations = <?php echo json_encode($incidentLocations); ?>;
</script>
<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>
    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">

        <!-- Card -->
        <div
          class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
        >
          <div
            class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500"
          >
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" clip-rule="evenodd" 
        d="M12 1L1 21h22L12 1zm1 14v-4h-2v4h2zm0 2v-2h-2v2h2z" 
        fill="#FFED00"/>
            </svg>
          </div>
          <div>
            <p
              class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"
            >
              Total Incidents
            </p>
            <p
              class="text-lg font-semibold text-gray-700 dark:text-gray-200" id="total_Incidents"
            >
              0
            </p>
          </div>
        </div>
        <!-- Card -->
        <div
          class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
        >
          <div
            class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500"
          >
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path
                d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"
              ></path>
            </svg>
          </div>
          <div>
            <p
              class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400" 
            >
              New Incidents
            </p>
            <p
              class="text-lg font-semibold text-gray-700 dark:text-gray-200" id="new_Incidents"
            >
              0
            </p>
          </div>
        </div>
        <!-- Card -->
        <div
          class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
        >
          <div
            class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500"
          >
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path
                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"
              ></path>
            </svg>
          </div>
          <div>
            <p
              class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"
            >
              In progress
            </p>
            <p
              class="text-lg font-semibold text-gray-700 dark:text-gray-200" id="inProgess_Incidents"
            >
              0
            </p>
          </div>
        </div>
        <!-- Card -->
        <div
          class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
        >
          <div
            class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500"
          >
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path
                fill-rule="evenodd"
                d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z"
                clip-rule="evenodd"
              ></path>
            </svg>
          </div>
          <div>
            <p
              class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"
            >
              Closed Incidents
            </p>
            <p
              class="text-lg font-semibold text-gray-700 dark:text-gray-200" id="closed_Incidents"
            >
              0
            </p>
          </div>
        </div>

      </div>

    
      <div class="relative overflow-x-auto overflow-y-auto shadow-md sm:rounded-lg" style="max-height: 400px;">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Location
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Incident Time
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Monitored Time
                    </th>
                    <th scope="col" class="px-6 py-3">
                      Officer
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                  @foreach ($incidentLocations as $key => $location)
                  <tr>
                      <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $location['title'] }}
                      </th>
                      <td class="px-6 py-4">
                          {{ $location['description'] }}
                      </td>
                      <td class="px-6 py-4">
                        {{ $location['status'] }}
                      </td>
                      <td class="px-6 py-4">
                          {{ $location['generated_at'] }}
                      </td>
                      <td class="px-6 py-4">
                        {{ $location['updated_at'] }}
                      </td>
                      <td class="px-6 py-4">
                        {{ $location['officer'] }}
                      </td>
                      <td class="px-6 py-4">
                        <a href="{{ route('map.getIncident', ['key' => $location['key']]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                      </td> 
                  </tr>
                  @endforeach
                </tr>
            </tbody>
        </table>
      </div>

</x-app-layout>
