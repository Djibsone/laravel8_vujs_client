<template>

<!-- component -->
<div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8">
    <div class="align-middle rounded-tl-lg rounded-tr-lg inline-block w-full py-4 overflow-hidden bg-white shadow-lg px-12">
        <div class="flex justify-between">
            <div class="inline-flex border rounded w-7/12 px-2 lg:px-6 h-12 bg-transparent">
                <div class="flex flex-wrap items-stretch w-full h-full mb-6 relative">
                    <div class="flex">
                        <span class="flex items-center leading-normal bg-transparent rounded rounded-r-none border border-r-0 border-none lg:px-3 py-2 whitespace-no-wrap text-grey-dark text-sm">
                            <svg width="18" height="18" class="w-4 lg:w-auto" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.11086 15.2217C12.0381 15.2217 15.2217 12.0381 15.2217 8.11086C15.2217 4.18364 12.0381 1 8.11086 1C4.18364 1 1 4.18364 1 8.11086C1 12.0381 4.18364 15.2217 8.11086 15.2217Z" stroke="#455A64" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M16.9993 16.9993L13.1328 13.1328" stroke="#455A64" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </div>
                    <input type="text" class="flex-shrink flex-grow flex-auto leading-normal tracking-wide w-px flex-1 border border-none border-l-0 rounded rounded-l-none px-3 relative focus:outline-none text-xxs lg:text-xs lg:text-base text-gray-500 font-thin" placeholder="Search">
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col-md-6 mt-3 mb-2">
        <!-- <router-link :to="{ name: 'customers.create' }" class="btn btn-outline-success">Créer un client</router-link> -->
        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Créer un client</button>
    </div>
    <div class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg">
        <table class="table-auto w-full">
        <thead>
            <tr>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Nom</th>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Téléphone</th>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Is_Favorite</th>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider" colspan="2">Action</th>
            </tr>
        </thead>
            <tbody class="bg-white" v-if="customers.length > 0">
            <tr v-for="customer in customers" :key="customer.id">
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                    <div class="text-sm leading-5 text-blue-900">{{ customer.name }}</div>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">{{ customer.tel }}</td>
                <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">{{ customer.is_favorite }}</td>
                <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">
                    <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                        <router-link :to="{ name: 'customers.edit', params: { id: customer.id } }" class="btn btn-outline-warning mr-2">Editer</router-link>
                        <button @click="deleteCustomer(customer.id)" class="btn btn-outline-danger">Delete</button>
                    </span>
                </td>
            </tr>
            </tbody>
            <tbody v-else>
                <p>Aucun client trouvé</p>
            </tbody>
        </table>
    </div>
</div>

<!-- modal cerate start -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div v-if="errors != ''" class="m-2 p-2 fw-bold text-center text-white bg-danger rounded">
            {{ errors }}
        </div>
        <form @submit.prevent="storeCustomer">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Créer client</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <div class="mb-3">
                    <label for="name" class="col-form-label">Nom:</label>
                    <input type="text" class="form-control border rounded" id="name" v-model="form.name">
                </div>
                <div class="mb-3">
                    <label for="tel" class="col-form-label">Téléphone:</label>
                    <input type="text" class="form-control border rounded" id="tel" v-model="form.tel">
                </div>
                <div class="mb-3">
                    <label for="is_favorite" class="col-form-label">Favori ?</label>
                    <input type="checkbox" class="dark rounded m-3 cursor-pointer" id="is_favorite" v-model="form.is_favorite">
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-outline-primary">Enregistrer</button>
            </div>
        </form>
    </div>
  </div>
</div>
<!-- modal end -->

</template>



<script>
import { onMounted, reactive } from 'vue';
import useCustomers from '../services/customerservices';

export default {
  setup() {
   
    const { customers, getCustomers, destroyCustomer }  = useCustomers();
    
    const deleteCustomer = async (id) => {
        await destroyCustomer(id);
    };


    onMounted(getCustomers);

    const form = reactive({
       name: '', 
       tel: '', 
       is_favorite: ''
    });

    const { createCustomer, errors }  = useCustomers();

    const storeCustomer = async () => {
        await createCustomer({...form});
        window.location.reload();
    };
    
    return {
      customers,
      form,
      errors,
      storeCustomer,
      deleteCustomer
    };
  }
};
</script>