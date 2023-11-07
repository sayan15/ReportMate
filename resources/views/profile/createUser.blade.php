@vite(['resources/js/createUser.js'])
<x-app-layout>
    <div class="flex flex-col overflow-y-auto md:flex-row">
        <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
            <div class="w-full">
                <h1 class="mb-4 text-xl font-semibold text-gray-700">
                    Create user
                </h1>

                <form method="POST" action="{{ route('users.store') }}">
                @csrf

                    <div class="mt-4">
                        <x-input-label for="name" :value="__('Name')"/>
                        <x-text-input type="text"
                                 id="name"
                                 name="name"
                                 class="block w-full"
                                 value="{{ old('name') }}"
                                 required
                                 autofocus/>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')"/>
                        <x-text-input name="email"
                                 type="email"
                                 class="block w-full"
                                 value="{{ old('email') }}"/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="officer_location" :value="__('Location')"/>
                        <x-text-input type="text"
                                 id="officer_location"
                                 name="officer_location"
                                 class="block w-full"
                                 value="{{ old('officer_location') }}"
                                 required
                                 autofocus/>
                        <x-input-error :messages="$errors->get('officer_location')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="lng" :value="__('Longitude')"/>
                        <x-text-input type="text"
                                 id="lng"
                                 name="lng"
                                 class="block w-full"
                                 value="{{ old('lng') }}"
                                 required
                                 autofocus
                                 autocomplete="address"/>
                        <x-input-error :messages="$errors->get('lng')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="lat" :value="__('Latitude')"/>
                        <x-text-input type="text"
                                 id="lat"
                                 name="lat"
                                 class="block w-full"
                                 value="{{ old('lat') }}"
                                 required
                                 autofocus/>
                        <x-input-error :messages="$errors->get('lat')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')"/>
                        <x-text-input type="password"
                                 name="password"
                                 class="block w-full"
                                 required/>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label id="password_confirmation" :value="__('Confirm Password')"/>
                        <x-text-input type="password"
                                 name="password_confirmation"
                                 class="block w-full"
                                 required/>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-primary-button class="block w-full">
                            {{ __('Create') }}
                        </x-primary-button>
                    </div>

                </form>

                <hr class="my-8"/>

            </div>

        </div>
    </div>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>                     
    <script>(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries","places",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
        ({key: "AIzaSyByAswoRslfKGpkazLbYFtaXj33XGN53lE", v: "weekly"});</script>
    <script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>
</x-app-layout>
