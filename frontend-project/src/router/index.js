import { createRouter, createWebHistory } from "vue-router";
import Index from "../components/Layout/Index.vue";
import product from "../pages/product";
import category from "../pages/category";
import NotFoundComponent from "../components/404/NotFoundComponent.vue"

const routes = [
  {
    name: "Layout",
    component: Index,
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
        component: NotFoundComponent,
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
