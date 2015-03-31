
function surligne(champ, erreur)
{
   if(erreur)
      champ.style.backgroundColor = "#fba";
   else
      champ.style.backgroundColor = "#8793c9";
}

function verifPseudo(champ)
{
 $(".pseudo p").empty();
 if(champ.value.length < 2 || champ.value.length > 25)
 {
   $(".pseudo").append("<p class ='error'> Le pseudo doit avoir une longueur comprise entre 5 et 15 caractéres. </p>");
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
   $(".passwordDiv p").empty();
   if(champ.value.length < 2 || champ.value.length > 25)
   {
     $(".passwordDiv").append("<p class ='error'> Le mot de passe doit avoir une longueur comprise entre 5 et 15 caractéres. </p>");
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

   $(".nom p").empty();
   if(champ.value.length >= 2 && champ.value.length < 25)
   {
      if (regex.test(champ.value)){
         surligne(champ, false);
         return true;
      }
   }
   $(".nom").append("<p class ='error'> nom incorrect </p>");
   surligne(champ, true);  
   return false;
}


function verifFirstname(champ){
 var regex = /^[a-zA-Z]+$/;

 $(".prenom p").empty();
 if(champ.value.length >= 2 && champ.value.length < 25)
 {
   if (regex.test(champ.value)){
      surligne(champ, false);
      return true;
   }
}
$(".prenom").append("<p class ='error'> prenom incorrect </p>");
surligne(champ, true);
return false;
}


function verifBirthdate(champ){
 var regex = /^[0-9]{2,2}\/[0-9]{2,2}\/[0-9]{4,4}$/;

 $(".date p").empty();
 if (regex.test(champ.value)){
   surligne(champ, false);
   return true;
}
$(".date").append("<p class = 'error'>date incorrect (JJ/MM/AAAA) </p>");
surligne(champ, true);
return false;
}


function verifEmail(champ){
   var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;

   $(".email p").empty();
   if(!regex.test(champ.value))
   {
      $(".email").append("<p class ='error'> mail incorrect </p>");
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
}


function verifCorrespondanceMail(){

   var inputMail= document.getElementById('UserEmail');
   var inputMailConfirmation = document.getElementById('UserMailConfirmation');

   $(".emailConfirmation p").empty();

   if(!(inputMail.value==inputMailConfirmation.value)){

      $(".emailConfirmation").append("<p class ='error'> les 2 mails sont différents  </p>");
      surligne(inputMailConfirmation,true);
      return false;
   }
   surligne(inputMailConfirmation,false);
   return true;
}

function  verifCorrespondancePassword(){
   var inputPassword= document.getElementById('UserPassword');
   var inputPasswordConfirmation = document.getElementById('UserPasswordConfirmation');

   $(".mdpConfirmation p").empty();

   if(!(inputPassword.value==inputPasswordConfirmation.value)){

      $(".mdpConfirmation").append("<p class ='error'> les 2 mots de passes sont différents  </p>");
      surligne(inputPasswordConfirmation,true);
      return false;
   }
   surligne(inputPasswordConfirmation,false);
   return true;
}


function testerRadio(radio) {

 

   return false;
}


function verifGenre(){

   $(".gender p").empty();
   var y = document.getElementById("UserGender0").checked;
   var x = document.getElementById("UserGender1").checked;

   if(x||y){
      return true;
   }
   $(".gender").append("<p class ='error'> Choississez votre genre </p>");

}


// fonction principale vérification formulaire
function verifFormulaire(form){


   var nom = verifName(form.UserName);
   var prenom = verifFirstname(form.UserFirstname);
   var pseudo = verifPseudo(form.UserPseudo);
   var date = verifBirthdate(form.UserBirthdate);
   var password = verifPassword(form.UserPassword);
   var email = verifEmail(form.UserEmail);

   var sexe = verifGenre();

   var coresspondanceMail = false ;
   var coresspondancePassword = false;


   if(email)
      coresspondanceMail= verifCorrespondanceMail();

   if(password)
      coresspondancePassword = verifCorrespondancePassword();

   if(nom && prenom && pseudo && date && password && email && coresspondanceMail && coresspondancePassword && sexe){
      return true;
   }
   return false;
}




