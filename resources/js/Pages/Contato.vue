<script>
import TableVue from "@/Components/TableVue.vue";
import {Head} from '@inertiajs/inertia-vue3';
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import PrimaryButton from "@/Components/PrimaryButton.vue";



export default {
    components: {
        PrimaryButton,
        Head,
        TableVue
    },
    props: ['contatos', 'errors'],
    setup () {
        const form = reactive({
            nome: null,
            email: null,
            telefone: null,
            principal: null,
        })

        function submit() {
            Inertia.post('/', form)
        }

        return { form, submit }
    }
}
</script>

<template>
    <Head title="PHP - Laravel - Test" />
    <h1 class="text-4xl m-2 mb-4">Contatos</h1>
    <form @submit.prevent="submit">
        <div class="form-group mb-6 m-2 flex gap-2">
            <div>
                <label for="nome" class="form-label inline-block mb-2 text-gray-700"><b>Nome*</b></label>
                <input type="text" :style="errors.nome ? 'border-color:red' : ''" class="form-control block px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="nome"
                       name="nome" v-model="form.nome" aria-describedby="nome" placeholder="Insira o nome">
                <div v-if="errors.nome" class="text-red-400">{{ errors.nome }}</div>
            </div>
            <div>
                <label for="cpf" class="form-label inline-block mb-2 text-gray-700"><b>CPF*</b></label>
                <input type="text" v-maska="'###.###.###-##'" :style="errors.cpf ? 'border-color:red' : ''" class="form-control block px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="cpf"
                       name="cpf" v-model="form.cpf" placeholder="CPF" >
                <div v-if="errors.cpf" class="text-red-400">{{ errors.cpf }}</div>
            </div>
            <div>
                <label for="email" class="form-label inline-block mb-2 text-gray-700"><b>Email</b></label>
                <input type="email" class="form-control block px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="email"
                       name="email" v-model="form.email" placeholder="E-mail">
            </div>
            <div>
                <label for="telefone" class="form-label inline-block mb-2 text-gray-700"><b>Telefone</b></label>
                <input type="text" class="form-control block px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="telefone"
                       v-maska="'+55 (##) #####-####'"  name="telefone" v-model="form.telefone" placeholder="Telefone">
            </div>
            <div class="mt-10">
                <label for="principal" class="form-label mr-1 inline-block text-gray-700"><b>Principal</b></label>
                <input name="principal" v-model="form.principal" type="checkbox" id="principal">
            </div>
            <div>
                <PrimaryButton class="mt-8">Salvar</PrimaryButton>
            </div>

            <button type="submit" class="mt-10"></button>
        </div>
    </form>
    <TableVue :contatos="contatos" :errors="errors"></TableVue>

</template>

<style scoped>

</style>
