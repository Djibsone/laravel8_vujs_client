<template>

<!-- component -->
<div class="container-fluid">
    <form @submit.prevent="storeCustomer" class="col-md-8">
        <div class="mb-3">
            <label for="name" class="form-label">Nom du client</label>
            <input type="text" class="form-control border rounded" id="name" v-model="form.name">
        </div>
        <div class="mb-3">
            <label for="tel" class="form-label">Téléphone du client</label>
            <input type="text" class="form-control border rounded" id="tel" v-model="form.tel">
        </div>
        <div class="mb-3">
            <label for="is_favorite" class="col-form-label">Favori ?</label>
            <input type="checkbox" class="form-check-input m-3" id="is_favorite" v-model="form.is_favorite">
        </div>
        <button type="submit" class="btn btn-outline-primary">Create Client</button>
    </form>
</div>

</template>


<script>
import { reactive } from 'vue'
import router from '../router/index'
import useCustomers from '../services/customerservices';

export default {
   setup() {

    const form = reactive({
       name: '', 
       tel: '', 
       is_favorite: ''
    });

    const { createCustomer, errors }  = useCustomers();

    const storeCustomer = async () => {
        await createCustomer({...form});
        router.push({ name: 'customers.index'});
    };
    
    return {
      form,
      errors,
      storeCustomer
    };
  }
}
</script>
