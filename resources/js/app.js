 import Dropzone from "dropzone";

Dropzone.autoDiscover=false;

const dropzone = new Dropzone('#dropzone',{
    dictDefaultMessage:"Sube aqui tu imagen",
    acceptedFiles:".png,.jpg,.jpeg,.gif",
    addRemoveLinks:true,
    dictRemoveFile:"Borrar Archivo",
    maxFiles:1,
    uploadMultiple:false,
    init:function(){
      //alert("creado");
      const valores = window.location.search;
      console.log(valores);
      if(valores){
        const valor_unico = valores.slice(1);
        document.getElementById("imagen").value=valor_unico;
        //console.log(valor_unico);
      }
      
     

      if(document.querySelector('[name="imagen"]').value.trim()){
        const imagenPublicada={}
        imagenPublicada.size = 1234
        imagenPublicada.name = document.querySelector('[name="imagen"]').value;
        //console.log("name: " + imagenPublicada.name);

        this.options.addedfile.call(this,imagenPublicada);
        this.options.thumbnail.call(this,imagenPublicada,`/updloads/${imagenPublicada}`);
        imagenPublicada.previewElement.classList.add('dz-success','dz-complete')
      }
    }

});

dropzone.on('sending',function(file,xhr,formData){
  //  console.log(file);
});

dropzone.on('success',function(file,response){
   // console.log(response);
    document.querySelector('[name="imagen"]').value= $imagenServidor;
});

dropzone.on('error',function(file,message){
  //  console.log(message);
});

dropzone.on('removedfile',function(){
  //  console.log("Archivo eliminado");
  document.querySelector('[name="imagen"]').value="";

});
 