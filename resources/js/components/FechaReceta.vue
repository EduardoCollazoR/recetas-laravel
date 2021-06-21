<template>
    <span v-text="formatear-fecha"></span>
</template>
<script>

export default {
    props:['fecha'],
    mounted(){

    },
    computed:{
        fomatearFecha(){
return moment(this.fecha).locale('es').format('DD [de] MMMM [del] YYYY')
        }
    }
}
</script>