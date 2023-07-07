
<script setup>

    import axios, { all } from 'axios';
    import { onMounted, ref } from 'vue';
    import { useRouter } from 'vue-router';

    const router = useRouter();

    let form = ref({
        id:'',
    })
    let allMarcas = ref([])

    const props = defineProps({
        id: {
            type: String,
            default: '',
        }
    });

    onMounted(async () => {
        getProduto()
        getAllMarcas()
    });

    const getProduto = async () => {

        let res = await axios.get('/api/edit_produto/'+props.id)
        form.value = res.data.produto
    }

    const getAllMarcas = async () => {
        let res = await axios.get('/api/marcas')
        allMarcas.value = res.data.marcas
    }

    const onEdit = async () => {
        const formData = new FormData()
        formData.append('id_marca', form.value.id_marca)
        formData.append('nome', form.value.nome)
        formData.append('preco', form.value.preco)

        axios.post(`/api/update_produto/${form.value.id}`, formData)
        router.push('/')
    }
</script>

<template>
    <div class="container">
        <div class="itens">
        <div class="card__header">
            <div>
                <h2 class="itens__title">Editar Produto</h2>
            </div>
            <div>
                
            </div>
        </div>
        <div class="card__content">
            <div class="card__content--header">
                <div>
                    <p class="my-1">Marca</p>
                    <select name="" id="" class="input" v-model="form.id_marca">
                        <option disabled>Escolha uma marca para o produto</option>
                        <option :value="marca.id" v-for="marca in allMarcas" :key="marca.id">{{ marca.nome }}</option>
                    </select>
                </div>
                <div>
                    <p class="my-1">Descrição</p> 
                    <input type="text" class="input" v-model="form.nome"> 
                </div>
                <div>
                    <p class="my-1">Preço</p> 
                    <input type="number" pattern="[0-9]*" oninput="this.value=this.value.replace(/[^0-9]/g,'')" class="input" v-model="form.preco">
                </div>
            </div>
            <br><br> 
        </div>
        <div class="card__header" style="margin-top: 40px;">
            <div>
            </div>
            <div>
                <a class="btn btn-secondary" @click="onEdit()">
                    Salvar
                </a>
            </div>
        </div>
    </div>
    <br><br><br>
    </div>
</template>