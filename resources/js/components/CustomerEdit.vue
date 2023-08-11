<template>
    <!-- errors -->
    <div v-if="errors != ''" class="mb-5 p-2 fw-bold text-center text-white bg-danger rounded">
        {{ errors }}
    </div>
    <div class="container-fluid">
        <form @submit.prevent="saveCustomer">
            <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Nom du client</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control border rounded" id="name" v-model="customer.name">
                </div>
            </div>
            <div class="row mb-3">
                <label for="tel" class="col-sm-2 col-form-label">Téléphone du client</label>
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
    </div>
</template>



<script>
    import { reactive, onMounted } from 'vue';
    //import router from '../router/index'; // Assurez-vous que l'importation du routeur est correcte
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
                await updateCustomer(props.id);
                //router.push({ name: 'customers.index'}); // Rediriger après la mise à jour
            };

            return {
                saveCustomer,
                customer,
                errors,
            };
        }
    };
</script>
