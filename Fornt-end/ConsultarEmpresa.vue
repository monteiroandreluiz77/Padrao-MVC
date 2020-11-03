<template>
  <div class="q-pa-md">
    <q-table v-if="empresaEdicao==null"
             :dense="$q.screen.lt.md"
             title="Empresas"
             :data="data"
             :columns="columns"
             row-key="name"
    >
      <template v-slot:header="props">
        <q-tr :props="props">

          <q-th
            v-for="col in props.cols"
            :key="col.name"
            :props="props"
          >
            {{col.label}}
          </q-th>
          <q-th auto-width>
          </q-th>
        </q-tr>
      </template>
      <template v-slot:body="props">
        <q-tr :props="props">

          <q-td
            v-for="col in props.cols"
            :key="col.name"
            :props="props"
          >
            {{col.value}}
          </q-td>
          <q-td auto-width>
            <q-btn round icon="fas fa-pen" style="color: #1976D2" @click="Editar(props.row)"></q-btn>
            <q-btn round icon="fas fa-trash" style="color: #1976D2" @click="Remover(props.row.id)"></q-btn>

          </q-td>
        </q-tr>
      </template>
    </q-table>
    <editar-empresa v-if="empresaEdicao!=null":empresa="empresaEdicao"></editar-empresa>

  </div>
</template>

<script>
  import axios from 'axios';
  import EditarEmpresa from "pages/Empresas/EditarEmpresa";


  export default {
    name: "ConsultarEmpresa",
    components: {EditarEmpresa},
    data() {
      return {
        columns: [
          {
            name: 'id',
            required: true,
            label: 'Código da Empresa',
            align: 'left',
            field: 'id',
            sortable: true
          },
          {name: 'razao', align: 'left', label: 'Razão Social', field: 'razao', sortable: true},
          {name: 'nome', align: 'left', label: 'Nome Fantasia', field: 'nome', sortable: true},
          {name: 'cnpj', align: 'left', label: 'CNPJ', field: 'cnpj', sortable: true},
          {name: 'dataAbertura', align: 'left', label: 'Data de Abertura', field: 'dataAbertura', sortable: true}
        ],
        data: [],
        empresaEdicao: null
      }
    },
    mounted() {
      this.Consultar();
    },
    methods: {
      Remover(idUsuario) {
        let usuario = {id: idUsuario};
        axios.delete('http://localhost/tsi/GERE/Deletar.php', {data: usuario}).then(resposta => {
          this.$q.notify(resposta.data.Mensagem);
          this.Consultar();
        });
      },
      Consultar() {
        axios.get('http://localhost/tsi/GERE/Consultar.php').then(resposta => {
          this.data = resposta.data;
        });
      },
      Editar(empresa) {
        this.empresaEdicao = empresa;

      },
    }
  }

</script>

<style scoped>

</style>
