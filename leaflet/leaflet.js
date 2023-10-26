            var mapAttr ="";
            var osmUrl="https://{s}.tile.osm.org/{z}/{x}/{y}.png";
            var osm = L.tileLayer(osmUrl, {attribution : mapAttr});

            var cartodbUrl = "https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png";
            var cartodb = L.tileLayer(cartodbUrl, {
                attribution : mapAttr,
                subdomains : "abcd",
                maxZomm : 19
                });

            //esri
            var esriUrl="https://tile.openstreetmap.org/{z}/{x}/{y}.png";
            var Esri_WorldImagery = L.tileLayer(esriUrl, {attribution : mapAttr});

            var baseLayers = {
                "CartoDB Light": cartodb,
                //"Openstreet Map (BW)": osm,
                "ESRI Imagery":Esri_WorldImagery,
                //"OpenTopomap": OpenStreetMap_BZH,
                            
            };

            var mymap = L.map("map",{
               
                zoom: 200,
                //minZoom:3,
                layers:[Esri_WorldImagery]
            }).setView([-1.6772971,29.2298003], 200);

            var overlays = {
            };

            basemapUrl = 'https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png';
  var basemap = new L.TileLayer(basemapUrl,  {minZoom: 0, maxZoom:13});
  var minMap = new L.Control.MiniMap(basemap).addTo(mymap);

             var controllLayers = L.control.layers(baseLayers, overlays, {collapsed: true}).addTo(mymap);

            mymap.on("mousemove", function(e){
                
                $(".map-coordinate").html("Lat : " + e.latlng.lat + "<br/>Long : " + e.latlng.lng);
            });

            var toggleBtn = document.getElementById("btnitineraire");
            var form = document.getElementById("list_itineraire");

            toggleBtn.addEventListener("click", function() {
              if (form.style.display === "none") {
                form.style.display = "block";
                //toggleBtn.textContent = "Masquer le formulaire";
              } else {
                form.style.display = "none";
                //toggleBtn.textContent = "Afficher le formulaire";
              }
            });
