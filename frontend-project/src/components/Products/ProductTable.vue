<template>
  <div>
    <div>
      <input type="text" v-model="categoryFilter" class="form-control" placeholder="Filter by category name" />
    </div>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th v-for="(col, index) in head" :key="index" scope="col" class="px-6 py-3">
            {{ col }}
            <button @click="updateSortOrder('asc')" v-if="col === 'Price'">
              &#9650;
            </button>
            <button @click="updateSortOrder('desc')" v-if="col === 'Price'">
              &#9660;
            </button>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="row in paginatedData" :key="row.id && index" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
          <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">{{ row.name }}</td>
          <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">{{ row.description }}</td>
          <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">{{ row.price }}</td>
          <td class="w-32 p-4">
            <img
              :src="require('/usr/src/app/src/assets/' + row.image)"
              width="100"
              height="100"
            />
          </td>
          <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
            <ul>
              <li v-for="category in row.categories" :key="category.id">
                {{ category.name }}
              </li>
            </ul>
          </td>
        </tr>
      </tbody>
    </table>
    <nav aria-label="Page navigation example" class="nav">
      <ul class="pagination">
        <li
          class="page-item"
          @click="previousPage"
          :class="{ disabled: currentPage === 1 }"
        >
          <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
        <li
          class="page-item"
          v-for="pageNumber in pageNumbers"
          :key="pageNumber"
          :class="{ active: currentPage === pageNumber, disabled: pageNumber === '...' }"
        >
          <a class="page-link" href="#" @click="goToPage(pageNumber)">{{ pageNumber }}</a>
        </li>
        <li
          class="page-item"
          @click="nextPage"
          :class="{ disabled: currentPage === totalPages }"
        >
          <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</template>
<script>
import {calculateTotalPages, calculatePageNumbers, getPaginatedData, sortProduct} from '../../helpers/paginationHelpers'
export default {
  props: {
    product: Array,
    head: Array,
  },
  data() {
    return {
      currentPage: 1,
      pageSize: 3,
      sortOrder: null,
      categoryFilter: "",
    };
  },
  computed: {
    totalPages() {
      return calculateTotalPages(this.product, this.pageSize);
    },
    pageNumbers() {
      return calculatePageNumbers(this.totalPages, this.currentPage);
    },
    paginatedData() {
      return getPaginatedData(this.product, this.currentPage, this.pageSize, this.categoryFilter, this.sortOrder);
    },
    sortedProduct() {
      return sortProduct(this.product, this.sortOrder);
    },
  },
  methods: {
    previousPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
      }
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
      }
    },
    goToPage(pageNumber) {
      if (pageNumber !== "...") {
        this.currentPage = pageNumber;
      }
    },
    updateSortOrder(order) {
      this.sortOrder = order;
      this.currentPage = 1;
    },
  },
  watch: {
    categoryFilter(newFilter) {
      if (!newFilter) {
        this.currentPage = 1;
      }
    },
  },
};
</script>
<style>
.nav {
  display: flex;
  justify-content: center;
}
</style>
