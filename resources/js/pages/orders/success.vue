

<template>
	<div>
        <div class="row justify-content-center" v-if="data">
                        <div class="col-xxl-9">
                            <div class="card" id="demo">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <!-- {{ data }} -->
                                        <!--end card-header-->
                                    </div><!--end col-->
                                    <div class="col-lg-12">
                                        <div class="card-body p-4">
                                            <div class="row g-3">
                                                <div class="col-lg-3 col-6">
                                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Mã đơn hàng</p>
                                                    <h5 class="fs-14 mb-0">#VL<span id="invoice-no" >{{data.zip_code}}</span></h5>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3 col-6">
                                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Ngày tạo</p>
                                                    <h5 class="fs-14 mb-0"><span id="invoice-date">{{data.created_at}}</span>  </h5>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3 col-6">
                                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Tình trạng thanh toán </p>
                                                    <span class="badge bg-success-subtle text-success fs-11"
                                                        id="payment-status">Paid</span>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3 col-6">
                                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Tổng tiền</p>
                                                    <h5 class="fs-14 mb-0"><span id="total-amount">{{useFormatCurrency(data.total_money)}}</span></h5>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                        </div>
                                        <!--end card-body-->
                                    </div><!--end col-->
                                    <div class="col-lg-12">
                                        <div class="card-body p-4 border-top border-top-dashed">
                                            <div class="row g-3">
                                                <!-- <div class="col-6">
                                                    <h6 class="text-muted text-uppercase fw-semibold mb-3">Billing
                                                        Address</h6>
                                                    <p class="fw-medium mb-2" id="billing-name">David Nichols</p>
                                                    <p class="text-muted mb-1" id="billing-address-line-1">305 S San
                                                        Gabriel Blvd</p>
                                                    <p class="text-muted mb-1"><span>Phone: +</span><span
                                                            id="billing-phone-no">(123) 456-7890</span></p>
                                                    <p class="text-muted mb-0"><span>Tax: </span><span
                                                            id="billing-tax-no">12-3456789</span> </p>
                                                </div> -->
                                                <!--end col-->
                                                <div class="col-6">
                                                    <h6 class="text-muted text-uppercase fw-semibold mb-3">Địa chỉ nhận hàng </h6>
                                                    <p class="fw-medium mb-2" id="shipping-name">{{ data.user_id[0].address }}</p>
                                                    
                                                    <p class="text-muted mb-1"><span>Phone: +</span><span
                                                            id="shipping-phone-no">{{ data.user_id[0].phone }}</span></p>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                        </div>
                                        <!--end card-body-->
                                    </div><!--end col-->
                                    <div class="col-lg-12">
                                        <div class="card-body p-4">
                                            <div class="table-responsive">
                                                <table
                                                    class="table table-borderless text-center table-nowrap align-middle mb-0">
                                                    <thead>
                                                        <tr class="table-active">
                                                            <th scope="col" style="width: 50px;">#</th>
                                                            <th scope="col">Thông tin sản phẩm</th>
                                                            <th scope="col">Đơn giá</th>
                                                            <th scope="col">Số lượng</th>
                                                            <th scope="col" class="text-end">Tổng tiền</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="products-list" v-for="(item, index) in data.order_detail" :key="index">
                                                        
                                                        <tr>
                                                            <th scope="row">{{ index + 1 }}</th>
                                                            <td class="text-start">
                                                                <span class="fw-medium">{{ item.product.name }}</span>
                                                              
                                                            </td>
                                                            <td>{{ useFormatCurrency(item.product.price) }}</td>
                                                            <td>{{ item.quantity }}</td> 
                                                            <td class="text-end">{{ useFormatCurrency(item.product.price *  item.quantity ) }}</td>
                                                        </tr>
                                                        
                                                        
                                                        
                                                    </tbody>
                                                </table><!--end table-->
                                            </div>
                                            <div class="border-top border-top-dashed mt-2">
                                                <table
                                                    class="table table-borderless table-nowrap align-middle mb-0 ms-auto"
                                                    style="width:250px">
                                                    <tbody>
                                                        <tr>
                                                            <td>Tổng phụ : </td>
                                                            <td class="text-end">{{ useFormatCurrency(data.total_money) }}</td>
                                                        </tr>
                                                        <!-- <tr>
                                                            <td>Estimated Tax (12.5%)</td>
                                                            <td class="text-end">44.99</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Discount <small class="text-muted">(VELZON15)</small>
                                                            </td>
                                                            <td class="text-end">- 53.99</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Shipping Charge</td>
                                                            <td class="text-end">65.00</td>
                                                        </tr> -->
                                                        <tr class="border-top border-top-dashed fs-15">
                                                            <th scope="row">Tổng cộng : </th>
                                                            <th class="text-end">{{ useFormatCurrency(data.total_money )}}</th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!--end table-->
                                            </div>
                                            <div class="mt-3">
                                                <h6 class="text-muted text-uppercase fw-semibold mb-3">Chi tiết thanh toán:
                                                </h6>
                                                <p class="text-muted mb-1">Phương thức thanh toán: <span class="fw-medium"
                                                        id="payment-method">Mastercard</span></p>
                                                <p class="text-muted mb-1">Chủ thẻ: <span class="fw-medium"
                                                        id="card-holder-name">{{data.user_id[0].name}}</span></p>
                                                <p class="text-muted mb-1">Số thẻ: <span class="fw-medium"
                                                        id="card-number">xxx xxxx xxxx 1234</span></p>
                                                <p class="text-muted">Tổng tiền: <span class="fw-medium" id="">
                                                    </span>{{useFormatCurrency(data.total_money)}}<span id="card-total-amount"></span></p>
                                            </div>
                                            <div class="mt-4">
                                                <div class="alert alert-info">
                                                    <p class="mb-0"><span class="fw-semibold">LƯU Ý :</span>
                                                        <span id="note">Tất cả các tài khoản phải được thanh toán trong vòng 7 ngày kể từ ngày nhận được hóa đơn. Được thanh toán bằng séc hoặc thẻ tín dụng hoặc thanh toán trực tiếp trực tuyến. Nếu tài khoản không được thanh toán trong vòng 7 ngày, các chi tiết tín dụng được cung cấp để xác nhận công việc đã thực hiện sẽ bị tính phí trích dẫn đã thỏa thuận nêu trên.
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                                                <a href="javascript:window.print()" class="btn btn-success"><i
                                                        class="ri-printer-line align-bottom me-1"></i> Print</a>
                                                <a href="javascript:void(0);" class="btn btn-primary"><i
                                                        class="ri-download-2-line align-bottom me-1"></i> Download</a>
                                            </div>
                                        </div>
                                        <!--end card-body-->
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div>
                            <!--end card-->
                        </div>
                        <!--end col-->
                    </div>
	</div>
</template>
<script setup>
import {onMounted, ref} from 'vue';
import Order from "../../api/order/order.js";
import { useFormatCurrency } from '../../composables/useFormatCurrency';
    const {orderDetail, responseOrderDetail} = Order();
    const data = ref();
    onMounted(async() => {
        await orderDetail();
        data.value = responseOrderDetail.data;
        console.log(responseOrderDetail.data.zip_code);
    })
</script>