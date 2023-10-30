<template>
  <div class="bloc-modale" v-if="revele">
    <div class="overlay" v-on:click="toggleModale"></div>

    <form @submit.prevent="submit">
      <div class="modale card">
        <div v-on:click="toggleModale" class="btn-modale btn btn-danger">X</div>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Name" v-model="name" />
        </div>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Price" v-model="price" />
        </div>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Description" v-model="description" />
        </div>
        <div class="form-group">
          <label for="file" class="btn">Select Image :</label>
          <input id="file" class="input-file" @change="handleFileChange" type="file" />
        </div>
        <div>Select Category :</div>
        <div class="form-group">
      <div class="category-list">
        <label
          v-for="element in Category"
          :key="element.id"
          :class="{ 'selected-category': element.selected }"
        >
          <input type="checkbox" v-model="element.selected" /> {{ element.name }} ,
        </label>
      </div>
      </div>
        <div v-if="showAlert" class="alert" :class="alertType">{{ errorMessage }}</div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Add Product</button>
        </div>
      </div>
    </form>
  </div>
</template>


<script>
import {validateForm, selectedCategorys} from '../../helpers/FormHelpers'
import CategoryAPIService from "../../services/category/CategoryAPIService";
import ProductsAPIService from "../../services/products/ProductsAPIService";
const categoryAPIService = new CategoryAPIService();
const productsAPIService = new ProductsAPIService();
export default {
  props: ["revele", "toggleModale"],
  data() {
    return {
      name: "",
      price: "",
      description: "",
      errorMessage: null,
      showAlert: true,
      Category: [],
    };
  },
  async created() {
    const [error, data] = await categoryAPIService.getCategory();
    if (error) console.error("Error fetching data:", error);
    else this.Category = data.data.category;
  },
  computed: {
    selectedNames() {
      return selectedCategorys(this.Category);
    },
  },
  methods: {
    handleFileChange(event) {
      this.selectedImage = event.target.files[0];
    },
    clearForm() {
      this.alertType = "success";
      this.showAlert = false;
      this.name = "";
      this.price = "";
      this.description = "";
      this.value = null;
      this.selectedImage = null;
      this.selectedCategorys = [];
    },
    async submit() {
      if (validateForm(this.name,this.description,this.price)) {
        const formData = new FormData();
        formData.append("name", this.name);
        formData.append("price", this.price);
        formData.append("description", this.description);

        if (this.selectedNames) {
          formData.append("category_ids", this.selectedNames.join(","));
        }
        if (this.selectedImage) {
          formData.append("image", this.selectedImage);
        }

        const [error, data] = await productsAPIService.addProduct(formData);
        if (error) {
          alert(data.message)
          console.error("Error Adding data:", error);
        } else {
          alert(data.message)
          this.clearForm();
          this.refreshPage();
        }
      } else {
        this.errorMessage = "Erreur : required fields";
      }
    },
    refreshPage() {
    window.location.reload();
  },
  },
};
</script>

<style scoped>
.bloc-modale {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  display: flex;
  justify-content: center;
  align-items: center;
}

.overlay {
  background: rgba(0, 0, 0, 0.5);
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
}

.modale {
  background: #f1f1f1;
  color: #333;
  padding: 50px;
  position: fixed;
  top: 40%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}

.btn-modale {
  display: flex;
  align-items: center;
  justify-content: center;
  position: absolute;
  top: 10px;
  right: 10px;
  width: 10px;
  height: 20px;
  font-size: 11px;
}

.category-list {
  max-height: 200px;
  overflow-y: auto;
  border: 1px solid #ccc;
  background-color: #ffff;
}

.selected-category {
  background-color: #0d6efd;
  color: #ffffff;
  border-radius: 6px;
  padding: 4px;
  margin: 4px;
}
.form-control {
  margin: 5px;
}
.btn-primary {
  background-color: #0d6efd;
}
</style>
