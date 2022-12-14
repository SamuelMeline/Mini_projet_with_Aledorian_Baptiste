//get lattitude + longitude onLoad  

        const lat = document.querySelector("#lat");
        const long = document.querySelector("#long");  
        
        const btnPos = document.querySelector("#btnPos");
        
        if(lat){
            navigator.geolocation.getCurrentPosition((position) => {
                lat.value = position.coords.latitude;
                long.value = position.coords.longitude;
                return position;
            }, (error) => {
                console.error(error);
            });
        }

        let events = document.querySelectorAll(".event span");
        
        //Afichage d'une map interactive centrée sur la France
        let map = L.map('map').setView([46.603354, 1.8883335], 5);  
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        
        //recupération des position pour affichage sur la map
        for (let pos of events){
            position = (pos.innerText.split(" "))
            L.marker([position[1], position[0]]).addTo(map)
        }



        
        

        // console.log(map)

