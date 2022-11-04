        var map = document.querySelector('#map');
        var paths = map.querySelectorAll('.map__image a');
        var infosRegion = map.querySelector('.map__infos #infosRegion');
        var populationRegion = map.querySelector('.map__infos #populationRegion');
        var thresholdRegion = map.querySelector('.map__infos #thresholdRegion');

        paths.forEach(function (path) {
            path.addEventListener('mouseenter', function (e) {
                //TRAITEMENT DES DONNEES VENANT DU FICHIER SVG
                var idandname = this.id;
                var id = idandname.substr(0, 5);
                var name = idandname.substr(6);
                //TRAITEMENT DES DONNEES VENANT DE LA BASE DE DONNEE
                let TidRegion=[];
                let TNomRegion=[];
                let TPopulation=[];
                let TThreshold=[];

                var r={{donnees|raw}}; //DONNEES DU BD
                //TRAITEMENTS DES DONNEES
                 for (i = 0; i < r.length; i++) { 
                    TidRegion.push(r[i][0]);
                    TNomRegion.push(r[i][1]);
                    TPopulation.push(r[i][2]);
                    TThreshold.push(r[i][3]);
                }
                for(i = 0; i< TidRegion.length; i++){ 
                        if(TidRegion[i]==id){
                            //console.log(TidRegion[i])
                            infosRegion.textContent = "Region-> " + TNomRegion[i];
                            populationRegion.textContent = "Population-> " +TPopulation[i];
                            //console.log(TThreshold[i])
                        }
                    }



                //infosRegion.textContent = name

                



           

            })
            



        })