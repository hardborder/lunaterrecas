var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
    backgroundColor: 'rgba(255, 255, 255, 0)',
    penColor: 'rgb(0, 0, 0)'
  });
  
  
var cancelButton = document.getElementById('clear');


  cancelButton.addEventListener('click', function (event) {
    signaturePad.clear();
  });

  function guardar(){
    var idCanvas='signature-pad';
    var idForm= 'formCanvas';
    imagen.value=document.getElementById(idCanvas).toDataURL('image/png');
    
    document.forms[idForm].submit();
    window.open("penalizacion.php");
  }