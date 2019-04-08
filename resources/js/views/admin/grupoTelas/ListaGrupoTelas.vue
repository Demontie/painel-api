<template>
    <div>
        <v-container grid-list-sm class="px-0 py-0">
            <v-layout wrap justify-end>
                <v-flex>
                    <v-toolbar-title class="headline text-uppercase mr-4">
                        Grupo de telas
                    </v-toolbar-title>
                </v-flex>
                <v-flex sm12 md3>
                    <v-btn @click="novoGrupoTela" color="primary darken-3" class="mb-1">Novo</v-btn>
                </v-flex>
                <v-flex sm12 md3>
                    <!--<InputSearch :param="busca"></InputSearch>-->
                    <v-text-field
                            v-model="busca"
                            append-icon="search"
                            label="Pesquisar"
                            single-line
                            hide-details
                    ></v-text-field>
                </v-flex>
            </v-layout>
        </v-container>
        <v-data-table
                :headers="cabecalho"
                :items="grupoTelas"
                :load="load"
                :search="busca"
                :rows-per-page-items="[10,25,50]"
                class="elevation-1"
        >
            <template slot="items" slot-scope="props">
                <td> {{ props.item.descricao }} </td>
                <td>
                    <v-icon v-if="props.item.ativo" title="Tipo ativo">done</v-icon>
                    <v-icon v-else title="Tipo inativo">clear</v-icon>
                </td>
                <td>
                    <v-icon title="Editar tipo de senha"
                            class="mr-5"
                            @click="editarGrupoTela(props.item)"
                    >
                        edit
                    </v-icon>
                    <v-icon title="Excluir tipo de senha"
                            @click="excluirGrupoTela(props.item)"
                    >
                        delete
                    </v-icon>
                </td>
            </template>
        </v-data-table>

        <Mensagens></Mensagens>
    </div>
</template>

<script>
    import { mapGetters,mapActions } from 'vuex'
    import Mensagens from './../../../components/admin/views/Mensagens'

    export default {
        components:{
            Mensagens
        },
        data(){
            return{
                cabecalho:[
                    {
                        text: 'Grupos de telas',
                        align: 'left',
                        value: 'descricao'
                    },
                    {text:'Ativo',value:'ativo'},
                    {text:'Ações', align:'justify'}
                ],
                busca: '',
                load: true,
            }
        },
        computed:{
            ...mapGetters({
                grupoTelas: 'getGrupoTelas'
            })
        },
        methods:{
            ...mapActions({
                loadGrupoTelas: 'loadGrupoTelas',
                setGrupoTela: 'setGrupoTela',
                deleteGrupoTela: 'deleteGrupoTela',
                setMensagem: 'setMensagem'
            }),
            novoGrupoTela(){
                this.setGrupoTela({ativo:true})
                this.$router.push({name:'admin.grupo-telas.novo'})
            },
            editarGrupoTela(grupoTela){
                this.setGrupoTela(grupoTela)
                console.log(grupoTela)
                this.$router.push({
                    name:'admin.grupo-telas.editar',
                    params:{
                        idGrupoTela: grupoTela.id
                    }
                })
            },
            async excluirGrupoTela(grupoTela){
                this.load = true

                let res = await this.$confirm('Tem certeza que deseja excluir esse grupo?',{
                    title:'Atenção',
                    icon:'warning',
                    color:'warning',
                })
                if(res){
                    try {
                        const request = await this.deleteGrupoTela(grupoTela)

                        this.setMensagem({
                            ativo: true,
                            texto: 'Grupo de telas excluído com sucesso',
                            tipo: 'success'
                        })
                    }catch (error) {
                        this.setMensagem({
                            ativo: true,
                            texto: 'Houve um problema ao excluir, por favor tente novamente.',
                            tipo: 'danger'
                        })
                    }
                }

                this.load = false
            }
        },
        watch:{
          grupoTelas(novoValor){
              if(Array.isArray(novoValor)){
                  this.load = false
              }
          }
        },
        created(){
            this.loadGrupoTelas()

            this.$store.watch(state => state.mensagem, () => {
                const msg = this.$store.state.mensagem
                console.log(msg)
            })
        }

    }
</script>

<style scoped>

</style>