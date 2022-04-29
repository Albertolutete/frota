var parentTab = [...document.querySelectorAll(".parent-tab")];
var tabLabel = [...document.querySelectorAll(".parent-tab label.accordion-label")];
const content = [...document.querySelectorAll(".parent-tab .content")];


// =============================================================================

for (var i = 0; i < tabLabel.length; i++) {
    tabLabel[i].onclick = function () {
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");
        var ll = this.children[1];
        // console.log(ll);
        ll.classList.toggle("hide");
        // console.log(ll);

        hideAll(this, ll);
        // apresentarFilhos(this);
    };
}

function hideAll(exceptThis, ll) {
    for (var i = 0; i < tabLabel.length; i++) {
        if (tabLabel[i] !== exceptThis && tabLabel[i] !== ll) {
            tabLabel[i].classList.remove("active");
            tabLabel[i].nextElementSibling.classList.remove("show");
            tabLabel[i].children[1].classList.remove("hide");
            // var ll = exceptThis.children[1];
        }
    }
}

// ---------------------- Child-tab ---------------------------------------
var childLabel = [...document.querySelectorAll(".parent-tab .child-tab label")];

for (var n = 0; n < childLabel.length; n++) {
    childLabel[n].onclick = function () {
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");
        hideAllinner(this);
    };
}

function hideAllinner(exceptThis) {
    for (var n = 0; n < childLabel.length; n++) {
        if (childLabel[n] !== exceptThis) {
            childLabel[n].classList.remove("active");
            childLabel[n].nextElementSibling.classList.remove("show");
        }
    }
}

// =============================================================================



function apresentarFilhos(e) {
    // var radios = document.querySelector('input[name="tab"]:checked');

    var hideInput = document.parentNode.querySelector("i.fa-plus");
    // console.log(e);
    hideInput.classList.togle("hide");
}

// Verificando os campos, se pelo menos um dos campos estiver preenchido, assinala check
function verificar(e) {
    const btnParent = e.parentNode.parentNode;
    const inputField = [...btnParent.querySelectorAll(".form-input")];
    var foto = inputField[0].querySelector("input.foto-input");
    var status = inputField[1].querySelector("select.status-input");
    var obs = inputField[2].querySelector(".obs-input");

    var iVisibleFoto = inputField[0].querySelector("i");
    var iVisibleStatus = inputField[1].querySelector("i");
    var iVisibleObs = inputField[2].querySelector("i");

    if (foto.value) {
        iVisibleFoto.classList.add("visivel");
    } else {
        iVisibleFoto.classList.remove("visivel");
    }

    if (status.value) {
        iVisibleStatus.classList.add("visivel");
        status.style.border = "#ccc 1px solid";

    } else {
        status.style.border = "red 1px solid";
        status.style.borderRadio = "8px";
        iVisibleStatus.classList.remove("visivel");
    }

    if (obs.value) {
        iVisibleObs.classList.add("visivel");
    } else {
        iVisibleObs.classList.remove("visivel");
    }

    var submit = btnParent.querySelector(".submitBtn input");
    var mainContIVisible = btnParent.parentNode.parentNode.querySelector("i");
    var mainLabelIVisible = btnParent.parentNode.parentNode.parentNode.parentNode.querySelector("i");
    var tipoP = inputField[1].parentNode.parentNode.parentNode.querySelector("label span");
    var nomeP = inputField[0].parentNode.parentNode.parentNode.parentNode.parentNode.querySelector("label.accordion-label span");

    let form = inputField[0].parentNode;
    let formData = new FormData(form);

    formData.append('nomeManPrev', nomeP.innerText);
    formData.append('tipoManPrev', tipoP.innerText);

    submit.onclick = () => {
        //  var laravelToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

        axios({
            method: "post",
            url: "manutencao/store",
            data: formData,
            headers: { "Content-Type": "multipart/form-data" },
        })
            .then((res) => {
                // console.log(res.data);
                if (res.data == "ok") {

                    if (foto.value || status.value || obs.value) {
                        foto.style.opacity = ".5";
                        foto.style.pointerEvents = "none";
                        status.style.opacity = ".5";
                        status.style.pointerEvents = "none";
                        obs.style.opacity = ".5";
                        obs.style.pointerEvents = "none";
                        enviarFormBtn.style.opacity = "1";
                        enviarFormBtn.style.pointerEvents = "auto";
                        mainContIVisible.classList.add("visivel");
                        mainContIVisible.parentNode.parentNode.parentNode.style.opacity = "0.7";

                        mainLabelIVisible.classList.add("visivel");

                        submit.style.opacity = ".5";
                        submit.style.pointerEvents = "none";
                    } else {
                        enviarFormBtn.style.pointerEvents = "none";
                        enviarFormBtn.style.opacity = ".5";
                        mainContIVisible.classList.remove("visivel");
                        mainLabelIVisible.classList.remove("visivel");
                    }
                    e.classList.toggle("active");
                } else if (res.data == "nok") {
                    // status.style.border = "red 1px solid";
                    alert("Por favor, escolha um status do equipamento");

                } else if (res.data == "existe") {
                    enviarFormBtn.style.opacity = "1";
                    enviarFormBtn.style.pointerEvents = "auto";
                    mainContIVisible.classList.add("visivel");
                    mainContIVisible.parentNode.parentNode.parentNode.style.opacity = "0.7";
                    alert("Esta manutencao ja foi registada");
                }
            })
            .catch((err) => console.error(err));
        return false;
    }

    return false;
}

// window.document.body.onload = () => {
//     axios.get(url,params)
//     .then(res => {
//         console.log(res)
//     })
//     .catch(err => {
//         console.error(err); 
//     })
// }

const formulario = document.getElementById("manutencao_corretiva");

// formulario.addEventListener("click", validarCorretiva);
const popup = document.querySelector(".popup-container");

function validarCorretiva(e) {
    // e.preventDefault();
    if (signaturePad_1.isEmpty() || signaturePad.isEmpty()) {
        alert("Por favor, precisa assinar primeiro.");
    } else {
        var formData = new FormData(formulario);
        axios({
            method: "post",
            url: "manutencao/store/corretiva",
            data: formData,
            headers: { "Content-Type": "multipart/form-data" },
        })
            .then((res) => {
                // console.log(res.data);
                if (res.data == "ok") {
                    savePNGButton.click();
                    savePNGButton_1.click();
                    popup.classList.add("mostrar");

                    setTimeout(() => {
                        // close();
                        popup.classList.remove("mostrar");
                        location.href = "/Elevador";
                    }, 2000);
                } else if (res.data === "existe") {
                    alert("Esta manutencao ja foi atendida");
                }

            })
            .catch((err) => console.error(err));
    }
    return false;
}


enviarFormBtn.onclick = () => {
    if (signaturePad.isEmpty() || signaturePad_1.isEmpty()) {
        alert("Por favor, precisa assinar primeiro.");
    } else {
        let popup = document.querySelector(".popup-container");
        const manutencaoId = document.forms[0].manutencao_id.value;

        savePNGButton.click();
        savePNGButton_1.click();
        
        
        axios.get("manutencao/fecharManutencao/"+manutencaoId)
        .then(res => {
            if(res.data == "ok"){
                popup.classList.add("mostrar");

                setTimeout(() => {
                    location.href = "/Elevador";
        
                    popup.classList.remove("mostrar");
                }, 2000);
            }

            console.log(res)
        })
        .catch(err => {
            console.error(err); 
        })


    }
}

