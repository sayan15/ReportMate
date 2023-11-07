<script type="text/javascript">
  var Speclocation = <?php echo json_encode($locations); ?>;
  const imageUrls = <?php echo json_encode($imageUrls); ?>;
  const userlocation= <?php echo json_encode($userLocation); ?>;
  console.log(userlocation);
</script>

@vite(['resources/js/map.js'])
<x-app-layout>
    <x-slot name="header">
        {{ __('Incident Details') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
          <form class="w-full max-w-full" action="{{ route('map.store') }}" method="POST">
            @csrf
            @method('patch')
            <input type="hidden" name="key" value="{{$locations[0]['key']}}">
            <div class="flex flex-nowrap -mx-3 mb-6">
              <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0 mx-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-longitude">
                  Longitute
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-longitude" type="text"  value={{$locations[0]['lat']}} readonly>
                
              </div>
              <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-latitude">
                  Latitude
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-latitude" type="text" value={{$locations[0]['lng']}} readonly>
              </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3 mb-6 md:mb-0 mx-3">
                    <label for="message" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Describtion</label>
                    <textarea id="message" rows="4" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Incident description" readonly>{{$locations[0]['description']}}</textarea>
                </div>
            </div>
            <div class="flex flex-nowrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0 mx-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-status">
                        Change Status
                    </label>
                    <div class="flex flex-nowrap mx-1 mb-6">
                      <select name="status" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white text-lg font-semibold hover:bg-white hover:shadow-md hover:border-blue-500" id="grid-status">
                        <option value="no" @if ($locations[0]['status'] == 'no') selected @endif>Not Attended</option>
                        <option value="accessed" @if ($locations[0]['status'] == 'accessed') selected @endif>Attended</option>
                    </select>
                        <x-primary-button type="submit" class="ml-3 hover:bg-blue-600" style="width: 160px; height: 48px;font-size: 10px;">
                            {{ __('Change Status') }}
                        </x-primary-button>

                  </div>

                </div>
            </div>

            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3 mb-6 md:mb-0 mx-3">
                <div class="w-72 h-52 border border-gray-300 rounded-lg overflow-hidden shadow-lg">
                  @if(count($imageUrls) > 0)
                    
                    <img class="w-full h-full object-cover" id="image" src="{{asset('images/image-2@2x.jpg')}}" alt="image description">

                  @else
                    <img class="w-full h-full object-cover" id="image" src="{{asset('images/image-2@2x.jpg')}}" alt="image description">                  
                  @endif     
                </div>   
                <button id="prev-btn" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700" type="button">Previous</button>
                <button id="next-btn" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700"  type="button">Next</button>                          
              </div>
            </div>

            <div class="py-12">
              <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" id="app">
                  <div class="z-depth-1-half map-container" style="height: 500px" id="map">
  
                  </div>
              </div>
            </div>
            <div class="flex flex-nowrap -mx-3 mb-6">
              <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0 mx-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-distance">
                  Total Distance
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-distance" type="text"  readonly>
                
              </div>
            </div>
            <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>                     
            <script>(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
                ({key: "AIzaSyByAswoRslfKGpkazLbYFtaXj33XGN53lE", v: "weekly"});</script>
            
        
            <script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>
        </form>
    </div>
</x-app-layout>