<template>
  <div class="bloc-modale" v-if="revele">
    <div class="overlay" v-on:click="toggleModale"></div>

    <div class="modale card">
      <div v-on:click="toggleModale" class="btn-modale btn btn-danger">X</div>
      <input type="text" class="form-control" placeholder="Name" v-model="name" />
      <input type="text" class="form-control" placeholder="Price" v-model="price" />
      <input type="text" class="form-control" placeholder="Description" v-model="description" />
      <label for="files" class="btn">Select Image :</label>
      <input id="file" class="input-file" @change="handleFileChange" type="file" />
      <div>Select Category :</div>
      <div class="category-list">
        <label
          v-for="element in Category"
          :key="element.id"
          :class="{ 'selected-category': element.selected }"
        >
          <input type="checkbox" v-model="element.selected" /> {{ element.name }}
        </label>
      </div>
      <div v-if="showAlert" class="alert" :class="alertType">{{ errorMessage }}</div>
      <button class="btn btn-primary" @click="submit">Add Product</button>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: "Modale",
  props: ["revele", "toggleModale"],
  components: {
  },
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
  created() {
    axios.get('http://localhost/category')
      .then(response => {
        console.log(response.data.data)
        this.Category = response.data.data.category;
      })
      .catch(error => {
        console.error('Error fetching data: ' + error);
      });
  },
  computed: {
    selectedNames() {
      return this.Category.filter((element) => element.selected).map((element) => element.id);
    },
  },
methods: {
    handleFileChange(event) {
      this.selectedImage = event.target.files[0];
    },
  async submit() {
      const formData = new FormData();
      if (!this.name || !this.description || isNaN(parseFloat(this.price))) {
        this.errorMessage = "Erreur : required fields";
        console.log(this.errorMessage);
        return;
      }
      formData.append("name", this.name);
      formData.append("price", this.price);
      formData.append("description", this.description);
      console.log(this.selectedNames)
      if (this.selectedNames) {
        formData.append("category_ids", this.selectedNames.join(","));
      }

      if (this.selectedImage) {
        formData.append("image", this.selectedImage);
      }
console.log(formData)
      axios
        .post("http://localhost/products", formData)
        .then((response) => {
          this.alertMessage = "Product added successfully";
          this.alertType = "success";
          this.showAlert = false;
          this.name = "";
          this.price = "";
          this.description = "";
          this.value = null;
          this.selectedImage = null;
          const newProduct = response.data.product;
            this.$emit("updateProductData", newProduct);
        })
        .catch((error) => {
          console.error(error);
        });
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
  padding: 6px;
  margin: 5px;
}
.form-control {
  margin: 5px;
}
</style>
