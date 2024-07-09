import { useRouter } from "vue-router";
import { ref, reactive, inject } from 'vue'
import { useStore } from 'vuex';
import store from '../../store/auth.js';
import validator from "../validator/validator.js";
import apiURL  from "../../connect.js";
export default function Order() {
	const API_BACK_END = apiURL.baseURL;
    // const formDataOrder = reactive({
    //     name: '',
    //     address: '',
    //     phone:'',
    //     list_product: [],
    //     zip_code:''
    // });
    const responseOrder = {
        data: [],
        count: 0
    };
    const responseOrderDetail = {
        data: [],
        count: 0
    };
    const router = useRouter();
    const headers = {
        'accept': 'application/json',
        'Authorization': 'Bearer ' + localStorage.getItem('token')
    }
    const handleError = (error) => {
		if (error.response) {
			console.error('Server responded with a status:', error.response.status);
			console.error('Response data:', error.response.data);
		} else if (error.request) {
			console.error('No response received:', error.request);
		} else {
			console.error('Error setting up the request:', error.message);
		}
		return error;
	};
    const submitOrder = async (formDataOrder) => {
        try {
            const  response  = await axios.post(`${API_BACK_END}createorder`,formDataOrder, { headers: headers });
                if(response.data.status === 'success'){
                    await router.push({ name: 'InformationLine' })
                }
        } catch (error) {
			throw handleError(error);
        }
    }
    const getOrder = async () => {
        try {
            const response  = await axios.get(`${API_BACK_END}get-order`, { headers: headers });
                if(response.data.status === 'success'){
                    responseOrder.data = response.data.data.orders
                    responseOrder.count = response.data.data.orderCount
                    console.log(responseOrder.data);
                }
        } catch (error) {
			throw handleError(error);
        }
    }
    const orderDetail = async () => {
        const headers = {
            'accept': 'application/json',
            'Authorization': 'Bearer ' + localStorage.getItem('token')
        }
        try {
            const response  = await axios.get(`${API_BACK_END}order-detail`, { headers: headers });
                if(response.data.status === 'success'){
                     responseOrderDetail.data = response.data.data
                }
        } catch (error) {
			throw handleError(error);
        }
    }
    return {
        submitOrder,
        getOrder,
        responseOrder,
        orderDetail,
        responseOrderDetail
    }
}