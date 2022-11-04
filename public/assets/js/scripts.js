$(document).ready(function () {
    $('[id*=TD-').hover(function () {
        let region = $(this);
        let regionId = $(this)[0].id.substr(0, 5);
        let regionName = $(this)[0].id.substr(6);
        let allRegion = $('[id*=TD-');
        infosRegion = $('.map__infos #infosRegion');
        var populationRegion = $('.map__infos #populationRegion');
        var thresholdRegion = $('.map__infos #thresholdRegion');

         let TAllRegion=[];
         let TidRegion=[];
         let TNomRegion=[];
         let TPopulation=[];
         let TThreshold=[];
         
         var request = new XMLHttpRequest();
         request.open('GET', '/card', true);
         request.onreadystatechange = function () {
            if (this.readyState == 4 && (this.status == 200 | this.status == 0)) {
                let data = JSON.parse(this.response);
                TAllRegion =Object.entries(data.Regions);

                for (let index = 0; index < TAllRegion.length; index++) {
                    TidRegion.push(TAllRegion[index][1].idRegion);
                    TNomRegion.push(TAllRegion[index][1].nomRegion);
                    TPopulation.push(TAllRegion[index][1].populations);
                    TThreshold.push(TAllRegion[index][1].threshold);
                }
                for(i = 0; i< TidRegion.length; i++){ 
                        if(TidRegion[i]==regionId){
                            infosRegion.text("Region-> " + TNomRegion[i]);
                            populationRegion.text("Population-> " +TPopulation[i]);
                            // $(".map__image path").css("fill", "red");
                        }
                    }
            }else if (this.readyState < 4) {
                    //alert("erreur");
            }
         }
         request.send();
         request = null;
    });
})