<template>
  <div>
    <div>
      <input type="text" v-model="categoryFilter" class="form-control" placeholder="Filter by category name" />
    </div>
    <table class="table">
      <thead>
        <tr>
          <th v-for="(col, index) in head" :key="index" scope="col">
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
        <tr v-for="row in paginatedData" :key="row.id && index">
          <td>{{ row.name }}</td>
          <td>{{ row.description }}</td>
          <td>{{ row.price }}</td>
          <td>
            <img
              :src="require('/usr/src/app/public/' + row.image)"
              width="100"
              height="100"
            />
          </td>
          <td>
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
export default {
  props: {
    product: Array,
    head: Array,
  },
  data() {
    return {
      currentPage: 1,
      pageSize: 5,
      sortOrder: null,
      categoryFilter: "",
    };
  },
  computed: {
    totalPages() {
      return Math.ceil(this.product.length / this.pageSize);
    },
    pageNumbers() {
      const pageNumbers = [];
      if (this.totalPages <= 7) {
        for (let i = 1; i <= this.totalPages; i++) {
          pageNumbers.push(i);
        }
      } else {
        if (this.currentPage <= 4) {
          for (let i = 1; i <= 5; i++) {
            pageNumbers.push(i);
          }
          pageNumbers.push("...");
          pageNumbers.push(this.totalPages);
        } else if (this.currentPage >= this.totalPages - 3) {
          pageNumbers.push(1);
          pageNumbers.push("...");
          for (let i = this.totalPages - 4; i <= this.totalPages; i++) {
            pageNumbers.push(i);
          }
        } else {
          pageNumbers.push(1);
          pageNumbers.push("...");
          for (let i = this.currentPage - 1; i <= this.currentPage + 1; i++) {
            pageNumbers.push(i);
          }
          pageNumbers.push("...");
          pageNumbers.push(this.totalPages);
        }
      }
      return pageNumbers;
    },
    paginatedData() {
      const startIndex = (this.currentPage - 1) * this.pageSize;
      const endIndex = startIndex + this.pageSize;
      const filteredProduct = this.sortedProduct.filter((product) => {
        if (this.categoryFilter) {
          return product.categories.some((category) =>
            category.name.toLowerCase().includes(this.categoryFilter.toLowerCase())
          );
        } else {
          return true;
        }
      });
      return filteredProduct.slice(startIndex, endIndex);
    },
    sortedProduct() {
      if (this.sortOrder === "asc") {
        console.log([...this.product].sort((a, b) => a.price - b.price));
        return [...this.product].sort((a, b) => a.price - b.price);
      } else if (this.sortOrder === "desc") {
        console.log([...this.product].sort((a, b) => b.price - a.price));
        return [...this.product].sort((a, b) => b.price - a.price);
      } else {
        return this.product;
      }
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
