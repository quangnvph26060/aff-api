import apiURL from "../../connect.js";
import { ref, reactive, inject } from 'vue'
export default function Wallet() {
    const API_BACK_END = apiURL.baseURL;
    const responseWallet = {
        data: [],
        teamRevenue: 0
    };

    const formData = reactive({
        wallet_type: '',
        method: '',
        amount: '',
        status: 'pending',
    });
    const headers = {
        'accept': 'application/json',
        'Authorization': 'Bearer ' + localStorage.getItem('token')
    }
    const postTransactionRequest = async (formData) => {
        try {
            const response = await axios.post(`${API_BACK_END}responseWallet`, { formData }, { headers: headers });

        } catch (error) {
            console.error('Failed to fetch team members:', error);
        }
    };
    const getTransactionAll = async () => {
        const headers = {
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + localStorage.getItem('token')
        };
    
        try {
            const response = await axios.get(`${API_BACK_END}transactionlist`, { headers });
            if (response.status === 200) {
                responseWallet.data = response.data;
            }
        } catch (error) {
            console.error('Failed to fetch transactions:', error);
        }
    };
    

    return {
        responseWallet,
        formData,
        postTransactionRequest,
        getTransactionAll
    };
}
