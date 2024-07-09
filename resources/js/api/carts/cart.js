import { ref, reactive, inject } from 'vue'
import { useRouter } from "vue-router";
import axios from 'axios';
import { useStore } from "vuex";
import { forEach } from 'lodash-es';

export default function Cart() {
    const API_BACK_END = "http://127.0.0.1:8000/api/v1"
    // const headers = {
    //     'accept': 'application/json',
    //     'Authorization': 'Bearer ' + localStorage.getItem('token')
    // }
    const showErrorPopup = (icon, message, status) => {
        swal({
            icon: icon,
            html: message,
            showConfirmButton: status,
        });
    };
    const headers = {
        'accept': 'application/json',
        'Authorization': 'Bearer ' + localStorage.getItem('token')
    }
    const router = useRouter()
    const swal = inject('$swal');
    const store = useStore();
    const user = store.getters['user'];
    const responseCart = reactive({
        data: [],
        total: 0,
    })
    const addToCart = async (id) => {
        const formData = {
            'product_id': id,
            'user_id': user.id,
            'amount': 1
        }
        try {
            const response = await axios.post(`${API_BACK_END}/cart`, formData);

            if (response.data.status === 'success') {
                showErrorPopup('success', 'Đã thêm vào giỏ hàng', false);
            }

        } catch (error) {
            console.error(error);
        }
    }
    const getToCart = async () => {
        try {
            const response = await axios.get(`${API_BACK_END}/cart`, { headers });
            if (response.data.status === 'success') {
                responseCart.data = response.data.data;
                let total = 0;
                responseCart.data.forEach(function (item) {
                    let amount = item['amount'];
                    let price = item['product']['price'];
                    total += amount * price;
                })
                responseCart.total = total;
            }
        } catch (error) {
            console.error(error);
        }
    }
    const delToCart = async (id) => {
        try {
            const response = await axios.delete(`${API_BACK_END}/cart/${id}`);
            if (response.data.status === 'success') {
                getToCart();
            }
        } catch (error) {
            console.error(error);
        }
    };
    const updateToCart = async (id, amount) => {
        const formData = {
            'id': id,
            'amount': amount
        }
        try {
            const response = await axios.post(`${API_BACK_END}/cart/update/${id}`, formData);
            if (response.data.status === 'success') {
                getToCart();
            }
        } catch (error) {
            console.error(error);
        }
    };
    const clearCartUser = async () => {
        const headers = {
            'accept': 'application/json',
            'Authorization': 'Bearer ' + localStorage.getItem('token')
        }
        try {
            const response = await axios.post(`${API_BACK_END}/cart/clear-cart`, {}, { headers: headers });
            if (response.data.status === 'success') {
                getToCart();
            }
        } catch (error) {
            console.error(error);
        }
    };
    return {
        addToCart,
        getToCart,
        responseCart,
        delToCart,
        updateToCart,
        clearCartUser
    }
}