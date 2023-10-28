const axios = require("axios");
const baseURL = process.env.API_BASE_URL;
class CategoryAPIService {
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
    async getCategory() {
        return this.axiosCall({ method: "get", url: "category" });
    }
}

module.exports = CategoryAPIService;