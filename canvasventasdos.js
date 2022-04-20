var signaturePad2 = new SignaturePad(document.getElementById('signature-pad2'), {
    backgroundColor: 'rgba(255, 255, 255, 0)',
    penColor: 'rgb(0, 0, 0)'
  }); 
var cancelButton = document.getElementById('clear');
  cancelButton.addEventListener('click', function (event) {
    signaturePad2.clear();
  });
  function guardar(){
    var idCanvas='signature-pad2';
    var idForm= 'formCanvas';
    imagen2.value=document.getElementById(idCanvas).toDataURL('image/png');
    document.forms[idForm].submit();
    
  }