
<script setup>

    import axios, { all } from 'axios';
    import { onMounted, ref } from 'vue';
    import { useRouter } from 'vue-router';

    const router = useRouter();

    
    let form = ref({
        id:'',
    })

    const props = defineProps({
        id: {
            type: String,
            default: '',
        }
    });

    onMounted(async () => {
        getMarca()
    });

    const getMarca = async () => {
        let res = await axios.get('/api/edit_marcas/'+props.id)
        form.value = res.data.marca
    }
    
    const onEdit = async () => {
        const formData = new FormData()
        formData.append('nome', form.value.nome)

        axios.post(`/api/update_marca/${form.value.id}`, formData)
        router.push('/marcas')
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
            <div class="card__content--header marca">
                <div>
                    <p class="my-1">Descrição</p> 
                    <input type="text" class="input" v-model="form.nome"> 
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