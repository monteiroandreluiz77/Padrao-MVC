<template>
  <div class="q-pa-md">
    <q-input type="text" label="Código" v-model="Empresa.id" readonly></q-input>
    <q-input type="text" label="Razão Social" v-model="Empresa.razao"></q-input>
    <q-input type="text" label="Nome Fantasia" v-model="Empresa.nome"></q-input>
    <q-input type="text" label="CNPJ" v-model="Empresa.cnpj"></q-input>
    Data de Abertura:
    <q-input type="date" v-model="Empresa.dataAbertura"></q-input>
    <br>
    <q-btn label="Salvar Alterações" color="primary" @click="EditarEmpresa"></q-btn>


  </div>
</template>

<script>
  import axios from 'axios';
    export default {
        name: "EditarEmpresa",
      data(){
          return{

          }
      }, methods:{
        EditarEmpresa(){
          axios.put('http://localhost/tsi/GERE/EditarEmpresa.php', this.Empresa).then(resposta => {
            this.$q.notify(resposta.data.Mensagem);
          });

        }
      },
      props: {
        Empresa: {
          type: Object,
          required: true

        }
      }
    }
</script>

<style scoped>

</style>
