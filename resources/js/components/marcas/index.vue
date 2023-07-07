<script setup>
    import { onMounted, ref } from 'vue';
    import moment from 'moment';
    import axios from 'axios';
    import { useRouter } from 'vue-router';

    const router = useRouter();

    let marcas = ref([])
    let searchMarcas = ref([])

    onMounted(async () => {
        getMarcas()
    })

    const getMarcas = async () => {
        let res = await axios.get('/api/marcas')
        marcas.value = res.data.marcas
    }

    const search = async () => {
        let res = await axios.get('/api/search_marcas?s='+searchMarcas.value);
        // Troca as informacoes pelas informacoes filtradas
        marcas.value = res.data.marcas
    }

    const newMarca = async () => {
        let form = await axios.get("/api/create_marca")
        router.push('/marcas/new')
    }
    
    const onEdit = (id) => {
        router.push('/marcas/edit/'+id)
    }

    const deleteMarca = async (id) => {
        // Consulta no banco se há algum produto que utilize essa marca, se sim bloqueia a exclusao
        let res = await axios.get('/api/verifica_produtos_marca/'+id)
        let produtosMarca = res.data.produtos

        if (produtosMarca.length > 0) {
            alert("Atenção, não é possivel apagar esta Marca pois um ou mais produtos estão a utilizando, desassocie a Marca aos produtos e tente novamente")
        } else {
            await axios.get('/api/delete_marca/'+id)
            await getMarcas()
            router.push('/marcas')
        }
    }
 
    const redirectProdutos = () => {
        router.push('/');
    }
</script>



<template>
    <div class="container">
        <div class="itens">
        <div class="card__header">
            <div>
                <h2 class="itens__title">Marcas</h2>
            </div>
            <div>
                <a class="btn btn-secondary" @click="newMarca">
                    Nova Marca
                </a>
            </div>
        </div>
        <div class="table card__content">
            <div class="table--filter">
                <span class="table--filter--collapseBtn ">
                    <i class="fas fa-ellipsis-h"></i>
                </span>
                <div class="table--filter--listWrapper">
                    <ul class="table--filter--list">
                        <li>
                            <a class="table--filter--link " @click="redirectProdutos">
                                Produtos
                            </a>
                        </li>
                        <li>
                            <a class="table--filter--link table--filter--link--active">
                                Marcas
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="table--search">
                <div class="table--search--wrapper">
                    <select class="table--search--select" name="" id="" disabled>
                    </select>
                </div>
                <div class="relative">
                    <i class="table--search--input--icon fas fa-search "></i>
                    <input class="table--search--input" type="text" placeholder="Filtre as marcas por nome" v-model="searchMarcas" @keyup="search()">
                </div>
            </div>
            <div class="table--heading">
                <p>ID</p>
                <p>Nome</p>
                <p>Ações</p>
            </div>
            <div class="table--items" v-for="item in marcas" :key = "item.id" v-if="marcas.length > 0">
                <p>{{item.id}}</p>
                <p>{{item.nome}}</p>
                
                <div class="acoes">
                    <a class="btn btn-secondary button btn-add" @click="onEdit(item.id)">
                        Editar
                    </a>
                    <a class="btn btn-secondary button btn-rem" @click="deleteMarca(item.id)">
                        Excluir
                    </a>
                </div>
            </div>
            <div class="table--items" v-else>
                <p>Não Existem marcas cadastradas</p>
            </div>
        </div>
    </div>
    <br><br><br>
    </div>
</template>