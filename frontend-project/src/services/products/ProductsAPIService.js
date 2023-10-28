const axios = require("axios");
const baseURL = process.env.API_BASE_URL;
class ProductsAPIService {
    constructor() {
        this.axiosInstance = axios.create({
            baseURL,
        });
    }
    async axiosCall(config) {
        try {
            const response = await this.axiosInstance.request(config);
            return [null, response.data];
        } catch (error) {
            return [error];
        }
    }
    async getProduct() {
        return this.axiosCall({ method: "get", url: "products" });
    }
    async addProduct(FormData) {
        return this.axiosCall({method: "post", url: "products", data: FormData})
    }
}

module.exports = ProductsAPIService;

// import axios from 'axios'
// const baseURL = 'http://localhost/';

// const api = axios.create({
//     baseURL,
// })
// export default {
//     getProduct() {
//         api.get('products')
//     },
// };
// export async function getProducts() {
//     try {
//         const {data} = await api.get('products');
//         return [null, data];
//     } catch (error) {
//         return [error]

//     }
// }