import { createRouter, createWebHistory } from "vue-router";
import Layout from "../components/master/Layout.vue";
import product from "../pages/product";
import category from "../pages/category";
import NotFoundComponent from "../components/NotFoundComponent.vue"

const routes = [
  {
    name: "Layout",
    component: Layout,
    path: "/",
    children: [
      {
        name: "product",
        component: product,
        path: "/product",
      },
      {
        name: "category",
        component: category,
        path: "/category",
      },
      {
        path: '/:catchAll(.*)',
        component: NotFoundComponent, // add this in the end
      },
    ],
  },
];
const router = Router();
export default router;
function Router() {
  const router = new createRouter({
    history: createWebHistory(),
    routes,
  });
  return router;
}
