<template>

<!-- errors -->
<div v-if="errors != ''" class="mb-5 p-2 fw-bold text-center text-white bg-danger rounded">
    {{ errors }}
</div>
<div class="container-fluid">
    <form @submit.prevent="storeCustomer">
        <div class="row mb-3">
            <label for="name" class="col-sm-2 col-form-label">Nom du client</label>
            <div class="col-sm-10">
                <input type="text" class="form-control border rounded" id="name" v-model="form.name">
            </div>
        </div>
        <div class="row mb-3">
            <label for="tel" class="col-sm-2 col-form-label">Téléphone du client</label>
            <div class="col-sm-10">
                <input type="text" class="form-control border rounded" id="tel" v-model="form.tel">
            </div>
        </div>
        <fieldset class="row mb-3">
            <legend class="col-form-label col-sm-2 pt-0">Is_Favori ?</legend>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_favorite" id="is_favorite" v-model="form.is_favorite">
                </div>
            </div>
        </fieldset>
        <button type="submit" class="btn btn-outline-primary">Create Client</button>
    </form>
</div>

</template>


<script>
import { reactive } from 'vue'
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
    };
    console.log(errors);
    
    return {
      form,
      errors,
      storeCustomer
    };
  }
}
</script>
