const form = document.getElementById("form");
const errorEmail = document.getElementById("erroremail");

form.addEventListener("submit", function(event) {
  
  const email = form.email.value; 
  
  if (email.endsWith("@gmail.com")||email.endsWith("@outlook.com")){
    errorEmail.style.display = "none";
    console.log(email);
  }else{
    event.preventDefault();
    errorEmail.textContent = "Los dominios del correo deben ser @gmail.com/@outlook.com !";
    errorEmail.style.display = "block";
  }
});
