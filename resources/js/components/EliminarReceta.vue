<template>
<input type="submit" value="Eliminar" class="btn btn-danger  d-block w-100 mb-2" v-on:click="eliminarReceta">
</template>

<script>
export default {
    props: ['recetaId'],
    methods:{
        eliminarReceta(){
this.$swal({
  title: 'Desea eliminar la receta?',
  text: "Una vez eliminada no se puede recuperar!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  cancelButtonText: 'No',
  confirmButtonText: 'Si, eliminar!'
}).then((result) => {
    //peticion al servidor
    const params ={
        id: this.recetaId
    }
    axios.post(`recetas/${this.recetaId}`,{params,_method:'delete'})
    .then((respuesta) => {
this.$swal({
      title:'Receta Eliminada',
      text:'Se elimino la receta',
      icon: 'success'
    })
    //eliminar receta del dom
    this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);
    })
    .catch((err) => {

    })

  
})
        }
    }
}

</script>
