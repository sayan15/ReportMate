@vite(['resources/js/firebaseMessagingService.js'])

<script type="text/javascript">
    var status = <?php echo ($status); ?>;

  </script>
<x-app-layout>
    <x-slot name="header">
        {{ __('Send Notification') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs" id="main_container">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            {{ __('Notification details') }}
        </h2>
                <!-- Form Start -->
                <form method="POST" action="{{ route('notification.send') }}">
                    @csrf
                        <x-input-label for="crimeInput" :value="__('Incident')" />
                        <x-text-input type="text"
                                    id="crimeInput"
                                    name="crimeInput"
                                    class="block w-full"
                                    value="{{ old('crimeInput') }}"
                                    placeholder="eg:- Theft happned at"
                                    required
                                    autofocus />
                        <x-input-error :messages="$errors->get('crimeInput')" class="mt-2" />

                    <!-- Location Input -->

                        <x-input-label for="locationInput" :value="__('Location')" />
                        <x-text-input type="text"
                                    id="locationInput"
                                    name="locationInput"
                                    class="block w-full"
                                    value="{{ old('locationInput') }}"
                                    placeholder="NN5 5AW"
                                    required />
                        <x-input-error :messages="$errors->get('locationInput')" class="mt-2" />

                
                    <!-- Latitude Input -->

                        <x-input-label for="latitudeInput" :value="__('Latitude')" />
                        <x-text-input type="text" 
                                    id="latitudeInput"
                                    name="latitudeInput"
                                    class="block w-full"
                                    value="{{ old('latitudeInput') }}"
                                    required 
                                    pattern="^-?[0-9]*[.,]?[0-9]+$" 
                                    title="Please enter a valid number." />
                        <x-input-error :messages="$errors->get('latitudeInput')" class="mt-2" />

                
                    <!-- Longitude Input -->

                        <x-input-label for="longitudeInput" :value="__('Longitude')" />
                        <x-text-input type="text"
                                    id="longitudeInput"
                                    name="longitudeInput"
                                    class="block w-full"
                                    value="{{ old('longitudeInput') }}"
                                    required 
                                    pattern="^-?[0-9]*[.,]?[0-9]+$" 
                                    title="Please enter a valid number." />
                        <x-input-error :messages="$errors->get('longitudeInput')" class="mt-2" />

                
                    <!-- Submit Button -->
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ml-4">
                            {{ __('Submit') }}
                        </x-primary-button>
                    </div>
                </form>
                
                <!-- Form End -->
        

    </div>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>                     
    <script>(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries","places",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
        ({key: "AIzaSyByAswoRslfKGpkazLbYFtaXj33XGN53lE", v: "weekly"});</script>
    <script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>
</x-app-layout>