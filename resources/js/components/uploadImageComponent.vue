<template>
      <div class="contenedor-input-imgs" >
        <div style="display: flex; justify-content: space-between;">
            <div class="row" style="width: 49%">
                    <div class="col-md-6 imgs">
                        <label class="form-label" for="imagen_antes" style="font-size:16;">Subir imagen "antes"</label>
                       <input  type="file" @change="getImageAntes" name="imagen_antes" id="imagen_antes" accept=".jpg, .jpeg, .png" class="form-control form-control-sm" :disabled="product.imagen_antes"> 
                    </div>
            </div>
            <div class="row" style="width: 49%">
                     <div class="col-md-6 imgs">
                           <label  class="form-label" for="imagen_durante" style="font-size:16;">Subir imagen "durante"</label>
                       <input  type="file" name="imagen_durante" id="imagen_durante" accept=".jpg, .jpeg, .png" class="form-control form-control-sm" @change="getImageDurante" :disabled="product.imagen_durante"> 
                    </div>
            </div>
        </div>
            <div class="row" style="width: 50%; padding-top: 20px; align-self: center;">
                     <div class="col-md-6 imgs">
                           <label class="form-label" for="imagen_despues" style="font-size:16;">Subir imagen "despues"</label>
                       <input  type="file" name="imagen_despues" id="imagen_despues" accept=".jpg, .jpeg, .png" class="form-control form-control-sm" @change="getImageDespues" :disabled="product.imagen_despues"> 
                    </div>
            </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            product:{
                imagen_antes:false,
                imagen_durante:false,
                imagen_despues:false
            }

        }
    },
    props:['datos'],
    
    mounted(){

      this.cargaImagenes()
    },
    methods:{

             getImageAntes(event){
                //Asignamos la imagen a  nuestra data
                this.$store.state.imagen_antes = event.target.files[0];
            },
             getImageDurante(event){
                //Asignamos la imagen a  nuestra data
                this.$store.state.imagen_durante = event.target.files[0];
            },
             getImageDespues(event){
                //Asignamos la imagen a  nuestra data
                this.$store.state.imagen_despues = event.target.files[0];
            },
            cargaImagenes(){
               //console.log(this.datos);
               if (this.datos != '' && this.datos != null){
                this.datos.forEach(element => {
                    console.log(element.timagen_id);
                    if (element.timagen_id == 1){
                        this.product.imagen_antes = true;
                    }
                    
                    if (element.timagen_id == 2){
                        this.product.imagen_durante = true;
                    }
                    
                    if (element.timagen_id == 3){
                        this.product.imagen_despues = true;
                    }
                });
            }
            }
    }
}
</script>
