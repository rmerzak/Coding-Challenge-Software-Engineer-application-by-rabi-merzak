<template>
  <div v-on:click="toggleModale" class="btn btn-primary">Add Product</div>
  <div>
    <ProdutTable :product="tableData" :head="tableHead" :class="{ 'background-opacity': revele }"/>
    <StoreProduct :revele="revele" :toggleModale="toggleModale"></StoreProduct>
  </div>
</template>

<script>
import ProdutTable from '../components/Products/ProductTable.vue'
import StoreProduct from '../components/Products/StoreProduct.vue'
import ProductsAPIService from '../services/products/ProductsAPIService'
const productsAPIService = new ProductsAPIService();
export default {
  components: {
    ProdutTable,
    StoreProduct
  },
  data() {
    return {
      tableData:[],
      tableHead: ["Name","Descrition", "Price", "Image", "Categorie"],
      revele: false
    };
  },
  methods: {
    toggleModale: function() {
      this.revele = !this.revele;
    }
  },
  async created() {
    const [error, data] = await productsAPIService.getProduct();
    if (error) console.error('Error fetching data:', error);
    else this.tableData = data.data.products;
  },
}
</script>

<style>
.background-opacity {
  opacity: 0.3;
}
.btn {
  width: 100%;
  margin-bottom:10px;
}
</style>