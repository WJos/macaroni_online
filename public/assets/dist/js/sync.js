function post_sync(){

           //alert("data");
           var pin=document.getElementById('getpin').value;
           var id=localStorage.getItem("idpack");
           var montant=localStorage.getItem("montantpack");
           var data = {"pin" : pin,"id" : id,"montant" : montant};
           alert(data['montant']);
           var url=base_url+"Compte/confirm_achat";
           var result = post_ajax(url,data);
           //alert(result);
           var details = JSON.parse(result);
           //$('#plan').html(details);

       }


function get_sync(data){

           //alert(data);
           var d = data;
           var data = {"idclient" : d};
           var url=base_url+"Admin/activ_user";
           var result = post_ajax(url,data);
           //alert(result);
           var details = JSON.parse(result);
           //$('#plan').html(details);

       }
function desact_user(data){

           //alert("data");
           
           var data = {"idclient" : data};
           var url=base_url+"Admin/desact_user";
           var result = post_ajax(url,data);
           //alert(result);
           var details = JSON.parse(result);
           //$('#plan').html(details);

       }


function devenir(id,dat){

           //alert(id);
           //alert(dat);
           
           var data = {"idclient" : id, "fonction" : dat};
           var url=base_url+"Admin/devenir";
           var result = post_ajax(url,data);
           //alert(result);
           var details = JSON.parse(result);
           //$('#plan').html(details);

       }

function requett(data){

           alert(data);
           var motif = $('#motif').val();
           
           var data = {"motif" : motif,"fonction" : data};
           var url=base_url+"Compte/requett";
           var result = post_ajax(url,data);
           //alert(result);
           var details = JSON.parse(result);
           //$('#plan').html(details);

       }



function validemande(data){

           //alert(data);          
           var data = {"idclient" : data};
           var url=base_url+"Admin/validemande";
           var result = post_ajax(url,data);
           //alert(result);
           location.reload();
           var details = JSON.parse(result);
           //reload();
           //$('#plan').html(details);
       }

function annuldemande(data){

           //alert(data);          
           var data = {"idclient" : data};
           var url=base_url+"Admin/annuldemande";
           var result = post_ajax(url,data);
           //alert(result);
           location.reload();
           var details = JSON.parse(result);
           //reload();
           //$('#plan').html(details);
       }






   function load_pack_enreg_tab(){
       //var q = q;
       //var start = start;
   var xhr=createXmlHttpRequestObject();
   
   xhr.onreadystatechange = function p(){
       // On ne fait quelque chose que si on a tout reèµ et que le serveur est ok
       if(xhr.readyState ==4 && xhr.status == 200){
               donnees = xhr.responseText;
               
               //alert(donnees);
          
       // On se sert de innerHTML pour rajouter les options a la liste
       //alert(type);
       //var details = JSON.parse(result);
       alert(donnees);
       document.getElementById('pack_enreg').innerHTML =donnees;
       //alert(details);
       // if (type == 'Depot') {
       //     document.getElementById('corpsvalidation').innerHTML =donnees;
       // } else {
       //     document.getElementById('corpsretraitvalidation').innerHTML =donnees;
       // }
       
       }

   }
   xhr.open("POST",base_url+"Tab/enreg_tab",true);
   // ne pas oublier è¡ pour le post
   xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
   xhr.send();
}


function lespays(){
   //alert(document.getElementById('countryCode').value(2));
   //alert($('#countryCode').val());

}



function post_ajax(url, data) {
   var result = '';
   $.ajax({
       type: "POST",
       url: url,
       data: data,
       success: function(response) {
           result = response;
           //location.reload();
       },
       error: function(response) {
           result = 'error';
       },
       async: false
       });
       
       return result;
}