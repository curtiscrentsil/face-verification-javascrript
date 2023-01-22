const webcamelement = document.getElementById("webcam");
const canvaselemnt = document.getElementById("webcanvas");
const webcam = new Webcam(webcamelement, "user", canvaselemnt);
const webcamelement2 = document.getElementById("webcam2");
const canvaselemnt2 = document.getElementById("webcanvas2");
const webcam2 = new Webcam(webcamelement2, "user", canvaselemnt2);

var p1 = ""; //GLOBAL VARIABLE
var p2 = ""; //GLOBAL VARIABLE

document.getElementById("bio").addEventListener("click", () => {
  document.getElementById("biometrics").style.display = "flex";
});
document.getElementById("scan1").addEventListener("click", () => {
  webcam.start();
});
document.getElementById("scan2").addEventListener("click", () => {
  webcam2.start();
});

document.getElementById("ko").addEventListener("click", () => {
  let picture = webcam.snap();
  p1 = picture;
  console.log(picture);
  document.getElementById("webcam").style.display = "none";
});

document.getElementById("ko2").addEventListener("click", () => {
  let picture = webcam2.snap();
  p2 = picture;
  console.log(picture);
  document.getElementById("webcam2").style.display = "none";
});

// /////////////////////////////////////////
document.getElementById("submit").addEventListener("click", () => {
  const formdata = new FormData();
  let email = document.getElementById("email").value;
  let password = document.getElementById("password").value;
  let username = document.getElementById("username").value;

  //   console.log(p1);
  formdata.append("p1", p1);
  formdata.append("p2", p2);
  formdata.append("email", email);
  formdata.append("password", password);
  formdata.append("username", username);

  fetch("register.php", {
    method: "POST",
    body: formdata,
  })
    .then((res) => res.text())
    .then((data) => {
      if (data == 1) {
        alert("Signup successfully");
       setTimeout(() => {
        location.href = "login.html"
       }, 1000);
      } else if (data == 2) {
        alert("Email already exist");
      } else if (data == 3) {
        alert("Phone Number Has Already Been Used");
      } else if (data == 4) {
        alert("phoneintication code does not exist");
      } else {
        alert("check Connection and try again");
        console.log(data);
      }
    });
});
