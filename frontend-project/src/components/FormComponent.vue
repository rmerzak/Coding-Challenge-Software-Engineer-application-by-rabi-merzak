<template>
  <div class="backdrop">
    <div class="dialog">
      <div class="wrapper">
        <div>
          <InputText type="text" placeholder="Name" v-model="name" />
          <InputText type="text" placeholder="Price" v-model="price" />
          <InputText type="text" placeholder="Description" v-model="description" />
          <Multiselect
            v-model="value" 
            mode="tags"
            placeholder="Select categories"
            track-by="id"
            label="name"
            :close-on-select="false"
            :search="true"
            :options="options"
            :classes="{
              container:
                'relative mx-auto w-full flex items-center justify-end box-border cursor-pointer border border-gray-300 rounded bg-white text-base leading-snug outline-none',
              containerDisabled: 'cursor-default bg-gray-100',
              containerOpen: 'rounded-b-none',
              containerOpenTop: 'rounded-t-none',
              containerActive: 'ring ring-green-500 ring-opacity-30',
              wrapper:
                'relative mx-auto w-full flex items-center justify-end box-border cursor-pointer outline-none',
              singleLabel:
                'flex items-center h-full max-w-full absolute left-0 top-0 pointer-events-none bg-transparent leading-snug pl-3.5 pr-16 box-border rtl:left-auto rtl:right-0 rtl:pl-0 rtl:pr-3.5',
              multipleLabel:
                'flex items-center h-full absolute left-0 top-0 pointer-events-none bg-transparent leading-snug pl-3.5 rtl:left-auto rtl:right-0 rtl:pl-0 rtl:pr-3.5',
              tags:
                'flex-grow flex-shrink flex flex-wrap items-center mt-1 pl-2 min-w-0 rtl:pl-0 rtl:pr-2',
              tag:
                'bg-green-500 text-white text-sm font-semibold py-0.5 pl-2 rounded mr-1 mb-1 flex items-center whitespace-nowrap min-w-0 rtl:pl-0 rtl:pr-2 rtl:mr-0 rtl:ml-1',
              tagDisabled: 'pr-2 opacity-50 rtl:pl-2',
              tagWrapper: 'whitespace-nowrap overflow-hidden overflow-ellipsis',
              tagRemove:
                'flex items-center justify-center p-1 mx-0.5 rounded-sm hover:bg-black hover:bg-opacity-10 group',
              tagRemoveIcon:
                'bg-multiselect-remove bg-center bg-no-repeat opacity-30 inline-block w-3 h-3 group-hover:opacity-60',
              placeholder:
                'flex items-center h-full absolute left-0 top-0 pointer-events-none bg-transparent leading-snug pl-3.5 text-gray-400 rtl:left-auto rtl:right-0 rtl:pl-0 rtl:pr-3.5',
              dropdown:
                'max-h-60 absolute -left-px -right-px bottom-0 transform translate-y-full border border-gray-300 -mt-px overflow-y-scroll z-50 bg-white flex flex-col rounded-b',
              dropdownHidden: 'hidden',
              options: 'flex flex-col p-0 m-0 list-none',
              groupLabelPointable: 'cursor-pointer',
              option:
                'flex items-center justify-start box-border text-left cursor-pointer text-base leading-snug py-2 px-3',
              optionSelected: 'text-white bg-green-500',
              optionDisabled: 'text-gray-300 cursor-not-allowed',
              noResults: 'py-2 px-3 text-gray-600 bg-white text-left rtl:text-right',
              fakeInput:
                'bg-transparent absolute left-0 right-0 -bottom-px w-full h-px border-0 p-0 appearance-none outline-none text-transparent',
              spacer: 'h-9 py-px box-content',
            }"
          >
            <template v-slot:tag="{ option, handleTagRemove, disabled }">
              <div
                class="multiselect-tag is-user"
                :class="{
                  'is-disabled': disabled,
                }"
              >
                {{ option.name }}
                <span
                  v-if="disabled"
                  class="multiselect-tag-remove"
                  @mousedown.prevent="handleTagRemove(option, $event)"
                >
                  <span class="multiselect-tag-remove-icon"></span>
                </span>
              </div>
            </template>
          </Multiselect>
          <label for="files" class="btn">Select Image :</label>
          <input id="file" class="input-file" @change="handleFileChange" type="file" />

          <div v-if="showAlert" class="alert" :class="alertType">{{ errorMessage }}</div>
        </div>
        <div class="container">
          <button class="btn btn-primary" @click="submit">Add Product</button>
          <slot />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Multiselect from "@vueform/multiselect";
import InputText from "primevue/inputtext";

import axios from "axios";
export default {
  components: {
    Multiselect,
    InputText,
  },
  data() {
    return {
      name: "",
      price: "",
      description: "",
      selectedCategories: [],
      selectedCities: [],
      value: null,
      options: [],
      errorMessage: null,
      showAlert: true,
    };
  },
  methods: {
    async fetchDataFromServer() {
      try {
        const response = await axios.get("http://localhost/category");
        this.options = response.data.map((item) => ({
          id: item.name,
          value: item.id,
          name: item.name,
        }));
        console.log(this.options);
        console.log("Data fetched successfully");
      } catch (error) {
        console.error("Error fetching data:", error);
      }
    },
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
      if (this.value) {
        formData.append("category_ids", this.value.join(","));
      }

      if (this.selectedImage) {
        formData.append("image", this.selectedImage);
      }

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
  mounted() {
    this.fetchDataFromServer();
  },
};
</script>
<style>
.backdrop {
  position: fixed;
  top: 0px;
  left: 0px;
  right: 0px;
  bottom: 0px;
  background: rgba(0, 0, 0, 0.3);
}
.dialog {
  background: #fff;
  width: 500px;
  position: fixed;
  top: 40%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}
.btn {
  background: #3f51b5;
  color: white;
  border: 0;
  padding: 7px;
  border-radius: 5px;
}

.wrapper {
  width: 400px;
  margin: 40px auto;
  padding: 10px;
  border-radius: 5px;
  box-shadow: 0px 10px 40px 0px rgba(47, 47, 47, 0.1);
}

input[type="text"] {
  padding: 10px;
  margin: 10px auto;
  display: block;
  border-radius: 5px;
  border: 1px solid lightgrey;
  background: none;
  width: 380px;
  color: black;
}

input[type="text"]:focus {
  outline: none;
}
.multiselect-green {
  --ms-tag-bg: #d1fae5;
  --ms-tag-color: #059669;
}
.controls {
  width: 294px;
  margin: 15px auto;
}

.controls a i.fa-minus {
  margin-right: 5px;
}

h1 {
  text-align: center;
  font-size: 48px;
  color: #232c3d;
}
.multiselect-tag.is-user {
  padding: 5px 2px;
  border-radius: 9px;
  margin: 3px 3px 2px;
}

.multiselect-tag.is-user i:before {
  color: #ffffff;
  border-radius: 50%;
}
.container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-top: 0px;
  margin-top: 0px;
}

input[type="file"]::file-selector-button {
  border-radius: 4px;
  padding: 0 16px;
  margin-top: 10px;
  height: 40px;
  cursor: pointer;
  background-color: white;
  border: 1px solid rgba(0, 0, 0, 0.16);
  box-shadow: 0px 1px 0px rgba(0, 0, 0, 0.05);
  margin-right: 16px;
  transition: background-color 200ms;
}
input[type="file"]::file-selector-button:hover {
  background-color: #f3f4f6;
}
input[type="file"]::file-selector-button:active {
  background-color: #e5e7eb;
}
</style>
