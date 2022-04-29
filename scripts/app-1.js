app.js
Quem pode acessar

Propriedades do sistema
Tipo
JavaScript
Tamanho
8 KB
Armazenamento usado
8 KB
Local
public
Proprietário
eu
Modificado
2 de fev. de 2022 por mim
Aberto
03:20 por mim
Criado em
2 de fev. de 2022 com o Google Drive Web
Adicionar uma descrição
Os leitores podem fazer o download
var wrapper = document.getElementById("signature-pad");
var wrapper_1 = document.getElementById("signature-pad-client");

var enviarFormBtn = document.getElementById("enviar-form");
var assinaturaModalAdmin = document.getElementById('assinatura');
var modalClose = document.getElementById("modalClose")

var clearButton = wrapper.querySelector("[data-action=clear]");
var clearButton_1 = wrapper_1.querySelector("[data-action=clear_1]");
var savePNGButton = wrapper.querySelector("[data-action=save-png]");
var savePNGButton_1 = wrapper_1.querySelector("[data-action=save_1-png]");

var canvas = wrapper.querySelector("canvas");
var canvas_client = document.getElementById("client-pad");



// =================================================================

let saveAdmin = document.getElementById("save_admin");
let signatureClient = document.getElementById("signature-pad-client");
let signatureAdmin = document.getElementById("signature-pad");
let backBtn = document.getElementById("back_1");
let cancelBtn = document.getElementById("back_0");

let showSucess = wrapper.querySelector("h1 i");
let showSucess_1 = wrapper_1.querySelector("h1 i");
let avancarBtn = document.getElementById("avancar_admin");

// ================================================================




var signaturePad = new SignaturePad(canvas, {
  // It's Necessary to use an opaque color when saving image as JPEG;
  // this option can be omitted if only saving as PNG or SVG
  backgroundColor: 'rgb(255, 255, 255)'
});

var signaturePad_1 = new SignaturePad(canvas_client, {
  // It's Necessary to use an opaque color when saving image as JPEG;
  // this option can be omitted if only saving as PNG or SVG
  backgroundColor: 'rgb(255, 255, 255)'
});


// Adjust canvas coordinate space taking into account pixel ratio,
// to make it look crisp on mobile devices.
// This also causes canvas to be cleared.
function resizeCanvas() {

  var ratio = Math.max(window.devicePixelRatio || 1, 1);

  // This part causes the canvas to be cleared
  canvas.width = canvas.offsetWidth * ratio;
  canvas.height = canvas.offsetHeight * ratio;
  canvas.getContext("2d").scale(ratio, ratio);

  // This part causes the canvas to be cleared
  canvas_client.width = canvas_client.offsetWidth * ratio;
  canvas_client.height = canvas_client.offsetHeight * ratio;
  canvas_client.getContext("2d").scale(ratio, ratio);

  signaturePad.clear();
  signaturePad_1.clear();
}

// On mobile devices it might make more sense to listen to orientation change,
// rather than window resize events.
window.onresize = resizeCanvas;
resizeCanvas();

function download(dataURL, filename) {
  if (navigator.userAgent.indexOf("Safari") > -1 && navigator.userAgent.indexOf("Chrome") === -1) {
    window.open(dataURL);
  } else {
    var blob = dataURLToBlob(dataURL);
    var url = window.URL.createObjectURL(blob);

    var a = document.createElement("a");
    a.style = "display: none";
    a.href = url;
    a.download = filename;

    document.body.appendChild(a);
    a.click();

    window.URL.revokeObjectURL(url);
  }
}

// One could simply use Canvas#toBlob method instead, but it's just to show
// that it can be done using result of SignaturePad#toDataURL.
function dataURLToBlob(dataURL) {
  // Code taken from https://github.com/ebidel/filer.js
  var parts = dataURL.split(';base64,');
  var contentType = parts[0].split(":")[1];
  var raw = window.atob(parts[1]);
  var rawLength = raw.length;
  var uInt8Array = new Uint8Array(rawLength);

  for (var i = 0; i < rawLength; ++i) {
    uInt8Array[i] = raw.charCodeAt(i);
  }

  return new Blob([uInt8Array], { type: contentType });
}





