<template>
    <form @submit.prevent="saveCustomer">
        <div v-if="errors != ''">
            {{ errors }}
        </div>
        <div class="row mb-3">
            <label for="name" class="col-sm-2 col-form-label">Nom</label>
            <div class="col-sm-10">
                <input type="text" class="form-control border rounded" id="name" v-model="customer.name">
            </div>
        </div>
        <div class="row mb-3">
            <label for="tel" class="col-sm-2 col-form-label">Téléphone</label>
            <div class="col-sm-10">
                <input type="text" class="form-control border rounded" id="tel" v-model="customer.tel">
            </div>
        </div>
        <fieldset class="row mb-3">
            <legend class="col-form-label col-sm-2 pt-0">Is_Favori ?</legend>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_favorite" id="is_favorite" v-model="customer.is_favorite">
                    <!-- <label class="form-check-label" for="gridRadios1">
                    First radio
                    </label> -->
                </div>
            </div>
        </fieldset>
        <button type="submit" class="btn btn-outline-warning mt-2">Modifier</button>
    </form>
</template>



<script>
import { reactive, onMounted } from 'vue';
import { router } from '../router/index';
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

        onMounted(() => {
            getCustomer(props.id);
        });
        
        const saveCustomer = async () => {
            await updateCustomer(props.id); // Assurez-vous que la fonction updateCustomer reçoit les données du client à mettre à jour
            router.push({ name: 'customers.index'}); // Vous pouvez réactiver cette ligne une fois le problème résolu
        };

        return {
            saveCustomer,
            customer,
            errors,
        };
    }

};
</script>