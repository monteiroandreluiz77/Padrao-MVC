<template>
  <div class="q-pa-md">
    <q-input type="text" label="Razão Social" v-model="Empresa.razao"></q-input>
    <q-input type="text" label="Nome Fantasia" v-model="Empresa.nome"></q-input>
    <q-input type="text" label="CNPJ" v-model="Empresa.cnpj"></q-input>
    Data de Abertura:
    <q-input type="date" v-model="Empresa.dataAbertura"></q-input>
    <br>
    <q-btn label="Salvar Dados" color="primary" @click="CadastrarNovaEmpresa"></q-btn>

  </div>
</template>

<script>
  import axios from 'axios';

  export default {
    name: "CadastrarEmpresa",
    data() {
      return {
        Empresa: {
          razao: '',
          nome: '',
          cnpj: '',
          dataAbertura: ''
        }
      }
    },
    methods: {
      CadastrarNovaEmpresa() {
        axios.post('http://localhost/tsi/GERE/Cadastrar.php', this.Empresa).then(resposta => {
          this.$q.notify(resposta.data.Mensagem);

        });
      }
    }
  }
</script>

<style scoped>

</style>