clearButton.addEventListener("click", function (event) {
  signaturePad.clear();
  showSucess.style.display = "none";
  saveAdmin.style.display = "inline";
  saveAdmin.style.opacity = "1";
  saveAdmin.style.pointerEvents = "auto";
  avancarBtn.style.display = "none";
});

clearButton_1.addEventListener("click", function (event) {
  signaturePad_1.clear();
  showSucess_1.style.display = "none";
  savePNGButton_1.style.opacity = "1";
  savePNGButton_1.style.pointerEvents = "auto";
  // save.style.display = "inline";
  // avancarBtn.style.display = "none";
});

// =========================Save Part=============================================

savePNGButton.addEventListener("click", function (event) {


  if (signaturePad.isEmpty()) {
    alert("Por favor, precisa assinar primeiro.");
  } else {

    var dataURL = signaturePad.toDataURL();
    // var blob = dataURLToBlob(dataURL);

    obj = {};
    obj["signature"] = dataURL;

    var data = JSON.stringify(obj);


    axios({
      method: 'post',
      url: "signature-pad",
      data: {
        assinatura: data
      },
      headers: {
        'Content-Type': 'application/json; charset=utf-8'
      }
    })
      .then(res => {
        if (res.data == "sucesso") {

          if (!wrapper.classList.contains("pad-corretiva")) {

            avancarBtn.style.display = "inline";
            saveAdmin.style.display = "none";

            avancarBtn.addEventListener("click", () => {
              setTimeout(() => {
                avancar();
              }, 300);
            })
          } {
            saveAdmin.style.opacity = ".5";
            saveAdmin.style.pointerEvents = "none";
          }
          showSucess.style.display = "inline";
        }
      })
      .catch(err => console.error(err));

  }
});

// ---------------------Client part --------------------------------------

savePNGButton_1.addEventListener("click", function (event) {
  if (signaturePad_1.isEmpty()) {
    alert("Por favor, precisa assinar primeiro.");
  } else {
    var dataURL_1 = signaturePad_1.toDataURL();

    obj = {};
    obj["signature"] = dataURL_1;

    var data = JSON.stringify(obj);


    axios({
      method: 'post',
      url: "signature-pad",
      data: {
        assinatura: data
      },
      headers: {
        'Content-Type': 'application/json; charset=utf-8'
      }
    })
      .then(res => {
        if (res.data == "sucesso") {
          showSucess_1.style.display = "inline";


          if (!wrapper.classList.contains("pad-corretiva")) {
            setTimeout(() => {
              close();

            }, 3000);
          } else {
            savePNGButton_1.style.opacity = ".5";
            savePNGButton_1.style.pointerEvents = "none";
          }
        }
      })
      .catch(err => console.error(err));

    // download(dataURL_1, "signature_1.png");
  }
});

// ========================================================================


enviarFormBtn.onclick = () => {
  assinaturaModalAdmin.style.visibility = "visible";
  assinaturaModalAdmin.style.opacity = "1";

  wrapper.style.opacity = "1";
  wrapper_1.style.opacity = "1";

  wrapper.style.pointerEvents = "auto";
}

function close() {
  assinaturaModalAdmin.style.visibility = "hidden";
  assinaturaModalAdmin.style.opacity = "0";
}

modalClose.onclick = () => {
  close()
  // signatureAdmin.style.zIndex = "-1";

  wrapper.style.opacity = "0";
  wrapper.style.pointerEvents = "none";
}
cancelBtn.onclick = () => {
  close();
}

var padAdmin = document.getElementById("signature-pad");
var padClient = document.getElementById("signature-pad-client");
function assinatura_cliente() {
  padClient.style.width = "100%";
  padClient.style.left = "0";
  assinaturaModalAdmin.style.opacity = ".80";
}



function avancar() {
  // signatureClient.style.width = "100%";
  if (!signaturePad.isEmpty()) {
    signatureClient.style.left = "0";
    signatureClient.style.pointerEvents = "auto";

    signatureAdmin.style.opacity = "0";
    signatureAdmin.style.visibility = "hidden";

  }

}


backBtn.addEventListener("click", () => {
  signatureAdmin.style.opacity = "1";
  signatureAdmin.style.visibility = "visible";

  signatureClient.style.left = "100%";
  signatureClient.style.pointerEvents = "none";

});
