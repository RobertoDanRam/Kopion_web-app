<template>
    <div class="tracking-container">
        <!-- 1. Company Name -->
        <h1 class="company-name">KOPION & La Capital del Café</h1>
        <p class="subtitle">Stationery & Coffee Shop Management</p>

        <div class="card">
            <!-- 2. Title -->
            <h2 class="title">Track Your Order</h2>

            <!-- 3. Short Instruction -->
            <p class="instruction">
                Enter your Customer Number and Invoice Number (Order ID) below to check the current status of your order.
            </p>

            <form @submit.prevent="checkOrderStatus" class="tracking-form">
                <!-- 4. Customer Number Field -->
                <div class="form-group">
                    <label for="customerNumber">Customer Number (User ID)</label>
                    <input
                        id="customerNumber"
                        type="number"
                        v-model="customerNumber"
                        placeholder="e.g., 4"
                        required
                    />
                </div>

                <!-- 5. Invoice Number Field -->
                <div class="form-group">
                    <label for="invoiceNumber">Invoice Number (Order ID)</label>
                    <input
                        id="invoiceNumber"
                        type="number"
                        v-model="invoiceNumber"
                        placeholder="e.g., 51"
                        required
                    />
                </div>

                <!-- 6. Check Order Status Button -->
                <button type="submit" class="submit-btn" :disabled="loading">
                    {{ loading ? 'Searching...' : 'Check Order Status' }}
                </button>
            </form>

            <!-- Mensaje de error -->
            <div v-if="error" class="error-msg">
                {{ error }}
            </div>

            <!-- Resultado real desde tu API /api/orders/{id} -->
            <div v-if="orderResult" class="result-card">
                <div class="result-header">
                    <h3>Order Summary</h3>
                    <span :class="['status-badge', statusClass]">
                        {{ orderResult.status }}
                    </span>
                </div>

                <div class="result-details">
                    <p><strong>Invoice Number:</strong> {{ orderResult.invoice_number }}</p>
                    <p><strong>Order ID:</strong> #{{ orderResult.id }}</p>
                    <p><strong>Customer ID:</strong> {{ orderResult.user_id }}</p>
                    <p><strong>Branch ID:</strong> {{ orderResult.branch_id }}</p>
                    <p><strong>Total Amount:</strong> ${{ Number(orderResult.total_amount).toFixed(2) }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            customerNumber: '',
            invoiceNumber: '',
            orderResult: null,
            error: null,
            loading: false
        };
    },
    computed: {
        statusClass() {
            if (!this.orderResult || !this.orderResult.status) return '';
            const status = this.orderResult.status.toLowerCase();
            if (status === 'completed' || status === 'delivered') return 'status-completed';
            if (status === 'cancelled') return 'status-cancelled';
            return 'status-pending';
        }
    },
    methods: {
        async checkOrderStatus() {
            this.error = null;
            this.orderResult = null;
            this.loading = true;

            try {
                // Consulta real a tu endpoint GET /api/orders/{id}
                const response = await axios.get(`/api/orders/${this.invoiceNumber}`);
                const order = response.data.data ? response.data.data : response.data;

                // Valida que la orden pertenezca al Customer Number (user_id) ingresado
                if (String(order.user_id) !== String(this.customerNumber)) {
                    this.error = 'The Customer Number does not match this order.';
                    return;
                }

                this.orderResult = order;
            } catch (err) {
                if (err.response && err.response.status === 404) {
                    this.error = 'Order not found or it has been archived. Please verify your Invoice Number.';
                } else {
                    this.error = 'Unable to connect to the server. Make sure Laravel is running.';
                }
            } finally {
                this.loading = false;
            }
        }
    }
};
</script>

<style scoped>
.tracking-container {
    max-width: 520px;
    margin: 40px auto;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #2c241e;
}

.company-name {
    text-align: center;
    color: #4a2c18;
    font-size: 26px;
    font-weight: 800;
    margin-bottom: 4px;
    letter-spacing: 0.5px;
}

.subtitle {
    text-align: center;
    color: #8c6d53;
    font-size: 14px;
    margin-top: 0;
    margin-bottom: 24px;
}

.card {
    background: #ffffff;
    padding: 32px;
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(74, 44, 24, 0.1);
    border-top: 5px solid #6f4e37;
}

.title {
    margin-top: 0;
    margin-bottom: 8px;
    font-size: 22px;
    color: #2c241e;
}

.instruction {
    color: #666;
    font-size: 14px;
    line-height: 1.4;
    margin-bottom: 24px;
}

.form-group {
    margin-bottom: 18px;
}

label {
    display: block;
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 6px;
    color: #3e2723;
}

input {
    width: 100%;
    padding: 11px 12px;
    border: 1px solid #d7ccc8;
    border-radius: 6px;
    font-size: 15px;
    box-sizing: border-box;
    transition: border-color 0.2s;
}

input:focus {
    outline: none;
    border-color: #6f4e37;
}

.submit-btn {
    width: 100%;
    background: #6f4e37;
    color: #ffffff;
    border: none;
    padding: 13px;
    font-size: 16px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 600;
    margin-top: 6px;
    transition: background-color 0.2s;
}

.submit-btn:hover:not(:disabled) {
    background: #5a3e2b;
}

.submit-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.error-msg {
    margin-top: 18px;
    color: #b71c1c;
    background: #ffebee;
    border-left: 4px solid #d32f2f;
    padding: 12px;
    border-radius: 4px;
    font-size: 14px;
    font-weight: 500;
}

.result-card {
    margin-top: 24px;
    padding: 18px;
    background: #faf8f5;
    border: 1px solid #e0d6cc;
    border-left: 5px solid #2e7d32;
    border-radius: 6px;
}

.result-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #e0d6cc;
    padding-bottom: 10px;
    margin-bottom: 12px;
}

.result-header h3 {
    margin: 0;
    font-size: 17px;
    color: #3e2723;
}

.result-details p {
    margin: 6px 0;
    font-size: 14px;
    color: #4e342e;
}

.status-badge {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: bold;
    text-transform: uppercase;
    color: white;
}

.status-completed {
    background-color: #2e7d32;
}

.status-pending {
    background-color: #ed6c02;
}

.status-cancelled {
    background-color: #d32f2f;
}
</style>