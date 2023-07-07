<script setup>
    import { onMounted, ref } from 'vue';
    import moment from 'moment';
    import axios from 'axios';
    import { useRouter } from 'vue-router';

    const router = useRouter();

    let produtos = ref([])
    let searchProdutos = ref([])

    onMounted(async () => {
        getProdutos()
    })

    const getProdutos = async () => {
        let res = await axios.get("/api/get_all_produtos")
        produtos.value = res.data.produtos
    }

    const search = async () => {
        let res = await axios.get('/api/search_produtos?s='+searchProdutos.value);
        // Troca as informacoes pelas informacoes filtradas
        produtos.value =  res.data.produtos
    }

    const newProduto = async () => {
        router.push('/produto/new')
    }

    const onEdit = (id) => {
        router.push('/produto/edit/'+id)
    }

    const deleteProduto = async (id) => {
        axios.get('/api/delete_produto/'+id)
        await getProdutos()
        router.push('/')
    }

    const redirectMarcas = () => {
        router.push('/marcas');
    }

</script>


<template>
    <div class="container">
        <div class="itens">
        <div class="card__header">
            <div>
                <h2 class="itens__title">Produtos</h2>
            </div>
            <div>
                <a class="btn btn-secondary" @click="newProduto">
                    Novo Produto
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
                            <p class="table--filter--link table--filter--link--active">
                                Produtos
                            </p>
                        </li>
                        <li>
                            <a class="table--filter--link " @click="redirectMarcas">
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
                    <input class="table--search--input" type="text" placeholder="Filtre os produtos por nome" v-model="searchProdutos" @keyup="search()">
                </div>
            </div>
            <div class="table--heading">
                <p>ID</p>
                <p>Nome</p>
                <p>Marca</p>
                <p>Preço</p>
                <p>Ações</p>
            </div>
            <div class="table--items" v-for="item in produtos" :key = "item.id" v-if="produtos.length > 0">
                <p>{{item.id}}</p>
                <p>{{item.nome}}</p>
                <p v-if="item.marca">
                    {{item.marca.nome}}
                </p>
                <p v-else> - </p>
                <p>R$ {{item.preco}}</p>
                <div class="acoes">
                    <a class="btn btn-secondary button btn-add" @click="onEdit(item.id)">
                        Editar
                    </a>
                    <a class="btn btn-secondary button btn-rem" @click="deleteProduto(item.id)">
                        Excluir
                    </a>
                </div>
            </div>
            <div class="table--items" v-else>
                <p>Não Existem produtos cadastrados</p>
            </div>
        </div>
    </div>
    <br><br><br>
    </div>
</template>