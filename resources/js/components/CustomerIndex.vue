
<template>
<!-- component -->
<section class="antialiased bg-gray-100 text-gray-600 h-screen px-4">
    <div class="flex flex-col justify-center h-full">
        <!-- Table -->
        <div class="w-full max-w-2xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
            <header class="px-5 py-4 border-b border-gray-100">
                <h2 class="font-semibold text-gray-800">Customers</h2>
            </header>
            <div class="p-3">
                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold uppercase text-gray-800 bg-gray-50">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Nom</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Téléphone</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Is_Favorite</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100" v-if="customers.length > 0">
                            <tr v-for="customer in customers" :key="customer.id">
                                <td class="p-2 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <!-- <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3"><img class="rounded-full" src="https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-05.jpg" width="40" height="40" alt="Alex Shatov"></div> -->
                                        <div class="font-medium text-gray-800">{{ customer.name }}</div>
                                    </div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{ customer.tel }}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left font-medium text-green-500">{{ customer.is_favorite }}</div>
                                </td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <p>Aucun client trouvé</p>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
</template>



<script>
import { onMounted } from 'vue';
import useCustomers from '../services/customerservices';

export default {
  setup() {
   
    const { customers, getCustomers }  = useCustomers();
    
    onMounted(getCustomers);

    return {
      customers
    };
  }
};
</script>