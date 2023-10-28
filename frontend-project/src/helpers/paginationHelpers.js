
export function calculateTotalPages(product, pageSize) {
    return Math.ceil(product.length / pageSize);
}

export function calculatePageNumbers(totalPages, currentPage) {
    const pageNumbers = [];
    if (totalPages <= 7) {
      for (let i = 1; i <= totalPages; i++) {
        pageNumbers.push(i);
      }
    } else {
      if (currentPage <= 4) {
        for (let i = 1; i <= 5; i++) {
          pageNumbers.push(i);
        }
        pageNumbers.push("...");
        pageNumbers.push(totalPages);
      } else if (currentPage >= totalPages - 3) {
        pageNumbers.push(1);
        pageNumbers.push("...");
        for (let i = totalPages - 4; i <= totalPages; i++) {
          pageNumbers.push(i);
        }
      } else {
        pageNumbers.push(1);
        pageNumbers.push("...");
        for (let i = currentPage - 1; i <= currentPage + 1; i++) {
          pageNumbers.push(i);
        }
        pageNumbers.push("...");
        pageNumbers.push(totalPages);
      }
    }
    return pageNumbers;
  }

  export function getPaginatedData(product, currentPage, pageSize, categoryFilter, sortOrder) {
    const startIndex = (currentPage - 1) * pageSize;
    const endIndex = startIndex + pageSize;
    const sortedProduct = sortProduct(product, sortOrder);
    const filteredProduct = categoryFilter
      ? sortedProduct.filter((product) => {
          return product.categories.some((category) =>
            category.name.toLowerCase().includes(categoryFilter.toLowerCase())
          );
        })
      : sortedProduct;
    return filteredProduct.slice(startIndex, endIndex);
  }

  export function sortProduct(product, sortOrder) {
    if (sortOrder === "asc") {
      return [...product].sort((a, b) => a.price - b.price);
    } else if (sortOrder === "desc") {
      return [...product].sort((a, b) => b.price - a.price);
    } else {
      return [...product];
    }
  }