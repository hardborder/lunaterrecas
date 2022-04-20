// canvas de firma cliente
var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
    backgroundColor: 'rgba(255, 255, 255, 0)',
    penColor: 'rgb(0, 0, 0)'
  }); 
var cancelButton = document.getElementById('clear');
  cancelButton.addEventListener('click', function (event) {
    signaturePad.clear();
  });
  // canvas de firma testigo
  var firmates = new SignaturePad(document.getElementById('firmates'), {
    backgroundColor: 'rgba(255, 255, 255, 0)',
    penColor: 'rgb(0, 0, 0)'
  }); 
    var cancelButton = document.getElementById('cleartes');
    cancelButton.addEventListener('click', function (event) {
    firmates.clear();
  });
  // canvas de firma directora 
    var firmadir = new SignaturePad(document.getElementById('firmadir'), {
    backgroundColor: 'rgba(255, 255, 255, 0)',
    penColor: 'rgb(0, 0, 0)'
  }); 
    var cancelButton = document.getElementById('cleardir');
    cancelButton.addEventListener('click', function (event) {
    firmadir.clear();
  });
  function guardar(){
    var idCanvas='signature-pad';
    var idForm= 'formCanvas';
    imagen.value=document.getElementById(idCanvas).toDataURL('image/png');
    document.forms[idForm].submit();
    //      
    var idCanvas='firmates';
    imagentes.value=document.getElementById(idCanvas).toDataURL('image/png');
    document.forms[idForm].submit();
    //
    var idCanvas='firmadir';
    imagendir.value=document.getElementById(idCanvas).toDataURL('image/png');
    document.forms[idForm].submit();
    window.open('contrato.php');
  }