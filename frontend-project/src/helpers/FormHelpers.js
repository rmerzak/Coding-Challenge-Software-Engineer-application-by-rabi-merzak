
export function  validateForm(name, description, price) {
    if (!name || !description || isNaN(parseFloat(price))) {
      return false;
    }
    return true;
  }

export function selectedCategorys(Category) {
    return Category.filter((element) => element.selected).map(
      (element) => element.id
    );
  }