<script setup>

    import axios from 'axios';
    import { onMounted, ref } from 'vue';
    import { useRouter } from 'vue-router';

    const router = useRouter();

    let nome = ref([])

    onMounted(async () => {
        
    })

    const onSave = () => {

        const formData = new FormData()
        formData.append('nome', nome.value)

        axios.post('/api/add_marca', formData) 
        router.push('/marcas')
    }
</script>

<template>
    <div class="container">
        <div class="itens">
        <div class="card__header">
            <div>
                <h2 class="itens__title">Nova Marca</h2>
            </div>
            <div>    
            </div>
        </div>
        <div class="card__content">
            <div class="card__content--header marca">
                <div>
                    <p class="my-1 marca">Nome</p> 
                    <input type="text" class="input" v-model="nome"> 
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