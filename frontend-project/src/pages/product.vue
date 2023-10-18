<template>
  <div :class="{ 'background-opacity': table.form }">
  <table-lite
    :is-slot-mode="true"
    :max-height="800"
    :is-static-mode="true"
    :columns="table.columns"
    :rows="filteredProducts"
    :total="filteredProducts.length"
    :sortable="table.sortable"
    @VnodeMounted="initTable"
  >
    <template v-slot:image="data">
      <template v-if="data.value.image">
        <img
          :src="
            require('../../../backend-project/src/storage/app/public/image/' +
              data.value.image)
          "
          width="100"
          height="100"
        />
      </template>
      <template v-else>
        <p>No image available</p>
      </template>
    </template>

    <template v-slot:categories="data">
      <div>
        <ul v-if="data.value.categories && data.value.categories.length > 0">
          <li v-for="category in data.value.categories" :key="category.id">
            {{ category.name }} ({{
              category.parent_id !== null ? "Has Parent" : "No Parent"
            }})
          </li>
        </ul>
        <div v-else>No categories available.</div>
      </div>
    </template>
  </table-lite>
</div>
  <div class="my-3">
    <button class="btn btn-primary" @click.prevent="onSHowDialog()">Add product</button>
    <FormComponents v-if="table.form" @updateProductData="updateProductData">
      <div class="my-3">
        <button class="btn btn-primary" @click.prevent="onCloseDialog()">close</button>
      </div>
    </FormComponents>
  </div>
</template>

<script>
import { defineComponent, reactive, computed, ref, createApp, h } from "vue";
import TableLite from "vue3-table-lite";
import axios from "axios";
const searchTerm = ref("");
const data = ref([]);
import FormComponents from "../components/FormComponent.vue";
export default defineComponent({
  name: "product",
  components: { TableLite, FormComponents },
  setup() {
    axios.get("http://localhost/products").then((response) => {
      data.value = response.data;
      console.log(data.value);
    });
    const table = reactive({
      isLoading: false,
      columns: [
        {
          label: "Name",
          field: "name",
          width: "3%",
          sortable: true,
        },
        {
          label: "Description",
          field: "description",
          width: "10%",
        },
        {
          label: "Price",
          field: "price",
          width: "15%",
          sortable: true,
        },
        {
          label: "Image",
          field: "image",
          width: "15%",
        },
        {
          label: "Categories",
          field: "categories",
          width: "15%",
        },
      ],
      form: false,
    });
    const updateProductData = (newProduct) => {
      data.value.push(newProduct);
    };
    const inputStyle = {
      width: "100%",
      padding: "8px",
      borderRadius: "4px",
      height: "30px",
      border: "1px solid #ccc",
      color: "black",
    };

    const initTable = ({ el: tableComponent }) => {
      let headerTr = tableComponent.getElementsByClassName("vtl-thead-tr");
      let cloneTr = headerTr[0].cloneNode(true);
      let childTh = cloneTr.getElementsByClassName("vtl-thead-th");
      for (let i = 0; i < childTh.length; i++) {
        childTh[i].innerHTML = "";
      }
      createApp(
        defineComponent({
          setup() {
            return () =>
              h("input", {
                value: searchTerm.value,
                onInput: (e) => {
                  searchTerm.value = e.target.value;
                },
                style: inputStyle,
                placeholder: "Filter by Category",
              });
          },
        })
      ).mount(childTh[4]);
      headerTr[0].after(cloneTr);
    };

    const filteredProducts = computed(() => {
      return data.value.filter((product) => {
        if (!searchTerm.value) {
          return true;
        }
        return product.categories.some((category) =>
          category.name.toLowerCase().includes(searchTerm.value.toLowerCase())
        );
      });
    });
    function onSHowDialog() {
      table.form = true;
    }
    function onCloseDialog() {
      table.form = false;
    }
    return {
      table,
      initTable,
      filteredProducts,
      onSHowDialog,
      onCloseDialog,
      updateProductData
    };
  },
});
</script>
<style>
.background-opacity {
  opacity: 0.7;
}
</style>
