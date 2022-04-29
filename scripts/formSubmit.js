axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': window.csrf_token
  };

var enviarFormBtn = document.getElementById("enviar-form");
let formEmpresa = document.getElementById("formEmpresa");


var loja = document.getElementById("loja_id");
var equipamentos = document.getElementById("equipamentos");
loja.addEventListener("change", buscarEquipamentos)

console.log(loja.value);
function buscarEquipamentos() {
    axios({
        method:'get',
        url: `buscarEquipamentos/${loja.value}`,
        // data: {
        //     loja_id: 
        // }
    })
    .then (res => {
        // console.log(res.data);
        equipamentos.innerHTML = res.data;
    })
}

var popup = document.querySelector(".popup-container");

// formEmpresa.addEventListener('submit', validarEmpresa);
console.log(formEmpresa);

function validarEmpresa(event) {

    // event.preventDefault();
    let popup = document.querySelector(".popup-container");
    var formData = new FormData(formEmpresa);

    axios({
        method:'post',
        url: "empresacad",
        headers: { "Content-Type": "multipart/form-data" },
        data: formData
        
    })
    .then(res => {
        if(res.data == "ok"){
            popup.classList.add("mostrar");
            setTimeout(()=>{
                location.href = "Empresas";
                popup.classList.remove("mostrar");
            }, 3500);
        } else if(res.data == "nok"){
            alert("O email introduzido ja existe");
        } else if(res.data == "logout"){
            location.href = "/login";
        }
        console.log(res.data);
    })
    .catch(err => {
        console.error(err);
    });

    return false;

}

function validarLoja(event) {
    var formLoja = document.forms.formLoja;
    // console.log(formLoja);
    
    let formData = new FormData(formLoja);
    
    axios({
        method:'post',
        url: "lojasubmit",
        headers: { "Content-Type": "multipart/form-data" },
        data: formData
        
    })
    .then(res => {
        if(res.data == "ok"){
            popup.classList.add("mostrar");
            popup.focus();
            setTimeout(()=>{
                location.href = "Elevador/Lojas";
                popup.classList.remove("mostrar");
            }, 3500);
        } else if(res.data == "loggedout") {
            location.href = "login";

        }
        console.log(res.data);
    })
    .catch(err => {
        console.error(err);
    })
    return false;
}

function validarTecnico(event) {
   
    var formTecnico = document.forms.formTecnico;
    // console.log(formLoja);
     
     var popup = document.querySelector(".popup-container");
     
    let formData = new FormData(formTecnico);
    
    axios({
        method:'post',
        url: "tecnico",
        headers: { "Content-Type": "multipart/form-data" },
        data: formData
        
    })
    .then(res => {
        if(res.data == "ok"){
            popup.classList.add("mostrar");
            
            popup.focus();
            setTimeout(()=>{
                location.href = "Tecnico";
                popup.classList.remove("mostrar");
            }, 3500);
        } else if(res.data == "loggedout") {
            location.href = "login";

        } else if(res.data == "nok"){
            alert("O email introduzido ja existe");
        }
        console.log(res.data);
    })
    .catch(err => {
        console.error(err);
    })
    return false;
}

function validarChamado(event) {
    let popup = document.querySelector(".popup-container");
    var formChamado = document.forms.SIM_Predial;
    // console.log(formLoja);

    let formData = new FormData(formChamado);
    
    axios({
        method:'post',
        url: "CadastrarChamado",
        headers: { "Content-Type": "multipart/form-data" },
        data: formData
        
    })
    .then(res => {
        console.log(res.data);
        if(res.data == "ok"){
            popup.classList.add("mostrar");

            setTimeout(()=>{
                if(!popup.classList.contains("admin")){
                    location.href = "/Elevador";
                } else {
                    location.href = "/Elevador/home";
                }
                popup.classList.remove("mostrar");
            }, 2000);
        } else if(res.data == "existe"){
            alert("Ja existe um chamdo aberto para esse equipamento");
        }
    })
    .catch(err => {
        console.error(err);
    })
    return false;
}

function abrirEnvelope(e, id) {
    var next = e.parentNode.childNodes[3];
    var chamadoDetail = document.getElementById("chamados-detail");
    var chamadoTbody = document.getElementById("chamado-show");
    var anexo = document.querySelector("#anexo-chamado img");

    
    axios({
        method:'get',
        url: `abrirEnvelope/${id}`,

    })
    .then(res => {

        var chamadoArray = res.data;
        console.log("Funcao: Abrir envelope; 190");
        anexo.src = "storage/app/public/chamados/" + chamadoArray["anexo"];
        chamadoDetail.querySelector(".nome").innerHTML = chamadoArray["nome"];
        chamadoDetail.querySelector(".tipo").innerHTML = chamadoArray["tipo"];                  // Novo
        chamadoDetail.querySelector(".empresa").innerHTML = chamadoArray["empresa"];            // Novo
        chamadoDetail.querySelector(".equipamento").innerHTML = chamadoArray["equipamento"];    // Sem dados
        chamadoDetail.querySelector(".motivo").innerHTML = chamadoArray["motivo"];          
        chamadoDetail.querySelector(".telefone").innerHTML = chamadoArray["telefone"];
        chamadoDetail.querySelector(".detalhes").innerHTML = chamadoArray["detalhes"];          // 
        chamadoDetail.querySelector(".cargo").innerHTML = chamadoArray["cargo"];          // 
        chamadoDetail.querySelector(".data").innerHTML = chamadoArray["data"];

        // chamadoTbody.innerHTML = `
        //     <tr>
        //         <td>${chamadoArray["nome"]}</td>
        //     </tr>
        // `;

    })
    .catch(err => {
        console.error(err);
    })
}

