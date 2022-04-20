var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
    backgroundColor: 'rgba(255, 255, 255, 0)',
    penColor: 'rgb(0, 0, 0)'
  }); 
var cancelButton = document.getElementById('clear');
  cancelButton.addEventListener('click', function (event) {
    signaturePad.clear();
  });

  var signaturePados = new SignaturePad(document.getElementById('signature-pad2'), {
    backgroundColor: 'rgba(255, 255, 255, 0)',
    penColor: 'rgb(0, 0, 0)'
  });  
var cancelButtondos = document.getElementById('cleardos');
  cancelButtondos.addEventListener('click', function (event) {
    signaturePados.clear();
  });

  var signaturePadtres = new SignaturePad(document.getElementById('signature-pad3'), {
    backgroundColor: 'rgba(255, 255, 255, 0)',
    penColor: 'rgb(0, 0, 0)'
  });
var cancelButtontres = document.getElementById('cleartres');
  cancelButtontres.addEventListener('click', function (event) {
    signaturePadtres.clear();
  });

  function guardar(){
    var idCanvas='signature-pad';
    var idCanvas2='signature-pad2';
    var idCanvas3='signature-pad3';
    var idForm= 'formCanvas';
    imagen.value=document.getElementById(idCanvas).toDataURL('image/png');
    document.forms[idForm].submit();
    imagendos.value=document.getElementById(idCanvas2).toDataURL('image/png');
    document.forms[idForm].submit();
    imagentres.value=document.getElementById(idCanvas3).toDataURL('image/png');
    document.forms[idForm].submit();
    window.open("contrato.php");
  }