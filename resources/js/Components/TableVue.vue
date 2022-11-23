<script>
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'

export default {
    props: ['contatos', 'errors'],
    setup () {
        const form = reactive({
            nome: null,
            email: null,
            cpf: null,
            telefone: null,
            principal: null,
        })

        function destroy(id) {
            Inertia.delete('/'+id)
        }

        function update(contato) {
            form.nome_edit = contato.nome
            form.cpf_edit = contato.cpf
            form.email = contato.email
            form.telefone = contato.telefone
            form.principal = contato.principal

            Inertia.put('/'+contato.id, form)
        }

        return { form, destroy, update }
    }
}
</script>

<template>
    <div class="flex flex-col m-10">
        <div v-if="errors.cpf_edit" class="text-red-400">{{ errors.cpf_edit }}</div>
        <div v-if="errors.nome_edit" class="text-red-400">{{ errors.nome_edit }}</div>
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full">
                        <thead class="border-b">
                        <tr>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Nome
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                CPF
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Email
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Telefone
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Principal
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">

                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border-b" v-for="(contato, key) in contatos" :key="key">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><input type="text" v-model="contato.nome" class="form-control block px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><input type="text" v-maska="'###.###.###-##'" v-model="contato.cpf" class="form-control block px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><input type="email" v-model="contato.email" class="form-control block px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><input type="text"  v-maska="'+55 (##) #####-####'" v-model="contato.telefone" class="form-control block px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"> <input type="checkbox" v-model="contato.principal"> </td>
                            <td class="flex mt-5 gap-2">
                                <button  @click="update(contato)" type="button" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                    Editar
                                </button>
                                <button @click.prevent="destroy(contato.id)" type="button" class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">
                                    Excluir
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
