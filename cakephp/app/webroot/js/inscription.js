
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
   $(".pseudo").append("<p class ='error'> pseudo incorrect (entre 2 et 25 caractères) </p>");
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
   $(".password p").empty();
   if(champ.value.length < 2 || champ.value.length > 25)
   {
    $(".pseudo").append("<p class ='error'> mot de passe incorrect (entre 2 et 25 caractères) </p>");
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

   var inputMail= document.getElementById('email');
   var inputMailConfirmation = document.getElementById('mailConfirmation');

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
   var inputPassword= document.getElementById('password');
   var inputPasswordConfirmation = document.getElementById('passwordConfirmation');

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
  var y = document.getElementById("gender0").checked;
    var x = document.getElementById("gender1").checked;

if(x||y){
   return true;
}
      $(".gender").append("<p class ='error'> Choississez votre genre </p>");

}


// fonction principale vérification formulaire
function verifFormulaire(form){


   var nom = verifName(form.nom);
   var prenom = verifFirstname(form.prenom);
   var pseudo = verifPseudo(form.pseudo);
   var date = verifBirthdate(form.date);
   var password = verifPassword(form.password);
   var email = verifEmail(form.email);

   var sexe = verifGenre();

   var coresspondanceMail = false ;
   var coresspondancePassword = false;


   if(email)
      coresspondanceMail= verifCorrespondanceMail();

   if(password)
      coresspondancePassword = verifCorrespondancePassword();

   if(nom && prenom && pseudo && date && password && email && verifCorrespondanceMail && verifCorrespondancePassword && sexe){
      return true;
   }
   return false;
}
