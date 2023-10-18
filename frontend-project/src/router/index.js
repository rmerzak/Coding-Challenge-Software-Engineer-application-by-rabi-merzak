import { createRouter, createWebHistory } from "vue-router";
import dashboardApp from "../master/dashboard-app";
import product from "../pages/product";
import category from "../pages/category";

const routes = [
  {
    name: "dashboard-app",
    component: dashboardApp,
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
