
@vite(['resources/js/map.js'])
<script type="text/javascript">
    var locations = <?php echo json_encode($locations); ?>;
</script>
<x-app-layout>
    
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" id="app">
                <div class="z-depth-1-half map-container" style="height: 500px" id="map">

                </div>
            </div>
        </div>
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>                     
        <script>(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
            ({key: "AIzaSyByAswoRslfKGpkazLbYFtaXj33XGN53lE", v: "weekly"});</script>
        
    
        <script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>
    


    <div class="p-4 bg-white rounded-lg shadow-xs">
        {{ __('You are logged in!') }}
    </div>
</x-app-layout>