const webcamelement = document.getElementById("webcam");
const canvaselemnt = document.getElementById("webcanvas");
const webcam = new Webcam(webcamelement, "user", canvaselemnt);

var p1 = ""; //GLOBAL VARIABLE

document.getElementById("bio").addEventListener("click", () => {
  document.getElementById("biometrics").style.display = "flex";
});
document.getElementById("scan1").addEventListener("click", () => {
  webcam.start();
});

document.getElementById("submit").addEventListener("click", (e) => {
  e.preventDefault();
  let loginEmail = document.getElementById("email");
  let loginPassword = document.getElementById("password");
  const formdata = new FormData();

  if (!loginEmail.value) {
    alert("enter an emial address");
  } else if (loginPassword.value == "" || loginPassword.value == " ") {
    alert("enter a password");
  } else {
    formdata.append("email", loginEmail.value);
    formdata.append("password", loginPassword.value);
    fetch("connectuser1.php", { method: "POST", body: formdata })
      .then((res) => res.text())
      .then((data) => {
        console.log(data);

        if (data == 1) {
          location.href = "./profile.html";
        } else if (data == 2) {
          alert("password is wrong");
        } else if (data == 3) {
          alert("email does not exist");
        } else {
          alert("check your connection and try again");
        }
      });
  }
});

//////////////////////////////////////
//RECOGNIZING THE USER👇
//////////////////////////////////////

fetch("getFolders.php", {
  method: "GET",
})
  .then((res) => res.text())
  .then((data) => {
    const imageUpload = document.getElementById("imageUpload");

    function b64toBlob(dataURI) {
      var byteString = atob(dataURI.split(",")[1]);
      var ab = new ArrayBuffer(byteString.length);
      var ia = new Uint8Array(ab);

      for (var i = 0; i < byteString.length; i++) {
        ia[i] = byteString.charCodeAt(i);
      }
      return new Blob([ab], { type: "image/jpeg" });
    }

    // console.log(data);
    Promise.all([
      faceapi.nets.faceRecognitionNet.loadFromUri("/models"),
      faceapi.nets.faceLandmark68Net.loadFromUri("/models"),
      faceapi.nets.ssdMobilenetv1.loadFromUri("/models"),
    ]).then(start);

    async function start() {
      const container = document.createElement("div");
      container.style.position = "relative";
      document.body.append(container);
      console.log(data);
      const labeledFaceDescriptors = await loadLabeledImages(data);
      const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors, 0.6);
      let canvas;
      let image;
      document.body.append("Loaded");

      document.getElementById("ko").addEventListener("click", async () => {
        let picture = webcam.snap();
        p1 = picture;

        // console.log(picture);
        // console.log(b64toBlob(p1));
        document.getElementById("biometrics").style.display = "none";

        if (image) image.remove();
        if (canvas) canvas.remove();
        // image = await faceapi.bufferToImage(imageUpload.files[0]);
        image = await faceapi.bufferToImage(b64toBlob(p1));
        canvas = faceapi.createCanvasFromMedia(image);
        container.append(canvas);
        container.append(image);
        const displaySize = { width: image.width, height: image.height };
        faceapi.matchDimensions(canvas, displaySize);
        const detections = await faceapi
          .detectAllFaces(image)
          .withFaceLandmarks()
          .withFaceDescriptors();
        const resizedDetections = faceapi.resizeResults(
          detections,
          displaySize
        );
        const results = resizedDetections.map((d) =>
          faceMatcher.findBestMatch(d.descriptor)
        );
        results.forEach((result, i) => {
          const box = resizedDetections[i].detection.box;
          const drawBox = new faceapi.draw.DrawBox(box, {
            label: result.toString(),
          });
          drawBox.draw(canvas);
          console.log(result.toString().split("(")[0]);

          const formdata = new FormData();

          formdata.append("email", result.toString().split("(")[0]);
          fetch("connectuserBio.php", { method: "POST", body: formdata })
            .then((res) => res.text())
            .then((data) => {
              console.log(data);

              if (data == 1) {
                alert("WELCOME " + result.toString().split("(")[0]);
                setTimeout(() => {
                  location.href = "./profile.html";
                }, 700);
                console.log("login");
              } else if (data == 2) {
                alert("password is wrong");
              } else if (data == 3) {
                alert("email does not exist");
              } else {
                alert("check your connection and try again");
              }
            });
        });
      });
    }
  });

function loadLabeledImages(data) {
  // const labels = ["curtiscrentsil"]
  const labels = JSON.parse(data);
  return Promise.all(
    labels.map(async (label) => {
      const descriptions = [];
      for (let i = 1; i <= 2; i++) {
        const img = await faceapi.fetchImage(
          `${location.href}labeled_images/${label}/${i}.png`,
          { mode: "no-cors" }
        );
        // const img = await faceapi.fetchImage(`https://raw.githubusercontent.com/WebDevSimplified/Face-Recognition-JavaScript/master/labeled_images/${label}/${i}.jpg`)
        const detections = await faceapi
          .detectSingleFace(img)
          .withFaceLandmarks()
          .withFaceDescriptor();
        descriptions.push(detections.descriptor);
      }

      return new faceapi.LabeledFaceDescriptors(label, descriptions);
    })
  );
}


