<script setup>

    import axios from 'axios';
    import { onMounted, ref } from 'vue';
    import { useRouter } from 'vue-router';

    const router = useRouter();

    let form = ref([])
    let allMarcas = ref([])
    let marca_id = ref([])
    let nome = ref([])
    let preco = ref([])

    onMounted(async () => {
        getAllMarcas()
    })

    const getAllMarcas = async () => {
        let res = await axios.get('/api/marcas')
        allMarcas.value = res.data.marcas
    }

    const onSave = () => {
        const formData = new FormData()
        formData.append('marca_id', marca_id.value)
        formData.append('nome', nome.value)
        formData.append('preco', preco.value)

        axios.post('/api/add_produto', formData) 
        router.push('/')
    }


</script>

<template>
    <div class="container">
        <div class="itens">
        
        <div class="card__header">
            <div>
                <h2 class="itens__title">Novo Produto</h2>
            </div>
            <div>
                
            </div>
        </div>

        <div class="card__content">
            <div class="card__content--header">
                <div>
                    <p class="my-1">Marca</p>
                    <select name="" id="" class="input" v-model="marca_id">
                        <option disabled>Escolha uma marca para o produto</option>
                        <option :value="marca.id" v-for="marca in allMarcas" :key="marca.id">{{ marca.nome }}</option>
                    </select>
                </div>
                <div>
                    <p class="my-1">Descrição</p> 
                    <input type="text" class="input" v-model="nome"> 
                </div>
                <div>
                    <p class="my-1">Preço</p> 
                    <input type="number" pattern="[0-9]*" oninput="this.value=this.value.replace(/[^0-9]/g,'')" class="input" v-model="preco">
                </div>
            </div>
            <br><br>
            

           
        </div>
        <div class="card__header" style="margin-top: 40px;">
            <div>
                
            </div>
            <div>
                <a class="btn btn-secondary" @click="onSave()">
                    Salvar
                </a>
            </div>
        </div>
        
    </div>
    
    <br><br><br>
    </div>
</template>