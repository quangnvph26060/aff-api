import { ref, reactive, inject } from 'vue'
import { useRouter } from "vue-router";
import axios from 'axios';
import apiURL from "../../connect";
export default function Product() {
    const API_BACK_END = apiURL.baseURL;
    // const headers = {
    //     'accept': 'application/json',
    //     'Authorization': 'Bearer ' + localStorage.getItem('token')
    // }
    const responseProduct = reactive({
        data: [],
        productCategory: [],
    })
    const getProduct = async () => {
        try {
            const response = await axios.get(`${API_BACK_END}products`);
            if(response.data.status === 'success'){
                responseProduct.data = response.data.data;
            }
        } catch (error) {
            console.error('Error fetching the product:', error);
        }
    }
    // lấy ra sản phẩm theo id 
    const findProduct = async (id) =>{
        try {
            const response = await axios.post(`${API_BACK_END}products/${id}`);
            if(response.data.status === 'success'){
                responseProduct.data = response.data.data;
                const responsecategory = await axios.post(`${API_BACK_END}products/bycategory/${responseProduct.data.category_id}`);
                if(responsecategory.data.status === 'success'){
                    responseProduct.productCategory = responsecategory.data.data;
                }
            }
        } catch (error) {
            console.error('Error fetching the product:', error);
        }
    }

    return {
        getProduct,
        responseProduct,
        findProduct,
    }
}