
function surligne(champ, erreur)
{
   if(erreur)
      champ.style.backgroundColor = "#fba";
   else
      champ.style.backgroundColor = "#8793c9";
}

function verifPseudo(champ)
{
   if(champ.value.length < 2 || champ.value.length > 25)
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
}

function verifPassword(champ){
 if(champ.value.length < 2 || champ.value.length > 25)
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
}

function verifName(champ){
   var regex = /^[a-zA-Z]+$/;
   if(champ.value.length >= 2 && champ.value.length < 25)
   {
      if (regex.test(champ.value)){
         surligne(champ, false);
         return true;
      }
   }
   surligne(champ, true);
   return false;
}


function verifFirstname(champ){
 var regex = /^[a-zA-Z]+$/;
   if(champ.value.length >= 2 && champ.value.length < 25)
   {
      if (regex.test(champ.value)){
         surligne(champ, false);
         return true;
      }
   }
   surligne(champ, true);
   return false;
}


function verifBirthdate(champ){
 var regex = /^[0-9]{2,2}\/[0-9]{2,2}\/[0-9]{4,4}$/;

      if (regex.test(champ.value)){
         surligne(champ, false);
         return true;
      }
   
   surligne(champ, true);
   return false;
}


function verifEmail(champ){
var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
 if(!regex.test(champ.value))
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
}



function verifFormulaire(form){


var nom = verifName(form.nom);
var prenom = verifFirstname(form.prenom);
var pseudo = verifPseudo(form.pseudo);
var date = verifBirthdate(form.date);
var password = verifPassword(form.password);
var mail = verifEmail(form.email);

if(nom && prenom && pseudo && date && password && mail){
   return true;
}
return false;
}
