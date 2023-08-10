
<template>
<!-- component -->

<!-- modal cerate start -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div v-if="errors != ''">
            {{ errors }}
        </div>
        <form @submit.prevent="saveCustomer">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Créer client</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <div class="mb-3">
                    <label for="name" class="col-form-label">Nom:</label>
                    <input type="text" class="form-control border rounded" id="name" v-model="customer.name">
                </div>
                <div class="mb-3">
                    <label for="tel" class="col-form-label">Téléphone:</label>
                    <input type="text" class="form-control border rounded" id="tel" v-model="customer.tel">
                </div>
                <div class="mb-3">
                    <label for="is_favorite" class="col-form-label">Favori ?</label>
                    <input type="checkbox" class="dark rounded m-3 cursor-pointer" id="is_favorite" v-model="customer.is_favorite">
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
import { reactive, onMounted } from 'vue';
import useCustomers from '../services/customerservices';

export default {
    props: {
        id: {
            required: true,
            type: String
        }
    },

  setup(props) {
    const { getCustomer, customer, updateCustomer, errors }  = useCustomers();

    onMounted(getCustomer(props.id));
    
    const saveCustomer = async () => {
        await update();
        //rouier.push({ name: 'customers.index'});
    };
    
    return {
      saveCustomer,
      customer,
      errors,
    };
  }
};
</script>